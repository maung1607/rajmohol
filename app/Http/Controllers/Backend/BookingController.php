<?php

namespace App\Http\Controllers\Backend;

use App\Enum\PaymentStatusEnum;
use App\Enum\ReservationStatusEnum;
use App\Enum\RoomInfoStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\AssignRoom;
use App\Models\Reservation;
use App\Models\RoomInfo;
use App\Services\BookingService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\Node\Expr\Assign;

class BookingController extends Controller
{
    public $bookingService;
    public $paymentService;
    public function __construct(BookingService $bookingService, PaymentService $paymentService)
    {
        $this->bookingService = $bookingService;
        $this->paymentService = $paymentService;
    }
    public function index()
    {
        return view("backend.pages.booking.index");
    }
    public function getData(Request $request)
    {
        $reservations = Reservation::with(['customer', 'payment'])->latest();


        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $reservations
                ->where('booking_id', 'like', "%{$search}%")
                ->orWhereHas('customer', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
        }

        return DataTables::of($reservations)
            ->addColumn('booking_id', function ($record) {
                return $record->booking_id;
            })
            ->addColumn('customer_info', function ($record) {
                $col = "<div> <strong>Name:</strong> " . $record?->customer?->name . "</div>";
                $col .= "<div> <strong>Email: </strong>" . $record?->customer?->email . "</div>";
                $col .= "<div> <strong>Phone: </strong>" . $record?->customer?->phone_number . "</div>";
                return $col;
            })
            ->addColumn('date', function ($record) {
                $col = "<div><strong>Check In: </strong>" . $record?->check_in_date . "</div>";
                $col .= "<div><strong>Check Out: </strong>" . $record?->check_out_date . "</div>";
                return $col;
            })
            ->addColumn('adults', function ($record) {
                return $record->adults;
            })
            ->addColumn('children', function ($record) {
                return $record->children;
            })
            ->addColumn('day_range', function ($record) {
                return $record->day_range;
            })
            ->addColumn('payment_info', function ($record) {
                $statusColors = [
                    'Pending' => 'info',
                    'Due' => 'warning',
                    'Failed' => 'danger',
                    'Completed' => 'success',
                ];
                $paymentStatus = $record?->payment?->status ?? 'Pending';
                $badgeColor = $statusColors[$paymentStatus] ?? 'secondary';

                $col = "<div><strong>Actual Amount:</strong> &#2547;" . $record?->payment?->actual_amount . "</div>";
                $col .= "<div><strong>Paid Amount:</strong> &#2547;" . $record?->payment?->paid_amount . "</div>";
                $col .= "<div><strong>Due Amount:</strong> &#2547;" . $record?->payment?->due_amount . "</div>";
                $col .= "<div><strong>Method:</strong> " . $record?->payment?->payment_method . "</div>";
                $col .= "<div><strong>Payment Status:</strong> <span class='badge text-white bg-$badgeColor'>" . ucfirst($paymentStatus) . "</span></div>";
                return $col;
            })
            ->addColumn('status', function ($record) {
                // Debugging: Check the status and payment status


                $statusColors = [
                    'Pending' => 'warning',
                    'Confirmed' => 'primary',
                    'Cancelled' => 'danger',
                    'Completed' => 'success',
                ];

                $badgeColor = $statusColors[$record->status] ?? 'secondary';
                $col = '<div class="mb-1"></div><span class="text-white badge bg-' . $badgeColor . '">' . ucfirst($record->status) . '</span></div>';

                // Check if the status is Confirmed and payment status is Completed
                if ($record->status === 'Confirmed' && isset($record->payment) && $record->payment->status === 'Completed') {
                    $col .= '<div class="mt-1"><a href="' . route('booking.complete', ['booking_id' => $record->booking_id]) . '"
                                   class="btn btn-success edit_btn"
                                   data-id="' . htmlspecialchars($record->id, ENT_QUOTES, 'UTF-8') . '"
                                   onclick="return confirm(\'Are you sure to complete booking?\')">
                                   Complete Booking
                                </a></div>';
                }

                return $col;
            })

            ->addColumn('actions', function ($record) {
                $btns = '
                <div class="btn-group">
                    <a href="' . route('booking.edit', ['booking_id' => $record->booking_id]) . '"
                       class="btn btn-primary edit_btn"
                       data-id="' . htmlspecialchars($record->id, ENT_QUOTES, 'UTF-8') . '">
                       Edit
                    </a>
                    <a href="' . route('booking.delete', ['booking_id' => $record->booking_id]) . '"
                       class="btn btn-danger delete_btn"
                       data-id="' . htmlspecialchars($record->id, ENT_QUOTES, 'UTF-8') . '"
                       onclick="return confirm(\'Are you sure you want to delete this item?\')">
                       Delete
                    </a>
                     <a href="' . route('booking.details', ['booking_id' => $record->booking_id]) . '"
                       class="btn btn-info"
                       data-id="' . htmlspecialchars($record->id, ENT_QUOTES, 'UTF-8') . '"
                      >
                       Details
                    </a>
                </div>';
                return $btns;
            })
            ->rawColumns(['customer_info', 'date', 'payment_info', 'status', 'actions'])
            ->make(true);
    }
    public function create()
    {
        $rooms = RoomInfo::where('status', RoomInfoStatusEnum::AVAILABLE)->get();
        return view('backend.pages.booking.create', ['rooms' => $rooms]);
    }
    public function store(Request $request)
    {
        //return $request->all();
        DB::beginTransaction();
        $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'adults' => 'required|numeric',
            'nid' => 'required',
            'children' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required',
            'actual_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0|lte:actual_amount',
            'payment_method' => 'required|string',
            'status' => 'required|string',
            'assign_rooms' => 'nullable|array',
        ]);

        $reservation = $this->bookingService->createBooking($request);
        Log::info($reservation);
        if ($reservation && $request->assign_rooms) {
            foreach ($request->assign_rooms as $roomId) {
                AssignRoom::create([
                    'reservation_id' => $reservation->id,
                    'room_info_id' => $roomId,
                ]);
            }

            RoomInfo::whereIn('id', $request->assign_rooms)->update([
                'status' => RoomInfoStatusEnum::OCCOPEID,
            ]);
        }
        DB::commit();
        flash()->option('position', 'bottom-right')->success('Booking created successfully!.');
        return redirect()->back();
    }

    public function edit($booking_id)
    {
        $reservation = Reservation::with(['customer', 'address', 'payment', 'assign_rooms'])
            ->where('booking_id', $booking_id)->first();
        $rooms = RoomInfo::get();
        return view('backend.pages.booking.edit', ['rooms' => $rooms, 'reservation' => $reservation]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'id' => 'required|exists:reservations,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'name' => 'required|string|max:255',
            'phone_number' => 'required',
            'email' => 'nullable|email|max:255',
            'adults' => 'required|numeric|min:1',
            'nid' => 'required|string|max:20',
            'children' => 'required|numeric|min:0',
            'address' => 'required',
            'city' => 'required|string|max:100',
            'postal_code' => 'required',
            'actual_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0|lte:actual_amount',
            'payment_method' => 'required|string',
            'status' => 'required|string',
            'assign_rooms' => 'nullable|array',
            'assign_rooms.*' => 'exists:room_infos,id',
        ]);
        //return $request->all();

        $reservation = $this->bookingService->updateBooking($request);
        Log::info($reservation);

        DB::commit();
        flash()->option('position', 'bottom-right')->success('Booking updated successfully!.');
        return redirect()->route('booking.index');
    }

    public function details($booking_id)
    {
        $reservation = Reservation::with(['customer', 'address', 'payment', 'assign_rooms.room_info.room_class'])
            ->where('booking_id', $booking_id)->first();
        // return $reservation;
        return view('backend.pages.booking.details', ['reservation' => $reservation]);
    }

    public function generatePdf($booking_id)
    {
        $reservation = Reservation::with(['customer', 'payment', 'assign_rooms.room_info.room_class', 'address'])
            ->where('booking_id', $booking_id)->first();

        $pdf = Pdf::loadView('backend.pages.booking.invoice-pdf', compact('reservation'));

        return $pdf->download('invoice_' . $reservation->booking_id . '.pdf');
    }
    public function completeBooking($booking_id)
    {
        DB::beginTransaction();
        try {
            $reservation = Reservation::with('assign_rooms')->where('booking_id', $booking_id)->first();

            if (!$reservation) {
                return redirect()->route('booking.index')->with('error', 'Booking not found.');
            }

            // Check if payment is completed
            if ($reservation->payment->status !== 'Completed') {
                return redirect()->route('booking.index')->with('error', 'Payment is not completed.');
            }

            // Mark the reservation as completed
            $reservation->status = 'Completed';
            $reservation->save();

            // Update the room status to AVAILABLE
            if ($reservation->assign_rooms) {
                $assignedRooms = AssignRoom::where('reservation_id', $reservation->id)
                    ->pluck('room_info_id')
                    ->toArray();

                RoomInfo::whereIn('id', $assignedRooms)
                    ->update(['status' => RoomInfoStatusEnum::AVAILABLE]);  
            }

            DB::commit();

            flash()->option('position', 'bottom-right')->success('Booking completed successfully!.');
            return redirect()->route('booking.index');  // Redirect to booking index page
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('booking.index')->with('error', 'An error occurred while completing the booking: ' . $e->getMessage());
        }
    }
}
