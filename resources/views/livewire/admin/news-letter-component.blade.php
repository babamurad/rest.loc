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
        <h1>{{ __('Testimonials') }}</h1>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div x-data="{ open: @entangle('open') }" class="mb-4">
                <button x-on:click="open = ! open" class="btn btn-primary">Send News Letter...</button>

                <div x-show="open" x-transition>
                    <form action="" wire:submit.prevent="sendNewsLetter">
                     <div class="row mt-4">                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Subject</label> @error('subject') is-invalid @enderror
                                <input type="text" class="form-control" wire:model="subject">
                                @error('subject') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Sub Title</label>
                                <textarea name="message" id="summernote" cols="30" rows="10" wire:model="message"></textarea>
                                @error('message') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>   
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">                
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($subscribes)
                            @foreach ($subscribes as $subscribe)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $subscribe->email }}</td>                                   

                                    <td class="text-center" style="width: 16%;">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ConfirmDelete" wire:click="getDelId({{ $subscribe->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    @if(!$subscribes)
                        <p>No items found.</p>
                    @else
                        {{ $subscribes->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('closeModal', event=> {
            $('#ConfirmDelete').modal('hide');
        })
    </script>

    <!-- Modal -->
    <div wire:ignore class="modal fade mt-5" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="ConfirmDelete" aria-hidden="true" style="background-color: rgb(70 70 70 / 50%);">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Удаление</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close"></button>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" wire:click="destroy">Удалить</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->

</section>
