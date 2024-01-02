@include('admin.banks-info.create')
<div class="mt-3">
   <fieldset class="row scheduler-border">
      <div class="d-flex justify-content-between">
            <div>
               <legend>{{ __('field_bank_information') }}</legend>
            </div>
            <div>
               <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#createBankInfoModal-{{ $student->id }}" type="button" class="btn btn-info"><i class="fas fa-plus"></i> {{ __('btn_add_new') }}</a>
            </div>
      </div>
      <!-- [ Data table ] start -->
      <div class="table-responsive">
         <table id="table" class="display table nowrap table-striped table-hover" style="width:100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Bank</th>
                     <th>Account Holder</th>
                     <th>Account No.</th>
                     <th>IFSC Code</th>
                     <th>Type</th>
                     <th>Branch</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($bank_details as $key => $bank_detail)
                  <tr>
                     <td>{{ $key + 1 }}</td>
                     <td>{{ @$bank_detail->payload['bank_name'] }}</td>
                     <td>
                        {{ @$bank_detail->payload['account_holder_name'] }}
                     </td>
                     <td>
                        {{ @$bank_detail->payload['account_no'] }}
                     </td>
                     <td>
                        {{ @$bank_detail->payload['ifsc_code'] }}
                     </td>
                     <td>
                        {{ @$bank_detail->payload['type'] }}
                     </td>
                     <td>
                        {{ @$bank_detail->payload['branch'] }}
                     </td>
                     <td>
                        <button type="button" class="btn btn-icon btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBankInfoModal-{{ @$bank_detail->id }}">
                           <i class="far fa-edit"></i>
                       </button>
                        @include('admin.banks-info.edit')

                        <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ @$bank_detail->id }}">
                           <i class="fas fa-trash-alt"></i>
                        </button>
                     </td>
                  </tr>
                  
                  @endforeach
               </tbody>
         </table>
      </div>
      <!-- [ Data table ] end -->
   </fieldset>
 </div>
 <div class="modal fade" id="deleteModal-{{ @$bank_detail->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-sm">
     <form action="@isset($bank_detail) {{ route('admin.user-bank.destroy',[@$bank_detail->id]) }} @endisset" method="post" class="delete-form">
     @csrf
     @method('DELETE')
       <div class="modal-content">
           <div class="modal-body text-center">
               <h5 class="modal-title" id="deleteModalLabel">{{ __('modal_are_you_sure') }}</h5>
               <p class="text-danger mt-2">{{ __('modal_delete_warning') }}</p>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('btn_close') }}</button>
               <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> {{ __('btn_delete') }}</button>
           </div>
       </div><!-- /.modal-content -->
     </form>
   </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->