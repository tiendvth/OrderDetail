<nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Welcome</span>
            </button>
            <a href="index.html" class="navbar-brand brand">SHOPING </a>
        </div>
        <div id="navbar-collapse-02" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
{{--                <li class="propClone"><a href="index.html">Home</a></li>--}}
                <li class="propClone"><a href="{{route('show_all_product')}}">Shop</a></li>
{{--                <li class="propClone"><a href="product.html">Product</a></li>--}}
{{--                <li class="propClone"><a href="checkout.html">Checkout</a></li>--}}
{{--                <li class="propClone"><a href="contact.html">Contact</a></li>--}}
                <li class="propClone item_shopping_cart"><a href="{{route('show_shopping_cart')}}" class="go_to_shopping_cart" >Shopping cart <i class="fa fa-shopping-cart"></i> <span class="count_items">{{$product_count}}</span></a></li>
            </ul>
        </div>
    </div>
</nav>
