<div class="page-section">
  <div class="container">
    <h1 class="text-center wow fadeInUp">Marcar Consulta</h1>
    <form class="main-form" action="{{url('appointment')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
      @csrf
      <div class="row mt-5 ">
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
          <input type="text" required class="form-control" name="name" placeholder="Nome Completo">
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <input type="email" required class="form-control" name="email" placeholder="Email">
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input type="datetime-local" name="date" class="form-control" id="datetime" required>
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
          <select required name="doctor" id="departement" class="custom-select">
            <option value="">Selecione um Medico</option>
            @foreach ($doctor as $doctors)
            <option value="{{$doctors->name}}">{{$doctors->name}}, especialidade {{$doctors->speciality}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <input type="text" class="form-control" name="phone" id="phone" required placeholder="Telefone">
        </div>
        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <textarea name="message" id="message" required class="form-control" rows="3" placeholder="Detalhes do paciente e da necessida da consulta..."></textarea>
        </div>
      </div>

      <button type="submit" class="btn btn-primary mt-1 wow zoomIn">Enviar pedido</button>
    </form>
  </div>
</div> <!-- .page-section -->


