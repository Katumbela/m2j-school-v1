@extends('layouts.app')
@section('title', 'Emprestar Livro')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">Emprestar Livro</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ url('library/issue-book') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('book_id') ? ' has-error' : '' }}">
                            <label for="book_id" class="col-md-4 control-label">Livro</label>

                            <div class="col-md-6">
                                <select id="book_id" class="form-control" name="book_id" required>
                                    <option value="">Selecione um Livro</option>
                                    @foreach ($books as $book)
                                        <option value="{{$book->id}}">{{$book->title}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('book_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('book_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                            <label for="student_id" class="col-md-4 control-label">Estudante</label>

                            <div class="col-md-6">
                                <select id="student_id" class="form-control" name="student_id" required>
                                    <option value="">Selecione um Estudante</option>
                                    @foreach ($students as $student)
                                        <option value="{{$student->id}}">{{$student->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('student_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('student_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('issue_date') ? ' has-error' : '' }}">
                            <label for="issue_date" class="col-md-4 control-label">Data de Empréstimo</label>

                            <div class="col-md-6">
                                <input id="issue_date" type="date" class="form-control" name="issue_date" value="{{ old('issue_date') }}" required>

                                @if ($errors->has('issue_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('issue_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
                            <label for="return_date" class="col-md-4 control-label">Data de Devolução</label>

                            <div class="col-md-6">
                                <input id="return_date" type="date" class="form-control" name="return_date" value="{{ old('return_date') }}" required>

                                @if ($errors->has('return_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('return_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Emprestar Livro
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 