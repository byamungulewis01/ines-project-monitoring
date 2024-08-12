@extends('layouts.student.app')
@section('body')
    <!-- start page title -->


    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body ">
                    <div class="text-muted py-3">
                        <h4 class="mb-3 fw-semibold">{{ $project->title }}
                            @unless ($project->status == 'approved')
                                <a href="{{ route('student.project.edit', $project->id) }}" class="text-primary float-end">
                                    <i class="ri-pencil-fill fs-16"></i> Edit
                                </a>
                                @endif
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
                        <!-- Warning Alert -->
                        @if ($project->isSponsered)

                        <div class="alert alert-warning bg-warning text-white"><strong>Great News</strong> - Your project was
                            sponsered <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                class="text-primary">Click to
                                view more</a>

                        </div>
                        <!-- Static Backdrop -->

                        <!-- staticBackdrop Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                                        </lord-icon>

                                        <div class="mt-4">
                                            <h4 class="mb-3">You've made it!</h4>
                                            <div class="table-card mt-2 mb-2">
                                                @php
                                                    $order = \App\Models\Order::where('project_id',$project->id)->first();
                                                @endphp
                                                <table class="table mb-0">
                                                    <tbody>

                                                        <tr>
                                                            <td class="fw-medium">Sponser Name</td>
                                                            <td>
                                                               {{ $order->sponser->name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium">email</td>
                                                            <td>
                                                                {{ $order->sponser->email }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium">Sold Date</td>
                                                            <td>{{ $order->sponser->created_at->format('d M, Y') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end table-->
                                            </div>
                                            <div class="hstack gap-2 mt-3 justify-content-center">
                                                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                                                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                                    Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="table-card mt-2">
                            <table class="table mb-0">
                                <tbody>

                                    <tr>
                                        <td class="fw-medium">Visible</td>
                                        <td>
                                            @if ($project->visible == 'draft')
                                            <span class="badge bg-warning-subtle text-warning">Draft</span>
                                            @else
                                            <span class="badge bg-success-subtle text-success">Published</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Status</td>
                                        <td>
                                            @if ($project->status == 'pending')
                                                <span class="badge border border-warning text-warning">Pending</span>
                                            @elseif ($project->status == 'approved')
                                                <span class="badge border border-success text-success">Approved</span>
                                            @else
                                                <span class="badge border border-danger text-danger">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Price</td>
                                        <td>{{ number_format($project->price) }}</td>
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
