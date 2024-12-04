<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Inclua o CSS do SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- Inclua o JavaScript do SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Inclua jsPDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <!-- Inclua html2canvas -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Consultas-{{config('app.name')}}</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
</head>
<header style="background-color:gray;">
  <div class="topbar">
  </div> <!-- .topbar -->

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
            <a style="color:white;" class="nav-link" href="{{url('/myappointment')}}">Consultas({{$appointmentCount}})</a>
          </li>
          <li>
            <a style="color:white;" href="{{ route('profile.show') }}">Meu Perfil</a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <li class="nav-item">
            <a style="color:white;" class="nav-link" href="{{ route('logout') }}" 
               onclick="event.preventDefault(); 
                         document.getElementById('logout-form').submit();">
              Sair
            </a>
          </li>
          <li class="nav-item">
          </li>
        </ul>
      </div> <!-- .navbar-collapse -->
    </div> <!-- .container -->
  </nav>
</header>

<body>
  
  <div align="center" style="padding: 70px">
    <table id="consultaTable" style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd; text-align: left;">
      <tr style="background-color: #f2f2f2;" align="center">
          <th style="padding: 8px; border: 1px solid #dddddd;">Nome do Médico</th>
          <th style="padding: 8px; border: 1px solid #dddddd;">Data do pedido</th>
          <th style="padding: 8px; border: 1px solid #dddddd;">Data da Consulta</th>
          <th style="padding: 8px; border: 1px solid #dddddd;">Mensagem</th>
          <th style="padding: 8px; border: 1px solid #dddddd;">Estado</th>
          <th style="padding: 8px; border: 1px solid #dddddd;">Cancelar</th>
      </tr>
      @foreach ($appoint as $appoints)
      <tr style="border: 1px solid #dddddd;">
          <td style="padding: 8px; border: 1px solid #dddddd;">{{$appoints->doctor}}</td>
          <td style="padding: 8px; border: 1px solid #dddddd;">{{$appoints->created_at}}</td>
          <td style="padding: 8px; border: 1px solid #dddddd;">{{$appoints->date}}</td>
          <td style="padding: 8px; border: 1px solid #dddddd;">{{$appoints->message}}</td>
          <td style="padding: 8px; border: 1px solid #dddddd;">{{$appoints->status}}</td>
          <td align="center" style="padding: 8px; border: 1px solid #dddddd;"><a href="{{url('cancel_appoint',$appoints->id)}}" id="" onclick="alertEliminar()" class="btn btn-danger">Excluir</a></td>
      </tr>
      @endforeach
    </table><br>
    <button id="exportButton" class="btn btn-primary">Exportar para PDF</button>
  </div>
  
  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
  <script src="../assets/vendor/wow/wow.min.js"></script>
  <script src="../assets/js/theme.js"></script>
  <script>
    async function exportarPDF() {
        const { jsPDF } = window.jspdf;

        // Cria um novo documento jsPDF com folha A4 na orientação horizontal
        const doc = new jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: 'a4'
        });

        // Define a largura da página A4 na orientação horizontal
        const pageWidth = 297;
        
        // Adiciona o título centralizado
        doc.setTextColor(255, 0, 0);
        doc.setFontSize(24);
        doc.text('{{config('app.name')}}', pageWidth / 2, 20, { align: 'center' });

        // Obtém a tabela HTML
        const table = document.querySelector('table');

        // Usa html2canvas para capturar a tabela como uma imagem
        const canvas = await html2canvas(table);

        // Converte o canvas para uma imagem em base64
        const imgData = canvas.toDataURL('image/png');

        // Calcula a largura e altura da imagem no PDF, mantendo a proporção
        const imgWidth = pageWidth - 20; // Subtrai 20 mm para margens
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        // Adiciona a imagem da tabela ao PDF
        doc.addImage(imgData, 'PNG', 10, 30, imgWidth, imgHeight);

        // Salva o documento PDF
        doc.save('minhas_consultas.pdf');

        // Exibe uma mensagem de sucesso
        Swal.fire({
            title: "Exportado Com Sucesso",
            text: "",
            icon: "success",
        });
    }
    document.getElementById('exportButton').addEventListener('click', exportarPDF);
     function alertEliminar(){
    Swal.fire({
            title: "Eliminada Com Sucesso",
            text: "",
            icon: "success",
        });
    }
  </script>
</body>
</html>
