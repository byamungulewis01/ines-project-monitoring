@extends('layouts.app')
@section('body')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Products</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">PM System</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Product Title</label>
                            <input type="text" class="form-control" value="{{ old('title', $product->title) }}" name="title"
                                id="product-title-input" value="" placeholder="Enter product title" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label>Product Description</label>

                            <textarea name="description" id="ckeditor-classic">{!! $product->description !!}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                            <label for="choices-publish-status-input" class="form-label">Status</label>

                            <select name="status" class="form-select" id="choices-publish-status-input" data-choices
                                data-choices-search-false>
                                <option {{ old('status', $product->status) == 'published' ? 'selected' : '' }} value="published" selected>
                                    Published</option>
                                <option {{ old('status', $product->status) == 'scheduled' ? 'selected' : '' }} value="scheduled">Scheduled
                                </option>
                                <option {{ old('status', $product->status) == 'draft' ? 'selected' : '' }} value="draft">Draft</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product-price-input">Price</label>
                                    <div class="input-group has-validation mb-3">
                                        <span class="input-group-text" id="product-price-addon">$</span>
                                        <input type="number" min="0" name="price" value="{{ old('price', $product->price) }}"
                                            class="form-control" id="product-price-input" placeholder="Enter price"
                                            aria-label="Price" aria-describedby="product-price-addon" required>
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product-discount-input">Discount</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="product-discount-addon">%</span>
                                        <input type="number" min="0" max="100" name="discount" value="{{ old('discount', $product->discount) }}"
                                            class="form-control" id="product-discount-input" placeholder="Enter discount"
                                            aria-label="discount" aria-describedby="product-discount-addon">
                                        @error('discount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- end col -->
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Short Description</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Add short description for product</p>
                        <textarea class="form-control" name="short_description" placeholder="Must enter minimum of a 100 characters"
                            rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                        @error('short_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
            <!-- end col -->
        </div>
        <div class="row">
            <div class="text-end mb-3">
                <button type="submit" class="btn btn-primary w-sm">Save Change</button>
            </div>
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
