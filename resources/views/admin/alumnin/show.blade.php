@extends('layouts.app')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">

            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
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
                </div>
            </div>
            <!--end card-->

            <div class="card">
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
                                    <th class="ps-0" scope="row">Department :</th>
                                    <td class="text-muted">{{ $student->department->name }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Option :</th>
                                    <td class="text-muted">{{ $student->option }}</td>
                                </tr>

                                <tr>
                                    <th class="ps-0" scope="row">Complation Date</th>
                                    <td class="text-muted">
                                        {{ \Carbon\Carbon::parse($student->completion_date)->format('d M, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
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

        @if ($student->project && $student->project->visible == 'publish')
            <div class="col-md-8">
                <div class="card mt-xxl-n5">
                    <div class="card-body">
                        <div class="text-muted py-3">
                            <h4 class="mb-3 fw-semibold">{{ $student->project->title }}

                            </h4>
                            <p>{!! $student->project->description !!}</p>


                        </div>
                        <div class="pt-3 border-top border-top-dashed mt-1">
                            <div class="hstack flex-wrap gap-2 fs-15">
                                <div class="ms-3">
                                    <h6 class="fs-15 mb-0"><a
                                            href='{{ asset('storage/' . $student->project->proposal_file) }}'>Project
                                            Proposal.pdf</a></h6>
                                </div>
                                <div class="ms-3">
                                    <h6 class="fs-15 mb-0"><a
                                            href='{{ asset('storage/' . $student->project->prototype_file) }}'
                                            class="text-primary">Prototype.zip</a>
                                    </h6>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="text-muted py-3">
                            <h4 class="mb-3 text-muted">Approval or reject project</h4>
                            <form action="{{ route('projects.reaction', $student->project->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Decision</label>
                                            <select name="status" class="form-select">
                                                <option value="" selected disabled> -- Select --</option>
                                                <option
                                                    {{ old('status', $student->project->status) == 'approved' ? 'selected' : '' }}
                                                    value="approved">Approve
                                                </option>
                                                <option
                                                    {{ old('status', $student->project->status) == 'reject' ? 'selected' : '' }}
                                                    value="reject">Reject</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Project Price</label>
                                            <input type="number" min="0" class="form-control"
                                                name="price" id="price" placeholder="Enter project value"
                                                value="{{ old('price', $student->project->price) }}">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="comment" class="form-label">Comment</label>
                                            <textarea  class="form-control" rows="4" name="comment" id="comment"
                                                placeholder="Please provide comment" rows="3">{{ old('comment', $student->project->comment) }}</textarea>
                                            @error('comment')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    @unless ($student->project->status == 'approved')
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    @endunless
                                    <!--end col-->
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endif
        <!--end col-->
    </div>
@endsection
@section('js')
@endsection
