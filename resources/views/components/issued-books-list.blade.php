{{$books->links()}}
<div class="table-responsive">
  <table class="table table-bordered table-data-div table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Título do Livro</th>
        <th scope="col">Código do Livro</th>
        <th scope="col">Tipo</th>
        <th scope="col">Nome do Emprestador</th>
        <th scope="col">Código do Emprestador</th>
        <th scope="col">Data de Empréstimo</th>
        <th scope="col">Data de Devolução</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>
    <tbody>
      @foreach($books as $book)
      <tr>
        <td>{{($loop->index + 1)}}</td>
        <td>{{$book->title}}</td>
        <td>{{$book->book_code}}</td>
        <td>{{$book->type}}</td>
        <td>{{$book->name}}</td>
        <td>{{$book->student_code}}</td>
        <td>{{Carbon\Carbon::parse($book->issue_date)->format('d/m/Y')}}</td>
        <td>{{Carbon\Carbon::parse($book->return_date)->format('d/m/Y')}}</td>
        <td>
          <form action="{{url('library/save_as_returned')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="issue_id" value="{{$book->id}}">
            <input type="hidden" name="book_code" value="{{$book->book_code}}">
            <button class="btn btn-xs btn-success">Salvar como Devolvido</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{$books->links()}}
