<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Customers</title>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Daftar Customers</h1>
            <a href="{{ route('customers.create') }}" class="btn btn-primary">Tambah Customer</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabel Customers -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Data Customers</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Spending</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->category }}</td>
                            <td>Rp {{ number_format($customer->spending, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data customer</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form Import CSV -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Import Data Statistik Customer</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('customers.import-csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="csv_file" class="form-label">Pilih File CSV</label>
                                <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv,.txt" required>
                                <div class="form-text">Format: Kategori;Week 1;Week 2;Week 3</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Import CSV</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Statistik Customer -->
        @if($customerStatistics->count() > 0)
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Statistik Customer per Kategori</h5>
                <form action="{{ route('customers.clear-statistics') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus semua data statistik?')">Clear Data</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Week 1</th>
                            <th>Week 2</th>
                            <th>Week 3</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customerStatistics as $stat)
                        <tr>
                            <td>{{ $stat->id }}</td>
                            <td>{{ $stat->kategori }}</td>
                            <td>{{ $stat->week_1 }}</td>
                            <td>{{ $stat->week_2 }}</td>
                            <td>{{ $stat->week_3 }}</td>
                            <td><strong>{{ $stat->total }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</body>
</html>