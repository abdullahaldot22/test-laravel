@extends('frontend.layout.master')

@section('content')
    <!-- ======================= Top Breadcrubms ======================== -->
			<div class="gray py-3">
				<div class="container">
					<div class="row">
						<div class="colxl-12 col-lg-12 col-md-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('customer.home') }}">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Support</a></li>
									<li class="breadcrumb-item active" aria-current="page">Checkout</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Top Breadcrubms ======================== -->
			
			<!-- ======================= Product Detail ======================== -->
			<section class="middle">
				<div class="container">
				
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="text-center d-block mb-5">
								<h2>Checkout</h2>
							</div>
						</div>
					</div>
					
					<div class="row justify-content-between">
						<div class="col-12 col-lg-7 col-md-12">
							<form>
								<h5 class="mb-4 ft-medium">Billing Details</h5>
								<div class="row mb-2">
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Full Name *</label>
											<input type="text" class="form-control" placeholder="First Name" />
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Email *</label>
											<input type="email" class="form-control" placeholder="Email" />
										</div>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Company</label>
											<input type="text" class="form-control" placeholder="Company Name (optional)" />
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Mobile Number *</label>
											<input type="text" class="form-control" placeholder="Mobile Number" />
										</div>
									</div>
									
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Address *</label>
											<input type="text" class="form-control" placeholder="Address" />
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Country *</label>
											<select class="custom-select">
											  <option value="">-- Select Country --</option>
											  <option value="1" selected="">Bangladesh</option>
											  <option value="2">United State</option>
											  <option value="3">United Kingdom</option>
											  <option value="4">China</option>
											  <option value="5">Pakistan</option>
											</select>
										</div>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">City / Town *</label>
											<input type="text" class="form-control" placeholder="City / Town" />
										</div>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">ZIP / Postcode *</label>
											<input type="text" class="form-control" placeholder="Zip / Postcode" />
										</div>
									</div>
									
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Additional Information</label>
											<textarea class="form-control ht-50"></textarea>
										</div>
									</div>
									
								</div>
								
							</form>
						</div>
						
						<!-- Sidebar -->
						<div class="col-12 col-lg-4 col-md-12">
							<div class="d-block mb-3">
								<h5 class="mb-4">Order Items ({{ count($carts) }})</h5>
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">

									@foreach ($carts as $cart)
										<li class="list-group-item">
											<div class="row align-items-center">
												<div class="col-3">
													<!-- Image -->
													<a href="product.html"><img src="{{ asset('uploads/product/preview') }}/{{ $cart->rel_to_product->preview }}" alt="..." class="img-fluid"></a>
												</div>
												<div class="col d-flex align-items-center">
													<div class="cart_single_caption pl-2">
														<h4 class="product_title fs-md ft-medium mb-1 lh-1">{{ $cart->rel_to_product->product_name }}</h4>
														<p class="mb-1 lh-1"><span class="text-dark">Size: {{ $cart->rel_to_size->product_size }}</span></p>
														<p class="mb-3 lh-1"><span class="text-dark">Color: {{ $cart->rel_to_color->color_name }}</span></p>
														<h4 class="fs-md ft-medium mb-3 lh-1">&#2547; {{ $cart->rel_to_product->after_discount }}</h4>
													</div>
												</div>
											</div>
										</li>
									@endforeach
									
								</ul>
							</div>
							
							<div class="mb-4">
								<div class="form-group">
									<h6>Delivery Location</h6>
									<ul class="no-ul-list">
										<li>
											<input id="c1" class="radio-custom location" name="charge" type="radio" value="60">
											<label for="c1" class="radio-custom-label">Inside City</label>
										</li>
										<li>
											<input id="c2" class="radio-custom location" name="charge" type="radio" value="180">
											<label for="c2" class="radio-custom-label">Outside City</label>
										</li>
									</ul>
								</div>
							</div>
							<div class="mb-4">
								<div class="form-group">
									<h6>Select Payment Method</h6>
									<ul class="no-ul-list">
										<li>
											<input id="c3" class="radio-custom" name="payment_method" type="radio">
											<label for="c3" class="radio-custom-label">Cash on Delivery</label>
										</li>
										<li>
											<input id="c4" class="radio-custom" name="payment_method" type="radio">
											<label for="c4" class="radio-custom-label">Pay With SSLCommerz</label>
										</li>
										<li>
											<input id="c5" class="radio-custom" name="payment_method" type="radio">
											<label for="c5" class="radio-custom-label">Pay With Stripe</label>
										</li>
									</ul>
								</div>
							</div>

							
							@php
								$total = session('total_cost');
								$discount = session('discount_tg');
							@endphp

							<div class="">
								<input type="hidden" class="total" value="{{ session('total_cost') }}">
								<input type="hidden" class="discount" value="{{ session('discount_tg') }}">
							</div>
							
							<div class="card mb-4 gray">
							  <div class="card-body">
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Subtotal</span> <span class="ml-auto text-dark ft-medium">&#2547; {{ number_format(session('total_cost')) }}</span>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Discount</span> <span class="ml-auto text-dark ft-medium">&#2547; {{ number_format(session('discount_tg'), 2) }}{{ session('percentage') == '' ? '' : ' ('.session('percentage').'%)' }}</span>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Charge</span> <span class="ml-auto text-dark ft-medium">&#2547; <span class="charge">0</span></span>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Total</span> <span class="ml-auto text-dark ft-medium">&#2547; <span class="grand_total">0</span></span>
								  </li>
								</ul>
							  </div>
							</div>
							
							<a class="btn btn-block btn-dark mb-3" href="checkout.html">Place Your Order</a>
						</div>
						
					</div>
					
				</div>
			</section>
			<!-- ======================= Product Detail End ======================== -->
@endsection

@section('footer_script')
<script>
	$('.location').on('click', function () {
		var charge = $(this).val();
		var discount = $('.discount').val();
		var total = $('.total').val();
		var grand_total = parseInt(total)+parseInt(charge)-parseInt(discount);
		$('.charge').html(charge);
		$('.grand_total').html(grand_total);
		// alert(charge);
	});
</script>
@endsection