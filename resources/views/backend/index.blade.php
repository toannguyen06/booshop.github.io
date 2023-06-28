@extends('backend.layouts.main')

@section('title')
    Chào mừng quay trở lại
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/libs/toastr/build/toastr.min.css')}}">
@endpush
@section('page-title')
    Thống kê mới trong ngày
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-hover" style="margin-bottom:0">
                        <div class="box bg-cyan text-center">
                            <h1 class="font-light text-white">
                                <i class="mdi mdi-account"></i>
                            </h1>
                            <h5 class="text-white">{{ count($userNew) ? $userNew[0]->userQuantity : 0}}</h5>
                            <h6 class="text-white">Người dùng mới</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-hover" style="margin-bottom:0">
                        <div class="box bg-warning text-center">
                            <h1 class="font-light text-white">
                                <i class="mdi mdi-tag"></i>
                            </h1>
                            <h5 class="text-white">{{ count($orderNew) ? $orderNew[0]->orderQuantity : 0}}</h5>
                            <h6 class="text-white">Đơn hàng mới</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-hover" style="margin-bottom:0">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white">
                                <i class="mdi mdi-cart"></i>
                            </h1>
                            <h5 class="text-white">{{ count($productNew) ? $productNew[0]->productQuantity : 0}}</h5>
                            <h6 class="text-white">Sản phẩm mới</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-hover" style="margin-bottom:0">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white">
                                <i class="mdi mdi-coin"></i>
                            </h1>
                            <h5 class="text-white">{{ count($salesNew) ? $salesNew[0]->salesQuantity : 0}} VNĐ</h5>
                            <h6 class="text-white">Doanh thu</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Biểu đồ</h4>
                <div class="form-group">
                    <label for="">Thống kê theo:   </label>
                    <select name="" id="chart_type" class="">
                        <option value="day">Ngày</option>
                        <option value="month">Tháng</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="myChart1"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
            
        </div>          
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sản phẩm bán chạy</h4>
                    <h6 class="card-subtitle">Top 5 sản phẩm bán chạy</h6>
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng bán</th>
                            <th></th>
                        </tr>
                        @php
                            $stt = 1;
                        @endphp
                        @foreach ($sellingProducts as $sellingProduct)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td class="d-flex">
                                    <img src="{{asset('storage/products/'.$sellingProduct['product']->image[0]->path)}}" alt="" width="40">
                                    <p class="ms-2">{{$sellingProduct['product']->information->name}}</p>
                                </td>
                                <td>{{$sellingProduct['sold']}}</td>
                                <td>
                                    <a href="{{url('admin/products/'.$sellingProduct['product']->id.'/edit')}}" class="btn btn-primary"><i class="far fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('link-js')
    <script src="{{asset('assets/libs/toastr/build/toastr.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endpush
@push('js')
    <script>
        var authName = "{{Auth::user()->information->fullname}}"
        toastr.success("Chúc bạn một ngày vui vẻ 🎉🎉🎉", "Chào mừng " + authName + "!!");
    </script>
    <script>
        function loadChart (type, change){
            var labels = []
            if (type == 'day'){
                data = {!!json_encode([
                    'sales' => $salesByDay,
                    'user' => $userByDay,
                    'product' => $productByDay,
                    'order' => $orderByDay,
                ])!!};
                console.log(data.product);
                for (let i = 0; i <= 30; i++) {
                    labels.push(i)
                }
            }
            if (type == 'month'){
                data = {!!json_encode([
                    'sales' => $salesByMonth,
                    'user' => $userByMonth,
                    'product' => $productByMonth,
                    'order' => $orderByMonth,
                ])!!};
                // console.log(data.product);
                for (let i = 0; i <= 12; i++) {
                    labels.push(i)
                }
            }
            return {
                data: data,
                labels: labels
            }

        }
        
        
        var chartData = loadChart('day');
        function config1 (chartData, conf){
            const data1 = {
                labels: chartData.labels,
                datasets: [
                    {
                        label: 'Người dùng',
                        backgroundColor: '#27a9e3',
                        borderColor: '#27a9e3',
                        data: chartData.data.user,
                    },
                    {
                        label: 'Sản phẩm',
                        backgroundColor: '#da542e',
                        borderColor: '#da542e',
                        data: chartData.data.product,
                    },
                    {
                        label: 'Đơn hàng',
                        backgroundColor: '#ffb848',
                        borderColor: '#ffb848',
                        data: chartData.data.order,
                    },
                ]
            };

            const config = {
                type: 'line',
                data: data1,
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: conf.xTittle
                                
                            },
                            ticks: {
                                callback: function(val, index) {
                                    // Hide the label of every 2nd dataset
                                    return index % 3 === 0 ? this.getLabelForValue(val) : '';
                                },
                            }
                        },
                        y: {
                            min: 0,
                            title: {
                                display: true,
                                text: conf.yTittle 
                            },
                            ticks: {
                                    // forces step size to be 50 units
                                    stepSize: 1
                                }
                        }
                    }
                }
            };
            return config
        }

        function config2 (chartData, conf){
            const data = {
                labels: chartData.labels,
                datasets: [
                    {
                        label: 'Doanh thu',
                        backgroundColor: '#28b779',
                        borderColor: '#28b779',
                        data: chartData.data.sales,
                    },
                ]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: conf.xTittle
                                
                            },
                            ticks: {
                                callback: function(val, index) {
                                    // Hide the label of every 2nd dataset
                                    return index % 3 === 0 ? this.getLabelForValue(val) : '';
                                },
                            }
                        },
                        y: {
                            min: 0,
                            title: {
                                display: true,
                                text: conf.yTittle 
                            },
                            ticks: {
                                    // forces step size to be 50 units
                                    stepSize: 50000
                                }
                        }
                    }
                }
            };
            return config
        }
        
        var myChart1 = new Chart(
                document.getElementById('myChart1'),
                config1(chartData, {xTittle: 'Ngày', yTittle: 'Số lượng'})
            );

        var myChart2 = new Chart(
                document.getElementById('myChart2'),
                config2(chartData, {xTittle: 'Ngày', yTittle: 'VNĐ'})
            );
        
    </script>
    <script>
        $('#chart_type').change(function(){
            if ($(this).val() == 'day'){
                myChart1.destroy()
                myChart1 = new Chart(
                    document.getElementById('myChart1'),
                    config1(loadChart('day'), {xTittle: 'Ngày', yTittle: 'Số lượng'})
                );
                myChart2.destroy()
                myChart2 = new Chart(
                    document.getElementById('myChart2'),
                    config2(loadChart('day'), {xTittle: 'Ngày', yTittle: 'VNĐ'})
                );
            }
            if ($(this).val() == 'month'){
                myChart1.destroy()
                myChart1 = new Chart(
                    document.getElementById('myChart1'),
                    config1(loadChart('month'), {xTittle: 'Tháng', yTittle: 'Số lượng'})
                );
                myChart2.destroy()
                myChart2 = new Chart(
                    document.getElementById('myChart2'),
                    config2(loadChart('month'), {xTittle: 'Tháng', yTittle: 'VNĐ'})
                );
            }
        })
    </script>
      
@endpush
