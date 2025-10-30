@extends('frontend.layouts.account')

@section('content')
    <h2 class="text-center">My Wishlist</h2>
    @if (blank($wishlists))
        <div class="no_items_wishlist">
            <h5>You have no items in your wishlist.</h5>
        </div>
    @else
        <div class="items_wishlist">
            <div class="row row_product_listing my-4">
                 <?php //echo '<pre>';print_r($wishlists);exit;?>
                @foreach ($wishlists as $item)
                    @if ($item->product)
                        <div class="col-lg-2 col-md-4 col-sm-6 col_product_listing">
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
                                    <a href="javascript:void(0);" class="artha-product-list-btn wishlist delete-item" data-id="{{$item->id}}"><i class="fa-solid fa-trash-can"></i>Remove</a>
                                </div>
                            </a>
                        </div>
                    @endif
                    
                @endforeach
            </div>
            <div class="d-flex justify-content-end">
                <button class="artha-product-list-btn submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-trash-can"></i>Submit</button>
            </div>
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered wishlist_history">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h6 class="text-center">Enter Your Wishlist Name</p>
                    <input type="text" name="wishlist_name" class="form-control" id="Name" value="{{Auth::user()->name.'-'.date('d-m-Y')}}">
                    <span class="text-danger nameError"></span>
                    <div class="d-flex justify-content-center modal_btn">
                        <a href="javascript:void(0);" class="artha-product-list-btn save_adddress submit_wishlist me-3">Submit</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
    @endif
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $(document).on('click','.submit_wishlist',function(){
            var name = $('#Name').val();
            if(name == ''){
                $('.nameError').html('Please enter wishlist name.')
            }
            $.ajax({
                url : "{{route('wishlist.submit')}}",
                data : {"_token": "{{ csrf_token() }}",'name':name},
                type : 'POST',
                dataType:'json',
                success : function(data) {
                    Swal.fire({
                        title: 'Submitted!',
                        text: "Wishlist items has been submitted successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            });
        });
        $(document).on('click','.delete-item',function(){
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : "{{route('delete.wishlist_item', '')}}"+"/"+id,
                        type : 'GET',
                        dataType:'json',
                        success : function(data) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: "Wishlist item has been deleted.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
