@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend')}}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend')}}/styles/cart_responsive.css">
    @include('layouts.user_partial.collapse_nav')

    <!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart_container">
						<div class="cart_title text-center" >Billing Address</div>     
                        <form action="{{route('order.place')}}"method="post" id="order-place">
                            @csrf
                            <div class=" row p-4">
                                <div class="form-group col-lg-6">
                                    <label for="">Coutomer Name</label>
                                    <input type="text" class="form-control"value="{{Auth::user()->name}}" name="c_name" required="">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Customer Phone</label>
                                    <input type="text" class="form-control"value="{{Auth::user()->phone}}" name="c_phone" required="">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Shipping Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_address" required="">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Country <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_country" required="">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Email Address</label>
                                    <input type="email" class="form-control" name="c_email" >
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Zip Code</label>
                                    <input type="text" class="form-control" name="c_zipcode" required="" >
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">City Name</label>
                                    <input type="text" class="form-control" name="c_city" required="" >
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Extra Phone</label>
                                    <input type="text" class="form-control" name="c_extra_phone" required="" >
                                </div>
                            </div>
                            <strong>Payment Type</strong><br><hr>
                            <div class="row">
                                <div class="form-group col-lg-3">
                                    <label for="">Paypal</label>
                                    <input type="radio" class="form-control" name="payment_type"value="paypal">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="">SSL Commerze</label>
                                    <input type="radio" class="form-control" name="payment_type"value="SSL Commerze">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="">Cash On Delivery</label>
                                    <input type="radio" class="form-control" name="payment_type"value="Cash on delivery" checked="">
                                </div>
                              
                            </div>
                            <div class="form-group">
                                <button type="submit"class="btn btn-info  p-2">Order place</button>
                            </div>
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden pl-2 d-none">Progressing...</span>
                             </div>
                        </form>
					</div>
				</div>
                <div class="col-lg-4" style="margin-top: 100px">
                    <!-- Order Total -->
                   <div class="card">
                       <div class="pl-4 pt-2">
                           <p style="color: black;">Subtotal:<span style="float: right; padding-right:10px"> {{Cart::subtotal()}}{{$setting->currency}}</span></p>
                           @if (Session::has('coupon'))
                            <p style="color: black">coupon: ({{Session::get('coupon')['name']}}) <a href="{{route('coupon.remove')}}" class="text-danger"> X</a><span style="float: right; padding-right:10px">{{Session::get('coupon')['discount']}}{{$setting->currency}}</span></p>
                           @else
                           @endif 
                           <p style="color: black">Tax: <span style="float: right; padding-right:10px">0.00 %</span></p>
                           <p style="color: black">Shipping:<span style="float: right; padding-right:10px">00.00{{$setting->currency}}</span></p>
                           @if (Session::has('coupon'))
                           <p style="color: black"><b>Total: <span style="float: right; padding-right:10px">{{Session::get('coupon')['after_discount']}}{{$setting->currency}}</span></b></p>
                           @else
                           <p style="color: black"><b>Total: <span style="float: right; padding-right:10px">{{Cart::total()}}{{$setting->currency}}</span></b></p>
                           @endif
                           <hr>
                        </div>
                       @if (!Session::has('coupon'))
                       <form action="{{route('apply.coupon')}}"method="POST">
                        @csrf
                           <div class="p-4">
                               <div class="form-group">
                                   <label for="">Coupon Apply</label>
                                   <input type="text" class="form-control" name="coupon" required="" placeholder="Coupon Code">
                               </div>
                               <div class="form-group">
                                   <button type="submit"class="btn btn-info">Apply Coupon</button>
                               </div>
                           </div>
                       </form>
                       @endif
                   </div>
                    <div class="cart_buttons">
                        <a href="{{route('checkout')}}" class="button cart_button_checkout">Payment Now</a>
                    </div>
                </div>
			</div>
		</div>
	</div>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">

    $('body').on("click","#removeProduct", function(){
        let id = $(this).data('id');
        $.ajax({
            url: '{{url('/cartproduct/remove')}}/'+id,
            type: 'get',
            async: false,
            success: function(data){
                toastr.success(data),
                location.reload();
            }
        });

     });
    //  qty update with ajax
     $('body').on("blur",".qty", function(){
        let qty =$(this).val();
        let rowId =$(this).data('id');
        $.ajax({
            url: '{{url('/cartproduct/updateqty')}}/'+rowId+'/'+qty,
            type: 'get',
            async: false,
            success: function(data){
                toastr.success(data),
                location.reload();
            }
        });

     });

     //  color update with ajax
     $('body').on("blur",".color", function(){
        let color =$(this).val();
        let rowId =$(this).data('id');
        $.ajax({
            url: '{{url('/cartproduct/updatecolor')}}/'+rowId+'/'+color,
            type: 'get',
            async: false,
            success: function(data){
                toastr.success(data),
                location.reload();
            }
        });

     });

      //  Size update with ajax
      $('body').on("blur",".size", function(){
        let size =$(this).val();
        let rowId =$(this).data('id');
        $.ajax({
            url: '{{url('/cartproduct/updatesize')}}/'+rowId+'/'+size,
            type: 'get',
            async: false,
            success: function(data){
                toastr.success(data),
                location.reload();
            }
        });

     });

  
  </script>
@endsection
