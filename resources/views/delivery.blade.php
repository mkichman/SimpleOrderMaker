@extends('main')

@section('content')

    <div class="max-w-6xl text-center">
        <p> Choose delivery: </p>
        <select class="block w-full mt-1 h-16">
            @foreach($delivery as $option)
                <option> {{$option->name}}   </option>
            @endforeach
        </select>
        </br>
        <a href="/finish" class="ml-4 text-sm text-gray-700 underline"> Finish</a>
    </div>


@endsection
