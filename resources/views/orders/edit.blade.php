@extends('layouts.app')
@section('body')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-products-center justify-content-between">
                <h4 class="mb-sm-0">Edit Order</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">PM System</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <form action="{{ route('orders.update',$order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mt-4 justify-content-center">
            <div class="col-xxl-9">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="companyAddress">EDIT ORDER FORM</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="customer" class="form-label">Customer</label>
                                <select class="form-select select2" name="customer_id" id="customer">
                                    @foreach ($customers as $customer)
                                        <option
                                            {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}
                                            value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status-field" class="form-label">Status</label>
                                    <option value="" selected disabled>Select</option>
                                    <option {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}
                                        value="pending">
                                        Pending</option>
                                    <option {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}
                                        value="completed">
                                        Completed</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="products" class="form-label">Product</label>
                            <select class="form-select" name="products" id="products">
                                <option value="">-- select --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" price="{{ $product->price }}"
                                        discount="{{ $product->discount }}">{{ $product->title }}</option>
                                @endforeach
                            </select>
                            @error('products')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="table-responsive">
                            <table id="productTable" class="table table-nowrap">
                                <thead class="align-middle">
                                    <tr class="table-active">
                                        <th scope="col">#</th>
                                        <th scope="col" style="width: 280px;">PRODUCT NAME</th>
                                        <th scope="col"> PRICE </th>
                                        <th scope="col">DISCOUNT</th>
                                        <th scope="col">AMOUNT</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td> <strong>{{ $item->product->title }}</strong> <input type="hidden" value="{{ $item->product_id }}" name="products[]"/></td>
                                        <td><input type="number" name="unitprice[]" value="{{ $item->price }}" class="form-control bg-light border-0" readonly required> </td>
                                        <td><div class="input-step">
                                                    <button type="button" class="minus">–</button>
                                                    <input type="number" name="discount[]" class="discount" value="{{ $item->discount }}" min="0"
                                                        max="100" readonly>
                                                    <button type="button" class="plus">+</button>
                                                </div> </td>
                                        <td><input type="number" name="amount[]" value="{{ $item->amount }}" readonly class="form-control bg-light border-0 amount" required> </td>
                                        <td><button type="button" class="btn btn-sm btn-danger removeBtn">Remove</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td colspan="3"><strong>Total Amount</strong></td>
                                        <td><span id="totalAmount">{{ $order->products->sum('amount') }}</span></td>
                                        <td></td>
                                    </tr>
                                </tfoot>


                            </table>
                            <!--end table-->
                        </div>

                        <div class="hstack gap-2 justify-content-end d-print-none mt-1">
                            <button type="submit" class="btn btn-primary"><i class="ri-save-line align-bottom me-1"></i>
                                Save</button>
                        </div>
                    </div>

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
    <link href="/assets/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2()
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#products').change(function() {
                var selectedOption = $(this).find('option:selected');
                var itemId = $(this).val();
                var itemName = selectedOption.text();
                var price = selectedOption.attr('price');
                var discount = selectedOption.attr('discount');

                // Check if the product is already in the table
                if ($('#productTable tr[data-id="' + itemId + '"]').length > 0) {
                    alert(itemName + 'Product already added!');
                    return;
                }

                // Add selected product to the table
                var rowCount = $('#productTable tbody tr').length + 1;
                $('#productTable tbody').append(`
                    <tr data-id="${itemId}">
                        <td>${rowCount}</td>
                        <td> <strong>${itemName}</strong> <input type="hidden" value="${itemId}" name="products[]"/></td>
                        <td><input type="number" name="unitprice[]" value="${price}" class="form-control bg-light border-0" readonly required> </td>
                        <td><div class="input-step">
                                    <button type="button" class="minus">–</button>
                                    <input type="number" name="discount[]" class="discount" value="${discount}" min="0"
                                        max="100" readonly>
                                    <button type="button" class="plus">+</button>
                                </div> </td>
                        <td><input type="number" name="amount[]" readonly class="form-control bg-light border-0 amount" required> </td>
                        <td><button type="button" class="btn btn-sm btn-danger removeBtn">Remove</button></td>
                    </tr>`);

                // Calculate and set the amount
                calculateAmount();
                isData();
            });

            // Function to calculate the amount and total
            function calculateAmount() {
                var totalAmount = 0;
                $('#productTable tbody tr').each(function(index) {
                    var discount = parseFloat($(this).find('.discount').val());
                    var unitPrice = parseFloat($(this).find('input[name="unitprice[]"]').val());
                    var discountAmount = unitPrice * (discount * 0.01);
                    var amount = unitPrice - discountAmount;

                    $(this).find('.amount').val(amount.toFixed(2));
                    $(this).find('td:first').text(index + 1); // Update the row count
                    totalAmount += amount;
                });

                $('#totalAmount').text(totalAmount.toFixed(2));
            }

            function isData() {
                var t = document.getElementsByClassName("plus"),
                    e = document.getElementsByClassName("minus"),
                    n = document.getElementsByClassName("product");
                t &&
                    Array.from(t).forEach(function(t) {
                        t.addEventListener("click", function(e) {
                            parseInt(t.previousElementSibling.value) <
                                e.target.previousElementSibling.getAttribute("max") &&
                                (e.target.previousElementSibling.value++, n) &&
                                Array.from(n).forEach(function(t) {
                                    updateQuantity(e.target);
                                });
                            calculateAmount(); // Recalculate amounts when quantity changes
                        });
                    }),
                    e &&
                    Array.from(e).forEach(function(t) {
                        t.addEventListener("click", function(e) {
                            parseInt(t.nextElementSibling.value) >
                                e.target.nextElementSibling.getAttribute("min") &&
                                (e.target.nextElementSibling.value--, n) &&
                                Array.from(n).forEach(function(t) {
                                    updateQuantity(e.target);
                                });
                            calculateAmount(); // Recalculate amounts when quantity changes
                        });
                    });
            }
            isData();
            // Handle removing products from the table
            $(document).on('click', '.removeBtn', function() {
                $(this).closest('tr').remove();
                calculateAmount(); // Recalculate amounts after removal
            });
        });
    </script>
@endsection
