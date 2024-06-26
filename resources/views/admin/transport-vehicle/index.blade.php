@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            @can($access.'-create')
            <div class="col-md-4">
                <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('btn_create') }} {{ $title }}</h5>
                        </div>
                        <div class="card-block">
                            <!-- Form Start -->
                            <div class="form-group">
                                <label for="number" class="form-label">{{ __('field_number') }} <span>*</span></label>
                                <input type="text" class="form-control" name="number" id="number" value="{{ old('number') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_number') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="type" class="form-label">{{ __('field_type') }} <span>*</span> </label>
                                <select class="form-control" name="type"  id="type" required >
                                    <option value="">{{ __('select') }}</option>
                                    @foreach (App\Models\TransportVehicle::TYPES as $key => $type)
                                    <option value="{{$type['label']}}">{{$type['label']}}</option>
                                    @endforeach
                                </select>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_type') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="capacity" class="form-label">{{ __('field_capacity') }}(No. of Persons)<span>*</span></label>
                                <input type="number" class="form-control" name="capacity" id="capacity" value="{{ old('capacity') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_capacity') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="route">{{ __('field_assign') }} {{ __('field_route') }} <span>*</span></label><br/>

                                @foreach($transportRoutes as $key => $transportRoute)
                                <br/>
                                <div class="checkbox d-inline">
                                    <input type="checkbox" class="route" name="routes[]" id="route-{{ $key }}" value="{{ $transportRoute->id }}">
                                    <label for="route-{{ $key }}" class="cr">{{ $transportRoute->title }}</label>
                                </div>
                                @endforeach

                                <div class="invalid-feedback">
                                {{ __('required_field') }} {{ __('field_route') }}
                                </div>
                            </div>
                            <!-- Form End -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            @endcan
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }} {{ __('list') }}</h5>
                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_number') }}</th>
                                        <th>{{ __('field_type') }}</th>
                                        <th>{{ __('field_capacity') }}</th>
                                        <th>{{ __('field_route') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->number }}</td>
                                        <td>{{ $row->type }}</td>
                                        <td>{{ $row->capacity }}</td>
                                        <td>
                                            @foreach($row->transportRoutes as $key => $transportRoute)
                                            <span class="badge badge-primary">{{ $transportRoute->title }}</span><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can($access.'-edit')
                                            <button type="button" class="btn btn-icon btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $row->id }}">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <!-- Include Edit modal -->
                                            @include($view.'.edit')
                                            @endcan

                                            @can($access.'-delete')
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')
                                            @endcan
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection