

                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="companyName" class="form-control form-control-line" 
                            value="{{isset($client) ? $client->companyName : old('title')}}"> 
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="firstName" class="form-control form-control-line"
                                    value="{{isset($client) ? $client->firstName : old('firstName')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lastName" class="form-control form-control-line"
                                    value="{{isset($client) ? $client->lastName : old('lastName')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="userName" class="form-control form-control-line"
                                    value="{{isset($client) ? $client->userName : old('userName')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control form-control-line"
                                    value="{{isset($client) ? $client->email : old('email')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uploadphoto" class="label-control">Upload Photo or Documents</label>
                                    <input type="file" class="form-control form-control-line" name="fileAttached" id="uploadphoto">
                                </div>
                            </div>
                            <div class="col-md-6">
                            @if($client ?? '')
                                @foreach($client->getMedia('products') as $clientMedia)
                                    <img class="d-flex mr-3" src="{{$clientMedia->getUrl()}}" width="60"
                                                    alt="image">
                                @endforeach
                            @endif
                            </div>
                        </div>
                        