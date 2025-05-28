@extends('layouts.app')

@section('title', 'Estudantes do Curso')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <ol class="breadcrumb" style="margin-top: 3%;">
                @if(isset($_GET['grade']) && $_GET['grade'] == 1)
                    <li><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">Notas</a></li>
                @else
                    <li><a href="{{url('school/sections?course=1')}}" style="color:#3b80ef;">Seção</a></li>
                @endif
                <li class="active">Estudantes</li>
            </ol>
            <h2>Estudantes da Seção</h2>
            <div class="panel panel-default">
              @if(count($students) > 0)
                <div class="panel-body">
                    <table class="table table-data-div table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Sl.</th>
                            <th scope="col">Código do Estudante</th>
                            <th scope="col">Nome do Estudante</th>
                            <th scope="col">Histórico de Notas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{($loop->index+1)}}</td>
                            <td>{{$student->student_code}}</td>
                            <td><a href="{{url('user/'.$student->student_code)}}">{{$student->name}}</a></td>
                            <td><a class="btn btn-xs btn-success" role="button" href="{{url('grades/'.$student->id)}}">Ver Histórico de Notas</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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
