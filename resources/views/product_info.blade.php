@extends('layout')
@section('title', 'PizzaRoot | Pizzas')

@section('content')

    @foreach($objects as $object)
    <div style="margin-top: 50px">
        <div class="row g-0 bg-body-secondary position-relative">
            <div class="col-md-6 mb-md-0 p-md-4" style="width: 700px;">
                <img src="{{asset("storage/".$object->image)}}" class="w-100" alt="...">
            </div>
            <div class="col-md-6 p-4 ps-md-0">
                @if(\Illuminate\Support\Facades\Session::get('locale')=='ru')
                    <h5 class="mt-0">{{$object->name_ru}}</h5>
                    <p>{{$object->description_ru}}</p>
                @else
                    <h5 class="mt-0">{{$object->name}}</h5>
                    <p>{{$object->description}}</p>

                @endif
                <p class="fs-2" id="total{{$loop->iteration}}">{{ $object->price }} AMD</p>


                <form  action="@auth{{route('add_cart')}} @else {{route('registration_view')}}@endauth" @auth method="POST" @else method="GET"@endauth>
                    @csrf
                    <input type="hidden" name="object_id" value="{{ $object->id }}">
                    <label for="quantity{{$loop->iteration}}"><h2 style="font-width: bold;">Count of pizza</h2></label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, -1)">-</button>
                        <input type="number" id="quantity{{$loop->iteration}}" name="quantity" value="1" min="1" style="width: 50px; height: 50px;" data-price="{{ $object->price }}">

                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, 1)">+</button>
                    </div>
                    <button class="btn btn-primary" type="submit" style="margin-top: 5px">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
@endforeach

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

