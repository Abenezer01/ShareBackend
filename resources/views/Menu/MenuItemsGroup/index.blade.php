@extends('layouts/contentLayoutMaster')

@section('title', 'List View')

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
            <th>Name</th>
            <th>description</th>
            <th>Created_at</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($menuItemsGroup as $item)
            <tr>
              <td></td>
              <td class="product-category">
                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#{{$item['id']}}">
                    {{ $item["name"] }}
                </button>
              </td>
              <td class="product-category">{!! $item["description"]!!}</td>
              <td class="product-price">{{ $item["created_at"] }}</td>
              <td class="product-action">
                <span class="action-edit"><i class="feather icon-edit"></i></span>

                <form action="{{ route('menuItemsGroup.destroy', $item->id) }}" method="post">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                    <span class="action-delete" onclick="confirm('{{ __("Are you sure you want to delete this Item?") }}') ? this.parentElement.submit() : ''"><i class="feather icon-trash"></i></span>
                </form>
              </td>
              <div class="modal-size-default mr-1 mb-1 d-inline-block">
                {{-- Button trigger modal --}}


                {{-- Modal --}}
                <div class="modal fade text-left" id="{{$item['id']}}" tabindex="-1" role="dialog"
                  aria-labelledby="myModalLabel18" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel18">{{ $item["name"] }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <?php if (isset($item->getSelectedLogo()['fileName'])): ?>
                          <img src="{{url(config('global.picturePaths.menuItemsGroup').$item->getSelectedLogo()['fileName'])}}" id="logoPreview" class="img-thumbnail" alt="Cinque Terre" style="width:100%">
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
    {{-- DataTable ends --}}

    {{-- add new sidebar starts --}}
    <div class="add-new-data-sidebar">
      <div class="overlay-bg"></div>
      <div class="add-new-data">
        <form method="post" action="{{ route('menuItemsGroup.store') }}" enctype="multipart/form-data">
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
                  <label for="data-description">Description</label>
                  <textarea  name="description" id="editor"></textarea>
                </div>
                  <div class="col-sm-12 data-field-col">
                  <label for="data-avatarPreview">Image</label>
                  <input type="file" class="form-control" name="picturePreview" id="data-avatarPreview">
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
        <script>
        var editor = new Quill('#editor');
        </script>
@endsection
@section('page-script')
        {{-- Page js files--}}
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
