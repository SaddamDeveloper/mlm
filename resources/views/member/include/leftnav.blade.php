<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="{{route('member.dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>MLM PROJECT MEMBER</span></a>
      </div>

      <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
        <div class="profile_pic">
          <img src="{{asset('member/production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
          <span>Welcome,</span>
          <h2>{{Auth::user()->full_name}}</h2>
        </div>
      </div>
      <!-- /menu profile quick info -->

      <br />

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
          <li><a href="{{route('member.dashboard')}}"><i class="fa fa-home"></i> Home </a>
            </li>
            
            <li><a href="{{route('member.add_new_member_form')}}"><i class="fa fa-user-plus"></i> Member Registration</a>
            </li>
          
            <li><a><i class="fa fa-code-fork"></i>My Downline <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{route('member.tree')}}"> My Tree</a></li>
                <li><a href="{{route('member.mem_downline_list_form')}}"> Downline List</a></li>
              </ul>
            </li>
            <li><a><i class="fa fa-ticket"></i> FUND Manage<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{route('member.mem_epin_list_form')}}"> My Fund</a></li>
              </ul>
            </li>
            {{-- <li><a><i class="fa fa-ticket"></i> Rewardz<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{route('member.my_rewards_list_form')}}"> My Rewards</a></li>
                <li><a href="{{route('member.mem_rewards_history')}}">Rewards History</a>
                </li>
              </ul>
            </li> --}}
            {{--
            <li><a href="{{route('member.mem_order_list_form')}}"><i class="fa fa-database"></i> Orders</a>
            </li>
          --}}
            <li><a href="{{route('member.mem_wallet_list_form')}}"><i class="fa fa-credit-card"></i> Wallet</a>
            </li>
            {{--
            <li><a href="{{asset('member/usermanual/anne_of_green_gables.pdf')}}"><i class="fa fa-file-pdf-o"></i> User Manual</a>
            </li>

            <li><a href="{{route('member.feedback')}}"><i class="fa fa-comments"></i> Complaint/ Feedback</a>
            </li> --}}

          </ul>
        </div>
      </div>
      <!-- /sidebar menu -->

    </div>
  </div>