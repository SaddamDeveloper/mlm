        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
              <nav>
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
  
                <div class="nav navbar-nav navbar-right">
                  <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <img src="{{asset('production/images/img.jpg')}}" alt="">{{Auth::user()->name}}
                      <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                      <li>
                        <a href="{{ route('admin.logout') }}" class="fa fa-sign-out pull-right" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            Logout
                        </a>     
                        <form id="frm-logout" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                      </li>
                    </ul>
                  </li>
                </div>
              </nav>
            </div>
          </div>
          <!-- /top navigation -->