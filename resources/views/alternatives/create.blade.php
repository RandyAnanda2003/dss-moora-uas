@extends('layouts.app')

@section('content')

    <h1 class="text-4xl font-bold text-red-600 mt-[20vh]">
        Add Data!
    </h1>

    <div class="mt-8">
        @if ($errors->any())
            <div class="text-red-600">
                @foreach ($errors->all() as $error)
                    <p>*{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('alternatives.store') }}">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td class="py-2 font-bold">Name:</td>
                        <td class="px-4 py-2 w-full"><input type="text" id="name" name="name"
                                class="border border-black rounded-3xl px-4 py-1"></td>
                    </tr>
                    @foreach ($criterias as $criteria)
                        <tr>
                            <td class="py-2 font-bold">{{ $criteria->name }}:</td>
                            <?php
                            $cur_id = (string) $criteria->id;
                            $alt_col = 'c' . $cur_id;
                            ?>
                            <td class="px-4 py-2 w-full"><input type="text" id="{{ $alt_col }}"
                                    name="{{ $alt_col }}" class="border border-black rounded-3xl px-4 py-1"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="px-4 py-1 bg-red-600 text-white rounded-3xl font-bold" type="submit">
                Save
            </button>
        </form>
    </div>


@endsection
