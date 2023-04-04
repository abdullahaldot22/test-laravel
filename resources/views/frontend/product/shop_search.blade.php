@extends('frontend.layout.master')

@section('content')
<div class="clearfix"></div>
    <!-- ============================================================== -->
    <!-- Top header  -->
    <!-- ============================================================== -->
    
    <!-- ======================= Shop Style 1 ======================== -->
    <section class="bg-cover" style="background:url({{ asset('frontend/img/banner-2.png') }}) no-repeat;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-left py-5 mt-3 mb-3">
                        <h1 class="ft-medium mb-3">Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Shop Style 1 ======================== -->
    <!-- ======================= Filter Wrap Style 1 ======================== -->
			<section class="py-3 br-bottom br-top">
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Shop</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</section>
			<!-- ============================= Filter Wrap ============================== -->
			
			
			<!-- ======================= All Product List ======================== -->
			<section class="middle">
				<div class="container">
					<div class="row">
						
						<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 p-xl-0">
							<div class="search-sidebar sm-sidebar border">
								<div class="search-sidebar-body">
									<!-- Single Option -->
									<div class="single_search_boxed">
										<div class="widget-boxed-body">
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group px-3 mt-3">
														<a href="{{ route('product.shop_search') }}" class="btn btn-dark form-control reset">Reset</a>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="single_search_boxed">
										<div class="widget-boxed-header">
											<h4><a href="#pricing" data-toggle="collapse" aria-expanded="false" role="button">Pricing</a></h4>
										</div>
										<div class="widget-boxed-body collapse show" id="pricing" data-parent="#pricing">
											<div class="row">
												<div class="col-lg-6 pr-1">
													@php
														
													@endphp
													<div class="form-group pl-3">
														<input type="number" class="form-control min-price" placeholder="{{ @$_GET['minprice'] == 'undefined' || @$_GET['minprice'] == '' ? 'Min' : @$_GET['minprice'] }}">
													</div>
												</div>
												<div class="col-lg-6 pl-1">
													<div class="form-group pr-3">
														<input type="number" class="form-control max-price" placeholder="{{ @$_GET['maxprice'] == 'undefined' || @$_GET['maxprice'] == '' ? 'Max' : @$_GET['maxprice'] }}">
													</div>
												</div>
												<div class="col-lg-12">
													<div class="form-group px-3">
														<button type="submit" class="btn form-control price_range">Submit</button>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- Single Option -->
									<div class="single_search_boxed">
										<div class="widget-boxed-header">
											<h4><a href="#Categories" data-toggle="collapse" aria-expanded="false" role="button">Categories</a></h4>
										</div>
										<div class="widget-boxed-body collapse show" id="Categories" data-parent="#Categories">
											<div class="side-list no-border">
												<!-- Single Filter Card -->
												<div class="single_filter_card">
													<div class="card-body pt-0">
														<div class="inner_widget_link">
															<ul class="no-ul-list">
                                                                @foreach($categories as $category)
                
                                                                    <li>
                                                                        <input {{ @$_GET['category'] == $category->id ? 'checked' : '' }} id="category{{ $category->id }}" class="category_id" name="category" value="{{ $category->id }}" type="radio">
                                                                        <label for="category{{ $category->id }}" class="checkbox-custom-label">{{ $category->category_name }}<span>{{ App\Models\product::where('category_id', $category->id)->count() }}</span></label>
                                                                    </li>
                                                                    
                                                                @endforeach
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- Single Option -->
									<div class="single_search_boxed">
										<div class="widget-boxed-header">
											<h4><a href="#brands" data-toggle="collapse" aria-expanded="false" role="button">Brands</a></h4>
										</div>
										<div class="widget-boxed-body collapse show" id="brands" data-parent="#brands">
											<div class="side-list no-border">
												<!-- Single Filter Card -->
												<div class="single_filter_card">
													<div class="card-body pt-0">
														<div class="inner_widget_link">
															<ul class="no-ul-list">
																<li>
																	<input id="brands1" class="checkbox-custom" name="brands" type="radio">
																	<label for="brands1" class="checkbox-custom-label">Sumsung<span>142</span></label>
																</li>
																<li>
																	<input id="brands2" class="checkbox-custom" name="brands" type="radio">
																	<label for="brands2" class="checkbox-custom-label">Apple<span>652</span></label>
																</li>
																<li>
																	<input id="brands3" class="checkbox-custom" name="brands" type="radio">
																	<label for="brands3" class="checkbox-custom-label">Nike<span>232</span></label>
																</li>
																<li>
																	<input id="brands4" class="checkbox-custom" name="brands" type="radio">
																	<label for="brands4" class="checkbox-custom-label">Reebok<span>192</span></label>
																</li>
																<li>
																	<input id="brands5" class="checkbox-custom" name="brands" type="radio">
																	<label for="brands5" class="checkbox-custom-label">Hawai<span>265</span></label>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- Single Option -->
									<div class="single_search_boxed">
										<div class="widget-boxed-header">
											<h4><a href="#colors" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Colors</a></h4>
										</div>
										<div class="widget-boxed-body collapse" id="colors" data-parent="#colors">
											<div class="side-list no-border">
												<!-- Single Filter Card -->
												<div class="single_filter_card">
													<div class="card-body pt-0">
														<div class="text-left">
                                                            @foreach($colors as $color)
                                                                
                                                                <div class="form-check form-option form-check-inline mb-1">
                                                                    <input {{ @$_GET['color'] == $color->id ? 'checked' : '' }} class="color_id" type="radio" name="color" id="whitea{{ $color->id }}" value="{{ $color->id }}">
                                                                    <label title="{{ $color->color_name }}" class="form-option-label rounded-circle" for="whitea{{ $color->id }}"><span class="form-option-color rounded-circle" style="background-color: {{ $color->color_code }};"></span></label>
                                                                </div>

                                                            @endforeach
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Single Option -->
									<div class="single_search_boxed">
										<div class="widget-boxed-header">
											<h4><a href="#size" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Size</a></h4>
										</div>
										<div class="widget-boxed-body collapse" id="size" data-parent="#size">
											<div class="side-list no-border">
												<!-- Single Filter Card -->
												<div class="single_filter_card">
													<div class="card-body pt-0">
														<div class="text-left pb-0 pt-2">
                                                            @foreach($sizes as $size)
                                                                
                                                                <div class="form-check form-option form-check-inline mb-2">
                                                                    <input {{ @$_GET['size'] == $size->id ? 'checked' : '' }} class="size_id" type="radio" name="sizes" id="{{ $size->id }}s" value="{{ $size->id }}">
                                                                    <label class="form-option-label" for="{{ $size->id }}s">{{ $size->product_size }}</label>
                                                                </div>

                                                            @endforeach
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						
						<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
							
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12">
									<div class="border mb-3 mfliud">
										<div class="row align-items-center py-2 m-0">
											<div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
												<h6 class="mb-0">Searched Products Found</h6>
											</div>
											
											<div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
												<div class="filter_wraps d-flex align-items-center justify-content-end m-start">
													<div class="single_fitres mr-2 br-right">
														<select class="custom-select simple sort">
														  <option value="">Default Sorting</option>
														  <option value="1" {{ @$_GET['sort'] == 1 ? 'selected' : '' }}>Sort by price: Low -> High </option>
														  <option value="2" {{ @$_GET['sort'] == 2 ? 'selected' : '' }}>Sort by price: Hight -> Low </option>
														  <option value="3" {{ @$_GET['sort'] == 3 ? 'selected' : '' }}>Sort by A - Z</option>
														  <option value="4" {{ @$_GET['sort'] == 4 ? 'selected' : '' }}>Sort by Z - A</option>
														</select>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- row -->
							<div class="row align-items-center rows-products">
								
                                @forelse($products as $product)
                                
                                    <!-- Single -->
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                        <div class="product_grid card b-0">
                                            <div class="badge bg-danger text-white position-absolute ft-regular ab-left text-upper">Hot</div>
                                            <div class="card-body p-0">
                                                <div class="shop_thumb position-relative">
                                                    <a class="card-img-top d-block overflow-hidden" href="{{ route('product.details', $product->slug) }}"><img class="card-img-top" src="{{ asset('uploads/product/preview') }}/{{ $product->preview }}" alt="..."></a>
                                                </div>
                                            </div>
                                            <div class="card-footer b-0 p-0 pt-2 bg-white">
                                                <div class="text-left">
                                                    <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="{{ route('product.details', $product->slug) }}">{{ $product->product_name }}</a></h5>
                                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">&#2547; {{ number_format($product->after_discount) }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert w-100 mt-5 text-center" style="font-weight: 700; font-style: italic; opacity: 0.5; letter-spacing: 3px; font-size: 18px;">No Product Found</div>
                                @endforelse
								
							</div>
							<!-- row -->
						</div>
					</div>
				</div>
			</section>
			<!-- ======================= All Product List ======================== -->
