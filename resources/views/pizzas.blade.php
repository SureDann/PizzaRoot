@extends('layout')
@section('title', 'PizzaRoot | Pizzas')
@section('content')

    <div class="row row-cols-1 row-cols-md-3 g-4" style="padding-top: 80px; ">
        @foreach($pizzas as $index => $pizza)
            <div class="col mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset("storage/".$pizza->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::get('locale')=='ru')
                            <h5 class="card-title">{{ $pizza->name_ru }}</h5>
                            <p class="card-text">{{ $pizza->description_ru }}</p>

                        @else
                            <h5 class="card-title">{{ $pizza->name }}</h5>
                            <p class="card-text">{{ $pizza->description }}</p>

                        @endif
                        <p class="font-monospace" style="font-size: 18pt">@lang('products.price'): {{ $pizza->price }} AMD</p>
                        <a class="btn btn-primary" href="{{route("prod_info_view", ['pk'=>$pizza->id])}}" role="button">Info</a>
                        <form  action="@auth{{route('add_cart')}}@endauth" @auth method="POST" @endauth>
                            @csrf
                            <input type="hidden" name="object_id" value="{{ $pizza->id }}">
                            <label for="quantity{{$loop->iteration}}"><h2 style="font-width: bold;">@lang('products.count')</h2></label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, -1)">-</button>
                                <input type="number" id="quantity{{$loop->iteration}}" name="quantity" value="1" min="1" style="width: 50px; height: 50px;" data-price="{{ $pizza->price }}">

                                <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            @auth
                                <button class="btn btn-primary openModalBtn" type="button" style="margin-top: 5px">@lang('products.add_to_cart')</button>
                            @else
                                <button class="btn btn-primary openModalBtn" type="button" style="margin-top: 5px" onclick="openModal()">@lang('products.add_to_cart')</button>
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
            @if(($index + 1) % 5 == 0)
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @endif
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="conteiner" style="padding-top: 30px; margin-left: 10px; margin-right: 10px">
                    <div class="mt5" style="margin-right: 20px">
                        @if($errors->any())
                            <div class="col-12">
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">{{$error}}</div>
                                @endforeach
                            </div>
                        @endif


                        @if(session()->has('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif


                        @if(session()->has('success'))
                            <div class="alert alert-danger">{{session('success')}}</div>
                        @endif
                    </div>


                    <form action="{{route('register_post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Fullname</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
                <span class="closeModal" onclick="closeModal()">X</span>

        </div>
    </div>


    <script>
        function changeQuantity(button, increment) {
            let input = button.parentNode.querySelector('input[type="number"]');
            let  newValue = parseInt(input.value) + increment;
            let pricePerItem = parseInt(input.getAttribute('data-price')); // Получаем цену одного товара
            let totalElement = document.getElementById('total' + input.id.replace('quantity', '')); // Находим элемент для общей стоимости

            if (newValue >= parseInt(input.getAttribute('min'))) {
                input.value = newValue;
                let total = newValue * pricePerItem; // Вычисляем общую стоимость
                totalElement.textContent = total + " AMD"; // Обновляем текст элемента с общей стоимостью
            }
        }
        function openModal() {
            let modal = document.getElementById('myModal');
            modal.style.display = "flex";
        }

        function closeModal() {
            let modal = document.getElementById('myModal');
            modal.style.display = "none";
        }
    </script>
@endsection
