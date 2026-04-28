<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/ppdb', 'pages.ppdb')->name('ppdb');
Route::view('/berita', 'pages.berita')->name('berita.index');
Route::view('/berita/{slug}', 'pages.berita-detail')->name('berita.show');
Route::view('/galeri', 'pages.galeri')->name('galeri');
Route::view('/prestasi', 'pages.prestasi')->name('prestasi');
Route::view('/kontak', 'pages.kontak')->name('kontak');
Route::view('/alumni-kemitraan', 'pages.alumni')->name('alumni');
Route::view('/guru-tenaga-kependidikan', 'pages.guru')->name('guru');
