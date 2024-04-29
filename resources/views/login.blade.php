
<style>
    .conteiner {
        padding-top: 80px;
    }
</style>
@extends('layout')
@section('title', 'Login')
@section('content')
    <div class="conteiner" style="">
        <div class="mt5">
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger"><p style="text-align: center">{{$error}}</p>}</div>
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
        <div>
            <form action="{{route('login_post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px">
                @csrf
                <div class="mb-3">
                    <label class="form-label">@lang('auth.email')</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">@lang('auth.password')</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary">@lang('auth.login')</button>     <div  style="margin-left: 200px; margin-top: -30px; margin: 0; padding:0"><h5>@lang('auth.not_registered?')</h5> <a class="btn btn-primary" href="{{route('registration_view')}}" role="button">@lang('auth.register')</a></div>


            </form>

        </div>




    </div>
@endsection


