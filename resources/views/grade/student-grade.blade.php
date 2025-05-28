@extends('layouts.app')

@section('title', 'Notas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">Notas</a></li>
                <li><a href="{{url()->previous()}}" style="color:#3b80ef;">Alunos da Seção</a></li>
                <li class="active">Histórico</li>
            </ol>
            @endif
            <h2>Histórico de Notas e Avaliações</h2>
            <div class="panel panel-default">
              @if(count($grades) > 0)
              @foreach ($grades as $grade)
                <?php
                    $studentName = $grade->student->name;
                    $classNumber = $grade->student->section->class->class_number;
                    $sectionNumber = $grade->student->section->section_number;
                ?>
                <div class="page-panel-title"><b>Código do Aluno</b> - {{$grade->student->student_code}} &nbsp;<b>Nome</b> -  {{$grade->student->name}} &nbsp;<b>Turma</b> - {{$grade->student->section->class->class_number}} &nbsp;<b>Seção</b> - {{$grade->student->section->section_number}}</div>
                 @break($loop->first)
              @endforeach
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('layouts.student.grade-table')
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
