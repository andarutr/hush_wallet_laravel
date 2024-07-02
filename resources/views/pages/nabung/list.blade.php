@extends('layouts.master')

@section('content')
<div class="row h-100">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="row align-items-end">
                    <div class="col-sm-8">
                        <div class="p-3">
                            <p class="fs-17 lh-base">Memulai dari yang kecil <span class="fw-semibold">lebih baik</span>, daripada ‘tidak memulai’ </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="px-3">
                            <img src="/assets/images/user-illustarator-2.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div> <!-- end card-body-->
        </div>
    </div> <!-- end col-->
</div> <!-- end row-->
<div class="row">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body checkout-tab">

                <form action="#">
                    

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel"
                            aria-labelledby="pills-bill-info-tab">
                            <div>
                                <h5>Tambahkan Data</h5>
                            </div>

                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="billinginfo-firstName" class="form-label">Jenis Tabungan</label>
                                            <select class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="JPA">Jangka Panjang</option>
                                                <option value="JPE">Jangka Pendek</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="billinginfo-lastName" class="form-label">Platform</label>
                                            <select class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="Bank Mandiri">Bank Mandiri</option>
                                                <option value="Bank Raya">Bank Raya</option>
                                                <option value="Dompet">Dompet</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="billinginfo-email" class="form-label">Nominal</label>
                                            <input type="email" class="form-control" id="billinginfo-email"
                                                placeholder="Enter email">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="billinginfo-address" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="billinginfo-address" placeholder="Enter address"
                                        rows="3"></textarea>
                                </div>

                                <div class="d-flex align-items-start gap-3 mt-3">
                                    <button type="button" class="btn btn-primary btn-label right ms-auto nexttab"
                                        data-nexttab="pills-bill-address-tab"><i
                                            class="ri-bank label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane fade" id="pills-bill-address" role="tabpanel"
                            aria-labelledby="pills-bill-address-tab">
                            <div>
                                <h5 class="mb-1">Shipping Information</h5>
                                <p class="text-muted mb-4">Please fill all information below</p>
                            </div>

                            <div class="mt-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-grow-1">
                                        <h5 class="fs-14 mb-0">Saved Address</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal"
                                            data-bs-target="#addAddressModal">
                                            Add Address
                                        </button>
                                    </div>
                                </div>
                                <div class="row gy-3">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="form-check card-radio">
                                            <input id="shippingAddress01" name="shippingAddress" type="radio"
                                                class="form-check-input" checked>
                                            <label class="form-check-label" for="shippingAddress01">
                                                <span class="mb-4 fw-semibold d-block text-muted text-uppercase">Home
                                                    Address</span>

                                                <span class="fs-14 mb-2 d-block">Marcus
                                                    Alfaro</span>
                                                <span class="text-muted fw-normal text-wrap mb-1 d-block">4739
                                                    Bubby Drive Austin, TX 78729</span>
                                                <span class="text-muted fw-normal d-block">Mo.
                                                    012-345-6789</span>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-wrap p-2 py-1 bg-light rounded-bottom border mt-n1">
                                            <div>
                                                <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal"
                                                    data-bs-target="#addAddressModal"><i
                                                        class="ri-pencil-fill text-muted align-bottom me-1"></i>
                                                    Edit</a>
                                            </div>
                                            <div>
                                                <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal"
                                                    data-bs-target="#removeItemModal"><i
                                                        class="ri-delete-bin-fill text-muted align-bottom me-1"></i>
                                                    Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="form-check card-radio">
                                            <input id="shippingAddress02" name="shippingAddress" type="radio"
                                                class="form-check-input">
                                            <label class="form-check-label" for="shippingAddress02">
                                                <span class="mb-4 fw-semibold d-block text-muted text-uppercase">Office
                                                    Address</span>

                                                <span class="fs-14 mb-2 d-block">James Honda</span>
                                                <span class="text-muted fw-normal text-wrap mb-1 d-block">1246
                                                    Virgil Street Pensacola, FL 32501
                                                </span>
                                                <span class="text-muted fw-normal d-block">Mo.
                                                    012-345-6789</span>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-wrap p-2 py-1 bg-light rounded-bottom border mt-n1">
                                            <div>
                                                <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal"
                                                    data-bs-target="#addAddressModal"><i
                                                        class="ri-pencil-fill text-muted align-bottom me-1"></i>
                                                    Edit</a>
                                            </div>
                                            <div>
                                                <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal"
                                                    data-bs-target="#removeItemModal"><i
                                                        class="ri-delete-bin-fill text-muted align-bottom me-1"></i>
                                                    Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h5 class="fs-14 mb-3">Shipping Method</h5>

                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="form-check card-radio">
                                                <input id="shippingMethod01" name="shippingMethod" type="radio"
                                                    class="form-check-input" checked>
                                                <label class="form-check-label" for="shippingMethod01">
                                                    <span class="fs-20 float-end mt-2 text-wrap d-block">Free</span>
                                                    <span class="fs-14 mb-1 text-wrap d-block">Free
                                                        Delivery</span>
                                                    <span class="text-muted fw-normal text-wrap d-block">Expected
                                                        Delivery 3 to 5 Days</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-check card-radio">
                                                <input id="shippingMethod02" name="shippingMethod" type="radio"
                                                    class="form-check-input" checked>
                                                <label class="form-check-label" for="shippingMethod02">
                                                    <span class="fs-20 float-end mt-2 text-wrap d-block">$24.99</span>
                                                    <span class="fs-14 mb-1 text-wrap d-block">Express
                                                        Delivery</span>
                                                    <span class="text-muted fw-normal text-wrap d-block">Delivery
                                                        within 24hrs.</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" class="btn btn-light btn-label previestab"
                                    data-previous="pills-bill-info-tab"><i
                                        class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                    to Personal Info</button>
                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab"
                                    data-nexttab="pills-payment-tab"><i
                                        class="ri-bank-card-line label-icon align-middle fs-16 ms-2"></i>Continue
                                    to Payment</button>
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane fade" id="pills-payment" role="tabpanel"
                            aria-labelledby="pills-payment-tab">
                            <div>
                                <h5 class="mb-1">Payment Selection</h5>
                                <p class="text-muted mb-4">Please select and enter your billing
                                    information</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-lg-4 col-sm-6">
                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show"
                                        aria-expanded="false" aria-controls="paymentmethodCollapse">
                                        <div class="form-check card-radio">
                                            <input id="paymentMethod01" name="paymentMethod" type="radio"
                                                class="form-check-input">
                                            <label class="form-check-label" for="paymentMethod01">
                                                <span class="fs-16 text-muted me-2"><i
                                                        class="ri-paypal-fill align-bottom"></i></span>
                                                <span class="fs-14 text-wrap">Paypal</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse"
                                        aria-expanded="true" aria-controls="paymentmethodCollapse">
                                        <div class="form-check card-radio">
                                            <input id="paymentMethod02" name="paymentMethod" type="radio"
                                                class="form-check-input" checked>
                                            <label class="form-check-label" for="paymentMethod02">
                                                <span class="fs-16 text-muted me-2"><i
                                                        class="ri-bank-card-fill align-bottom"></i></span>
                                                <span class="fs-14 text-wrap">Credit / Debit
                                                    Card</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show"
                                        aria-expanded="false" aria-controls="paymentmethodCollapse">
                                        <div class="form-check card-radio">
                                            <input id="paymentMethod03" name="paymentMethod" type="radio"
                                                class="form-check-input">
                                            <label class="form-check-label" for="paymentMethod03">
                                                <span class="fs-16 text-muted me-2"><i
                                                        class="ri-money-dollar-box-fill align-bottom"></i></span>
                                                <span class="fs-14 text-wrap">Cash on
                                                    Delivery</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse show" id="paymentmethodCollapse">
                                <div class="card p-4 border shadow-none mb-0 mt-4">
                                    <div class="row gy-3">
                                        <div class="col-md-12">
                                            <label for="cc-name" class="form-label">Name on
                                                card</label>
                                            <input type="text" class="form-control" id="cc-name"
                                                placeholder="Enter name">
                                            <small class="text-muted">Full name as displayed on
                                                card</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="cc-number" class="form-label">Credit card
                                                number</label>
                                            <input type="text" class="form-control" id="cc-number"
                                                placeholder="xxxx xxxx xxxx xxxx">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="cc-expiration" class="form-label">Expiration</label>
                                            <input type="text" class="form-control" id="cc-expiration"
                                                placeholder="MM/YY">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="cc-cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cc-cvv" placeholder="xxx">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-muted mt-2 fst-italic">
                                    <i data-feather="lock" class="text-muted icon-xs"></i> Your
                                    transaction is secured with SSL encryption
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" class="btn btn-light btn-label previestab"
                                    data-previous="pills-bill-address-tab"><i
                                        class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                    to Shipping</button>
                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab"
                                    data-nexttab="pills-finish-tab"><i
                                        class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Complete
                                    Order</button>
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane fade" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
                            <div class="text-center py-5">

                                <div class="mb-4">
                                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                                        colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">
                                    </lord-icon>
                                </div>
                                <h5>Thank you ! Your Order is Completed !</h5>
                                <p class="text-muted">You will receive an order confirmation email
                                    with
                                    details of your order.</p>

                                <h3>Order ID: <a href="apps-ecommerce-order-details.html"
                                        class="text-decoration-underline">VZ2451</a></h3>
                            </div>
                        </div>
                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xl-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-0">List Nabung</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="table-light text-muted">
                            <tr>
                                <th style="width: 90px;" scope="col">Gambar</th>
                                <th scope="col">Nama Tabungan</th>
                                <th scope="col">Tgl Nabung</th>
                                <th scope="col" class="text-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="avatar-md bg-light rounded p-1">
                                        <img src="https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/Mandiri-512.png" alt="" class="img-fluid d-block">
                                    </div>
                                </td>
                                <td>
                                    <h5 class="fs-14"><a href="apps-ecommerce-product-details.html"
                                            class="text-body">Bank Mandiri</a>
                                    </h5>
                                    <p class="text-muted mb-0">Rp 10.000.000</p>
                                </td>
                                <td>
                                    <p>
                                        (02-07-2024)
                                    </p>
                                </td>
                                <td class="text-end"><span class="badge bg-success" title="Jangka Panjang" style="cursor: pointer">JPA</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="avatar-md bg-light rounded p-1">
                                        <img src="https://bankraya.co.id/img/logo.png" alt="" class="img-fluid d-block">
                                    </div>
                                </td>
                                <td>
                                    <h5 class="fs-14"><a href="apps-ecommerce-product-details.html"
                                            class="text-body">Bank Raya</a>
                                    </h5>
                                    <p class="text-muted mb-0">Rp 5.000.000</p>
                                </td>
                                <td>
                                    <p>
                                        (02-07-2024)
                                    </p>
                                </td>
                                <td class="text-end"><span class="badge bg-primary" title="Jangka Pendek" style="cursor: pointer">JPE</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="/u/nabung/selengkapnya">Selengkapnya</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
@endsection