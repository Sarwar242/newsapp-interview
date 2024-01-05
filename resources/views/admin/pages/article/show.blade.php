@extends('admin.layouts.master')
@section('title', 'Post Details')

@section('content')
@php
$user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        {!! \App\Library\Html::linkBack(route('admin.post.index')) !!}
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Post Details')) }}</h4>
        </div>
    </div>

    <input type="hidden" value="{{ $post->id }}" id="postId">
    <!-- TabMenu Start -->
    <div class="card shadow-sm">
        <div class="card-body py-sm-4">
            <ul class="nav nav-tab" id="tabMenu" role="tablist">
                <li class="nav-item">
                    <a class="nav-link default home" data-toggle="tab" href="#tab-details" role="tab"
                        aria-controls="One" aria-selected="true">
                        Details
                    </a>
                </li>

                <li class="nav-item notes">
                    <a class="nav-link" data-toggle="tab" href="#tab-recipients" role="tab" aria-controls="Two"
                        aria-selected="false">
                        Recipients
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <!-- TabMenu End -->

    <div class="tab-content mt-4" id="tabContent">
        <!-- Home -->
        <div class="tab-pane fade" id="tab-details" role="tabpanel" aria-labelledby="tab-details">
            <div class="row">
                <div class="col-md-6">

                    <div class="card shadow-sm">
                        <div class="card-body py-sm-4">

                            <div class="border-bottom text-center pb-2">
                                <h3>{{ $post?->title }}</h3>
                            </div>

                            <div class="text-center mt-3 nav-tab border-bottom">
                                @if($user_role->hasPermission('post_update'))
                                <a href="{{ route('admin.post.update', $post->id) }}"
                                    class="btn btn-sm btn-warning mb-2 mr-2 tooltip-edit">

                                    <i class="fas fa-edit"></i></a>
                                @endif

                                @if($user_role->hasPermission('post_delete'))
                                <button class="btn btn-sm mb-2 mr-2 btn-danger tooltip-delete"
                                    onclick="confirmFormModal('{{ route('admin.post.delete', $post->id) }}', 'Confirmation', 'Are you sure to delete operation?')">

                                    <i class="fas fa-trash-alt"></i> </button>
                                @endif
                            </div>

                            <table class="table org-data-table table-bordered mt-2">
                                <tbody>
                                    <tr>
                                        <td class="text-center">Operator</td>
                                        <td>
                                            {{$post->operator->full_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"> Type</td>
                                        <td>
                                            {{$post->type}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Sending Date</td>
                                        <td>
                                            {{$post->sending_date}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Attachment</td>
                                        <td>
                                            @if($post->attachment)
                                                <a href="{{ asset($post->attachment) }}" target="_blank"><i
                                                        class="fa-solid fa-eye"></i> View </a>
                                            @else N/A @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Created Date</td>
                                        <td>
                                            {{$post->created_at}}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card shadow-sm mt-2">
                        <div class="card-body py-sm-4">
                            <div class="border-bottom text-center mb-3">
                                <h3>Description</h3>
                            </div>
                            {!! $post->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body py-sm-4">
                            <h4 class="card-title">Questions </h4>

                            @foreach($post->questions as $key => $qus)
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <strong> {{++$key}} .{{$qus->question}}</strong><br><br>
                                    <strong class="ml-3">Correct Answer => {{ $qus->correct_option }}</strong>
                                </div>
                                <div class="col-md-4">
                                    <p>A. {{ $qus->option1 }}</p>
                                    <p>B. {{ $qus->option2 }}</p>
                                    @if($qus->option3)<p>C. {{ $qus->option3 }}</p>@endif
                                    @if($qus->option3)<p>D. {{ $qus->option4 }}</p>@endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-recipients" role="tabpanel" aria-labelledby="tab-recipients">
            <div class="row">
                <div class="col-md-12">

                    <div class="card shadow-sm">
                        <div class="card-body py-sm-4">
                            <table id="dataTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Sending Status</th>
                                        <th>Sending Date</th>
                                        <th>Is Passed</th>
                                        <th>Seen</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@include('admin.assets.dt')
@include('admin.assets.dt-buttons')
@include('admin.assets.dt-buttons-export')

@push('scripts')
@vite('resources/admin_assets/js/pages/post/show.js')
@endpush