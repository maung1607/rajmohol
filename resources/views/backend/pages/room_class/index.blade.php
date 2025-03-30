@extends('layouts.backend.app')
@section('title')
    Room Class | List
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card ">
                <div class="d-flex justify-content-between align-items-center border p-3">
                    <h5>Room Classes</h5>
                    <a  href="{{ route('room.class.create') }}" class="btn btn-info">Add Room Class</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Room Class Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Beds</th>
                                        <th>Bath</th>
                                        <th>Image</th>
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
                    url: "{{ route('room.class.data.list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        data: 'name'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'discount'
                    },
                    {
                        data: 'beds'
                    },
                    {
                        data: 'baths'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'actions'
                    },
                ]
            });
        });
    </script>
@endpush
