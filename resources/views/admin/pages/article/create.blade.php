@extends('admin.layouts.master')

@section('title', __('New Post'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        {!! \App\Library\Html::linkBack(route('panel.news.articles')) !!}
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Article')) }}</h4>
        </div>

    </div>

    <div class="card shadow-sm">
        <div class="card-body m-3">
            <form method="post" action="{{ route('panel.news.articles.create') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="count" name="count" value="1">
                <div class="row">

                    <div class="col-md-10">
                        <div class="form-group row @error('title') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                    placeholder="{{ __('Title') }}" required>
                                @error('title')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('article') error @enderror">

                            <label class="col-sm-3 col-form-label required">{{ __('Article') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="summernote"
                                    name="article">{{ old('article') }}</textarea>
                                @error('article')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('category_id') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Category') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id" id="categories" required>
                                    <option value="" class="selected highlighted">Select One</option>
                                    @foreach($categories as $key => $category)
                                    <option class="text-capitalize" value="{{ $category->id }}"
                                        {{ old("category_id") == $category->id ? "selected" : ""}}>
                                        {{ $category->name }}
                                    </option>

                                    @foreach($category->childrenCategories as $key => $subCategory)
                                    @if ($subCategory->categories)
                                    <option class="text-capitalize" value="{{ $subCategory->id }}"
                                        {{ old("category_id") == $subCategory->id ? "selected" : ""}}>
                                        &nbsp;-{{ $subCategory->name }}
                                    </option>
                                    @endif

                                    @foreach($subCategory->childrenCategories as $key => $subSubCat)
                                    @if ($subSubCat->categories)
                                    <option class="text-capitalize" value="{{ $subSubCat->id }}"
                                        {{ old("category_id") == $subSubCat->id ? "selected" : ""}}>
                                        &nbsp;&nbsp;--{{ $subSubCat->name }}
                                    </option>
                                    @endif

                                    @foreach($subSubCat->childrenCategories as $key => $subSub2Cat)
                                    @if ($subSub2Cat->categories)
                                    <option class="text-capitalize" value="{{ $subSub2Cat->id }}"
                                        {{ old("category_id") == $subSub2Cat->id ? "selected" : ""}}>
                                        &nbsp;&nbsp;&nbsp;---{{ $subSub2Cat->name }}
                                    </option>
                                    @endif
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </select>
                                @error('category_id')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('thumb') error @enderror">
                            <label class="col-sm-3 col-form-label" for="thumb">{{ __('Thumb') }}</label>
                            <div class="col-sm-9">
                                <div class="file-upload-section">
                                    <input name="thumb" type="file" class="form-control hidden_file"  allowed="png,gif,jpeg,jpg">
                                    <div class="input-group col-xs-12">
                                        <input type="text"
                                            class="form-control file-upload-info @error('thumb') error @enderror"
                                            disabled="" readonly placeholder="Type: picture and max 200kB">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-outline-secondary"
                                                type="button"><i class="fas fa-upload"></i> Browse</button>
                                        </span>
                                    </div>
                                    <div class="display-input-image d-none">
                                            <img src="{{ asset(\App\Library\Enum::NO_IMAGE_PATH) }}"
                                                alt="Preview Image" />
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger file-upload-remove"
                                                title="Remove">x</button>
                                        </div>
                                    @error('thumb')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row @error('picture') error @enderror">
                            <label class="col-sm-3 col-form-label" for="picture">{{ __('Picture') }}</label>
                            <div class="col-sm-9">
                                <div class="file-upload-section">
                                    <input name="picture" type="file" class="form-control hidden_file"  allowed="png,gif,jpeg,jpg">
                                    <div class="input-group col-xs-12">
                                        <input type="text"
                                            class="form-control file-upload-info @error('picture') error @enderror"
                                            disabled="" readonly placeholder="Type: picture and max 2000kB">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-outline-secondary"
                                                type="button"><i class="fas fa-upload"></i> Browse</button>
                                        </span>
                                    </div>
                                    <div class="display-input-image d-none">
                                            <img src="{{ asset(\App\Library\Enum::NO_IMAGE_PATH) }}"
                                                alt="Preview Image" />
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger file-upload-remove"
                                                title="Remove">x</button>
                                        </div>

                                    @error('picture')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2 justify-content-center">
                    <div class="modal-footer justify-content-center col-md-12">
                        <button type="submit" class="btn mr-3 my-3 btn2-secondary"><i class="fas fa-save"></i>
                            Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@stop
@include('admin.assets.select2')
@include('admin.assets.summernote-text-editor')

@push('scripts')
@vite('resources/admin_assets/js/pages/post/create.js')
@endpush
