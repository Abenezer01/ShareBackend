@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class='alert alert-danger alert-block'>
 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="feather icon-x"></i>
                        </button>    <strong>{{$error}}
</strong>
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class='alert alert-success alert-block'>
 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="feather icon-x"></i>
        </button>        {{session('success')}}
    </div>
@endif
@if(session('warning'))
    <div class='alert alert-warning alert-block'>
 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="feather icon-x"></i>
        </button>        {{session('warning')}}
    </div>
@endif

@if(session('error'))
    <div class='alert alert-danger alert-block'>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
        <strong>{{session('error')}}</strong>
    </div>
@endif
