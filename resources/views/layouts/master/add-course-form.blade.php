<a class="btn btn-xs btn-info pull-right" data-toggle="collapse" href="#collapseForNewCourse{{$section->id}}" aria-expanded="false" aria-controls="collapseForNewCourse{{$section->id}}">+ Adicionar Novo Curso</a>
  <div class="collapse" id="collapseForNewCourse{{$section->id}}" style="margin-top:1%;">
    <div class="panel panel-default">
      <div class="panel-body">
      <form class="form-horizontal" action="{{url('courses/store')}}" method="post">
          {{csrf_field()}}
          <input type="hidden" name="class_id" value="{{$class->id}}"/>
          <input type="hidden" name="section_id" value="{{$section->id}}"/>
          <div class="form-group">
            <label for="courseName{{$section->id}}" class="col-sm-2 control-label">Nome do Curso</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="courseName{{$section->id}}" name="course_name" placeholder="Nome do Curso">
            </div>
          </div>
          <div class="form-group">
            <label for="teacherDepartment{{$section->id}}" class="col-sm-2 control-label">Departamento do Professor</label>
            <div class="col-sm-10">
              <select class="form-control" id="teacherDepartment{{$section->id}}" name="teacher_department">
                <option value="0" selected disabled>Selecionar Departamento</option>
                @if(count($departments) > 0)
                  @foreach ($departments as $d)
                    <option value="{{$d->department_name}}">{{$d->department_name}}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="assignTeacher{{$section->id}}" class="col-sm-2 control-label">Atribuir Professor do Curso</label>
            <div class="col-sm-10">
              <select class="form-control" id="assignTeacher{{$section->id}}" name="teacher_id">
                <option value="0" selected disabled>Selecione o Departamento Primeiro</option>
                @foreach($teachers as $teacher)
                  <option value="{{$teacher->id}}" data-department="{{$teacher->department->department_name}}">{{$teacher->name}} ({{$teacher->department->department_name}})</option>
                @endforeach
              </select>
            </div>
          </div>
        <div class="form-group">
          <label for="course_type{{$section->id}}" class="col-sm-2 control-label">Tipo de Curso</label>
          <div class="col-sm-10">
            <select class="form-control" id="course_type{{$section->id}}" name="course_type">
              <option value="core">Obrigatório</option>
              <option value="elective">Eletivo</option>
              <option value="optional">Opcional</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="courseTime{{$section->id}}" class="col-sm-2 control-label">Horário do Curso</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="courseTime{{$section->id}}" name="course_time" placeholder="Horário do Curso">
            <span id="helpBlock" class="help-block">Exemplo: 12:50PM-01:40PM Domingo</span>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">Enviar</button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
<script>
  $(document).ready(function() {
    var teacherSelect = $("#assignTeacher{{$section->id}}");
    // Initially show all teachers except the first option
    teacherSelect.find('option').not(':first').show();
  });

  $('#teacherDepartment{{$section->id}}').on('change', function () {
    var selectedDepartment = $(this).val();
    var teacherSelect = $("#assignTeacher{{$section->id}}");
    
    // Show all teachers first
    teacherSelect.find('option').not(':first').show();
    
    if (selectedDepartment !== '0') {
      // Hide teachers that don't belong to the selected department
      teacherSelect.find('option').not(':first').each(function() {
        if ($(this).data('department') !== selectedDepartment) {
          $(this).hide();
        }
      });
    }
  });
</script>
