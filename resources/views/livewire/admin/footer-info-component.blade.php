<section class="section">
    <div class="section-header">
        <h1>{{ __('Footer Info') }}</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Update Footer Info') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>{{ __('Short Info') }}</label>
                                <input type="text" class="form-control @error('short_info') is-invalid @enderror" wire:model="short_info">
                                @error('short_info') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Address') }}</label>
                                <input type="text" name="url" class="form-control @error('address') is-invalid @enderror" wire:model="address">
                                @error('address') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('Phone') }}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone">
                                        @error('phone') <div class="invalid-feedback">{{$message}}</div> @enderror
                                    </div>
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label>{{ __('Email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                                @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Copyright') }}</label>
                                <input type="text" class="form-control @error('copyright') is-invalid @enderror" wire:model="copyright">
                                @error('copyright') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="">Logo {{ asset($logo) }}</label>
                            <div class="image-preview img-fluid"
                                 style="
                                 @if($newlogo)
                                 background-image: url({{ $newlogo->temporaryUrl() }});
                                 @else
                                 background-image: url({{ asset($logo) }});
                                 @endif
                                 background-size: cover;
                                 @error('logo') border: 2px dashed #dc3545; @enderror
                                 background-position: center center;  background-color: #F86F03;">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="logo" id="image-upload" wire:model="newlogo">
                            </div>
                            <!-- Загрузка в процессе -->
                            <div wire:loading wire:target="logo">
                                <p>Идет загрузка...</p> <!-- Сообщение, пока идет загрузка -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="updateFooterInfo">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</section>

