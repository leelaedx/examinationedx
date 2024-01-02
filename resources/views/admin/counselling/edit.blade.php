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
                        <h5>{{ __('modal_edit') }} <span class="fw-bolder fst-italic">
                            {{@$row->student->first_name}} {{@$row->student->last_name}} 's</span> {{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route($route.'.update', [$row->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-block">
                        <div class="row">
                             <!-- Form Start -->
                             <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="manager_ids">{{ __('field_manager') }} <span>*</span></label>
                                        <select class="form-control" name="manager_ids" id="manager_ids" required>
                                            <option value="">{{ __('select') }}</option>
                                            @foreach($managers as $manager)
                                                <option value="{{$manager->id}}"@if($row->manager_ids == $manager->id)selected @endif>{{ $manager->first_name }} {{ $manager->last_name }}</option>
                                            @endforeach
                                        </select>
        
                                        <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ __('field_manager') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="date" class="form-label">{{ __('field_date') }} <span>*</span></label>
                                        <input type="date" class="form-control" name="date" id="date" value="{{$row->date}}" required>
        
                                        <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ __('field_date') }}
                                        </div>
                                    </div>
        
                                    
                                    <div class="form-group col-md-12">
                                        <label for="time">{{ __('field_time') }} <span>*</span></label>
                                        <input type="time" class="form-control" name="time" id="time" value="{{$row->time}}" required >
        
                                        <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ __('field_time') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="counselling_category_id">{{ __('field_category') }} <span>*</span></label>
                                        <select class="form-control" name="counselling_category_id" id="counselling_category_id" required>
                                            <option value="">{{ __('select') }}</option>
                                            @foreach($counselling_categories as $category)
                                                <option value="{{ $category->id }}" @if($row->counselling_category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
        
                                        <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ __('field_manager') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="note">{{ __('field_status') }} <span>*</span></label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="">{{ __('select') }}</option>
                                                @foreach ($statuses as $key => $status)
                                                    <option value="{{$key}}" @if( $key == $row->status ) selected @endif>{{ $status['label'] }}</option>
                                                @endforeach
                                            </select>
        
                                            <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_status') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="note">{{ __('field_note') }} <span>*</span></label>
                                            <textarea type="text" class="form-control" name="note" id="note"rows="8" value="{{ old('note') }}" required>{{$row->note}}</textarea>
        
                                            <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_note') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4"></div>
                        <!-- Form End -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_update') }}</button>
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