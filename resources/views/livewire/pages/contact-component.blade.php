<div>
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('assets/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>contact with us</h1>
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>home</a></li>
                        <li><a href="{{ route('contact') }}" wire:navigate>contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=============================
        CONTACT PAGE START
    ==============================-->
    <section class="fp__contact mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__contact_info">
                        <span><i class="fal fa-phone-alt"></i></span>
                        <div class="text">
                            <h3>call</h3>
                            <p>+1347-430-9510</p>
                            <p>+9658745554002</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__contact_info">
                        <span><i class="fal fa-envelope"></i></span>
                        <div class="text">
                            <h3>mail</h3>
                            <p>websolutionus1@gmail.com</p>
                            <p>example@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__contact_info">
                        <span><i class="fas fa-street-view"></i></span>
                        <div class="text">
                            <h3>location</h3>
                            <p>7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fp__contact_form_area mt_100 xs_mt_70">
                <div class="row">
                    <div class="col-xl-12 wow fadeInUp" data-wow-duration="1s">
                        <form class="fp__contact_form" wire:submit.prevent="sendContactForm">
                            <h3>contact</h3>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fp__contact_form_input">
                                        <span><i class="fal fa-user-alt"></i></span>
                                        <input class="@error('name') is-invalid @enderror" type="text" placeholder="Name" wire:model="name" wire:input="validateName">                                        
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fp__contact_form_input">
                                        <span><i class="fal fa-envelope"></i></span>
                                        <input class="@error('email') is-invalid @enderror" type="email" placeholder="Email" wire:model="email" wire:input="validateEmail">
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fp__contact_form_input">
                                        <span><i class="fal fa-phone-alt"></i></span>
                                        <input class="@error('phone') is-invalid @enderror" type="text" placeholder="Phone" wire:model="phone" wire:input="validatePhone">
                                    </div>
                                    @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fp__contact_form_input">
                                        <span><i class="fal fa-book"></i></span>
                                        <input class="@error('messageSubject') is-invalid @enderror" type="text" placeholder="Subject" wire:model="messageSubject" wire:input="validateSubject">                                        
                                    </div>
                                    @error('messageSubject')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-12">
                                    <div class="fp__contact_form_input textarea">
                                        <span><i class="fal fa-book"></i></span>
                                        <textarea class="@error('message') is-invalid @enderror" rows="8" placeholder="Message" wire:model="messageText" wire:input="validateMessage"></textarea>
                                    </div>
                                    @error('messageText')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <button type="submit">send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt_100 xs_mt_70">
                    <div class="col-xl-12 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__contact_map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29199.78758207035!2d90.43684581929195!3d23.819543211524437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c62fce7d991f%3A0xacfaf1ac8e944c05!2sBasundhara%20Residential%20Area%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1667021568123!5m2!1sen!2sbd"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        CONTACT PAGE END
    ==============================-->
</div>
