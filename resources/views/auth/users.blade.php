@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Daftar User</h2>
        <a href="{{ route('users.create') }}" 
           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Tambah User
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Nama</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Dibuat</th>
                <th class="py-2 px-4 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border">{{ $user->id }}</td>
                    <td class="py-2 px-4 border">{{ $user->name }}</td>
                    <td class="py-2 px-4 border">{{ $user->email }}</td>
                    <td class="py-2 px-4 border">{{ $user->created_at->format('d-m-Y') }}</td>
                    <td class="py-2 px-4 border text-center space-x-2">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('users.edit', $user->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('users.destroy', $user->id) }}" 
                              method="POST" 
                              class="inline-block"
                              onsubmit="return confirm('Yakin mau hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
