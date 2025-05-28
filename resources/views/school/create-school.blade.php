@extends('layouts.app')

@section('title', 'Gerenciar Escolas')

@section('content')
<div class="container-fluid">
    <div class="row">
      @if(\Auth::user()->role != 'master')
        <div class="col-md-2" id="side-navbar">
          @include('layouts.leftside-menubar')
        </div>
      @endif
        <div class="col-md-{{ (\Auth::user()->role == 'master')? 12 : 10 }}" id="main-container">
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
            <div class="panel panel-default">
              <div class="panel-body table-responsive">
                @if(\Auth::user()->role == 'master')
                  @include('layouts.master.create-school-form')
                  <h2>Lista de Escolas</h2>
                @endif
                <h4>Gerenciar Departamentos, Turmas, Seções, Promoção de Estudantes, Cursos</h4>
                <table class="table table-condensed" style="{{(\Auth::user()->role == 'master')?'':'width:800px'}}">
                  <thead>
                    <tr>
                      @if(\Auth::user()->role == 'master')
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Código</th>
                        <th scope="col">Sobre</th>
                      @endif
                      @if(\Auth::user()->role == 'admin')
                        {{--<th scope="col">Theme</th>--}}
                        <th scope="col">Departamento</th>
                        <th scope="col">Turmas</th>
                        {{-- <th scope="col">Students</th>
                        <th scope="col">Teachers</th> --}}
                      @endif
                      @if(\Auth::user()->role == 'master')
                        <th scope="col">+Admin</th>
                        <th scope="col">Ver Admins</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($schools as $school)
                    @if(\Auth::user()->role == 'master' || \Auth::user()->school_id == $school->id)
                    <tr>
                      @if(\Auth::user()->role == 'master')
                      <td>{{($loop->index + 1)}}</td>
                      <td><small>{{$school->name}}</small></td>
                      <td><small>{{$school->code}}</small></td>
                      <td><small>{{$school->about}}</small></td>
                      @endif
                      @if(\Auth::user()->school_id == $school->id)
                        {{--<td>
                          @include('layouts.master.theme-form')
                        </td>--}}
                      <td>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#departmentModal">+ Criar Departamento</button>
                        <!-- Modal -->
                                  <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h4 class="modal-title" id="departmentModalLabel">Criar Departamento</h4>
                                        </div>
                                        <div class="modal-body">
                                          <form class="form-horizontal" action="{{url('school/add-department')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                              <label for="department_name" class="col-sm-2 control-label">Nome do Departamento</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Português, Matemática,...">
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger btn-sm">Enviar</button>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                      </td>
                      <td>
                        <a href="#collapse{{($loop->index + 1)}}" role="button" class="btn btn-danger btn-sm" data-toggle="collapse" aria-expanded="false" aria-controls="collapse{{($loop->index + 1)}}"><i class="material-icons">class</i> Gerenciar Turma, Seção
                        </a>
                      </td>
                      {{-- <td>
                        <a href="{{url('users/'.$school->code.'/1/0')}}"><small>View All Students</small></a>
                      </td>
                      <td>
                        <a href="{{url('users/'.$school->code.'/0/1')}}"><small>View All Teachers</small></a>
                      </td> --}}
                      @endif
                      @if(\Auth::user()->role == 'master')
                        <td>
                          <a class="btn btn-danger btn-sm" href="{{url('register/admin/'.$school->id.'/'.$school->code)}}"><small>+ Criar Admin</small></a>
                        </td>
                        <td>
                          <a href="{{url('school/admin-list/'.$school->id)}}"><small>Ver Admins</small></a>
                        </td>
                      @endif
                    </tr>
                    @if(\Auth::user()->school_id == $school->id)
                    <tr class="collapse" id="collapse{{($loop->index + 1)}}" aria-labelledby="heading{{($loop->index + 1)}}" aria-expanded="false">
                      <td colspan="12">
                        @include('layouts.master.add-class-form')
                          <div><small>Clique na Turma para Ver Todas as Seções</small></div>
                            <div class="row">
                              @foreach($classes as $class)
                                @if($class->school_id == $school->id)
                                <div class="col-sm-3">
                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal{{$class->id}}" style="margin-top: 5%;">Gerenciar {{$class->class_number}} {{!empty($class->group)? '- '.$class->group:''}}</button>
                                  <!-- Modal -->
                                  <div class="modal fade" id="myModal{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h4 class="modal-title" id="myModalLabel">Todas as Seções da Turma {{$class->class_number}}</h4>
                                        </div>
                                        <div class="modal-body">
                                          <ul class="list-group">
                                            @foreach($sections as $section)
                                              @if($section->class_id == $class->id)
                                              <li class="list-group-item">Seção {{$section->section_number}} &nbsp;
                                                <a class="btn btn-xs btn-warning" href="{{url('courses/0/'.$section->id)}}">Ver Todos os Cursos Atribuídos</a>
                                                <span class="pull-right"> &nbsp;&nbsp;
                                                  <a  class="btn btn-xs btn-success" href="{{url('school/promote-students/'.$section->id)}}">+ Promover Estudantes</a>
                                                  {{-- &nbsp;<a class="btn btn-xs btn-primary" href="{{url('register/student/'.$section->id)}}">+ Register Student</a> --}}
                                                </span>
                                                @include('layouts.master.add-course-form')
                                              </li>
                                              @endif
                                            @endforeach
                                          </ul>
                                          @include('layouts.master.create-section-form')
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                @endif
                              @endforeach
                            </div>
                      </td>
                    </tr>
                    @endif
                    @endif
                  @endforeach
                  </tbody>
                </table>
                <br>
                @if(\Auth::user()->role == 'admin' && \Auth::user()->school_id == $school->id)
                <h4>Adicionar Usuários</h4>
                <table class="table table-condensed" style="width:600px">
                  <thead>
                    <tr>
                        <th scope="col">+Estudante</th>
                        <th scope="col">+Professor</th>
                        <th scope="col">+Contador</th>
                        <th scope="col">+Bibliotecário</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                          <a class="btn btn-info btn-sm" href="{{url('register/student')}}">+ Adicionar Estudante</a>
                        </td>
                        <td>
                          <a class="btn btn-success btn-sm" href="{{url('register/teacher')}}">+ Adicionar Professor</a>
                        </td>
                        <td>
                          <a class="btn btn-default btn-sm" href="{{url('register/accountant')}}">+ Adicionar Contador</a>
                        </td>
                        <td>
                          <a class="btn btn-warning btn-sm" href="{{url('register/librarian')}}">+ Adicionar Bibliotecário</a>
                        </td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <h4>Upload</h4>
                <table class="table table-condensed" style="width:400px">
                  <thead>
                    <tr>
                      <th scope="col">+Aviso</th>
                      <th scope="col">+Evento</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                          <a class="btn btn-info btn-sm" href="{{ url('academic/notice') }}"><i class="material-icons">developer_board</i> Upload de Aviso</a>
                        </td>
                        <td>
                          <a class="btn btn-info btn-sm" href="{{ url('academic/event') }}"><i class="material-icons">developer_board</i> Upload de Evento</a>
                        </td>
                    </tr>
                  </tbody>
                </table>
                @endif
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
