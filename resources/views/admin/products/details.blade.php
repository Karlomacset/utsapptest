

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
                                    <label>Select the Insurance Provider to Underwrite this product</label>
                                    <select class="form-control" name="provider_id">
                                        <option value=1 >Fortune Insurance Group</option>
                                        <option value=2>Generali Insurance</option>
                                        <option value=3>MVIT Insurance Corp</option>
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
                                @foreach($prod->getMedia('products') as $prodMedia)
                                    <img class="d-flex mr-3" src="{{$prodMedia->getUrl()}}" width="60"
                                                    alt="image">
                                @endforeach
                            </div>
                        </div>
                        