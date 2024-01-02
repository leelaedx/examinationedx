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
                        @can($access.'-create')
                        <a href="{{ route($route.'.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{ __('btn_add_new') }}</a>
                        @endcan

                        <a href="{{ route($route.'.index') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>{{__('ID')}}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Bank Name') }}</th>
                                        <th>{{ __('Bank Holder Name') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Entry') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Created At') }}</th>                                
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php 
                                    $fee = 0;
                                    $entry = 0;
                                @endphp
                                  @foreach( $rows as $key => $row )
                                    @php
                                        $paidFee = App\Models\Fee::where('fee_register_id',$row->id)->sum('paid_amount');
                                        $entry = App\Models\Fee::where('fee_register_id',$row->id)->count();
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{@$row->createdBy->full_name  ?? '--'}}</td>
                                        <td>{{ @$row->name->bank->name }}</td>
                                        <td>{{ @$row->name->account_holder_name }}</td>
                                        
                                        <td>{{ @$row->date }}</td>
                                        <td>{{ @$entry }}</td>
                                        <td>{{ round($paidFee,2) }}</td>
                                        <td>
                                            <span class="badge badge-{{ App\Models\FeeRegister::STATUSES[$row->status]['color'] }}">{{ App\Models\FeeRegister::STATUSES[$row->status]['label'] }}</span>
                                        </td>
                                        <td>{{$row->created_at ?? '--'}}</td>
                                      
                                        <td>
                                            @can($access.'-edit')
                                            <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-icon btn-primary btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
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