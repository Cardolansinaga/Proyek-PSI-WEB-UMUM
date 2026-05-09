@extends('layouts.site', ['active' => 'kesiswaan'])

@section('title', 'Admin Kesiswaan - SMAN 2 Balige')
@section('description', 'Panel admin untuk manajemen kesiswaan dan agenda.')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-10 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-black">Kesiswaan — Admin</h1>
                <p class="text-sm text-gray-600">Kelola agenda, organisasi, dan statistik kesiswaan.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/admin/kesiswaan/create" class="inline-flex items-center rounded bg-[#071f3a] px-4 py-2 text-sm font-semibold text-white">Buat Agenda</a>
                <a href="/admin/kesiswaan/import" class="inline-flex items-center rounded border px-4 py-2 text-sm">Impor</a>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-4">
            <table class="w-full table-auto text-left">
                <thead>
                    <tr class="text-sm text-gray-700">
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Judul</th>
                        <th class="py-3 px-4">Lokasi</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events ?? [['date' => '2026-10-28','title' => 'Latihan Dasar Kepemimpinan (LDK)','location' => 'Aula Serbaguna','status' => 'CONFIRMED'], ['date' => '2026-11-05','title' => 'Kompetisi Sains Balige (KSB)','location' => 'Laboratorium IPA','status' => 'PLANNING']] as $event)
                        <tr class="border-t">
                            <td class="py-3 px-4 align-top">{{ $event['date'] ?? ($event->date ?? '-') }}</td>
                            <td class="py-3 px-4 align-top">{{ $event['title'] ?? ($event->title ?? '-') }}</td>
                            <td class="py-3 px-4 align-top">{{ $event['location'] ?? ($event->location ?? '-') }}</td>
                            <td class="py-3 px-4 align-top"><span class="rounded px-2 py-1 text-xs font-semibold {{ ($event['status'] ?? ($event->status ?? '')) == 'CONFIRMED' ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700' }}">{{ $event['status'] ?? ($event->status ?? '-') }}</span></td>
                            <td class="py-3 px-4 align-top">
                                <a href="/admin/kesiswaan/{{ $loop->index ?? ($event->id ?? '') }}/edit" class="text-sm text-[#071f3a]">Edit</a>
                                <form action="/admin/kesiswaan/{{ $loop->index ?? ($event->id ?? '') }}" method="POST" class="inline-block ml-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="rounded-lg border p-4">
                <h4 class="font-black">Statistik Partisipasi</h4>
                <p class="text-sm text-gray-600 mt-2">Ringkasan partisipasi per kategori.</p>
            </div>
            <div class="rounded-lg border p-4">
                <h4 class="font-black">Prestasi</h4>
                <p class="text-sm text-gray-600 mt-2">Kelola prestasi dan sorotan siswa.</p>
            </div>
            <div class="rounded-lg border p-4">
                <h4 class="font-black">Pengaturan Organisasi</h4>
                <p class="text-sm text-gray-600 mt-2">Kelola OSIS, MPK, dan perwakilan kelas.</p>
            </div>
        </div>
    </div>
@endsection
