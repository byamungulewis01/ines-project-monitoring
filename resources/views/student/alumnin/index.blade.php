@extends('layouts.student.app')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">List of Alumni</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Alumni</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    <div class="team-list list-view-filter">
        @foreach ($students as $student)
            <div class="card team-box">
                <div class="card-body px-4">
                    <div class="row align-items-center team-row">
                        <div class="col-lg-4 col">
                            <div class="team-profile-img">
                                <div class="avatar-lg img-thumbnail rounded-circle">
                                    <img src='{{ asset('storage/' . $student->profile_image) }}' alt=""
                                        class="img-fluid d-block rounded-circle">
                                </div>
                                <div class="team-content">
                                    <a href="#" class="d-block">
                                        <h5 class="fs-16 mb-1">{{ $student->name }}</h5>
                                    </a>
                                    <p class="text-muted mb-0">{{ $student->department->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col">
                            <div class="row text-muted text-center">
                                <div class="col-6 border-end border-end-dashed">
                                    <p class="text-muted mb-0">Projects</p>
                                    <h5 class="mb-1">{{ $student->project->title ?? 'Not uploaded' }}</h5>
                                </div>
                                <div class="col-6">
                                    <p class="text-muted mb-0">Complete Year</p>
                                    <h5 class="mb-1">{{ \Carbon\Carbon::parse($student->completion_date)->format('Y') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col">
                            <div class="text-end">
                                <a href="{{ route('student.alumnins.show', $student->id) }}"
                                    class="btn btn-light view-btn">View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
