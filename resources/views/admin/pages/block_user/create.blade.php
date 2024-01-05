@extends('admin.layouts.master')

@section('title', __('Block User'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        {!! \App\Library\Html::linkBack(route('admin.advanced.block_user.index')) !!}
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Block User')) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm col-md-6">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.advanced.block_user.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-sm-3">

                            <div class="form-group row @error('employee_id') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Employee') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="employee_id" id="employee_id" required>
                                        <option value="" class="selected highlighted">Select</option>
                                        @foreach($employees as $employee)
                                        <option class="text-capitalize" value="{{ $employee->id }}" {{(old("employee_id")==$employee->id) ?
                                            "selected" : ""}}>
                                            {{ $employee->id }}--{!! $employee->f_name !!}-{!! $employee->l_name !!}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('client_id') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Client') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="client_id" id="client_id" required>
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach($clients as $client)
                                        <option class="text-capitalize" value="{{ $client->id }}" {{(old("client_id")==$client->id) ?
                                            "selected" : ""}}>
                                            {{ $client->id }}--{{ $client->f_name }}-{!! $client->l_name !!}</option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="modal-footer justify-content-center col-md-12">
                        {!! \App\Library\Html::btnReset() !!}
                        {!! \App\Library\Html::btnSubmit() !!}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@include('admin.assets.select2')

@push('scripts')
@vite('resources/admin_assets/js/pages/block_user/create.js')
@endpush