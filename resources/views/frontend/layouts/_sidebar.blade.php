<div class="sub-cate">
    <div class="top-nav rsidebar span_1_of_left">
        <h3 class="cate">
            {{-- <i class="fas fa-bars"></i>  --}}
            DANH MỤC SÁCH</h3>
        <ul class="menu">
            @foreach ($categories as $category)
            <li class="item1">
                <a href="#" class="d-flex justify-content-between align-items-center">{{$category->name}} <i class="fa-solid fa-angle-down mx-3"></i> </a>
                @if ($category->subCategory)
                    <ul class="cute" style="display: none">
                        @foreach ($category->subCategory as $subcate )
                        <li class="subitem1">
                            @if (isset($subcategory_id) && $subcate->id == $subcategory_id)
                                <a href="{{url('category/'.$category->id.'/'.'sub_category/'.$subcate->id.'/products')}}" class="active px-3">{{$subcate->name}} </a>
                            @else
                                <a href="{{url('category/'.$category->id.'/'.'sub_category/'.$subcate->id.'/products')}}" class="px-3" style="color: #444">{{$subcate->name}} </a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    <div class="chain-grid menu-chain">
        @yield('sidebar')
    </div>
</div>
