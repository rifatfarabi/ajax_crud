<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script>
$(document).ready(function() {
    $(document).on('click','.save_product', function(e){
        e.preventDefault();
        let name = $('#name').val();
        let price = $('#price').val();
        // console.log(name+price);

        $.ajax({
            url:"/product/add",
            // url:"{{ route('add.product') }}",
            method:'POST',
            data:{name:name,price:price},
            success:function(res){
                if(res.status == 'success'){
                    $('#exampleModal').modal('hide');
                    $('#addProductForm')[0].reset();
                }
            },error:function(err){
                let error = err.responseJSON;
                $.each(error.errors,function(index, value){
                    if ('.errorMessage') {
                        '<span class="text-danger">'+value+'</span>'+'<br>';
                    } else {
                        '<span class="text-danger">'+value+'</span>'+'<br>';
                    }
                //    $('.errorMessage').append('<span class="text-danger">'+value+'</span>'+'<br>');
                });
            }
        });
    });

    $(document).on('click','.update_product_form', function(){
        let id = $(this).data('id');
        let name = $(this).data('name');
        let price = $(this).data('price');

        $('#up_id').val(id);
        $('#up_name').val(name);
        $('#up_price').val(price);
    });


    //Update Product
    $(document).on('click','.update_product', function(e){
        e.preventDefault();
        let up_id = $('#up_id').val();
        let up_name = $('#up_name').val();
        let up_price = $('#up_price').val();
        // console.log(name+price);

        $.ajax({
            url:"{{ route('update.product') }}",
            method:'POST',
            data:{up_id:up_id,up_name:up_name,up_price:up_price},
            success:function(res){
                if(res.status == 'success'){
                    $('#updateModal').modal('hide');
                    $('#updateProductForm')[0].reset();
                }
            },error:function(err){
                let error = err.responseJSON;
                $.each(error.errors,function(index, value){
                    if ('.errorMessage') {
                        '<span class="text-danger">'+value+'</span>'+'<br>';
                    } else {
                        '<span class="text-danger">'+value+'</span>'+'<br>';
                    }
                //    $('.errorMessage').append('<span class="text-danger">'+value+'</span>'+'<br>');
                });
            }
        });
    });

});
</script>
