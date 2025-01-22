<div>
        <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Our Customar Feedbacks</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:;">Testimonial</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=============================
        TESTIMONIAL PAGE START-->
<section class="fp__testimonial_page mt_95 xs_mt_65 mb_100 xs_mb_70">
    <div class="container">
        <div class="row">
            @foreach($testimonials as $testimonial)
            <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                <div class="fp__single_testimonial">
                    <div class="fp__testimonial_header d-flex flex-wrap align-items-center">
                        <div class="img">
                            <img src="{{ asset($testimonial->image) }}" alt="clients" class="img-fluid w-100">
                        </div>
                        <div class="text">
                            <h4>{{ $testimonial->name }}</h4>
                            <p>{{ $testimonial->title }}</p>
                        </div>
                    </div>
                    <div class="fp__single_testimonial_body">
                        <p class="feedback">{{ $testimonial->review }}</p>
                        <span class="rating">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star" aria-hidden="true"></i>
                            @endfor
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="fp__pagination mt_60">
            <div class="row">
                <div class="col-12">
                    <div class="text-center" style="display: flex; justify-content: center;">
                    {{ $testimonials->links() }}
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</section>
    <!--=============================
        TESTIMONIAL PAGE END
    ==============================-->
</div>