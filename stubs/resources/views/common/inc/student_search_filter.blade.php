<div class="form-group col-md-3">
  <label for="faculty">{{ __('field_faculty') }}</label>
  <select class="form-control faculty" name="faculty" id="faculty">
    <option value="">{{ __('select') }}</option>
    <option value="all" @if( $selected_faculty == 'all')selected @endif>{{ __('all') }}</option>
    @if(isset($faculties))
    @foreach($faculties->sortBy('title') as $faculty )
    <option value="{{ $faculty->id }}" @if( $selected_faculty == $faculty->id) selected @endif>{{ $faculty->title }}</option>
    @endforeach
    @endif
  </select>

  <div class="invalid-feedback">
    {{ __('required_field') }} {{ __('field_faculty') }}
  </div>
</div>
<div class="form-group col-md-3">
  <label for="program">{{ __('field_program') }}</label>
  <select class="form-control program" name="program" id="program">
    <option value="">{{ __('select') }}</option>
    <option value="all" @if( $selected_program == 'all')selected @endif>{{ __('all') }}</option>
    @if(isset($programs))
      @foreach( $programs->sortBy('title') as $program )
      <option value="{{ $program->id }}" @if( $selected_program == $program->id) selected @endif>{{ $program->title }}</option>
      @endforeach
    @endif
  </select>

  <div class="invalid-feedback">
    {{ __('required_field') }} {{ __('field_program') }}
  </div>
</div>
<div class="form-group col-md-3">
  <label for="session">{{ __('field_session') }}</label>
  <select class="form-control session" name="session" id="session">
    <option value="">{{ __('select') }}</option>
    <option value="all" @if( $selected_session == 'all')selected @endif>{{ __('all') }}</option>
    @if(isset($sessions))
    @foreach( $sessions->sortByDesc('id') as $session )
    <option value="{{ $session->id }}" @if( $selected_session == $session->id) selected @endif>{{ $session->title }}</option>
    @endforeach
    @endif
  </select>

  <div class="invalid-feedback">
    {{ __('required_field') }} {{ __('field_session') }}
  </div>
</div>
<div class="form-group col-md-3">
  <label for="semester">{{ __('field_semester') }}</label>
  <select class="form-control semester" name="semester" id="semester">
    <option value="">{{ __('select') }}</option>
    <option value="all" @if( $selected_semester == 'all') selected @endif>{{ __('all') }}</option>
    {{-- <option value="all" @if($selected_semester != null && $selected_semester == 0) selected @endif>{{ __('all') }}</option> --}}
    @if(isset($semesters))
    @foreach( $semesters->sortBy('id') as $semester )
    <option value="{{ $semester->id }}" @if($selected_semester == $semester->id) selected @endif>{{ $semester->title }}</option>
    @endforeach
    @endif
  </select>

  <div class="invalid-feedback">
    {{ __('required_field') }} {{ __('field_semester') }}
  </div>
</div>
<div class="form-group col-md-3">
  <label for="section">{{ __('field_section') }}</label>
  <select class="form-control section" name="section" id="section">
    <option value="">{{ __('select') }}</option>
    <option value="all"@if( $selected_section == 'all') selected @endif>{{ __('all') }}</option>
    @if(isset($sections))
    @foreach( $sections->sortBy('title') as $section )
    <option value="{{ $section->id }}" @if( $selected_section == $section->id) selected @endif>{{ $section->title }}</option>
    @endforeach
    @endif
  </select>

  <div class="invalid-feedback">
    {{ __('required_field') }} {{ __('field_section') }}
  </div>
</div>
@section('sub-script')
<script type="text/javascript">
    "use strict";
    $(".faculty").on('change',function(e){
      e.preventDefault(e);
      var program=$(".program");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-program') }}",
        data:{
          _token:$('input[name=_token]').val(),
          faculty:$(this).val()
        },
        success:function(response){
              console.log("Okk");
            // var jsonData=JSON.parse(response);
            $('option', program).remove();
            $('.program').append('<option value="">{{ __("all") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.program');
            });
          }

      });
    });

    $(".program").on('change',function(e){
      e.preventDefault(e);
      var session=$(".session");
      var semester=$(".semester");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-session') }}",
        data:{
          _token:$('input[name=_token]').val(),
          program:$(this).val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', session).remove();
            $('.session').append('<option value="">{{ __("all") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.session');
            });
          }

      });

      $.ajax({
        type:'POST',
        url: "{{ route('filter-semester') }}",
        data:{
          _token:$('input[name=_token]').val(),
          program:$(this).val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', semester).remove();
            $('.semester').append('<option value="">{{ __("all") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.semester');
            });
          }

      });
    });

    $(".semester").on('change',function(e){
      e.preventDefault(e);
      var section=$(".section");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-section') }}",
        data:{
          _token:$('input[name=_token]').val(),
          semester:$(this).val(),
          program:$('.program option:selected').val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', section).remove();
            $('.section').append('<option value="">{{ __("all") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.section');
            });
          }

      });
    });
</script>
@endsection