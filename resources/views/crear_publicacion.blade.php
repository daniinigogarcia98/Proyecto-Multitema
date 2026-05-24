<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <title>ForoMultitema - Crear Publicaciones</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-body-secondary overflow-x-hidden">

<header>
<nav class="navbar navbar-expand-lg bg-body-secondary" data-bs-theme="dark">
    <div class="container-fluid px-2 px-md-4">
        <a class="navbar-brand" href="#">
            <i class="fas fa-layer-group me-2"></i>ForoMultitema
        </a>
    </div>
</nav>
</header>

<main class="container mt-4 mb-5">

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card shadow-sm">

                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        Nueva Publicación en: {{ $categoria->nombre }}
                    </h5>
                </div>

                <div class="card-body">

                    {{-- FORMULARIO --}}
                    <form action="{{ route('crearPublicacion', $categoria->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Título</label>
                            <input type="text"
                                   name="titulo"
                                   class="form-control"
                                   placeholder="Ej: Problema con..."
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Categoría</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $categoria->nombre }}"
                                   disabled>
                            <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Contenido</label>
                            <textarea class="form-control"
                                      name="contenido"
                                      rows="5"
                                      placeholder="Describe tu duda o aporte..."
                                      required></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('categoriaver', $categoria->id) }}"
                               class="btn btn-outline-secondary me-md-2">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                Publicar
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
