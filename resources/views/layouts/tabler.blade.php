<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <script src="{{ asset('dist/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>

    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/inter.css') }}" rel="stylesheet" />

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>
    
    <style>
        
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .form-control:focus {
            box-shadow: none;
        }
    </style>

    {{-- - Page Styles - --}}
    @stack('page-styles')
    @livewireStyles
</head>

<body>
    <script src="{{ asset('dist/js/jquery-3.7.1.min.js') }}" defer></script>

    <div class="page">
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('static/logo.png') }}" width="110" height="32" alt="Top Flowe"
                            class="navbar-brand-image">
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="d-none d-md-flex">
                        <div class="nav-item dropdown d-none d-md-flex me-3">
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Open user menu">
                            <span class="avatar avatar-sm shadow-none"
                                style="background-image: url({{ Auth::user()->photo ? asset('storage/profile/' . Auth::user()->photo) : asset('assets/img/illustrations/profiles/admin.jpg') }})">
                            </span>

                            <div class="d-none d-xl-block ps-2">
                                <div>{{ Auth::user()->name }}</div>
                                {{--                                    <div class="mt-1 small text-muted">UI Designer</div> --}}
                            </div>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon dropdown-item-icon icon-tabler icon-tabler-settings" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                    </path>
                                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                </svg>
                                Cuenta
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon dropdown-item-icon icon-tabler icon-tabler-logout" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                        <path d="M9 12h12l-3 -3" />
                                        <path d="M18 15l3 -3" />
                                    </svg>
                                    Salir
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <header class="navbar-expand-md">
          <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
              <div class="container-xl">
                <ul class="navbar-nav">
                  <li class="nav-item {{ request()->is('dashboard*') ? 'active' : null }}">
                      <a class="nav-link" href="{{ route('dashboard') }}">
                          <span
                              class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                  height="24" viewBox="0 0 24 24" stroke-width="2"
                                  stroke="currentColor" fill="none" stroke-linecap="round"
                                  stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                  <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                  <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                              </svg>
                          </span>
                          <span class="nav-link-title">
                              {{ __('Dashboard') }}
                          </span>
                      </a>
                  </li>

                  <li class="nav-item {{ request()->is('products*') ? 'active' : null }}">
                      <a class="nav-link" href="{{ route('products.index') }}">
                          <span
                              class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                              <svg xmlns="http://www.w3.org/2000/svg"
                                  class="icon icon-tabler icon-tabler-packages" width="24"
                                  height="24" viewBox="0 0 24 24" stroke-width="2"
                                  stroke="currentColor" fill="none" stroke-linecap="round"
                                  stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                  <path d="M2 13.5v5.5l5 3" />
                                  <path d="M7 16.545l5 -3.03" />
                                  <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                  <path d="M12 19l5 3" />
                                  <path d="M17 16.5l5 -3" />
                                  <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                  <path d="M7 5.03v5.455" />
                                  <path d="M12 8l5 -3" />
                              </svg>
                          </span>
                          <span class="nav-link-title">
                              {{ __('Ramos') }}
                          </span>
                      </a>
                  </li>
                @if(Gate::allows('isAdmin')) 
                  <li
                      class="nav-item dropdown {{ request()->is('suppliers*', 'customers*') ? 'active' : null }}">
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <svg xmlns="http://www.w3.org/2000/svg"
                                  class="icon icon-tabler icon-tabler-layers-subtract" width="24"
                                  height="24" viewBox="0 0 24 24" stroke-width="2"
                                  stroke="currentColor" fill="none" stroke-linecap="round"
                                  stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path
                                      d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                  <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2" />
                              </svg>
                          </span>
                          <span class="nav-link-title">
                              {{ __('Remision') }}
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns">
                              <div class="dropdown-menu-column">
                                  <a class="dropdown-item" href="{{ route('remisiones.index') }}">
                                      {{ __('Crear') }}
                                  </a>
                                  <a class="dropdown-item" href="{{ route('saldosRemisiones.index') }}">
                                      {{ __('Saldos') }}
                                  </a>
                              </div>
                          </div>
                      </div>
                  </li>
                @endif
                @if(Gate::allows('isAdmin')) 
                  <li
                      class="nav-item dropdown {{ request()->is('suppliers*', 'customers*') ? 'active' : null }}">
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <svg xmlns="http://www.w3.org/2000/svg"
                                  class="icon icon-tabler icon-tabler-layers-subtract" width="24"
                                  height="24" viewBox="0 0 24 24" stroke-width="2"
                                  stroke="currentColor" fill="none" stroke-linecap="round"
                                  stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path
                                      d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                  <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2" />
                              </svg>
                          </span>
                          <span class="nav-link-title">
                              {{ __('Informes') }}
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns">
                              <div class="dropdown-menu-column">
                                  <a class="dropdown-item" href="{{ route('informeProduccion') }}">
                                      {{ __('Producción de Ramos') }}
                                  </a>
                              </div>
                          </div>
                      </div>
                  </li>
                @endif

                @if(Gate::allows('isAdmin')) 
                  <li
                      class="nav-item dropdown {{ request()->is('suppliers*', 'customers*') ? 'active' : null }}">
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <svg xmlns="http://www.w3.org/2000/svg"
                                  class="icon icon-tabler icon-tabler-layers-subtract" width="24"
                                  height="24" viewBox="0 0 24 24" stroke-width="2"
                                  stroke="currentColor" fill="none" stroke-linecap="round"
                                  stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path
                                      d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                  <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2" />
                              </svg>
                          </span>
                          <span class="nav-link-title">
                              {{ __('Otros') }}
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns">
                              <div class="dropdown-menu-column">
                                  <a class="dropdown-item" href="{{ route('suppliers.index') }}">
                                      {{ __('Proveedores') }}
                                  </a>
                                  <a class="dropdown-item" href="{{ route('customers.index') }}">
                                      {{ __('Clientes') }}
                                  </a>
                              </div>
                          </div>
                      </div>
                  </li>
                @endif

                @if(Gate::allows('isAdmin')) 
                  <li
                      class="nav-item dropdown {{ request()->is('users*', 'categories*', 'units*') ? 'active' : null }}">
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <svg xmlns="http://www.w3.org/2000/svg"
                                  class="icon icon-tabler icon-tabler-settings" width="24"
                                  height="24" viewBox="0 0 24 24" stroke-width="2"
                                  stroke="currentColor" fill="none" stroke-linecap="round"
                                  stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path
                                      d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                  <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                              </svg>
                          </span>
                          <span class="nav-link-title">
                              {{ __('Configuraciones') }}
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns">
                              <div class="dropdown-menu-column">
                                  <a class="dropdown-item" href="{{ route('categories.index') }}">
                                      {{ __('Tipo de Empaque') }}
                                  </a>
                                  <a class="dropdown-item" href="{{ route('lands.index') }}">
                                      {{ __('Fincas') }}
                                  </a>
                                  <a class="dropdown-item" href="{{ route('tables.index') }}">
                                      {{ __('Mesas') }}
                                  </a>
                                  <a class="dropdown-item" href="{{ route('grades.index') }}">
                                      {{ __('Grados') }}
                                  </a>
                                  <a class="dropdown-item" href="{{ route('varieties.index') }}">
                                      {{ __('Variedades') }}
                                  </a>
                                  <a class="dropdown-item" href="{{ route('typeBranches.index') }}">
                                      {{ __('Tipo de Ramo') }}
                                  </a>
                              </div>
                          </div>
                      </div>
                  </li>
                @endif

                @if(Gate::allows('isAdmin')) 
                  <li
                      class="nav-item dropdown {{ request()->is('suppliers*', 'customers*') ? 'active' : null }}">
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <svg xmlns="http://www.w3.org/2000/svg"
                                  class="icon icon-tabler icon-tabler-layers-subtract" width="24"
                                  height="24" viewBox="0 0 24 24" stroke-width="2"
                                  stroke="currentColor" fill="none" stroke-linecap="round"
                                  stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path
                                      d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                  <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2" />
                              </svg>
                          </span>
                          <span class="nav-link-title">
                              {{ __('Seguridad') }}
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns">
                              <div class="dropdown-menu-column">
                                  <a class="dropdown-item" href="{{ route('users.index') }}">
                                          {{ __('Usuarios') }}
                                  </a> 
                              </div>
                          </div>
                      </div>
                  </li>
                @endif
                </ul>

                  
              </div>
            </div>
          </div>
        </header>

        <div class="page-wrapper">
            <div>
                @yield('content')
            </div>

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                     {{ now()->year }}
                                    <a href="." class="link-secondary">by Top Software</a>.
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary" rel="noopener">
                                        v1.0.0
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Libs JS -->
    @stack('page-libraries')
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
    {{-- - Page Scripts - --}}
    @stack('page-scripts')
    @livewireScripts
</body>

</html>
