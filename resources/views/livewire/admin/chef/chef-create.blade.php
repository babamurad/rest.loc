<section class="section">
    <div class="section-header">
        <h1>{{__('Banner Slider')}}</h1>
        @include('livewire.admin.components.alerts')
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{__('Create Banner Slider Item')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="image-preview"
                                 style="
                                 @if(strlen($image) == 0 || $image == '')
                                     background-image: url({{ asset('uploads/sliders/placeholder.jpg') }});
                                     @else
                                     background-image: url({{ $image->temporaryUrl() }});
                                 @endif
                                 background-size: cover;
                                 @error('image') border: 2px dashed #dc3545; @enderror
                                 background-position: center center; width: 80%;">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="image" id="image-upload" wire:model="image">
                            </div>
                            <!-- Загрузка в процессе -->
                            <div wire:loading wire:target="image">
                                <p>Идет загрузка...</p> <!-- Сообщение, пока идет загрузка -->
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>{{  __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="title">
                                @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>{{  __('Title') }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title">
                                @error('title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>Link</label>
                                <input type="text" name="url" class="form-control " wire:model="link">
                                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                            </div> --}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control " wire:model="status">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="create">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</section>
