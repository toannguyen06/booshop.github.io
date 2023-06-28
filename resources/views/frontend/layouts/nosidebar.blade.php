<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png')}}" />
    <title>@yield('title')</title>
    <!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!--//fonts-->
    <link rel="stylesheet" href="{{asset('assets/libs/bootstrap/dist/css/bootstrap.css')}}">
    {{-- <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('link-css')
    <!--theme-style-->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />	
    <!--//theme-style-->
    @stack('css')
    
</head>
<body>
    @include('frontend.layouts._header')
    <div class="container">
        <div class="row mt-4">
            
            <div >
                @yield('content')
            </div>
        </div>
       
    </div>
    @include('frontend.layouts._footer')


    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js" integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @stack('link-js')
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Code injected by live-server -->
    <script type="text/javascript">
        // <![CDATA[  <-- For SVG support
        if ("WebSocket" in window) {
            (function () {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if ((elem.href && typeof rel != "string") || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, "");
                            elem.href = url + (url.indexOf("?") >= 0 ? "&" : "?") + "_cacheOverride=" + new Date().valueOf();
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === "http:" ? "ws://" : "wss://";
                var address = protocol + window.location.host + window.location.pathname + "/ws";
                var socket = new WebSocket(address);
                socket.onmessage = function (msg) {
                    if (msg.data == "reload") window.location.reload();
                    else if (msg.data == "refreshcss") refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem("IsThisFirstTime_Log_From_LiveServer")) {
                    console.log("Live reload enabled.");
                    sessionStorage.setItem("IsThisFirstTime_Log_From_LiveServer", true);
                }
            })();
        } else {
            console.error("Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.");
        }
        // ]]>
    </script>
    <!--initiate accordion-->
    <script type="text/javascript">
        $(function () {
            var menu_ul = $(".menu > li > ul"),
                menu_a = $(".menu > li > a");
            // menu_ul.hide();
            menu_a.click(function (e) {
                e.preventDefault();
                if (!$(this).hasClass("active")) {
                    menu_a.removeClass("active");
                    menu_ul.filter(":visible").slideUp("normal");
                    $(this).addClass("active").next().stop(true, true).slideDown("normal");
                } else {
                    $(this).removeClass("active");
                    $(this).next().stop(true, true).slideUp("normal");
                }
            });
        });
    </script>
    <script>
        function loadCart (){
            axios.get('/getCart')
                .then(function(res){
                    var html = ''
                    var html1 = ''
                    if(res.data.cart.length){
                        res.data.cart.forEach(function(item){
                            // console.log(item);
                            html += `<li class="cart-item">
                                            <img src="{{asset('storage/products/${item.img}')}}" alt="">
                                            <div class="item-name">
                                                ${item.name}
                                            </div>
                                            <div class="quantity-price">
                                                <div class="quantity">
                                                    <label for="">Số lượng: </label>
                                                    <input type="number" name="quantity" data-id="${item.id}" value="${item.quantity}" class="cart-top-quantity">
                                                </div>
                                                <span class="price">${item.price * item.quantity} VNĐ</span>
                                            </div>
                                            <div class="remove" data-id="${item.id}">x</div>
                                        </li>`
                            html1 += `<tr class="cart-table-item">
                                        <td><button data-id="${item.id}" class="btn btn-danger table-cart-remove">x</button></td>
                                        <td class="table-item-name">
                                            <img src="{{asset('storage/products/${item.img}')}}" alt="">
                                            <p>${item.name}</p>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity" data-id="${item.id}" class="cart-quantity" value="${item.quantity}" min="1">
                                        </td>
                                        <td>${item.price} VNĐ</td>
                                        <td>${item.price * item.quantity} VNĐ</td>
                                    </tr>`
                        })
                    } else {
                        html1 = `<tr>
                                    <td colspan="5"><p class="text-center">Giỏ hàng trống. <a href="{{url('/')}}">Mua hàng ngay.</a></p></td>
                                </tr>`
                        html = `<img src="{{asset('frontend/images/nothing.png')}}" alt="" width="100px">
                                <p>Giỏ hàng trống</p>`
                    }
                    $('#cart-list-item').html(html);
                    $('#cart-quantity').html($('#cart-list-item').children('li').length)
                    $('#cart-quantity').show();
                    $('#cart-data').html(html1);
                    $('#total-price').html(res.data.totalPrice)
                })
                .catch(function(res){
                    console.log(res)
                })
        }
    </script>
    <script>loadCart()</script>
    <script>
        $('#cart-list-item').on('click', '.remove', function(){
            console.log(this.dataset.id);
            axios.delete('/cart', { data: { id: this.dataset.id } })
                .then(function(res){
                    loadCart();
                })
                .catch(function(res){
                    console.log(res);
                })
        })
        $('#cart-list-item').on('change', '.cart-top-quantity', function(){
            console.log(this.value);
            axios.put('/cart', {id: this.dataset.id, quantity: this.value})
                .then(function(res){
                    loadCart();
                })
                .catch(function(res){
                    console.log(res);
                })
        })
    </script>
    <script>
        $('#search-btn').click(function(){
            if (window.localStorage.getItem('history')){
                var history = JSON.parse(window.localStorage.getItem('history'))
                if (!history.includes($(this).siblings('#search-content').val())) {
                    history.unshift($(this).siblings('#search-content').val())
                    window.localStorage.setItem('history', JSON.stringify(history))
                }
            } else {
                var history = [$(this).siblings('#search-content').val()]
                window.localStorage.setItem('history', JSON.stringify(history))
            }

        })
        function loadHistory(){
            if (window.localStorage.getItem('history')){
                var history = JSON.parse(window.localStorage.getItem('history'))
                var html = ""
                history.forEach(function(item){
                    html += `<li class="search-list-item">
                                <i class="fas fa-history"></i>
                                <a href="search?search=${item}">${item}</a>
                            </li>`
                })
                $('.search-list').html(html)
            } else {
                $('.search-list').html('Lịch sử trống')
            }
        }
        loadHistory();
        $('.search').blur(function(e){
            $(this).find('.search-list').hide();
        })
        $('.search').click(function(){
            $(this).find('.search-list').show();
        })
    </script>
    @stack('js')
</body>
</html>