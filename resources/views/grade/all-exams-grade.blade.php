@extends('layouts.app')

@section('title', 'Notas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-8" id="main-container">
            <h2>Notas e Avaliações de Todas as Turmas</h2>
            <div class="panel panel-default">
              @if(count($classes) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($classes as $class)
                        <div class="panel panel-default">
                            <div class="page-panel-title" role="tab" id="heading{{$class->id}}">
                            <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}">
                                <h5>
                                {{$class->class_number}} {{$class->group}} <span class="pull-right"><b>Clique para ver todas as Seções desta Turma+</b></span>
                                </h5>
                            </a>
                            </div>
                            <div id="collapse{{$class->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$class->id}}">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nome da Seção</th>
                                                <th scope="col">Ver Histórico de Notas de Cada Aluno</th>
                                                <th scope="col">Ver Notas de Todos os Alunos desta Seção</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sections as $section)
                                                @if($class->id == $section->class_id)
                                                <tr>
                                                <td>
                                                    <a href="{{url('grades/section/'.$section->id)}}">{{$section->section_number}}</a>
                                                </td>
                                                <td>
                                                    <a href="{{url('section/students/'.$section->id)}}" class="btn btn-info btn-xs"><i class="material-icons">visibility</i> Ver Histórico de Notas de Cada Aluno</a>
                                                </td>
                                                <td>
                                                    <a href="{{url('grades/section/'.$section->id)}}" role="button" class="btn btn-xs btn-danger"><i class="material-icons">visibility</i> Ver Notas de Todos os Alunos desta Seção</a>
                                                </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
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
