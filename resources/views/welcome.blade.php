<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('animations.css') }}">

</head>

<body>

    <div class="logo">
        <i class="fas fa-wallet fa-3x" style="color: white;"></i>
    </div>

    <div class="welcome-text">
        Welcome to Expense Tracker App <br> <span
            style="margin-left: 30%; color:#3752a6;text-decoration:underline;">Akash Raval</span>
    </div>

    <a href="{{ route('loginETA') }}" class="btn btn-custom">Get Started</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
