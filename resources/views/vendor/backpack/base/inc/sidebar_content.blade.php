<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('post') }}'><i class='nav-icon la la-newspaper-o'></i> Posts</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-users'></i> Users</a></li>

<li class="nav-title">Others</li>
<li class="nav-item"><a class="nav-link" href="{{ url('telescope') }}"><i class="nav-icon la la-moon"></i> <span>Telescope</span> <i class="la la-external-link-alt"></i></a></li>
