<header class="navbar navbar-static-top bd-b" id="top" role="banner" style="border-color: #e6e9ea;">
    <div class="container">
        <div class="navbar-header pull-left">
            <a href="/" class="navbar-brand">
                <span><img src="/images/logo-brandmark.png" alt="" class="brandmark"></span>
                <span><img src="/images/logo-wordmark.png" alt="" class="wordmark hidden-xs"></span>
            </a>
        </div>
        <!--/ .navbar-header -->

        <form class="navbar-form pull-left" role="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Agents, Events, Calendar, Birthdays" aria-describedby="basic-addon2">
        <span class="input-group-btn">
          <button class="btn btn-success" type="button"><i class="fa fa-search"></i></button>
        </span>
            </div>
        </form>

        <nav id="menu-bar" class="menu-bar">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle pd-y-10 pull-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="mg-r-10 hidden-xs hidden-sm">{{ $myData->first_name }}</span> <img src="/profile/photo" class="avatar img-circle" width="48" height="48"><span class="caret hidden-xs hidden-sm"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/profile">Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/auth/logout">Log Off</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>