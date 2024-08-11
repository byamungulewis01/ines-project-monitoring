@extends('layouts.home')
@section('body')
    <section class="section" id="findJob">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="{{ route('buyProject', $project->id) }}" method="post">
                        @csrf
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
                            <ul class="list-inline fs-bold mb-3">
                                <span class="badge bg-success-subtle text-success me-2">{{ number_format($project->price) }}
                                    Rwf</span>
                                @if (auth()->guard('sponser')->check())
                                    <button type="submit" class="btn btn-danger btn-sm"> Get it now</button>
                                @else
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#loginModals" class="btn btn-danger btn-sm"> Get it now</button>
                                @endif

                            </ul>

                        </div>
                    </form>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->


        </div>
    </section>
@endsection
