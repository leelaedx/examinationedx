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
                        <h5>{{ __('modal_edit') }} {{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route($route.'.update', [$row->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-block">
                        <!-- Form Start -->
                        <fieldset class="row scheduler-border">
                        <div class="form-group col-md-4">
                            <label for="category">{{ __('field_category') }} <span>*</span></label>
                            <select class="form-control" name="category" id="category" required>
                                <option value="">{{ __('select') }}</option>
                                @foreach( $categories as $category )
                                <option value="{{ $category->id }}" @if( $category->id == $row->category_id ) selected @endif>{{ $category->title }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_category') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="title">{{ __('field_title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $row->title }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_title') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="isbn">{{ __('field_isbn') }} <span>*</span></label>
                            <input type="text" class="form-control" name="isbn" id="isbn" value="{{ $row->isbn }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_isbn') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="author">{{ __('field_author') }} <span>*</span></label>
                            <input type="text" class="form-control" name="author" id="author" value="{{ $row->author }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_author') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="publisher">{{ __('field_publisher') }}</label>
                            <input type="text" class="form-control" name="publisher" id="publisher" value="{{ $row->publisher }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_publisher') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="edition">{{ __('field_edition') }}</label>
                            <input type="text" class="form-control" name="edition" id="edition" value="{{ $row->edition }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_edition') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="publish_year">{{ __('field_publish_year') }}</label>
                            <input type="text" class="form-control" name="publish_year" id="publish_year" value="{{ $row->publish_year }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_publish_year') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="language">{{ __('field_language') }}</label>
                            <input type="text" class="form-control" name="language" id="language" value="{{ $row->language }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_language') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="price">{{ __('field_price') }} ({!! $setting->currency_symbol !!})</label>
                            <input type="text" class="form-control autonumber" name="price" id="price" value="{{ round($row->price) }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_price') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="quantity">{{ __('field_quantity') }} <span>*</span></label>
                            <input type="text" class="form-control autonumber" name="quantity" id="quantity" value="{{ $row->quantity }}" required data-v-max="999999999" data-v-min="0">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_quantity') }}
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                          <div class="switch d-inline m-r-10">
                            <label>{{ __('eBook') }}</label>
                            <input type="checkbox" id="is_e_book" name="is_e_book" class="book-type" value="1" @if($row->is_e_book == 1)  checked @endif>
                            <label for="is_e_book" class="cr"></label>
                          </div>
                        </div>
                        

                        <div class="form-group col-md-2">
                          <div class="switch d-inline m-r-10">
                            <label>{{ __('Physical Book') }}</label>
                              <input type="checkbox" id="is_physical_book" name="is_physical_book"  value="1" @if($row->is_physical_book == 1)  checked @endif>
                              <label for="is_physical_book" class="cr"></label>
                          </div>
                        </div>

                        <div class="form-group col-md-4 d-none show-link">
                          <label for="">{{ __('Link') }} <span>*</span></label>
                          <input type="url" class="form-control autonumber" name="link" id="link" value="{{$row->link}}" required >
                        </div>
                        </fieldset>
                        <fieldset class="row scheduler-border">
                        <legend>{{ __('field_location') }}</legend>
                        <div class="form-group col-md-4">
                            <label for="section">{{ __('field_rack') }}</label>
                            <input type="text" class="form-control" name="section" id="section" value="{{ $row->section }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_rack') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="column">{{ __('field_column') }}</label>
                            <input type="text" class="form-control" name="column" id="column" value="{{ $row->column }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_column') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="row">{{ __('field_row') }}</label>
                            <input type="text" class="form-control" name="row" id="row" value="{{ $row->row }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_row') }}
                            </div>
                        </div>
                        </fieldset>

                        <fieldset class="row scheduler-border">
                        <div class="form-group col-md-6">
                            <label for="description">{{ __('field_description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ $row->description }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_description') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="note">{{ __('field_note') }}</label>
                            <textarea class="form-control" name="note" id="note">{{ $row->note }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_note') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="status" class="form-label">{{ __('select_status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" @if( $row->status == 1 ) selected @endif>{{ __('status_available') }}</option>
                                <option value="2" @if( $row->status == 2 ) selected @endif>{{ __('status_damage') }}</option>
                                <option value="0" @if( $row->status == 0 ) selected @endif>{{ __('status_lost') }}</option>
                            </select>
                        </div>
                        </fieldset>
                        <!-- Form End -->
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
<script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    if($('#is_e_book').prop('checked')==true){
      $('.show-link').removeClass('d-none');
    }else{
      $('.show-link').addClass('d-none');
    }
    $('.book-type').on('change',function() {
      if(this.checked){
        $('.show-link').removeClass('d-none');
      }else{
        $('.show-link').addClass('d-none');
      }
    });
  });
</script>
@endsection