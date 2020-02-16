

                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="companyName" class="form-control form-control-line" 
                            value="{{isset($prod) ? $prod->companyName : old('companyName')}}"> 
                        </div>
                        <div class="form-group">
                            <label>Company Narrative</label>
                            <textarea name="narrative" class="form-control" rows="2">{{isset($prod) ? $prod->narrative : old('narrative')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address1" class="form-control form-control-line" 
                            value="{{isset($prod) ? $prod->address1 : old('address1')}}"> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->city : old('city')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Province/State</label>
                                    <input type="text" name="state" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->state : old('state')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" name="zipCode" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->zipCode : old('zipCode')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Contact Person</label>
                                    <input type="text" name="contactPerson" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->contactPerson : old('contactPerson')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" name="mobileNo" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->mobileNo : old('mobileNo')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phoneNo" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->phoneNo : old('phoneNo')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="text" name="email" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->email : old('email')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Website URL</label>
                                    <input type="text" name="website" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->website : old('website')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>API Key</label>
                            <input type="text" name="apiKey" class="form-control form-control-line" 
                            value="{{isset($prod) ? $prod->apiKey : old('apiKey')}}"> 
                        </div>
                        <div class="form-group">
                            <label>API Secret Key</label>
                            <input type="text" name="apiSecret" class="form-control form-control-line" 
                            value="{{isset($prod) ? $prod->apiSecret : old('apiSecret')}}"> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uploadphoto" class="label-control">Upload Photo or Documents</label>
                                    <input type="file" class="form-control form-control-line" name="fileAttached" id="uploadphoto">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($prod ?? '')
                                    @foreach($prod->getMedia('gateways') as $prodMedia)
                                        <img class="d-flex mr-3" src="{{$prodMedia->getUrl()}}" width="150"
                                                        alt="image">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        