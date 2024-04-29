

<style>
    .conteiner {
        padding-top: 80px;
    }
</style>
@extends('layout')
@section('title', 'Registration')
@section('content')
    <div class="conteiner">
        <div class="mt5">
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
                <label class="form-label">@lang('auth.full_name')</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label">@lang('auth.email')</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">@lang('auth.password')</label>
                <input type="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-primary">@lang('auth.register')</button>
        </form>
    </div>
@endsection
