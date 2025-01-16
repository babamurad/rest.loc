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
                                <label>{{  __('Title') }}</label>
                                <input type="text" class="form-control " wire:model="title">
                            </div>
                            <div class="form-group">
                                <label>{{  __('Sub Title') }}</label>
                                <input type="text" class="form-control " wire:model="sub_title">
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

@push('select2-css')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/select2/dist/css/select2.min.css') }}">
    <style>
        .product-item {
            /* Базовые стили */
            color: #333;
            cursor: pointer;
            display: flex; /* Создаем гибкий контейнер для выравнивания элементов */
            align-items: center; /* Выравниваем элементы по вертикали по центру */
        }

        .product-item:hover {
            background-color: #f0f0f0;
            color: #007bff;
        }
    </style>
@endpush

@push('select2-js')
    <script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#product_search').select2();
        });
    </script>
@endpush
