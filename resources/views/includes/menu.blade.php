<div class="cover-holder menu-holder">
    <div class="cover-menu bg-white bd-b">
        <div class="container">
            <ul class="list-inline mg-b-0 pull-sm-left {{in_array(Request::segment(1), ['profile', 'admin'])?'tab-list':'tab-list-2'}}">
                @foreach($menu as $m)
                    <li><a href="{{$m['url']}}" class="block pd-y-20 pd-x-10">{{$m['text']}}</a></li>
                @endforeach
            </ul>
            
            <div class="pull-right mg-r-10 ">
                <ul class="list-inline mg-b-0 pull-sm-right">
                    <li class="dropdown">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#" class="block pd-y-20 pd-x-10"><i class="fa fa-bell"></i></a>
                            <ul class="dropdown-menu list" aria-labelledby="drop1">
                                <li class="dp-header">NOTIFICATION
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="/images/img-holder.png">
                                        </div>
                                        <div class="list-desc">
                                            <div>Gabriel Ceniza</div>
                                            <small>Created a new sale and is the leading sales</small>
                                        </div>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li class="view-all"><a href="#">View All </a></li>
                            </ul>
                    </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#" class="block pd-y-20 pd-x-10"><i class="fa fa-inbox"></i></a>
                            <ul class="dropdown-menu list" aria-labelledby="drop2">
                                <li class="dp-header">INBOX</li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="/images/img-holder.png">
                                        </div>
                                        <div class="list-desc">
                                            <div>Gabriel Ceniza</div>
                                            <small>Created a new sale and is the leading sales</small>
                                        </div>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li class="view-all"><a href="#">View All </a></li>
                            </ul>
                    </li>
                </ul>
            </div>
        </div> 
    </div>
</div>