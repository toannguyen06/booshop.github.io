<!--header-->

<div class="header">
    <div class="top-header">
        <div class="container">
            <div class="top-header-left">
                <ul class="support">
                    <li><a href="#"><label> </label></a></li>
                    <li><a href="#">24x7 live<span class="live"> support</span></a></li>
                </ul>
                <ul class="support">
                    <li class="van"><a href="#"><label> </label></a></li>
                    <li><a href="#">Free shipping <span class="live">on order over 500</span></a></li>
                </ul>
                <div class="clearfix"> </div>
            </div>
            <div class="top-header-right">
                @auth
                <div class="down-top top-down">
                    <a href="{{url('/logout')}}" class="logout" ><i class="fas fa-sign-out-alt"></i> ĐĂNG XUẤT</a>
               </div>
                @endauth
                
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

    <div class="bottom-header">
        <div class="container">
            <div class="d-flex justify-content-beetween">
                <div class="logo">
                    <a href="{{url('/')}}" class="" ><img src="{{asset('frontend/images/logo.png')}}" alt=" " height="50px" /></a>
                </div>
                
                <div class="header-bottom-left-menu">
                    <ul class="header-bottom-left-menu-content">
                        <li class="header-bottom-left-menu-content-li"><a href="{{url('/introduce')}}">Giới thiệu</a></li>
                        
                        <li class="header-bottom-left-menu-content-li"><a href="">Danh mục</a>
                            <ul class="header-bottom-left-menu-content-li-ul category">
                                @foreach ($categories as $category)
                                    <li>
                                        <div><strong style="color: #555">{{$category->name}}</strong> </div>
                                        <div class="list-category-parent">
                                            @foreach ($category->subCategory as $subCate)
                                                <a href="{{url('category/'.$category->id.'/'.'sub_category/'.$subCate->id.'/products')}}" class="mx-2 d-block">{{$subCate->name}} </a>
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="header-bottom-left-menu-content-li"><a href="">Dịch vụ</a>
                            <ul class="header-bottom-left-menu-content-li-ul">
                                <li><a href="{{url('/contact')}}">Liên Hệ</a></li>
                                <li><a href="{{url('/terms')}}">Điều khoản sử dụng</a></li>
                                <li><a href="{{url('/security')}}">Chính sách bảo mật</a></li>
                                <li><a href="{{url('/introduce')}}">Giới thiệu Book - Shop</a></li>
                            </ul>
                        </li>

                        <li class="header-bottom-left-menu-content-li"><a href="">Hỗ trợ</a>
                            <ul class="header-bottom-left-menu-content-li-ul">
                                <li><a href="{{url('/change')}}">Chính sách đổi - trả - hoàn tiền</a></li>
                                <li><a href="{{url('/buys')}}">Chính sách khách sỉ</a></li>
                                <li><a href="{{url('/transport')}}">Phương thức vận chuyển</a></li>
                                <li><a href="#">Phương thức thanh toán và xuất HĐ</a></li>
                            </ul>
                        </li>

                        <li class="header-bottom-left-menu-content-li"><a href="{{url('/contact')}}">Liên hệ</a></li>
                    </ul>
                </div>
                
                <div class="search">
                    <form class="form-search" action="{{url('/search')}}">
                        <input type="text" name="search" autocomplete="off" id="search-content" value="" placeholder="Tìm kiếm theo tên sách" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
                        {{-- <ul class="search-list">
                        </ul> --}}
                        {{-- <input type="submit" id="search-btn"  value="SEARCH"> --}}
                    </form>
                </div>
                <div class="header-bottom-right"> 
                    <div class="cart">
                        <a href="{{url('/cart')}}" class="position-relative">
                            <span><i class="fa-solid fa-cart-shopping"></i></span>
                            {{-- CART --}}
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-quantity" style="display:none">
                            </span>
                        </a>
                        <div class="cart-container">
                            <ul id="cart-list-item">

                            </ul>
                            <a class="link-cart" href="{{url('/cart')}}">XEM GIỎ HÀNG</a>
                        </div>
                    </div>

                    @if (Auth::check())
                    <div class="account">
                        <a href="{{url('/profile')}}" class="position-relative">
                            <span><i class="fa-solid fa-user"></i></span>
                            {{Auth::user()->information->fullname}}
                        </a>
                    </div>
                        {{-- <div class="account"><a href="#"><span><i class="fa-solid fa-user"></i> </span>{{Auth::user()->information->fullname}}</a></div> --}}
                    @else
                    <ul class="login">
                        <li><a href="{{url('/login')}}"><span><i class="fa-solid fa-lock"></i></span>ĐĂNG NHẬP</a></li> |
                        <li ><a href="{{url('/register')}}">ĐĂNG KÝ</a></li>
                    </ul>
                    @endif
                <div class="clearfix"> </div> 
                </div>
            </div>
        </div>
    </div>
    
</div>
