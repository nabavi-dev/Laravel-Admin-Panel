<div id="sidebar" class="sidebar responsive ace-save-state">
    <ul class="nav nav-list">
        <li class="">
            <a href="{{ url('dashboard') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>
         <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list-alt"></i>
                    <span class="menu-text"> Category </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                        <li class="">
                            <a href="{{ url('category') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Category List
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('category/create') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Add Category
                            </a>

                            <b class="arrow"></b>
                        </li>
                </ul>
            </li>
         <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list-ul"></i>
                    <span class="menu-text"> Sub-Category </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                        <li class="">
                            <a href="{{ url('subcategory') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Sub-Category List
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('subcategory/create') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Add Sub-Category
                            </a>

                            <b class="arrow"></b>
                        </li>
                </ul>
            </li>
         <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-product-hunt"></i>
                    <span class="menu-text"> Products </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                        <li class="">
                            <a href="{{ url('product') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Product List
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('product/create') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Add Product
                            </a>

                            <b class="arrow"></b>
                        </li>
                </ul>
            </li>
        <li class="">
            <a href="{{url('live-search-product')}}">
                <i class="menu-icon fa fa-search"></i>
                <span class="menu-text"> Live Search Product </span>
            </a>
        </li>
        <li class="">
            <a href="{{url('filter-product')}}">
                <i class="menu-icon fa fa-filter"></i>
                <span class="menu-text"> Filter Product </span>
            </a>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
           data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
