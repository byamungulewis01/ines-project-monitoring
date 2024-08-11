@extends('layouts.student.app')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">

            <div class="card h-100">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                            @php
                                $image_url = $student->profile_image
                                    ? 'storage/' . $student->profile_image
                                    : 'assets/images/users/user-dummy-img.jpg';
                            @endphp
                            <img id="user-profile-image" src="{{ asset($image_url) }}"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <input id="profile-img-file-input" name="image_file" type="file"
                                    class="profile-img-file-input" accept="image/*">

                            </div>
                        </div>
                        <h5 class="fs-16 mb-1">{{ $student->name }}</h5>
                        <p class="text-muted mb-0">{{ $student->email }}</p>
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-success text-white">
                                <i class="ri-whatsapp-fill"></i>
                            </span>
                        </div>
                        <input type="text" readonly name="whatsapp_number" class="form-control" id="whatsapp_number"
                            placeholder="Whatsapp" value="{{ old('whatsapp_number', $student->whatsapp_number) }}">
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                <i class="ri-phone-fill"></i>
                            </span>
                        </div>
                        <input type="text" readonly class="form-control" name="call_number" id="call_number"
                            placeholder="call number" value="{{ old('call_number', $student->call_number) }}">
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Info</h5>

                        </div>

                    </div>
                    <div class="table-responsive mb-3">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="ps-0" style="width: 25%" scope="row">Registration Number :</th>
                                    <td class="text-muted">{{ $student->reg_number }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Department :</th>
                                    <td class="text-muted">{{ $student->department->name }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Option :</th>
                                    <td class="text-muted">{{ $student->option }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Academic Year :</th>
                                    <td class="text-muted">{{ $student->academic_year }}</td>
                                </tr>

                                <tr>
                                    <th class="ps-0" scope="row">Complation Date</th>
                                    <td class="text-muted">
                                        @if ($student->completion_date)
                                            {{ \Carbon\Carbon::parse($student->completion_date)->format('d M, Y') }}
                                        @else
                                            <i>Not yet completed</i>
                                        @endif
                                    </td>
                                </tr>
                                @if ($student->biography)
                                    <tr>
                                        <th class="ps-0" scope="row">Biography </th>
                                        <td class="text-muted">{{ $student->biography }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>

        <!--end col-->
    </div>
@endsection
@section('js')
@endsection
