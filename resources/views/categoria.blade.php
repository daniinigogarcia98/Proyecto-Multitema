<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>ForoMultitema - {{ $categoria->nombre }}</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
</head>

<body class="bg-body-secondary overflow-x-hidden">

    <header>
        <nav class="navbar navbar-expand-lg bg-body-secondary" data-bs-theme="dark">
            <div class="container-fluid px-3 px-md-4">

                <!-- Logo -->
                <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">

                    <i class="fas fa-layer-group me-2"></i>
                    ForoMultitema

                </a>

                @auth

                    <div class="ms-auto d-flex align-items-center gap-3">

                        <!-- Volver -->
                        <a href="{{ route('dashboard') }}"
                            class="btn btn-outline-light btn-sm">

                            Volver a la página principal

                        </a>

                        <!-- Usuario -->
                        <div class="d-flex align-items-center gap-2">

                            <span class="fw-bold text-white">
                                {{ Auth::user()->nombre }}
                            </span>

                            <!-- Avatar -->
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                                style="width:38px;height:38px;">

                                {{ strtoupper(substr(Auth::user()->nombre, 0, 2)) }}

                            </div>

                        </div>

                        <!-- Logout -->
                        <form action="{{ route('cerrar') }}" method="POST">

                            @csrf

                            <button class="btn btn-outline-danger btn-sm">

                                <i class="fas fa-sign-out-alt me-1"></i>
                                Cerrar sesión

                            </button>

                        </form>

                    </div>

                @endauth

            </div> <!-- ===================== -->
            <!-- INVITADO -->
            <!-- ===================== -->
            @guest

                <ul class="navbar-nav align-items-center gap-3">

                    <li class="nav-item">
                        <a class="btn btn-outline-light px-4" href="{{ route('login') }}">
                            Iniciar Sesión
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-success" href="{{ route('registro') }}">
                            Registrarse
                        </a>
                    </li>

                </ul>

            @endguest

            </div>
            </div>
        </nav>
    </header>

    <main class="container-fluid px-0">

        <div class="container px-3 px-md-4 px-lg-5 py-4 py-md-5">

            <!-- HEADER -->
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mb-3 gap-2">

                <h2 class="mb-0">
                    <i class="fas fa-laptop-code me-2"></i>
                    {{ $categoria->nombre }}
                </h2>
                <a href="{{ route('formularioCrearPublicacion', $categoria->id) }}" class="btn btn-success px-4">
                    Nueva Publicación
                </a>


            </div>

            <!-- LISTA -->
            <div class="list-group shadow-sm">

                @forelse ($publicaciones as $publicacion)
                    <a href="{{ route('verPublicacion', $publicacion->id) }}"
                        class="list-group-item list-group-item-action">

                        <div class="d-flex w-100 justify-content-between flex-wrap gap-1">

                            <h5 class="mb-1 text-break">
                                {{ $publicacion->titulo }}
                            </h5>

                            <small class="text-muted text-nowrap">
                                {{ $publicacion->created_at->diffForHumans() }}
                            </small>

                        </div>

                        <p class="mb-1 text-break small">
                            {{ Str::limit($publicacion->contenido, 120) }}
                        </p>

                        <small class="text-primary fw-semibold">

                            Por: {{ $publicacion->usuario->nombre ?? 'Anónimo' }}

                        </small>

                    </a>

                @empty

                    <div class="alert alert-info">
                        No hay publicaciones en esta categoría.
                    </div>
                @endforelse

            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
