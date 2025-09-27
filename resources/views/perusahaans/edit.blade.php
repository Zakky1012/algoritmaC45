@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Perusahaan</h2>
    
    <form action="{{ route('perusahaans.update', $perusahaan->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Form Fields --}}
        @include('perusahaans.form')

        <div class="flex justify-end space-x-3">
            <a href="{{ route('perusahaans.index') }}" 
               class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                Batal
            </a>
            <button type="submit" 
                    class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
