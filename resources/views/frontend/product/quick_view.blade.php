@php
$color = explode(',',$product->color);
$size = explode(',',$product->size);
@endphp
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="">
                    <img src="{{asset('public/Files/product/'.$product->thumbnail)}}" height="100%" width="100%" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <h3>{{$product->name}}</h3>
                <p>{{$product->category->category_name}} > {{$product->subcategory->subcategory_name}}</p>
                <p>Brand:  {{$product->brand->brand_name}}</p>
                <p>Stock:   
                    @if ($product->stock_quantity<1)
                        <span class="badge badge-danger">stock Out</span>
                    @else
                        <span class="badge badge-success">stock available</span>
                    @endif</p>
                 <div>
                <p>Description: {!! $product->description !!}</p>
                <div style="margin-top: -50px">
                    Price: @if ($product->discount_price==NULL)
                            <div class="product_price">{{$setting->currency}}{{$product->selling_price}}</div>
                            @else
                            <div class="product_price"><del class="text-danger">{{$setting->currency}}{{$product->selling_price}}</del> {{$setting->currency}}{{$product->discount_price}}</div>
                           @endif
                </div><br> 
                <div class="order_info d-flex flex-row"style="margin-top: -10px">
                    <form action="{{route('add.to.cart.quickview')}}" method="POST" id="add_cart_form">
                        @csrf
                        {{-- cart add details --}}
                        <input type="hidden" name="id" value="{{$product->id}}">
                        @if ($product->discount_price==NULL)
                        <input type="hidden" name="price" value="{{$product->selling_price}}">
                        @else
                        <input type="hidden" name="price" value="{{$product->discount_price}}">
                        @endif
                        <div>
                            Qunatity: <input type="number" min="1" max="100" name="qty" class="form-control-sm" value="1">
                        </div>
                        <br>
                        <div class="row">
                            @isset($product->size)
                            <div class="col-lg-5">
                                <label for="">Size:</label>
                                <select class="form-control form-control-sm"style="min-width: 120px;  margin-left: -4px;" name="color">
                                    @foreach ($size as $size)
                                    <option value="{{$size}}">{{$size}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endisset
                            @isset($product->color)
                            <div class="col-lg-5">
                                <label for="">Color:</label>
                                <select class="form-control form-control-sm"style="min-width: 120px; margin-left: -4px;" name="color">
                                    @foreach ($color as $color)
                                    <option value="{{$color}}">{{$color}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endisset
                        </div>
                        <div class="button_container">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    @if ($product->stock_quantity<1)
                                    <span class="text-danger">Stock Out</span>
                                    @else
                                    <button class="btn btn-sm btn-outline-info"type="submit"><span class="loading d-none">...</span>  Add to cart</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    // store coupon with ajax call
$('#add_cart_form').submit(function(e){
            e.preventDefault();
            $('.loading').removeClass('d-none');
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url:url,
                type: 'Post',
                async: false,
                data:request,
                success:function(data){
                    toastr.success(data);
                    $('.loading').addClass('d-none');
                    $('#add_cart_form')[0].reset();
                    cart();
                }
         });
    });

</script>