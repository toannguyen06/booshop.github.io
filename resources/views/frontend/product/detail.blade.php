@extends('frontend.layouts.main')

@section('title')
    {{$product->information->name}}
@endsection
@push('link-css')
<link rel="stylesheet" href="{{asset('frontend/css/etalage.css')}}" type="text/css" media="all" />
@endpush
@push('css')
<style>
    .comment-list-item{
        display: flex;
        /* align-items: center; */
        padding: 6px 12px;
        background-color: #f0f0f0;
        border-radius: 10px;
        margin-bottom: 8px;
    }
    .comment-content{
        font-size: 14px;
        margin-left: 10px; 
    }
    .comment-content input{
        width: 100%;
    }
    .comment-name{
        font-weight: bold;
        margin-left: 10px;
    }
    .comment-control{
        width: 40px;
        margin-left: 10px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .comment-control .sub{
        display: none;
        position: absolute;
        top:80%;
        right: 50%;
    }
    .comment-control .sub div{
        border: 1px solid black;
        padding: 2px 4px;
        font-size: 12px;
        line-height: 14px;
    }
    .comment-control .sub div:hover{
        background-color: blue;
        color: white;
        cursor: pointer;
    }
    .comment{
        padding: 6px 12px;
    }
    .comment .form{
        flex: 1;
        margin-left: 10px;
        display: flex;
        align-items: flex-start;
    }
    .comment .form button {
        margin-left: 10px;
    }
    .decs.hide p{
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
    .decs{
        color: #707070;
        position: relative;
    }
    .more{
        /* position: absolute;
        bottom: -2px;
        left: 0; */
        width: 100%;
        text-align: center;
        cursor: pointer;
        /* backdrop-filter: blur(2px); */
        color: blue;
    }
</style>
    
@endpush
@section('content')
<div class="content">
    <div class="single_grid">
        <div class="grid images_3_of_2">
            <ul id="etalage">
                @foreach ( $product->image as $img)
                <li>
                    <img class="etalage_thumb_image" src="{{asset('storage/products/'.$img->path)}}" class="img-responsive" />
                    <img class="etalage_source_image" src="{{asset('storage/products/'.$img->path)}}" class="img-responsive" title="" />
                </li>
                @endforeach
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="desc1 span_3_of_2">
            <h4 style="font-weight: bold">{{$product->information->name}}</h4>
            <div class="cart-b">
                <div class="left-n">{{$product->price}} VNĐ</div>
                <div class="quantity">
                    <label for="">Số lượng</label>
                    <input type="number" name="quantity"  id="quantity" value="1">
                </div>
                <a class="now-get get-cart-in" id="add-cart" data-product="{{$product->id}}">MUA NGAY</a>
            </div>
            <h6 style="font-size: 1.1em; color: #888">Tình trạng: {{$product->quantity > 0 ? 'Còn hàng' : 'Hết hàng'}}</h6>
            <p>
                <strong>Tác giả: </strong> {{$product->information->author}}<br>
                <strong>Nhà xuất bản: </strong> {{$product->information->published}}<br>
                <strong>Ngôn ngữ: </strong> {{$product->information->language}}<br>
                <strong>Năm xuất bản: </strong> {{$product->information->year}}<br>
            </p>
            {{-- <div class="share">
                <h5>Share Product :</h5>
                <ul class="share_nav">
                    <li>
                        <a href="#"><img src="images/facebook.png" title="facebook" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="images/twitter.png" title="Twiiter" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="images/rss.png" title="Rss" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="images/gpluse.png" title="Google+" /></a>
                    </li>
                </ul>
            </div> --}}
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="toogle">
        <h3 class="m_3">Mô tả sản phẩm</h3>
        <div class="decs hide">
            {!! $product->information->decs !!}
            <div class="more">
                Xem thêm
            </div>
        </div>
    </div>
</div>
<div class="content mt-4">
    <h5>Bình luận</h5>
    <ul class="comment-list">
    </ul>
    <div class="comment d-flex">
        @if (Auth::check())
            @if (Auth::user()->information->avatar)
                <img src="{{asset('storage/avatars/'.Auth::user()->information->avatar)}}" class="rounded-circle" width="50" height="50" alt="">
            @else
                <img src="{{asset('assets/images/users/user.jpg')}}" class="rounded-circle" width="50" height="50"/>
            @endif
            <div class="form" >
                <textarea name="comment" id=""  class="form-control" placeholder="Viết bình luận ..." ></textarea>
                <button class="btn btn-success" data-product="{{$product->id}}" id="send-comment">Gửi</button>
            </div>
        @else
            <p class="text-center">Đăng nhập để viết bình luận. <a href="{{url('/login')}}">Đăng nhập</a></p>
        @endif
            
            
    </div>
</div>


@endsection
@section('content-botttom')
<div class="labels">
    <h5 class="latest-product">SẢN PHẨM CÙNG THỂ LOẠI</h5>
    <a class="view-all" href="product.html">XEM TẤT CẢ<span> </span></a>
</div>
<div class="content mt-4">
    <div class="p-4">
        <ul id="flexiselDemo1">
            @foreach ($productsSame as $productSame)
                <li>
                    <div style="padding: 0 20px">
                        <div class="chain-grid" style="">
                            <a href="{{url('products/'.$productSame->id)}}" class="chain-container"><img class="img-responsive chain" src="{{asset('storage/products/'.$productSame->image[0]->path)}}" alt=" " /></a>
                            <span class="star"> </span>
                            <div class="grid-chain-bottom mb-3">
                                <h6><a href="{{url('products/'.$productSame->id)}}">{{$productSame->information->name}}</a></h6>
                                
                            </div>
                        </div>
                    </div>
                    
                </li>
            @endforeach
        </ul>
    </div>
    
</div>
@endsection
@push('link-js')
<script src="{{asset('frontend/js/jquery.etalage.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/jquery.flexisel.js')}}"></script>
@endpush
@push('js')
<script>
    jQuery(document).ready(function($){

        $('#etalage').etalage({
            thumb_image_width: 300,
            thumb_image_height: 400,
            source_image_width: 900,
            source_image_height: 1200,
            show_hint: true,
            click_callback: function(image_anchor, instance_id){
                alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
            }
        });

    });
</script>
<script type="text/javascript">
    $(window).load(function() {
       $("#flexiselDemo1").flexisel({
           visibleItems: 4,
           animationSpeed: 1000,
           autoPlay: true,
           autoPlaySpeed: 3000,    		
           pauseOnHover: true,
           enableResponsiveBreakpoints: true,
           responsiveBreakpoints: { 
               portrait: { 
                   changePoint:480,
                   visibleItems: 1
               }, 
               landscape: { 
                   changePoint:640,
                   visibleItems: 2
               },
               tablet: { 
                   changePoint:768,
                   visibleItems: 3
               }
           }
       });
       
   });
 </script>

 <script>
     function loadComment(){
         var product_id = {{$product->id}};
         var user = {}
         user.id = {{Auth::user() ? Auth::user()->id : 0}}
         user.role = '{{Auth::user() ? Auth::user()->role : 10}}'
         var url = "/comment/product/" + product_id
         axios.get(url)
            .then((res) => {
                var htmls = "";
                var html = ""
                res.data.forEach(function(comment){
                    if (user.id == comment.user_id){
                        html = `<li class="comment-list-item" data-comment="${comment.id}">
                                <img src="{{asset('storage/avatars/${comment.avatar}')}}" class="rounded-circle" width="50" height="50"/>
                                <div style="flex:1">
                                    <div class="comment-name">
                                        ${comment.username ? comment.username : 'Người dùng'}
                                    </div>
                                    <div class="comment-content">
                                        ${comment.comment}
                                    </div>
                                </div>
                                <div class="comment-control">
                                    <i class="fas fa-ellipsis-v" style="padding: 8px 14px; cursor: pointer;"></i>
                                    <div class="sub">
                                        <div class="fix">Sửa</div>
                                        <div class="delete">Xóa</div>
                                    </div>
                                </div>
                            </li>`
                    } else {
                        if (user.role == 'RootAdmin' || user.role == 'Admin'){
                            html = `<li class="comment-list-item" data-comment="${comment.id}">
                                <img src="{{asset('storage/avatars/${comment.avatar}')}}" class="rounded-circle" width="50" height="50"/>
                                <div style="flex:1">
                                    <div class="comment-name">
                                        ${comment.username ? comment.username : 'Người dùng'}
                                    </div>
                                    <div class="comment-content">
                                        ${comment.comment}
                                    </div>
                                </div>
                                <div class="comment-control">
                                    <i class="fas fa-ellipsis-v" style="padding: 8px 14px; cursor: pointer;"></i>
                                    <div class="sub">
                                        <div class="delete">Xóa</div>
                                    </div>
                                </div>
                            </li>`
                        }
                        else {
                            html = `<li class="comment-list-item" data-comment="${comment.id}">
                                <img src="{{asset('storage/avatars/${comment.avatar}')}}" class="rounded-circle" width="50" height="50"/>
                                <div style="flex:1">
                                    <div class="comment-name">
                                        ${comment.username ? comment.username : 'Người dùng'}
                                    </div>
                                    <div class="comment-content">
                                        ${comment.comment}
                                    </div>
                                </div>
                            </li>`
                        }
                    }
                    htmls += html
                })
                $('.comment-list').html(htmls);
            })
            .catch((res) => {
                console.log(res);
            })
     }
 </script>
 <script>loadComment();</script>
 <script>
        $('#add-cart').click(function(){
            axios.post('/cart', {
                product_id: $(this).data('product'),
                quantity: $(this).siblings('.quantity').children('#quantity').val()
            })
            .then(function (response) {
                loadCart();
                swal("Thành công!", "Thêm sản phẩm vào giỏ hàng thành công!", "success")
            })
            .catch(function (error) {
                console.log(error);
            });
        })
        $('#send-comment').click(function(){
            axios.post('/comment', {
                comment : $(this).siblings('textarea').val(),
                product : $(this).data('product')
            })
                .then((res) => {
                    loadComment()
                })
                .catch((res) => {
                    console.log(res);
                })
        })
     
    //  $(function(){
    //      $('#add-cart').click
    //  })
    $('.comment-list').on('click', '.comment-control', function(){
        $(this).children('.sub').toggle()
    })
    $('.comment-list').on('click', '.fix', function(){
        var commentNode = $(this).parents('.comment-list-item');
        var content = commentNode.find('.comment-content');
        var oldVal = content.text();
        html = `<input type="text">`
        content.html(html)
        content.children('input').focus();
        commentNode.on('keyup', 'input',function(e){
            if(e.keyCode == 13)
            {
                // console.log($(this).val());
                var url = '/comment/' + commentNode.data('comment')
                // console.log(url);
                axios.put(url, {content: $(this).val()})
                    .then((res) => {
                        loadComment();
                    })
                    .catch((res) => {
                        console.log(res);
                    })
            }
        });
    })
    $('.comment-list').on('click', '.delete', function(){
        var commentNode = $(this).parents('.comment-list-item');
        var url = '/comment/' + commentNode.data('comment')
                // console.log(url);
                axios.delete(url)
                    .then((res) => {
                        loadComment();
                    })
                    .catch((res) => {
                        console.log(res);
                    })
    })
    $('.more').click(function(){
        $(this).parents('.decs').toggleClass('hide')
        if (!$(this).parents('.decs').hasClass('hide')){
            $(this).text('Ẩn bớt')
        } else {
            $(this).text('Xem thêm')
        }
    })
 </script>
 
@endpush