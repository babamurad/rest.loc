<section class="section">
    <div class="section-header">
        <h1>{{__('Create Chef Item')}}</h1>
        @include('livewire.admin.components.alerts')
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{__('Create Chef')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="image-preview"
                                 style="
                                 @if($newimage)
                                 background-image: url({{ $newimage->temporaryUrl() }});
                                 @else
                                 background-image: url({{ asset($image) }});
                                 @endif
                                 background-size: cover;
                                 @error('image') border: 2px dashed #dc3545; @enderror
                                 background-position: center center;>
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="image" id="image-upload" wire:model="newimage">
                            </div>
                            <!-- Загрузка в процессе -->
                            <div wire:loading wire:target="image">
                                <p>Идет загрузка...</p> <!-- Сообщение, пока идет загрузка -->
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>{{  __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                                @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>{{  __('Title') }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title">
                                @error('title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>                        
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>{{ __('Rating') }}</label>
                                <select class="form-control " wire:model="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>{{  __('Sort Order') }}</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" wire:model="sort_order">
                                @error('sort_order') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>{{ __('Show at home') }}</label>
                                <select class="form-control " wire:model="show_at_home">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>{{ __('Status') }}</label>
                                <select class="form-control " wire:model="status">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Inactive') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>{{  __('Review') }}</label>
                                <textarea class="form-control @error('review') is-invalid @enderror" rows="3" wire:model="review"></textarea>
                                @error('review') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>                                              
                    </div>
                    
                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="update">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</section>
