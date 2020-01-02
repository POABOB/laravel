<!-- {% extends "post/base.html" %}
    {% block title %}訊息{% endblock %}
    {% block legend %}訊息{% endblock %}
    {% block content %} -->
        <!-- Section One -->
    <div class="wrapper style2">
        <section class="container">
            <div class="row double">
                <div class="6u">
                    <div class="align">
                       {{ $msg }}<span id="show"></span>
                        <input type="hidden" id="url" value=" {{ $url }}">
                        <input type="hidden" name="time" id="time" value="{{ $time }}">
                    </div>
                </div>

            </div>
        </section>
    </div>
<!-- 
    {% endblock %}
    {% block script %} -->
    <script>
　　var t=document.getElementById("time").value;
//設定跳轉的時間
　　setInterval("refer()",1000); //啟動1秒定時
　　function refer(){
　　　　if(t==0){
　　　　　　location=document.getElementById("url").value; //#設定跳轉的鏈接地址
　　　　}
　　　　document.getElementById('show').innerHTML=""+t+"秒後跳轉..."; // 顯示倒>計時
　　　　t--; // 計數器遞減
　　}
    </script>

<!--     {% endblock %} -->
