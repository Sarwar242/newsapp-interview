@extends('admin.layouts.master')

@section('title', __('Update Category'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
    {!! \App\Library\Html::linkBack(route('panel.categories')) !!}
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Category')) }}</h4>
        </div>

    </div>

    <div class="card shadow-sm">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('panel.category.update', $category->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-sm-3">

                            <div class="form-group row @error('name') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Name') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', $category->name) }}" placeholder="{{ __('Name') }}"
                                        required>
                                    @error('name')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row @error('parent_id') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Parent Category') }}</label>
                                <div class="col-sm-9">

                                    <select class="form-control select2" name="parent_id">
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach($categories as $key => $cat)
                                            <option class="text-capitalize" value="{{ $cat->id }}" {{ old("parent_id") ?? $category->parent_id == $cat->id ? "selected" : ""}}>
                                                {{ $cat->name }}
                                            </option>

                                            @foreach($cat->childrenCategories as $key => $subCategory)
                                                    @if ($subCategory->categories)
                                                    <option class="text-capitalize" value="{{ $subCategory->id }}" {{ old("parent_id") ?? $category->parent_id == $subCategory->id ? "selected" : ""}}>
                                                        &nbsp;-{{ $subCategory->name }}
                                                    </option>
                                                    @endif

                                                    @foreach($subCategory->childrenCategories as $key => $subSubCat)
                                                        @if ($subSubCat->categories)
                                                            <option class="text-capitalize" value="{{ $subSubCat->id }}" {{ old("parent_id") ?? $category->parent_id == $subSubCat->id ? "selected" : ""}}>
                                                                &nbsp;&nbsp;--{{ $subSubCat->name }}
                                                            </option>
                                                        @endif

                                                        @foreach($subSubCat->childrenCategories as $key => $subSub2Cat)
                                                            @if ($subSub2Cat->categories)
                                                                <option class="text-capitalize" value="{{ $subSub2Cat->id }}" {{ old("parent_id") ?? $category->parent_id == $subSub2Cat->id ? "selected" : ""}}>
                                                                    &nbsp;&nbsp;&nbsp;---{{ $subSub2Cat->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('parent_id')
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
@vite('resources/admin_assets/js/select2.js')
@endpush
