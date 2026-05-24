<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Siswa - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('pages.admin.partials.admin-polish')
    <style>
        body{font-family:Inter, sans-serif;background:#f8fafc;padding:24px}
        .card{background:white;padding:20px;border-radius:10px;max-width:720px;margin:0 auto}
        .field{display:block;margin-bottom:12px}
        input,textarea,select{width:100%;padding:10px;border-radius:8px;border:1px solid #e6eef8}
        .actions{display:flex;gap:8px;justify-content:flex-end;margin-top:12px}
        .btn{padding:10px 14px;border-radius:8px;cursor:pointer}
        .btn.primary{background:#071f3a;color:white;border:none}
        .btn.outline{background:white;border:1px solid #d9e1ec}
    </style>
</head>
<body>
    <div class="card">
        <h2>Edit Data Siswa</h2>
        <form id="edit-student-form" method="POST" action="{{ route('admin.api.students.update', $student->id) }}">
            @csrf
            <div class="field">
                <label>NIS</label>
                <input name="nis" value="{{ $student->nis }}" required />
            </div>
            <div class="field">
                <label>Nama</label>
                <input name="name" value="{{ $student->name }}" required />
            </div>
            <div class="field">
                <label>Email</label>
                <input name="email" value="{{ $student->email }}" />
            </div>
            <div class="field">
                <label>Tgl Lahir</label>
                <input type="date" name="birth_date" value="{{ optional($student->birth_date)->format('Y-m-d') }}" />
            </div>
            <div class="field">
                <label>Kelas</label>
                <input name="class" value="{{ $student->class }}" />
            </div>
            <div class="field">
                <label>Alamat</label>
                <textarea name="address">{{ $student->address }}</textarea>
            </div>
            <div class="actions">
                <a href="{{ route('admin.kesiswaan.index') }}" class="btn outline">Batal</a>
                <button class="btn primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
