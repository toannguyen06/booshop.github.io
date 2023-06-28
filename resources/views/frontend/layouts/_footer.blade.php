<div class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="latter">
                <h6>ĐĂNG KÍ NHẬN TIN</h6>
                <div class="sub-left-right">
                    <form>
                        <input type="text" value="Enter email here"onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter email here';}" />
                        <input type="submit" value="SUBSCRIBE" />
                    </form>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="latter-right">
                <p>FOLLOW US</p>
                <ul class="face-in-to">
                    <li><a href="#"><span> </span></a></li>
                    <li><a href="#"><span class="facebook-in"> </span></a></li>
                    <div class="clearfix"> </div>
                </ul>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-cate">
                <h6>DANH MỤC</h6>
                <ul>
                    @foreach ($categories as $category)
                        <li>
                            <div><strong style="color: #555">{{$category->name}}</strong> </div>
                            @foreach ($category->subCategory as $subCate)
                                <a href="{{url('category/'.$category->id.'/'.'sub_category/'.$subCate->id.'/products')}}" class="mx-2 d-block">{{$subCate->name}} </a>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-bottom-cate bottom-grid-cat footer-bottom-cate1">
                <h6>DỊCH VỤ</h6>
                <ul>
                    <li><a href="{{url('/contact')}}">Liên Hệ</a></li>
                    <li><a href="{{url('/terms')}}">Điều khoản sử dụng</a></li>
                    <li><a href="{{url('/security')}}">Chính sách bảo mật</a></li>
                    <li><a href="{{url('/introduce')}}">Giới thiệu Book - Shop</a></li>
                </ul>
            </div>
            <div class="footer-bottom-cate footer-bottom-cate2">
                <h6>HỖ TRỢ</h6>
                <ul>
                    <li><a href="{{url('/change')}}">Chính sách đổi - trả - hoàn tiền</a></li>
                    <li><a href="{{url('/buys')}}">Chính sách khách sỉ</a></li>
                    <li><a href="{{url('/transport')}}">Phương thức vận chuyển</a></li>
                    <li><a href="#">Phương thức thanh toán và xuất HĐ</a></li>
                </ul>
            </div>
            <div class="footer-bottom-cate cate-bottom footer-bottom-cate3">
                <h6>ĐỊA CHỈ CỬA HÀNG</h6>
                <ul >
                    <li style="color: #555">Số 38, ngách 23/57 đường Thanh Liệt </li>
                    <li style="color: #555">Thanh Liệt, Thanh Trì, Hà Nội</li>
                    <li style="color: #555">Email : bookshop.gmail.com</li>
                    <li class="phone">SĐT : 6985792466</li>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232.8567253204141!2d105.81422552996186!3d20.964254190652355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad1db6c6ddc1%3A0x66eca8ac79f611ca!2zVGhhbmggTGnhu4d0LCBUaGFuaCBUcsOsLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1686668315895!5m2!1svi!2s" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>