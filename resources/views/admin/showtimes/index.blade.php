@extends('layouts.admin')

@section('title', 'Jadwal Tayang')

@section('content')
<div class="container">
    <h1 class="my-4">Jadwal Tayang</h1>
    <a href="{{ route('admin.showtimes.create') }}" class="btn btn-primary mb-3">Tambah Jadwal Tayang</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Judul Film</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($showtimes as $showtime)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $showtime->movie->title }}</td>
                        <td>{{ $showtime->date }}</td>
                        <td>{{ $showtime->start_time }}</td>
                        <td>{{ $showtime->end_time }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.showtimes.edit', $showtime->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.showtimes.destroy', $showtime->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada jadwal tayang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
