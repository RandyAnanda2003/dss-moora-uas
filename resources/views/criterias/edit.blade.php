@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-bold text-red-600 mt-[20vh]">
        Edit Data!
    </h1>
    <div class="container my-2">
        <form action="{{ route('criterias.update', $criteria) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ $criteria->name }}"
                    class="border border-gray-400 p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-bold mb-2">Type</label>
                <input type="text" name="type" id="type" value="{{ $criteria->type }}"
                    class="border border-gray-400 p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label for="weight" class="block text-sm font-bold mb-2">Weight</label>
                <input type="number" name="weight" id="weight" value="{{ $criteria->weight }}"
                    class="border border-gray-400 p-2 w-full" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
@endsection
