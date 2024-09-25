@section('title', 'Create Product')
@push('summernote-css')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/summernote/summernote-bs4.css') }}">
@endpush
@push('summernote-js')
    <script src="{{ asset('admin/assets/modules/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                tabsize: 2,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                ],
            });
            $('#summernote2').summernote({
                height: 300,
                tabsize: 2,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                ],
            });
            $('#summernote').on('summernote.change', function(we, contents, $editable) {
            @this.set('long_description', contents)
            });
            $('#summernote2').on('summernote.change', function(we, contents, $editable) {
            @this.set('seo_description', contents)
            });
        });
    </script>
@endpush
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
                    <ul class="nav nav-pills" id="myTab" role="tablist" wire:ignore>
                        <li class="nav-item">
                            <a class="nav-link @if($activeTab == 'main') active show @endif " id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main"
                               aria-selected="@if($activeTab == 'main') 'true' @else 'false' @endif" wire:click.prevent="changeTab('main')">{{__('Main Info')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($activeTab == 'image') active show @endif" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image"
                               aria-selected="@if($activeTab == 'image') 'true' @else 'false' @endif" wire:click.prevent="changeTab('image')">{{__('Images')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent" wire:ignore>
                        <div class="tab-pane fade active show" id="main" role="tabpanel" aria-labelledby="main-tab">
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
                                    <div class="form-group">
                                        <label>Long description</label>
                                        <div wire:ignore>
                                            <textarea id="summernote" class="form-control" wire:model="long_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>SEO title</label>
                                        <textarea class="form-control" wire:model="seo_title"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>SEO description</label>
                                        <div wire:ignore>
                                            <textarea id="summernote2" class="form-control" wire:model="seo_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Main Image Upload</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="image-preview"
                                                 style="
                                 @if(strlen($thumb_image) == 0 || $thumb_image == '')
                                     background-image: url({{ asset('uploads/sliders/placeholder.jpg') }});
                                     @else
                                     background-image: url({{ $thumb_image->temporaryUrl() }});
                                 @endif
                                 background-size: cover;
                                 @error('image') border: 2px dashed #dc3545; @enderror
                                 background-position: center center;">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="thumb_image" id="image-upload" wire:model="thumb_image">
                                            </div>
                                            <!-- Загрузка в процессе -->
                                            <div wire:loading wire:target="thumb_image">
                                                <p>Идет загрузка...</p> <!-- Сообщение, пока идет загрузка -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Multiple Upload</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group" wire:ignore>
                                                <div class="custom-file"
                                                     x-data="{ uploading: false, progress: 0 }"
                                                     x-on:livewire-upload-start="uploading = true"
                                                     x-on:livewire-upload-finish="uploading = false"
                                                     x-on:livewire-upload-cancel="uploading = false"
                                                     x-on:livewire-upload-error="uploading = false"
                                                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                                                >
                                                    <input type="file" id="images" class="custom-file-input @error('images') is-invalid @enderror" wire:model="images" multiple>
                                                    <label class="custom-file-label" for="images" aria-describedby="inputGroupFileAddon02">Product Image Gallery </label>
                                                    <div class="d-flex">
                                                        @if($images)
                                                            @foreach($images as $image)
                                                                <img class="mt-2 mb-5 rounded" src="{{ $image->temporaryUrl() }}" alt="Product Image Galley" style="width: 120px; max-height: 200px;">
                                                                <span class="text-danger btn h-25">x</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <!-- Progress Bar -->
                                                    <div x-show="uploading">
                                                        <progress max="100" x-bind:value="progress"></progress>
                                                    </div>

                                                    @error('images') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="button" wire:click="createProduct">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</section>

