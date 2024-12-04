<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Home-{{config('app.name')}}</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">
</head>
<body>
  <div class="back-to-top"></div>
  <header style="background-color: gray; color:white;">
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
          @if (Auth::check())
            <p>Olá, {{ Auth::user()->name }}</p>
          @endif
      </a>
        <img src="..\assets\img\mobile_app.png" alt="" width="55" height="55">
        <a class="navbar-brand" href="{{url('/')}}">
          {{config('app.name')}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a style="color:white;" class="nav-link" href="{{url('/')}}">Dashboard</a>
            </li> 
            <li class="nav-item">
              <a style="color:white;" class="nav-link" href="{{url('/myappointment')}}">Consultas</a>
            </li> 
            <li><a style="color:white;" href="{{ route('profile.show') }}">
              Meu Perfil
          </a>
          </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          <li class="nav-item">
          <a  style="color:white;"class="nav-link" href="{{ route('logout') }}" 
             onclick="event.preventDefault(); 
                       document.getElementById('logout-form').submit();">
              Sair
          </a>
          </li>
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>
    @include('user.doctor')
    @include('user.appoitment')
    </div> <!-- .bg-light -->
  </div> <!-- .bg-light -->

  <!-- include user.dctr -->
<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

<!--teste-->

  
</body>
<script>
  function validateForm() {
    if (!validatePhone()) {
      return false;
    }
    if (!validateDateTime()) {
      return false;
    }
    return true;
  }

  function validatePhone() {
    const phoneInput = document.getElementById('phone').value;
    const angolaPhonePattern = /^\+244\d{9}$/;
    if (!angolaPhonePattern.test(phoneInput)) {
      swal("Por favor, insira um número de telefone válido de Angola (começando com +244 seguido por 9 dígitos).");
      return false;
    }
    return true;
  }

  function validateDateTime() {
    const dateTimeInput = document.getElementById('datetime').value;
    const selectedDateTime = new Date(dateTimeInput);

    if (selectedDateTime < new Date()) {
      swal("Por favor, insira uma data e hora futura.");
      return false;
    }

    const day = selectedDateTime.getUTCDay();
    if (day === 0 || day === 6) {
      swal("Por favor, insira uma data que não seja em um final de semana.");
      return false;
    }

    const hour = selectedDateTime.getUTCHours();
    if (hour < 8 || hour > 16) {
      swal("Por favor, insira um horário entre 08:00 e 16:00.");
      return false;
    }

    return true;
  }
</script></html>

