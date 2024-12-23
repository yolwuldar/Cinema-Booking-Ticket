@extends('layouts.admin')
@section('title', 'Edit Movie')
@section('content')
<h1>Edit Movie</h1>
<form action="{{ route('admin.movies.update', $movie) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Judul:</label>
    <input type="text" name="title" value="{{ $movie->title }}" required>
    
    <label>Genre:</label>
    <input type="text" name="genre" value="{{ $movie->genre }}" required>
    
    <label>Sutradara:</label>
    <input type="text" name="director" value="{{ $movie->director }}" required>
    
    <label>Poster:</label>
    <input type="file" name="poster">
    
    <label>Sinopsis:</label>
    <textarea name="synopsis" required>{{ $movie->synopsis }}</textarea>
    
    <label>Pemeran:</label>
    <input type="text" name="casts" value="{{ $movie->casts }}" required>
    
    <label>Rating Usia:</label>
    <input type="text" name="age_rating" value="{{ $movie->age_rating }}"> 
    <label>Tanggal Rilis:</label>
    <input type="date" name="release_date" value="{{ $movie->release_date }}">
    
    <label>Durasi (menit):</label>
    <input type="number" name="duration" value="{{ $movie->duration }}">
    
    <button type="submit">Update Film</button>
</form>
@endsection
