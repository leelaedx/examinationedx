@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <form class="needs-validation" novalidate method="get" action="{{ route($route.'.index') }}">
                            <div class="row gx-2">
                                @include('common.inc.student_search_filter')

                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-info btn-filter"><i class="fas fa-search"></i> {{ __('btn_search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    @if(isset($rows))                
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_library_id') }}</th>
                                        <th>{{ __('field_student_id') }}</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_batch') }}</th>
                                        <th>{{ __('field_program') }}</th>
                                        <th>{{ __('field_phone') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>#{{ $row->member->library_id ?? '' }}</td>
                                        <td>
                                            @isset($row->student_id)
                                            <a href="{{ route('admin.student.show', $row->id) }}">
                                            #{{ $row->student_id ?? '' }}
                                            </a>
                                            @endisset
                                        </td>
                                        <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                        <td>{{ $row->batch->title ?? '' }}</td>
                                        <td>{{ $row->program->shortcode ?? '' }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td>
                                            @if(isset($row->member))
                                            @if( $row->member->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                            @endif
                                            @else
                                            <span class="badge badge-pill badge-primary">{{ __('status_pending') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                        @can($access.'-create')
                                        @if(isset($row->member))
                                        @if($row->member->status == 1)

                                            @can($access.'-card')
                                            @if(isset($print))
                                            <a href="#" class="btn btn-sm btn-icon btn-warning" onclick="PopupWin('{{ route($route.'.card', $row->member->id) }}', '{{ $title }}', 800, 500);">
                                                <i class="fas fa-address-card"></i>
                                            </a>
                                            @endif
                                            @endcan

                                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal-{{ $row->id }}"><i class="fas fa-times"></i></button>
                                            @include($view.'.cancel')
                                        @else
                                            <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#approveModal-{{ $row->id }}"><i class="fas fa-check"></i></button>
                                            @include($view.'.approve')
                                        @endif
                                        @else
                                            <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#addModal-{{ $row->id }}"><i class="fas fa-plus"></i></button>
                                            @include($view.'.create')
                                        @endif
                                        @endcan
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->


@endsection
@section('page_js')

@yield('sub-script')
@endsection