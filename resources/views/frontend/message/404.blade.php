@extends("frontend.layout.master")

@section('content')
    <!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			
			<!-- ======================= Top Breadcrubms ======================== -->
			<div class="gray py-3">
				<div class="container">
					<div class="row">
						<div class="colxl-12 col-lg-12 col-md-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Page</a></li>
									<li class="breadcrumb-item active" aria-current="page">Error Page</li>
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
				
					<div class="row justify-content-center">
						<div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

							<!-- Icon -->
							<div class="p-4 d-inline-flex align-items-center justify-content-center circle bg-light-danger text-danger mx-auto mb-4"><i style="font-size: 28px; line-height: 30px;" class="fa-sharp fa-solid fa-triangle-exclamation"></i></div>
							<!-- Heading -->
							<h2 class="mb-2 ft-bold">404. Page not found.</h2>
							<!-- Text -->
							<p class="ft-regular fs-md mb-5">Sorry, we couldn't find the page you where looking for. We suggest that you return to home page.</p>
							<!-- Button -->
							<a class="btn btn-dark" href="{{ route('customer.home') }}">Go To Home Page</a>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ======================= Product Detail End ======================== -->
@endsection