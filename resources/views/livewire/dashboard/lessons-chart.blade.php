<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Statistiques des Leçons</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Par Type -->
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-4">Par Type</h3>
            <div class="h-64">
                <canvas id="lessonsByTypeChart"></canvas>
            </div>
        </div>

        <!-- Par Statut -->
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-4">Par Statut</h3>
            <div class="h-64">
                <canvas id="lessonsByStatusChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('livewire:load', function () {
    // Graphique par type
    const typeCtx = document.getElementById('lessonsByTypeChart').getContext('2d');
    const typeChart = new Chart(typeCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(collect($lessonsByType)->pluck('type')) !!},
            datasets: [{
                data: {!! json_encode(collect($lessonsByType)->pluck('count')) !!},
                backgroundColor: [
                    'rgb(59, 130, 246)',
                    'rgb(16, 185, 129)',
                    'rgb(245, 158, 11)',
                    'rgb(139, 92, 246)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Graphique par statut
    const statusCtx = document.getElementById('lessonsByStatusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(collect($lessonsByStatus)->pluck('status')) !!},
            datasets: [{
                data: {!! json_encode(collect($lessonsByStatus)->pluck('count')) !!},
                backgroundColor: [
                    'rgb(16, 185, 129)',
                    'rgb(239, 68, 68)',
                    'rgb(59, 130, 246)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    Livewire.on('lessonsDataUpdated', data => {
        // Mise à jour du graphique par type
        typeChart.data.labels = data.types.labels;
        typeChart.data.datasets[0].data = data.types.data;
        typeChart.update();

        // Mise à jour du graphique par statut
        statusChart.data.labels = data.statuses.labels;
        statusChart.data.datasets[0].data = data.statuses.data;
        statusChart.update();
    });
});
</script>
@endpush 