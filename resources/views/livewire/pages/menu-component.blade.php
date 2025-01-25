<div>
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Foods menu</h1>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#">menu</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=============================
        MENU PAGE START
    ==============================-->
    <section class="fp__search_menu mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <form class="fp__search_menu_form">
                <div class="row">
                    <div class="col-xl-6 col-md-5">
                        <input type="text" placeholder="Search..." wire:model.live="search">
                    </div>
                    <div class="col-xl-6 col-md-4">
                        <div x-data="{ isOpen: @entangle('isOpen').defer }" x-init="selectComponent($el)">
                            <div @click="isOpen = !isOpen" class="custom-select d-flex justify-content-between">
                              <span>{{ $categoryName?? "Select Category" }}</span> 
                              <i class="fa fa-chevron-down mt-1" :class="{ 'rotate-180': isOpen }"></i>
                            </div>
                            <ul x-show="isOpen" class="dropdown">
                                @foreach($categories as $category)
                                  <li wire:click="selectCategory({{ $category->id }})" @click="isOpen =false">{{ Str::ucfirst($category->name) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </form>
            
            <div class="row">
                @foreach($products as $product)
                    <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__menu_item">
                            <div class="fp__menu_item_img">
                                <img src="{{ asset($product->thumb_image) }}" alt="menu" class="img-fluid w-100">
                                <a class="category" href="#">{{ $product->category->name }}</a>
                            </div>
                            <div class="fp__menu_item_text">
                                <p class="rating">
                                    @for($i = 0; $i < 5; $i++)
                                        @if($i < $product->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <span>{{ $product->rating }}</span>
                                </p>
                                <a class="title" href="{{ route('product-details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                <h5 class="price">${{ $product->price }} <del>${{ $product->old_price }}</del></h5>
                                <ul class="d-flex flex-wrap justify-content-center">
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#cartModal"><i
                                                class="fas fa-shopping-basket"></i></a></li>
                                    <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="fp__pagination mt_35">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        MENU PAGE END
    ==============================-->
</div>
