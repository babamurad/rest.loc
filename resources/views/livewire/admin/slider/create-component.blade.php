<section class="section">
    <div class="section-header">
        <h1>Slider</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Create Slider Item</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="image-preview"
                                 style="
                                 @if(strlen($image) == 0 || $image == '')
                                     background-image: url({{ asset('uploads/sliders/placeholder.jpg') }});
                                     @else
                                     background-image: url({{ $image->temporaryUrl() }});
                                 @endif
                                 background-size: cover;
                                 @error('image') border: 2px dashed #dc3545; @enderror
                                 background-position: center center;">
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
                                <label>Offer %</label>
                                <input type="text" class="form-control @error('offer') is-invalid @enderror" wire:model="offer">
                                @error('offer') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" name="url" class="form-control @error('link') is-invalid @enderror" wire:model="link">
                                @error('link') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Sort Order</label>
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" wire:model="sort_order">
                                        @error('start_order') <div class="invalid-feedback">{{$message}}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status. Is Published?</label>
                                        <select class="form-control @error('link') is-invalid @enderror"  wire:model="status">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('status') <div class="invalid-feedback">{{$message}}</div> @enderror
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title">
                                @error('title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Subtitle</label>
                                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" wire:model="subtitle">
                                @error('subtitle') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" wire:model="description"></textarea>
                                @error('description') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="createSlider">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</section>

