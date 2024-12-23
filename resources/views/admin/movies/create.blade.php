@extends('layouts.admin')
@section('title', 'Add Movie')
@section('content')
<h1>Add New Movie</h1>
<form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Judul:</label>
    <input type="text" name="title" required>
    
    <label>Genre:</label>
    <input type="text" name="genre" required>
    
    <label>Sutradara:</label>
    <input type="text" name="director" required>
    
    <label>Poster:</label>
    <input type="file" name="poster">
    
    <label>Sinopsis:</label>
    <textarea name="synopsis" required></textarea>
    
    <label>Pemeran:</label>
    <input type="text" name="casts" required>
    
    <label>Rating Usia:</label>
    <input type="text" name="age_rating" required>
    
    <label>Tanggal Rilis:</label>
    <input type="date" name="release_date">
    
    <label>Durasi (menit):</label>
    <input type="number" name="duration">
    
    <button type="submit">Tambah Film</button>
</form>
@endsection