@endsection

@section('footer_script')
    <script>
        $('#search_btn').click(function () {
            var input = $('#search_input').val();
			var cat_id = $('input[class="category_id"]:checked').val();
			var color_id = $('input[class="color_id"]:checked').val();
			var size_id = $('input[class="size_id"]:checked').val();
			var sort = $('.sort').val();
			var min = $('.min-price').val();
			var max = $('.max-price').val();
            var link = "{{ route('product.shop_search') }}"+"?keyword="+input+"&category="+cat_id+"&color="+color_id+"&size="+size_id+"&minprice="+min+"&maxprice="+max+"&sort="+sort;
            window.location.href = link;
        });
        $('.price_range').click(function () {
            var input = $('#search_input').val();
			var cat_id = $('input[class="category_id"]:checked').val();
			var color_id = $('input[class="color_id"]:checked').val();
			var size_id = $('input[class="size_id"]:checked').val();
			var sort = $('.sort').val();
			var min = $('.min-price').val();
			var max = $('.max-price').val();
            var link = "{{ route('product.shop_search') }}"+"?keyword="+input+"&category="+cat_id+"&color="+color_id+"&size="+size_id+"&minprice="+min+"&maxprice="+max+"&sort="+sort;
            window.location.href = link;
        });
        $('.sort').change(function () {
            var input = $('#search_input').val();
			var cat_id = $('input[class="category_id"]:checked').val();
			var color_id = $('input[class="color_id"]:checked').val();
			var size_id = $('input[class="size_id"]:checked').val();
			var sort = $('.sort').val();
			var min = $('.min-price').val();
			var max = $('.max-price').val();
            var link = "{{ route('product.shop_search') }}"+"?keyword="+input+"&category="+cat_id+"&color="+color_id+"&size="+size_id+"&minprice="+min+"&maxprice="+max+"&sort="+sort;
            window.location.href = link;
        });
        $('.size_id').click(function () {
            var input = $('#search_input').val();
			var cat_id = $('input[class="category_id"]:checked').val();
			var color_id = $('input[class="color_id"]:checked').val();
			var size_id = $('input[class="size_id"]:checked').val();
			var sort = $('.sort').val();
			var min = $('.min-price').val();
			var max = $('.max-price').val();
            var link = "{{ route('product.shop_search') }}"+"?keyword="+input+"&category="+cat_id+"&color="+color_id+"&size="+size_id+"&minprice="+min+"&maxprice="+max+"&sort="+sort;
            window.location.href = link;
        });
        $('.color_id').click(function () {
            var input = $('#search_input').val();
			var cat_id = $('input[class="category_id"]:checked').val();
			var color_id = $('input[class="color_id"]:checked').val();
			var size_id = $('input[class="size_id"]:checked').val();
			var sort = $('.sort').val();
			var min = $('.min-price').val();
			var max = $('.max-price').val();
            var link = "{{ route('product.shop_search') }}"+"?keyword="+input+"&category="+cat_id+"&color="+color_id+"&size="+size_id+"&minprice="+min+"&maxprice="+max+"&sort="+sort;
            window.location.href = link;
        });
        $('.category_id').click(function () {
            var input = $('#search_input').val();
			var cat_id = $('input[class="category_id"]:checked').val();
			var color_id = $('input[class="color_id"]:checked').val();
			var size_id = $('input[class="size_id"]:checked').val();
			var sort = $('.sort').val();
			var min = $('.min-price').val();
			var max = $('.max-price').val();
            var link = "{{ route('product.shop_search') }}"+"?keyword="+input+"&category="+cat_id+"&color="+color_id+"&size="+size_id+"&minprice="+min+"&maxprice="+max+"&sort="+sort;
            window.location.href = link;
        });
    </script>
@endsection