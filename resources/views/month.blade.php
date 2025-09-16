@extends('main')
@section('title')
    Expense Tracker - Monthly
@endsection
@section('csspart')
    <link rel="stylesheet" href="{{ asset('month.css') }}">
    <link rel="stylesheet" href="{{ asset('animations.css') }}">
@endsection
@section('titleOfPageHead')
    Expense Tracker App
@endsection
@section('mainpart')
    <!-- Chart -->
    <div class="chart-container">
        <h6 class="text-center mb-3">Expenses in 2025</h6>
        <canvas id="monthlyChart" height="70"></canvas>
    </div>

    <!-- Expense List -->
    <div class="expense-list">
        @foreach ($expenseData as $index => $expense)
            <div class="expense-card d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="circle me-3">{{ $loop->iteration }}</div>
                    <div>
                        <div class="expense-name">{{ $expense->expense_name }}</div>
                        <div class="expense-amount">₹{{ $expense->amount }}</div>
                    </div>
                </div>
                <small class="text-muted">{{ \Carbon\Carbon::parse($expense->created_at)->format('d-m-Y h:i A') }}</small>
            </div>
        @endforeach
    </div>
@endsection

@section('js')
    <script>
        // Convert Laravel $expenseData to JS
        const expenseData = @json($expenseData);

        // Initialize months
        const monthLabels = ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'];

        // Aggregate expenses by month (0 = Jan, 11 = Dec)
        const monthlyExpenses = Array(12).fill(0);
        expenseData.forEach(expense => {
            const date = new Date(expense.created_at);
            const month = date.getMonth(); // 0 - 11
            monthlyExpenses[month] += parseFloat(expense.amount);
        });

        const ctx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Expenses',
                    data: monthlyExpenses,
                    backgroundColor: function(context) {
                        // Highlight the month with max expense
                        const max = Math.max(...monthlyExpenses);
                        return context.raw === max ? '#ff4d4d' : '#ddd';
                    },
                    borderRadius: 10
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₹ ' + context.raw;
                            }
                        }
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
