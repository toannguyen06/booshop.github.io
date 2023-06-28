@extends('frontend.layouts.main')
@section('title')
    Trang chủ
@endsection
@push('link-css')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush
@push('css')
    <style>
        .carousel-control-prev, .carousel-control-next{
            background: transparent;
            border: none;
        }
        .swiper-slide img{
            width: 100%;
        }
    </style>
@endpush
@section('content')
<div class="shoes-grid">
    <a href="single.html"> </a>
    <div class="wrap-in mb-4">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('frontend/images/main_920_x_420_2.png')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('frontend/images/PayDay_T1021_mainbanner__920x420.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('frontend/images/TrangManga920x420.png')}}" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <a href="">
                <img src="{{asset('frontend/images/moca_310.jpg')}}" alt="" style="width:100%" srcset="">
            </a>
        </div>
        <div class="col-md-4">
            <a href="">
                <img src="{{asset('frontend/images/bo 4  310 x 210.png')}}" alt="" style="width:100%">
            </a>
        </div>
        <div class="col-md-4">
            <a href="">
                <img src="{{asset('frontend/images/bo 1  310 x 210.png')}}" alt="" style="width:100%">
            </a>
        </div>
    </div>
</div>



@endsection
@section('content-botttom')
<div class="product-left content mt-5">
    <h5 class="mt-2"><strong>SẢN PHẨM MỚI</strong></h5>
    <hr>
    <div class="row">
        @foreach ($lastestProducts as $lastestProduct)
        <div class="col-md-3">
            <div class="product-container">
                <a href="{{url('products/'.$lastestProduct->id)}}" class="chain-container"><img class="img-responsive chain" src="{{asset('storage/products/'.$lastestProduct->image[0]->path)}}" alt=" " /></a>
                <span class="star"> </span>
                <div class="grid-chain-bottom">
                    <h6><a href="{{url('products/'.$lastestProduct->id)}}">{{$lastestProduct->information->name}}</a></h6>
                    <div class="star-price">
                        <div class="dolor-grid" style="flex:1">
                            @if ($lastestProduct->price_sale)
                            <div>
                                <span class="actual" >{{$lastestProduct->priceSaleFormat}} đ</span>
                                <span class="reducedfrom">{{$lastestProduct->priceFormat}}đ</span>
                            </div>
                            @else
                                <span class="actual" >{{$lastestProduct->priceFormat}} đ</span>
                            @endif
                            <ul class="rating">
                                <li><i class="{{$lastestProduct->rate >= 1 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                <li><i class="{{$lastestProduct->rate >= 2 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                <li><i class="{{$lastestProduct->rate >= 3 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                <li><i class="{{$lastestProduct->rate >= 4 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                <li><i class="{{$lastestProduct->rate >= 5 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                            </ul>
                        </div>
                        <a class="now-get add-cart" data-product="{{$lastestProduct->id}}">MUA NGAY</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="product-left content mt-5">
    <h5 class="mt-2"><strong>SẢN PHẨM BÁN CHẠY</strong></h5>
    <hr>
    <div class="row">
        @foreach ($sellingProducts as $sellingProduct)
        <div class="col-md-3">
            <div class="product-container">
                <a href="{{url('products/'.$sellingProduct['product']->id)}}" class="chain-container"><img class="img-responsive chain" src="{{asset('storage/products/'.$sellingProduct['product']->image[0]->path)}}" alt=" " /></a>
                <span class="star"> </span>
                <div class="grid-chain-bottom">
                    <h6><a href="{{url('products/'.$sellingProduct['product']->id)}}">{{$sellingProduct['product']->information->name}}</a></h6>
                    <div class="star-price">
                        <div class="dolor-grid" style="flex: 1">
                            @if ($sellingProduct['product']->price_sale)
                            <div>
                                <span class="actual" >{{$sellingProduct['product']->priceSaleFormat}} đ</span>
                                <span class="reducedfrom">{{$sellingProduct['product']->priceFormat}}đ</span>
                            </div>
                            @else
                                <span class="actual" >{{$sellingProduct['product']->priceFormat}} đ</span>
                            @endif
                            <ul class="rating">
                                <li><i class="{{$sellingProduct['product']->rate >= 1 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                <li><i class="{{$sellingProduct['product']->rate >= 2 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                <li><i class="{{$sellingProduct['product']->rate >= 3 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                <li><i class="{{$sellingProduct['product']->rate >= 4 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                <li><i class="{{$sellingProduct['product']->rate >= 5 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                            </ul>
                        </div>
                        <a class="now-get add-cart" data-product="{{$sellingProduct['product']->id}}">MUA NGAY</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="content mt-5">
    <!-- Swiper -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/macgrawhill.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/macmillan.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/oxford.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/paragon.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/penguin.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/sterling.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/usborn.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/Harper-Collins.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/hachette.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/cengage.jpg')}}" alt="">
          </div>
          <div class="swiper-slide">
              <img src="{{asset('frontend/images/cambridge.jpg')}}" alt="">
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
</div>
@endsection
@push('link-js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endpush
@push('js')
<script>
        $('.add-cart').click(function(){
            console.log($(this).data('product'));
            axios.post('/cart', {
                product_id: $(this).data('product'),
                quantity: 1
            })
            .then(function (response) {
                loadCart();
                swal("Thành công!", "Thêm sản phẩm vào giỏ hàng thành công!", "success")
            })
            .catch(function (error) {
                console.log(error);
            });
        })

        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 7,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
</script>
@endpush