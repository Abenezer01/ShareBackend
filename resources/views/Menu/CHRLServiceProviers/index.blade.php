@extends('layouts/contentLayoutMaster')

@section('title', 'Service Providers')

@section('vendor-style')
        {{-- vendor files --}}
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
@endsection
@section('page-style')
        {{-- Page css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/pages/data-list-view.css')) }}">
@endsection

@section('content')

{{-- Data list view starts --}}
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<section id="data-list-view" class="data-list-view-header">
  <div class="action-btns d-none">
    <div class="btn-dropdown mr-1 mb-1">
      <div class="btn-group dropdown actions-dropodown">
        <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Actions
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
          <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
          <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
          <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another Action</a>
        </div>
      </div>
    </div>
  </div>
    {{-- DataTable starts --}}
    <div class="table-responsive">
      <table class="table data-list-view">
        <thead>
          <tr>
            <th></th>
            <th>
            </th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Numeber</th>
            <th>Catagory</th>
            <th>Is Open</th>
            <th>Admins</th>
            <th>Created_at</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($serviceProviders as $index=>$serviceProvider)

            <?php
              $arr = array('success', 'primary', 'info', 'warning', 'danger');
            ?>
            <tr>
              <td></td>
              <td>
                <img style="width: 100px;height: 100px" src="{{url(config('global.picturePaths.CHRLServiceProvider').$serviceProvider->getSelectedLogo()['fileName'])}}" id="logoPreview" class="img-thumbnail" alt="Cinque Terre" style="width:100%">
              </td>
              <td class="product-category">{{ $serviceProvider["id"] }}</td>
              <td class="product-name">{{ $serviceProvider["name"] }}</td>
              <td class="product-category">{{ $serviceProvider["email"] }}</td>
              <td class="product-category">{{ $serviceProvider["phone"] }} </td>
              <td class="product-category">{{ $serviceProvider["serviceCatagory"]['name'] }}</td>
              <td class="product-category">{{ $serviceProvider["isOpen"] }}</td>
              <td class="product-category">
                  @if ($serviceProvider->admins->count()==0)
                    <a class="todo-item-delete" data-toggle="modal" data-target="#{{$serviceProvider['id']}}"><i class="feather icon-plus"></i></a>
                  @else
                  @foreach ($serviceProvider->admins as $admin)
                  <div class="chip chip-secondary">
                  <div class="chip-body">
                    <div class="chip-text">{{$admin->firstName." ".$admin->lastName}}</div>
                  </div>
                </div>,
                  @endforeach
                  @endif
              </td>
              <td class="product-price">{{ $serviceProvider["created_at"] }}</td>
              <td class="product-action">
                <span class="action-edit"><i class="feather icon-edit"></i></span>
                <form action="{{ route('serviceProviders.destroy', $serviceProvider['id']) }}" method="post">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                    <span class="action-delete" onclick="confirm('{{ __("Are you sure you want to delete this Item?") }}') ? this.parentElement.submit() : ''"><i class="feather icon-trash"></i></span>
                </form>

              </td>
              <div class="modal fade text-left" id="{{$serviceProvider['id']}}" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card">
                        <div class="card-header d-flex justify-content-between">
                          <h4>Suggestions</h4>
                          <i class="feather icon-more-horizontal cursor-pointer"></i>
                        </div>
                        <div class="card-body">
                          <div class="search-bar">
                              <form id="form-{{$serviceProvider['id']}}" name="{{$serviceProvider['id']}}">
                                  <fieldset class="form-group position-relative has-icon-left">
                                      <input type="text" class="form-control round" id="
                                      " name="input-{{$serviceProvider['id']}}" value="">

                                      <div class="form-control-position">
                                          <i class="feather icon-search px-1"></i>
                                      </div>
                                  </fieldset>
                              </form>
                          </div>
                          <div id="endUserList-{{$index}}">

                          </div>
                          <button type="button" class="btn btn-primary w-100 mt-1"><i class="feather icon-plus mr-25"></i>Load More</button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </tr>
            <script type="text/javascript">
            $("#form-{{$serviceProvider['id']}}").submit(function (e) {
            e.preventDefault();
            var searchUserKey = $('input[name="input-{{$serviceProvider['id']}}"]').val();
            var proceed = true;
            var filteredUser;
            if (searchUserKey=== "") {
                $('input[name="input-{{$serviceProvider['id']}}"]').css('border-color', 'red');
                proceed = false;
            }
            // if (proceed)
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
              }
            });
               $.ajax({
                type: 'POST',
                url:'/endUsers/filter/'+searchUserKey,
                data:{key:searchUserKey},
                dataType: 'json',
                success: function (data) {
                filteredUser=data;
                console.log(data);
                var trHTML="";
                for(var i=0;i<filteredUser.length;i++){
                let trRow=`
                <form class="d-flex justify-content-start align-items-center mb-1" action="{{ route('userServiceProvider.store') }}" method="post">

                  <div class='avatar mr-50'>
                    <img src='{{ asset('images/portrait/small/avatar-s-5.jpg') }}' alt='avtar img holder' height='35' width='35'>
                  </div>
                  <div class='user-page-info'>
                    <h6 class='mb-0'>`+filteredUser[i].firstName+" "+filteredUser[i].lastName+`</h6>
                  </div>
                  @csrf
                  <input type="hidden" name="serviceProviderId" value={{$serviceProvider['id']}}>
                  <input type="hidden" name="endUserId" value=`+filteredUser[i].id+`>
                  <button type='submit' class='btn btn-primary btn-icon ml-auto'><i class='feather icon-user-plus'></i></button>
                </form>
                `;
                trHTML=trHTML+trRow;
                }
                $('#endUserList-{{$index}}').empty();
                $('#endUserList-{{$index}}').append(trHTML)
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

          });
            </script>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- DataTable ends --}}

    {{-- add new sidebar starts --}}
    <div class="add-new-data-sidebar">
      <div class="overlay-bg"></div>
      <div class="add-new-data">
        <form method="post" action="{{ route('serviceProviders.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
            <div>
              <h4 class="text-uppercase">List View Data</h4>
            </div>
            <div class="hide-data-sidebar">
              <i class="feather icon-x"></i>
            </div>
          </div>
          <div class="data-items pb-3">
            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Name</label>
                  <input type="text" class="form-control" name="name" id="data-name">
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Phone</label>
                  <input type="text" class="form-control" name="phone" id="data-name">
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Email</label>
                  <input type="email" class="form-control" name="email" id="data-name">
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Web Link</label>
                  <input type="url" class="form-control" name="webLink" id="data-name">
                </div>
                <div class="col-sm-12 data-field-col">
                  <select class="form-control" name="serviceCatagoryId">
                    <option value="">--Select--</option>
                      @foreach($serviceCatagories as $catagory)
                      <option value="{{$catagory['id']}}">{{$catagory['name']}}</option>
                      @endforeach
                  </select>
                </div>

                 <div class="col-sm-12 data-field-col">
                  <label for="data-phone">About</label>
                  <textarea class="form-control" name="about" id="editor"></textarea>
                </div>
                <div class="col-sm-12 data-field-col">
                 <label for="data-phone">About</label>
                 <input type="file" class="form-control" name="avatarPreview">
               </div>
            </div>
            </div>
          </div>
          <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
            <div class="add-data-btn">
              <input type="submit" class="btn btn-primary" value="Add Data">
            </div>
            <div class="cancel-data-btn">
              <input type="reset" class="btn btn-outline-danger" value="Cancel">
            </div>
          </div>
        </form>
      </div>
    </div>
    {{-- add new sidebar ends --}}
  </section>
  {{-- Data list view end --}}
@endsection
@section('vendor-script')
{{-- vendor js files --}}
        <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>

@endsection
@section('page-script')
        {{-- Page js files --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
        <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
        <script src="{{ asset(mix('js/scripts/ui/data-list-view.js')) }}"></script>
@endsection
