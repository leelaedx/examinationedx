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
                        <h5>{{ __('modal_edit') }} {{@$row->student->full_name }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route($route.'.update', $row->id) }}" method="post" enctype="multipart/form-data">
                        <div class="wizard-sec-bg">
                            @csrf
                            @method('PUT')
                            <fieldset class="row scheduler-border">
                                <div class="col-md-6">
                                    <div class="form-group col-md-12">
                                        <label for="status" class="form-label">{{ __('Status') }} <span>*</span></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="">{{ __('Select Status') }}</option>
                                            @foreach($statuses as $key => $status)
                                                <option value="{{$key}}" @if($key == $row->status) selected @endif>{{$status['label']}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ __('Status') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="package">{{ __('Package') }} (in LPA)<span>*</span></label>
                                        <input type="number" class="form-control" name="package" id="package" value="{{$row->package}}" required>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('Package') }}
                                        </div> 
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-group col-md-12">
                                        <label for="note">{{ __('Note') }}</label>
                                        <textarea type="text" class="form-control" name="note" id="note"  rows="5">{{$row->note}}</textarea>
                                        <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ __('Note') }}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
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
