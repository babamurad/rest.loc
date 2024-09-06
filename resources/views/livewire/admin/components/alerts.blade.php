
@if(session('success'))
    <div class="alert alert-success alert-dismissible" style="margin-bottom: 0%; padding-top:0.5rem; padding-bottom:0.5rem; width: 40%; margin-left: 2em;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="top: -.2em; color: white;">×</button>
        <h5><i class="icon fas fa-check"></i> {{ session('success') }}</h5>
    </div>
@endif

@if (session('update'))
    <div class="alert alert-info alert-dismissible" style="margin-bottom: 0%; padding-top:0.5rem; padding-bottom:0.5rem;  width: 20%; margin-left: 2em;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="top: -.2em; color: white;">×</button>
        <h5><i class="icon fas fa-info"></i> {{ session('update') }}</h5>
    </div>
@endif

{{--@if(session('error'))--}}
{{--    <div class="alert alert-danger alert-dismissible" style="margin-bottom: 0%; padding-top:0.5rem; padding-bottom:0.5rem;  width: 20%; margin-left: 2em;">--}}
{{--        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="top: -.2em; color: white;">×</button>--}}
{{--        <h5><i class="icon fas fa-info"></i> {{ session('error') }}</h5>--}}
{{--    </div>--}}
{{--@endif--}}

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" style="  width: 40%; margin-left: 2em;">
        @foreach ($errors->all() as $error)
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"">×</button>
            <h5><i class="icon fas fa-ban"></i> {{ $error }}</h5>
        @endforeach
    </div>
@endif


