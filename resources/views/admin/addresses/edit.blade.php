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
                                    <label for="Model ">{{ __('Model') }} <span>*</span></label>
                                    <input type="text" class="form-control" name="model_type" id="model_type" value="{{$row->model_type}}" required>

                                    <div class="invalid-feedback">
                                    {{ __('required_field') }} {{ __('field_model_type') }}
                                    </div>  
                                </div>
                                <div class="form-group col-md-6">
                                <label for="type">{{ __('field_type') }}</label>
                                    <select class="form-control" name="type" id="type">
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($types as $key => $type)
                                        <option value="{{$key}}" @if( $key == $row->type ) selected @endif>{{ $type['label'] }}</option>
                                        @endforeach
                                    </select>
                                <div class="invalid-feedback"> {{ __('field_type') }}
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
