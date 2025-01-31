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
                <a href="{{ route('booking.create') }}" class="btn btn-info">Create Booking</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Customer Info</th>
                                    <th>Date</th>
                                    <th>Adults</th>
                                    <th>Children</th>
                                    <th>Day Range</th>
                                    <th>Payment Info</th>
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
                url: "{{ route('booking.get.data') }}"
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
                    data: 'date'
                }
                , {
                    data: 'adults'
                }
                , {
                    data: 'children'
                }
                , {
                    data: 'day_range'
                }
                , {
                    data: 'payment_info'
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
