@extends('layouts.app')

@section('content')
    <div class="h-screen flex items-center">
        <div>
            <h1 class="text-4xl font-bold">
                Welcome to Decision Support System Dashboard!
            </h1>
            <button class="mt-4 px-4 py-2 bg-red-600 text-white rounded-3xl font-bold">
                <a href="{{ route('dashboard') }}">Go to Dashboard</a>
            </button>
        </div>

    </div>
@endsection
