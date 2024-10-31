<section class="fp__menu mt_95 xs_mt_65" x-data="{ name: 'calebporzio' }">
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
                            <img src="{{ $product->thumb_image }}" alt="menu" class="img-fluid w-100">
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
                            <a class="title" href="menu_details.html">{{ $product->name }}</a>
                            <h5 class="price">
                                @if($product->offer_price > 0)
                                    ${{ $product->offer_price }}<del>{{ $product->price }}</del>
                                @else
                                    ${{ $product->price }}
                                @endif
                            </h5>
{{--                            data-bs-toggle="modal" data-bs-target="#cartModal"--}}
{{--                            wire:click="openModal({{ $product->id }})"--}}
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><button  data-bs-toggle="modal" data-bs-target="#cartModal" x-on:click="name = '{{$product->name}}'"><i
                                            class="fas fa-shopping-basket"></i></button></li>
                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                <li><a href="#"><i class="far fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Modal -->
{{--    @if($showModal)--}}
        <div class="fp__cart_popup">
            <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="fal fa-times"></i></button>
                            <div class="fp__cart_popup_img">
                                <img src="{{ asset('assets/images/menu1.png') }}" alt="menu" class="img-fluid w-100">
                            </div>
                            <div class="fp__cart_popup_text">
                                <a href="#" class="title" x-text="name"></a>
                                <p class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                    <span>(201)</span>
                                </p>
                                <h4 class="price">$320.00 <del>$350.00</del> </h4>

                                <div class="details_size">
                                    <h5>select size</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="large"
                                               checked>
                                        <label class="form-check-label" for="large">
                                            large <span>+ $350</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="medium">
                                        <label class="form-check-label" for="medium">
                                            medium <span>+ $250</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="small">
                                        <label class="form-check-label" for="small">
                                            small <span>+ $150</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="details_extra_item">
                                    <h5>select option <span>(optional)</span></h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="coca-cola">
                                        <label class="form-check-label" for="coca-cola">
                                            coca-cola <span>+ $10</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="7up">
                                        <label class="form-check-label" for="7up">
                                            7up <span>+ $15</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="details_quentity">
                                    <h5>select quentity</h5>
                                    <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                        <div class="quentity_btn">
                                            <button class="btn btn-danger"><i class="fal fa-minus"></i></button>
                                            <input type="text" placeholder="1">
                                            <button class="btn btn-success"><i class="fal fa-plus"></i></button>
                                        </div>
                                        <h3>$320.00</h3>
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
{{--    @endif--}}
</section>
