@extends('main')

@section('content')

    <div class="max-w-6xl text-center">
        <form action="/products" method="post">
            @csrf
            <p> Choose product: </p>
            <select name="orderedProduct" class="block w-full mt-1 h-16">
                @foreach($products as $product)
                    <option value="{{$product->id}}"> {{$product->name}} </option>
                @endforeach
            </select>
            </br>
            <input type="submit" value="Submit">
        </form>
    </br>
        <a href="/colors" class="ml-4 text-sm text-gray-700 underline"> Next step: Pick color</a>
    </div>


@endsection
