<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RoomClass;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    public function index()
    {
        return view("frontend.pages.index");
    }
    public function aboutUs()
    {
        return view("frontend.pages.about");
    }
    public function services()
    {
        return view("frontend.pages.services");
    }
    public function booking()
    {
        return view("frontend.pages.booking");
    }
    public function contactUs()
    {
        return view("frontend.pages.contact");
    }
    public function rooms()
    {
        $roomClasses = RoomClass::with('image')->get();
        //return $roomClasses;
        return view("frontend.pages.rooms",['roomClasses'=>$roomClasses]);
    }
    public function bookingRequest(Request $request)
    {
        DB::beginTransaction();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'specail_request' => 'nullable|string|max:500',
        ]);
        
        $reservation = $this->bookingService->clientBooking($request);
        DB::commit();
        return redirect()->back()->with('success', 'Your booking request has been submitted successfully!');

        
    }
}
