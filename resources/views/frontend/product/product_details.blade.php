@extends('layouts.app')
@section('content')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_responsive.css')}}"> --}}

@include('layouts.user_partial.collapse_nav')

		<!-- Menu -->

		<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="page_menu_content">
							
							<div class="page_menu_search">
								<form action="#">
									<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							</div>
							<ul class="page_menu_nav">
								<li class="page_menu_item has-children">
									<a href="#">Language<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Currency<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item">
									<a href="#">Home<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
										<li class="page_menu_item has-children">
											<a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
											<ul class="page_menu_selection">
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
											</ul>
										</li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-angle-down"></i></a></li>
							</ul>
							
							<div class="menu_contact">
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('public/frontend')}}/images/phone_white.png" alt=""></div>+880 1521-446940</div>
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('public/frontend')}}/images/mail_white.png" alt=""></div><a href="mailto:hbr4494@gmail.com">hbr4494@gmail.com</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>
	@php
	$review_5 = App\Models\Review::where('product_id',$product->id)->where('rating',5)->count();
	$review_4 = App\Models\Review::where('product_id',$product->id)->where('rating',4)->count();
	$review_3 = App\Models\Review::where('product_id',$product->id)->where('rating',3)->count();
	$review_2 = App\Models\Review::where('product_id',$product->id)->where('rating',2)->count();
	$review_1 = App\Models\Review::where('product_id',$product->id)->where('rating',1)->count();

	$sum_rating = App\Models\Review::where('product_id',$product->id)->sum('rating');
	$count_rating = App\Models\Review::where('product_id',$product->id)->count('rating');

	@endphp
	<!-- Single Product -->

	<div class="single_product">
		<div class="container">
			<div class="row">
				@php
					$images = json_decode($product->images,true);
					$color = explode(',',$product->color);
					$size = explode(',',$product->size);
				@endphp

				<!-- Images -->
				<div class="col-lg-1 order-lg-1 order-2">
					<ul class="image_list">
						@foreach ($images as $image)
						<li data-image="{{asset('public/Files/product/'.$image)}}">
						<img src="{{asset('public/Files/product/'.$image)}}" alt=""></li>
						@endforeach
					
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-3 order-lg-2 order-1">
					<div class="image_selected"><img src="{{asset('public/Files/product/'.$product->thumbnail)}}" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category">{{$product->category->category_name}} > {{$product->subcategory->subcategory_name}}</div>
						<div class="product_name" style="font-size: 18px">{{$product->name}}</div>
						<div style="font-size: 18px"> brand: {{$product->brand->brand_name}}</div>
						<div style="font-size: 18px"> Stock: {{$product->stock_quantity}}</div>
						<div style="font-size: 18px">Unit: {{$product->unit}}</div>
						<div class="rating_r rating_r_4 product_rating">
							@if ($sum_rating != NULL)
									@if (intval($sum_rating/5)==5)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									@elseif (intval($sum_rating/$count_rating)>=4 && (intval($sum_rating/5))<$count_rating)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star "></span>
									@elseif (intval($sum_rating/$count_rating)>=3 && (intval($sum_rating/5))<$count_rating)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									@elseif (intval($sum_rating/$count_rating)>=2 && (intval($sum_rating/5))<$count_rating)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									@elseif (intval($sum_rating/$count_rating)>=1 && (intval($sum_rating/5))<$count_rating)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									@endif
								@endif	
						</div>

						@if ($product->discount_price==NULL)
						<div class="product_price"style="margin-top: 25px">{{$setting->currency}}{{$product->selling_price}}</div>
						@else
						<div class="product_price" style="margin-top: 25px"><del class="text-danger">{{$setting->currency}}{{$product->selling_price}}</del> {{$setting->currency}}{{$product->discount_price}}</div>
						@endif
						
						<div class="order_info d-flex flex-row">
							<form action="{{route('add.to.cart.quickview')}}" method="post" id="add_to_cart">
							@csrf
							<input type="hidden" name="id" value="{{$product->id}}">
							@if ($product->discount_price==NULL)
							<input type="hidden" name="price" value="{{$product->selling_price}}">
							@else
							<input type="hidden" name="price" value="{{$product->discount_price}}">
							@endif
							
								<div class="form-group">
									<div class="row">
										@isset($product->size)
										<div class="col-lg-6">
											<label for="">size</label>
											<select class="form-control form-control-sm"style="min-width: 120px" name="size">
												@foreach ($size as $size)
												<option value="{{$size}}">{{$size}}</option>
												@endforeach
											</select>
										</div>
										@endisset
										@isset($product->color)
										<div class="col-lg-6">
											<label for="">Color</label>
											<select class="form-control form-control-sm"style="min-width: 120px" name="color">
												@foreach ($color as $color)
												<option value="{{$color}}">{{$color}}</option>
												@endforeach
											</select>
										</div>
										@endisset
									</div>
									<div class="row">
										<div class="col-lg-3"></div>
										<div class="col-lg-3">
											<label for="">Qunatity</label>
											<input type="number" min="1" max="100" name="qty" class="form-control form-control-sm"style="min-width: 120px" value="1">
										</div>
									</div>
								</div>
								<br>
								{{-- <div class="clearfix" style="z-index: 1000;">
									
									<!-- Product Quantity -->
									<div class="product_quantity clearfix ml-2">
										<span>Quantity: </span>
										<input id="quantity_input" type="text" name="qty" pattern="[1-9]*" value="1">
										<div class="quantity_buttons">
											<div  class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
											<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
										</div>
									</div>
								</div> --}}

								
								<div class="button_container">
									<div class="input-group mb-3">
										<div class="input-group-pretend">
											@if ($product->stock_quantity<1)
											<button disabled="" class="btn btn-outline-danger">Stock Out</button>
											@else
											<button type="submit" class="btn btn-outline-info"><span class="loading d-none">...</span> Add to Cart <i class="fas fa-shopping-cart"></i></button>
											@endif
											<a href="{{route('add.wishlist',$product->id)}} " class="btn btn-outline-primary" type="button">add to wishlist <i class="fas fa-heart"></i></a>
										</div>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3 order-3" style="border-left: 1px solid gray; padding-left:10px;">
					<strong class="text-muted">Pickup Point of this Product</strong><br>
					<i class="fa fa-map"> {{$product->pickuppoint->pickup_point_name}}</i><hr><br>
					<strong class="text-muted">Home Delivery : </strong><br>
					->(4-8) days after the order placed. <br>
					->cash on Delivery Available. <hr><br>
					<strong class="text-muted">Product Return & Warranty :</strong><br>
					-> 7 days return guarranty. <br>
					-> warranty not available. <hr><br>
					@isset($product->video)
					<strong>Product Video: </strong>
					<iframe width="340" height="205" src="https://www.youtube.com/embed/{{$product->video}}" title="Youtube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"allowfullscreen></iframe>
					@endisset
				</div>
			</div><br><br>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h4>Product details of {{$product->name}}</h4>
						</div>
						<div class="card-body">
							{!! $product->description !!}
						</div>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header">
							<h4>Rating & Review of {{$product->name}}</h4>
						</div>
					
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3">
									Average Review of {{$product->name}}: <br>
								@if ($sum_rating != NULL)
									@if (intval($sum_rating/5)==5)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									@elseif (intval($sum_rating/$count_rating)>=4 && (intval($sum_rating/5))<$count_rating)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star "></span>
									@elseif (intval($sum_rating/$count_rating)>=3 && (intval($sum_rating/5))<$count_rating)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									@elseif (intval($sum_rating/$count_rating)>=2 && (intval($sum_rating/5))<$count_rating)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									@elseif (intval($sum_rating/$count_rating)>=1 && (intval($sum_rating/5))<$count_rating)
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									<span class="fa fa-star "></span>
									@endif
								@endif	
								</div>
								<div class="col-md-6">
									Average Review of {{$product->name}}: <br>
									<div>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span> Total:{{$review_5}}</span>
									</div>
									<div>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star "></span>
										<span> Total:{{$review_4}}</span>
									</div>
									<div>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star "></span>
										<span class="fa fa-star "></span>
										<span> Total:{{$review_3}}</span>
									</div>
									<div>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star "></span>
										<span class="fa fa-star "></span>
										<span class="fa fa-star "></span>
										<span> Total:{{$review_2}}</span>
									</div>
									<div>
										<span class="fa fa-star  text-warning"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span> Total:{{$review_1}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="{{ route('review.store')}}" method="POST">
						@csrf
						<div class="form-group">
							<label for="details">Write Your Review</label>
							<textarea type="text"name="review" class="form-control" cols="20" rows="5" required></textarea>
						</div>
						<input type="hidden" name="product_id" value="{{$product->id}}">
						<div class="form-group">
							<label for="rating">Write Your Review</label>
							<select name="rating" class="custom-select form-control-sm" style="min-width: 120px" id="">
								<option disabled="" selected="select your Review"></option>
								<option value="1">1 star</option>
								<option value="2">2 star</option>
								<option value="3">3 star</option>
								<option value="4">4 star</option>
								<option value="5">5 star</option>
							</select>
						</div>
						@if (Auth::check())
						<button type="submit" class="btn btn-sm btn-info"><span class="fa fa-star"></span> Submit Review</button>
						@endif
						<p>Please at first login to your account for submit a review</p>
					</form>
				</div>
				<br>
				{{-- All review of this product --}}
				
				<strong>All review of {{$product->name}}</strong><hr>
				<div class="row">
					@foreach ($review as $row )
						<div class="card col-lg-5 m-4">
							<div class="card-header">
								{{$row->user->name}} ({{date('d  F , Y'), strtotime($row->review_date)}})
							</div>
							<div class="card-body">
								{{$row->review}}
								@if ($row->rating==5)
								<div>
									<span class="fa fa-star  text-warning"></span>
									<span class="fa fa-star  text-warning"></span>
									<span class="fa fa-star  text-warning"></span>
									<span class="fa fa-star  text-warning"></span>
									<span class="fa fa-star  text-warning"></span>
								</div>
								@elseif ($row->rating==4)
								<div>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star "></span>
								</div>
								@elseif ($row->rating==3)
								<div>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</div>
								@elseif ($row->rating==2)
								<div>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</div>
								@elseif ($row->rating==1)
								<div>
									<span class="fa fa-star text-warning"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</div>
								@endif
							</div>
						</div>						
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Related Product</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">
						
						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">
							@foreach ($related_product as $row)
							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{asset('public/Files/product/'.$row->thumbnail)}}" alt="{{$row->name}}"></div>
									<div class="viewed_content text-center">
										@if ($product->discount_price==NULL)
											<div  class="viewed_price">{{$setting->currency}}{{$product->selling_price}}</div>
											@else
												<div class="viewed_price">{{$setting->currency}}{{$product->selling_price}}<span>{{$setting->currency}}{{$product->discount_price}}</span></div>
											@endif
											<div class="viewed_name"><a href="{{route('product.details',$row->slug)}}">{{substr($row->name,0,20)}}</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">new</li>
										
									</ul>
								</div>
							</div>
							@endforeach
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="brands_slider_container">
						
						<!-- Brands Slider -->

						<div class="owl-carousel owl-theme brands_slider">
							
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('public/frontend')}}/images/brands_2.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('public/frontend')}}/images/brands_3.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('public/frontend')}}/images/brands_4.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('public/frontend')}}/images/brands_5.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('public/frontend')}}/images/brands_6.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('public/frontend')}}/images/brands_1.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('public/frontend')}}/images/brands_7.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('public/frontend')}}/images/brands_8.jpg" alt=""></div></div>

						</div>
						
						<!-- Brands Slider Navigation -->
						<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="{{asset('public/frontend')}}/images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 
<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
{{--
<script src="{{asset('public/frontend/js/product_custom.js')}}"></script>
<script src="{{asset('public/frontend/js/custom.js')}}"></script> --}}

<script>
	
// store coupon with ajax call
$('#add_to_cart').submit(function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url:url,
                type: 'Post',
                async: false,
                data:request,
                success:function(data){
                    toastr.success(data);
                    $('#add_to_cart')[0].reset();
					cart();
                }
         });
    });

</script>
@endsection