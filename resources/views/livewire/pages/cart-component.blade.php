<div>
    BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('assets/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>cart view</h1>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#">cart view</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CART VIEW START
    ==============================-->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp"
                     data-wow-duration="1s">
                    @if($cartProducts->count() > 0)
                        <div class="fp__cart_list">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                    <tr>
                                        <th class="fp__pro_img">
                                            Image
                                        </th>

                                        <th class="fp__pro_name">
                                            details
                                        </th>

                                        <th class="fp__pro_status">
                                            price
                                        </th>

                                        <th class="fp__pro_select">
                                            quantity
                                        </th>

                                        <th class="fp__pro_tk">
                                            total
                                        </th>

                                        <th class="fp__pro_icon">
                                            <a class="clear_all" href="#" wire:click.prevent="clearAll">clear all</a>
                                        </th>
                                    </tr>
                                    @foreach($cartProducts as $product)
                                        <tr x-data="{
                                        productTotal: 0,
                                        productPrice: {{$product->price}},
                                        count: {{ $product->qty }},
                                        sizePrice: {{ $product->options['product_size']['price']?? 0 }},
                                        optionsPrice: 0,
                                        calculateTotal() {
                                            this.productTotal = (this.productPrice + this.sizePrice) * this.count + this.optionsPrice;
                                        }
                                        }"
                                            x-init="calculateTotal()"
                                            @change="calculateTotal()"
                                        >
                                            <td class="fp__pro_img">
                                                <img src="{{ asset($product->options->product_info['image']) }}" alt="{{ $product->name }}" class="img-fluid w-100">
                                            </td>

                                            <td class="fp__pro_name">
                                                <a href="{{ route('product-details', ['slug' => $product->options->product_info['slug']]) }}">{{ $product->name }}</a>
                                                @if($product->options['product_size']['name'])
                                                    <span>{{ $product->options['product_size']['name'] }} <small>({{ $product->options['product_size']['price'] }})man.</small></span>
                                                @endif
                                                @if($product->options['product_options'])
                                                    @foreach($product->options['product_options'] as $option)
                                                        <p>{{ $option['name'] }} <small x-init="optionsPrice += {{ $option['price'] }}; calculateTotal()">({{ $option['price'] . ' man.' }})</small></p>
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td class="fp__pro_status">
                                                @if($product->options['product_info']['offer_price'])
                                                    <h6>{{ $product->options['product_info']['offer_price'] }} <del class="text-danger"><small>{{ $product->options['product_info']['price'] }}</small></del></h6>
                                                @else
                                                    <h6>{{ $product->options['product_info']['price'] }}</h6>
                                                @endif
                                            </td>

                                            <td class="fp__pro_select">
                                                <div class="quentity_btn">
                                                    <button class="btn btn-danger" wire:click="decreaseQty('{{ $product->rowId }}')"><i class="fal fa-minus"></i></button>
                                                    <input type="text"  min="1" value="{{ $product->qty }}">
                                                    <button class="btn btn-success" wire:click="increaseQty({{ $product->id }}, '{{ $product->rowId }}')"><i class="fal fa-plus"></i></button>
                                                </div>
                                            </td>

                                            <td class="fp__pro_tk">
                                                <h6>{{ number_format($product->weight, 2) }}</h6>

                                            </td>
                                            <td class="fp__pro_icon">
                                                <a href="#" wire:click.prevent="deleteCartItem('{{ $product->rowId }}')"><i class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <h6>Список заказов пуст.</h6>
                    @endif
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <h6>{{__('total cart')}}</h6>
                        <p>{{__('subtotal')}}: <span>{{ number_format($cartTotalSum, 2) }} man.</span></p>
                        <p>{{__('delivery')}}: <span>{{ number_format($delivery, 2) }} man.</span></p>
                        <p>{{__('discount')}}: <span>{{ number_format($discount, 2) }} man.</span></p>
                        <p class="total"><span>{{__('total')}}:</span> <span>{{ number_format($cartTotalSum, 2) }} man.</span></p>
                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit">{{__('apply')}}</button>
                        </form>
                        <a class="common_btn" href="#">{{__('checkout')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CART VIEW END
    ==============================-->
</div>
