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
            <th>Pick Up</th>
            <th>Destination</th>
            <th>Stop Over</th>
            <th>Status</th>
            <th>No Of Seats</th>
            <th>Driver</th>
            <th>Time</th>
            <th>Date</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($rideOffers as $offer)
          @php
              $color="";
          @endphp
            @if($offer['status']['name'] === 'Completed')
              <?php $color = "success" ?>
            @elseif($offer['status']['name'] === 'OnGoing')
              <?php $color = "primary" ?>
            @elseif($offer['status']['name'] === 'Hold')
              <?php $color = "warning" ?>
            @elseif($offer['status']['name'] === 'Canceled')
              <?php $color = "danger" ?>
            @endif
            <?php
              $arr = array('success', 'primary', 'info', 'warning', 'danger');
            ?>
            <tr>
              <td></td>
              <td class="product-category">{{ $offer["pickup"] }}</td>
              <td class="product-category">{{ $offer["destination"] }}</td>
                <td class="product-category">{{ $offer["stopOver"] }}</td>

              <td>
                <div class="chip chip-{{$color}}">
                  <div class="chip-body">
                    <div class="chip-text">{{ $offer['status']['name']}}</div>
                  </div>
                </div>
              </td>
                <td class="product-price">{{ $offer["no_of_seats"] }}</td>
                <td class="product-price">{{ $offer["user"]["firstName"]." ".$offer["user"]["lastName"] }}</td>
                <td class="product-price">
                  {{ Carbon\Carbon::parse($offer['date'])->englishDayOfWeek }}
                </td>
              <td class="product-price">{{ $offer["created_at"] }}</td>
              <td class="product-action">
                <span class="action-edit"><i class="feather icon-edit"></i></span>
                <form action="{{ route('rideOffers.destroy', $offer) }}" method="post">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                    <span class="action-delete" onclick="confirm('{{ __("Are you sure you want to delete this Item?") }}') ? this.parentElement.submit() : ''"><i class="feather icon-trash"></i></span>
                </form>

              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- DataTable ends --}}

    {{-- add new sidebar starts --}
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
