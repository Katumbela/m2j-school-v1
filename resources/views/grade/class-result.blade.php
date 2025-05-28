@extends('layouts.app')

@section('title', 'Notas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-8" id="main-container">
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">Notas</a></li>
                <li class="active">Notas da Seção</li>
            </ol>
            @endif
            <h2>Notas e Avaliações</h2>
            <div class="panel panel-default">
              @if(count($grades) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($grades as $grade)
                        <b>Turma:</b> {{$grade->course->class->class_number}} &nbsp;
                        <b>Seção:</b> {{$grade->student->section->section_number}}
                        @break
                    @endforeach
                    <table class="table table-data-div table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="row">Nome do Exame</th>
                            <th scope="row">Nome do Curso</th>
                            <th scope="row">Código do Aluno</th>
                            <th scope="row">Nome do Aluno</th>
                            <th scope="row">Nota Total</th>
                            <th scope="row">Média</th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach($grades as $grade)
                        <tr>
                            <td>{{$grade->exam->exam_name}}</td>
                            <td>{{$grade->course->course_name}}</td>
                            <td>{{$grade->student->student_code}}</td>
                            <td><a href="{{url('user/'.$grade->student->student_code)}}">{{$grade->student->name}}</a></td>
                            <td>{{$grade->marks}}</td>
                            <td>{{$grade->gpa}}</td>
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
