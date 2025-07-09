<!DOCTYPE html>
<html>
<head>
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Edit Data Pegawai</h2>

    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama:</label>
            <input type="text" name="name" class="form-control" value="{{ $pegawai->name }}" required>
        </div>

        <div class="mb-3">
            <label>Posisi:</label>
            <input type="text" name="posisi" class="form-control" value="{{ $pegawai->posisi }}" required>
        </div>

        <div class="mb-3">
            <label>Gaji:</label>
            <input type="number" name="gaji" class="form-control" value="{{ $pegawai->gaji }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
