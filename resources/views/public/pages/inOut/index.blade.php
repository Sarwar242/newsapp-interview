@extends('public.layout.master')

@section('title', 'Attendance')

@section('content')

<div class="content-wrapper d-flex justify-content-center">

    <div class="card shadow-sm col-xl-8 col-md-10 col-sm-12 col-12" style="height: min-content;" >

        <div class="card-body">
            <ul class="nav nav-tabs d-flex justify-content-between signinOut-tab" id="tabMenu" role="tablist">
                <li class="nav-item text-center">
                    <a class="nav-link default" data-toggle="tab" href="#tab-visitor" role="tab" aria-controls="One"
                        aria-selected="true" style="margin-right: 0px"> Visitor </a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link" data-toggle="tab" href="#tab-kaimahi" role="tab" aria-controls="Two"
                        aria-selected="false" style="margin-right: 0px"> Kaimahi </a>
                </li>
            </ul>

            <div class="tab-content mt-4" id="tabContent">
                <!-- Home -->
                <div class="tab-pane fade" id="tab-visitor" role="tabpanel" aria-labelledby="tab-home">
                    @include('public.pages.inOut.visitor')
                </div>

                <div class="tab-pane fade" id="tab-kaimahi" role="tabpanel" aria-labelledby="tab-donations">
                    @include('public.pages.inOut.kaimahi')
                </div>

            </div>
        </div>
    </div>
</div>

@stop
@include('admin.assets.select2')
@push('scripts')
@vite('resources/admin_assets/js/public/pages/inOut/index.js')
@endpush
