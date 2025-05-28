@extends('layouts.app')

@section('title', 'Curso')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <h2>Cursos Ministrados pelo Professor</h2>
            <div class="panel panel-default">
              @if(count($courses) > 0)
              @foreach ($courses as $course)
                <div class="page-panel-title" style="font-size: 20px;"><b>Código do Professor</b> - {{$course->teacher->student_code}} &nbsp;<b>Nome</b> - <a href="{{url('user/'.$course->teacher->student_code)}}">{{$course->teacher->name}}</a></div>
                 @break($loop->first)
              @endforeach
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.course-table',['courses'=>$courses, 'exams'=>$exams, 'student'=>false])
                    @endcomponent
                </div>
              @else
                <div class="panel-body">
                    Nenhum dado relacionado encontrado.
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
