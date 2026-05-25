<!doctype html>
<html lang="es" data-bs-theme="light">

<head>
    <title>{{ $publicacion->titulo }} - ForoMultitema</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
</head>

<body class="bg-body-secondary overflow-x-hidden">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

            <div class="container-fluid px-3 px-md-4">

                <!-- Logo -->
                <a class="navbar-brand fw-bold" href="{{ route('categoriaver', $publicacion->categoria_id) }}">

                    <i class="fas fa-layer-group me-2"></i>
                    ForoMultitema

                </a>

                @auth

                    <div class="ms-auto d-flex align-items-center gap-3">

                        <!-- Volver -->
                        <a href="{{ route('categoriaver', $publicacion->categoria_id) }}"
                            class="btn btn-outline-light btn-sm">

                            Volver a la categoría

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

            </div>

        </nav>
    </header>

    <main class="container py-4">

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <!-- PUBLICACIÓN -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">

                        <h2 class="card-title mb-2">
                            {{ $publicacion->titulo }}
                        </h2>

                        <div class="d-flex flex-wrap gap-2 text-muted small mb-3">
                            <span>
                                Por:
                                <strong>
                                    {{ $publicacion->usuario->nombre ?? 'Anónimo' }}
                                </strong>
                            </span>

                            <span>
                                {{ $publicacion->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <div class="card-text lead">
                            {!! nl2br(e($publicacion->contenido)) !!}
                        </div>

                    </div>
                </div>

                <!-- COMENTARIOS (ESTÁTICO POR AHORA) -->
                <h5 class="mb-3">Comentarios</h5>

                <div class="list-group mb-4 shadow-sm">

                    @forelse($publicacion->comentarios as $c)
                        <div class="list-group-item p-3">

                            <div class="d-flex justify-content-between">

                                <strong>
                                    {{ $c->usuario->nombre ?? 'Anónimo' }}
                                </strong>

                                <small class="text-muted">
                                    {{ $c->created_at->diffForHumans() }}
                                </small>

                            </div>

                            <p class="mb-0 mt-2">
                                {{ $c->contenido }}
                            </p>

                        </div>

                    @empty

                        <div class="list-group-item text-muted text-center p-3">
                            No hay comentarios todavía.
                        </div>
                    @endforelse

                </div>

                <!-- FORMULARIO DE COMENTARIO -->
                <form action="{{ route('guardarcomentario', $publicacion->id) }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <textarea name="contenido" class="form-control" rows="3" placeholder="Escribe tu respuesta..." required></textarea>

                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Enviar Respuesta
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
