@extends('layouts.sbk')

@section('content')

<div class="row el-element-overlay">
    @foreach($products as $prod)
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1"> <img src="{{$prod->getFirstMediaUrl('products')}}"
                        alt="user" />
                    <div class="el-overlay">
                        <ul class="el-info">
                            <li><a class="btn default btn-outline image-popup-vertical-fit"
                                    href="{{route('product.edit',$prod)}}"><i
                                        class="icon-magnifier"></i></a></li>
                            <!-- <li><a class="btn default btn-outline" href="javascript:void(0);"><i
                                        class="icon-link"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="el-card-content">
                    <h4 class="mb-0">{{$prod->title}}</h4> <small>{{$prod->description}}</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

@endsection