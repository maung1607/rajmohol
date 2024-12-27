<?php

namespace App\Http\Controllers;

use App\Models\RoomClass;
use Illuminate\Http\Request;
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

        $roomClasses = RoomClass::latest();

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
            ->addColumn('actions', function ($roomClass) {
                $btns = '
                    <div class="btn-group">
                        <button class="btn btn-primary edit_btn" data-id="' . $roomClass->id . '">Edit</button>
                        <button class="btn btn-danger delete_btn" data-id="' . $roomClass->id . '">Delete</button>
                    </div>';
                return $btns;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $roomClass = RoomClass::create($request->all());
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
