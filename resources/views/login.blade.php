<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('animations.css') }}"> <!-- Add this line -->
    <link rel="stylesheet" href="{{ asset('login.css') }}">


</head>

<body>
    {{-- Show success message --}}






    <div class="glass-card">

        @if (session('error'))
            <div class="row ">
                <div class="col-12 text-center text-dark"> <b> {{ session('error') }} </b>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="row ">
                <div class="col-12 text-center text-dark"> <b> {{ session('success') }} </b>
                </div>
            </div>
        @endif



        <br>
        <h3>LOGIN</h3>
        <form action="{{ route('loginProcessETA') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" class="form-control @error('Email') is-invalid @enderror " placeholder="Email"
                    name="email">
                @error('email')
                    <b class="text-danger">{{ $message }}</b>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror "
                    placeholder="Password" name="password">
                @error('password')
                    <b class="text-danger">{{ $message }}</b>
                @enderror
            </div>
            <button type="submit" class="btn btn-custom">Login</button>
        </form>
        <div class="text-center mt-3">
            <small>Don't have an account? <a href="{{ route('registerETA') }}" class="text-link">Sign up</a></small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
