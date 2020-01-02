@extends('login._base')
@section('title', '彰師大二手書交易平台-重設密碼')
@section('style')
<style>
    .box{
        height: 260px;
        width: 400px;
        display: flex;

    }
    .smallbox{
        display: inline-flex;
        height: 100%;
        width: 100%;
        text-align: center;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }
</style>
@stop
@section('nav')
<header>
        <nav>
            <div class="logo-section">
                <a href="{{ url('/') }}" class="logo">MARKET</a>
                <button class="hb-button"><i class="fa fa-bars"></i></button>
            </div>
            <ul>
                <li><a href="{{ url('/cart') }}">購物車</a></li>
                <li><a href="{{ url('/') }}">首頁</a></li>
            </ul>
        </nav>
    </header>
@stop
@section('container')
<div class="box">
    <div class="smallbox">
        <form action="{{ url('reset_password') }}" method="POST">
        	<h2>密碼重設</h2>
            {{ csrf_field() }}
        	<input type="password" name="password" placeholder="請再輸入密碼..."placeholder="請輸入密碼..."
    >
        	<input type="password" name="passconf" placeholder="請再輸入密碼...">
        	<input type="submit" style="margin-bottom: 0px;" name="submit" value="送出">
            @if($errors->any())
                            @foreach($errors->all() as $error)
                                <p style="margin-top: 0px;">{{ $error }}</p>
                                @break
                             @endforeach
            @endif
        </form>
    </div>
</div>
@stop