@extends('layouts.app')
@section('body')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Order Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">PM System</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order #{{ $order->index }}</h5>
                        <div class="flex-shrink-0">
                            <a href="#" class="btn btn-success btn-sm"><i
                                    class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Product Details</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Descount</th>
                                    <th scope="col">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $item)

                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td><h5 class="fs-15"><span class="link-primary">{{ $item->product->title }}</span></h5>
                                    </td>
                                    <td>{{ number_format($item->price) }}</td>
                                    <td>{{ $item->discount}}</td>

                                    <td class="fw-medium">
                                        {{ $item->amount }}
                                    </td>
                                </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td><h5 class="fs-15"><span class="link-dark">Total</span></h5></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-medium">{{ $order->products->sum('amount') }}</td>
                                    </tr>
                                </tfoot>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
        <div class="col-xl-3">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>

                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="/assets/images/users/user-dummy-img.jpg" alt="" class="avatar-sm rounded">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ $order->customer->name }}</h6>
                                    <p class="text-muted mb-0">Customer</p>
                                </div>
                            </div>
                        </li>
                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->customer->email }}</li>
                        <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->customer->phone }}</li>
                    </ul>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
