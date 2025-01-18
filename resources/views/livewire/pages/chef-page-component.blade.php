<section class="fp__team_page pt_95 xs_pt_65 pb_100 xs_pb_70">
    <div class="container">
        <div class="row">
            @foreach($chefs as $chef)
            <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
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
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="fp__pagination mt_60">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-long-arrow-alt-left"></i></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-long-arrow-alt-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>