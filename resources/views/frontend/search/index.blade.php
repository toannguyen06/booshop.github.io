@extends('frontend.layouts.main')
@section('title')
 Kết quả tìm kiếm
@endsection
@section('content')
<div class="content">
    <div class="shoes-grid">
        <h5>Kết quả tìm kiếm cho: {{$search}}</h5>
        <div class=" w_content">
            <div class="women">
                <ul class="w_nav">
                    <li>Sort : </li>
                     <li><a href="?sort=popular" style="{{Request::get('sort') == 'popular' ? 'color: rgb(29, 186, 165)' : ''}}">Phổ biến</a></li> |
                     <li><a href="?sort=new" style="{{Request::get('sort') == 'new' ? 'color: rgb(29, 186, 165)' : ''}}">Mới </a></li> |
                     <li><a href="?sort=discount" style="{{Request::get('sort') == 'discount' ? 'color: rgb(29, 186, 165)' : ''}}">discount</a></li> |
                     <li><a href="?sort=price" style="{{Request::get('sort') == 'price' ? 'color: rgb(29, 186, 165)' : ''}}">Giá: Low High </a></li> 
                 <div class="clearfix"> </div>	
                 </ul>
                 <div class="clearfix"> </div>	
            </div>
        </div>
        <!-- grids_of_4 -->
        <div class="product-left mt-4">
            <div class="row">
            @if ($products)
                @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="product-container">
                        <a href="{{url('products/'.$product->id)}}" class="chain-container"><img class="img-responsive chain" src="{{asset('storage/products/'.$product->image[0]->path)}}" alt=" " /></a>
                        <span class="star"> </span>
                        <div class="grid-chain-bottom">
                            <h6><a href="{{url('products/'.$product->id)}}">{{$product->information->name}}</a></h6>
                            <div class="star-price">
                                <div class="dolor-grid" style="flex: 1">
                                    @if ($product->price_sale)
                                        <div>
                                            <span class="actual" >{{$product->priceSaleFormat}} đ</span>
                                            <span class="reducedfrom">{{$product->priceFormat}}đ</span>
                                        </div>
                                    @else
                                        <span class="actual" >{{$product->priceFormat}} đ</span>
                                    @endif
                                    <ul class="rating">
                                        <li><i class="{{$product->rate >= 1 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                        <li><i class="{{$product->rate >= 2 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                        <li><i class="{{$product->rate >= 3 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                        <li><i class="{{$product->rate >= 4 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                        <li><i class="{{$product->rate >= 5 ? 'fas fa-star' : 'far fa-star'}}"></i></li>
                                    </ul>
                                </div>
                                <a class="now-get add-cart" data-product="{{$product->id}}">MUA NGAY</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p>Không có sản phẩm phù hợp</p>
            @endif
                
            </div>
        </div>
    </div>
    </div>
@endsection
@push('js')
    <script>
        $('.add-cart').click(function(){
            axios.post('/cart', {
                product_id: $(this).data('product'),
                quantity: 1
            })
            .then(function (response) {
                loadCart();
            })
            .catch(function (error) {
                console.log(error);
            });
        })
    </script>
@endpush