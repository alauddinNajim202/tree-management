<div class="item item-carousel">
    <div class="products">
        <div class="modern-card">
            <div class="product-image">
                <div class="image">
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}">
                    </a>
                </div>
                <!-- /.image -->

                @if($product->stock <= 0)
                    <div class="modern-badge out-of-stock" style="background: #dc3545;"><span>stock out</span></div>
                @elseif($product->is_featured)
                    <div class="modern-badge hot"><span>hot</span></div>
                @else
                    <div class="modern-badge new"><span>new</span></div>
                @endif
            </div>
            <!-- /.product-image -->

            <div class="product-info text-left">
                <h3 class="name"><a href="{{ route('product.detail', $product->slug) }}">
                    {{ $product->name ?? '' }}
                </a>
                </h3>
                <div class="rating rateit-small"></div>
                <div class="description"></div>
                <div class="product-price"> 
                    @if($product->discount_price)
                        <span class="price"> ${{ $product->discount_price }} </span>
                        <span class="price-before-discount">$ {{ $product->price }}</span>
                    @else
                        <span class="price"> ${{ $product->price }} </span>
                    @endif
                </div>
                <!-- /.product-price -->

            </div>
            <!-- /.product-info -->
            <div class="cart clearfix animate-effect">
                <div class="action">
                    <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline-block; margin: 0;">
                                    @csrf
                                    <button class="btn btn-primary icon" type="submit"> 
                                        <i class="fa fa-shopping-cart"></i> 
                                    </button>
                                    <button class="btn btn-primary cart-btn" type="submit">Add to cart</button>
                                </form>
                            @else
                                <button class="btn btn-danger icon disabled" type="button" disabled> 
                                    <i class="fa fa-ban"></i> 
                                </button>
                                <button class="btn btn-danger cart-btn disabled" type="button" disabled>Stock Out</button>
                            @endif
                        </li>
                        <li class="lnk wishlist"> 
                            <a class="add-to-cart" href="{{ route('wishlist.add', $product->id) }}" title="Wishlist"> 
                                <i class="icon fa fa-heart"></i> 
                            </a> 
                        </li>
                        <li class="lnk"> 
                            <a data-toggle="tooltip" class="add-to-cart" href="{{ route('compare.add', $product->id) }}" title="Compare"> 
                                <i class="fa fa-signal" aria-hidden="true"></i>
                            </a> 
                        </li>
                    </ul>
                </div>
                <!-- /.action -->
            </div>
            <!-- /.cart -->
        </div>
        <!-- /.product -->
    </div>
    <!-- /.products -->
</div>
<!-- /.item -->
