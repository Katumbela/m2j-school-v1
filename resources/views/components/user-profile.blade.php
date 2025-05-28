@if($user)
<div class="row">
  <div class="col-md-2">
    @if(!empty($user->pic_path))
    <img src="{{asset('01-progress.gif')}}" data-src="{{url($user->pic_path)}}" class="img-thumbnail" id="my-profile" alt="Foto de Perfil" width="100%">
    @else
      @if(strtolower($user->gender) == 'male')
        <img src="{{asset('01-progress.gif')}}" data-src="{{asset('images/user-male.png')}}" class="img-thumbnail" width="100%">
      @else
        <img src="{{asset('01-progress.gif')}}" data-src="{{asset('images/user-female.png')}}" class="img-thumbnail" width="100%">
      @endif
    @endif
    @if(\Auth::user()->role == 'admin')
    <div class="rows" style="font-size:10px;margin-top:5%;">
      <input type="hidden" id="picPath" name="pic_path">
      <input type="hidden" id="userIdPic" name="user_id" value="{{$user->id}}">
      @component('components.file-uploader',['upload_type'=>'profile'])
      @endcomponent
    </div>
    @endif
  </div>
  <div class="col-md-10" id="main-container">
    <h3>{{$user->name}} <span class="label label-danger">{{ucfirst($user->role)}}</span> <span class="label label-primary">{{ucfirst($user->gender)}}</span>
      @if ($user->role == 'teacher' && $user->section_id > 0)
        <small>Professor da Seção: <span class="label label-info">{{ucfirst($user->section->section_number)}}</span></small>
      @endif
      
      @if($user->role == "student")
       <button class="btn btn-xs btn-success pull-right" role="button" id="btnPrint"><i class="material-icons">print</i> Imprimir Perfil</button>
       <div class="visible-print-block" id="profile-content">
       <div class="row">
          <div class="col-md-12">
            <div class="col-xs-8">
              <h2>{{$user->section->class->school->name}}</h2>
              <div style="font-size: 10px;">{{$user->section->class->school->about}}</div>
            </div>
            <div class="col-xs-4">
              <h3>Perfil do Estudante</h3>
              <div style="font-size: 10px;">Data de Impressão: {{Carbon\Carbon::now()->format('d/m/Y')}}</div>
            </div>
          </div>
        </div>
        <br/>
        <div class="row">
          <div class="col-md-12">
            <p class="bg-primary" style="text-align:center;">
              Informações Acadêmicas
            </p>
            <div class="col-xs-9">
              <table class="table">
                <tr>
                  <td>ID do Estudante:</td>
                  <td>{{$user->student_code}}</td>
                  <td>Nome do Estudante:</td>
                  <td>{{$user->name}}</td>
                </tr>
                <tr>
                  <td>Turma:</td>
                  <td>{{$user->section->class->class_number}}</td>
                  <td>Seção:</td>
                  <td>{{$user->section->section_number}}</td>
                </tr>
                <tr>
                  <td>Sessão:</td>
                  <td>{{$user->studentInfo['session'] ?? 'N/A'}}</td>
                  <td>Versão:</td>
                  <td>{{$user->studentInfo['version'] ?? 'N/A'}}</td>
                </tr>
                <tr>
                  <td>Grupo:</td>
                  <td>{{$user->studentInfo['group'] ?? 'N/A'}}</td>
                  <td colspan="2"></td>
                </tr>
              </table>
            </div>
            <div class="col-xs-3">
              @if(!empty($user->pic_path))
              <img src="https://static.vecteezy.com/system/resources/thumbnails/000/439/863/small/Basic_Ui__28186_29.jpg" data-src="{{url($user->pic_path)}}" class="img-thumbnail" id="my-profile" alt="Foto de Perfil" width="120px" height="120px">
              @else
              @if(strtolower($user->gender) == 'male')
                <img src="{{asset('01-progress.gif')}}" data-src="https://static.vecteezy.com/system/resources/thumbnails/000/439/863/small/Basic_Ui__28186_29.jpg" class="img-thumbnail" id="my-profile" alt="Foto de Perfil" width="120px" height="120px">
              @else
                <img src="{{asset('01-progress.gif')}}" data-src="https://static.vecteezy.com/system/resources/thumbnails/000/439/863/small/Basic_Ui__28186_29.jpg" class="img-thumbnail" id="my-profile" alt="Foto de Perfil" width="120px" height="120px">
              @endif
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p class="bg-primary" style="text-align:center;">
              Detalhes Pessoais
            </p>
            <div class="col-xs-12">
              <table class="table">
                <tr>
                  <td>Email:</td>
                  <td>{{$user->email}}</td>
                  <td>Número de Contato</td>
                  <td>{{$user->phone_number}}</td>
                </tr>
                <tr>
                  <td>Gênero:</td>
                  <td>{{$user->gender}}</td>
                  <td>Grupo Sanguíneo:</td>
                  <td>{{$user->blood_group}}</td>
                </tr>
                <tr>
                  <td>Nacionalidade:</td>
                  <td>{{$user->nationality}}</td>
                  <td>Data de Nascimento:</td>
                  <td>{{$user->birthday ? Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : 'N/A'}}</td>
                </tr>
                <tr>
                  <td>Religião:</td>
                  <td>{{$user->studentInfo['religion'] ?? 'N/A'}}</td>
                  <td>Nome do Pai:</td>
                  <td>{{$user->studentInfo['father_name'] ?? 'N/A'}}</td>
                </tr>
                <tr>
                  <td>Nome da Mãe:</td>
                  <td>{{$user->studentInfo['mother_name'] ?? 'N/A'}}</td>
                  <td>Endereço:</td>
                  <td>{{$user->address}}</td>
                </tr>
                <tr>
                  <td>Número de Telefone:</td>
                  <td>{{$user->phone_number}}</td>
                  <td>Número do Telefone do Pai:</td>
                  <td>{{$user->studentInfo['father_phone_number'] ?? 'N/A'}}</td>
                </tr>
                <tr>
                  <td>ID Nacional do Pai:</td>
                  <td>{{$user->studentInfo['father_national_id'] ?? 'N/A'}}</td>
                  <td>Ocupação do Pai:</td>
                  <td>{{$user->studentInfo['father_occupation'] ?? 'N/A'}}</td>
                </tr>
                <tr>
                  <td>Cargo do Pai:</td>
                  <td>{{$user->studentInfo['father_designation'] ?? 'N/A'}}</td>
                  <td>Renda Anual do Pai:</td>
                  <td>{{$user->studentInfo['father_annual_income'] ?? 'N/A'}}</td>
                </tr>
                <tr>
                  <td>Número do Telefone da Mãe:</td>
                  <td>{{$user->studentInfo['mother_phone_number'] ?? 'N/A'}}</td>
                  <td>ID Nacional da Mãe:</td>
                  <td>{{$user->studentInfo['mother_national_id'] ?? 'N/A'}}</td>
                </tr>
                <tr>
                  <td>Ocupação da Mãe:</td>
                  <td>{{$user->studentInfo['mother_occupation'] ?? 'N/A'}}</td>
                  <td>Cargo da Mãe:</td>
                  <td>{{$user->studentInfo['mother_designation'] ?? 'N/A'}}</td>
                </tr>
                <tr>
                  <td>Renda Anual da Mãe:</td>
                  <td>{{$user->studentInfo['mother_annual_income'] ?? 'N/A'}}</td>
                  <td>Sobre:</td>
                  <td>{{$user->about}}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
       </div>
       <script>
        $("#btnPrint").on("click", function () {
            var tableContent = $('#profile-content').html();
            var printWindow = window.open('', '', 'height=720,width=1280');
            printWindow.document.write('<html><head>');
            printWindow.document.write('<link href="{{url('css/app.css')}}" rel="stylesheet">');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<div class="container"><div class="col-md-12" id="academic-part">');
            printWindow.document.write(tableContent);
            printWindow.document.write('</div></div></body></html>');
            printWindow.document.close();
            printWindow.print();
          });
        </script>
      @endif
     </h3>
    <div class="table-responsive" style="margin-top: 3%;">
    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          @if($user->role == "student")
          <td><b>Código:</b></td>
          <td>{{$user->student_code}}</td>
          <td><b>Sessão:</b></td>
          <td>{{$user->studentInfo['session'] ?? 'N/A'}}</td>
          @else
          <td><b>Código:</b></td>
          <td>{{$user->student_code}}</td>
          <td><b>Sobre:</b></td>
          <td>{{$user->about}}</td>
          @endif
        </tr>
        @if($user->role == "student")
        <tr>
          <td><b>Turma:</b></td>
          <td>{{$user->section->class->class_number}}</td>
          <td><b>Seção:</b></td>
          <td>{{$user->section->section_number}}</td>
        </tr>
        <tr>
          <td><b>Versão:</b></td>
          <td>{{$user->studentInfo['version'] ?? 'N/A'}}</td>
          <td><b>Grupo Sanguíneo:</b></td>
          <td>{{$user->blood_group}}</td>
        </tr>
        <tr>
          <td><b>Grupo:</b></td>
          <td>{{$user->studentInfo['group'] ?? 'N/A'}}</td>
          <td><b>Data de Nascimento:</b></td>
          <td>{{$user->birthday ? Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : 'N/A'}}</td>
        </tr>
        @endif
        <tr>
          <td><b>Nacionalidade:</b></td>
          <td>{{$user->nationality}}</td>
          <td><b>Religião:</b></td>
          <td>{{$user->studentInfo['religion'] ?? 'N/A'}}</td>
        </tr>
        @if($user->role == "student")
        <tr>
          <td><b>Nome do Pai:</b></td>
          <td>{{$user->studentInfo['father_name'] ?? 'N/A'}}</td>
          <td><b>Nome da Mãe:</b></td>
          <td>{{$user->studentInfo['mother_name'] ?? 'N/A'}}</td>
        </tr>
        @endif
        <tr>
          <td><b>Endereço:</b></td>
          <td>{{$user->address}}</td>
          <td><b>Número de Telefone:</b></td>
          <td>{{$user->phone_number}}</td>
        </tr>
        @if($user->role == "student")
        <tr>
          <td><b>Número do Telefone do Pai:</b></td>
          <td>{{$user->studentInfo['father_phone_number'] ?? 'N/A'}}</td>
          <td><b>ID Nacional do Pai:</b></td>
          <td>{{$user->studentInfo['father_national_id'] ?? 'N/A'}}</td>
        </tr>
        <tr>
          <td><b>Ocupação do Pai:</b></td>
          <td>{{$user->studentInfo['father_occupation'] ?? 'N/A'}}</td>
          <td><b>Cargo do Pai:</b></td>
          <td>{{$user->studentInfo['father_designation'] ?? 'N/A'}}</td>
        </tr>
        <tr>
          <td><b>Renda Anual do Pai:</b></td>
          <td>{{$user->studentInfo['father_annual_income'] ?? 'N/A'}}</td>
          <td><b>Número do Telefone da Mãe:</b></td>
          <td>{{$user->studentInfo['mother_phone_number'] ?? 'N/A'}}</td>
        </tr>
        <tr>
          <td><b>ID Nacional da Mãe:</b></td>
          <td>{{$user->studentInfo['mother_national_id'] ?? 'N/A'}}</td>
          <td><b>Ocupação da Mãe:</b></td>
          <td>{{$user->studentInfo['mother_occupation'] ?? 'N/A'}}</td>
        </tr>
        <tr>
          <td><b>Cargo da Mãe:</b></td>
          <td>{{$user->studentInfo['mother_designation'] ?? 'N/A'}}</td>
          <td><b>Renda Anual da Mãe:</b></td>
          <td>{{$user->studentInfo['mother_annual_income'] ?? 'N/A'}}</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endif
