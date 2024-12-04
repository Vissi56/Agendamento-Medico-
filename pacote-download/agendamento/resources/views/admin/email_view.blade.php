    
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    <!-- Inclua o CSS do SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Inclua o JavaScript do SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Required meta tags -->
    <style>
        label{
            display: inline-block;
            width: 200px;
        }
    </style>
    @include('admin.css')
  </head>
  <body>
     
     <!-- container-scroller -->
     <div class="container-scroller">
        @include('admin.sidebar')
    @include('admin.navbar')  
    <div class="col-12 grid-margin stretch-card" style="color: white;">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">EMAIL</h4>
            <div class="conteiner" style="text-align: center; padding-top:75px;">
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
            <p class="card-description">  </p>
            <form class="forms-sample" action="mailto:" enctype="text/plain" style="text-align: left;" method="POST">
              <div class="form-group">
                <label for="Saudaçã"></label><br>
                <input class="form-control" type="text" id="Saudaçã" name="Saudaçã" required value="{{config('app.name')}}">
                <label for="exampleInputEmail3"></label>
                <textarea style="color: white;" id="Mensagem" name="Mensagem" rows="4" class="form-control" cols="50" required></textarea>
                <label for="fim"></label><br>
                <input class="form-control" type="text" id="fim" name="fim" required value="A {{config('app.name')}} deseja-lhe boa continuação!">
              </div>
              <button type="submit" class="btn btn-primary mr-2">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    <!-- plugins:js -->
    @include('admin.js')
      </body>
</html>

