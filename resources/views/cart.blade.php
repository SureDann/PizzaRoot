@extends('layout')
@section('title', 'Registration')
@section('content')
    @php
        $totalPrice = 0;
    @endphp
    <div style="padding-top: 100px; display: flex; flex-wrap: wrap;">
        @foreach($products as $product)
            @php
                $totalPrice += $product->price * $product->count;
            @endphp
            <div class="card" style="width: 18rem; margin: 15px" id="product{{$loop->iteration}}">
                <img src="{{asset("storage/".$product->image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    @if(\Illuminate\Support\Facades\Session::get('locale') == 'ru')
                        <h5 class="card-title">{{$product->name_ru}}</h5>
                        <p class="card-text">{{$product->description_ru}}</p>

                    @else
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>

                    @endif
                   <!-- <p class="card-text2">Count : {{$product->count}}</p>-->

                    <form>
                        @csrf
                        <input type="hidden" name="object_id" value="#">
                        <label for="quantity{{$loop->iteration}}"><h2 style="font-width: bold;">@lang('cart.count')</h2></label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, -1)">-</button>
                            <input class='price' type="number" id="quantity{{$loop->iteration}}" name="quantity" value="{{$product->count}}" min="1" style="width: 50px; height: 50px;" data-price="{{$product->price}}">

                            <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="btn btn-primary" type="submit" style="margin-top: 5px">@lang('cart.buy')</button>
                    </form>
                </div>
                <p id="total{{$loop->iteration}}" data-total="{{$product->price * $product->count}}">@lang('cart.total'): AMD {{$product->price * $product->count}}</p>
            </div>
        @endforeach
        <div>
            @if(!empty($product))
                <p id="totalPrice">@lang('cart.total_price'): AMD {{$totalPrice}}</p>
            @endif
        </div>
    </div>
    <script>
        let totalElement = document.getElementById('totalPrice');

        function changeQuantity(button, increment) {
            let input = button.parentNode.querySelector('input[type="number"]');
            let newValue = parseInt(input.value) + increment;
            let pricePerItem = parseInt(input.getAttribute('data-price')); // Получаем цену одного товара

            if (newValue >= parseInt(input.getAttribute('min'))) {
                input.value = newValue;
                let total = newValue * pricePerItem; // Вычисляем общую стоимость
                let totalElementId = 'total' + input.id.replace('quantity', ''); // Формируем ID элемента для общей стоимости
                let totalElement = document.getElementById(totalElementId); // Находим элемент для общей стоимости
                totalElement.textContent = "Total: AMD " + total; // Обновляем текст элемента с общей стоимостью
                totalElement.setAttribute('data-total', total); // Устанавливаем атрибут с общей стоимостью
                updateTotalPrice(); // Обновляем общую цену
            }
        }

        function updateTotalPrice() {
            let totalElements = document.querySelectorAll('[id^="total"]');
            let totalPrice = 0;
            totalElements.forEach(function(element) {
                let totalValue = parseInt(element.getAttribute('data-total'));
                if (!isNaN(totalValue)) {
                    totalPrice += totalValue; // Суммируем общую цену каждого элемента
                }
            });
            totalElement.textContent = "Total Price: AMD " + totalPrice; // Обновляем текст элемента с общей ценой
        }
    </script>
@endsection
