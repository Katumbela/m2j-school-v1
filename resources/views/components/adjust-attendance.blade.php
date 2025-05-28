@if(count($attendances) > 0)
<div class="col-md-6">
    <h5>Lista de Presença deste Período</h5>
    <form action="{{url('attendance/adjust')}}" method="POST">
        {{ csrf_field() }}
        <table class="table table-striped table-hover table-condensed">
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Data</th>
            </tr>
            @foreach ($attendances as $att)
                <input type="hidden" name="att_id[]" value="{{$att->id}}">
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" aria-label="Presente" name="isPresent[]">
                        </div>
                    </td>
                    <td>
                        @if($att->present === 0)
                            <span class="label label-danger attdState">Ausente</span>
                        @endif
                    </td>
                    <td>{{$att->created_at}}</td>
                </tr>
            @endforeach
        </table>
        <a href="javascript:history.back()" class="btn btn-sm btn-primary" style="margin-right: 2%;" role="button">Cancelar</a>
        <input type="submit" class="btn btn-sm btn-danger" value="Enviar"/>
    </form>
</div>
<script>
  $('input[type="checkbox"]').change(function() {
      var attdState = $(this).parent().parent().parent().find('.attdState').removeClass('label-danger label-success');
      if($(this).is(':checked')){
        attdState.addClass('label-success').text('Presente');
      } else {
        attdState.addClass('label-danger').text('Ausente');
      }
  });
</script>
@endif