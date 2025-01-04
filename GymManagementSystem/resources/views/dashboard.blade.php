@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Dashboard</h1>

        <div class="row mt-5">
            <h1>Plans chart</h1>
            <div class="col-lg-4">
                <!-- Aquí agregamos el gráfico -->
                <canvas id="membershipChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Espera a que el DOM se haya cargado completamente antes de ejecutar el script
        document.addEventListener("DOMContentLoaded", function() {
            // Asegúrate de que el elemento canvas exista antes de intentar acceder a él
            var ctx = document.getElementById('membershipChart').getContext('2d');

            // Crear el gráfico
            var membershipChart = new Chart(ctx, {
                type: 'doughnut', // Tipo de gráfico
                data: {
                    labels: ['Basic', 'Premium', 'VIP'],
                    datasets: [{
                        label: 'Membership Types',
                        data: [{{ $basicMembers }}, {{ $premiumMembers }}, {{ $vipMembers }}], // Los valores
                        backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56'], // Colores
                        borderColor: ['#ff6384', '#36a2eb', '#ffcd56'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw + ' members';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
