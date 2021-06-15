@extends('main')

@section('content')

    <div class="max-w-6xl text-center">
        <p> Choose color: </p>
        <select class="block w-full mt-1 h-16">
            @foreach($colors as $color)
                <option> {{$color->name}}   </option>
            @endforeach
        </select>
        </br>
        <a href="/delivery" class="ml-4 text-sm text-gray-700 underline"> Next step: Pick delivery</a>
    </div>


@endsection
