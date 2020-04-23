<div class="add-new-data">
  <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
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
          <input type="text" class="form-control" name="name" id="data-name" value="{{ $user->name}}">
          </div>
          <div class="col-sm-12 data-field-col">
            <label for="data-category"> Role </label>
            <select class="form-control" name="category" id="data-category">
              <option value="">--Select--</option>
            @foreach ($user_type as $item)
            <option
            <?php $user['userTypeId']==$user_type['userTypeId']? print 'selected' :''?>
            value={{$user_type->userTypeId}}>{{$user_type->userTypeId}}</option>
            @endforeach
            </select>
          </div>
           <div class="col-sm-12 data-field-col">
            <label for="data-email">Email</label>
           <input type="email" class="form-control" name="email" id="data-email" value="{{$user['email']}}">
          </div>
           <div class="col-sm-12 data-field-col">
            <label for="data-phone">Phone Number</label>
            <input type="text" class="form-control" name="phone" id="data-phone" value="{{$user['phone']}}">
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
