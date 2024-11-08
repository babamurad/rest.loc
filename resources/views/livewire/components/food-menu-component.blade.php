<section class="fp__menu mt_95 xs_mt_65">

    <script>
        window.addEventListener('show-modal', event => {
            $('#cartModal').modal('show');
        });
        window.addEventListener('close-modal', event => {
            $('#cartModal').modal('hide');
        });
        /*document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('show-modal', event => {
                const modalElement = new bootstrap.Modal(document.getElementById('cartModal'));
                modalElement.show();
            });
        });*/


    </script>

    <!-- CART POPUT START -->
{{--    {{ $product->offer_price? $product->offer_price : $product->price }}--}}
    <div class="fp__cart_popup">
        <div wire:ignore.self class="modal fade"
             id="cartModal" tabindex="-1" aria-hidden="true"
             wire:loading.class="d-none"
             wire:target="getProduct"
             x-data="{ totalSummary: 0,
             selectedSizePrice: 0, checkedOptions: [], option :0,
             summa : 0,
             count : 1,
             getTotalOptionPrice() {
            // Calculate the total price of selected options
            let totalOptionPrice = 0;
            for (const option of this.checkedOptions) {
              totalOptionPrice += parseFloat(option); // Ensure number conversion
            }
            return totalOptionPrice;
          }
          }"

        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fal fa-times"></i></button>
                        <div class="fp__cart_popup_img">
                            <img src="{{ $product->thumb_image }}" alt="menu" class="img-fluid w-100">
                        </div>
                        <div class="fp__cart_popup_text">
                            <a href="#" class="title">{{ $product->name }}</a>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <span>(201)</span>
                            </p>
                            @if($product->offer_price)
                                <h4 class="price" x-bind="totalSummary={{ $product->offer_price }}">${{ $product->offer_price }} <del>${{ $product->price }}</del> </h4>
                            @else
                                <h4 class="price" x-bind="totalSummary={{ $product->price }}">${{ $product->price }}</h4>
                            @endif
                            <p x-text="totalSummary"></p>

                            <div class="details_size">
                                <h5>select size</h5>
                                @foreach($product->sizes as $size)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                               {{ $loop->index == 0 ? 'checked' : '' }}
                                               id="size-{{$size->id}}"
                                               value="{{ $size->price }}"
                                               @change="selectedSizePrice={{ (float) $size->price }}">
                                        <h6 class="form-check-label" for="size-{{$size->id}}">
                                            {{ Str::words($size->name, 1, '') }} <span>+ ${{ $size->price }}</span>
                                        </h6>
                                    </div>
                                @endforeach
                            </div>

                            <div class="details_extra_item">
                                <h5>select option <span>(optional)</span></h5>
                                @foreach($product->options as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               value="{{ $option->price }}"
                                               id="option-{{ $option->id }}"
                                               x-model="checkedOptions"
                                               >
                                        <h6 class="form-check-label" for="option-{{ $option->id }}">
                                            {{ Str::words($option->name, 1, '') }} <span x-model="option">+ ${{ $option->price }}</span>
                                        </h6>
                                    </div>
                                @endforeach
                            </div>

                            <div class="details_quentity">
                                <h5>select quentity</h5>
                                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                    <div class="quentity_btn">
                                        <button class="btn btn-danger" @click="if (count > 1) count--"><i class="fal fa-minus"></i></button>
                                        <input type="text"  x-model="count">
                                        <button class="btn btn-success" @click="count++"><i class="fal fa-plus"></i></button>
                                    </div>
                                    <h3><span x-text="summa=((totalSummary + selectedSizePrice) * count + getTotalOptionPrice()).toFixed(2)"></span></h3>
                                </div>
                            </div>
                            <ul class="details_button_area d-flex flex-wrap">
                                <li><a class="common_btn" href="#">add to cart</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CART POPUT END -->

    <div class="container">
        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                <div class="fp__section_heading mb_45">
                    <h4>food Menu</h4>
                    <h2>Our Popular Delicious Foods</h2>
                    <span>
                            <img src="{{ asset('assets/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                        </span>
                    <p>Objectively pontificate quality models before intuitive information. Dramatically
                        recaptiualize multifunctional materials.</p>
                </div>
            </div>
        </div>

        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-12">
                <div class="menu_filter d-flex flex-wrap justify-content-center">
                    <button class=" active" data-filter="*">all menu</button>
                    @foreach($categories as $category)
                        <button data-filter=".{{ $category->name }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row grid">
            @foreach($products as $product)
                <div class="col-xl-3 col-sm-6 col-lg-4 {{ $product->category->name }} wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_item">
                        <div class="fp__menu_item_img">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100">
                            <a class="category" href="#">{{ $product->category->name }}</a>
                        </div>
                        <div class="fp__menu_item_text">
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <span>10</span>
                            </p>
                            <a class="title" href="{{ route('product-details', ['slug' => $product->slug]) }}" wire:navigate>{{ $product->name }}</a>
                            <h5 class="price">
                                @if($product->offer_price > 0)
                                    {{ $product->offer_price }} {{ $setting->value }}
                                    <del>{{ $product->price }}{{ $setting->value }}</del>
                                @else
                                    ${{ $product->price }}
                                @endif
                            </h5>
{{--                            wire:click="openModal({{ $product->id }})"--}}
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a href="javascript:;"  data-bs-toggle="modal" data-bs-target="#cartModal" wire:click="getProduct({{ $product->id }})">
                                        <i class="fas fa-shopping-basket"></i></a>
                                </li>
                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                <li><a href="#"><i class="far fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</section>
