<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>VisionAI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
      <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <!--a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a-->
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">            
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-person-fill"></i>
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <li class="user-header text-bg-primary">
                  <i class="bi bi-person-fill rounded-circle shadow" style="font-size: 60px;"></i>
                  <p>
                  {{ Auth::user()->name }}
                    <small>{{ Auth::user()->roles->nombreRol }}</small>
                    <small>{{ Auth::user()->email }}</small>
                  </p>
                </li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="btn btn-default btn-flat float-end"></i> Salir
                    </button>
                </form>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="./index.html" class="brand-link">
            <span class="brand-text fw-light">VisionAI</span>
          </a>
        </div>
        <div class="sidebar-wrapper">
        @php
          $currentRoute = Route::currentRouteName();
          $dashboard = '';
          $roles = '';
          $usuarios = '';
             switch ($currentRoute) {
                case 'usuarios.lstUsuarios':
                    $clase_div = 'col-sm-4';
                    $estilo = 'padding:30px 400px 0px 0px';
                    $usuarios = 'active';
                    break;
                case 'dashboard':
                    $clase_div = 'col-sm-2';
                    $estilo = 'padding-top: 30px;';
                    $dashboard = 'active';
                    break;
                case 'usuarios.edit':
                    $clase_div = 'col-sm-6';
                    $estilo = 'padding:30px 319px 0px 0px';
                    $usuarios = 'active';
                    break;
                case 'roles.lstRoles':
                    $clase_div = 'col-sm-4';
                    $estilo = 'padding:30px 450px 0px 0px';
                    $roles = 'active';
                    break;
                case 'roles.create':
                    $clase_div = 'col-sm-6';
                    $estilo = 'padding:30px 500px 0px 0px';
                    $roles = 'active';
                    break;
                case 'roles.edit':
                    $clase_div = 'col-sm-6';
                    $estilo = 'padding:30px 440px 0px 0px';
                    $roles = 'active';
                    break;
                default:
                    $clase_div = 'col-sm-6';
                    $estilo = 'padding:30px 400px 0px 0px';
                    break;
            }
          @endphp
          <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{$dashboard}}">
                  <i class="nav-icon bi bi-graph-down"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('usuarios.lstUsuarios')}}" class="nav-link {{$usuarios}}">
                  <i class="nav-icon bi bi-people-fill"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('roles.lstRoles')}}" class="nav-link {{$roles}}">
                  <i class="nav-icon bi bi-shield-fill"></i>
                  <p>Roles</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </aside>
      <main class="app-main">
        <div class="app-content">         
          <div class="app-content" style="{{$estilo}}">
            <div class="row">
                <div class="{{$clase_div}}">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item" ><a href="{{ route('dashboard') }}">Inicio</a></li>
                        @if($currentRoute == 'dashboard')
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        @endif
                        @if($currentRoute == 'usuarios.lstUsuarios')
                        <li class="breadcrumb-item active" aria-current="page">Lista de usuarios</li>
                        @endif
                        @if($currentRoute == 'usuarios.create')
                        <li class="breadcrumb-item active"><a href="{{ route('usuarios.lstUsuarios') }}">Lista de usuarios</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Crear usuario</li>
                        @endif
                        @if($currentRoute == 'usuarios.edit')
                        <li class="breadcrumb-item active"><a href="{{ route('usuarios.lstUsuarios') }}">Lista de usuarios</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Actualizar usuario</li>
                        @endif
                        @if($currentRoute == 'usuarios.permisos')
                        <li class="breadcrumb-item active"><a href="{{ route('usuarios.lstUsuarios') }}">Lista de usuarios</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Permisos de usuario</li>
                        @endif
                        @if($currentRoute == 'usuarios.logs')
                        <li class="breadcrumb-item active"><a href="{{ route('usuarios.lstUsuarios') }}">Lista de usuarios</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Logs de usuario</li>
                        @endif
                        @if($currentRoute == 'roles.lstRoles')
                        <li class="breadcrumb-item active" aria-current="page">Lista de roles</li>
                        @endif
                        @if($currentRoute == 'roles.create')
                        <li class="breadcrumb-item active"><a href="{{ route('roles.lstRoles') }}">Lista de roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Crear rol</li>
                        @endif
                        @if($currentRoute == 'roles.edit')
                        <li class="breadcrumb-item active"><a href="{{ route('roles.lstRoles') }}">Lista de roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Actualizar rol</li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
          @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          @if (session('danger'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  {{ session('danger') }}
              </div>
          @endif
          @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  {{ session('success') }}
              </div>
          @endif
          @yield('content')
        </div>
      </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <script>
      const visitors_chart_options = {
        series: [
          {
            name: 'High - 2023',
            data: [100, 120, 170, 167, 180, 177, 160],
          },
          {
            name: 'Low - 2023',
            data: [60, 80, 70, 67, 80, 77, 100],
          },
        ],
        chart: {
          height: 200,
          type: 'line',
          toolbar: {
            show: false,
          },
        },
        colors: ['#0d6efd', '#adb5bd'],
        stroke: {
          curve: 'smooth',
        },
        grid: {
          borderColor: '#e7e7e7',
          row: {
            colors: ['#f3f3f3', 'transparent'],
            opacity: 0.5,
          },
        },
        legend: {
          show: false,
        },
        markers: {
          size: 1,
        },
        xaxis: {
          categories: ['22th', '23th', '24th', '25th', '26th', '27th', '28th'],
        },
      };

      const visitors_chart = new ApexCharts(
        document.querySelector('#visitors-chart'),
        visitors_chart_options,
      );
      visitors_chart.render();

      const sales_chart_options = {
        series: [
          {
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
          },
          {
            name: 'Revenue',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
          },
          {
            name: 'Free Cash Flow',
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
          },
        ],
        chart: {
          type: 'bar',
          height: 200,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded',
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997', '#ffc107'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent'],
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return '$ ' + val + ' thousands';
            },
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#sales-chart'),
        sales_chart_options,
      );
      sales_chart.render();
    </script>
  </body>
</html>
