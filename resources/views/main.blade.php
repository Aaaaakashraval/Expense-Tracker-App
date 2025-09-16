<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/x-icon"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>💰</text></svg>">

    @yield('csspart')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('dashboardETA') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h5 class="title" style="margin-left: 50px">@yield('titleOfPageHead')</h5>

        <div class="d-block"><b style="text-transform: capitalize">{{ Auth::user()->Username }}</b></div>
    </nav>

    @yield('mainpart')



    <!-- Add Button -->
    <button class="add-btn" data-bs-toggle="modal" data-bs-target="#expenseModal">+</button>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">

        <!-- Bottom Navigation -->
        <div class="bottom-nav">

            <a href="{{ route('dashboardETA') }}" class="active">
                <i class="fas fa-calendar-day"></i>
                <span>Daily</span>
            </a>
            <a href="{{ route('monthETA') }}" class="active">
                <i class="fas fa-chart-pie"></i>
                <span>Monthly</span>
            </a>

            <a href="{{ route('myaccountETA') }}" class="active">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </div>
    </div>

    <!-- Success Message -->
    {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ Expense saved successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div> --}}

    <!-- Expense Modal -->
    <div class="modal fade" id="expenseModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center">Add New Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addexpenseETA') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Expense Name</label>
                            <input type="hidden"  name="expenseuserId" value="{{ Auth::user()->id }}">
                            <input name="ExpenseName" type="text" class="form-control  @error('ExpenseName') is-invalid @enderror" placeholder="Enter expense">
                            @error('ExpenseName')
                                <p class="text-danger">
                                     <b>{{ $message }}</b>
                                </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input name="ExpensePrice" type="number" class="form-control @error('ExpensePrice') is-invalid @enderror" placeholder="0.00"> <br>
                               
                            </div>
                             @error('ExpensePrice')
                                    <p class="text-danger">
                                        <b> {{ $message }}</b>
                                    </p>
                                @enderror
                        </div>

                </div>
                <div class="modal-footer d-flex justify-content-between border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')

</body>

</html>
