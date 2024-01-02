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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('modal_edit') }} {{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>


                    <form class="needs-validation" novalidate action="{{ route($route.'.update', $row->id) }}" method="post" enctype="multipart/form-data">
                        <div class="wizard-sec-bg">
                            @csrf
                            @method('PUT')

                            <div class="row">
                            <div class="col-md-12">
                            <fieldset class="row scheduler-border">
                            <div class="form-group col-md-6">
                                <label for="name">{{ __('field_name') }} <span>*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $row->name }}" required>

                                <div class="invalid-feedback">
                                {{ __('required_field') }} {{ __('field_name') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="start_date">{{ __('field_start_date') }} </label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $row->start_date }}">

                                <div class="invalid-feedback">
                                     {{ __('field_start_date') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Subject <span>*</span></label>
                                <select class="form-control" name="subject_id" id="subject_id"required>
                                    <option value=""selected>{{ __('Select Subject') }}</option>
                                    @foreach ($subjects as $key => $subject)
                                        <option value="{{$subject->id}}" @if($row->subject_id == $subject->id) selected @endif>{{ $subject->title }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                {{ __('required_field') }} Chapter
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Subject <span>*</span></label>
                                <select class="form-control" name="chapter_id" id="chapter_id"required>
                                  <option value="">{{ __('Select Chapter') }}</option>
                                  @foreach ($chapters as $key => $chapter)
                                      <option value="{{$chapter->id}}" @if($row->chapter_id == $chapter->id) selected @endif>{{ $chapter->name }}</option>
                                  @endforeach
                              </select>
                                <div class="invalid-feedback">
                                  {{ __('required_field') }} Chapter
                                </div>
                            </div>

                          

                            <div class="form-group col-md-6">
                                <label for="end_date">{{ __('field_end_date') }}</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $row->end_date }}">

                                <div class="invalid-feedback">
                                {{ __('required_field') }} {{ __('field_end_date') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="note">{{ __('field_note') }}</label>
                                <textarea name="note" id="note" rows="6"class="form-control">{{$row->note}}</textarea>
                                <div class="invalid-feedback">{{ __('field_note') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="status">{{ __('field_status') }}</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">{{ __('select') }}</option>
                                    @foreach ($statuses as $key => $status)
                                    <option value="{{$key}}" @if($key == $row->status) selected @endif>{{ $status['label'] }}</option>
                                    @endforeach
                                </select>

                                <div class="invalid-feedback">
                                {{ __('required_field') }} {{ __('field_status') }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_update') }}</button>
                            </div>
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

<script>
        $("#subject_id").on('change',function(e){
            e.preventDefault(e);
            var chapter=$("#chapter_id");
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: "{{ route('filter-chapter') }}",
                data:{
                _token:$('input[name=_token]').val(),
                id:$(this).val()
                },
                success:function(response){
                    console.log("Okk");
                    // var jsonData=JSON.parse(response);
                    $('option', chapter).remove();
                    $('#chapter_id').append('<option value=""readonly>{{ __("Select chapter") }}</option>');
                    $.each(response, function(){
                    $('<option/>', {
                        'value': this.id,
                        'text': this.name
                    }).appendTo('#chapter_id');
                    });
                }

            });
        });
</script>

@endsection