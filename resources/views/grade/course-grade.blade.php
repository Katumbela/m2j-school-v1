@extends('layouts.app')

@section('title', 'Notas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
          @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{url('courses/save-configuration')}}" method="POST">
              {{csrf_field()}}
              <input type="hidden" name="course_id" value="{{$course_id}}">
            <div class="panel panel-default" id="main-container">
              @if(count($grades) > 0)
              @foreach ($grades as $grade)
                <div class="page-panel-title" style="font-size: 15px;"><b>Curso</b> - {{$grade->course->course_name}} &nbsp; <b>Turma</b> - {{$grade->course->section->class->class_number}} &nbsp;<b>Seção</b> - {{$grade->course->section->section_number}}
                  <button type="submit" class="btn btn-success btn-xs pull-right">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar
                  </button>
                </div>
                @break($loop->first)
              @endforeach
                <div class="panel-body" style="padding-top: 0px;">
                  <div class="alert alert-info alert-dismissible" style="font-size:13px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                      <li>
                        Selecione qual Sistema de Notas você deseja usar.
                      </li>
                      <li>
                        <b>Exemplo de Contagem:</b> Se você aplicar 3 Provas e quiser contar as 2 melhores, então a Contagem de Provas é 2.
                      </li>
                      <li>
                        <b>Exemplo de Porcentagem:</b> A porcentagem total deve ser 100%. Você pode colocar 100% em um campo ou distribuí-lo conforme sua necessidade. A nota máxima também é necessária para que a Porcentagem funcione.
                      </li>
                      <li>
                        <b>Exemplo de Nota Máxima:</b> Se você aplicar uma Prova de Classe onde a nota máxima é 15, então a Nota Máxima para a Prova de Classe é 15.
                      </li>
                    </ul>
                  </div>
                      <table class="table table-condensed table-hover">
                        <thead>
                          <tr>
                            <th scope="col" style="width:10%;">Selecionar Sistema de Notas</th>
                            <th scope="col" style="width:10%;">Contagem de Provas</th>
                            <th scope="col" style="width:10%;">Contagem de Trabalhos</th>
                            <th scope="col" style="width:10%;">Contagem de Provas de Classe</th>
                            <th scope="col" style="width:10%;">% de Presença</th>
                            <th scope="col" style="width:10%;">% de Trabalhos</th>
                            <th scope="col" style="width:10%;">% de Provas</th>
                            <th scope="col" style="width:10%;">% de Provas de Classe</th>
                          </tr>
                        </thead>
                        <?php
                          $section_id = 0;
                        ?>
                        @foreach ($grades as $grade)
                        <tbody>
                          <tr>
                            <td>
                              <select class="form-control input-sm" name="grade_system_name">
                                @foreach($gradesystems as $gs)
                              <option {{($grade->course->grade_system_name == $gs->grade_system_name)?'selected=selected':''}}>{{$gs->grade_system_name}}</option>
                                @endforeach
                              </select>
                            </td>
                            <td>
                            <input type="number" class="form-control input-sm" id="quiz-count" name="quiz_count" placeholder="Contagem de Provas" max="5" value="{{$grade->course->quiz_count}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="assignment-count" name="assignment_count" placeholder="Contagem de Trabalhos" max="3" value="{{$grade->course->assignment_count}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="ct-count" name="ct_count" placeholder="Contagem de PC" max="5" value="{{$grade->course->ct_count}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="attendance" name="attendance_perc" placeholder="Porcentagem" max="50" value="{{$grade->course->attendance_percent}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="assignment" name="assign_perc"
                              placeholder="Porcentagem" max="50" value="{{$grade->course->assignment_percent}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="quiz" name="quiz_perc" placeholder="Porcentagem" max="50" value="{{$grade->course->quiz_percent}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="class-test" name="ct_perc" placeholder="Porcentagem" max="50" value="{{$grade->course->ct_percent}}">
                            </td>
                          </tr>
                          <tr>
                            <th scope="col" style="width:10%;">% de Exame Final</th>
                            <th scope="col" style="width:10%;">% de Prática</th>
                            <th scope="col" style="width:10%;">
                              Nota Máxima de Provas
                            </th>
                            <th scope="col" style="width:10%;">
                              Nota Máxima de Trabalhos
                            </th>
                            <th scope="col" style="width:10%;">
                              Nota Máxima de PC
                            </th>
                            <th scope="col" style="width:10%;">
                              Nota Máxima de Exame Final
                            </th>
                            <th scope="col" style="width:10%;">
                              Nota Máxima de Prática
                            </th>
                            <th scope="col" style="width:10%;">
                              Nota Máxima de Presença
                            </th>
                          </tr>
                          <tr>
                            <td>
                              <input type="number" class="form-control input-sm" id="final" name="final_perc" placeholder="Porcentagem" max="100" value="{{$grade->course->final_exam_percent}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="practical_perc" name="practical_perc" placeholder="Porcentagem" max="100" value="{{$grade->course->practical_percent}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="q_full" name="quiz_fullmark" placeholder="Nota Máxima de Provas" max="20" value="{{$grade->course->quiz_fullmark}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="a_full" name="assignment_fullmark" placeholder="Nota Máxima de Trabalhos" max="20" value="{{$grade->course->a_fullmark}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="ct_full" name="ct_fullmark" placeholder="Nota Máxima de PC" max="20" value="{{$grade->course->ct_fullmark}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="final_full" name="final_fullmark" placeholder="Nota Máxima Final" max="100" value="{{$grade->course->final_fullmark}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="practical_full" name="practical_fullmark" placeholder="Nota Máxima de Prática" max="100" value="{{$grade->course->practical_fullmark}}">
                            </td>
                            <td>
                              <input type="number" class="form-control input-sm" id="att_full" name="att_fullmark" placeholder="Nota Máxima de Presença" max="100" value="{{$grade->course->att_fullmark}}">
                            </td>
                          </tr>
                        </tbody>
                          <?php
                            $section_id = $grade->course->section->id;
                          ?>
                          @break($loop->first)
                        @endforeach
                      </table>
                </div>
              @else
                <div class="panel-body">
                  Nenhum Dado Relacionado Encontrado.
                </div>
              @endif
            </div>
          </form>
            <div class="panel panel-default">
              @if(count($grades) > 0)
              <div class="page-panel-title" style="font-size: 15px;">
                <form action="{{url('grades/calculate-marks')}}" method="POST">
                  {{csrf_field()}}
                  Dar Notas aos Alunos
                  <input type="hidden" name="course_id" value="{{$course_id}}">
                  @foreach($gradesystems as $gs)
                    <input type="hidden" name="grade_system_name" value="{{$gs->grade_system_name}}">
                  @endforeach
                  <input type="hidden" name="exam_id" value="{{$exam_id}}">
                  <input type="hidden" name="teacher_id" value="{{$teacher_id}}">
                  <input type="submit" class="btn btn-info btn-xs pull-right" value="Obter Notas Totais">
                </form>
              </div>
              <div class="panel-body">
                @include('layouts.teacher.grade-form')
              </div>
              @else
                <div class="panel-body">
                  Nenhum Dado Relacionado Encontrado.
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
