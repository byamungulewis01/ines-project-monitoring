@extends('layouts.student.app')
@section('body')
    <!-- start page title -->


    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body ">
                    <div class="text-muted py-3">
                        <h4 class="mb-3 fw-semibold">{{ $project->title }}
                            <a href="{{ route('student.project.edit', $project->id) }}" class="text-primary float-end">
                                <i class="ri-pencil-fill fs-16"></i> Edit
                            </a>
                        </h4>
                        <p>{!! $project->description !!}</p>


                    </div>
                    <div class="pt-3 border-top border-top-dashed mt-1">
                        <div class="hstack flex-wrap gap-2 fs-15">
                            <div class="ms-3">
                                <h6 class="fs-15 mb-0"><a href='{{ asset('storage/' . $project->proposal_file) }}'>Project
                                        Proposal.pdf</a></h6>
                            </div>
                            <div class="ms-3">
                                <h6 class="fs-15 mb-0"><a href='{{ asset('storage/' . $project->prototype_file) }}'
                                        class="text-primary">Prototype.zip</a>
                                </h6>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end card -->

        </div>
        <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">More Details</h5>
                </div>
                <div class="card-body">
                    <div class="table-card">
                        <table class="table mb-0">
                            <tbody>

                                <tr>
                                    <td class="fw-medium">Visible</td>
                                    <td><span class="badge bg-danger-subtle text-warning">Published</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Status</td>
                                    <td><span class="badge bg-secondary-subtle text-secondary">Approved</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Price</td>
                                    <td>200,000</td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->


        </div>
        <!-- end col -->
    </div>

    <!-- end row -->

    <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('css')
@endsection
