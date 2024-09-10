@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Menú Lateral -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky">
                <h4 class="text-center text-white mt-3 mb-4">Panel de Control</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="#">
                            <i class="bi bi-house-door-fill"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="bi bi-camera-video-fill"></i> Cámaras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="bi bi-bar-chart-fill"></i> Reportes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="bi bi-gear-fill"></i> Configuración
                        </a>
                    </li>
                    <li class="nav-item mt-4">
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
        <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Encabezado -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">SESESP</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </button>
                </div>
            </div>

            <!-- Sección de Estadísticas -->
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Cámaras Activas</h5>
                                    <p class="card-text display-4">12</p>
                                </div>
                                <div>
                                    <i class="bi bi-camera-video-fill display-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Reportes Pendientes</h5>
                                    <p class="card-text display-4">5</p>
                                </div>
                                <div>
                                    <i class="bi bi-exclamation-triangle-fill display-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Cámaras Inactivas</h5>
                                    <p class="card-text display-4">3</p>
                                </div>
                                <div>
                                    <i class="bi bi-camera-video-off-fill display-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mapa -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    Sistema de vigilancia
                </div>
                <div class="card-body p-0">
                    <div id="map" style="height: 500px;"></div>
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

                    // Datos de las cámaras (15 puntos en Tlaxcala)
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
        </main>
    </div>
</div>
@endsection