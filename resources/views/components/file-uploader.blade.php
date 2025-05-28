<div id="my_upload">
    @if($upload_type != 'profile')
    <h3>{{ucfirst($upload_type)}}</h3>
    <div class="form-group">
        <label for="upload-title">Título do Arquivo: </label>
        <input type="text" class="form-control" name="upload-title" id="upload-title" placeholder="Digite o título do arquivo" required>
    </div>
    @endif
    <div class="form-group">
        <label for="fileupload" class="btn btn-primary">
            <i class="material-icons">attach_file</i> Selecionar Arquivo
        </label>
        <input class="form-control-sm" id="fileupload" type="file" style="display: none;" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf,image/png,image/jpeg" name="file" data-url="{{url('upload/file')}}">
        <span id="selected-file-name" class="help-block"></span>
    </div>
    <div class="progress" style="display: none;">
        <div class="progress-bar progress-bar-striped active" id="up-prog-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            <div class="text-xs-center" id="up-prog-info">0% enviado</div>
        </div>
    </div>
    <div id="errorAlert" class="alert alert-danger" style="display: none;"></div>
    <div id="fileInfo"></div>
</div>

<!-- jQuery File Upload Dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/js/jquery.fileupload.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/js/jquery.iframe-transport.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.4/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.4/sweetalert2.all.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        // Initialize fileupload
        $('#fileupload').fileupload({
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                add: function(e, data) {
                    var file = data.originalFiles[0];
                    if (file) {
                        $('#fileInfo').remove();
                        $('#selected-file-name').text('Arquivo selecionado: ' + file.name);
                        $('.progress').show();
                        data.context = $('<div/>').attr('id', 'fileInfo').appendTo('#my_upload');

                        var node = $('<div class="form-group"/>')
                            .append($('<button type="button" class="btn btn-success"/>')
                                .text('Enviar Arquivo')
                                .on('click', function() {
                                    var $this = $(this);

                                    // Validate file type
                                    var acceptFileTypes = /application\/(pdf|xlsx|xls|doc|docx|ppt|pptx|txt)|image\/(png|jpeg)$/i;
                                    var filesSize = 50 * 1024 * 1024; // 50MB

                                    if (file['type'].length && !acceptFileTypes.test(file['type'])) {
                                        swal({
                                            title: 'Tipo de arquivo não aceito',
                                            text: 'Por favor, selecione um arquivo válido (PDF, Excel, Word, PowerPoint, TXT ou imagem)',
                                            type: 'error',
                                            showCloseButton: true,
                                            confirmButtonText: 'OK',
                                            confirmButtonColor: '#3085d6'
                                        });
                                        return false;
                                    }

                                    if (file.size > filesSize) {
                                        swal({
                                            title: 'Arquivo muito grande',
                                            text: 'O tamanho máximo permitido é 50MB',
                                            type: 'error',
                                            showCloseButton: true,
                                            confirmButtonText: 'OK',
                                            confirmButtonColor: '#3085d6'
                                        });
                                        return false;
                                    }

                                    @if($upload_type != 'profile')
                                    if (!$('#upload-title').val()) {
                                        swal({
                                            title: 'Título necessário',
                                            text: 'Por favor, digite um título para o arquivo',
                                            type: 'warning',
                                            showCloseButton: true,
                                            confirmButtonText: 'OK',
                                            confirmButtonColor: '#3085d6'
                                        });
                                        return false;
                                    }
                                    @endif

                                    $this.prop('disabled', true).text('Enviando...');

                                    @if($upload_type != 'profile')
                                    data.formData = {
                                        upload_type: '{{$upload_type}}',
                                        title: $('#upload-title').val(),
                                        _token: '{{ csrf_token() }}'
                                    };
                                    @else
                                    data.formData = {
                                        upload_type: '{{$upload_type}}',
                                        user_id: $('#userIdPic').val(),
                                        _token: '{{ csrf_token() }}'
                                    };
                                    @endif

                                    data.submit();
                                }));
                        node.appendTo(data.context);
                    }
                },
                progress: function(e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('.progress-bar').attr('aria-valuenow', progress).css('width', progress + '%');
                    $('#up-prog-info').text(progress + "% enviado");
                }
            })
            .on('fileuploaddone', function(e, data) {
                var error = data['jqXHR']['responseJSON']['error'];
                var imgUrlpath = data['jqXHR']['responseJSON']['imgUrlpath'];
                var path = data['jqXHR']['responseJSON']['path'];

                if (error) {
                    swal({
                        title: 'Erro no upload',
                        text: error,
                        type: 'error',
                        showCloseButton: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    });
                    $('#errorAlert').text(error).show();
                } else {
                    swal({
                        title: 'Sucesso!',
                        text: 'Arquivo enviado com sucesso',
                        type: 'success',
                        showCloseButton: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    });
                    data.context.html('<div class="alert alert-success">Upload concluído com sucesso!</div>');
                    $('#errorAlert').hide();

                    @if($upload_type == 'profile')
                    $('#picPath').val(path);
                    $('#my-profile').attr('src', imgUrlpath);
                    @endif
                }

                $('.progress').hide();
                $('#selected-file-name').text('');
                $('#fileupload').val('');
            })
            .on('fileuploadfail', function(e, data) {
                swal({
                    title: 'Erro no upload',
                    text: 'Ocorreu um erro ao enviar o arquivo. Por favor, tente novamente.',
                    type: 'error',
                    showCloseButton: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });

                data.context.html('<div class="alert alert-danger">Falha no upload do arquivo</div>');
                var error = data['jqXHR']['responseJSON']['error'];
                $('#errorAlert').text(error || 'Erro desconhecido').show();
                $('.progress').hide();
                $('#selected-file-name').text('');
                $('#fileupload').val('');
            });

        // Add hover effect to file selection button
        $('label[for="fileupload"]').hover(
            function() {
                $(this).addClass('btn-primary-dark');
            },
            function() {
                $(this).removeClass('btn-primary-dark');
            }
        );
    });
</script>

<style>
    .btn-primary-dark {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .progress {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .alert {
        margin-top: 15px;
    }

    #selected-file-name {
        margin-top: 10px;
        color: #666;
    }

    .btn-success {
        margin-top: 10px;
    }
</style>