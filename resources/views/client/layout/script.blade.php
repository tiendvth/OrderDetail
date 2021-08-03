<script src="{{url('libs/js/jquery-.js')}}"></script>
<script src="{{url('libs/js/bootstrap.min.js')}}"></script>
<script src="{{url('libs/js/anim.js')}}"></script>
<script type="text/javascript"
        src="{{url('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js')}}"></script>
<script>
    //----HOVER CAPTION---//
    jQuery(document).ready(function ($) {
        $('.fadeshop').hover(
            function () {
                $(this).find('.captionshop').fadeIn(150);
            },
            function () {
                $(this).find('.captionshop').fadeOut(150);
            }
        );
    });

    $('.add_to_cart').click(function () {
        $('.item_shopping_cart').animate({top: "15px"})
        $('.item_shopping_cart').animate({top: "0"})
        $.post('{{route('add-to-cart')}}', {
            product_id: this.slot,
            _token: $('input[name = "_token"]').val()
        }, function (response) {
            $('.count_items').text(response.product_count)
        });
    })

    $(document).ready(function () {
        toastr.options = {
            'closeButton': true,
            'debug': false,
            'newestOnTop': false,
            'progressBar': false,
            'positionClass': 'toast-top-right',
            'preventDuplicates': false,
            'showDuration': '1000',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut',
        }
    });

    $('.update_cart').click(function () {
        let quantity = $(`.${this.slot}`).val()
        let id = this.slot
        $.post('{{route('add-to-cart')}}', {
            action: 'update',
            quantity: quantity,
            product_id: this.slot,
            _token: $('input[name = "_token"]').val()
        }, function (response) {
            if (response.code === 200) {
                toastr.success(`Update #${id} success`);
                $(`.price${id}`).text('$' + Number($(`.${id}`).val()) * Number(response.price))
            } else if (response.code === 401) {
                toastr.error(`Only ${response.quantity_product} products left`);
            } else {
                alert('Vui lòng kiểm tra lại kết nối')
            }
        });
    })
    $('.btn_remove_item').click(function () {
        let id = this.slot
        var a = confirm('Bạn có chắc chắn xóa sản phẩm này')
        if (a){
            $.post('{{route('remove_cart')}}', {
                product_id: id,
                _token: $('input[name = "_token"]').val()
            }, function (response) {
                if (response.code === 200) {
                    $(`#cart_item${id}`).remove()
                    $('.count_items').text(response.product_count)
                    toastr.info(response.message);
                }
            });
        }

    })
</script>
