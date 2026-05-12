<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <title>Inicio de Sesión</title>
</head>

<body class="bg-body-secondary">

    <div class="container py-5">
        <div class="row justify-content-center">

            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">

                <div class="card shadow-sm">
                    <div class="card-body p-4">

                        <h2 class="text-center mb-4">
                            <i class="fas fa-user me-2"></i>Iniciar Sesión
                        </h2>
                        <div class="row">
                            <div class="col">
                                @if (session('mensaje'))
                                    <div
                                        class="p-3 text-success-emphasis bg-success-subtle border border-success-subtle rounded-3">
                                        {{ session('mensaje') }}</div>
                                @endif
                                @if ($errors->any())
                                    @foreach ($errors->all() as $e)
                                        <div
                                            class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">
                                            {{ $e }}</div>
                                    @endforeach
                                @endif
                            </div>
                            <form action="{{ route('loguear') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" placeholder="tu@email.com"
                                            name="email" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" placeholder="Contraseña"
                                            name="password" required>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                    <button class="btn btn-success w-100 w-sm-auto">
                                        <i class="fas fa-check-circle me-2"></i>Iniciar Sesión
                                    </button>
                                    <button class="btn btn-danger w-100 w-sm-auto">
                                        <a href="{{ route('inicio') }}" class="btn btn-danger w-100 w-sm-auto">
                                            <i class="fas fa-times-circle me-2"></i>Cancelar
                                        </a>
                                    </button>

                                </div>
                                <div class="text-center mb-4 mt-4">
                                    <a href="{{ route('registro') }}">¿No tienes Cuenta? Registrate</a>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </div>

</body>

</html>

</div>
<!-- Bootstrap JavaScript Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
</body>

</html>
