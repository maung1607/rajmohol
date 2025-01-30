<?php

namespace App\Http\Controllers\Backend;

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
        $reservations = Reservation::with(['customer','payment'])->latest();


        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $reservations
            ->where('booking_id','like', "%{$search}%")
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
                $col= "<div> <strong>Name:</strong> " . $record?->customer?->name . "</div>";
                $col .= "<div> <strong>Email: </strong>" . $record?->customer?->email . "</div>";
                $col .= "<div> <strong>Phone: </strong>".$record?->customer?->phone_number."</div>";
                return $col;
            })
            ->addColumn('check_in', function ($record) {
                return $record->check_in_date;
            })
            ->addColumn('check_out', function ($record) {
                return $record->check_out;
            })
            ->addColumn('check_in', function ($record) {
                return $record->check_out_date;
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
                $statusColors = [
                    'Pending' => 'warning',
                    'Confirmed' => 'primary',
                    'Cancelled' => 'danger',
                    'Completed' => 'success',
                ];
            
                $badgeColor = $statusColors[$record->status] ?? 'secondary';
            
                return '<span class="text-white badge bg-' . $badgeColor . '">' . ucfirst($record->status) . '</span>';
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
            ->rawColumns(['customer_info','payment_info','status', 'actions'])
            ->make(true);
    }
    public function create()
    {
        $rooms = RoomInfo::where('status',RoomInfoStatusEnum::AVAILABLE)->get();
        return view('backend.pages.booking.create',['rooms'=>$rooms]);
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
        $reservation = Reservation::with(['customer','address','payment','assign_rooms'])
                                    ->where('booking_id',$booking_id)->first();
        $rooms = RoomInfo::get();
        return view('backend.pages.booking.edit',['rooms'=>$rooms,'reservation'=>$reservation]);
    }

    public function update(Request $request){
        
    }
}
