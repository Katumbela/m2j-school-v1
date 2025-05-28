{{$books->links()}}
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Todos os Livros</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título do Livro</th>
                    <th>Código do Livro</th>
                    <th>Autor</th>
                    <th>Quantidade</th>
                    <th>Disponível</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->book_code}}</td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->quantity}}</td>
                    <td>{{$book->quantity - $book->issued_quantity}}</td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{url('library/book/'.$book->id.'/edit')}}">Editar</a>
                        <a class="btn btn-sm btn-danger" href="{{url('library/book/'.$book->id.'/delete')}}">Excluir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{$books->links()}}
