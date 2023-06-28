@extends('frontend.layouts.main')
@section('title')
Giỏ hàng
@endsection

@push('css')
<style>
    .cart-table-item img{
        width: 60px;
        margin-right: 8px;
    }
    .cart-table-item input{
        width: 50px;
        outline: none;
        /* border: none; */
    }
    .table-item-name{
        display: flex;
        /* align-items: center; */
    }
</style>
@endpush
@section('content')
<div class="content">
    <h3>Giỏ hàng của tôi</h3>
    <hr>
    <table class="table" id="cart-table">
        <thead>
            <tr>
                <th></th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody id="cart-data">
            
            
        </tbody>
        
    </table>
    <h5 style="text-align: right" >Tổng tiền: <span id="total-price"></span> VNĐ</h5>
    <div class="mt-4" style="text-align: right">
        <a href="{{url('/payment')}}" class="btn btn-success">Xác nhận thanh toán</a>
    </div>
</div>
@endsection
@push('js')
<script>
    $('#cart-data').on('click', '.table-cart-remove', function(){
        console.log(this.dataset.id);
        axios.delete('/cart', { data: { id: this.dataset.id } })
            .then(function(res){
                loadCart();
            })
            .catch(function(res){
                console.log(res);
            })
    })
    $('#cart-data').on('change', '.cart-quantity', function(){
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
@endpush