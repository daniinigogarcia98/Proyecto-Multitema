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
        <nav class="navbar navbar-expand-lg bg-body-secondary" data-bs-theme="dark">
            <div class="container-fluid px-3 px-md-4">
                <a class="navbar-brand" href="{{ route('categoriaver', $publicacion->categoria_id) }}">
                    <i class="fas fa-layer-group me-2"></i>ForoMultitema
                </a>
            </div>
            <div
                class="ms-lg-auto d-flex align-items-center gap-2 gap-lg-3 justify-content-center justify-content-lg-end">
                <div class="ms-auto d-flex align-items-center gap-3">
                    @auth
                        <form action="{{ route('cerrar') }}" method="post">
                            @csrf
                            <button class="btn btn-link nav-link text-danger">
                                <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                            </button>
                        </form>
                        <div class="user-profile d-flex align-items-center gap-2">
                            <span class="fw-bold text-white d-inline-block text-truncate" style="max-width: 150px;">
                                {{ Auth::user()?->nombre }}
                            </span>
                            <!-- Avatar Placeholder -->

                            <div class="avatar">
                                {{ strtoupper(substr(trim(Auth::user()->nombre), 0, 2)) }}
                            </div>
                        @endauth
                    </div>
                </div>
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

                    <div class="list-group-item p-3">
                        <div class="d-flex justify-content-between">
                            <strong>Ana</strong>
                            <small class="text-muted">Hace 1 día</small>
                        </div>
                        <p class="mb-0">
                            Ejemplo de comentario (luego lo conectamos a BD).
                        </p>
                    </div>

                    <div class="list-group-item p-3">
                        <div class="d-flex justify-content-between">
                            <strong>Carlos</strong>
                            <small class="text-muted">Hace 5 horas</small>
                        </div>
                        <p class="mb-0">
                            Otro comentario de ejemplo.
                        </p>
                    </div>

                </div>

                <!-- FORM RESPUESTA (SIN FUNCIONALIDAD AÚN) -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">Responder</h6>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="Escribe tu respuesta..." required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Enviar Respuesta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
