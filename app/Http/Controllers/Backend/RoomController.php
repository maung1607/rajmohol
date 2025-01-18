<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomClass;
use App\Models\RoomInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Flasher\Prime\FlasherInterface;
class RoomController extends Controller
{
    public function index()
    {
        return view('backend.pages.room.index');
    }
    public function getData(Request $request)
    {

        $roomInfos = RoomInfo::with('room_class')->latest();
       
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $roomInfos->where('name', 'like', "%{$search}%");
        }

        return DataTables::of($roomInfos)
            ->addColumn('room_number', function ($record) {
                return $record->room_number;
            })
            ->addColumn('room_class', function ($record) {
                return $record?->room_class?->name;
            })
            ->addColumn('description', function ($record) {
                return Str::limit($record->description, 20);
            })
            ->addColumn('status', function ($record) {
                return $record->status;
            })
            ->addColumn('actions', function ($record) {
                $btns = '
                <div class="btn-group">
                    <a href="' . route('room.edit', ['id' => $record->id]) . '"
                       class="btn btn-primary edit_btn"
                       data-id="' . htmlspecialchars($record->id, ENT_QUOTES, 'UTF-8') . '">
                       Edit
                    </a>
                    <a href="' . route('room.delete', ['id' => $record->id]) . '"
                       class="btn btn-danger delete_btn"
                       data-id="' . htmlspecialchars($record->id, ENT_QUOTES, 'UTF-8') . '"
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
        $roomClasses = RoomClass::get();
        return view('backend.pages.room.create', compact('roomClasses'));
    }
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'room_number' => 'required|unique:room_infos',
            'room_class_id' => 'required',
            'room_type' => 'required',
            'description' => 'string|max:1000'
        ]);
        
        RoomInfo::create($validatedData);
       
        flash()->option('position', 'bottom-right')->success('Room created successfully!.');

        return redirect()->back();
    }
    public function edit($id)
    {
        $roomClasses = RoomClass::get();
        $roomInfo = RoomInfo::with('room_class')->findOrFail($id);
        return view('backend.pages.room.edit',['roomInfo'=> $roomInfo, 
    'roomClasses'=>$roomClasses]);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'room_number' => 'required|string|max:255|unique:room_infos,room_number,' . $request->input('id'),
            'room_class_id' => 'required|numeric',
            'room_type' => 'required|string',
            'description' => 'required|string|max:1000',
            'id' => 'required|exists:room_infos,id', 
        ],
        [
            'room_number.unique' => 'The room number is already in use. Please choose a different one.',
        ]);
        
        RoomInfo::where('id', $validatedData['id'])->update($validatedData);
        
        flash()->option('position', 'bottom-right')->success('Room updated successfully!.');

        return redirect()->route('room.index');
    }
    public function destroy($id)
    {
        RoomInfo::destroy($id);
        flash()->option('position', 'bottom-right')->success('Room deleted successfully!.');
        return redirect()->route('room.index');
    }
}
