<section class="section">
    <div class="section-header">
        <h1>Product</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Create Product</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" wire:keyup="generateSlug()">
                                @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model="slug" disabled>
                                @error('slug') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>Status. Is Published?</label>
                                <select class="form-control @error('link') is-invalid @enderror" wire:model="status">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>Sort Order</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" wire:model="order">
                                @error('order') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>Show at home?</label>
                                <select class="form-control @error('show_at_home') is-invalid @enderror"
                                        wire:model="show_at_home">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('show_at_home')
                                <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>SKU</label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" wire:model="sku">
                                @error('sku') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="image-preview"
                                 style="
                                 @if(strlen($image) == 0 || $image == '')
                                     background-image: url({{ asset('uploads/products/1727079252_menu2_img_2.jpg') }});
                                     @elseif($newimage)
                                     background-image: url({{ $newimage->temporaryUrl() }});
                                     @else
                                     background-image: url({{ asset($image) }});
                                 @endif
                                 background-size: cover;
                                 @error('newimage') border: 2px dashed #dc3545; @enderror
                                 background-position: center center;">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="image" id="image-upload" wire:model="newimage">
                            </div>
                            <!-- Загрузка в процессе -->
                            <div wire:loading wire:target="newimage">
                                <p>Идет загрузка...</p> <!-- Сообщение, пока идет загрузка -->
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" wire:model="price" min="0" step="0.01">
                                @error('price') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Offer Price</label>
                                <input type="number" class="form-control @error('offer_price') is-invalid @enderror" wire:model="offer_price" min="0" step="0.01">
                                @error('offer_price') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control @error('cateory_id') is-invalid @enderror" wire:model="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" wire:key="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                    @endforeach

                                </select>
                                @error('cateory_id')
                                <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>Is Featured?</label>
                                <select class="form-control @error('is_featured') is-invalid @enderror"
                                        wire:model="is_featured">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('is_featured')
                                <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Short description</label>
                                <textarea class="form-control" wire:model="short_description"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Long description</label>
                                <textarea class="form-control" wire:model="long_description"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="updateProduct">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</section>

