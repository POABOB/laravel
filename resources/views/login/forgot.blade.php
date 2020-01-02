<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>忘記密碼</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('/resources/views/login/static/style.css') }}">
    <!-- hreader -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/resources/views/login/static/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <script type="text/javascript" src="{{ asset('/resources/views/login/static/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/resources/views/login/static/responsive_navbar.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/resources/views/login/static/responsive_navbar.css') }}">
    </head>
    <body>
        <header>
            <nav>
                <div class="logo-section">
                    <a href="#" class="logo">MARKET</a>
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
        <div class="box">
            <form action="{{ url('/forgot') }}" method="post">
                {{ csrf_field() }}
                
               <input type="email" name="email" id="email">
               <button type="submit">送出</button>
               @if($errors->any())
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            </ul>
                                @endforeach
                        </div>
                @endif
                @if(session('msg'))
                    <p style="color:green;">{{ session('msg') }}</p>
                @endif
                @if(session('err'))
                    <p style="color:red;">{{ session('err') }}</p>
                @endif
           </form>
        </div>
    </body>
</html>