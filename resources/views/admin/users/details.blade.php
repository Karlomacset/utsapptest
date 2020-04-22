
<div class="row">

<div class="col-md-6">
    <div class="form-group">
        <label for="firstName" class="col-sm-4 control-label">Full Name</label>
        <div class="col-sm-8">
        <input type="text" name="name" required="required" class="form-control" value="{{isset($prod)? $prod->name : old('name')}}">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-4 control-label">Your Email Address</label>
        <div class="col-sm-8">
            <input id="email" class="form-control" type="text" name="email" value="{{isset($prod)? $prod->email : old('email')}}">
        </div>
    </div>
    <div class="form-group">
        <label for="uploadphoto" class="label-control">Upload Photo or Documents</label>
        <input type="file" class="form-control form-control-line" name="fileAttached" id="uploadphoto">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="password" class="col-sm-4 control-label" >Password</label>
        <div class="col-sm-8">
            <input  class="form-control" type="password" name="password" >    
        </div>
        
    </div>
    <div class="form-group">
        <label for="confirm" class="col-sm-4 control-label">Confirm Password</label>
        <div class="col-sm-8">
            <input class="form-control" type="password" name="password_confirmation">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Select the Role for this User</label>
            <select class="form-control" name="role">
                @foreach($roles as $role)
                <option>{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

</div>