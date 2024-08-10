@extends('layouts.student.app')
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
            <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
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
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                    alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" name="image_file" type="file"
                                        class="profile-img-file-input" accept="image/*">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <h5 class="fs-16 mb-1">{{ $student->name }}</h5>
                            <p class="text-muted mb-0">{{ $student->department->name }}</p>
                        </div>
                    </div>
                </div>
                <!--end card-->

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Contact</h5>
                            </div>

                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-success text-white">
                                    <i class="ri-whatsapp-fill"></i>
                                </span>
                            </div>
                            <input type="text" name="whatsapp_number" class="form-control" id="whatsapp_number"
                                placeholder="Whatsapp" value="{{ old('whatsapp_number', $student->whatsapp_number) }}">
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-primary">
                                    <i class="ri-phone-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="call_number" id="call_number"
                                placeholder="call number" value="{{ old('call_number', $student->call_number) }}">
                        </div>

                    </div>
                </div>
                <!--end card-->
        </div>
        <!--end col-->
        <div class="col-md-8">
            <div class="card mt-xxl-n5">


                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab"
                                aria-selected="true">
                                <i class="fas fa-home"></i> Personal Details
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab"
                                aria-selected="false" tabindex="-1">
                                <i class="far fa-user"></i> Change Password
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="personalDetails" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" readonly name="name" id="name"
                                            placeholder="Enter your name" value="{{ old('name', $student->name) }}">
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter your email" value="{{ old('name', $student->email) }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            placeholder="Enter your phone number"
                                            value="{{ old('phone', $student->phone) }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3 pb-2">
                                        <label for="biography" class="form-label">Biography</label>
                                        <textarea class="form-control" rows="4" name="biography" id="biography" placeholder="Enter your description"
                                            rows="3">{{ old('biography', $student->biography) }}</textarea>
                                        @error('biography')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Updates</button>
                                        <button type="button" class="btn btn-soft-success">Cancel</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{ route('student.profile.password_store') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row g-2">
                                    <div class="col-lg-12">
                                        <x-input-label class="form-label" for="update_password_current_password"
                                            :value="__('Current Password')" />
                                        <x-text-input id="update_password_current_password" name="current_password"
                                            type="password" class="form-control" autocomplete="current-password"
                                            placeholder="Enter current password" />
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>

                                    <div class="col-lg-12">
                                        <x-input-label class="form-label" for="update_password_password"
                                            :value="__('New Password')" />
                                        <x-text-input id="update_password_password" name="password" type="password"
                                            class="form-control" autocomplete="new-password"
                                            placeholder="Enter new password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>

                                    <div class="col-lg-12">
                                        <x-input-label class="form-label" for="update_password_password_confirmation"
                                            :value="__('Confirm Password')" />
                                        <x-text-input id="update_password_password_confirmation"
                                            name="password_confirmation" placeholder="Confirm password" type="password"
                                            class="form-control" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>




                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Change Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>

                        </div>
                        <!--end tab-pane-->

                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
@section('js')
    <script>
        document.getElementById('profile-img-file-input').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const imgElement = document.getElementById('user-profile-image');
                imgElement.src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection
