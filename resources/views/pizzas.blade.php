@extends('layout')
@section('title', 'PizzaRoot | Pizzas')
@section('content')

    <div class="row row-cols-1 row-cols-md-3 g-4" style="margin-top: 10px; margin-left: 10px">
        @foreach($pizzas as $index => $pizza)
            <div class="col mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset("storage/".$pizza->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pizza->name }}</h5>
                        <p class="card-text">{{ $pizza->description }}</p>
                        <p class="font-monospace" style="font-size: 18pt">Price: {{ $pizza->price }} AMD</p>
                        <a class="btn btn-primary" href="{{route("prod_info_view", ['pk'=>$pizza->id])}}" role="button">Info</a>
                        <form  action="@auth{{route('add_cart')}} @else {{route('registration_view')}}@endauth" @auth method="POST" @else method="GET"@endauth>
                            @csrf
                            <input type="hidden" name="object_id" value="{{ $pizza->id }}">
                            <label for="quantity{{$loop->iteration}}"><h2 style="font-width: bold;">Count of pizza</h2></label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, -1)">-</button>
                                <input type="number" id="quantity{{$loop->iteration}}" name="quantity" value="1" min="1" style="width: 50px; height: 50px;" data-price="{{ $pizza->price }}">

                                <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="btn btn-primary" type="submit" style="margin-top: 5px">Add to Cart</button>
                        </form>

                    </div>
                </div>
            </div>
            @if(($index + 1) % 5 == 0)

    </div><div class="row row-cols-1 row-cols-md-3 g-4">
        @endif

        @endforeach
    </div>

@endsection

<script>
    function changeQuantity(button, increment) {
        var input = button.parentNode.querySelector('input[type="number"]');
        var newValue = parseInt(input.value) + increment;
        var pricePerItem = parseInt(input.getAttribute('data-price')); // Получаем цену одного товара
        var totalElement = document.getElementById('total' + input.id.replace('quantity', '')); // Находим элемент для общей стоимости

        if (newValue >= parseInt(input.getAttribute('min'))) {
            input.value = newValue;
            var total = newValue * pricePerItem; // Вычисляем общую стоимость
            totalElement.textContent = total + " AMD"; // Обновляем текст элемента с общей стоимостью
        }
    }
</script>

