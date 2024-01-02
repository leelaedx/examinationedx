@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
    <!-- Wizard css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/wizard.css') }}">
@endsection

@section('content')
<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Card ] start -->
            <div class="col-sm-6 mx-auto">
                <div class="card d-flex justify-content-center">
                    <div class="card-header">
                        <h5>{{ __('modal_add') }} {{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.create') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                        <div class="wizard-sec-bg">
                          @csrf
                          <input type="hidden" name="status" value="{{ App\Models\FeeRegister::STATUS_OPEN}}">
                            <!-- Form Start -->
                                <fieldset class="row scheduler-border">
                                <div class="col-md-12">
                                   <div class="form-group col-md-12">
                                        <label for="date">{{ __('Date') }} <span>*</span></label>
                                        <input type="date" class="form-control" name="date" id="date" value="{{now()->format('Y-m-d')}}" required>
                                        <div class="invalid-feedback">
                                          {{ __('required_field') }} {{ __('date') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 ">
                                    <label for="bank_id" class="form-label">{{ __('Deposited Bank') }} </label>
                                    <select   class="form-control select2"  name="bank_id" id="bank_id">
                                        <option value=""> Select Name</option>
                                        @foreach($collegebank as $college)
                                            <option value="{{ $college->id }}"> {{ $college->bank->name}} | {{ $college->account_holder_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ __('field_college_banks') }}
                                    </div>
                                    </div>
                                  
                                    {{-- <div class="form-group col-md-12">
                                        <label for="status">{{ __('field_status') }}</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">Select Status</option>
                                                @foreach ($statuses as $key => $status)
                                                <option value="{{$key}}">{{ $status['label'] }}</option>
                                                @endforeach
                                            </select>
                                        <div class="invalid-feedback"> {{ __('field_status') }}
                                        </div>
                                    </div> --}}
                               
                               
                                    <div class="form-group col-md-12">
                                        <label for="note">{{ __('Note') }} </label>
                                        <textarea type="text" class="form-control" name="note" id="note" value="" rows="3"></textarea>
                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('note') }}
                                        </div>
                                    </div>
                                </div>
                                </fieldset>
                              </div>
                          <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- [ Card ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection

@section('page_js')
    <!-- validate Js -->
    <script src="{{ asset('dashboard/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

    <!-- Wizard Js -->
    <script src="{{ asset('dashboard/js/pages/jquery.steps.js') }}"></script>

    <script type="text/javascript">
        "use strict";
        var form = $("#wizard-advanced-form").show();

        form.steps({
            headerTag: "h3",
            bodyTag: "content",
            transitionEffect: "slideLeft",
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex)
                {
                    return true;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex)
            {
                
            },
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                $("#wizard-advanced-form").submit();
            }
        }).validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {

            }
        });
    </script>


<!-- Filter Search -->
@endsection