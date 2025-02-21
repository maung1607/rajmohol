<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
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
        return view("frontend.pages.rooms");
    }
}
