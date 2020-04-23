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
            <th>Brand</th>
            <th>Model</th>
            <th>Year</th>
            <th>Plate No</th>
            <th>Owner</th>
            <th>Created_at</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($Vehicles as $vehicle)
          @php
              $color="";
          @endphp
            @if($vehicle["order_status"] === 'delivered')
              <?php $color = "success" ?>
            @elseif($vehicle["order_status"] === 'pending')
              <?php $color = "primary" ?>
            @elseif($vehicle["order_status"] === 'on hold')
              <?php $color = "warning" ?>
            @elseif($vehicle["order_status"] === 'canceled')
              <?php $color = "danger" ?>
            @endif
            <?php
              $arr = array('success', 'primary', 'info', 'warning', 'danger');
            ?>
            <tr>
              <td></td>
              <td class="product-name">{{$vehicle["brand"] }} </td>
              <td class="product-category">{{ $vehicle["model"] }}</td>
              <td class="product-category">{{ $vehicle["year"] }}</td>

              <td class="product-category">{{ $vehicle["plateNo"] }}</td>
              <td>
                <div class="product-category">

                <button class="btn btn-link" data-toggle="modal" data-target="#{{$vehicle['vehicleId']}}">
                    <div class="chip-text">{{ $vehicle["user"]['firstName']." ".$vehicle["user"]['lastName']}}</div>
                  </button>

                </div>
              </td>
              <td class="product-price">{{ $vehicle["created_at"] }}</td>
              <td class="product-action">
                <span class="action-edit"><i class="feather icon-edit"></i></span>
                <form action="" method="post">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                    <span class="action-delete" onclick="confirm('{{ __("Are you sure you want to delete this Item?") }}') ? this.parentElement.submit() : ''"><i class="feather icon-trash"></i></span>
                </form>
              </td>
            <div class="modal fade text-left" id="{{$vehicle['vehicleId']}}" tabindex="-1" role="dialog"
              aria-labelledby="myModalLabel18" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="card">

                  <div class="card-header modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel18">Owner</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12 profile-card-2">
                      <div class="modal-body">
                        <div class="card-header mx-auto pb-0">
                          <div class="row m-0">
                            <div class="col-sm-12 text-center">
                            <h4>{{ $vehicle["user"]['firstName']." ".$vehicle["user"]['lastName']}}</</h4>
                            </div>
                            <div class="col-sm-12 text-center">
                              <p class="">End User</p>
                            </div>
                          </div>
                        </div>
                        <div class="card-content">
                          <div class="card-body text-center mx-auto">
                            <div class="avatar avatar-xl">
                              <img class="img-fluid" src="{{ asset('storage/images/avatar/'.$vehicle['user']['avatar'][0]['avatarName']) }}"
                                alt="img placeholder">
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                              <div class="uploads">
                                <p class="font-weight-bold font-medium-2 mb-0">{{$vehicle['user']['vehicles']->count()}}</p>
                                <span class="">vehicles</span>
                              </div>
                              <div class="followers">
                                <p class="font-weight-bold font-medium-2 mb-0">78.6k</p>
                                <span class="">Followers</span>
                              </div>
                              <div class="following">
                                <p class="font-weight-bold font-medium-2 mb-0">112</p>
                                <span class="">Following</span>
                              </div>
                            </div>
                            <button class="btn gradient-light-primary btn-block mt-2">Follow</button>
                          </div>
                        </div>
                      </div>
                    </div
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
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
        <form method="post" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
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
                  <label for="data-name">Owner Id</label>
                  <input type="text" class="form-control" name="id" id="data-name">
                </div>

                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Brand</label>
                  <input type="text" class="form-control" name="brand" id="data-name">
                </div>
                 <div class="col-sm-12 data-field-col">
                  <label for="data-email">Model</label>
                  <select class="" name="" name="model">
                      <?php foreach ( json_decode(file_get_contents('data/vehicle-list.json'), true) as $item): ?>

                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-email">Year</label>
                  <input type="email" class="form-control" name="year" id="data-email">
                </div>
                 <div class="col-sm-12 data-field-col">
                  <label for="data-phone">Plate Number</label>
                  <input type="text" class="form-control" name="plateNumber" id="data-phone">
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
