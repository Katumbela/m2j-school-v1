@extends('layouts.app')

@section('title', 'Presença')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if(count($attendances) > 0)
                @if(Auth::user()->role != 'student')
                <ol class="breadcrumb" style="margin-top: 3%;">
                    <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">Turmas &amp; Seções</a></li>
                    <li><a href="{{url()->previous()}}" style="color:#3b80ef;">Lista de Estudantes</a></li>
                    <li class="active">Ver Presença</li>
                </ol>
                @endif
                <h2>Ajustar Presença do Estudante -  {{$attendances[0]->student->name}}</h2>
            @endif
            <div class="panel panel-default">
                @if(count($attendances) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.adjust-attendance',['attendances'=>$attendances,'student_id'=>$student_id])
                        
                    @endcomponent
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
