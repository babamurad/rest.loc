@push('icon-css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-iconpicker.css') }}">
    <!-- Подключаем FontAwesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/FontAwesome.css') }}" />
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
@endpush
@push('icon-js')
    <script src="{{ asset('admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="https://rest.loc/assets/js/Font-Awesome.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('iconPicker', () => ({
                open: false,
                icon: @entangle('icon'), // Связываем с Livewire
                icons: [
                    'fas fa-home', 'fas fa-user', 'fas fa-cog', 'fas fa-check', 'fas fa-times', 'fas fa-envelope',
                    'fas fa-phone', 'fas fa-heart', 'fas fa-percent', 'fas fa-receipt', 'fas fa-pizza-slice', 'fas fa-hamburger',
                    'fas fa-ice-cream', 'fas fa-carrot', 'fas fa-hat-chef', 'fas fa-burger-soda', 'fas fa-badge-percent', 'fas fa-badge-dollar',
                    'fas fa-soup', 'fas fa-pizza', 'fas fa-fish-cooked', 'fas fa-meat', 'fas fa-candy-corn', 'far fa-pie'
                ]
            }));
        });
    </script>

@endpush
<section class="section">
    <div class="section-header">
        <h1>Why Choose Us</h1>
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Textarea</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" wire:model="description" rows="4"></textarea>
                                        @error('description') <div class="invalid-feedback">{{$message}}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-left">
                                <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="createItem">Submit</button>
                                <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-6">



                            <div x-data="iconPicker" class="p-3">
                                <div class="d-flex align-items-center mb-3">
                                    <input type="text" x-model="icon" class="form-control me-2" placeholder="Выберите иконку" readonly wire:model.live="icon" />

                                    <button @click="open = true" class="btn btn-primary btn-lg">
                                        <i :class="icon"></i> Выбрать иконку
                                    </button>

                                </div>

                                <div><i :class="icon" style="    font-size: 80px;color: #6a7aed;"></i></div>
                                <div x-show="open" @click.away="open = false" class="icon-grid">
                                    <template x-for="iconClass in icons" :key="iconClass">
                                        <i :class="iconClass" class="fas fa-icon" @click="icon = iconClass; open = false"></i>

                                    </template>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

