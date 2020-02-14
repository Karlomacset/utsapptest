@extends('layouts.sbk')

@section('content')

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Sales Overview</h3>
                                                <h6 class="card-subtitle">Dengue Vs Gadgets</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item px-2">
                                                        <h6 class="text-success"><i
                                                                class="fa fa-circle font-10 mr-2 "></i>Dengue Ins</h6>
                                                    </li>
                                                    <li class="list-inline-item px-2">
                                                        <h6 class="text-info"><i
                                                                class="fa fa-circle font-10 mr-2"></i>CellPhone Ins</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="amp-pxl" style="height: 360px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Our Visitors </h3>
                                <h6 class="card-subtitle">Different Devices Used to Visit</h6>
                                <div id="visitor" style="height:290px; width:100%;"></div>
                            </div>
                            <div class="card-body text-center border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item px-2">
                                        <h6 class="text-info"><i class="fa fa-circle font-10 mr-2 "></i>Mobile</h6>
                                    </li>
                                    <li class="list-inline-item px-2">
                                        <h6 class=" text-primary"><i class="fa fa-circle font-10 mr-2"></i>Desktop</h6>
                                    </li>
                                    <li class="list-inline-item px-2">
                                        <h6 class=" text-success"><i class="fa fa-circle font-10 mr-2"></i>Tablet</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-md-12">
                        <div class="card blog-widget">
                            <div class="card-body">
                                <div class="blog-image"><img src="/assets/images/big/img1.jpg" alt="img"
                                        class="img-fluid blog-img-height w-100" /></div>
                                <h3>Business development new rules for 2020</h3>
                                <label class="badge badge-pill badge-success py-1 px-2">Technology</label>
                                <p class="my-3">
                                    Lorem ipsum dolor sit amet, this is a consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut
                                </p>
                                <div class="d-flex align-items-center">
                                    <div class="read"><a href="javascript:void(0)" class="link font-medium">Read
                                            More</a></div>
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" class="link mr-2" data-toggle="tooltip"
                                            title="Like"><i class="mdi mdi-heart-outline"></i></a> <a
                                            href="javascript:void(0)" class="link" data-toggle="tooltip"
                                            title="Share"><i class="mdi mdi-share-variant"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h3 class="card-title">Newsletter Campaign</h3>
                                        <h6 class="card-subtitle">Overview of Newsletter Campaign</h6>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item px-2">
                                                <h6 class="text-success"><i class="fa fa-circle font-10 mr-2 "></i>Open
                                                    Rate</h6>
                                            </li>
                                            <li class="list-inline-item px-2">
                                                <h6 class="text-info"><i class="fa fa-circle font-10 mr-2"></i>Recurring
                                                    Payments</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="campaign ct-charts"></div>
                                <div class="row text-center">
                                    <div class="col-lg-4 col-md-4 mt-3">
                                        <h1 class="mb-0 font-weight-light">5098</h1><small>Total Sent</small>
                                    </div>
                                    <div class="col-lg-4 col-md-4 mt-3">
                                        <h1 class="mb-0 font-weight-light">4156</h1><small>Mail Open Rate</small>
                                    </div>
                                    <div class="col-lg-4 col-md-4 mt-3">
                                        <h1 class="mb-0 font-weight-light">1369</h1><small>Click Rate</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-md-12">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="mr-3 align-self-center">
                                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1>
                                    </div>
                                    <div>
                                        <h3 class="card-title">Transaction Volume</h3>
                                        <h6 class="card-subtitle">March 2020</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <h2 class="font-weight-light text-white text-nowrap">50 GB</h2>
                                    </div>
                                    <div class="col-8 pb-3 pt-2 align-self-center">
                                        <div class="usage chartist-chart" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4 col-md-12">
                        <div class="card card-inverse card-success">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="mr-3 align-self-center">
                                        <h1 class="text-white"><i class="icon-cloud-download"></i></h1>
                                    </div>
                                    <div>
                                        <h3 class="card-title">Download count</h3>
                                        <h6 class="card-subtitle">March 2020</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <h2 class="font-weight-light text-white text-nowrap text-truncate">35487</h2>
                                    </div>
                                    <div class="col-8 pb-3 pt-2 text-right">
                                        <div class="spark-count" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <img class="rounded-top" src="/assets/images/background/weatherbg.jpg"
                                alt="Card image cap">
                            <div class="card-img-overlay" style="height:110px;">
                                <div class="d-flex align-items-center">
                                    <h3 class="card-title text-white mb-0 d-inline-block">Manila</h3>
                                    <div class="ml-auto">
                                        <small class="card-text text-white font-weight-light">Wednesday 19
                                            February</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body weather-small">
                                <div class="row">
                                    <div class="col-8 border-right align-self-center">
                                        <div class="d-flex">
                                            <div class="display-6 text-info"><i class="wi wi-day-rain-wind"></i></div>
                                            <div class="ml-3">
                                                <h1 class="font-weight-light text-info mb-0">32<sup>0</sup></h1>
                                                <small>Sunny Rainy day</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <h1 class="font-weight-light mb-0">25<sup>0</sup></h1>
                                        <small>Tonight</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->


@endsection