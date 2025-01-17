<div>

    <!--=============================
        BANNER START
    ==============================-->
   <livewire:components.slider-component />
{{--    <livewire:partials.carousel />--}}
    {{-- @livewire('components.slider-component') --}}
    <!--=============================
        BANNER END
    ==============================-->


    <!--=============================
        WHY CHOOSE START
    ==============================-->
    <livewire:partials.why-choose />
    <!--=============================
        WHY CHOOSE END
    ==============================-->


    <!--=============================
        OFFER ITEM START
    ==============================-->
    <livewire:partials.daily-offer-component />
    <!--=============================
        OFFER ITEM END
    ==============================-->

    <!-- CART POPUT START -->
    {{-- <div class="fp__cart_popup">
        <div class="modal fade" id="cartModalHome" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fal fa-times"></i></button>
                        <div class="fp__cart_popup_img">
                            <img src="{{ asset('assets/images/menu1.png') }}" alt="menu" class="img-fluid w-100">
                        </div>
                        <div class="fp__cart_popup_text">
                            <a href="#" class="title">Maxican Pizza Test Better Modal</a>
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
    </div> --}}
    <!-- CART POPUT END -->

    <!--=============================
        OFFER ITEM END
    ==============================-->


    <!--=============================
        MENU ITEM START
    ==============================-->
    <livewire:components.food-menu-component />
    <!--=============================
        MENU ITEM END
    ==============================-->


    <!--=============================
        ADD SLIDER START
    ==============================-->
    <livewire:partials.banner-component />    
    <!--=============================
        ADD SLIDER END
    ==============================-->


    <!--=============================
        TEAM START
    ==============================-->
    <section class="fp__team pt_95 xs_pt_65 pb_50">
        <div class="container">

            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                    <div class="fp__section_heading mb_25">
                        <h4>our team</h4>
                        <h2>meet our expert chefs</h2>
                        <span>
                            <img src="{{ asset('assets/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                        </span>
                        <p>Objectively pontificate quality models before intuitive information. Dramatically
                            recaptiualize multifunctional materials.</p>
                    </div>
                </div>
            </div>

            <div class="row team_slider">
                <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_team">
                        <div class="fp__single_team_img">
                            <img src="{{ asset('assets/images/chef_1.jpg') }}" alt="team" class="img-fluid w-100">
                        </div>
                        <div class="fp__single_team_text">
                            <h4>ismat joha</h4>
                            <p>senior chef</p>
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_team">
                        <div class="fp__single_team_img">
                            <img src="{{ asset('assets/images/chef_2.jpg') }}" alt="team" class="img-fluid w-100">
                        </div>
                        <div class="fp__single_team_text">
                            <h4>arun chandra</h4>
                            <p>senior chef</p>
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_team">
                        <div class="fp__single_team_img">
                            <img src="{{ asset('assets/images/chef_3.jpg') }}" alt="team" class="img-fluid w-100">
                        </div>
                        <div class="fp__single_team_text">
                            <h4>isita rahman</h4>
                            <p>senior chef</p>
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_team">
                        <div class="fp__single_team_img">
                            <img src="{{ asset('assets/images/chef_4.jpg') }}" alt="team" class="img-fluid w-100">
                        </div>
                        <div class="fp__single_team_text">
                            <h4>khandakar rashed</h4>
                            <p>senior chef</p>
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_team">
                        <div class="fp__single_team_img">
                            <img src="{{ asset('assets/images/chef_5.jpg') }}" alt="team" class="img-fluid w-100">
                        </div>
                        <div class="fp__single_team_text">
                            <h4>naurin nipu</h4>
                            <p>senior chef</p>
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        TEAM END
    ==============================-->


    <!--=============================
        DOWNLOAD APP START
    ==============================-->
    <section class="fp__download mt_100 xs_mt_70">
        <div class="fp__download_bg" style="background: url({{ asset('assets/images/download_bg.jpg') }});">
            <div class="fp__download_overlay">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-5 col-md-6 wow fadeInUp" data-wow-duration="1s">
                            <div class="fp__download_img">
                                <img src="{{ asset('assets/images/download_img.png') }}" alt="download" class="img-fluid w-100">
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 wow fadeInUp" data-wow-duration="1s">
                            <div class="fp__download_text">
                                <div class="fp__section_heading mb_25">
                                    <h2>download our mobile apps</h2>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque assumenda
                                        tenetur,
                                        provident earum consequatur, ut voluptas laboriosam fuga error aut eaque
                                        architecto
                                        quo pariatur. Vel dolore omnis quisquam. Lorem ipsum dolor, sit amet consectetur
                                        adipisicing elit Cumque.</p>
                                </div>
                                <ul class="d-flex flex-wrap">
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-google-play"></i>
                                            <p> <span>download from</span> google play </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-apple"></i>
                                            <p> <span>download from</span> apple store </p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        DOWNLOAD APP END
    ==============================-->


    <!--=============================
       TESTIMONIAL  START
    ==============================-->
    <section class="fp__testimonial pt_95 xs_pt_66 mb_150 xs_mb_120">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                    <div class="fp__section_heading mb_40">
                        <h4>testimonial</h4>
                        <h2>our customar feedbacks</h2>
                        <span>
                            <img src="{{ asset('assets/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                        </span>
                        <p>Objectively pontificate quality models before intuitive information. Dramatically
                            recaptiualize multifunctional materials.</p>
                    </div>
                </div>
            </div>

            <div class="row testi_slider">
                <div class="col-xl-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_testimonial">
                        <div class="fp__testimonial_header d-flex flex-wrap align-items-center">
                            <div class="img">
                                <img src="{{ asset('assets/images/comment_img_1.png') }}" alt="clients" class="img-fluid w-100">
                            </div>
                            <div class="text">
                                <h4>isita islam</h4>
                                <p>nyc usa</p>
                            </div>
                        </div>
                        <div class="fp__single_testimonial_body">
                            <p class="feedback">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut
                                accusamus
                                praesentium quaerat
                                nihil magnam a porro eaque numquam</p>
                            <span class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_testimonial">
                        <div class="fp__testimonial_header d-flex flex-wrap align-items-center">
                            <div class="img">
                                <img src="{{ asset('assets/images/comment_img_2.png') }}" alt="clients" class="img-fluid w-100">
                            </div>
                            <div class="text">
                                <h4>sumon mahmud</h4>
                                <p>nyc usa</p>
                            </div>
                        </div>
                        <div class="fp__single_testimonial_body">
                            <p class="feedback">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut
                                accusamus
                                praesentium quaerat
                                nihil magnam a porro eaque numquam</p>
                            <span class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_testimonial">
                        <div class="fp__testimonial_header d-flex flex-wrap align-items-center">
                            <div class="img">
                                <img src="{{ asset('assets/images/client_img_1.jpg') }}" alt="clients" class="img-fluid w-100">
                            </div>
                            <div class="text">
                                <h4>israt jahan</h4>
                                <p>nyc usa</p>
                            </div>
                        </div>
                        <div class="fp__single_testimonial_body">
                            <p class="feedback">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut
                                accusamus
                                praesentium quaerat
                                nihil magnam a porro eaque numquam</p>
                            <span class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_testimonial">
                        <div class="fp__testimonial_header d-flex flex-wrap align-items-center">
                            <div class="img">
                                <img src="{{ asset('assets/images/client_img_3.jpg') }}" alt="clients" class="img-fluid w-100">
                            </div>
                            <div class="text">
                                <h4>payel sarkar</h4>
                                <p>nyc usa</p>
                            </div>
                        </div>
                        <div class="fp__single_testimonial_body">
                            <p class="feedback">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut
                                accusamus
                                praesentium quaerat
                                nihil magnam a porro eaque numquam</p>
                            <span class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        TESTIMONIAL END
    ==============================-->


    <!--=============================
        COUNTER START
    ==============================-->
    <section class="fp__counter" style="background: url({{ asset('assets/images/counter_bg2.jpg') }});">
        <div class="fp__counter_overlay pt_100 xs_pt_70 pb_100 xs_pb_70">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-lg-3 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__single_counter">
                            <i class="fas fa-burger-soda"></i>
                            <div class="text">
                                <h2 class="counter">85,000</h2>
                                <p>customer serve</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-lg-3 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__single_counter">
                            <i class="fal fa-hat-chef"></i>
                            <div class="text">
                                <h2 class="counter">120</h2>
                                <p>experience chef</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-lg-3 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__single_counter">
                            <i class="far fa-handshake"></i>
                            <div class="text">
                                <h2 class="counter">72,000</h2>
                                <p>happy customer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-lg-3 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__single_counter">
                            <i class="far fa-trophy"></i>
                            <div class="text">
                                <h2 class="counter">30</h2>
                                <p>winning award</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        COUNTER END
    ==============================-->


    <!--=============================
        BLOG 2 START
    ==============================-->
    <section class="fp__blog fp__blog2">
        <div class="fp__blog_overlay pt_95 pt_xs_60 pb_100 xs_pb_70">
            <div class="container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                        <div class="fp__section_heading mb_25">
                            <h4>news & blogs</h4>
                            <h2>our latest foods blog</h2>
                            <span>
                                <img src="{{ asset('assets/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__single_blog">
                            <a href="#" class="fp__single_blog_img">
                                <img src="{{ asset('assets/images/menu2_img_1.jpg') }}" alt="blog" class="img-fluid w-100">
                            </a>
                            <div class="fp__single_blog_text">
                                <a class="category" href="#">chicken</a>
                                <ul class="d-flex flex-wrap mt_15">
                                    <li><i class="fas fa-user"></i>admin</li>
                                    <li><i class="fas fa-calendar-alt"></i> 25 oct 2022</li>
                                    <li><i class="fas fa-comments"></i> 25 comment</li>
                                </ul>
                                <a class="title" href="blog_details.html">Competently supply customized initiatives</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__single_blog">
                            <a href="#" class="fp__single_blog_img">
                                <img src="{{ asset('assets/images/menu2_img_2.jpg') }}" alt="blog" class="img-fluid w-100">
                            </a>
                            <div class="fp__single_blog_text">
                                <a class="category" href="#">kabab</a>
                                <ul class="d-flex flex-wrap mt_15">
                                    <li><i class="fas fa-user"></i>admin</li>
                                    <li><i class="fas fa-calendar-alt"></i> 27 oct 2022</li>
                                    <li><i class="fas fa-comments"></i> 41 comment</li>
                                </ul>
                                <a class="title" href="blog_details.html">Unicode UTF8 Character Sets They Sltimate
                                    Guide Systems</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__single_blog">
                            <a href="#" class="fp__single_blog_img">
                                <img src="{{ asset('assets/images/menu2_img_3.jpg') }}" alt="blog" class="img-fluid w-100">
                            </a>
                            <div class="fp__single_blog_text">
                                <a class="category" href="#">grill</a>
                                <ul class="d-flex flex-wrap mt_15">
                                    <li><i class="fas fa-user"></i>admin</li>
                                    <li><i class="fas fa-calendar-alt"></i> 27 oct 2022</li>
                                    <li><i class="fas fa-comments"></i> 32 comment</li>
                                </ul>
                                <a class="title" href="blog_details.html">Quality Foods Requirments For Every Human
                                    Body’s</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BLOG 2 END
    ==============================-->
</div>
