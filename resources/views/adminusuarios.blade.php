<!doctype html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrar Usuarios</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <!-- Estilos personalizados -->
    <!-- El archivo admin.css contiene estilos personalizados para el panel de administración
    permite mostrar un avatar del usuario  en este caso-->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark shadow">

        <div class="container-fluid">

            <span class="navbar-brand">

                <i class="fas fa-users-cog me-2"></i>

                Administración de Usuarios

            </span>

            <!-- Perfil y Cerrar Sesión (Derecha) -->
            <div
                class="ms-lg-auto d-flex align-items-center gap-2 gap-lg-3 justify-content-center justify-content-lg-end">
                <div class="ms-auto d-flex align-items-center gap-3">
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
                        <!-- El avatar se muestra con las iniciales del usuario, obtenidas de su nombre -->
                        <div class="avatar">
                            {{ strtoupper(substr(trim(Auth::user()->nombre), 0, 2)) }}
                        </div>
                        {{-- botón volver --}}
                        <a href="{{ route('admin') }}" class="btn btn-outline-light">

                            Volver al Panel Principal

                        </a>
                    </div>
                </div>
            </div>
        </div>

    </nav>

    <div class="container py-5">

        {{-- alertas de éxito --}}
        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif
        {{-- alertas de error --}}
        @if (session('error'))
            <div class="alert alert-danger">

                {{ session('error') }}

            </div>
        @endif

        <div class="card shadow border-0">

            <div class="card-header bg-primary text-white">

                <h4 class="mb-0">
                    <i class="fas fa-users me-2"></i>
                    Lista de Usuarios

                </h4>

            </div>

            <div class="card-body table-responsive">
                {{-- Lista de usuarios --}}
                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>
                        {{-- Lista de usuarios --}}
                        {{-- se recorren los usuarios y se muestran en la tabla --}}
                        {{-- se recorren con un foreach  --}}
                        @foreach ($us as $u)
                            <tr>

                                <td>

                                    {{ $u->id }}

                                </td>

                                <td>

                                    {{ $u->nombre }}

                                </td>

                                <td>

                                    {{ $u->email }}

                                </td>

                                <td>
                                    {{-- Rol del usuario --}}
                                    @if ($u->rol == 'A')
                                        <span class="badge bg-danger">

                                            Administrador

                                        </span>
                                    @else
                                        {{-- Rol de usuario normal --}}
                                        <span class="badge bg-primary">

                                            Usuario

                                        </span>
                                    @endif

                                </td>

                                <td class="d-flex gap-2">

                                    {{-- BOTON EDITAR --}}
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editarModal{{ $u->id }}">

                                        <i class="fas fa-edit"></i>
                                        Editar
                                    </button>

                                    {{-- BOTON ELIMINAR --}}
                                    {{-- no se puede eliminar el administrador principal --}}
                                    {{-- pero si podemos eliminar otros usuarios --}}
                                    @if ($u->id != 1)
                                        <form action="{{ route('eliminarUsuario', $u->id) }}" method="POST">
                                            {{-- para eliminar un usuario necesitamos el ID del usuario --}}
                                            @csrf
                                            {{-- devido a que es un formulario de eliminación --}}
                                            {{-- laravel no puede el borrado como post necesitamos usar el metodo DELETE --}}
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">

                                                <i class="fas fa-trash"></i>
                                                Borrar
                                            </button>

                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>

                                            <i class="fas fa-lock"></i>
                                            No se puede eliminar usuario protegido
                                        </button>
                                    @endif

                                </td>

                            </tr>

                            {{-- MODAL EDITAR --}}
                            {{-- Aqui podemos editar los datos del usuario a traves de un formulario modal --}}
                            {{-- en el AdminController en la funcion actualizarUsuario se ha puesto una restriccion
                            al administrador principal para que no pueda cambiar su propio rol a usuario normal  --}}

                            <div class="modal fade" id="editarModal{{ $u->id }}" tabindex="-1">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header bg-warning">

                                            <h5 class="modal-title">

                                                Editar Usuario

                                            </h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal">

                                            </button>

                                        </div>

                                        <form action="{{ route('actualizarUsuario', $u->id) }}" method="POST">
                                            {{-- para cambiar la contraseña o el nombre necesitamos el ID del usuario --}}
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">

                                                {{-- NOMBRE --}}
                                                <div class="mb-3">

                                                    <label class="form-label">

                                                        Nombre

                                                    </label>

                                                    <input type="text" name="nombre" class="form-control"
                                                        {{-- obtenemos el nombre del usuario de la base de datos --}} value="{{ $u->nombre }}" required>

                                                </div>

                                                {{-- EMAIL --}}
                                                <div class="mb-3">

                                                    <label class="form-label">

                                                        Email

                                                    </label>

                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $u->email }}" required>

                                                </div>

                                                {{-- PASSWORD --}}
                                                <div class="mb-3">

                                                    <label class="form-label">

                                                        Nueva Contraseña

                                                    </label>

                                                    <input type="password" name="password" class="form-control">

                                                    <small class="text-muted">

                                                        Déjalo vacío para mantener la contraseña actual

                                                    </small>

                                                </div>

                                                {{-- ROL --}}
                                                <div class="mb-3">

                                                    <label class="form-label">

                                                        Rol

                                                    </label>

                                                    <select name="rol" class="form-select">

                                                        <option value="U" {{ $u->rol == 'U' ? 'selected' : '' }}>

                                                            Usuario

                                                        </option>

                                                        <option value="A" {{ $u->rol == 'A' ? 'selected' : '' }}>

                                                            Administrador

                                                        </option>

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">

                                                    Cancelar

                                                </button>

                                                <button class="btn btn-success">

                                                    Guardar Cambios

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
