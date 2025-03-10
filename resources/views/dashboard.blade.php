@extends('layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  
  <script src="{{ asset('js/dashboard.js') }}"></script>

    </script>

  <!-- Contenido principal -->
  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon text-bg-primary shadow-sm">
              <i class="bi bi-gear-fill"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <span class="info-box-number">10<small>%</small></span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon text-bg-danger shadow-sm">
              <i class="bi bi-hand-thumbs-up-fill"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon text-bg-success shadow-sm">
              <i class="bi bi-cart-fill"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon text-bg-warning shadow-sm">
              <i class="bi bi-people-fill"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Total usuarios</span>
              <span class="info-box-number" id="user_register"></span>
            </div>
          </div>
        </div>
      </div>
      <!-----INICIO DE GRAFICO de cantidad de reconocimientos--->
      <div class="row">
        <!-- Gráfico de Cantidad de Reconocimientos -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Cantidad de reconocimientos por tipo</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="fs-5 fw-bold"><span id="total-recognitions">0</span> Reconocimientos</p>
                    </div>
                    <div id="recognitionChart"></div>
                    <span id="genUrl" 
                        data-url="{{ route('datosReconocimiento') }}" 
                        data-getUserRegistrationsByMonth="{{ route('getUserRegistrationsByMonth') }}">
                    </span>
                </div>
            </div>
        </div>    
      <!-----INICIO DE GRAFICO de cantidad de reconocimientos--->
   
        <!-- Gráfico de Usuarios Registrados -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                  <h3 class="card-title">Cantidad de Usuarios Registrados</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                        <span class="fs-5 fw-bold"><span id="total-users">0 </span> Usuarios Registrados en el Año</span>
                        </p>
                    </div>
                    <div class="position-relative mb-4">
                        <div id="users-chart"></div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="row" style='padding-top:20px'>
      </div>
      <div class="row">
      <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Enfermedades visuales</h3>
                </div>
                <div class="card-body">
                  <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Distribución de Enfermedades Visuales por Rango de Edad</h3>
                </div>
                <div class="card-body">
                <div id="grafico"></div>
                </div>
            </div>
      </div>



      

<!---------
<div class="card">
                  <div class="card-header border-0">
                    <h3 class="card-title">Online Store Overview</h3>
                    <div class="card-tools">
                      <a href="#" class="btn btn-sm btn-tool"> <i class="bi bi-download"></i> </a>
                      <a href="#" class="btn btn-sm btn-tool"> <i class="bi bi-list"></i> </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3" >
                      <p class="text-success fs-2">
                        <svg height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" >
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" ></path>
                        </svg>
                      </p>
                      <p class="d-flex flex-column text-end">
                        <span class="fw-bold">
                          <i class="bi bi-graph-up-arrow text-success"></i> 12%
                        </span>
                        <span class="text-secondary">CONVERSION RATE</span>
                      </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                      <p class="text-info fs-2">
                        <svg height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" >
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                        </svg>
                      </p>
                      <p class="d-flex flex-column text-end">
                        <span class="fw-bold">
                          <i class="bi bi-graph-up-arrow text-info"></i> 0.8%
                        </span>
                        <span class="text-secondary">SALES RATE</span>
                      </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-0">
                      <p class="text-danger fs-2">
                        <svg height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" >
                          <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" ></path>
                        </svg>
                      </p>
                      <p class="d-flex flex-column text-end">
                        <span class="fw-bold">
                          <i class="bi bi-graph-down-arrow text-danger"></i>
                          1%
                        </span>
                        <span class="text-secondary">REGISTRATION RATE</span>
                      </p>
                    </div>
                  </div>
                </div>

----->
                
      </div>
    </div>
  </div>
</div>
@endsection