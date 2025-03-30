@extends('layouts.backend.app')
@section('title')
    Room Class | Create
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center border p-3">
                    <h5>Edit Room Class</h5>
                    <a href="{{ route('room.class.index') }}" class="btn btn-info">Back</a>
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
                        <form action="{{ route('room.class.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{ $roomClass->id }} ">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" type="text" name="name" class="form-control"
                                            placeholder="Enter room class type name"
                                            value="{{ $roomClass->name ?? old('name') }}">
                                        @if ($errors->has('name'))
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price(Tk)</label>
                                        <input id="price" type="text" name="price" placeholder="Enter amount"
                                            class="form-control" value="{{ $roomClass->price ?? old('price') }}">
                                        @if ($errors->has('price'))
                                            <small class="text-danger">{{ $errors->first('price') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-group">        
                                        <label for="number_of_beds">Number Of Beds</label>
                                        <input id="number_of_beds" type="text" name="number_of_beds" placeholder="Enter number of beds"
                                            class="form-control" value="{{ $roomClass->number_of_beds ?? old('number_of_beds') }}">
                                        @if ($errors->has('number_of_baths'))
                                            <small class="text-danger">{{ $errors->first('number_of_baths') }}</small>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="discount">Discount(%)</label>
                                        <input id="discount" type="text" name="discount" placeholder="Enter discount"
                                            class="form-control" value="{{ $roomClass->discount ?? old('discount') }}">
                                        @if ($errors->has('discount'))
                                            <small class="text-danger">{{ $errors->first('discount') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" placeholder="Enter description">{{ $roomClass->description ?? old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file">Image</label>
                                        <div class="">
                                            <input id="file" type="file" name="image" class="form-control mr-2">
                                            <div class="mt-1">
                                                @if ($roomClass?->image?->value)
                                                <img src="{{ asset($roomClass?->image?->value) }}" class=""
                                                    alt="{{ $roomClass?->image?->value }}" width="100" height="100">
                                            @endif
                                            </div>
    
                                            @if ($errors->has('image'))
                                                <small class="text-danger">{{ $errors->first('image') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">        
                                        <label for="number_of_baths">Number Of Baths</label>
                                        <input id="number_of_baths" type="text" name="number_of_baths" placeholder="Enter number of baths"
                                            class="form-control" value="{{ $roomClass->number_of_baths ?? old('number_of_baths') }}">
                                        @if ($errors->has('number_of_baths'))
                                            <small class="text-danger">{{ $errors->first('number_of_baths') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            

                            <!-- Submit Button -->
                            <div class="form-group mt-3">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
