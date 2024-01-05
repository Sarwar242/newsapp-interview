@extends('admin.layouts.master')

@section('title', __('Profile'))

@section('content')
@php $user=auth()->user(); @endphp
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ __('My Profile') }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body py-sm-4">
                    <div class="border-bottom text-center pb-2">
                        <div class="mb-3 border-bottom">
                            <img src="{{ $user->getAvatar() }}" alt="profile" class="img-lg rounded-circle mb-3">
                        </div>
                        <div class="mb-3">
                            <h3>{{ $user->getFullNameAttribute() }}</h3>

                        </div>
                    </div>
<!--
                    <div class="text-center mt-4">
                        <a href="{{ route('public.home') }}"
                            class="btn btn-sm btn2-light-secondary mb-2 mr-2">
                            <i class="fas fa-key"></i> Update Password
                        </a>
                        <a href="{{ route('public.home') }}" class="btn btn-sm btn-warning mb-2 mr-2">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table org-data-table table-bordered">
                        <tbody>
                            <tr>
                                <td>Phone</td>
                                <td> {{ $user ? $user->phone : 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> {{ $user->email }} </td>
                            </tr>
                            <tr>
                                <td>Joined At</td>
                                <td> {{ $user ? $user->created_at->format('d-m-Y H:i a') : "--:--:--" }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@include('admin.assets.dt')

@push('scripts')

<script type="text/javascript">

</script>
@endpush
