<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="{{asset('member/production/images/img.jpg')}}" alt="">{{Auth::user()->full_name}}
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              {{-- <li>
                <a href="{{ route('member.profile') }}" class="fa fa-user"> Profile</a>
              </li>
              <li>
                <a href="{{route('member.change_password')}}" class="fa fa-key">
                  Change Password
                </a>
              </li> --}}
              <div class="devider">

              </div>
              <li>
                <a href="{{ route('member.logout') }}" class="fa fa-sign-out pull-right" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    Logout
                </a>     
                <form id="frm-logout" action="{{ route('member.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->