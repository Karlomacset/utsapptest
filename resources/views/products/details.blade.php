

                        <div class="form-group">
                            <label>Product Title</label>
                            <input type="text" name="title" class="form-control form-control-line" 
                            value="{{isset($prod) ? $prod->title : old('title')}}"> 
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea name="description" class="form-control" rows="2">{{isset($prod) ? $prod->description : old('description')}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select the Client to Sell this product</label>
                                    <select class="form-control" name="provider_id">
                                        @foreach($providers as $prov)
                                        <option value={{$prov->id}} {{(isset($prod)? ($prod->provider_id == $prov->id) ? 'selected': '': '')}} >{{$prov->companyName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Premium Amount</label>
                                    <input type="text" name="premium_amt" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->premium_amt : old('premium_amt')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Service Fee</label>
                                    <input type="text" name="service_fee" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->service_fee : old('service_fee')}}">
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
                            @if($prod ?? '')
                                @foreach($prod->getMedia('products') as $prodMedia)
                                    <img class="d-flex mr-3" src="{{$prodMedia->getUrl()}}" width="60"
                                                    alt="image">
                                @endforeach
                            @endif
                            </div>
                        </div>
                        