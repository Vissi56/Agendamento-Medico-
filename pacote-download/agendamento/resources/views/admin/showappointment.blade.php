<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  @include('admin.css')
  <title>Exportar Consultas</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.navbar')
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                @if (session()->has('message'))
                         <script type="text/javascript">
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Mensagem',
                                    text: "{{ session()->get('message') }}",
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            });
                         </script>
                        @endif
                <h2>Consultas<button id="exportButton" class="btn btn-primary">Exportar para PDF</button></h2>
                <div class="form-group">
                  <label for="filter">Filtro de Colunas:</label>
                  <select id="filter" class="form-control" multiple>
                    <option value="name" selected>Nome Paciente</option>
                    <option value="email" selected>Email Endereco</option>
                    <option value="phone" selected>Telefone</option>
                    <option value="doctor" selected>Nome Medico</option>
                    <option value="created_at" selected>Data do pedido</option>
                    <option value="date" selected>Data Consulta</option>
                    <option value="message" selected>Descricao</option>
                    <option value="status" selected>Estado</option>
                    <option value="options" selected>Opcoes</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="timeFilter">Filtro de Tempo:</label>
                  <select id="timeFilter" class="form-control">
                    <option value="all" selected>Todas as Informações</option>
                    <option value="day">Hoje</option>
                    <option value="month">Este Mês</option>
                  </select>
                </div>
                
                <div class="table-responsive">
                  <table class="table" id="consultaTable" style="align-content: center;">
                    <thead>
                      <tr>
                        <th class="name">Nome Paciente</th>
                        <th class="email">Email Endereco</th>
                        <th class="phone">Telefone</th>
                        <th class="doctor">Nome Medico</th>
                        <th class="created_at">Data do pedido</th>
                        <th class="date">Data Consulta</th>
                        <th class="message">Descricao</th>
                        <th class="status">Estado</th>
                        <th class="options">Opcoes</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $appoint)
                      <tr>
                        <td class="name">{{$appoint->name}}</td>
                        <td class="email">{{$appoint->email}}</td>
                        <td class="phone">{{$appoint->phone}}</td>
                        <td class="doctor">{{$appoint->doctor}}</td>
                        <td class="created_at">{{$appoint->created_at}}</td>
                        <td class="date">{{$appoint->date}}</td>
                        <td class="message">{{$appoint->message}}</td>
                        <td class="status">{{$appoint->status}}</td>
                        <td class="options">
                          <a href="{{url('canceled',$appoint->id)}}" class="badge badge-outline-danger">Negar</a>
                          <a href="{{url('approved',$appoint->id)}}" class="badge badge-outline-success">Aceitar</a>
                          <a href="mailto:{{ $appoint->email }}" class="badge badge-outline-primary" onclick="redirectToMail(event, '{{ $appoint->email }}')">Enviar SMS</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Todos os seus direitos reservados {{date('m-Y')}}</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Feito por: <a href="https://youtu.be/BY_XwvKogC8" target="_blank">CSZI</a> ITEL</span>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  @include('admin.js')
  <script>
    document.getElementById('exportButton').addEventListener('click', async () => {
      const { jsPDF } = window.jspdf;
      const selectedColumns = Array.from(document.getElementById('filter').selectedOptions).map(option => option.value);
      const timeFilter = document.getElementById('timeFilter').value;

      // Apply time filter
      const today = new Date().toISOString().split('T')[0];
      const currentMonth = new Date().toISOString().split('T')[0].slice(0, 7);
      
      const rows = document.querySelectorAll('#consultaTable tbody tr');
      rows.forEach(row => {
        const createdAt = row.querySelector('.created_at').innerText.split(' ')[0]; // Assuming date is in 'YYYY-MM-DD HH:MM:SS' format
        if (
          (timeFilter === 'day' && createdAt !== today) ||
          (timeFilter === 'month' && createdAt.slice(0, 7) !== currentMonth)
        ) {
          row.style.display = 'none';
        } else {
          row.style.display = '';
        }
      });

      // Hide columns not selected
      const allColumns = ['name', 'email', 'phone', 'doctor', 'created_at', 'date', 'message', 'status', 'options'];
      allColumns.forEach(column => {
        const elements = document.querySelectorAll(`.${column}`);
        elements.forEach(element => {
          if (selectedColumns.includes(column)) {
            element.style.display = '';
          } else {
            element.style.display = 'none';
          }
        });
      });

      // Capture the table as image
      const table = document.getElementById('consultaTable');
      const canvas = await html2canvas(table);
      const imgData = canvas.toDataURL('image/png');

      // Create PDF
      const doc = new jsPDF({
        orientation: 'landscape',
        unit: 'mm',
        format: 'a4'
      });

      const pageWidth = 297;
      const imgWidth = pageWidth - 20; // Subtrai 20 mm para margens
      const imgHeight = (canvas.height * imgWidth) / canvas.width;

      doc.addImage(imgData, 'PNG', 10, 30, imgWidth, imgHeight);
      doc.save('consultas.pdf');

      Swal.fire({
        title: "",
        text: "Exportado Com Sucesso",
        icon: "success",
      });

      // Reset column visibility and row display
      allColumns.forEach(column => {
        const elements = document.querySelectorAll(`.${column}`);
        elements.forEach(element => {
          element.style.display = '';
        });
      });
      rows.forEach(row => {
        row.style.display = '';
      });
    });

    
function redirectToMail(event, email) {
    event.preventDefault(); // Previni o comportamento padrão do link
    window.location.href = 'mailto:' + email; // Redireciona para o mailto
}

  </script>
</body>
</html>
