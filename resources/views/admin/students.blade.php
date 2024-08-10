@extends('layouts.app')
@section('body')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Students</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">PM System</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-12">
            <div class="card" id="studentList">
                <div class="card-header border-bottom-dashed">

                    <div class="row g-4 align-items-center">
                        <div class="col-sm">
                            <div>
                                <h5 class="card-title mb-0">Student List</h5>

                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex flex-wrap align-items-start gap-2">

                                <button type="button" class="btn btn-primary add-btn"
                                    data-action="{{ route('students.store') }}" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add
                                    student</button>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table align-middle" id="studentTable" style="width: 100%">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="sort" data-sort="student_name">Student</th>
                                <th class="sort" data-sort="email">Reg Number</th>
                                <th class="sort" data-sort="phone">Phone</th>
                                <th class="sort" data-sort="department">Department</th>
                                <th class="sort" data-sort="option">Option</th>
                                <th class="sort" data-sort="date">Joining Date</th>
                                <th class="sort" data-sort="action">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>


                <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form class="tablelist-form" method="POST" autocomplete="off">
                                @csrf

                                <div class="modal-body">

                                    <input type="hidden" value="{{ old('id') }}" name="id" id="id" />

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Student Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" id="name"
                                            class="form-control" placeholder="Enter name" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" id="email"
                                            class="form-control" placeholder="Enter email" />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" id="phone"
                                            class="form-control" placeholder="Enter phone no." />
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">

                                        <div class="col-md-6">
                                            <label for="department_id" class="form-label">Department</label>
                                            <select class="form-select" name="department_id" id="department_id">
                                                <option value="" selected disabled>Select</option>
                                                @foreach ($departments as $department)
                                                    <option
                                                        {{ old('department_id') == $department->department_id ? 'selected' : '' }}
                                                        value="{{ $department->id }}">
                                                        {{ $department->name }}</option>
                                                @endforeach

                                            </select>
                                            @error('department_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">

                                            <label for="option" class="form-label">Option</label>
                                            <input type="text" name="option" value="{{ old('option') }}"
                                                id="option" class="form-control" placeholder="Enter Option." />
                                            @error('option')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="academic_year" class="form-label">Academic Year</label>
                                        <input type="text" name="academic_year" value="{{ old('academic_year') }}"
                                            id="academic_year" class="form-control" placeholder="2020 - 2021" />
                                        @error('academic_year')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3" id="add-completion" style="display: none">
                                        <label for="completion_date" class="form-label">Completion Date</label>
                                        <input type="date" name="completion_date" value="{{ old('completion_date') }}"
                                            id="completion_date" class="form-control" placeholder="Date of Completion" />
                                        @error('completion_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="add-btn">Add
                                            Student</button>
                                        <!-- <button type="button" class="btn btn-primary" id="edit-btn">Update</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                active: {
                    title: "Active",
                    class: "badge bg-success-subtle text-success text-uppercase"
                },
                block: {
                    title: "Block",
                    class: "badge bg-danger-subtle text-danger text-uppercase"
                },
            };
            $('#studentTable').DataTable({
                ajax: {
                    url: "{{ route('students.all') }}",
                    dataSrc: 'data' // Specify the key in the response object containing the data array
                },
                scrollX: true,
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {

                            return `<div class="d-flex">
                                    <img src="${row.profile_image}" alt="" class="avatar-xs rounded-3 me-2">
                                    <div>
                                        <h5 class="fs-13 mb-0">${row.name}</h5>
                                        <p class="fs-12 mb-0 text-muted">${row.email}</p>
                                    </div>
                                </div>`;
                        }
                    },
                    {
                        data: 'reg_number'
                    },
                    {
                        data: 'phone'
                    },

                    {
                        data: 'department'
                    },
                    {
                        data: 'option'
                    },

                    {
                        data: 'created_at'
                    },
                    {
                        data: null, // Use null data source
                        render: function(data, type, row, meta) {
                            var route = "{{ route('students.update', ['student' => ':id']) }}";
                            route = route.replace(':id', row.id);
                            return `<ul class="list-inline hstack gap-2 mb-0">
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                <a href="#showModal" data-bs-toggle="modal" data-id="${row.id }"
                                                    data-name="${row.name }" data-email="${row.email }"
                                                    data-phone="${row.phone }" data-department_id="${row.department_id }"
                                                    data-option="${row.option }" data-academic_year="${row.academic_year }" data-completion_date="${row.completion_date}" data-action="${route }"
                                                    class="text-primary d-inline-block edit-btn">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                data-bs-placement="top" title="Remove">
                                                <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" data-id="${row.id }"
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
            $(document).on('click', '#create-btn', function() {
                document.getElementById("exampleModalLabel").innerHTML = "Add Student";
                document.getElementById("add-btn").innerHTML = "Add Student";
                $("#add-completion").hide();
                var form_action = $(this).data('action');
                $('.tablelist-form').attr('action', form_action);
            });

            // update updateitem modl with clicked button data
            $(document).on('click', '.edit-btn', function() {
                $("#add-completion").show();
                document.getElementById("exampleModalLabel").innerHTML = "Edit student";
                document.getElementById("add-btn").innerHTML = "Save Changes";
                $('.tablelist-form').attr('action', $(this).data('action')).append(
                    '<input type="hidden" name="_method" value="PUT">');
                $('#id').val($(this).data('id'));
                $('#name').val($(this).data('name'));
                $('#email').val($(this).data('email'));
                $('#phone').val($(this).data('phone'));
                $('#department_id').val($(this).data('department_id'));
                $('#academic_year').val($(this).data('academic_year'));
                $('#option').val($(this).data('option'));
                $('#completion_date').val($(this).data('completion_date'));

            });

            $(document).on('click', '.remove-item-btn', function() {
                var route = "{{ route('students.destroy', ['student' => ':id']) }}";
                route = route.replace(':id', $(this).data('id'));
                $('.delete-form').attr('action', route);
            });
        });
    </script>

    @if ($errors->any())
        @if (old('id'))
            <script>
                document.getElementById("add-btn").innerHTML = "Save Changes";
                document.getElementById("exampleModalLabel").innerHTML = "Edit student";


                var myModal = new bootstrap.Modal(document.getElementById('showModal'), {
                    keyboard: false
                })
                myModal.show()

                var id = "{{ old('id') }}";
                var route = "{{ route('students.update', ['student' => ':id']) }}";
                route = route.replace(':id', id);

                $('.tablelist-form').attr('action', route).append('<input type="hidden" name="_method" value="PUT">');
            </script>
        @else
            <script>
                document.getElementById("exampleModalLabel").innerHTML = "Add Student";

                var myModal = new bootstrap.Modal(document.getElementById('showModal'), {
                    keyboard: false
                })
                myModal.show()
            </script>
        @endif
    @endif
@endsection
