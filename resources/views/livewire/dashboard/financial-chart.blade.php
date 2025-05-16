<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Aperçu Financier</h2>
    <div class="h-64">
        <canvas id="financialChart"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('livewire:load', function () {
    const ctx = document.getElementById('financialChart').getContext('2d');
    
    const chartData = {
        months: {!! json_encode(collect($monthlyRevenue)->pluck('month')->map(function($month) {
            return date('F', mktime(0, 0, 0, $month, 1));
        })) !!},
        revenue: {!! json_encode(collect($monthlyRevenue)->pluck('total')) !!},
        expenses: {!! json_encode(collect($monthlyExpenses)->pluck('total')) !!},
        profit: {!! json_encode(collect($monthlyProfit)->pluck('total')) !!}
    };

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.months,
            datasets: [
                {
                    label: 'Revenus',
                    data: chartData.revenue,
                    borderColor: 'rgb(59, 130, 246)',
                    tension: 0.1
                },
                {
                    label: 'Dépenses',
                    data: chartData.expenses,
                    borderColor: 'rgb(239, 68, 68)',
                    tension: 0.1
                },
                {
                    label: 'Bénéfice',
                    data: chartData.profit,
                    borderColor: 'rgb(34, 197, 94)',
                    tension: 0.1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' DH';
                        }
                    }
                }
            }
        }
    });

    Livewire.on('financialDataUpdated', data => {
        chart.data.labels = data.labels;
        chart.data.datasets[0].data = data.revenue;
        chart.data.datasets[1].data = data.expenses;
        chart.data.datasets[2].data = data.profit;
        chart.update();
    });
});
</script>
@endpush 