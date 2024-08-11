@extends('layouts.home')
@section('body')
    <section class="section" id="findJob">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="text-center mb-5">
                        <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">{{ $project->title }}</h1>
                        <p class="text-muted">{!! $project->description !!}</p>

                        <ul class="list-inline fs-bold mb-3">
                            <li class="list-inline-item">
                                <i class="ri-user-line align-bottom me-1"></i> {{ $project->student->name }}
                            </li>
                            <li class="list-inline-item">
                                <i class="ri-apps-2-line"></i> {{ $project->department->name }}
                            </li>

                        </ul>
                        <div class="hstack flex-wrap gap-2 fs-15">
                            <div class="ms-3">
                                <h6 class="fs-15 mb-0"><a
                                        href='{{ asset('storage/' . $project->proposal_file) }}'>Project
                                        Proposal.pdf</a></h6>
                            </div>
                            <div class="ms-3">
                                <h6 class="fs-15 mb-0"><a
                                        href='{{ asset('storage/' . $project->prototype_file) }}'
                                        class="text-primary">Prototype.zip</a>
                                </h6>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
    </section>
@endsection
