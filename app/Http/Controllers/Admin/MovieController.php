<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // daftar film
    public function index()
    {
        $movies = Movie::all();  // buat ambil data filmnya
        return view('admin.movies.index', compact('movies'));  // ngasih data ke view
    }

    // form  tambah film
    public function create()
    {
        return view('admin.movies.create');
    }

    // nyimpen data film baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'synopsis' => 'required|string',
            'genre' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'casts' => 'required|string|max:255',
            'age_rating' => 'required|string|max:10',
            'release_date' => 'required|date',
            'duration' => 'required|integer',
        ]);

        $movie = new Movie();
        $movie->title = $validated['title'];  // Pastikan title terisi
        $movie->synopsis = $validated['synopsis'];
        $movie->genre = $validated['genre'];
        $movie->director = $validated['director'];
        $movie->casts = $validated['casts'];
        $movie->age_rating = $validated['age_rating'];
        $movie->release_date = $validated['release_date'];
        $movie->duration = $validated['duration'];

        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $posterName = $movie->title . '-' . time() . '.' . $poster->getClientOriginalExtension();
            // Simpan gambar di folder public/posters
            $posterPath = public_path('posters');
            $poster->move($posterPath, $posterName);
            // Simpan nama file ke database
            $movie->poster = 'posters/' . $posterName;
        }
        

        $movie->save();

        return redirect()->route('admin.movies.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);  // ambil data film sesuai id
        return view('admin.movies.edit', compact('movie'));  // ngasih data ke view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'synopsis' => 'required|string',
            'genre' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'casts' => 'required|string|max:255',
            'age_rating' => 'required|string|max:10',
            'release_date' => 'required|date',
            'duration' => 'required|integer',
        ]);

        $movie = Movie::findOrFail($id);

        $movie->update($validated);

        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $posterName = $movie->title . '-' . time() . '.' . $poster->getClientOriginalExtension();
            // Simpan gambar di folder public/posters
            $posterPath = public_path('posters');
            $poster->move($posterPath, $posterName);
            // Simpan nama file ke database
            $movie->poster = 'posters/' . $posterName;
        }
        

        $movie->save();

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil diperbarui!');
    }

    // hapus data film
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        if ($movie->poster) {
            \Storage::delete('public/' . $movie->poster);
        }
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil dihapus!');
    }
}
