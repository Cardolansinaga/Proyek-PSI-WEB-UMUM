@extends('errors.layout')

@section('title', 'Akses Dibatasi')
@section('eyebrow', 'Akses Tidak Diizinkan')
@section('heading', 'Halaman ini memiliki akses terbatas')
@section('message', 'Akun atau sesi Anda tidak memiliki izin untuk membuka halaman tersebut. Kembali ke halaman utama atau masuk melalui portal admin yang resmi.')
@section('code', '403')
@section('status', 'Forbidden')
@section('primary_label', 'Kembali ke Beranda')
