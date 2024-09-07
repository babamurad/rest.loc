<div wire:ignore.self class="tab-pane fade" id="v-pills-settings" role="tabpanel"
     aria-labelledby="v-pills-settings-tab">
    <div class="fp_dashboard_body fp__change_password">
        <div class="fp__review_input">
            <h3>change password</h3>
            <div class="comment_input pt-0">
                <form wire:submit.prevent="updatePassword">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="fp__comment_imput_single" wire:ignore.self>
                                <label>Current Password</label>
                                <input class="@error('current_password') is-invalid @enderror" type="password" placeholder="Current Password" wire:model="current_password">
                                @error('current_password') <div class="invalid-feedback" style="display: block;">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="fp__comment_imput_single">
                                <label>New Password</label>
                                <input class="@error('password') is-invalid @enderror" type="password" placeholder="New Password" wire:model="password">
                                @error('password') <div class="invalid-feedback" style="display: block;">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="fp__comment_imput_single">
                                <label>confirm Password</label>
                                <input class="@error('password_confirmation') is-invalid @enderror" type="password" placeholder="Confirm Password" wire:model="password_confirmation">
                                @error('password_confirmation') <div class="invalid-feedback" style="display: block;">{{$message}}</div> @enderror
                            </div>
                            <button type="submit" class="common_btn mt_20">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
