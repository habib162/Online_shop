@extends('layouts.app')
@section('content')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_responsive.css')}}"> --}}

@include('layouts.user_partial.collapse_nav')

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">{{$childcategory->childcategory_name}}</h2>
    </div>
</div>
{{-- brands --}}
<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">
                    <div class="owl-carousel owl-theme brands_slider">
                        @foreach ($brand as $row)
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <a href="#" title="{{$row->brand_name}}"><img src="{{asset($row->brand_logo)}}" alt="{{$row->brand_name}}" height="50"width="40"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            @foreach ($category as $row)
                                <li><a href="{{route('categorywise.product',$row->id)}}">{{$row->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <div id="slider-range" class="slider_range"></div>
                            <p>Range: </p>
                            <p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
                        </div>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle color_subtitle">Color</div>
                        <ul class="colors_list">
                            <li class="color"><a href="#" style="background: #b19c83;"></a></li>
                            <li class="color"><a href="#" style="background: #000000;"></a></li>
                            <li class="color"><a href="#" style="background: #999999;"></a></li>
                            <li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
                            <li class="color"><a href="#" style="background: #df3b3b;"></a></li>
                            <li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span>{{count($product)}}</span> products found</div>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                                        <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product_grid row">
                        <div class="product_grid_border"></div>
                        @foreach($product as $row)
                            <div class="product_item is_new col-lg-3">
                                <div class="product_border"></div>
                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('public/Files/product/'.$row->thumbnail)}}"height="100%" alt=""></div>
                                <div class="product_content">
                                    @if ($row->discount_price==NuLL)
                                    <div class="product_price">{{$setting->currency}}{{$row->selling_price}} </div>
                                    @endif
                                    <div class="product_price">{{$setting->currency}}{{$row->discount_price}} <span>{{$setting->currency}}{{$row->selling_price}}</span> </div>
                                    <div class="product_name"><div><a href="{{route('product.details',$row->slug)}}" tabindex="0">{{$row->name}}</a></div></div>
                                    {{-- <div><button class="btn btn-success">Add to cart</button></div> --}}
                                </div>
                                <a href="{{route('add.wishlist',$row->id)}}">
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                </a>
                                <ul class="product_marks">
                                    <li class="product_mark product_new quick_view"data-toggle="modal" id="{{$row->id}}"data-target="#exampleModalCenter"><i class="fas fa-eye"></i></li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <!-- Shop Page Navigation -->

                    <div class="shop_page_nav d-flex flex-row">
                        <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
                        <ul class="page_nav d-flex flex-row">
                            {{$product->links()}}
                        </ul>
                        <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
                    </div>

                </div>
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
                    <h3 class="viewed_title">Products For you</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">
                    
                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">
                        @foreach ($random_product as $row)
                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{asset('public/Files/product/'.$row->thumbnail)}}" alt=""></div>
                                <div class="viewed_content text-center">
                                    @if ($row->discount_price==NULL)
                                    <div class="viewed_price">{{$setting->currency}}{{$row->selling_price}}</div>
                                    @else
                                        <div class="viewed_price">{{$setting->currency}}{{$row->discount_price}}<span>{{$setting->currency}}{{$row->selling_price}}</span></div>
                                    @endif
                                    <div class="viewed_name"><a href="{{route('product.details',$row->slug)}}">{{$row->name}}</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="quick_view_body">
            
        </div>
      </div>
    </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
// ajax request send for collect childcategory
$(document).on('click','.quick_view',function()
{
   var id = $(this).attr('id');
   $.ajax({
       url: "{{ url("/product-quick-view/") }}"+id,
       type: 'get',
       success: function(data){
          $("#quick_view_body").html(data);
       }
   });
});
</script>

@endsection