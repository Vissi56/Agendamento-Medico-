    
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="{{url('/public')}}">
    @include('admin.css')
  </head>
  <body>

    <div class="container-scroller">  
        @include('admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">
                  <i class="mdi mdi-dots-horizontal"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile.show') }}" class="dropdown-item preview-item">
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1">Perfil</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
                <a class="dropdown-item preview-item" href="{{ route('logout') }}" 
                onclick="event.preventDefault(); 
                          document.getElementById('logout-form').submit();">
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1">Sair</p>
                  </div>
                </a>
              </div>
              </li>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Preencha o formulrio</h4>
                    <p class="card-description"> & cadastre </p>
                    <p> @if (session()->has('message'))
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
                    </p>
                    <form class="forms-sample" action="{{url('editdoctor', $data->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Nome<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="exampleInputName1" required placeholder="Nome" name="name" value="{{$data->name}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Telefone<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" id="exampleInputEmail3" required placeholder="Telefone" name="phone" value="{{$data->phone}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Sala<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" id="exampleInputPassword4" required placeholder="Sala" name="room" value="{{$data->room}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Especialidade</label>
                        <select class="form-control" id="exampleSelectGender" style="color: white;" name="speciality">
                          <option value="{{$data->speciality}}">{{$data->speciality}}</option>
                          <option value="Oftamologia">Oftamologia</option>
                          <option value="Optometria">Optometria</option>
                          <option value="Ortóptica">Ortóptica</option>
                          <option value="Oculista">Oculista</option>
                          <option value="Cirurgia refrativa">Cirurgia refrativa</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Trocar imagem</label>
                        <input type="file" name="file" id="file" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <span class="input-group-append">
                            <input class="file-upload-browse btn btn-primary" id="file" type="file" name="file">
                          </span>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-success mr-2">OK</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
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
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
    <!-- End custom js for this page -->
  </body>
</html>
