<?php

namespace App\Http\Controllers;

use App\Models\RoomClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class RoomClassController extends Controller
{
    public function index()
    {

        return view("backend.pages.room_class.index");
    }
    public function getData(Request $request)
    {

        $roomClasses = RoomClass::with('image')->latest();
        //return $roomClasses;

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $roomClasses->where('name', 'like', "%{$search}%");
        }

        return DataTables::of($roomClasses)
            ->addColumn('name', function ($roomClass) {
                return $roomClass->name;
            })
            ->addColumn('description', function ($roomClass) {
                return Str::limit($roomClass->description, 20);
            })
            ->addColumn('price', function ($roomClass) {
                return number_format($roomClass->price, 2) . 'TK.';
            })
            ->addColumn('discount', function ($roomClass) {
                return $roomClass->discount . '%';
            })
            ->addColumn('image', function ($roomClass) {
                // Check if an image is present
                if ($roomClass->image) {
                    return '<img src="' . $roomClass->image->value . '" alt="image" class="tb-image"   />';
                } else {
                    return ''; // Handle case where no image is found
                }
            })
            ->addColumn('actions', function ($roomClass) {
                $btns = '
            <div class="btn-group">
                <button class="btn btn-primary edit_btn" data-id="' . $roomClass->id . '">Edit</button>
                <button class="btn btn-danger delete_btn" data-id="' . $roomClass->id . '">Delete</button>
            </div>';
                return $btns;
            })
            ->rawColumns(['image','actions'])
            ->make(true);
    }
    public function create()
    {
        return view('backend.pages.room_class.create');
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required|string|max:1000',
            'image' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'The name field is required.',
            'price.numeric' => 'The price must be a valid number.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        ]);



        $roomClass = RoomClass::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
        ]);
        $imagePath = uploadImage($request->file('image'), 'uploads/images/room_class', RoomClass::class, $roomClass->id);
        if (!$imagePath) {
            return back()->with('error', 'Failed to upload image.');
        }
        DB::commit();

        return redirect()->back()->with('success', 'Room class created successfully!');
    }
    public function show($id)
    {
        $roomClass = RoomClass::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        $roomClass = RoomClass::findOrFail($id);
        $roomClass->update($request->all());
    }
    public function destroy($id)
    {
        RoomClass::destroy($id);
    }
}
