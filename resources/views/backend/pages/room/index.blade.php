@extends('layouts.backend.app')
@section('title')
Room | List
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card ">
            <div class="d-flex justify-content-between align-items-center border p-3">
                <h5>Room List Info</h5>
                <a href="{{ route('room.create') }}" class="btn btn-info">Add New Room</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Customer Info</th>
                                    <th>Check In</th>
                                    <th>Check Oute</th>
                                    <th>Room Type</th>
                                    <th>Day Range</th>
                                    <th>Creator</th>
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
            "processing": true
            , "serverSide": true
            , 'stateSave': true
            , "lengthChange": true
            , "searching": true
            , "responsive": true
            , "buttons": []
            , "ajax": {
                url: ""
                , dataType: "json"
                , type: "POST"
                , data: function(d) {
                    d._token = "{{ csrf_token() }}"
                }
            }
            , "columns": [{
                    data: 'booking_id'
                }
                , {
                    data: 'customer_info'
                }
                , {
                    data: 'check_in'
                }
                , {
                    data: 'check_out'
                }
                , {
                    data: 'room_type'
                }
                , {
                    data: 'creator'
                }
                , {
                    data: 'status'
                }
                , {
                    data: 'actions'
                }
            , ]
        });
    });

</script>
@endpush
