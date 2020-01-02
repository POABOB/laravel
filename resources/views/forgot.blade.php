@extends('login._base')
@section('title', '彰師大二手書交易平台-忘記密碼')
@section('style')
<style >
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
                    <li><a href="{{ url('/login') }}">登入</a></li>
                    <!-- <li><a href="#"></a></li> -->
                    <li><a href="{{ url('/cart') }}">購物車</a></li>
                    <li><a href="{{ url('/') }}">首頁</a></li>
                </ul>
            </nav>
        </header>
@stop
@section('container')
        <div class="box">

            <div class="smallbox">
                <form action="{{ url('/forgot') }}" method="post">
                    <h2>忘記密碼</h2>
                    {{ csrf_field() }}
                   <div>
                       <input type="text" name="email" placeholder="請輸入Email..." value="{{ old('email') }}" id="email">
                       <input type="submit" style="margin-bottom: 0px;" name="submit" value="送出">
                   </div>
                   @if($errors->any())
                            @foreach($errors->all() as $error)
                                <p style="margin-top: 0px;">{{ $error }}</p>
                             @endforeach
                    @endif
                    @if(session('msg'))
                        <p style="color:green; margin-top: 0px;">{{ session('msg') }}</p>
                    @endif
                    @if(session('err'))
                        <p style="margin-top: 0px;">{{ session('err') }}</p>
                    @endif
               </form>
           </div>
        </div>
@stop
@section('script')
<script>
</script>
@stop