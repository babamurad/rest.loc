<div>
    <section class="fp__offer_item mt_100 xs_mt_70 pt_95 xs_pt_65 pb_150 xs_pb_120">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                    <div class="fp__section_heading mb_50">
                        <h4>{{ $titles->top_title ?? '' }}</h4>
                        <h2>{{ $titles->title ?? '' }}</h2>
                        <span>
                            <img src="{{ asset('assets/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                        </span>
                        <p>{{ $titles->sub_title ?? '' }}</p>
                    </div>
                </div>
            </div>        
    
    {{-- Owlo carousel --}}
    <div class="row wow fadeInUp">
        <div wire:ignore class="owl-carousel owl-theme">
            @foreach ($dailyOffers as $dailyOffer)
            <div class="fp__offer_item_single">
                <div class="img">
                    <img src="{{ asset($dailyOffer->product->thumb_image) }}"
                        alt="{{ $dailyOffer->product->name }}" class="img-fluid w-100">
                </div>
                <div class="text">
                    <span>{{ $dailyOffer->product->discount_percent }}% off
                        {{ $dailyOffer->product->id }}</span>
                    <a class="title"
                        href="{{ route('product-details', ['slug' => $dailyOffer->product->slug]) }}">{{ ucfirst($dailyOffer->product->name) }}</a>
                    <p>{{ $dailyOffer->product->short_description }}</p>
                    <ul class="d-flex flex-wrap">
                        <li><a href="#" class="call-product-daily" wire:click.prevent="productDaily({{ $dailyOffer->product->id }})">
                            <i class="fas fa-shopping-basket"></i></a></li>
                        <li><a href="#"><i class="fas fa-heart"></i></a></li>
                        <li><a href="#"><i class="far fa-eye"></i></a></li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        <div class="custom-dots"></div>
    </div>
{{-- Owlo carousel --}}        
        </div>    
        
    <!--Carousel Wrapper-->     


    
    
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('click', function (event) {
                if (event.target.closest('.call-product-daily')) {
                    const productId = event.target.closest('.call-product-daily').getAttribute('data-product-id');
                    console.log('Calling productDaily with ID:', productId);
                    if (window.Livewire) {
                        window.Livewire.emit('productDaily', productId);
                    } else {
                        console.error('Livewire is not loaded');
                    }
                }
            });
        });
    </script> --}}
    
</section>    
        
    @push('mdb-js')
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script>
            $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop:true,
                autoplaySpeed:500,
                items:3,
                autoplay:true,
                dots: true,
                dotsContainer: '.custom-dots',
            });

            var dotsContainer = $('.custom-dots');

            $('.owl-dot').each(function(index){
                var dot = $('<div class="custom-dot"></div>');
                dotsContainer.append(dot);

                dot.click(function(){
                $('.owl-carousel').trigger('to.owl.carousel', [index, 300]);
                });

                $('.owl-carousel').on('changed.owl.carousel', function(event){
                dot.toggleClass('active', event.item.index === index);
                });
            });
            });
        </script>
    @endpush
    
    @push('mdb-css')   
{{--  --}}
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">

<style>
    .custom-dots {
  text-align: center;
}

.custom-dots button {
    font-size: 0;
    width: 25px;
    height: 7px;
    border-radius: 40px;
    background: var(--colorPrimary);
    margin: 0px 3px;
    padding: 0;
    opacity: .2;
    transition: all linear .2s;
    -webkit-transition: all linear .2s;
    -moz-transition: all linear .2s;
    -ms-transition: all linear .2s;
    -o-transition: all linear .2s;
    position: relative;
}

.custom-dots button.active {
    background-color: var(--colorPrimary);
    opacity: 1;
    }
</style>
    @endpush
    
</div>