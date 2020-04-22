@extends('layouts.app')

@section('content')

    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-6 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                    <div class="card-header border-0">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-title text-center">
                <!--        <img src="/app-assets/images/logo/logo-dark.png" alt="branding logo"> -->
                            {{env('APP_NAME','UTS Application Test')}}
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span>Company Registration</span>
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h1>Client UTS Application Registration for {{$ag->companyName}} was approved by You!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection