<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Home-{{ config('app.name') }}</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">
</head>
<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">{{ config('app.name') }}</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link">/médicos/serviços</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary ml-lg-3" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary ml-lg-3" href="{{route('register')}}">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="page-hero bg-image overlay-dark" style="background-image: url(../assets/img/bg_image_1.jpg);">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <h1 class="display-4">BEM-VINDO AO {{config('app.name')}}</h1>
        <span class="subhead">
          Somos uma equipe de médicos oftamologistas competentes <br>dispostos a fornercer um ótimo serviço!</span>
          <br>
        <a href="{{url('/login')}}" class="btn btn-primary">Marcar Consulta</a>
      </div>
    </div>
  </div>
  <div class="bg-light">
    <div class="page-section py-3 mt-md-n5 custom-index">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-4 py-3 py-md-0" onclick="alertWhy()" title="Dê um Clique">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-secondary text-white">
                <!--span cm chabuild-->
              </div>
              <p>Por que escolher a OFTCAD?</p>   
            </div> 
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp" onclick="alertReport()" title="Dê um Clique">
              <div class="circle-shape bg-primary text-white">   
              </div>
              <p>Relatório</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp" onclick="alertCris()" title="Dê um Clique">
              <div class="circle-shape bg-accent text-white">   
              </div>
              <p>Cristais</p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .page-section -->
@include('user.doctor')
@include('user.service')
@include('user.question')
  <footer class="page-footer">
    <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>{{config('app.name')}}</h5>
          <ul class="footer-menu">
            <li>Inicio</a></li>
            <li>Sobre nós</a></li>
            <li>Serviços</a></li>
            <li>Doctores</a></li>
            <li>Contacto</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Nossos Serviços</h5>
          <ul class="footer-menu">
            <li>Oftamologia</li>
            <li>Optometria</li>
            <li>Ortóptica</li>
            <li>Oculista</li>
            <li>Cirurgia refrativa</li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Contacto</h5>
          <p>Distrito do Rangel </p>
            <p> bairro da CTT, Av Ngola Kuiluanje</p>
            <p class="mt-3"><strong>Telefone:</strong> <span>+244 912 417 774</span></p>
            <p><strong>Email:</strong> <span>OFTCAD@gmail.com</span></p>
          <h5 class="mt-3">Social Media</h5>
          <div class="footer-sosmed mt-3">
            <a href="#" target="_blank"><span class="mai-logo-facebook-f"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-twitter"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-instagram"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>
      </div>
      <hr>
      <p id="copyright">Copyright &copy; {{config('app.name')}} {{date('d-m-Y')}} <a href="https://macodeid.com/" target="_blank">ITEL</a>. Todos direitos reservados</p>
    </div>
  </footer>
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
<script src="../assets/vendor/wow/wow.min.js"></script>
<script src="../assets/js/theme.js"></script>
<script>
  function alertWhy(){
    swal("Por que {{config('app.name')}}", 
    `Escolher a nossa oftamologia é optar por um atendimento de excelência, 
     personalizado e centrado nas necessidades do paciente. Contamos com uma 
     equipa de especialistas altamente qualificados e constantemente atuali-
     zados com as mais recentes evoluções e técnicas da área`);
  }
  function alertReport(){
    swal("Relaório", 
    `O relatório detalhado de exames oculares são essenciais para resistar
     as condições de visões dos pacientes.Esse relatório inclui,resultados 
     de testes de acuidade visual`);
  }
  function alertCris(){
    swal("Cristais", 
    `Os cristais sobre a forma de lentes intraoculares desenpenhan um papel 
    crucial na oftalmologia,especialmente em cirugia de catarata.`);
  }
  function alert1(){
    swal("Oftamologia", 
    `É a especialidade médica que se ocupa do diagnóstico e tratamento das doenças dos olhos.
     Oftalmologistas realizam cirurgias oculares, tratam condições como catarata, glaucoma, e 
     doenças da retina, além de prescrever óculos e lentes de contato.`);
  }
  function alert2(){
    swal("Optometria", 
    `Optometristas são profissionais da saúde visual
     Realizam exames de vista, prescrevem óculos e 
     lentes de contato e detectam anomalias visuais. 
     Eles não realizam cirurgias, mas podem tratar 
     algumas condições oculares com medicamentos.`);
  }
  function alert3(){
    swal("Ortóptica", 
    `Ortoptistas são especializados em diagnosticar e tratar problemas 
     de motilidade ocular e coordenação dos olhos como o estrabismo e 
     a ambliopia (olho preguiçoso). Eles trabalham frequentemente com 
     oftalmologistas para tratar esses distúrbios.`);
  }
  function alert4(){
    swal("Oculista", 
    `Profissionais que fabricam e ajustam próteses oculares (olhos artificiais) 
    para pacientes que perderam um olho devido a trauma ou doença.`);
  }
  function alert5(){
    swal("Cirurgia refrativa", 
    `Especialidade dentro da oftalmologia focada em procedimentos cirúrgicos para 
     corrigir problemas de refração, como miopia, hipermetropia e astigmatismo, usando 
     técnicas como LASIK e PRK.`);
  }
</script>
<script>
  // alerte para as perguntas
  function alertq1(){
    swal("O que é degeneração macular e como é tratada?", 
    `A degeneração macular é uma condição que afecta a parte central da 
     retina,levando a perda na . central. Tratamentos podem incluir 
     suplementos vitamínicos,terápia a laser,injeções intraoculares e 
     em alguns casos cirugia.`);
  }
  function alertq2(){
    swal("Quanto tempo leva para se recuperar de uma cirurgia ocular?", 
    `O tempo de recuperação varia de acordo com o tipo de cirurgia. 
    Por exemplo, a recuperação de uma cirurgia de catarata geralmente 
    leva algumas semanas, enquanto a recuperação de uma cirurgia de 
    correcção de visão a laser pode ser mais rápida. O oftamologista 
    fornecerá orientações especificas para cada caso.`);
  }
  function alertq3(){
    swal("Quais são os tratamentos para a sindrome do olho seco?", 
    `Os tratamentos para olho secos podem incluir o uso de lágrimas 
     artificiais, pomadas oculares, compressas quentes, além de mudança 
     no estilo de vida, como aumentar a ingestão de água e usar um 
     umidificador. Em casos mais graves tratamentos médicos especificas 
     podem ser necessários.`);
  }
  function alertq4(){
    swal("Qual a diferença de oftalmologista, optometrista e ortoptista?", 
    `O oftalmologista é um médica especializado em diagnósticos, tratamentos 
     e cirurgias de problemas oculares. O optometrista é um profissional treinado 
     para examinar a visão, prescrever óculos e lentes de conctatos. O ortoptista 
     trata problemas de movimentos oculares e visão binocular, muitas vezes trabalhando 
     em conjunto com os oftalmologistas.`);
  }
  function alertq5(){
    swal("Posso usar qualquer tipo colírio?", 
    `Não, é importante usar apenas colírios prescritos ou recomendados 
     por um oftalmologista. Alguns colírios de venda livre podem não ser 
     adequados para todos os tipos de condições oculares e podem até piorar 
     os sintomas.`);
  }
  function alertq6(){
    swal("Como prevenir problemas de visão?", 
    `Manter uma dieta saudável, evitar fumar, usar óculos de sol com protecção UV e 
    fazer exames regulares com um oftalmologista, são formas eficazes de prevenir 
    problemas de visão. Além disso, é importante seguir as orientações para o uso 
    correcto de lentes de contactos e evitar a fadiga ocular.`);
  }
</script>
</body>
</html>