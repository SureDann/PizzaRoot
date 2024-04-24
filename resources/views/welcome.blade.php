@extends('layout')
@section('title', 'PizzaRoot')
@section('content')
    <div style="margin-top: 50px; margin-left: 150px; font-size: 30pt; position: absolute">
        <p class="fw-bold">PizzaRoot.</p><p class="fw-medium"> - Very super cool pizza magazin.</p>
        <p class="fw-medium">buy any pizza that you want</p>
        <p class="fw-medium">and you never be refused</p>
        <button type="button" class="btn btn-primary btn-lg">Take a pizza!</button>
    </div>
    @include('includes.slide')

    @auth
        @foreach(\App\Models\User::all() as $user)
        @endforeach
    @else

    @endauth


@foreach($category as $cat)
    <div style="display: flex; justify-content: space-between; margin-top: 570px" >
        <div class="card mb-3 shadow p-3 mb-5 bg-body-tertiary rounded" style="max-width: 540px; margin-top: 50px; margin-left: 30px;position: absolute">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{asset("storage/".$cat->image)}}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$cat->name}}</h5>
                        <p class="card-text">{{$cat->description}}</p>
                        <p class="card-text"><small class="text-body-secondary">By PizzaRoot</small></p>
                        <a class="btn btn-primary" href="{{route('pizza_view', ['pk'=>$cat->id])}}" role="button">Go To Category</a>


                    </div>
                </div>
            </div>
        </div>
        @endforeach


@endsection
