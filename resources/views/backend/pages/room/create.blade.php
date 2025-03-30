@extends('layouts.backend.app')
@section('title')
Add New Room | Create
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center border p-3">
                <h5>Add New Room</h5>
                <a href="{{ route('room.index') }}" class="btn btn-info">Back</a>
            </div>


            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    <div class="my-2">
                        <!-- Success Message -->
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                {{ session('success') }}
                            </div>
                            @endif
                            {{-- @if($errors->any())
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif --}}

                            <!-- Error Message -->
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>×</span>
                                    </button>
                                    {{ session('error') }}
                                </div>
                                @endif
                            </div>
                            <form action="{{ route('room.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="room_number">Room Number</label>
                                            <input id="room_number" type="text" name="room_number" class="form-control" placeholder="Enter room number" value="{{ old('room_number') }}">
                                            @if ($errors->has('room_number'))
                                            <small class="text-danger">{{ $errors->first('room_number') }}</small>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="room_class_id">Room Class</label>
                                            <select name="room_class_id" id="room_class_id" class="form-control">
                                                <option>Select Room Class</option>
                                                @foreach ($roomClasses as $roomClass)
                                                <option value="{{ $roomClass->id }}" {{ old('room_class_id') == $roomClass->id ? 'selected' : '' }}>
                                                    {{ $roomClass->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('room_class_id'))
                                            <small class="text-danger">{{ $errors->first('room_class_id') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Submit Button -->
                                        <div class="form-group mt-3">
                                            <button class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
