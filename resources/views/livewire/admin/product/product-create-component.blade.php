@push('summernote-css')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/summernote/summernote-bs4.css') }}">
@endpush
@push('summernote-js')
    <script>
        function deleteConfirmation(id)
        {
        @this.set('size_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteProduct()
        {
        @this.call('deleteProduct');
            $('#deleteSize').modal('hide');
        }
/*        window.addEventListener('closeModalSize', event=> {
            $('#ConfirmDelete').modal('hide');
        })*/
        function closeModal() {
            // alert('close ConfirmDelete');
            $('#ConfirmDelete').modal('hide');
            // или для другого модального окна: $('#ConfirmDeleteOption').modal('hide');
        }
        function closeOption() {
            // alert('close ConfirmDelete');
            $('#closeModalOption').modal('hide');
        }
        // window.addEventListener('closeModalOption', event=> {
        //     $('#ConfirmDeleteOption').modal('hide');
        // })
    </script>
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
    <div class="section-header d-flex justify-content-between align-items-center">
            <h4>Create Product</h4>
            <div class="card-header-action">
                @if($errors->any())
                @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" style="margin-bottom: 2%; padding-top:0.5rem; padding-bottom:0.5rem; ">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6><i class="icon fas fa-info"></i> {{ $error }}</h6>
                        </div>
                @endforeach
                @endif
                <a class="btn btn-primary mr-1 text-white" type="button" wire:click="createProduct"><i class="fas fa-save mr-1"></i>{{__('Save')}}</a>
                <a class="btn btn-secondary" type="reset" wire:click="cancel"><i class="fas fa-window-close mr-1"></i>{{__('Cancel')}}</a>
            </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary"></div>
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
                <div x-show="currentTab === 1">
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
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label>{{ __('Quantity') }} {{ $quantity }}</label>
                                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" wire:model="quantity" min="0" step="1">
                                            @error('quantity') <div class="invalid-feedback">{{$message}}</div> @enderror
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
                                            @error('cateory_id') <div class="invalid-feedback">{{$message}}</div> @enderror
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
                                    <div class="image-preview @error('thumb_image') border-danger @enderror" style="
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
                                    @error('thumb_image') <div class="invalid-feedback" style="display: block;">{{$message}}</div> @enderror

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
                                <div class="form-group card-body">
                                    <div class="custom-file">
                                        <input type="file" id="images" class="custom-file-input @error('images') is-invalid @enderror" wire:model="images" multiple>
                                        <label class="custom-file-label" for="images" aria-describedby="inputGroupFileAddon02">Product Image Gallery </label>

                                        @error('newimages') <div class="invalid-feedback">{{$message}}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if($images)
                                    @foreach($images as $key => $image)
                                        <div class="col-sm-3">
                                            <div class="card">
                                                <div class="view overlay text-center position-relative">
                                                    <!-- Скрываем кнопку по умолчанию -->
                                                    <div class="text-danger h-25 delete-button" wire:key="{{ $key }}" wire:click="delImageItem({{ $key }})" style="cursor: pointer;">x</div>
                                                    <img class="card-img-top" src="{{ $image->temporaryUrl() }}" alt="Product Image Gallery">
                                                </div>
                                            </div>
                                        </div>
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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Size')}}</label>
                                                <input type="text" class="form-control form-control-sm @error('sizeName') is-invalid @enderror" wire:model="sizeName">
                                                @error('sizeName') <div class="invalid-feedback">{{$message}}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Price')}}</label>
                                                <div>
                                                    <input type="number" class="form-control form-control-sm @error('sizePrice') is-invalid @enderror" wire:model="sizePrice">
                                                    @error('sizePrice') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="btn btn-primary mr-1 text-white btn-sm" type="button" wire:click="saveSize">
                                        <i class="fas fa-plus"></i>
                                        {{__('Create')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card mb-3">
                                <div class="card-header">{{__('Create options(optional)')}}</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input type="text" class="form-control form-control-sm" wire:model="optionName">
                                                @error('optionName') <div class="invalid-feedback">{{$message}}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Price')}}</label>
                                                <div>
                                                    <input type="number" class="form-control form-control-sm" wire:model="optionPrice">
                                                    @error('optionPrice') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="btn btn-primary mr-1 text-white btn-sm" type="button" wire:click="saveOption">
                                        <i class="fas fa-plus"></i>
                                        {{__('Create')}}
                                    </a>
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
                                        @foreach($sizes as $size)
                                            <tr>
                                                <th scope="row">{{ ++$loop->index }}</th>
                                                <td style="width: 50%;">{{ $size->name }}</td>
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

                                        @if(count($sizes) === 0)
                                            <tr>
                                                <td colspan="4" class="text-center">No data found!</td>
                                            </tr>
                                        @endif
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
                                        @foreach($options as $option)
                                            <tr>
                                                <th scope="row">{{ ++$loop->index }}</th>
                                                <td style="width: 50%;">{{ $option->name }}</td>
                                                <td>{{ $option->price }}</td>
                                                <td>
                                                    <button class="btn btn-icon btn-primary btn-sm" wire:click="editOption({{ $option->id }})">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm"
                                                            onclick="if (confirm('Подтвердите удаление')) { @this.call('destroyOption', {{ $option->id }}) }">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if(count($options) === 0)
                                            <tr>
                                                <td colspan="4" class="text-center">No data found!</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
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

