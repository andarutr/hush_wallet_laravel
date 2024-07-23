@extends('layouts.master')

@section('content')
<div class="card">
    <center>
        <div class="card-body mt-5">
            <h1 class="mb-5">Dashboard</h1>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-bordered">
                        <div class="card-body">
                            <h5>Rekapan Tahunan</h5>
                            <canvas id="myTahunanChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-bordered">
                        <div class="card-body">
                            <h5>Platform Favorite</h5>
                            <canvas id="myPlatformChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.com/libraries/Chart.js"></script>
<script>

    function myTahunanChart(){
        const labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        const incomeData = {!! json_encode($monthly_income) !!};
        const savingData = {!! json_encode($monthly_saving) !!};
        const outcomeData = {!! json_encode($monthly_outcome) !!};

        function getMaxValue(data) {
            return Math.max(...Object.values(data), 0); 
        }

        const maxIncome = getMaxValue(incomeData) + 100000;
        const maxSaving = getMaxValue(savingData) + 100000;
        const maxOutcome = getMaxValue(outcomeData) + 100000;

        // Memilih nilai maksimum terbesar dari ketiga data
        const suggestedMax = Math.max(maxIncome, maxSaving, maxOutcome);

        // Fungsi untuk mengatur data berdasarkan label bulan
        function formatData(data) {
            return labels.map(month => data[month] || 0);
        }

        const data = {
            labels: labels.map(month => {
                const date = new Date(2000, month - 1, 1); 
                return date.toLocaleString('id-ID', { month: 'long' });
            }),
            datasets: [{
                    label: 'Income',
                    data: formatData(incomeData), 
                    backgroundColor: 'rgb(75, 192, 75)',
                    borderColor: 'rgb(75, 192, 75)',
                    borderWidth: 1
                },
                {
                    label: 'Nabung',
                    data: formatData(savingData), 
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                },
                {
                    label: 'Outcome',
                    data: formatData(outcomeData), 
                    backgroundColor: 'rgb(255, 159, 64)',
                    borderColor: 'rgb(255, 159, 64)',
                    borderWidth: 1
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: suggestedMax, 
                        ticks: {
                            callback: function(value, index, values) {
                                return value.toLocaleString('id-ID'); 
                            }
                        }
                    },
                    x: {
                        beginAtZero: true,
                        categoryPercentage: 0.8, 
                        barPercentage: 0.9 
                    }
                }
            }
        };

        const ctx = document.getElementById('myTahunanChart').getContext('2d');
        new Chart(ctx, config);
    }

    myTahunanChart();

    function generateRandomColor() {
        const r = Math.floor(Math.random() * 250) + 100;
        const g = Math.floor(Math.random() * 250) + 100;
        const b = Math.floor(Math.random() * 250) + 100;

        return `rgb(${r}, ${g}, ${b})`;
    }

    function myPlatformChart(){
        const ctx = document.getElementById('myPlatformChart');
        const platforms = @json($platforms); 
        const backgroundColors = [];
        for (let i = 0; i < platforms.length; i++) {
            backgroundColors.push(generateRandomColor());
        }
        const platformCount = @json($platformCount);

        const counts = Object.values(platformCount);
        const data = {
            labels: platforms,
            datasets: [{
                label: 'My First Dataset',
                data: counts,
                backgroundColor: backgroundColors
            }]
        };

        new Chart(ctx, {
            type: 'polarArea',
            data: data,
            options: {}
        });
    }

    myPlatformChart();
</script>
@endpush