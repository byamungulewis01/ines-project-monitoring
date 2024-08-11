@extends('layouts.app')
@section('body')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sponsored</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">PM System</a></li>
                        <li class="breadcrumb-item active">Sponsored</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Sponsored Projects</h4>

                </div><!-- end card header -->

                <div class="card-body">
                    <table class="table align-middle" id="datalist" style="width: 100%;">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sponsor Name</th>
                                <th scope="col">Sponsor Email</th>
                                <th scope="col">Project Name</th>
                                <th scope="col" style="width: 20%">Project Owner</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date of Sold</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div><!-- end card -->
        </div><!-- end col -->


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
            $('#datalist').DataTable({
                ajax: {
                    url: "{{ route('projects.sponsoredApi') }}",
                    dataSrc: 'data' // Specify the key in the response object containing the data array
                },
                scrollX: true,
                columns: [{
                        data: null, // Use null data source
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'sponsor_name'
                    },
                    {
                        data: 'sponsor_email'
                    },
                    {
                        data: 'project_name'
                    },

                    {
                        data: null,
                        render: function(data, type, row, meta) {

                            return `<img src="/${row.profile_image}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">${row.student_name}</a>`;
                        }
                    },
                    {
                        data: 'project_price'
                    },
                    {
                        data: 'created_at'
                    },

                ]
            });
        });
    </script>
@endsection
