<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Customer</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('customers.index') }}">Customer Management</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    Selamat datang, {{ Auth::user()->name }}!
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Customer Baru</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('customers.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Customer</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="VIP" {{ old('category') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                    <option value="Regular" {{ old('category') == 'Regular' ? 'selected' : '' }}>Regular</option>
                                    <option value="Premium" {{ old('category') == 'Premium' ? 'selected' : '' }}>Premium</option>
                                    <option value="Corporate" {{ old('category') == 'Corporate' ? 'selected' : '' }}>Corporate</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="spending" class="form-label">Total Spending</label>
                                <input type="number" class="form-control" id="spending" name="spending" value="{{ old('spending') }}" min="0" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>