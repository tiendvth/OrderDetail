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
                <h1 class="text-center latestitems">ALL PRODUCTS</h1>
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
            @foreach($products as $item)
            <div class="col-md-4">
                <div class="productbox" style="width: 100%">
                    <div class="fadeshop" style="width: 100%">
                        <div class="captionshop text-center" style="display: none;height: 100%;">
                            <h3>#{{$item->id}}</h3>
                            <p>
                                {{$item->description}}
                            </p>
                            <p style="float: bottom">
                                <a slot="{{$item->id}}" class="learn-more add_to_cart detailslearn"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                <a href="#" class="learn-more detailslearn"><i class="fa fa-link"></i> Details</a>
                            </p>
                        </div>
                        <span class="maxproduct" style="width: 100%"><img style="height: 300px;width:100%;object-fit: cover" src="{{$item->thumbnail}}" alt=""></span>
                    </div>
                    <div class="product-details">
                        <a href="#">
                            <h1>{{$item->product_name}}</h1>
                        </a>
                        <span class="price">
					<span class="edd_price text-danger" style="font-weight: bold">$ {{$item->price}}</span>
					</span>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-12" style="display: flex;justify-content: center">
                {{$products->links()}}
            </div>
        </div>
    </div>
    </div>
</section>
@csrf
<!-- FOOTER =============================-->
@include('.client.layout.footer')
<!-- Load JS here for greater good =============================-->
@include('.client.layout.script')

</body>
</html>
