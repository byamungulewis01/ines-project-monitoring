@extends('layouts.student.app')
@section('body')
    <!-- end page title -->
    <form action="{{ route('student.project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="project-title-input">Project Title</label>
                            <input type="text" class="form-control" value="{{ old('title', $project->title) }}"
                                name="title" id="project-title-input" placeholder="Enter project title" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Product Description</label>

                            <textarea name="description" id="ckeditor-classic">{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="proposal_file">Proposal File</label>
                            <input class="form-control" name="proposalFile" id="proposal_file" type="file"
                                accept=".pdf">
                        </div>
                        <div class="row">
                            <div class="text-end mb-3">
                                <button type="submit" class="btn btn-primary w-sm">Save Changes</button>
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
                        <h5 class="card-title mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-visible-input" class="form-label">visible</label>

                            <select name="visible" class="form-select" id="choices-publish-visible-input" data-choices
                                data-choices-search-false>
                                <option {{ old('visible', $project->visible) == 'publish' ? 'selected' : '' }}
                                    value="publish" selected>
                                    Published</option>

                                <option {{ old('visible', $project->visible) == 'draft' ? 'selected' : '' }} value="draft">
                                    Draft</option>
                            </select>
                            @error('visible')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="prototypeFile">Prototype</label>
                                <input class="form-control" name="prototypeFile" id="prototypeFile" type="file">
                            </div>

                            <!-- end col -->
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->


            </div>
            <!-- end col -->
        </div>

        <!-- end row -->

    </form>
    <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('css')
@endsection
@section('js')
    <!-- ckeditor -->
    <script src="/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

    <!-- dropzone js -->
    <script src="/assets/libs/dropzone/dropzone-min.js"></script>

    <script src="/assets/js/pages/ecommerce-product-create.init.js"></script>
@endsection
