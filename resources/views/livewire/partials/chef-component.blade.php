<section class="fp__team pt_95 xs_pt_65 pb_50">
    <div class="container">

        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                <div class="fp__section_heading mb_25">
                    <h4>{{ $top_title }}</h4>
                    <h2>{{ $title }}</h2>
                    <span>
                        <img src="{{ asset('assets/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                    </span>
                    <p>{{ $sub_title }}</p>
                </div>
            </div>
        </div>

        <div class="row team_slider">
            @foreach($chefs as $chef)
            <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                <div class="fp__single_team">
                    <div class="fp__single_team_img">
                        <img src="{{ asset($chef->image) }}" alt="team" class="img-fluid w-100">
                    </div>
                    <div class="fp__single_team_text">
                        <h4>{{ $chef->name }}</h4>
                        <p>{{ $chef->title }}</p>
                        <ul class="d-flex flex-wrap justify-content-center">
                            @if($chef->facebook)
                            <li><a href="{{ $chef->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if($chef->instagram)
                            <li><a href="{{ $chef->instagram }}"><i class="fab fa-instagram"></i></a></li>
                            @endif
                            @if($chef->twitter)
                            <li><a href="{{ $chef->twitter }}"><i class="fab fa-twitter"></i></a></li>
                            @endif
                            @if($chef->linkedin)
                            <li><a href="{{ $chef->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                            @endif
                            {{-- <x-icons.imo /> --}}
                            @if($chef->imo)
                            <li><a href="{{ $chef->imo }}">Imo</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
