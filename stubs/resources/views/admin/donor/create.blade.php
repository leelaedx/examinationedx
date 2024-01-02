@extends('admin.layouts.master')
@section('title', $title)
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
                        <h5>{{ __('modal_add') }} {{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.create') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>

                </div>
            </div>
            <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="donor_type">Donor Type</label>
                                                <select class="form-control" name="donor_type" id="donor_type">
                                                    <option value="">{{ __('select') }}</option>
                                                    @foreach ($types as $key => $type)
                                                    <option value="{{$key}}">{{ $type['label'] }}</option>
                                                    @endforeach
                                                </select>
                                            <div class="invalid-feedback"> {{ __('field_status') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="donor_name">Donor Name<span>*</span></label>
                                            <input type="text" class="form-control" name="donor_name" id="donor_name" value="{{ old('donor_name') }}" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="contact_name">Contact Name<span>*</span></label>
                                            <input type="text" class="form-control" name="contact_name" id="contact_name" value="{{ old('contact_name') }}" required>
                                        </div>
                                      
                                      
                                        <div class="form-group col-md-12">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" >
        
                                            <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_email') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control" name="phone" id="phone"  min="0" value="{{ old('phone') }}" >
        
                                            <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_phone') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="note">Note</label>
                                            <textarea type="text" class="form-control" name="note" id="note" rows="7" >{{ old('note') }}</textarea>
                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_note') }}
                                            </div>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="address">Address</label>
                                            <textarea type="text" class="form-control" name="address" id="address" rows="7">{{ old('address') }}</textarea>
                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_address') }}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                             </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
             
        
            <!-- [ Card ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection