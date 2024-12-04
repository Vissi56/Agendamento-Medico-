<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      @include('admin.navbar')
      <div class="main-panel">
        <div class="content-wrapper"> 
          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h2>Médicos</h2>
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
                  <button id="exportBtn" class="btn btn-success">Exportar para PDF</button>
                  <div class="table-responsive">
                    <table id="doctorTable" class="table">
                      <thead>
                        <tr> 
                          <th>Nome</th>
                          <th>Telefone</th>
                          <th>Especialidade</th>
                          <th>Sala</th>
                          <th>Imagem</th>
                          <th>Opções</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $doctor)
                        <tr>
                          <td>{{$doctor->name}}</td>
                          <td>{{$doctor->phone}}</td>
                          <td>{{$doctor->speciality}}</td>
                          <td>{{$doctor->room}}</td>
                          <td><img height="100px" width="100px" src="doctorimage/{{$doctor->image}}" alt=""></td>
                          <td>
                            <a href="{{url('deletedoctor', $doctor->id)}}" class="btn btn-danger">Apagar</a>
                            <a href="{{url('updatedoctor', $doctor->id)}}" class="btn btn-primary">Editar</a>
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
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Todos os seus diretorios reservados{{date(' m-Y')}}</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Feito por: <a href="https://youtu.be/BY_XwvKogC8" target="_blank">CSZI</a>ITEL</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    @include('admin.js')
    <!-- jsPDF and jsPDF-AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
    <script>
      document.getElementById('exportBtn').addEventListener('click', async function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.text('Médicos', 14, 20);

        const table = document.getElementById('doctorTable');
        const rows = Array.from(table.rows);
        const data = await Promise.all(rows.map(async (row) => {
          const cells = Array.from(row.cells);
          const rowData = await Promise.all(cells.map(async (cell) => {
            if (cell.querySelector('img')) {
              const img = cell.querySelector('img');
              const src = img.src;
              const base64 = await getBase64ImageFromURL(src);
              return { image: base64, width: 20, height: 20 };
            }
            return cell.innerText.trim();
          }));
          return rowData;
        }));

        doc.autoTable({
          head: [data[0].map(cell => (typeof cell === 'string' ? cell : 'Imagem'))],
          body: data.slice(1),
          startY: 30,
          didDrawCell: (data) => {
            if (data.cell.raw && data.cell.raw.image) {
              doc.addImage(data.cell.raw.image, 'JPEG', data.cell.x + 2, data.cell.y + 2, 20, 20);
            }
          }
        });
        

        doc.save('medicos.pdf');
        Swal.fire({
        title: "",
        text: "Exportado Com Sucesso",
        icon: "success",
      });
      });

      function getBase64ImageFromURL(url) {
        return new Promise((resolve, reject) => {
          let img = new Image();
          img.setAttribute('crossOrigin', 'anonymous');
          img.onload = () => {
            let canvas = document.createElement('canvas');
            canvas.width = img.width;
            canvas.height = img.height;
            let ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0);
            let dataURL = canvas.toDataURL('image/jpeg');
            resolve(dataURL);
          };
          img.onerror = error => reject(error);
          img.src = url;
        });
      }
    </script>
  </body>
</html>
