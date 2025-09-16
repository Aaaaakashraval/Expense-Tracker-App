@extends('main')
@section('title')
    Expense Tracker - Daily
@endsection
@section('csspart')
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('animations.css') }}">
@endsection
@section('titleOfPageHead')
    Expense Tracker App
@endsection
@section('mainpart')
    <!-- Chart -->
    <div class="chart-container mt-3">
        <canvas id="expenseChart" height="60"></canvas>
    </div>

    <!-- Expense List -->
    <div class="container mt-3">

        @foreach ($expenseData as $expenseDataView)
            <div class="expense-card d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="circle me-3">{{ $loop->iteration }}</div>
                    <div>
                        <div class="expense-name">{{ $expenseDataView->expense_name }}</div>
                        <div class="expense-amount">₹{{ $expenseDataView->amount }}</div>
                    </div>
                </div>
                <small class="text-muted">{{ $expenseDataView->formatted_created_at }}</small>
            </div>
        @endforeach

    </div>
@endsection

@section('js')
    <script>
    // Prepare data from Laravel
    const expenseData = @json($expenseData);

    // Extract labels (day of month) and amounts
    const labels = expenseData.map(expense => {
        // Format created_at to day of month (e.g., 27)
        const date = new Date(expense.created_at);
        return date.getDate();
    });

    const data = expenseData.map(expense => expense.amount);

    // Chart.js
    const ctx = document.getElementById('expenseChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Expenses',
                data: data,
                borderColor: '#2563eb',
                tension: 0.4,
                pointBackgroundColor: 'red',
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
