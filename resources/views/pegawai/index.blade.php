<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Pegawai</h1>
        <a href="{{ route('pegawai.tambah') }}" class="btn btn-primary mb-3">Tambah Pegawai</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr class="table-primary" align="center">
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Posisi</th>
                    <th>Gaji</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pegawai as $pegawai)
                <tr>
                    <td>{{ $pegawai->id }}</td>
                    <td>{{ $pegawai->name }}</td>
                    <td>{{ $pegawai->posisi }}</td>
                    <td>{{ $pegawai->gaji }}</td>
                    <td align="center">
                        <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> <br> <br>

        <h1>Daftar Insentif Pegawai</h1>
        <div class="row">
            <div class="col-8">
                <form action="{{ route('insentif.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".csv" required>
                    <button type="submit" class="btn btn-success mb-3">Import CSV</button>
                    <a href="{{ route('insentif.export') }}" class="btn btn-success mb-3">Export CSV</a>
                </form>
            </div>
            <div class="col-4">
                <form action="{{ route('insentif.destroyAll') }}" align="right" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua data insentif?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-3">Hapus Semua Data Insentif</button>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr class="table-primary" align="center">
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jumlah Lembur</th>
                    <th>Jumlah Absen</th>
                    <th>Insentif</th>
                </tr>
            </thead>
            <tbody>
                @foreach($insentifs as $i)
                <tr>
                    <td>{{ $i->id }}</td>
                    <td>{{ $i->nama }}</td>
                    <td>{{ $i->jumlah_lembur }}</td>
                    <td>{{ $i->jumlah_absen }}</td>
                    <td>{{ $i->insentif }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
