@if(count($exams) > 0)
@foreach($exams as $exam)
<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      {{$exam->exam_name}}
      <button class="btn btn-sm btn-success float-right" role="button" id="btnPrint{{$exam->id}}">
        <i class="material-icons">print</i> Imprimir Resultado
      </button>
    </h3>
  </div>
  <div class="card-body">
    <div class="visible-print-block" id="table-content{{$exam->id}}">
      <div class="text-center mb-4">
        <h2>{{Auth::user()->school->name}}</h2>
        <h4>Boletim</h4>
        <p>Nome do Aluno: {{$studentName}}</p>
        <p>Turma: {{$classNumber}} | Seção: {{$sectionNumber}}</p>
        <p>Nome da Prova: {{$exam->exam_name}}</p>
      </div>
      <table class="table table-bordered" style="font-size: 12px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Presença</th>
            @for($i=1;$i<=5;$i++)
              <th scope="col">Quiz {{$i}}</th>
              @endfor
              @for($i=1;$i<=3;$i++)
                <th scope="col">Trabalho {{$i}}</th>
                @endfor
                @for($i=1;$i<=5;$i++)
                  <th scope="col">Teste {{$i}}</th>
                  @endfor
                  @if($grade->course->final_exam_percent > 0)
                  <th scope="col">Escrito</th>
                  <th scope="col">Múltipla Escolha</th>
                  @endif
                  @if($grade->course->practical_percent > 0)
                  <th scope="col">Prático</th>
                  @endif
                  <th scope="col">Total de Pontos</th>
                  <th scope="col">Nota</th>
                  <th scope="col">Professor</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($grades as $grade)
          <tr>
            <th scope="row">{{($loop->index + 1)}}</th>
            <td>{{$grade->course->course_name}}</td>
            <td>{{$grade->attendance}}</td>
            @for($i=1;$i<=5;$i++)
              <td>{{$grade['quiz'.$i]}}</td>
              @endfor
              @for($i=1;$i<=3;$i++)
                <td>{{$grade['assignment'.$i]}}</td>
                @endfor
                @for($i=1;$i<=5;$i++)
                  <td>{{$grade['ct'.$i]}}</td>
                  @endfor
                  @if($grade->course->final_exam_percent > 0)
                  <td>{{$grade->written}}</td>
                  <td>{{$grade->mcq}}</td>
                  @endif
                  @if($grade->course->practical_percent > 0)
                  <td>{{$grade->practical}}</td>
                  @endif
                  <td>{{$grade->marks}}</td>
                  <td>
                    @foreach($gradesystems as $gs)
                    @if($grade->marks >= $gs->from_mark && $grade->marks <= $gs->to_mark)
                      <b>{{$gs->grade}}</b>
                      @break
                      @else
                      Sem Nota
                      @endif
                      @endforeach
                  </td>
                  <td>{{$grade->teacher->name}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Total de Pontos</th>
            <th scope="col">Nota</th>
            <th scope="col">Professor</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($grades as $grade)
          @if($grade->exam->id == $exam->id)
          <tr id="heading{{($loop->index + 1)}}">
            <th scope="row">{{($loop->index + 1)}}</th>
            <td>{{$grade->course->course_name}}</td>
            <td>
              <b>{{$grade->marks}}</b>
              <button class="btn btn-sm btn-info float-right" type="button" data-toggle="collapse" data-target="#collapse{{($loop->index + 1)}}" aria-expanded="false" aria-controls="collapse{{($loop->index + 1)}}">
                Ver Detalhes
              </button>
            </td>
            <td>
              @foreach($gradesystems as $gs)
              @if($grade->marks >= $gs->from_mark && $grade->marks <= $gs->to_mark)
                <b>{{$gs->grade}}</b>
                @break
                @else
                Sem Nota
                @endif
                @endforeach
            </td>
            <td>
              <a href="{{url('user/'.$grade->teacher->student_code)}}">{{$grade->teacher->name}}</a>
            </td>
          </tr>
          <tr class="collapse" id="collapse{{($loop->index + 1)}}" aria-labelledby="heading{{($loop->index + 1)}}">
            <td colspan="5">
              <div class="table-responsive">
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th scope="col">Presença</th>
                      @for($i=1;$i<=5;$i++)
                        <th scope="col">Quiz {{$i}}</th>
                        @endfor
                        @for($i=1;$i<=3;$i++)
                          <th scope="col">Trabalho {{$i}}</th>
                          @endfor
                          @for($i=1;$i<=5;$i++)
                            <th scope="col">Teste {{$i}}</th>
                            @endfor
                            @if($grade->course->final_exam_percent > 0)
                            <th scope="col">Escrito</th>
                            <th scope="col">Múltipla Escolha</th>
                            @endif
                            @if($grade->course->practical_percent > 0)
                            <th scope="col">Prático</th>
                            @endif
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$grade->attendance}}</td>
                      @for($i=1;$i<=5;$i++)
                        <td>{{$grade['quiz'.$i]}}
            </td>
            @endfor
            @for($i=1;$i<=3;$i++)
              <td>{{$grade['assignment'.$i]}}</td>
              @endfor
              @for($i=1;$i<=5;$i++)
                <td>{{$grade['ct'.$i]}}</td>
                @endfor
                @if($grade->course->final_exam_percent > 0)
                <td>{{$grade->written}}</td>
                <td>{{$grade->mcq}}</td>
                @endif
                @if($grade->course->practical_percent > 0)
                <td>{{$grade->practical}}</td>
                @endif
          </tr>
        </tbody>
      </table>
    </div>
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

@push('scripts')
<script>
function printGradeTable(examId) {
    var tableContent = document.getElementById('table-content' + examId).innerHTML;
    var printWindow = window.open('', '', 'height=720,width=1280');
    printWindow.document.write('<!DOCTYPE html><html><head><title>Boletim</title>');
    printWindow.document.write('<link href="{{url("css/app.css")}}" rel="stylesheet">');
    printWindow.document.write('<style>body { padding: 20px; } .visible-print-block { display: block !important; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(tableContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    setTimeout(function() {
        printWindow.print();
        printWindow.close();
    }, 500);
}

document.addEventListener('DOMContentLoaded', function() {
    @foreach($exams as $exam)
    document.getElementById('btnPrint{{$exam->id}}').addEventListener('click', function() {
        printGradeTable('{{$exam->id}}');
    });
    @endforeach
});
</script>
@endpush
@else
<div class="alert alert-info">
  Nenhum dado relacionado
</div>
@endif