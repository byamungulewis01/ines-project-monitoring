@extends('layouts.app')
@section('body')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">ORDERS</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">PM System</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-12">
            <div class="card" id="customerList">
                <div class="card-header border-bottom-dashed">

                    <div class="row g-4 align-items-center">
                        <div class="col-sm">
                            <div>
                                <h5 class="card-title mb-0">Order History</h5>

                            </div>
                        </div>


                        <div class="col-sm-auto">
                            <div class="d-flex flex-wrap align-items-start gap-2">

                                <a href="{{ route('orders.create') }}" class="btn btn-primary add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i> Create
                                    Order</a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table align-middle" id="ordersTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width: 20px;">#</th>
                                <th class="sort" data-sort="orderId">ORDER ID</th>
                                <th class="sort" data-sort="customer">CUSTOMER</th>
                                <th class="sort" data-sort="customer_phone">PHONE NUMBER</th>
                                <th class="sort" data-sort="order">ORDER DATE</th>
                                <th class="sort" data-sort="amount">AMOUNT</th>
                                <th class="sort" data-sort="status">STATUS</th>
                                <th class="sort" data-sort="action">ACTION</th>
                            </tr>
                        </thead>

                    </table>
                </div>
                <!-- Modal -->
                <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" id="deleteRecord-close" data-bs-dismiss="modal"
                                    aria-label="Close" id="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="delete-form" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="mt-2 text-center">
                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                            colors="primary:#f7b84b,secondary:#f06548"
                                            style="width:100px;height:100px"></lord-icon>
                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                            <h4>Are you sure ?</h4>
                                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                        <button type="button" class="btn w-sm btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn w-sm btn-danger" id="delete-record">Yes, Delete
                                            It!</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal -->
            </div>
        </div>

    </div>
    <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('css')
    @include('layouts.datatable.css-without-bottons')

    {{-- @include('layouts.datatable.css-with-bottons') --}}
@endsection
@section('js')
    <!--datatable js-->
    @include('layouts.datatable.js-without-bottons')
    {{-- @include('layouts.datatable.js-with-bottons') --}}

    <script>
        $(document).ready(function() {
            var status = {
                pending: {
                    title: "Pending",
                    class: "badge bg-warning-subtle text-warning text-uppercase"
                },
                completed: {
                    title: "Completed",
                    class: "badge bg-success-subtle text-success text-uppercase"
                },
            };
            $('#ordersTable').DataTable({
                ajax: {
                    url: "{{ route('orders.all') }}",
                    dataSrc: 'data' // Specify the key in the response object containing the data array
                },
                columns: [{
                        data: null, // Use null data source
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    }, {
                        data: null, // Use null data source
                        render: function(data, type, row, meta) {

                            return '<a href=" ' + row.show_route + '" class="fw-medium link-primary">#' + row
                                .order + '</a>';
                        }
                    },
                    {
                        data: 'customer_name'
                    },
                    {
                        data: 'customer_phone'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return `<span class="${status[row.status].class}">${status[row.status].title}</span>`;
                        }
                    },
                    {
                        data: null, // Use null data source
                        render: function(data, type, row, meta) {

                            return `<ul class="list-inline hstack gap-2 mb-0">
                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="View" data-bs-original-title="View">
                                                <a href="${row.show_route}" class="text-primary d-inline-block">
                                                    <i class="ri-eye-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                <a href="${row.edit_route}"
                                                    class="text-primary d-inline-block edit-btn">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                data-bs-placement="top" title="Remove">
                                                <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" data-id="${row.id}"
                                                    href="#deleteRecordModal">
                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                </a>
                                            </li>
                                        </ul>`;
                        }
                    },

                ]
            });
        });



        // check if data loaded fully
        $(document).ready(function() {
            $(document).on('click', '.remove-item-btn', function() {
                var route = "{{ route('orders.destroy', ['order' => ':id']) }}";
                route = route.replace(':id', $(this).data('id'));
                $('.delete-form').attr('action', route);
            });
        });
    </script>

    @if ($errors->any())
        @if (old('id'))
            <script>
                document.getElementById("add-btn").innerHTML = "Save Changes";
                document.getElementById("exampleModalLabel").innerHTML = "Edit Customer";


                var myModal = new bootstrap.Modal(document.getElementById('showModal'), {
                    keyboard: false
                })
                myModal.show()

                var id = "{{ old('id') }}";
                var route = "{{ route('customers.update', ['customer' => ':id']) }}";
                route = route.replace(':id', id);

                $('.tablelist-form').attr('action', route).append('<input type="hidden" name="_method" value="PUT">');
            </script>
        @else
            <script>
                document.getElementById("exampleModalLabel").innerHTML = "Add Customer";

                var myModal = new bootstrap.Modal(document.getElementById('showModal'), {
                    keyboard: false
                })
                myModal.show()
            </script>
        @endif
    @endif
@endsection
