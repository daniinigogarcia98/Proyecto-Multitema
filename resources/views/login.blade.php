<!doctype html>
<html lang="es" data-bs-theme="light">

<head>
    <title>ForoMultitema-InicioSesion</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <!-- Bootstrap CSS v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>


<body class="bg-body-secondary">

    <div class="container py-4 py-md-5">
        <div class="row justify-content-center">

            <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">

                <div class="card shadow-sm card-responsive">
                    <div class="card-body p-4 p-md-5">

                        <h2 class="text-center mb-4 form-title-responsive">
                            <i class="fas fa-user me-2"></i>Iniciar Sesión
                        </h2>

                        <form action="{{ route('loguear') }}" method="post">
                            {{-- si el usuario admin no funciona lo redirigimos a la ruta de login admin --}}
                            <?php
                            if (session('is_admin')) {
                                echo '<script>window.location.href = "' . route('loginAdmin') . '";</script>';
                            }
                            ?>
                            @csrf
                              @if (session('mensaje'))
                                {{-- mostrar mensaje de error --}}
                                    <div
                                        class="p-3 text-success-emphasis bg-danger-subtle border border-danger-subtle rounded-3">
                                        {{ session('mensaje') }}</div>
                                @endif
                                @if ($errors->any())
                                    @foreach ($errors->all() as $e)
                                        <div
                                            class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">
                                            {{ $e }}</div>
                                    @endforeach
                                @endif
                            <!-- Campo: Correo electrónico -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="example@dominio.com" required>
                                </div>
                            </div>

                            <!-- Campo: Contraseña -->
                            <div class="mb-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Contraseña" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">
                                <button class="btn btn-success w-100 w-sm-auto">
                                    <i class="fas fa-check-circle me-2"></i>Iniciar Sesión
                                </button>
                                <button class="btn btn-danger w-100 w-sm-auto">
                                   <a class="nav-link" href="{{ route('inicio') }}"><i class="fas fa-times-circle me-2"></i>Cancelar</a>
                                </button>
                            </div>

                            <!-- Enlace a registro -->
                            <div class="text-center">
                                <small class="text-muted">¿No tienes cuenta?</small><br>
                                <a href="{{ route('registro') }}" class="text-decoration-none fw-semibold">
                                    Regístrate aquí
                                </a>
                            </div>
                            <!-- Enlace a login admin -->
                            <div class="text-center">
                                <small class="text-muted">¿Eres administrador?</small><br>
                                <a href="{{ route('loginAdmin') }}" class="text-decoration-none fw-semibold">
                                    Inicia sesión como administrador
                                </a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <!-- Script opcional: Mostrar/Ocultar contraseña -->
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
