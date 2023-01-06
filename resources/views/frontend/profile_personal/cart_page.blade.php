@extends('frontend.layout.master')

@section('content')
    <!-- ======================= Top Breadcrubms ======================== -->
			<div class="gray py-3">
				<div class="container">
					<div class="row">
						<div class="colxl-12 col-lg-12 col-md-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Support</a></li>
									<li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
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
								<h2>Shopping Cart</h2>
							</div>
						</div>
					</div>
					
					<div class="row justify-content-between">
						<div class="col-12 col-lg-7 col-md-12">
                            <form action="{{ route('cart.product.update') }}" method="post">
                                @csrf
                            
                                <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                                    @php
										$total_cost = 0;
									@endphp
                                    @foreach ($cart as $cart)
                                    
                                        <li class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-3">
                                                    <!-- Image -->
                                                    <a href="product.html"><img src="{{ asset('uploads/product/preview') }}/{{ $cart->rel_to_product->preview }}" alt="..." class="img-fluid"></a>
                                                </div>
                                                <div class="col d-flex align-items-center justify-content-between">
                                                    <div class="cart_single_caption pl-2">
                                                        <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{ $cart->rel_to_product->product_name }}</h4>
                                                            <input type="hidden" name="product_id[{{ $cart->id }}]" value="{{ $cart->product_id }}">
                                                        <p class="mb-1 lh-1"><span class="text-dark">Size: {{ $cart->rel_to_size->product_size }}</span></p>
                                                            <input type="hidden" name="size_id[{{ $cart->id }}]" value="{{ $cart->size_id }}">
                                                        <p class="mb-3 lh-1"><span class="text-dark">Color: {{ $cart->rel_to_color->color_name }}</span></p>
                                                            <input type="hidden" name="color_id[{{ $cart->id }}]" value="{{ $cart->color_id }}">
                                                        <h4 class="fs-md ft-medium mb-3 lh-1">&#2547; {{ number_format($cart->rel_to_product->after_discount) }}</h4>

                                                        @php
                                                            $quantity = App\Models\inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->first()->quantity;
                                                        @endphp

                                                        <select class="mb-2 custom-select w-auto" name="quantity[{{ $cart->id }}]">
                                                            @for($i = 1; $i <= $quantity; $i++)
                                                                <option value="{{ $i }}" {{ $cart->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="fls_last"><a href="{{ route('cart.remove', $cart->id) }}" class="close_slide gray"><i class="ti-close"></i></a></div>
                                                </div>
                                            </div>
                                        </li>
										@php
											$total_cost += $cart->rel_to_product->after_discount * $cart->quantity;
										@endphp
                                    @endforeach
                                    
                                </ul>
							
                                <div style="flex-flow:row-reverse;" class="row align-items-end justify-content-between mb-10 mb-md-0">
                                    <div class="col-12 col-md-auto mfliud">
                                        <button type="submit" class="btn stretched-link borders">Update Cart</button>
                                    </div>
                            </form>
                                    <div class="col-12 col-md-7">
                                        <!-- Coupon -->
                                        <form class="mb-7 mb-md-0" action="{{ route('cart.page') }}" method="GET">
                                            <label class="fs-sm ft-medium text-dark">Coupon code:</label>
                                            <div class="row form-row">
                                                <div class="col">
                                                	<input name="coupon_code" class="form-control" type="text" placeholder="Enter coupon code*">
													@if($err_msg)
														<div class="mt-1 errormsg">{{ $err_msg }}</div>
													@endif
												</div>
                                                <div class="col-auto">
                                                    <button class="btn btn-dark" type="submit">Apply</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
						</div>

						@php
							$total_wd = 0;
							$total_cost;
							$discount;
							$method;
							$drange;
							$discount_prcnt = null;
							switch ($method) {
								case '1':
										if ($drange != null && $total_cost*($discount/100) > $drange) {
											$total_wd = $total_cost-$drange;
											$discount_tg = $drange; 
										}else {
											$total_wd = $total_cost-($total_cost*($discount/100));
											$discount_tg = $total_cost*($discount/100);
											$discount_prcnt = $discount;
										}
									break;
								case '2':
										$total_wd = $total_cost-$discount;
										$discount_tg = $discount; 
									break;
								default:
										$total_wd = $total_cost;
										$discount_tg = $discount; 
									break;
							
							}
						@endphp
						
						<div class="col-12 col-md-12 col-lg-4">
							<div class="card mb-4 gray mfliud">
							  <div class="card-body">
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Subtotal</span> <span class="ml-auto text-dark ft-medium">&#2547; {{ number_format($total_cost) }}</span>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Discount</span> <span class="ml-auto text-dark ft-medium">&#2547; {{ number_format($discount_tg, 2) }}</span>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Total</span> <span class="ml-auto text-dark ft-medium">&#2547; {{ number_format(round($total_wd)) }}</span>
								  </li>
								  <li class="list-group-item fs-sm text-center">
									Shipping cost calculated at Checkout *
								  </li>
								</ul>
							  </div>
							</div>
							
							<a class="btn btn-block btn-dark mb-3" href="{{ route('checkout.page') }}">Proceed to Checkout</a>
							
							<a class="btn-link text-dark ft-medium" href="shop.html">
							  <i class="ti-back-left mr-2"></i> Continue Shopping
							</a>
						</div>

						@php
							session([
								'total_cost'=>$total_cost,
								'discount_tg'=>$discount_tg,
								'percentage'=>$discount_prcnt,
							]);
						@endphp
						
					</div>
					
				</div>
			</section>
			<!-- ======================= Product Detail End ======================== -->
@endsection