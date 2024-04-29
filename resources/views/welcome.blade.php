@extends('layout')
@section('title', 'PizzaRoot')
@section('content')

    <div style="margin-left: 40px; font-size: 30pt; padding-top: 70px">
        <p class="fw-bold">PizzaRoot.</p><p class="fw-medium">@lang('welcome.pizza_text1')</p>
        <p class="fw-medium">@lang('welcome.pizza_text2')</p>
        <p class="fw-medium">@lang('welcome.pizza_text3')</p>
        <button type="button" class="btn btn-primary btn-lg">@lang('welcome.take_a_pizza')</button>
    </div>
    @include('includes.slide')

    @auth
        @foreach(\App\Models\User::all() as $user)
        @endforeach
    @else

    @endauth


    <div style="display: flex; flex-wrap: wrap; margin-top: 330px">
        @foreach($category as $cat)
            <div style="width: 600px; margin: 15px;">
                <div class="card mb-3 shadow p-3 mb-5 bg-body-tertiary rounded">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset("storage/".$cat->image)}}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                @if(\Illuminate\Support\Facades\Session::get('locale')=='ru')
                                    <h5 class="card-title">{{$cat->name_ru}}</h5>
                                    <p class="card-text">{{$cat->description_ru}}</p>

                                @else
                                    <h5 class="card-title">{{$cat->name}}</h5>
                                    <p class="card-text">{{$cat->description}}</p>

                                @endif

                                <p class="card-text"><small class="text-body-secondary">By PizzaRoot</small></p>
                                <a class="btn btn-primary" href="{{route('pizza_view', ['pk'=>$cat->id])}}" role="button">@lang('welcome.GoToCat')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


@endsection
