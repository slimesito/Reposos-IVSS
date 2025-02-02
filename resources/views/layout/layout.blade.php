<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{!! asset('assets/logo.png') !!}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    {{-- FONTSAWESOME --}}
    <link href="{!! asset('assets/fontawesome/css/fontawesome.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/fontawesome/css/brands.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/fontawesome/css/solid.css') !!}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{!! asset('app/lib/owlcarousel/assets/owl.carousel.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('app/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') !!}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{!! asset('app/css/bootstrap.min.css') !!}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{!! asset('app/css/style.css') !!}" rel="stylesheet">

    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{!! asset('app/css/select2.css') !!}" rel="stylesheet" />

    <!-- Alerta Reposos -->
    <link rel="stylesheet" href="{!! asset('assets/css/alertaReposos.css') !!}">

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="{{url('/inicio')}}" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><img src="{!! asset('assets/logo.png') !!}" alt="Logo IVSS" height="50" width="50"> Reposos</h3>
                </a>
                
                <div class="navbar-nav w-100">

                    @if (Auth::check() && Auth::user()->cod_cargo == 4)

                        {{-- <div class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-solid fa-book-medical me-2"></i>Capítulos</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('gestion.capitulos.view') }}" class="dropdown-item">Gestión de Capítulos</a>
                                <a href="{{ route('registro.capitulos.view') }}" class="dropdown-item">Registrar nuevo Capítulo</a>
                            </div>
                        </div> --}}

                        <div class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-solid fa-square-virus me-2"></i>Patologías Generales</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('gestion.patologia-general.view') }}" class="dropdown-item">Gestión de PG</a>
                                <a href="{{ route('registrar.patologia-general.view') }}" class="dropdown-item">Registrar nueva PG</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-solid fa-viruses me-2"></i>Patologías Específicas</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('gestion.patologia-especifica.view') }}" class="dropdown-item">Gestión de PE</a>
                                <a href="{{ route('registrar.patologia-especifica.view') }}" class="dropdown-item">Registrar nueva PE</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-solid fa-hospital me-2"></i>Centros Asistenciales</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('gestion.centro-asistencial.view') }}" class="dropdown-item">Gestión de CA</a>
                                <a href="{{ route('registrar.centro-asistencial.view') }}" class="dropdown-item">Registrar nuevo CA</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-solid fa-stethoscope me-2"></i>Servicios</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('gestion.servicios.view') }}" class="dropdown-item">Gestión de Servicios</a>
                                <a href="{{ route('registrar.servicio.view') }}" class="dropdown-item">Registrar nuevo Servicio</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-light fa-users me-2"></i>Usuarios</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('gestion.usuarios.view') }}" class="dropdown-item">Gestión de Usuarios</a>
                                <a href="{{ route('registro.usuarios.view') }}" class="dropdown-item">Registrar nuevo usuario</a>
                            </div>
                        </div>

                    @endif

                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-solid fa-file-medical me-2"></i>Reposos</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('validar.cedula.reposo.view') }}" class="dropdown-item">Nuevo Reposo</a>
                            <a href="{{ route('validar.cedula.reposo.maternindad.view') }}" class="dropdown-item">Nuevo Reposo Maternidad</a>
                            <a href="{{ route('validar.cedula.prorroga.view') }}" class="dropdown-item">Nueva Prórroga</a>
                            {{-- <a href="{{ route('gestion.reposos.view') }}" class="dropdown-item">Gestión de Reposos</a> --}}
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-solid fa-list me-2"></i>Gestión</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('gestion.reposos.view') }}" class="dropdown-item">Reposos por Aprobar</a>
                            {{-- <a href="{{ route('validar.cedula.reposo.maternindad.view') }}" class="dropdown-item">Prórrogas por Aprobar</a> --}}
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-solid fa-address-book me-2"></i>Expedientes</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            @if (Auth::check() && Auth::user()->cod_cargo == 4)
                                <a href="{{ route('expediente.pacientes.view') }}" class="dropdown-item">Pacientes registrados</a>
                            @endif
                            <a href="{{ route('reposos.registrados.view') }}" class="dropdown-item">Reposos registrados</a>
                            <a href="{{ route('prorrogas.registradas.view') }}" class="dropdown-item">Prórrogas registradas</a>
                        </div>
                    </div>

                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{!! asset('app/button.html') !!}" class="dropdown-item">Buttons</a>
                            <a href="{!! asset('app/typography.html') !!}" class="dropdown-item">Typography</a>
                            <a href="{!! asset('app/element.html') !!}" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    <a href="{!! asset('app/widget.html') !!}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="{!! asset('app/form.html') !!}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="{!! asset('app/table.html') !!}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="{!! asset('app/chart.html') !!}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{!! asset('app/signin.html') !!}" class="dropdown-item">Sign In</a>
                            <a href="{!! asset('app/signup.html') !!}" class="dropdown-item">Sign Up</a>
                            <a href="{!! asset('app/404.html') !!}" class="dropdown-item">404 Error</a>
                            <a href="{!! asset('app/blank.html') !!}" class="dropdown-item">Blank Page</a>
                        </div>
                    </div> --}}
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->

        <div class="content">

            <!-- Navbar Start -->

            <nav class="navbar navbar-expand bg-secondary sticky-top px-4 py-0">
                <a href="{{url('/inicio')}}" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><img src="{!! asset('assets/logo.png') !!}" alt="Logo IVSS" height="40" width="40"></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificaciones</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div> --}}
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            @if (Auth::user()->foto)
                                <img class="rounded-circle me-lg-2" src="{{ Storage::url(Auth::user()->foto) }}" alt="Foto de perfil" style="width: 40px; height: 40px;">
                            @else
                                <img class="rounded-circle me-lg-2" src="{{ asset('app/img/no-pfp.jpeg') }}" alt="Foto de perfil predeterminada" style="width: 40px; height: 40px;">
                            @endif
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->nombres }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ route('configuracion.perfil.view', ['id' => Auth::id()]) }}" class="dropdown-item">Mi perfil</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Cerrar Sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <div class="container-fluid pt-4 px-4">

                <div class="row g-4">

                    <div class="col-sm-12 col-xl-12">

                        @include('layout.alerts.success-message')

                        @include('layout.alerts.reposos-success')

                        @include('layout.alerts.error-message')

                        @yield('content')

                    </div>

                </div>

            </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
              <div class="bg-secondary rounded-top p-4">
                <div class="row">
                  <div class="col-12 col-sm-6 text-center text-sm-start">
                      &copy; <a href="">Reposos | IVSS</a>
                  </div>
                  <div class="col-12 col-sm-6 text-center text-sm-end">
                      Por <a href="https://www.linkedin.com/in/william-villegas-ab3b94215/">William Villegas</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" style="display: none;"><i class="bi bi-arrow-up"></i></a>

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{!! asset('app/lib/chart/chart.min.js') !!}"></script>
    <script src="{!! asset('app/lib/easing/easing.min.js') !!}"></script>
    <script src="{!! asset('app/lib/waypoints/waypoints.min.js') !!}"></script>
    <script src="{!! asset('app/lib/owlcarousel/owl.carousel.min.js') !!}"></script>
    <script src="{!! asset('app/lib/tempusdominus/js/moment.min.js') !!}"></script>
    <script src="{!! asset('app/lib/tempusdominus/js/moment-timezone.min.js') !!}"></script>
    <script src="{!! asset('app/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') !!}"></script>

    <!-- Alerta Botón Eliminar -->
    <script src="{!! asset('assets/js/botonEliminar.js') !!}"></script>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Buscador Select -->
    <script src="{!! asset('assets/js/buscadorSelects.js') !!}"></script>

    <!-- formHandlerPatologia -->
    <script src="{{ asset('assets/js/formHandlerPatologia.js') }}"></script>

    <!-- formHandlerProrrogas -->
    <script src="{{ asset('assets/js/formHandlerProrrogas.js') }}"></script>

    <!-- Incluir el archivo JavaScript -->
    <script src="{!! asset('assets/js/backToTop.js') !!}"></script>

    <!-- Template Javascript -->
    <script src="{!! asset('app/js/main.js') !!}"></script>
</body>

</html>