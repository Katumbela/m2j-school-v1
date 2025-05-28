@extends('layouts.app')

@section('title', 'Todas as Turmas e Seções')

@section('content')
<style>
    #cls-sec .panel{
        margin-bottom: 0%;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <h2>Todas as Turmas e Seções</h2>
            <div class="panel panel-default" id="cls-sec">
              @if(count($classes) > 0)
                @foreach ($classes as $class)
                    <div class="panel panel-default">
                        <div class="page-panel-title" role="tab" id="heading{{$class->id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}">{{$class->class_number}} {{ucfirst($class->group)}}</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}"><small><b>Clique para ver todas as Seções desta Turma <i class="material-icons">keyboard_arrow_down</i></b></small></a>
                                    </div>
                                    @if(isset($_GET['course']) && $_GET['course'] == 1)
                                    <div class="col-md-4">
                                        <a role="button" class="btn btn-info btn-xs" href="{{url('academic/syllabus')}}"><i class="material-icons">visibility</i> Ver Programa desta Turma</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div id="collapse{{$class->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$class->id}}">
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nome da Seção</th>
                                            @if(isset($_GET['att']) && $_GET['att'] == 1)
                                            <th>Ver Frequência de Hoje</th>
                                            <th>Ver Frequência de Cada Estudante</th>
                                            <th>Registrar Frequência</th>
                                            @endif
                                            @if(isset($_GET['course']) && $_GET['course'] == 1)
                                            <th>Ver Cursos</th>
                                            <th>Ver Estudantes</th>
                                            <th>Ver Rotinas</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sections as $section)
                                            @if($class->id == $section->class_id)
                                            <tr>
                                            <td>
                                                <a href="{{url('courses/0/'.$section->id)}}">{{$section->section_number}}</a>
                                            </td>
                                            @if(isset($_GET['att']) && $_GET['att'] == 1)
                                                @foreach ($exams as $ex)
                                                    @if ($ex->class_id == $class->id)
                                                        <td>
                                                            <a role="button" class="btn btn-primary btn-xs" href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}"><i class="material-icons">visibility</i> Ver Frequência de Hoje</a>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            <td>
                                                <a role="button" class="btn btn-danger btn-xs" href="{{url('attendances/'.$section->id)}}"><i class="material-icons">visibility</i> Ver Frequência de Cada Estudante</a>
                                            </td>
                                            <td>
                                                <?php
                                                    $ce = 0;    
                                                ?>
                                                @foreach ($exams as $ex)
                                                    @if ($ex->class_id == $class->id)
                                                        <?php
                                                            $ce = 1;
                                                        ?>
                                                        <a role="button" class="btn btn-info btn-xs" href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}"><i class="material-icons">spellcheck</i> Registrar Frequência</a>
                                                    @endif
                                                @endforeach
                                                @if($ce == 0)
                                                    Atribuir Turma ao Exame
                                                @endif
                                            </td>
                                            @endif
                                            @if(isset($_GET['course']) && $_GET['course'] == 1)
                                            <td>
                                                <a role="button" class="btn btn-info btn-xs" href="{{url('courses/0/'.$section->id)}}"><i class="material-icons">visibility</i> Ver Cursos desta seção</a>
                                            </td>
                                            <td>
                                                <a role="button" class="btn btn-danger btn-xs" href="{{url('section/students/'.$section->id.'?section=1')}}"><i class="material-icons">visibility</i> Ver Estudantes desta seção</a>
                                            </td>
                                            <td>
                                                <a role="button" class="btn btn-primary btn-xs" href="{{url('academic/routine')}}"><i class="material-icons">visibility</i> Ver Rotinas desta seção</a>
                                            </td>
                                            @endif
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
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
