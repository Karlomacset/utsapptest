            <div class="row page-titles">
                    <div class="col-md-5 col-12 align-self-center">
                        <h3 class="text-themecolor">{{$ps['pagename']}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">{{$ps['pagename']}}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                        <div class="d-flex mt-2 justify-content-end">
                            @if($dash ?? '')
                            <div class="d-flex mr-3 ml-2">
                                <div class="chart-text mr-2">
                                    <h6 class="mb-0"><small>THIS MONTH</small></h6>
                                    <h4 class="mt-0 text-info">P58,896</h4>
                                </div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex mr-3 ml-2">
                                <div class="chart-text mr-2">
                                    <h6 class="mb-0"><small>LAST MONTH</small></h6>
                                    <h4 class="mt-0 text-primary">P48,396</h4>
                                </div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            @elseif($ps['actionTyp'] == 'Create')
                                <div class="d-flex mr-3 ml2">
                                    <a class="btn btn-success" href="{{route($ps['actionHed'].'.store')}}" >Save {{$ps['actionHed']}}</a>
                                </div>
                            @elseif($ps['actionTyp'] == 'Edit' )
                                <div class="d-flex mr-3 ml2">
                                    <a class="btn btn-success" href="{{route($ps['actionHed'].'.update',$prod->id)}}" >Save {{$ps['actionHed']}}</a>
                                </div>
                            @else
                                <div class="d-flex mr-3 ml2">
                                    <a class="btn btn-primary" href="{{route($ps['actionHed'].'.create')}}" >Add {{$ps['actionHed']}}</a>
                                </div>

                            @endif
                            <!-- <div class="">
                                <button
                                    class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right ml-2"><i
                                        class="ti-settings text-white"></i></button>
                            </div> -->
                        </div>
                    </div>
                </div>