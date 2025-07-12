<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management System</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mt-5">
                    <h1 class="display-4">Customer Management System</h1>
                    <p class="lead">Selamat datang di sistem manajemen customer</p>
                    
                    @if (Route::has('login'))
                        <div class="mt-4">
                            @auth
                                <a href="{{ route('customers.index') }}" class="btn btn-primary btn-lg">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>