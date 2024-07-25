@extends('layouts.app')

@section('content')
    <div class="">
        <h1 class="text-4xl font-bold text-red-600 mt-[20vh]">Dashboard!</h1>

        <div class="mt-8">
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold">Table Kriteria Staff Of The Month</h2>
                <button class="px-4 py-1 bg-slate-600 text-white rounded-3xl font-bold">
                    <a href="{{ route('criterias.create') }}">Add</a>
                </button>
            </div>

            <div class="w-[100%] mt-4 overflow-auto">
                @if ($criterias->isEmpty())
                    <div class="text-center py-4 text-red-600 font-bold">
                        Data kriteria masih kosong.
                    </div>
                @else
                    <table class="border-collapse border-2 border-black text-center w-full">
                        <thead>
                            <tr class="bg-red-300">
                                <th class="border-2 border-black px-4 py-2">Criteria</th>
                                @foreach ($criterias as $criteria)
                                    <th class="border-2 border-black px-4 py-2">{{ $criteria->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-2 border-black px-4 py-2 font-bold">Weight</td>
                                @foreach ($criterias as $criteria)
                                    <td class="border-2 border-black px-4 py-2">
                                        {{ rtrim(sprintf('%.2f', $criteria->weight), '0.') }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="border-2 border-black px-4 py-2 font-bold">Type</td>
                                @foreach ($criterias as $criteria)
                                    <td class="border-2 border-black px-4 py-2">{{ $criteria->type }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="border-2 border-black px-4 py-2 font-bold">Aksi</td>
                                @foreach ($criterias as $criteria)
                                    <td class="border-2 border-black px-4 py-2">
                                        <div class="flex justify-center gap-2">
                                            <button class="px-4 py-1 bg-black text-white rounded-3xl font-bold">
                                                <a href="{{ route('criterias.edit', $criteria) }}">Edit</a>
                                            </button>

                                            <form action="{{ route('criterias.destroy', $criteria) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-1 bg-red-600 text-white rounded-3xl font-bold"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="mt-8">
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold">Alternatives</h2>
                <button class="px-4 py-1 bg-slate-600 text-white rounded-3xl font-bold">
                    <a href="{{ route('alternatives.create') }}">Add</a>
                </button>
            </div>

            <div class="w-[100%] mt-4 overflow-auto">
                @if ($alternatives->isEmpty())
                    <div class="text-center py-4 text-red-600 font-bold">
                        Data alternatif masih kosong.
                    </div>
                @else
                    <table class="border-collapse border-2 border-black text-center w-full">
                        <thead>
                            <tr class="bg-red-300">
                                <th class="border-2 border-black px-4 py-2">Alternative</th>
                                @foreach ($criterias as $criteria)
                                    <th class="border-2 border-black px-4 py-2">{{ $criteria->name }}</th>
                                @endforeach
                                <th class="border-2 border-black px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatives as $alternative)
                                <tr>
                                    <td class="border-2 border-black px-4 py-2 font-bold">{{ $alternative->name }}</td>
                                    @foreach ($criterias as $criteria)
                                        @php
                                            $criteriaColumn = 'c' . $criteria->id;
                                        @endphp
                                        <td class="border-2 border-black px-4 py-2">{{ $alternative->$criteriaColumn }}</td>
                                    @endforeach
                                    <td class="border-2 border-black px-4 py-2">
                                        <div class="flex justify-center gap-2">
                                            <button class="px-4 py-1 bg-black text-white rounded-3xl font-bold">
                                                <a href="{{ route('alternatives.edit', $alternative) }}">Edit</a>
                                            </button>
                                            <form method="POST"
                                                action="{{ route('alternatives.destroy', $alternative) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-4 py-1 bg-red-600 text-white rounded-3xl font-bold"
                                                    type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <tr class="bg-slate-200">
                                <td class="border-2 border-black px-4 py-2 font-bold">Optimum</td>
                                @foreach ($criterias as $criteria)
                                    <td class="border-2 border-black px-4 py-2">{{ $criteria->type }}</td>
                                @endforeach
                                <td class="border-2 border-black px-4 py-2 font-bold"></td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold">Results</h2>

            <div class="w-[100%] mt-4 overflow-auto">
                @if (empty($results))
                    <div class="text-center py-4 text-red-600 font-bold">
                        Data hasil masih kosong.
                    </div>
                @else
                    <table class="border-collapse border-2 border-black text-center w-full">
                        <thead>
                            <tr class="bg-red-300">
                                <th class="border-2 border-black px-4 py-2">Alternative</th>
                                <th class="border-2 border-black px-4 py-2">Value</th>
                                <th class="border-2 border-black px-4 py-2">Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td class="border-2 border-black px-4 py-2 font-bold">{{ $result['name'] }}</td>
                                    <td class="border-2 border-black px-4 py-2 font-bold">{{ $result['y'] }}</td>
                                    <td class="border-2 border-black px-4 py-2 font-bold">{{ $loop->index + 1 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
