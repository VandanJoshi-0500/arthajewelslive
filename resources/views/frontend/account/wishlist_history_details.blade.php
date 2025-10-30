@extends('frontend.layouts.account')

@section('content')
    <div class="">
        <a href="{{route('wishlist_history')}}" class="artha-product-list-btn save_adddress w_history btn">Back</a>
    </div>
    @if (blank($wishlists))
        <div class="no_items_wishlist">
            <h5>You have no items in your wishlist.</h5>
        </div>
    @else
        <div class="items_wishlist">
            <div class="row row_product_listing my-4">
                @foreach ($wishlists as $item)
                <?php $product = DB::table('products')->where('id',$item->product_id)->first(); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col_product_listing">
                        <a href="{{route('product.details',$item->product->sku)}}" class=" text-center">
                            <div class="product_listing_box">
                                <?php
                                    if (substr($item->product->image, 0, 7) == "http://" || substr($item->product->image, 0, 8) == "https://") {
                                        $product_image = $item->product->image;
                                    }else{
                                        $product_image = URL::asset('products/'.$item->product->image);
                                    }
                                ?>
                                <img src="{{$product_image}}" alt="" class="img-fluid">
                                <p>{{$item->product->name}}</p>
                                <h6>€ @if(isset($item->product->price)){{$item->product->getPriceForCustomer()}} @else {{$item->product->special_price}} @endif</h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
