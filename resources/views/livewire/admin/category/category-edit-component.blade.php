<section class="section">
    <div class="section-header">
        <h1>{{ __('Category') }}</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Edit Category') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" wire:keyup="generateSlug()">
                                @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>{{ __('Slug') }}</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model="slug" disabled>
                                @error('slug') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{ __('Status. Is Published?') }}</label>
                                <select class="form-control @error('link') is-invalid @enderror"  wire:model="status">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{ __('Sort Order') }}</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" wire:model="order">
                                @error('order') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{ __('Show at home?') }}</label>
                                <select class="form-control @error('show_at_home') is-invalid @enderror"  wire:model.live="show_at_home">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                                @error('show_at_home') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="update">{{ __('Submit') }}</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">{{ __('Cancel') }}</button>
                </div>

            </div>
        </div>
    </div>
</section>

