<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tile') }}'><i class='nav-icon la la-border-all'></i> Tiles</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('post') }}'><i class='nav-icon la la-pager'></i> Posts</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon la la-file-alt'></i> Pages</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-users'></i> Users</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('document') }}'><i class='nav-icon la la-file'></i> Documents</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('publication') }}'><i class='nav-icon la la-book'></i> Publications</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tag') }}'><i class='nav-icon la la-tag'></i> Tags</a></li>

<li class="nav-title">Imported</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('work') }}'><i class='nav-icon la la-building'></i> Works</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('award') }}'><i class='nav-icon la la-award'></i> Awards</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contest') }}'><i class='nav-icon la la-clock'></i> Contests</a></li>

<li class="nav-title">Others</li>
<li class="nav-item"><a class="nav-link" href="{{ url('telescope') }}"><i class="nav-icon la la-moon"></i> <span>Telescope</span> <i class="la la-external-link-alt"></i></a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}\"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
