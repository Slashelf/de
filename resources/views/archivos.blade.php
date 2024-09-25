@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <!-- Contenido principal -->
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-light">
                <div class="card-header bg-primary text-white">
                    {{ __('Lista de Documentos') }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="mb-4">Documentos Registrados</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Autor</th>
                                <th>Facultad</th>
                                <th>Carrera</th>
                                <th>Tipo</th>
                                <th>Archivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                            <tr>
                                <td>{{ $document->autor }}</td>
                                <td>{{ $document->facultad }}</td>
                                <td>{{ $document->carrera }}</td>
                                <td>{{ $document->tipo }}</td>
                                <td>
                                    @php
                                        $fileUrl = asset('storage/' . $document->archivo);
                                    @endphp
                                    <a href="{{ $fileUrl }}" target="_blank" class="text-primary">
                                        {{ basename($document->archivo) }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        Subir Documento
                    </button>

                    <div id="message"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="uploadModalLabel">Subir Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadForm" action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Autor</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="facultad" class="form-label">Facultad</label>
                        <select id="facultad" name="facultad_id" class="form-select" required>
                            <option value="">Seleccione una facultad</option>
                            @foreach ($facultades as $facultad)
                                <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="carrera" class="form-label">Carrera</label>
                        <select id="carrera" name="carrera_id" class="form-select" required>
                            <option value="">Seleccione una carrera</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="program" class="form-label">Programa</label>
                        <input type="text" class="form-control" id="program" name="program" required>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Año</label>
                        <input type="text" class="form-control" id="year" name="year" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipo" name="tipo_id" class="form-select" required>
                            <option value="">Seleccione un tipo</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="document" class="form-label">Documento</label>
                        <input type="file" class="form-control" id="document" name="document" required>
                        <p id="fileName" class="mt-2"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Mostrar el nombre del archivo seleccionado
    $('#document').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $('#fileName').text('Nombre del archivo: ' + fileName);
    });

    // Manejar el envío del formulario
    $('#uploadForm').on('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#message').html('<div class="alert alert-success">Documento cargado con éxito.</div>');
                $('#uploadForm')[0].reset();
                $('#fileName').text('');
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '<div class="alert alert-danger"><ul>';
                $.each(errors, function(key, value) {
                    errorMessage += '<li>' + value[0] + '</li>';
                });
                errorMessage += '</ul></div>';
                $('#message').html(errorMessage);
            }
        });
    });
});
</script>
@endpush

<style>
    .card-header {
        background-color: #007bff; /* Azul más intenso */
    }

    .card {
        border: 1px solid #e0e0e0; /* Borde gris claro */
        border-radius: 0.5rem; /* Bordes redondeados */
        transition: transform 0.2s; /* Efecto de hover */
    }

    .card:hover {
        transform: scale(1.02); /* Aumentar tamaño al pasar el ratón */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra más pronunciada */
    }

    .btn-primary {
        background-color: #0056b3; /* Azul más oscuro */
        border: none;
    }

    .btn-primary:hover {
        background-color: #004494; /* Color más oscuro al pasar el ratón */
    }

    .table th {
        background-color: #f8f9fa; /* Fondo gris claro para encabezados */
        color: #495057; /* Color de texto más oscuro */
    }

    .modal-header {
        background-color: #007bff; /* Azul intenso */
        color: white;
    }

    #uploadModal .modal-body {
        padding: 2rem; /* Espaciado en el modal */
    }

    #message {
        margin-top: 1rem; /* Espaciado superior */
    }

    /* Ajustes para responsividad */
    @media (max-width: 768px) {
        .modal-dialog {
            max-width: 90%; /* Ancho del modal en móviles */
        }
    }
</style>

@endsection
