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
        $reservations = Reservation::with('customer')->latest();


        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $reservations->whereHas('customer', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return DataTables::of($reservations)
            ->addColumn('booking_id', function ($record) {
                return $record->id;
            })
            ->addColumn('customer_info', function ($record) {
                $col = "<div> Name: " . $record?->customer?->name . "</div>";
                $col += "<div> Email: " . $record?->customer?->email . "</div>";
                // $col += "<div> Phone: ".$record?->customer?->phone."</div>";
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
            ->addColumn('special_request', function ($record) {
                return $record->special_request;
            })
            ->addColumn('status', function ($record) {
                return $record->status;
            })


            ->addColumn('actions', function ($roomClass) {
                $btns = '
                <div class="btn-group">
                    <a href="' . route('room.class.edit', ['id' => $roomClass->id]) . '"
                       class="btn btn-primary edit_btn"
                       data-id="' . htmlspecialchars($roomClass->id, ENT_QUOTES, 'UTF-8') . '">
                       Edit
                    </a>
                    <a href="' . route('room.class.delete', ['id' => $roomClass->id]) . '"
                       class="btn btn-danger delete_btn"
                       data-id="' . htmlspecialchars($roomClass->id, ENT_QUOTES, 'UTF-8') . '"
                       onclick="return confirm(\'Are you sure you want to delete this item?\')">
                       Delete
                    </a>
                </div>';
                return $btns;
            })
            ->rawColumns(['customer_info', 'actions'])
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
}
