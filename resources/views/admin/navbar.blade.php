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
            <span class="pcoded-mtext">Danh mục</span>
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
          class="pcoded-hasmenu {{ in_array(Route::currentRouteName(), ['admin.all.post', 'admin.edit.post']) ? 'active pcoded-trigger' : '' }}">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
            <span class="pcoded-mtext">Đăng tin</span>
          </a>
          <ul class="pcoded-submenu">
            <li
              class="{{ Route::currentRouteName() == 'admin.all.post' ? 'active' : '' }}">
              <a href="{{ route('admin.all.post') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tất cả tin</span>
              </a>
            </li>
            <li class="">
              <a href="{{ route('admin.create.category') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tin phê duyệt</span>
              </a>
            </li>
            <li class="">
              <a href="{{ route('admin.create.category') }}"
                class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tin chờ phê duyệt</span>
              </a>
            </li>
          </ul>
        </li>

      </ul>
      <div class="pcoded-navigation-label">UI Element</div>
      <ul class="pcoded-item pcoded-left-item">
        <li class="pcoded-hasmenu">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon">
              <i class="feather icon-box"></i>
            </span>
            <span class="pcoded-mtext">Basic</span>
          </a>
          <ul class="pcoded-submenu">
            <li class="">
              <a href="alert.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Alert</span>
              </a>
            </li>
            <li class="">
              <a href="breadcrumb.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Breadcrumbs</span>
              </a>
            </li>
            <li class="">
              <a href="button.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Button</span>
              </a>
            </li>
            <li class="">
              <a href="box-shadow.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Box-Shadow</span>
              </a>
            </li>
            <li class="">
              <a href="accordion.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Accordion</span>
              </a>
            </li>
            <li class="">
              <a href="generic-class.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Generic Class</span>
              </a>
            </li>
            <li class="">
              <a href="tabs.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tabs</span>
              </a>
            </li>
            <li class="">
              <a href="color.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Color</span>
              </a>
            </li>
            <li class="">
              <a href="label-badge.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Label Badge</span>
              </a>
            </li>
            <li class="">
              <a href="progress-bar.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Progress Bar</span>
              </a>
            </li>

            <li class="">
              <a href="list.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">List</span>
              </a>
            </li>
            <li class="">
              <a href="tooltip.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Tooltip And
                  Popover</span>
              </a>
            </li>
            <li class="">
              <a href="typography.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Typography</span>
              </a>
            </li>
            <li class="">
              <a href="other.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Other</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="pcoded-hasmenu">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon">
              <i class="feather icon-gitlab"></i>
            </span>
            <span class="pcoded-mtext">Advance</span>
          </a>
          <ul class="pcoded-submenu">
            <li class="">
              <a href="draggable.html" class="waves-effect waves-dark">
                <span class="pcoded-mtext">Draggable</span>
              </a>
            </li>


        </li>
        <li class="">
          <a href="modal.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Modal</span>
          </a>
        </li>
        <li class="">
          <a href="notification.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Notifications</span>
          </a>
        </li>

        <li class="">
          <a href="rating.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Rating</span>
          </a>
        </li>
        <li class="">
          <a href="range-slider.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Range Slider</span>
          </a>
        </li>
        <li class="">
          <a href="slider.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Slider</span>
          </a>
        </li>
        <li class="">
          <a href="syntax-highlighter.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Syntax Highlighter</span>
          </a>
        </li>
        <li class="">
          <a href="tour.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Tour</span>
          </a>
        </li>
        <li class="">
          <a href="treeview.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Tree View</span>
          </a>
        </li>
        <li class="">
          <a href="nestable.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Nestable</span>
          </a>
        </li>
        <li class="">
          <a href="toolbar.html" class="waves-effect waves-dark">
            <span class="pcoded-mtext">Toolbar</span>
          </a>
        </li>

      </ul>
      </li>
      <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
          <span class="pcoded-micon">
            <i class="feather icon-package"></i>
          </span>
          <span class="pcoded-mtext">Extra</span>
        </a>
        <ul class="pcoded-submenu">
          <li class="">
            <a href="session-timeout.html" class="waves-effect waves-dark">
              <span class="pcoded-mtext">Session Timeout</span>
            </a>
          </li>
          <li class="">
            <a href="session-idle-timeout.html"
              class="waves-effect waves-dark">
              <span class="pcoded-mtext">Session Idle
                Timeout</span>
            </a>
          </li>
          <li class="">
            <a href="offline.html" class="waves-effect waves-dark">
              <span class="pcoded-mtext">Offline</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="">
        <a href="animation.html" class="waves-effect waves-dark">
          <span class="pcoded-micon">
            <i class="feather icon-aperture rotate-refresh"></i>
          </span>
          <span class="pcoded-mtext">Animations</span>
        </a>
      </li>

      <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
          <span class="pcoded-micon">
            <i class="feather icon-command"></i>
          </span>
          <span class="pcoded-mtext">Icons</span>
        </a>
        <ul class="pcoded-submenu">
          <li class="">
            <a href="icon-font-awesome.html" class="waves-effect waves-dark">
              <span class="pcoded-mtext">Font Awesome</span>
            </a>
          </li>
          <li class="">
            <a href="icon-themify.html" class="waves-effect waves-dark">
              <span class="pcoded-mtext">Themify</span>
            </a>
          </li>
          <li class="">
            <a href="icon-simple-line.html" class="waves-effect waves-dark">
              <span class="pcoded-mtext">Simple Line Icon</span>
            </a>
          </li>

        </ul>
      </li>
      </ul>
    </div>
  </div>
</nav>
