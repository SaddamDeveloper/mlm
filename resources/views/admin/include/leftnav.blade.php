<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="{{route('admin.dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>MLM PROJECT</span></a>
      </div>

      <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
        <div class="profile_pic">
          <img src="{{asset('admin/production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
          <span>Welcome,</span>
          <h2>{{Auth::user()->name}}</h2>
        </div>
      </div>
      <!-- /menu profile quick info -->

      <br />

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
          <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> Home </a>
            </li>
            {{-- <li><a><i class="fa fa-edit"></i> Member Product <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{route('admin.mem_product_list')}}">Product List</a></li>
              </ul>
            </li> --}}
            {{-- <li><a><i class="fa fa-users"></i> Members <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{route('admin.mem_member_list')}}">Member List</a></li>
                <li><a href="{{route('admin.mem_commission_history')}}">Commision History</a></li>
                <li><a href="{{route('admin.mem_wallet')}}">Member Wallet List</a></li>
              </ul>
            </li>
            <li><a><i class="fa fa-shopping-cart"></i> Shopping <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{route('admin.shopping_slider')}}">Slider List</a></li>
                <li><a href="{{route('admin.shopping_product')}}">Product List</a></li>
                <li><a href="{{route('admin.shopping_category')}}">Category List</a></li>
              </ul>
            </li>
            <li>
                <a href="{{route('admin.important_notice')}}">
                  <i class="fa fa-bell"></i> Important Notice
                </a>
            </li>--}}
            <li><a><i class="fa fa-gear"></i> Configuration <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{route('admin.mem_epin')}}">Fund Allocate</a></li>
                <li><a href="{{route('admin.mem_commission')}}">Admin Commission</a></li>
                <li><a href="{{route('admin.mem_tds')}}">TDS</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <!-- /sidebar menu -->

    </div>
  </div>