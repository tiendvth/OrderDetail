<!DOCTYPE html>
<html>
@include('.client.layout.head')
<body>
<!-- HEADER =============================-->
@include('.client.layout.header')
<!-- CONTENT =============================-->
<section class="item content">
    <div class="container toparea">
        <div class="underlined-title">
            <div class="editContent">
                <h1 class="text-center latestitems">SHOPING CART</h1>
            </div>
            <div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
            </div>
        </div>
        <div class="row">
            @foreach($list as $item)
                <div id="cart_item{{$item->id}}" class="col-12" style="height: 160px;margin-bottom: 8px;box-shadow: 1px 3px 6px">
                    <div class="show_thumbnail" style="height: 100%;width: 160px;float: left;">
                        <img style="width: 100%;height: 100%;object-fit: cover"
                             src="{{$item->thumbnail}}"
                             alt="...">
                    </div>
                    <div class="col row" style="height: 100%">
                        <div class="col-md-8">
                            <strong style="font-size: 14px;margin-bottom: 2px">#{{$item->id}}</strong><br>
                            <p style="font-size: 14px;margin-bottom: 2px"><strong>Product name
                                    :</strong> {{$item->product_name}}</p>
                            <p style="margin-bottom: 2px;margin-top: 0;font-size: 14px"><strong>Price / 1product
                                    :</strong> <span style="color: #f44848;font-weight: bold">${{$item->price}}</span>
                            </p>
                            <p style="font-size: 14px;margin-bottom: 2px"><strong>Quantity : </strong><input
                                    class="{{$item->id}}"
                                    style="font-weight: bold;border: none;box-shadow: 0 0 3px;border-radius: 5px"
                                    type="number" min="1" max="10000" step="1" value="{{$item->quantity}}"></p>
                            <p style="font-size: 14px;margin-bottom: 2px"><strong>Total price : </strong><span
                                    style="font-weight: bold;color: #f44848" class="price{{$item->id}}">${{$item->quantity*$item->price}}</span>
                            </p>
                            <p style="font-size: 14px ;margin-bottom: 2px; width: 100%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">
                                <strong>Description</strong> : {{$item->description}}?</p>
                        </div>
                        <div style="height: 100%">
                            <button slot="{{$item->id}}" class="btn btn-info update_cart"
                                    style="display: block;margin:10px auto;width: 120px">Update
                            </button>
                            <button class="btn btn-warning" style="display: block;margin:10px auto;width: 120px">Buy
                            </button>
                            <button slot="{{$item->id}}" class="btn btn-danger btn_remove_item" style="display: block;margin:10px auto;width: 120px">Remove
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @csrf
</section>
<!-- FOOTER =============================-->
@include('.client.layout.footer')
<!-- Load JS here for greater good =============================-->
@include('.client.layout.script')
</body>
</html>
