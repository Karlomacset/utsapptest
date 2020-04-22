

                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="name" class="form-control form-control-line" 
                            value="{{isset($tenant) ? $tenant->name : old('name')}}"> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sub Domain</label>
                                    <input type="text" name="subdomain" class="form-control form-control-line"
                                    value="{{isset($tenant) ? $tenant->subdomain : old('subdomain')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alias Domain</label>
                                    <input type="text" name="alias_domain" class="form-control form-control-line"
                                    value="{{isset($tenant) ? $tenant->alias_domain : old('alias_domain')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Connection</label>
                                    <input type="text" name="connection" class="form-control form-control-line" placeholder="tenant_db"
                                    value="{{isset($tenant) ? $tenant->connection : old('connection')}}">
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
                            @if($tenant ?? '')
                                @foreach($tenant->getMedia('tenants') as $clientMedia)
                                    <img class="d-flex mr-3" src="{{$clientMedia->getUrl()}}" width="60"
                                                    alt="image">
                                @endforeach
                            @endif
                            </div>
                        </div>
                        