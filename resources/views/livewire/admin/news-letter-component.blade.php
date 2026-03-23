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
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],                    
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
            $('#summernote').on('summernote.change', function(we, contents, $editable) {
                @this.set('message', contents)          
                
            });
        });
    </script>
@endpush
<section class="section">
    <div class="section-header">
        <h1>{{ __('Newsletter') }}</h1>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div x-data="{ open: @entangle('open') }" class="mb-4">
                <button x-on:click="open = ! open" class="btn btn-primary">{{ __('Send News Letter...') }}</button>

                <div x-show="open" x-transition>
                    <form action="" wire:submit.prevent="sendNewsLetter">
                        @csrf
                     <div class="row mt-4">                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Subject') }}</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" wire:model="subject">
                                @error('subject') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                              <div class="form-group">
                                <label>{{ __('Message') }}</label>                                
                                <div wire:ignore>
                                    <textarea  class="form-control" name="message" id="summernote" cols="30" rows="10" wire:model.lazy="message"></textarea>
                                </div>                              
                                @error('message') <div class="invalid-feedback" style="display: block;">{{$message}}</div> @enderror
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
                            <th scope="col">ID</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($subscribes)
                            @foreach ($subscribes as $subscribe)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $subscribe->id }}</td>                                   
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
                        <p>{{ __('No items found.') }}</p>
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
                    <h5 class="modal-title">{{ __('Удаление') }}</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close"></button>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Вы действительно хотите удалить?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">{{ __('Отмена') }}</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" wire:click="destroy">{{ __('Удалить') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->

</section>
