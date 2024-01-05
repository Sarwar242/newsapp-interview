<div class="row">

    <div class="col-md-12 mb-4">

        <div class="row text-center">

            <div class="col-md-6 col-12 p-3">
                <button class="btn btn-outline-success btn-lg font-weight-bolder btn2-success-active" id="signInBtn"> SignIn </button>
            </div>

            <div class="col-md-6 col-12 p-3">
                <button class="btn btn-lg btn-outline-youtube font-weight-bolder" id="signOutBtn"> SignOut </button>
            </div>

        </div>

        <div id="visitorSignInForm">

            <form method="post" action="{{ route('public.visitor.sign.in') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group row @error('name') error @enderror">
                            <label class="col-sm-12 col-form-label required inOutFont-good">{{ __('Name') }}</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="visitor_name" value="{{ old('name') }}"
                                    placeholder="{{ __('Name') }}" required>
                                @error('name')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row @error('name') error @enderror ">
                                    <label class="col-sm-12 col-form-label inOutFont-good">{{ __('Visiting To') }}</label>
                                    <div class="col-sm-12">
                                        <select class="form-control select-2" name="visited_to" id="kaimaihi">
                                            <option value="" class="selected highlighted">Select One</option>
                                            @foreach($kaimahies as $kaimahi)
                                            <option class="text-capitalize" value="{{ $kaimahi->employee->id }}"
                                                {{(old("category_type_id") == $kaimahi->employee->id) ? "selected" : ""}}>
                                                {{ $kaimahi->full_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_type_id')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label inOutFont-good">{{ __('Note') }}</label>
                            <div class="col-sm-12">
                                <textarea type="text" id="note" class="form-control todo-list-input" name="in_time_note"
                                    rows="6" placeholder="Add Note">{{ old('in_time_note') }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="modal-footer justify-content-center col-md-12">
                        {!! \App\Library\Html::btnSignIn() !!}
                    </div>
                </div>
            </form>

        </div>

        <div class=" d-none" id="visitorSignOutForm">

            <form method="post" action="{{ route('public.visitor.sign.out') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">

                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row @error('visitor_name') error @enderror ">
                                    <label class="col-sm-12 col-form-label inOutFont-good">{{ __('Visitor') }}</label>
                                    <div class="col-sm-12">
                                        <select class="form-control select-2" name="visitor_name" id="kaimaihi">
                                            <option value="" class="selected highlighted">Select One</option>
                                            @foreach($possibleVisitorToSignUp as $kaimahi)
                                            <option class="text-capitalize" value="{{ $kaimahi->id }}"
                                                {{(old("visitor_name") == $kaimahi->visitor_name) ? "selected" : ""}}>
                                                {{ $kaimahi->visitor_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('visitor_name')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label inOutFont-good">{{ __('Note') }}</label>
                            <div class="col-sm-12">
                                <textarea type="text" id="note" class="form-control todo-list-input" name="out_time_note"
                                    rows="6" placeholder="Add Note">{{ old('out_time_note') }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="modal-footer justify-content-center col-md-12">
                        {!! \App\Library\Html::btnSignOut() !!}
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
