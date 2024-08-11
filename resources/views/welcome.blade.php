@extends('layouts.home')
@section('body')
    <!-- start hero section -->
    {{-- <section class="section pb-0 mb-4" id="hero">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-10">
                    <div class="text-center mt-lg-5 pt-5">
                        <h1 class="display-6 fw-semibold mb-3 lh-base">Connecting Sponsors with Future Innovators
                            <span class="text-success">Innovators </span>
                        </h1>
                        <p class="lead text-muted lh-base">Our platform bridges the gap between ambitious students, talented
                            alumni, and visionary sponsors.</p>

                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
        <div class="position-absolute start-0 end-0 bottom-0 hero-shape-svg">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 1440 120">
                <g mask="url(&quot;#SvgjsMask1003&quot;)" fill="none">
                    <path d="M 0,118 C 288,98.6 1152,40.4 1440,21L1440 140L0 140z">
                    </path>
                </g>
            </svg>
        </div>
        <!-- end shape -->
    </section> --}}
    <!-- end hero section -->

      <!-- start hero section -->
      <section class="section job-hero-section bg-light pb-0" id="hero">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div>
                        <h1 class="fw-semibold text-capitalize mb-3 lh-base">Connecting Sponsors with Future Innovators
                            <span class="text-success">Innovators</h1>
                        <p class="lead text-muted lh-base mb-4">Our platform bridges the gap between ambitious students, talented
                            alumni, and visionary sponsors.</p>
                            <a href="#project" class="btn btn-primary">Get Started <i class="ri-arrow-right-line align-middle ms-1"></i></a>


                        <ul class="treding-keywords list-inline mb-0 mt-3 fs-13">
                            <li class="list-inline-item text-danger fw-semibold"><i class="mdi mdi-tag-multiple-outline align-middle"></i> You can also start as:</li>
                            <li class="list-inline-item"><a target="_blank" href="{{ route('student.login') }}">Student,</a></li>
                            <li class="list-inline-item"><a target="_blank" href="{{ route('student.login') }}">Alumni,</a></li>
                            <li class="list-inline-item"><a target="_blank" href="{{ route('login') }}">HoD,</a></li>
                            <li class="list-inline-item"><a target="_blank" href="{{ route('login') }}">Academic</a></li>
                        </ul>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-4">
                    <div class="position-relative home-img text-center mt-lg-0">

                        <div class="circle-effect">
                            <div class="circle"></div>
                            <div class="circle2"></div>
                            <div class="circle3"></div>
                            <div class="circle4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end hero section -->

    <section class="section bg-light" id="categories">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center mb-5">
                        <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">Filtering by <span
                                class="text-primary">Departments</span></h1>

                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                @foreach ($departments as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-none text-center py-3">
                            <div class="card-body py-4">
                                <div class="avatar-sm position-relative mb-4 mx-auto">
                                    <div class="job-icon-effect"></div>
                                    <div class="avatar-title bg-transparent text-success rounded-circle">
                                        <i class="ri-pencil-ruler-2-line fs-1"></i>
                                    </div>
                                </div>
                                <a href="{{ route('projectCategory', $item->id) }}" class="stretched-link">
                                    <h5 class="fs-17 pt-1">{{ $item->name }}</h5>
                                </a>
                                <p class="mb-0 text-muted">{{ $item->projects->where('isSponsered', false)->count() }} Projects</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>

    <section class="section" id="findJob">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center mb-5">
                        <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">Explore Innovative <span
                                class="text-primary">Projects</span></h1>
                        <p class="text-muted">Support the next generation of innovators and discover projects that are
                            ready to make a lasting impact.</p>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row" id="project">
                @foreach ($projects as $project)
                    <div class="col-lg-6">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="d-flex">

                                    <div class="ms-3 flex-grow-1">
                                        <a href="{{ route('showProject', $project->id) }}">
                                            <h5>{{ $project->title }}</h5>
                                        </a>

                                        @php
                                            $description = strip_tags($project->description); // Remove any HTML tags
                                            $words = explode(' ', $description); // Split the string into an array of words
                                            $shortDescription = implode(' ', array_slice($words, 0, 30)); // Get the first 30 words
                                        @endphp

                                        <p class="text-muted">{{ $shortDescription }}{{ count($words) > 30 ? '...' : '' }}
                                        </p>
                                        {{-- <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Maecenas
                                            rhoncus ligula ut ligula placerat placerat. Quisque at tincidunt ipsum. Donec
                                            eros
                                            lacus ... </p> --}}
                                        <ul class="list-inline fs-bold mb-3">
                                            <li class="list-inline-item">
                                                <i class="ri-user-line align-bottom me-1"></i> {{ $project->student->name }}
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="ri-apps-2-line"></i> {{ $project->department->name }}
                                            </li>

                                        </ul>
                                        <div class="hstack gap-2">
                                            <span class="badge bg-success-subtle text-success">{{ $project->price }}
                                                Rwf</span>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection
