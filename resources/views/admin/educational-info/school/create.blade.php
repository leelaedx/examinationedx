    <!-- create modal content -->
    <div id="createSchoolModal-{{ $student->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <form class="needs-validation" novalidate action="{{ route('admin.education.store') }}" method="post">
                  @csrf
                  <input type="hidden" name="student_id" value="{{ $student->id }}">
                  <input type="hidden" name="education_type" value="school">
                  <div class="modal-header">
                      <h5 class="modal-title" id="myModalLabel">{{$student->full_name}} {{ __('field_school_information') }} </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <fieldset class="row">
                        <div class="form-group col-md-12">
                           <label for="school_name">{{ __('field_school_name') }}<span>*</span></label>
                           <input type="text" class="form-control" name="payload[school_name]" id="school_name" value="{{ old('school_name') }}" required>
                           <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_school_name') }}
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="board">{{ __('field_board') }}<span>*</span></label>
                           <input type="text" class="form-control" name="payload[board]" id="board" value="{{ old('board') }}" required>
                           <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_board') }}
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="year_of_passing">{{ __('field_year_of_passing') }}<span>*</span></label>
                           <select id="year_of_passing" class="form-control year" name="payload[year_of_passing]">
                              @foreach(scopedYear() as $year)
                                 <option value="{{$year}}">{{$year}}</option>
                              @endforeach
                           </select>
                           <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_year_of_passing') }}
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="school_exam_id">{{ __('field_exam_id') }}<span>*</span></label>
                           <input type="text" class="form-control" name="payload[school_exam_id]" id="school_exam_id" value="{{ old('school_exam_id') }}" required>
                           <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_exam_id') }}
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="hall_ticket_no">{{ __('field_hall_ticket_no') }}<span>*</span></label>
                           <input type="text" class="form-control" name="payload[hall_ticket_no]"  id="hall_ticket_no" value="{{ old('hall_ticket_no') }}" required>
                           <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_hall_ticket_no') }}
                           </div>
                        </div>
                        <div class="form-group col-md-4">
                           <label for="total_marks">{{ __('field_total_marks') }}<span>*</span></label>
                           <input type="number" min="0" class="form-control" name="payload[total_marks]" id="total_marks" value="{{ old('total_marks') }}" required>
                           <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_total_marks') }}
                           </div>
                        </div>
                        <div class="form-group col-md-4">
                           <label for="obtain_marks">{{ __('field_obtain_marks') }}<span>*</span></label>
                           <input type="number" min="0" step="any" class="form-control" name="payload[obtain_marks]" id="obtain_marks" value="{{ old('obtain_marks') }}" required>
                           <!-- <input type="hiden" max="100" min="0" step="any" value="0" class="form-control" name="payload[percentage]" id="percentage" value="{{ old('percentage') }}" required> -->
                           <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_obtain_marks') }}
                           </div>
                        </div>
                        <!-- <div class="form-group col-md-4">
                           <label for="percentage">{{ __('field_percentage') }}<span>*</span></label>
                           <input type="number" max="100" min="0" step="any" class="form-control" name="payload[percentage]" id="percentage" value="{{ old('percentage') }}" required>
                           <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_percentage') }}
                           </div>
                        </div> -->
                        <div class="form-group col-md-4">
                           <label for="gpa">{{ __('GPA') }}<span>*</span></label>
                           <input type="number" max="10" required min="0" step="any" class="form-control" name="payload[gpa]" id="gpa" value="{{ old('gpa') }}">
                           <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('GPA') }}
                           </div>
                        </div>
                      </fieldset>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('btn_close') }}</button>
                      <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_save') }}</button>
                  </div>
              </form>
          </div>
      </div>
  </div>