@extends('frontend.layouts.account')

@section('content')
<h2 class="text-center">My Wishlist History</h2>
<div class="items_wishlist">
    <div class=" my-4">
        <div class="table-reponsive box">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Wishlist Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!blank($wishlists))
                        @foreach ($wishlists as $wishlist)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$wishlist->name}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('wishlist.details',$wishlist->name)}}" class="artha-product-list-btn save_adddress w_history me-3">View Detail</a>
                                        <button type="button" class="artha-product-list-btn save_adddress w_history btn" data-id="{{$wishlist->id}}" data-name="{{$wishlist->name}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            Edit Name
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wishlist_history">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6 class="text-center">Edit Your Wishlist Name</p>
            <input type="text" name="wishlist_name" class="form-control" id="Name" value="">
            <div class="d-flex justify-content-center modal_btn">
                <input type="hidden" name="wishlist_id" class="wishlist_id" value="">
                <a href="javascript:void(0);" class="artha-product-list-btn save_adddress update_wishlist me-3">Update</a>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $(document).on('click','.w_history',function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#Name').val(name);
            $('.wishlist_id').val(id);
        });
        $(document).on('click','.update_wishlist',function(){
            var name = $('#Name').val();
            var id = $('.wishlist_id').val();
            if(name == ''){
                $('.nameError').html('Please enter wishlist name.')
            }
            $.ajax({
                url : "{{route('wishlist.update')}}",
                data : {"_token": "{{ csrf_token() }}",'name':name,'id':id},
                type : 'POST',
                dataType:'json',
                success : function(data) {
                    Swal.fire({
                        title: 'Updated!',
                        text: "Wishlist name has been submitted successfully.",
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
    });
</script>
@endsection
