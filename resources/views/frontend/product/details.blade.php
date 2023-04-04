@extends('frontend.layout.master')

@section('content')
    
    <!-- ======================= Top Breadcrubms ======================== -->
			<div class="gray py-3">
				<div class="container">
					<div class="row">
						<div class="colxl-12 col-lg-12 col-md-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Library</a></li>
									<li class="breadcrumb-item active" aria-current="page">Data</li>
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
					<div class="row justify-content-between">
					
						<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
							<div class="quick_view_slide">
                                @foreach ($thumb as $thumb)
								    <div class="single_view_slide">
                                        <a href="{{ asset('uploads/product/thumbnail') }}/{{ $thumb->thumbnail }}" data-lightbox="roadtrip" class="d-block mb-4">
                                            <img src="{{ asset('uploads/product/thumbnail') }}/{{ $thumb->thumbnail }}" class="img-fluid rounded" alt="" />
                                        </a>
                                    </div>
                                @endforeach
							</div>
						</div>
						
						<div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
							<div class="prd_details pl-3">
								
								<div class="prt_01 mb-1"><span class="text-light bg-info rounded px-2 py-1">{{ $pro_info->first()->rel_scat->subcategory_name }}</span></div>
								<div class="prt_02 mb-3">
									<h2 class="ft-bold mb-1">{{ $pro_info->first()->product_name }}</h2>
									<div class="text-left">
										<div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
											@for ($i=1; $i<=$avg_star; $i++)
												<i class="fas fa-star filled"></i>
											@endfor
											@for ($i=1; $i<=5-$avg_star; $i++)
												<i class="fas fa-star"></i>
											@endfor
											<span class="small">({{ count($reviews) }} Reviews)</span>
										</div>
										<div class="elis_rty">
											@if($pro_info->first()->discount != 0)
												<span class="ft-medium text-muted line-through fs-md mr-2">&#2547; {{ $pro_info->first()->price }}</span>
											@endif
											<span class="ft-bold theme-cl fs-lg mr-2">&#2547; {{ number_format($pro_info->first()->after_discount) }}</span></div>
									</div>
								</div>
								
								<div class="prt_03 mb-4">
									<p>{{ $pro_info->first()->short_description }}</p>
								</div>


								<form action="{{ route('store.cart') }}" method="post">
									@csrf

									<input type="hidden" name="product_id" value="{{ $pro_info->first()->id }}">
									<div class="prt_04 mb-2">
										<p class="d-flex align-items-center mb-0 text-dark ft-medium">Color:</p>
										<div class="text-left">
											@foreach ($av_color as $itm)
												<div class="form-check form-option form-check-inline mb-1">
													<input class="form-check-input colorcl" type="radio" value="{{ $itm->color_id }}" name="color_id" id="white{{ $itm->rel_color->id }}">
													<label title="{{ $itm->rel_color->color_name }}" class="form-option-label rounded-circle" for="white{{ $itm->rel_color->id }}">
														<span class="form-option-color rounded-circle" style="background: {{ $itm->rel_color->color_code }};">
															@if ($itm->rel_color->id == 1)
																{{ $itm->rel_color->color_name }}
															@endif
														</span>
													</label>
												</div>
											@endforeach
										</div>
										@error('color_id')
											<strong class="tt">{{$message}}</strong>
										@enderror
									</div>
									
									<div class="prt_04 mb-2">
										<p class="d-flex align-items-center mb-0 text-dark ft-medium">Size:</p>
										<div class="text-left pb-0 pt-2 size_block">
											@foreach ($av_size as $itm)
												<div class="form-check form-option size-option form-check-inline mb-2">
													<input class="form-check-input sesize" value="{{ $itm->size_id }}" type="radio" name="size_id" id="large{{ $itm->rel_size->id }}">
													<label class="form-option-label" for="large{{ $itm->rel_size->id }}">{{ $itm->rel_size->product_size }}</label>
												</div>
											@endforeach

										</div>
										@error('size_id')
											<strong class="tt">{{$message}}</strong>
										@enderror
										@error('quantity')
											<strong class="tt">{{$message}}</strong>
										@enderror
									</div>

									@if(session('pinfo_err'))
										<div style="margin: 2px 0 6px 0; padding: 4px 0;" class="text-red">{{ session('pinfo_err') }}</div>
									@endif
									
									<div class="prt_05 mb-4">
										<div class="form-row mb-7">
											<div class="col-12 col-lg-auto">
												<!-- Quantity -->
												<select class="mb-2 custom-select quantity_av" name="quantity">
													<option value="" selected>-</option>
												</select>
											</div>
											<div class="col-12 col-lg">
												<!-- Submit -->
												<button type="submit" class="btn btn-block custom-height bg-dark mb-2">
													<i class="lni lni-shopping-basket mr-2"></i>Add to Cart 
												</button>
											</div>
											<div class="col-12 col-lg-auto">
												<!-- Wishlist -->
												<button formaction="{{ route('store.wishlist') }}" class="btn custom-height btn-block mb-2 text-dark">
													<i class="lni lni-heart mr-2"></i>Wishlist
												</button>
											</div>
										</div>
									</div>

								</form>

								
								
								<div class="prt_06">
									<p class="mb-0 d-flex align-items-center">
									  <span class="mr-4">Share:</span>
									  <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="#!">
										<i class="fab fa-twitter position-absolute"></i>
									  </a>
									  <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="#!">
										<i class="fab fa-facebook-f position-absolute"></i>
									  </a>
									  <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted" href="#!">
										<i class="fab fa-pinterest-p position-absolute"></i>
									  </a>
									</p>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ======================= Product Detail End ======================== -->
			
			<!-- ======================= Product Description ======================= -->
			<section class="middle">
				<div class="container">
					<div class="row align-items-center justify-content-center">
						<div class="col-xl-11 col-lg-12 col-md-12 col-sm-12">
							<ul class="nav nav-tabs b-0 d-flex align-items-center justify-content-center simple_tab_links mb-4" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="description-tab" href="#description" data-toggle="tab" role="tab" aria-controls="description" aria-selected="true">Description</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" href="#information" id="information-tab" data-toggle="tab" role="tab" aria-controls="information" aria-selected="false">Additional information</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" href="#reviews" id="reviews-tab" data-toggle="tab" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
								</li>
							</ul>
							
							<div class="tab-content" id="myTabContent">
								
								<!-- Description Content -->
								<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
									<div class="description_info">
										<p class="p-0 mb-2">
                                            {!! $pro_info->first()->long_description !!}
                                        </p>
									</div>
								</div>
								
								<!-- Additional Content -->
								<div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
									<div class="additionals">
										<table class="table">
											<tbody>
												<tr>
												  <th class="ft-medium text-dark">ID</th>
												  <td>#1253458</td>
												</tr>
												<tr>
												  <th class="ft-medium text-dark">SKU</th>
												  <td>KUM125896</td>
												</tr>
												<tr>
												  <th class="ft-medium text-dark">Color</th>
												  <td>Sky Blue</td>
												</tr>
												<tr>
												  <th class="ft-medium text-dark">Size</th>
												  <td>Xl, 42</td>
												</tr>
												<tr>
												  <th class="ft-medium text-dark">Weight</th>
												  <td>450 Gr</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
								<!-- Reviews Content -->
								<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
									<div class="reviews_info">
										@forelse ($reviews as $review)
											@if($review->rel_to_customer != null)
												<div class="single_rev d-flex align-items-start br-bottom py-3">
													<div class="single_rev_thumb"><img src="{{ asset('uploads/customer')}}/{{ $review->rel_to_customer->profile_image }}" class="img-fluid circle" width="40" alt="" /></div>
													<div class="single_rev_caption d-flex align-items-start justify-content-between w-100 pl-3">
														<div class="single_capt_left">
															<h5 class="mb-0 fs-md ft-medium lh-1">{{ $review->rel_to_customer->name }}</h5>
															<span class="small">{{ $review->updated_at->format('d M, Y') }}</span>
															<p>{{ $review->review }}</p>
														</div>
														<div class="single_capt_right">
															<div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
																@for ($i=1; $i<=$review->star; $i++)
																	<i class="fas fa-star filled"></i>
																@endfor
																@for ($i=1; $i<=5-$review->star; $i++)
																	<i class="fas fa-star"></i>
																@endfor
															</div>
														</div>
													</div>
												</div>
												
											@endif
										@empty
											<div class="alert alert-danger text-dark d-flex justify-content-center align-items-center">No review found</div>
										@endforelse
										
										
										
									</div>
									
									<div class="mt-5"></div>
									@auth('customerlogin')
										@if(App\Models\orderProduct::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $pro_info->first()->id)->exists())
											@if(App\Models\orderProduct::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $pro_info->first()->id)->whereNotNull('review')->exists())

											{{-- App\Models\orderProduct::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $pro_info->first()->id)->whereNotNull('review')->first() == false --}}

											<div class="alert alert-danger text-dark d-flex justify-content-center align-items-center">You already reviewed this product</div>
											@else
												<div class="reviews_rate mt-3">
													<form class="row" method="POST" action="{{ route('user.review', $pro_info->first()->id) }}">
														@csrf
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
															<h4>Submit Rating</h4>
														</div>
														
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
															<div class="revie_stars d-flex align-items-center justify-content-between px-2 py-2 gray rounded mb-2 mt-1">
																<div class="srt_013">
																	<div class="submit-rating">
																	<input class="star" id="star-5" type="radio" name="rating" value="5" />
																	<label for="star-5" title="5 stars">
																		<i class="fa fa-star" aria-hidden="true"></i>
																	</label>
																	<input class="star" id="star-4" type="radio" name="rating" value="4" />
																	<label for="star-4" title="4 stars">
																		<i class="fa fa-star" aria-hidden="true"></i>
																	</label>
																	<input class="star" id="star-3" type="radio" name="rating" value="3" />
																	<label for="star-3" title="3 stars">
																		<i class="fa fa-star" aria-hidden="true"></i>
																	</label>
																	<input class="star" id="star-2" type="radio" name="rating" value="2" />
																	<label for="star-2" title="2 stars">
																		<i class="fa fa-star" aria-hidden="true"></i>
																	</label>
																	<input class="star" checked id="star-1" type="radio" name="rating" value="1" />
																	<label for="star-1" title="1 star">
																		<i class="fa fa-star" aria-hidden="true"></i>
																	</label>
																	</div>
																</div>
																
																<div class="srt_014">
																	<h6 class="mb-0"><span class="input-star">1</span> Star</h6>
																</div>
															</div>
														</div>
														
														<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
															<div class="form-group">
																<label class="medium text-dark ft-medium">Full Name</label>
																<input readonly type="text" value="{{ Auth::guard('customerlogin')->user()->name }}" class="form-control" />
															</div>
														</div>
														
														<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
															<div class="form-group">
																<label class="medium text-dark ft-medium">Email Address</label>
																<input readonly type="email" value="{{ Auth::guard('customerlogin')->user()->email }}" class="form-control" />
															</div>
														</div>
														
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
															<div class="form-group">
																<label class="medium text-dark ft-medium">Description</label>
																<textarea name="review" class="form-control"></textarea>
															</div>
														</div>
														
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
															<div class="form-group m-0">
																<button class="btn btn-white stretched-link hover-black">Submit Review <i class="lni lni-arrow-right"></i></button>
															</div>
														</div>
														
													</form>
												</div>
											@endif
										@else
											<div class="alert alert-danger text-dark d-flex justify-content-center align-items-center">You havent purched this product yet</div>
										@endif

									@else
										<div class="alert alert-danger text-dark d-flex justify-content-between align-items-center">Please login to review this product <a href="{{ route('user.login.page') }}" class="btn btn-primary text-white" style="border-radius: 6px;">Login</a></div>
									@endauth

									
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ======================= Product Description End ==================== -->
			
			<!-- ======================= Similar Products Start ============================ -->
			<section class="middle pt-0">
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">Similar Products</h2>
								<h3 class="ft-bold pt-3">Matching Producta</h3>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="slide_items">
								
								@forelse ($sim_pro as $itm)
									<!-- single Item -->
									<div class="single_itesm">
										<div class="product_grid card b-0 mb-0">
											@if($itm->discount > 0)
												<div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">Sale</div>
											@endif
											<div class="card-body p-0">
												<div class="shop_thumb position-relative">
													<a class="card-img-top d-block overflow-hidden" href="{{ route('product.details', $itm->slug) }}"><img class="card-img-top" src="{{ asset('uploads/product/preview') }}/{{ $itm->preview }}" alt="..."></a>
												</div>
											</div>
											<div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
												<div class="text-left">
													<div class="text-center">
														<h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="{{ route('product.details', $itm->slug) }}">{{ $itm->product_name }}</a></h5>
														<div class="elis_rty"><span class="ft-bold fs-md text-dark">&#2547;{{ $itm->after_discount }}</span></div>
													</div>
												</div>
											</div>
										</div>
									</div>

								@empty
									<div>No Matching Product Found</div>
								@endforelse
								
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ======================= Similar Products Start ============================ -->

