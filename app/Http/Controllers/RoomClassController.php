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
                    return '<img src="' . asset($roomClass->image->value) . '" alt="image" class="tb-image w-[100px] h-[100px]" height="100px" width="100px"   />';
                } else {
                    return ''; // Handle case where no image is found
                }
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
    public function edit($id)
    {
        $roomClass = RoomClass::with('image')->findOrFail($id);
        return view('backend.pages.room_class.edit',['roomClass'=> $roomClass]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required|string|max:1000',
            'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'The name field is required.',
            'price.numeric' => 'The price must be a valid number.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        ]);

        $roomClass = RoomClass::with('image')->where('id', $request->id)->first();
        $roomClass->name = $request->input('name');
        $roomClass->price = $request->input('price');
        $roomClass->discount = $request->input('discount');
        $roomClass->description = $request->input('description');
        $roomClass->save();

        if($request->hasFile('image'))
        {
            if(file_exists($roomClass?->image?->value))
            {
                unlink($roomClass?->image->value);
                $roomClass?->image->delete();
            }
            uploadImage($request->file('image'), 'uploads/images/room_class', RoomClass::class, $roomClass->id);
        }

        return redirect()->route('room.class.index')->with('success', 'Room class updated successfully!');
    }
    public function destroy($id)
    {
        RoomClass::destroy($id);
        return redirect()->route('room.class.index')->with('success', 'Room class deleted successfully!');
    }
}
