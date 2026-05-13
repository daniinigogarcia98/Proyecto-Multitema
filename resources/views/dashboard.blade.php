<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>ForoMultitema-Panel-De-Administración</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <!-- Bootstrap CSS v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
</head>
<style>
    .avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #4f46e5;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 22px;
    }
</style>

<body class="bg-body-secondary overflow-hidden">
    <header>
        <nav class="navbar navbar-expand-lg bg-body-secondary" data-bs-theme="dark">
            <div class="container-fluid container-lg container-md container-sm">
                <a class="navbar-brand" href="#"> <i class="fas fa-layer-group me-2"></i>ForoMultitema</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center gap-3 w-100">
                            <!-- Grupo de Botones de Administración (Izquierda/Centro) -->
                            <div class="d-flex gap-3 flex-wrap">
                                @auth
                                    @if (Auth::user()->rol === 'A')
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-users-cog"></i> Administrar Usuarios
                                        </button>
                                    @endif
                                @endauth

                                <!-- TODOS -->
                                <button class="btn btn-success btn-sm">
                                    <i class="fas fa-newspaper"></i> Administrar Publicaciones
                                </button>

                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-envelope-open-text"></i> Bandeja de Mensajes
                                </button>
                            </div>

                            <!-- Perfil y Cerrar Sesión (Derecha) -->
                            <div class="ms-auto d-flex align-items-center gap-3">
                                <form action="{{ route('cerrar') }}" method="post">
                                    @csrf
                                    <button class="btn btn-link nav-link text-danger">
                                        <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                                    </button>
                                </form>
                                <div class="admin-profile d-flex align-items-center gap-2">
                                    <span class="fw-bold text-white d-inline-block text-truncate"
                                        style="max-width: 150px;">
                                        {{ Auth::user()?->nombre }}
                                    </span>
                                    <!-- Avatar Placeholder -->
                                    <div class="avatar">
                                        {{ strtoupper(substr(trim(Auth::user()->nombre), 0, 2)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5 pe-5 p-5 justify-content-center">
            <div class="col">
                <div class="card p-5 text-center h-100">
                    <div class="card-img">
                        <i class="fas fa-laptop-code" style="font-size: 4.5rem; margin-bottom: 20px;"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Informática</h5>
                        <p class="card-text">
                            Espacio dedicado a soporte técnico especializado. Aquí podrás aportar tu granito de arena,
                            buscar soluciones a problemas de código, configuraciones de sistemas operativos o contactar
                            con otros usuarios para resolver incidencias técnicas.
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <button class="btn btn-outline-primary btn-sm">Gestionar Categoría</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card p-5 text-center h-100">
                    <div class="card-img">
                        <i class="fas fa-tools" style="font-size: 4.5rem; margin-bottom: 20px;"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Temas Varios</h3>
                        <p class="card-text">
                            Soluciones prácticas para la vida cotidiana. Desde cómo cambiar una bombilla hasta
                            tutoriales específicos como el cambio del sensor de aparcamiento de un BMW. Un lugar para
                            compartir conocimientos generales y bricolaje.
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <button class="btn btn-outline-success btn-sm">Gestionar Categoría</button>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </main>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
