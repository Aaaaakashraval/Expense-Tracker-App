<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('registration.css') }}">
    <link rel="stylesheet" href="{{ asset('animations.css') }}"> <!-- Add this line -->

</head>

<body>

    <div class="glass-card text-center">
        <h3 class="mb-4">Sign Up</h3>
        <form method="POST" action="{{ route('registerProcessETA') }}">
            @csrf

            <div class="mb-3">
                <input type="text" name="Username" value="{{ old('Username') }}" class="form-control  @error('Username') is-invalid @enderror"
                    placeholder="Name">
                @error('Username')
                    <b class="text-danger text-left">{{ $message }}</b>
                @enderror
            </div>

            <div class="mb-3">
                <input type="email" name="Email" value="{{ old('Email') }}" class="form-control  @error('Username') is-invalid @enderror"
                    placeholder="Email">
                @error('Email')
                    <b class="text-danger text-left">{{ $message }}</b>
                @enderror
            </div>

            <div class="mb-3">
                <input type="tel" name="Mobile" maxlength="10" minlength="10"
                    value="{{ old('Mobile') }}" class="form-control  @error('Username') is-invalid @enderror" placeholder="Mobile Number">
                @error('Mobile')
                    <b class="text-danger text-left">{{ $message }}</b>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="Password" value="{{ old('Password') }}" class="form-control  @error('Username') is-invalid @enderror"
                    placeholder="Password">
                @error('Password')
                    <b class="text-danger text-left">{{ $message }}</b>
                @enderror
            </div>
            <button type="submit" class="btn btn-custom">Sign Up</button>
        </form>
        <div class="text-center mt-3">
            <small>Already have an account? <a href="{{ route('loginETA') }}" class="text-link">Login</a></small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
