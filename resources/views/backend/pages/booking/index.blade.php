@extends('layouts.backend.app')
@section('title')
    Booking | List
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card ">
                <div class="d-flex justify-content-between align-items-center border p-3">
                    <h5>Booking List Info</h5>
                    <a  href="{{ route('room.create') }}" class="btn btn-info">Create Booking</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Room Number</th>
                                        <th>Room Class</th>
                                        <th>Room Type</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "processing": true,
                "serverSide": true,
                'stateSave': true,
                "lengthChange": true,
                "searching": true,
                "responsive": true,
                "buttons": [],
                "ajax": {
                    url: "{{ route('room.data.list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        data: 'room_number'
                    },
                    {
                        data: 'room_class'
                    },
                    {
                        data: 'room_type'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'actions'
                    },
                ]
            });
        });
    </script>
@endpush
