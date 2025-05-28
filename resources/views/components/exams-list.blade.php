<div class="card text-white bg-info mb-3">
    <div class="card-header">Informação</div>
    <div class="card-body">
      Um Exame representa um Semestre. Todos os Cursos de um Semestre pertencem a um Exame. Assim, todos os Quizzes, Testes de Classe, Trabalhos, Frequência, Escritos, Práticos, etc. em um Curso estão sujeitos a esse Exame específico.
    </div>
</div>
{{$exams->links()}}
<div class="table-responsive">
  @foreach ($exams as $exam)
    <form id="form{{$exam->id}}" action="{{url('exams/activate-exam')}}" method="POST">
      {{csrf_field()}}
    </form>
  @endforeach
  <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome do Exame</th>
      <th scope="col">Aviso Publicado</th>
      <th scope="col">Resultado Publicado</th>
      <th scope="col">Criado Em</th>
      <th scope="col">Definir Ativo</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($exams as $exam)
    <tr>
      <th scope="row">{{($loop->index + 1)}}</th>
      <td scope="row">{{$exam->exam_name}}</td>
      <td scope="row">
        @if($exam->notice_published === 1)
          Sim
        @else
          @if($exam->result_published === 1)
            Não
          @else
            <span class="label label-danger checkbox-inline">
              <input type="checkbox" name="notice_published" form="form{{$exam->id}}" /> Sim
            </span>
          @endif
        @endif
      </td>
      <td scope="row">
        @if($exam->result_published === 1)
          Sim
        @else
          <span class="label label-danger checkbox-inline">
            <input type="checkbox" name="result_published" form="form{{$exam->id}}" /> Sim
          </span>
        @endif
      </td>
      <td scope="row">{{Carbon\Carbon::parse($exam->created_at)->format('d/m/Y')}}</td>
      <td scope="row">
        <input type="hidden" name="exam_id" value="{{$exam->id}}" form="form{{$exam->id}}"/>
        @if($exam->active === 1)
          <span class="label label-success checkbox-inline">
            <input type="checkbox" name="active" form="form{{$exam->id}}" checked />
              Ativo
          </span>
        @else
          @if($exam->result_published === 1)
            Concluído
          @else
            <span class="label label-danger checkbox-inline">
              <input type="checkbox" name="active" form="form{{$exam->id}}" />
              Não Ativo
            </span>
          @endif
        @endif
        @if($exam->result_published != 1)
          <input type="submit" class="btn btn-info btn-xs" style="margin-left: 1%;" value="Salvar" form="form{{$exam->id}}"/>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$exams->links()}}
