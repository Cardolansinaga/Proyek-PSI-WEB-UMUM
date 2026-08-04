@extends('layouts.admin')

@section('title', 'Edit Siswa')

@push('styles')
    @vite('resources/css/admin-pages/edit-student.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'kesiswaan'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Edit Data Siswa</h1>
                    <p>Perbarui data siswa yang tersimpan di modul kesiswaan admin.</p>
                </div>
                <a href="{{ route('admin.kesiswaan.index') }}" class="btn outline"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali</a>
            </div>

            @include('pages.admin.partials.page-guide', [
                'title' => 'Panduan edit data siswa',
                'description' => 'Pastikan data dasar siswa ditulis dengan benar sebelum disimpan.',
                'items' => [
                    'NIS dan nama wajib diisi.',
                    'Isi email, tanggal lahir, kelas, dan alamat jika datanya tersedia.',
                    'Klik Simpan Data setelah semua perubahan selesai.',
                ],
            ])

            <form class="card" id="edit-student-form" method="POST" action="{{ route('admin.api.students.update', $student->id) }}">
                @csrf
                <div class="form-grid">
                    <div class="field">
                        <label>NIS</label>
                        <input name="nis" value="{{ old('nis', $student->nis) }}" required>
                    </div>
                    <div class="field">
                        <label>Nama</label>
                        <input name="name" value="{{ old('name', $student->name) }}" required>
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $student->email) }}">
                    </div>
                    <div class="field">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date', optional($student->birth_date)->format('Y-m-d')) }}">
                    </div>
                    <div class="field">
                        <label>Kelas</label>
                        <input name="class" value="{{ old('class', $student->class) }}">
                    </div>
                    <div class="field full">
                        <label>Alamat</label>
                        <textarea name="address">{{ old('address', $student->address) }}</textarea>
                    </div>
                </div>
                <div class="actions">
                    <a href="{{ route('admin.kesiswaan.index') }}" class="btn outline"><i class="bi bi-x-circle" aria-hidden="true"></i> Batal</a>
                    <button class="btn primary" type="submit"><i class="bi bi-save" aria-hidden="true"></i> Simpan Data</button>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
