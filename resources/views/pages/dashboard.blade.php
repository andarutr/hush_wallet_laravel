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
            <div class="row mt-5 mb-5">
                <div class="col-lg-10 mx-auto">
                    <div class="card card-bordered">
                        <div class="card-body">
                            <h5>Rekapan Income Tahunan</h5>
                            <canvas id="myIncomeChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto mt-3">
                    <div class="card card-bordered">
                        <div class="card-body">
                            <h5>Rekapan Outcome Tahunan</h5>
                            <canvas id="myOutcomeChart"></canvas>
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

        const suggestedMax = Math.max(maxIncome, maxSaving, maxOutcome);

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

    function myIncomeChart(){
        const labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        const incomeBekerja = {!! json_encode($monthly_income_bekerja) !!};
        const incomeFreelance = {!! json_encode($monthly_income_freelance) !!};

        function getMaxValue(data) {
            return Math.max(...Object.values(data), 0); 
        }

        const maxBekerja = getMaxValue(incomeBekerja) + 100000;
        const maxFreelance = getMaxValue(incomeFreelance) + 100000;

        const suggestedMax = Math.max(maxBekerja, maxFreelance);

        function formatData(data) {
            return labels.map(month => data[month] || 0);
        }

        const data = {
            labels: labels.map(month => {
                const date = new Date(2000, month - 1, 1); 
                return date.toLocaleString('id-ID', { month: 'short' });
            }),
            datasets: [{
                    label: 'Bekerja',
                    data: formatData(incomeBekerja), 
                    backgroundColor: 'rgb(75, 192, 75)',
                    borderColor: 'rgb(75, 192, 75)',
                    borderWidth: 1
                },
                {
                    label: 'Freelance',
                    data: formatData(incomeFreelance), 
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
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

        const ctx = document.getElementById('myIncomeChart').getContext('2d');
        new Chart(ctx, config);
    }

    myIncomeChart();

    function myOutcomeChart(){
        const labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        const outcomeHari = {!! json_encode($monthly_outcome_hari) !!};
        const outcomeHutang = {!! json_encode($monthly_outcome_hutang) !!};
        const outcomeCicilan = {!! json_encode($monthly_outcome_cicilan) !!};
        const outcomeKeinginan = {!! json_encode($monthly_outcome_keinginan) !!};
        const outcomeBulanan = {!! json_encode($monthly_outcome_bulanan) !!};

        function getMaxValue(data) {
            return Math.max(...Object.values(data), 0); 
        }

        const maxHari = getMaxValue(outcomeHari) + 100000;
        const maxHutang = getMaxValue(outcomeHutang) + 100000;
        const maxCicilan = getMaxValue(outcomeCicilan) + 100000;
        const maxKeinginan = getMaxValue(outcomeKeinginan) + 100000;
        const maxBulanan = getMaxValue(outcomeBulanan) + 100000;

        const suggestedMax = Math.max(maxHari, maxHutang, maxCicilan, maxKeinginan, maxBulanan);

        function formatData(data) {
            return labels.map(month => data[month] || 0);
        }

        const data = {
            labels: labels.map(month => {
                const date = new Date(2000, month - 1, 1); 
                return date.toLocaleString('id-ID', { month: 'short' });
            }),
            datasets: [{
                    label: 'Sehari-hari',
                    data: formatData(outcomeHari), 
                    backgroundColor: 'rgb(192, 75, 75)',
                    borderColor: 'rgb(192, 75, 75)',
                    borderWidth: 1
                },
                {
                    label: 'Hutang',
                    data: formatData(outcomeHutang), 
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                },
                {
                    label: 'Cicilan',
                    data: formatData(outcomeCicilan), 
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                },
                {
                    label: 'Keinginan',
                    data: formatData(outcomeKeinginan), 
                    backgroundColor: 'rgb(255, 159, 64)',
                    borderColor: 'rgb(255, 159, 64)',
                    borderWidth: 1
                },
                {
                    label: 'Bulanan',
                    data: formatData(outcomeBulanan), 
                    backgroundColor: 'rgb(153, 102, 255)',
                    borderColor: 'rgb(153, 102, 255)',
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

        const ctx = document.getElementById('myOutcomeChart').getContext('2d');
        new Chart(ctx, config);
    }

    myOutcomeChart();
</script>
@endpush