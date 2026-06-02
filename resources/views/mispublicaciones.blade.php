<!doctype html>
<html lang="es" data-bs-theme="light">

<head>
    <title>Mis Publicaciones - ForoMultitema</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-body-secondary overflow-x-hidden">

    <header>
        <nav class="navbar navbar-expand-lg bg-body-secondary" data-bs-theme="dark">
            <div class="container-fluid px-3 px-md-4">

                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <i class="fas fa-layer-group me-2"></i>ForoMultitema
                </a>

            </div>
        </nav>
    </header>

    <main class="container-fluid px-0">

        <div class="container px-3 px-md-4 px-lg-5 py-4 py-md-5">

            <h2 class="mb-4">
                <i class="fas fa-newspaper me-2"></i>
                Mis Publicaciones
            </h2>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 g-md-4">

                @forelse ($publicaciones as $publicacion)
                    <div class="col">

                        <div class="card h-100 shadow-sm">

                            <div class="card-body d-flex flex-column text-center p-4">

                                <!-- ICONO -->
                                <div class="mb-3">
                                    <i class="fas fa-file-alt" style="font-size: 3.5rem;"></i>
                                </div>

                                <!-- TÍTULO -->
                                <h5 class="card-title mb-2">
                                    {{ $publicacion->titulo }}
                                </h5>

                                <!-- CATEGORÍA -->
                                <small class="text-muted mb-3">
                                    {{ $publicacion->categoria->nombre }}
                                </small>

                                <!-- TEXTO -->
                                <p class="card-text small flex-grow-1">
                                    {{ Str::limit($publicacion->contenido, 120) }}
                                </p>

                                <!-- BOTONES -->
                                <div class="mt-3 d-grid gap-2">

                                    <a href="{{ route('verPublicacion', $publicacion->id) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        Ver
                                    </a>
                                    <form action="{{ route('editarPublicacion', $publicacion->id) }}" method="POST"
                                        onsubmit="return confirm('¿Deseas editar la publicación?')">

                                        @csrf
                                        @method('PUT')

                                        <button class="btn btn-outline-warning btn-sm">
                                            Editar
                                        </button>

                                    </form>


                                    <form action="{{ route('eliminarPublicacion', $publicacion->id) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar esta publicación?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-outline-danger btn-sm w-100">
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No tienes publicaciones todavía.
                        </div>
                    </div>
                @endforelse

            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
