{{--@section('title', 'Edit Product')--}}
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
        <h1>Edit Product</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4> </h4>
                    <div class="card-header-action">
                    <button class="btn btn-primary mr-1" type="button" wire:click="updateProduct">Save</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                    </div>
                </div>
            </div>


            <div x-data="{ currentTab: 1 }">
                <ul class="nav nav-tabs">
                    <li class="nav-item" @click="currentTab = 1">
                        <a :class="{ 'active-tab-btn text-white': currentTab === 1 }" class=" nav-link" href="#">Main Info</a>
                    </li>
                    <li class="nav-item" @click="currentTab = 2">
                        <a :class="{ 'active-tab-btn text-white': currentTab === 2 }" class=" nav-link" href="#">Images</a>
                    </li>
                    <li class="nav-item" @click="currentTab = 3">
                        <a :class="{ 'active-tab-btn text-white': currentTab === 3 }" class=" nav-link" href="#">Seo</a>
                    </li>
                    <li class="nav-item" @click="currentTab = 4">
                        <a :class="{ 'active-tab-btn text-white': currentTab === 4 }" class=" nav-link" href="#">Options</a>
                    </li>
                </ul>
                <div class="" x-show="currentTab === 1">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="card">
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
                                        <div class="col-sm-12">
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


                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-sm-12 col-md-12">
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
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Sort Order</label>
                                            <input type="number" class="form-control @error('order') is-invalid @enderror" wire:model="order">
                                            @error('order') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>SKU</label>
                                            <input type="text" class="form-control @error('sku') is-invalid @enderror" wire:model="sku">
                                            @error('sku') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" class="form-control @error('price') is-invalid @enderror" wire:model="price" min="0" step="0.01">
                                            @error('price') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Offer Price</label>
                                            <input type="number" class="form-control @error('offer_price') is-invalid @enderror" wire:model="offer_price" min="0" step="0.01">
                                            @error('offer_price') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
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
                                    <div class="col-sm-12 col-md-12">
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
                            </div>
                        </div>
                    </div>


                </div>
                <div x-show="currentTab === 2">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Main Image Upload</h4>
                                </div>
                                <div class="card-body">
                                    <div class="image-preview"
                                         style="
                                         @if(strlen($newimage) == 0 || $newimage == '')
                                             background-image: url({{ asset( $image ) }});
                                         @else
                                             background-image: url({{ $newimage->temporaryUrl() }});
                                         @endif
                                             background-size: cover;
                                         @error('newimage') border: 2px dashed #dc3545; @enderror
                                             background-position: center center;">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="image" id="image-upload" wire:model="newimage">
                                    </div>
                                    <!-- Загрузка в процессе -->
                                    <div wire:loading wire:target="image">
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
                                <div class="form-group card-body">
                                    <div class="custom-file"
                                         x-data="{ uploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="uploading = true"
                                         x-on:livewire-upload-finish="uploading = false"
                                         x-on:livewire-upload-cancel="uploading = false"
                                         x-on:livewire-upload-error="uploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress"
                                    >
                                        <input type="file" id="images" class="custom-file-input @error('images') is-invalid @enderror" wire:model="newimages" multiple>
                                        <label class="custom-file-label" for="images" aria-describedby="inputGroupFileAddon02">Product Image Gallery </label>
                                        <div x-show="uploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                        @error('images') <div class="invalid-feedback">{{$message}}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if($newimages)
                                    @foreach($newimages as $key => $newimage)
                                        @if($newimage)
                                            <div class="col-sm-3">
                                                <div class="card">
                                                    <div class="view overlay text-center position-relative">
                                                        <div class="text-danger h-25 delete-button" wire:key="{{ $key }}" wire:click="delImageItem({{ $key }})" style="cursor: pointer;">
                                                            <i class="fas fa-times"></i>
                                                        </div>
                                                        <img class="card-img-top" src="{{ $newimage->temporaryUrl() }}" alt="Product Image Gallery">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($images as $key => $image)
                                        @if($image)
                                            <div class="col-sm-3">
                                                <div class="card">
                                                    <div class="view overlay text-center position-relative">
                                                        <div class="text-danger h-25 delete-button" wire:key="{{ $key }}" wire:click="delImageItem({{ $key }})" style="cursor: pointer;">x</div>
                                                        <img class="card-img-top" src="{{ asset($image) }}" alt="Product Image Gallery">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="currentTab === 3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-sm-12">
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
                        </div>
                    </div>
                </div>
                <div x-show="currentTab === 4">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card mb-3">
                                <div class="card-header">{{__('Create size')}}</div>
                                <div class="card-body">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Size')}}</label>
                                            <input type="text" class="form-control form-control-sm @error('sizeName') is-invalid @enderror" wire:model="sizeName">
                                            @error('sizeName') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Price')}}</label>
                                            <div>
                                                <input type="number" class="form-control form-control-sm @error('sizePrice') is-invalid @enderror" wire:model="sizePrice">
                                                @error('sizePrice') <div class="invalid-feedback">{{$message}}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <a class="btn btn-primary mr-1 text-white btn-sm" type="button" wire:click="saveSize">
                                            <i class="far fa-save"></i>
                                            {{__('Save')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card mb-3">
                                <div class="card-header">{{__('Create options(optional)')}}</div>
                                <div class="card-body">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Size')}}</label>
                                            <input type="text" class="form-control form-control-sm @error('optionName') is-invalid @enderror" wire:model="optionName">
                                            @error('optionName') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Price')}}</label>
                                            <div>
                                                <input type="number" class="form-control form-control-sm @error('optionPrice') is-invalid @enderror" wire:model="optionPrice">
                                                @error('optionPrice') <div class="invalid-feedback">{{$message}}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <a class="btn btn-primary mr-1 text-white btn-sm" type="button" wire:click="saveOption()">
                                            <i class="far fa-save"></i>
                                            {{__('Save')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->sizes as $size)
                                            <tr>
                                                <th scope="row">{{ ++$loop->index }}</th>
                                                <td class="w-50">{{ $size->name }}</td>
                                                <td>{{ $size->price }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" wire:click.prevent="editSize({{ $size->id }})">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm"
                                                            onclick="if (confirm('Подтвердите удаление')) { @this.call('destroySize', {{ $size->id }}) }">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->options as $option)
                                            <tr>
                                                <th scope="row">{{ $loop->index+1 }}</th>
                                                <td class="w-50">{{ $option->name }}</td>
                                                <td>{{ $option->price }}</td>
                                                <td>
                                                    <a class="btn btn-icon btn-primary btn-sm" href="#" wire:click.prevent="editOption({{ $option->id }})">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm"
                                                            onclick="if (confirm('Подтвердите удаление')) { @this.call('destroyOption', {{ $option->id }}) }">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="card-footer text-left">
            <button class="btn btn-primary mr-1" type="button" wire:click="updateProduct"><i class="fas fa-save mr-1"></i>Submit</button>
            <button class="btn btn-secondary" type="reset" wire:click="cancel"><i class="far fa-window-close mr-1"></i>Cancel</button>
        </div>

    </div>
    </div>
    </div>
</section>

