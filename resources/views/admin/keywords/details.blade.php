
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keyword</label>
                                    <input type="text" name="title" class="form-control form-control-line" 
                                    value="{{isset($prod) ? $prod->title : old('title')}}"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Filter</label>
                                    <input type="text" name="filter" class="form-control form-control-line" 
                                    value="{{isset($prod) ? $prod->filter: old('filter')}}"> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="2">{{isset($prod) ? $prod->description : old('description')}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date & Time</label>
                                    <input type="date" name="dateTime" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->dateTime : old('dateTime')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="amount" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->amount : old('amount')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Number/Counter</label>
                                    <input type="text" name="number" class="form-control form-control-line"
                                    value="{{isset($prod) ? $prod->number : old('number')}}">
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
                                @foreach($prod->getMedia('keywords') as $prodMedia)
                                    <img class="d-flex mr-3" src="{{$prodMedia->getUrl()}}" width="60"
                                                    alt="image">
                                @endforeach
                                @endif
                            </div>
                        </div>
                        