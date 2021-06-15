@extends('main')

@section('content')
    <div class="max-w-6xl text-center">
        <form action="/placeOrder" method="post">
            @csrf
            <p> Choose product: </p>
            <select name="orderedProduct" class="block w-full mt-1 h-16">
                @foreach($products as $product)
                    <option value="{{$product->id}}"> {{$product->name}} </option>
                @endforeach
            </select>

            <p> Choose delivery: </p>
            <select name="delivery" class="block w-full mt-1 h-16">
                @foreach($delivery as $deliverItem)
                    <option value="{{$deliverItem->id}}"> {{$deliverItem->name}} </option>
                @endforeach
            </select>
            </br>
            <input type="submit" value="Submit">
        </form>
        </br>
    </div>

@endsection