@endsection

@section('footer_script')

	<script>
		var color_id;
		var pro_id;
		$('.colorcl').click(function(){
			pro_id = "{{ $pro_info->first()->id }}";
			color_id = $(this).val();

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			$.ajax({
				url:'/getSize',
				type:'post',
				data:{'pro_id': pro_id, 'color_id': color_id},
				success:function(data){
					$('.size_block').html(data);
				},
			});
		});
		
		// $('.colorcl').click(function(){
		// 	var color_id = $(this).val();
		// 	console.log(color_id);
		// });

		$(document).on('click', 'input.sesize' , function(){
			pro_id;
			color_id;
			var size_id = $(this).val();

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			$.ajax({
				url:'/getavQuantity',
				type:'post',
				data:{'pro_id': pro_id, 'color_id': color_id, 'size_id': size_id},
				success:function(data){
					$('select.quantity_av').html(data);
				},
			});
		});
		

	</script>

@if (session('store_message'))
{{-- <div class="alert alert-success">{{ session('store_message') }}</div> --}}
<script>
	Swal.fire({
		position: 'center-center',
		icon: 'success',
		title: '{{ session("store_message") }}',
		showConfirmButton: false,
		// timer: 1800, 
	});
	// console.log('ok');
</script>
@endif

<script>
	$('.star').on('click', function () {
		var input = $(this).val();
		$('.input-star').html(input);
	});
</script>

@endsection