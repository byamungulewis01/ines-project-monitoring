@extends('layouts.home')
@section('body')
    <section class="section" id="findJob">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center mb-5">
                        <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">List of Sponsered Project</h1>

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

                                        <div>
                                            <a href="{{ route('sponser.showProject', $project->id) }}" class="link-primary">More
                                                Details<i class="ri-arrow-right-line align-bottom ms-1"></i></a>
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
