<div class="row">
    <div class="col-md-12">

        <form method="post" action="{{ route('public.employee.attendance') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="can_sign_in" value="yes" id="can_sign_in">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row @error('name') error @enderror ">
                                <label class="col-sm-12 col-form-label inOutFont-good required ">{{ __('Kaimahi') }}</label>
                                <div class="col-sm-12">
                                    <select class="form-control select-2" name="employee_id" id="kaimaihiList" required>
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach($kaimahies as $kaimahi)
                                        <option class="text-capitalize" value="{{ $kaimahi->employee->id }}"
                                            {{(old("employee_id") == $kaimahi->employee->id) ? "selected" : ""}}>
                                            {{ $kaimahi->full_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="inDiv">
                        <div class="form-group row @error('name') error @enderror">
                            <label class="col-sm-12 col-form-label inOutFont-good">{{ __('Sign In Note') }}</label>
                            <div class="col-sm-12">
                                <textarea type="text" id="note" class="form-control todo-list-input" name="in_time_note"
                                    rows="6" placeholder="Add Note">{{ old('notes') }}</textarea>
                                @error('notes')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="outDiv d-none">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row @error('name') error @enderror">
                                <label
                                    class="col-sm-12 col-form-label inOutFont-good required">{{ __('Sign Out Type') }}</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="sign_out_type" id="break_type">
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach(\App\Library\Enum::getSignOutType() as $index => $value)
                                        <option class="text-capitalize" value="{{ $index }}" data-params="{{ $index }}"
                                            {{ (old("sign_out_type") == $index) ? "selected" : "" }}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('sign_out_type')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                    <span class="error-message text-danger" id="error-breakType"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id="break_time_div">
                            <div class="form-group row @error('expected_back_time') error @enderror">
                                <label class="col-sm-12 col-form-label inOutFont-good required">{{ __('Expected Back Time') }}</label>
                                <div class="col-sm-12">
                                    <input type="time" class="form-control" min="{{ now()->format('H:i') }}" max="23:59" name="expected_back_time" id="expected_back_time">
                                    @error('expected_back_time')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label inOutFont-good">{{ __('Sign Out Note') }}</label>
                        <div class="col-sm-12">
                            <textarea type="text" id="note" class="form-control todo-list-input" name="out_time_note"
                                rows="6" placeholder="Add Note">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="modal-footer justify-content-center employeeIn col-md-12 d-none">
                    {!! \App\Library\Html::btnSignIn() !!}
                </div>

                <div class="modal-footer justify-content-center employeeOut col-md-12 d-none">
                    {!! \App\Library\Html::btnSignOut() !!}
                </div>
            </div>
        </form>

    </div>
</div>


@push('scripts')

<script>

</script>

@endpush
