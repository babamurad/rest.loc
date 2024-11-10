<div class="fp__menu_cart_area">
    <div class="fp__menu_cart_boody">
        <div class="fp__menu_cart_header">
            <h5>total item ({{ $cartProducts->count() }})</h5>
            <span class="close_cart"><i class="fal fa-times"></i></span>
        </div>
        <ul>
            @foreach($cartProducts as $cartProduct)
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset($cartProduct->options->product_info['image']) }}" alt="{{ $cartProduct->name }}" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="{{ route('product-details', ['slug' => $cartProduct->options->product_info['slug']]) }}">{!! $cartProduct->name !!}</a>
                    <p class="size">Qty: {{ $cartProduct->qty }}</p>
{{--                    @if (isset($cartProduct->options->product_size) && isset($cartProduct->options->product_size['name'])) {--}}
                    <p class="size">{{ $cartProduct->options['product_size']['name'] }} <small>({{ $cartProduct->options['product_size']['price'] }} m.)</small></p>
{{--                    @endif--}}
{{--                    ['product_size']['name']--}}

                    @foreach($cartProduct->options['product_options'] as $option)
                    <span class="extra">{{ $option['name'] }} <small>({{ $option['price'] }} m.)</small></span>
                    @endforeach
                    <p class="price">{{ $cartProduct->options->product_info['offer_price'] }} tmt<del>{{ $cartProduct->options->product_info['price'] }} tmt</del></p>
                </div>
                <span class="del_icon" wire:click="deleteCartItem('{{ $cartProduct->rowId }}')"><i class="fal fa-times"></i></span>
            </li>
            @endforeach
            {{--<li>
                <div class="menu_cart_img">
                    <img src="{{ asset('assets/images/menu8.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Hyderabadi Biryani Component</a>
                    <p class="size">small</p>
                    <span class="extra">coca-cola</span>
                    <span class="extra">7up</span>
                    <p class="price">$99.00 <del>$110.00</del></p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>--}}
        </ul>
        <p class="subtotal">sub total <span>{{ number_format($cartTotalSum, 2)}} TMT</span></p>
        <a class="cart_view" href="cart_view.html"> view cart</a>
        <a class="checkout" href="check_out.html">checkout</a>
    </div>
</div>
