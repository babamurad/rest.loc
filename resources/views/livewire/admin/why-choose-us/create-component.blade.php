@push('icon-css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-iconpicker.css') }}">
    <!-- Подключаем FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

@endpush
@push('icon-js')
    <script src="{{ asset('admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('iconPicker', () => ({
                open: false,
                icon: @entangle('icon'), // Связываем с Livewire
                icons: [
                    'fas fa-home', 'fas fa-user', 'fas fa-cog', 'fas fa-trash',
                    'fas fa-edit', 'fas fa-check', 'fas fa-times', 'fas fa-envelope',
                    'fas fa-phone', 'fas fa-heart', 'fas fa-percent', 'fas fa-receipt', 'fas fa-pizza-slice', 'fas fa-hamburger',
                    'fas fa-ice-cream', 'fas fa-carrot'
                ]
            }));
        });
    </script>

@endpush
<section class="section">
    <div class="section-header">
        <h1>Why Choose Us</h1>
        <i class="fas fa-carrot"></i>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Create WCU Item</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title">
                                @error('title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Sort Order</label>
                                        <input type="number" class="form-control @error('order') is-invalid @enderror" wire:model="order">
                                        @error('order') <div class="invalid-feedback">{{$message}}</div> @enderror
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
                        <div class="col-sm-12 col-md-6">



                            <div x-data="iconPicker" class="p-3">
                                <div class="d-flex align-items-center mb-3">
                                    <input type="text" x-model="icon" class="form-control me-2" placeholder="Выберите иконку" readonly wire:model.live="icon" />

                                    <button @click="open = true" class="btn btn-primary btn-lg">
                                        <i :class="icon"></i> Выбрать иконку
                                    </button>
{{--                                    <input type="text" hidden x-model="icon" wire:model="icon" />--}}
                                </div>

                                <div x-show="open" @click.away="open = false" class="icon-grid">
                                    <template x-for="iconClass in icons" :key="iconClass">
                                        <i :class="iconClass" class="fas fa-icon" @click="icon = iconClass; open = false"></i>
                                    </template>
                                </div>
                            </div>

                            <style>
                                .icon-grid {
                                    display: grid;
                                    grid-template-columns: repeat(auto-fit, minmax(40px, 1fr));
                                    gap: 10px;
                                    max-width: 300px;
                                    margin-top: 10px;
                                    border: 1px solid #ccc;
                                    padding: 10px;
                                    background-color: #fff;
                                }

                                .icon-grid i {
                                    font-size: 24px;
                                    cursor: pointer;
                                    padding: 10px;
                                    border: 1px solid transparent;
                                }

                                .icon-grid i:hover {
                                    background-color: #f0f0f0;
                                    border: 1px solid #ddd;
                                }
                            </style>


{{--                            <label for="">Icon</label> <br>--}}
{{--                            <!-- Button tag -->--}}
{{--                            <button class="btn btn-primary btn-lg" role="iconpicker" name="icon"></button>--}}
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
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="createItem">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</section>

