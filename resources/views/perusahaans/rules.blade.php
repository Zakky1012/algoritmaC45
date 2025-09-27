@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📌 Rules Hasil Algoritma C5.0</h2>

    {{-- Card Rules --}}
    <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
        @if(isset($rules) && count($rules) > 0)
            <div class="space-y-4">
                @foreach($rules as $index => $rule)
                    <div class="p-4 border-l-4 border-indigo-500 bg-gray-50 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 mb-2">Rule {{ $index + 1 }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ $rule }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 italic">Belum ada rules yang dihasilkan.</p>
        @endif
    </div>
</div>
@endsection
