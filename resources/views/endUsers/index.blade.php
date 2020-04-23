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
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Created_at</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($Users as $user)
          @php
              $color="";
          @endphp
            @if($user["order_status"] === 'delivered')
              <?php $color = "success" ?>
            @elseif($user["order_status"] === 'pending')
              <?php $color = "primary" ?>
            @elseif($user["order_status"] === 'on hold')
              <?php $color = "warning" ?>
            @elseif($user["order_status"] === 'canceled')
              <?php $color = "danger" ?>
            @endif
            <?php
              $arr = array('success', 'primary', 'info', 'warning', 'danger');
            ?>
            <tr>

              <td></td>
                <td class="product-name"><span>
                  @if(isset($user['avatar'][0]['avatarName']))
                  <img class="round" src="{{ asset('storage/images/avatar/'.$user['avatar'][0]['avatarName']) }}" height="40" width="40" />
                  @else
                  <img class="round" src="{{ asset('storage/images/avatar/noimage.jpg') }}" height="40" width="40" />
                  @endif
              </span> &nbsp;&nbsp;{{$user["firstName"]." ".$user["lastName"] }} </td>
              <td class="product-category">{{ $user["email"] }}</td>
              <td class="product-category">{{ $user["phone"] }}</td>
              <td>

              </td>
              <td class="product-price">{{ $user["created_at"] }}</td>
              <td class="product-action">
                <span class="action-edit"><i class="feather icon-edit"></i></span>
               @if(auth()->user()->id!=$user['id'])
                <form action="{{ route('endUsers.destroy', $user) }}" method="post">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                    <span class="action-delete" onclick="confirm('{{ __("Are you sure you want to delete this Item?") }}') ? this.parentElement.submit() : ''"><i class="feather icon-trash"></i></span>
                </form>
              @endif
              </td>
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
        <form method="post" action="{{ route('endUsers.store') }}" enctype="multipart/form-data">
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
                  <label for="data-name">First Name</label>
                  <input type="text" class="form-control" name="firstName" id="data-name">
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Last Name</label>
                  <input type="text" class="form-control" name="lastName" id="data-name">
                </div>

                 <div class="col-sm-12 data-field-col">
                  <label for="data-email">Email</label>
                  <input type="email" class="form-control" name="email" id="data-email">
                </div>
                 <div class="col-sm-12 data-field-col">
                  <label for="data-phone">Phone Number</label>
                  <input type="text" class="form-control" name="phone" id="data-phone">
                </div>
                <div>
                  <div class="col-sm-12 data-field-col">
                  <ul class="list-unstyled mb-0">
                    <li class="d-inline-block mr-2">
                      <fieldset>
                       <div class="vs-radio-con">
                          <input type="radio" name="gender" checked value="M">
                          <span class="vs-radio">
                            <span class="vs-radio--border"></span>
                            <span class="vs-radio--circle"></span>
                          </span>
                          <span class="">Male</span>
                        </div>
                      </fieldset>
                    </li>
                    <li class="d-inline-block mr-2">
                      <fieldset>
                        <div class="vs-radio-con">
                          <input type="radio" name="gender" value="F">
                          <span class="vs-radio">
                            <span class="vs-radio--border"></span>
                            <span class="vs-radio--circle"></span>
                          </span>
                          <span class="">Female</span>
                        </div>
                      </fieldset>
                    </li>
                  </ul>
                </div>
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-password">Password</label>
                  <input type="password" class="form-control" name="password" id="data-password">
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-confirm-password">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm-password" id="confirm-password">
                </div>
                  <div class="col-sm-12 data-field-col">
                  <label for="data-avatarPreview">Avatar</label>
                  <input type="file" class="form-control" name="avatarPreview" id="data-avatarPreview">
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
        <script src="{{ asset(mix('js/scripts/ui/data-list-view.js')) }}"></script>
@endsection
