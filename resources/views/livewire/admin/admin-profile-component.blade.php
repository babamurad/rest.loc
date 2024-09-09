<section class="section">
    <div class="section-header">
        <h1>Profile</h1>



    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Update User Settings</h4>
                    </div>
                    <div class="card-body">
                        <form >
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control
                                        @if($errors->has('name')) is-invalid @endif" wire:model="name">
                                @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" wire:model="email">
                                @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-form-label text-md-right">Thumbnail</label>
                                <div class="row">
                                    <div class="col-sm-12 col-md-7">
                                        <div class="image-preview"
                                        style="
                                             @if($newimage)
                                             background-image: url({{ $newimage->temporaryUrl() }});
                                             @else
                                             background-image: url({{ asset(auth()->user()->avatar) }});
                                             @endif
                                             background-size: cover;
                                             background-position: center center;"
                                        >
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="image" id="image-upload" wire:model="newimage">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="button" class="btn btn-primary" wire:click.prevent="updateUser">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Update Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @elseif(strlen($current_password) > 0) is-valid @enderror" wire:model="current_password">
                                @error('current_password') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @elseif(strlen($password) > 0) is-valid @enderror" wire:model="password">
                                @error('password') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" wire:model="password_confirmation">
                                @error('password_confirmation') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="updatePassword">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{--@push('toastr-js')
    <script>
        import Toastr from 'toastr';

        window.Toastr = Toastr;

        // Настройка внешнего вида (необязательно)
        Toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
        };
    </script>
@endpush--}}
