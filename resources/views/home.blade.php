@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Menú Lateral -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <h4 class="text-center mt-3 mb-4">Inicio</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-house-door"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-file-earmark-text"></i> Reportes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-gear"></i> Configuración
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido Principal -->
        <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Bienvenido, {{ Auth::user()->name }}!</h1>
            </div>

            <!-- Mapa -->
            <div id="map" style="height: 500px;"></div>

            <!-- Sección de Estadísticas -->
            <div class="row mt-4">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reportes</h5>
                            <p class="card-text">Aquí puedes agregar gráficos o estadísticas importantes.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                        </div>
                    </div>
                </div>

                <!-- Sección de Alertas -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Busqueda</h5>
                            <p class="card-text">Aquí puedes agregar un resumen de alertas o notificaciones.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                        </div>
                    </div>
                </div>

                <!-- Sección de Tareas Pendientes -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Agregar</h5>
                            <p class="card-text">Aquí puedes mostrar tareas pendientes o pendientes de revisión.</p>
                            <a href="#" class="btn btn-primary">Ver Más</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Script para Inicializar el Mapa -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializa el mapa
        var map = L.map('map').setView([19.3124, -98.2382], 13);

        // Añade la capa de mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Datos de las cámaras (puntos de ejemplo)

        var cameras = [
        
    { "lat": 19.317942, "lng": -98.238421, "name": "Cámara 1", "status": "Operativa", "report": "Sin reportes" },
    { "lat": 19.317058, "lng": -98.237364, "name": "Cámara 2", "status": "No operativa", "report": "Fallo de conexión" },
    { "lat": 19.316480, "lng": -98.238958, "name": "Cámara 3", "status": "Operativa", "report": "Sin reportes" },
    { "lat": 19.314607, "lng": -98.238834, "name": "Cámara 4", "status": "Operativa", "report": "Reporte de mantenimiento" },
    { "lat": 19.312321, "lng": -98.244209, "name": "Cámara 5", "status": "Operativa", "report": "Sin reportes" },
    { "lat": 19.315967, "lng": -98.246607, "name": "Cámara 6", "status": "No operativa", "report": "Fallo de conexión" },
    { "lat": 19.314972, "lng": -98.243705, "name": "Cámara 7", "status": "Operativa", "report": "Sin reportes" },
    { "lat": 19.319428, "lng": -98.241377, "name": "Cámara 8", "status": "Operativa", "report": "Reporte de mantenimiento" },
    { "lat": 19.323928, "lng": -98.231689, "name": "Cámara 9", "status": "Operativa", "report": "Sin reportes" },
    { "lat": 19.317684, "lng": -98.229092, "name": "Cámara 10", "status": "No operativa", "report": "Fallo de conexión" },
    { "lat": 19.303890, "lng": -98.240862, "name": "Cámara 11", "status": "Operativa", "report": "Sin reportes" },
    { "lat": 19.299363, "lng": -98.246242, "name": "Cámara 12", "status": "Operativa", "report": "Reporte de mantenimiento" },
    { "lat": 19.296125, "lng": -98.241291, "name": "Cámara 13", "status": "Operativa", "report": "Sin reportes" },
    { "lat": 19.29102,  "lng": -98.22945, "name": "Cámara 14", "status": "No operativa", "report": "Fallo de conexión" },
    { "lat": 19.311032, "lng": -98.236892, "name": "Cámara 15", "status": "Operativa", "report": "Reporte de mantenimiento" }

        ];

        // Añade los marcadores de las cámaras
        cameras.forEach(function(camera) {
            var marker = L.marker([camera.lat, camera.lng]).addTo(map);
            marker.bindPopup(`<b>${camera.name}</b><br>Status: ${camera.status}<br>Reporte: ${camera.report}`);
        });
    });
</script>
@endsection
