<div>
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('assets/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>sign in</h1>
                    <ul>
                        <li><a href="/" wire:navigate>home</a></li>
                        <li><a href="#">sign in</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=========================
        SIGNIN START
    ==========================-->
    <section class="fp__signin" style="background: url({{ asset('assets/images/login_bg.jpg') }});">
        <div class="fp__signin_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
            <div class="container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                        <div class="fp__login_area">
                            <h2>Welcome back!</h2>
                            <p>sign in to continue</p>
                            <form>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>email</label>
                                            <input class="is-invalid" type="email" placeholder="Email" wire:model="email">
                                            @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>password</label>
                                            <input type="password" placeholder="Password" wire:model="password">
                                            @error('password') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput fp__login_check_area">
                                            <div class="form-check" x-data="{ rememberMe: false }">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault"
                                                       wire:model="rememberMe"
                                                       :checked="rememberMe"
                                                       @mouseover="cursor = 'pointer'"
                                                       @mouseout="cursor = 'default'"
                                                >
                                                <label class="form-check-label" for="flexCheckDefault" :style="{ cursor: cursor }">
                                                    Запомнить меня
                                                </label>
                                            </div>
                                            <a href="{{ route('forgot-password') }}" wire:navigate>Forgot Password ?</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <button type="button" class="common_btn" wire:click.prevent="login">login</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="or"><span>or</span></p>
                            <p class="create_account">Dont’t have an account ? <a href="{{ route('register') }}">Create Account</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        SIGNIN END
    ==========================-->
</div>
