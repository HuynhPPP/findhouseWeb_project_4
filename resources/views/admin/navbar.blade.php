<nav class="pcoded-navbar">
  <div class="nav-list">
    <div class="pcoded-inner-navbar main-menu">
      <ul class="pcoded-item pcoded-left-item">
        <li
          class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }} ">
          <a href="{{ route('admin.dashboard') }}"
            class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
            <span class="pcoded-mtext">Tổng quan</span>
          </a>
        </li>
        <li
          class="pcoded-hasmenu {{ in_array(Route::currentRouteName(), ['admin.all.category', 'admin.create.category']) ? 'active pcoded-trigger' : '' }}">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
            <span class="pcoded-mtext">Quản lý danh mục</span>
          </a>
          <ul class="pcoded-submenu">
            <li
              class="{{ Route::currentRouteName() == 'admin.all.category' ? 'active' : '' }}">
              <a href="{{ route('admin.all.category') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tất cả danh mục</span>
              </a>
            </li>
            <li
              class="{{ Route::currentRouteName() == 'admin.create.category' ? 'active' : '' }}">
              <a href="{{ route('admin.create.category') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Thêm danh mục</span>
              </a>
            </li>
          </ul>
        </li>
        <li
          class="pcoded-hasmenu {{ in_array(Route::currentRouteName(), ['admin.all.post', 'admin.edit.post', 'admin.approved.post', 'admin.pending.post', 'admin.hidden.post']) ? 'active pcoded-trigger' : '' }}">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i
                class="fa fa-location-arrow"></i></span>
            <span class="pcoded-mtext">Quản lý tin đăng</span>
          </a>
          <ul class="pcoded-submenu">
            <li
              class="{{ Route::currentRouteName() == 'admin.all.post' ? 'active' : '' }}">
              <a href="{{ route('admin.all.post') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tất cả tin đăng</span>
              </a>
            </li>
            <li
              class="{{ Route::currentRouteName() == 'admin.approved.post' ? 'active' : '' }}">
              <a href="{{ route('admin.approved.post') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tin đăng đã duyệt</span>
              </a>
            </li>
            <li
              class="{{ Route::currentRouteName() == 'admin.pending.post' ? 'active' : '' }}">
              <a href="{{ route('admin.pending.post') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tin đăng chờ duyệt</span>
              </a>
            </li>
            <li
              class="{{ Route::currentRouteName() == 'admin.hidden.post' ? 'active' : '' }}">
              <a href="{{ route('admin.hidden.post') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tin đăng đã ẩn</span>
              </a>
            </li>
          </ul>
        </li>
        <li
          class="pcoded-hasmenu {{ in_array(Route::currentRouteName(), ['admin.all.renter', 'admin.edit.renter', 'admin.all.lease', 'admin.edit.lease']) ? 'active pcoded-trigger' : '' }}">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="fa fa-user"></i></span>
            <span class="pcoded-mtext">Quản lý tài khoản</span>
          </a>
          <ul class="pcoded-submenu">
            <li
              class="{{ Route::currentRouteName() == 'admin.all.renter' ? 'active' : '' }}">
              <a href="{{ route('admin.all.renter') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Người thuê</span>
              </a>
            </li>
            <li
              class="{{ Route::currentRouteName() == 'admin.all.lease' ? 'active' : '' }}">
              <a href="{{ route('admin.all.lease') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Người cho thuê</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
