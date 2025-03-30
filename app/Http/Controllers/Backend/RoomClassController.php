<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
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
            ->addColumn('beds', function ($roomClass) {
                return $roomClass->number_of_beds;
            })
            ->addColumn('baths', function ($roomClass) {
                return $roomClass->number_of_baths;
            })
            ->addColumn('image', function ($roomClass) {
                if ($roomClass->image) {
                    return '<img src="' . asset($roomClass->image->value) . '" alt="image" class="tb-image w-[100px] h-[100px]" height="100px" width="100px"   />';
                } else {
                    return ''; 
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
            'number_of_beds' => 'required|numeric',
            'number_of_baths' => 'required|numeric'
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
            'number_of_beds' => $request->input('number_of_beds'),
            'number_of_baths' => $request->input('number_of_baths'),
        ]);
        $imagePath = uploadImage($request->file('image'), 'uploads/images/room_class', RoomClass::class, $roomClass->id);
        if (!$imagePath) {
            return back()->with('error', 'Failed to upload image.');
        }
        DB::commit();
        flash()->option('position', 'bottom-right')->success('Room class created successfully!.');
        return redirect()->back();
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
            'number_of_beds' => 'required|numeric',
            'number_of_baths' => 'required|numeric',
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
        $roomClass->number_of_beds = $request->input('number_of_beds');
        $roomClass->number_of_baths = $request->input('number_of_baths');
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
        flash()->option('position', 'bottom-right')->success('Room class updated successfully!.');

        return redirect()->route('room.class.index');
    }
    public function destroy($id)
    {
        RoomClass::destroy($id);
        flash()->option('position', 'bottom-right')->success('Room class deleted successfully!.');
        return redirect()->route('room.class.index');
    }
}
