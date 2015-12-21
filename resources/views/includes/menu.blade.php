<div class="cover-menu bg-white bd-b clearfix" style="border-color: #e6e9ea; position: relative;">
    <div class="container">
        <ul class="list-inline mg-b-0 pull-sm-left tab-list">
            @foreach($menu as $m)
                <li><a href="{{$m['url']}}" class="block pd-y-20 pd-x-10">{{$m['text']}}</a></li>
            @endforeach
        </ul>

        <ul class="list-inline mg-b-0 pull-sm-right">
        <li><a href="" class="block pd-y-20 pd-x-10"><i class="fa fa-calendar"></i></a></li>
        <li><a href="" class="block pd-y-20 pd-x-10"><i class="fa fa-bell"></i></a></li>
        <li><a href="" class="block pd-y-20 pd-x-10"><i class="fa fa-music"></i></a></li>
        <li><a href="" class="block pd-y-20 pd-x-10"><i class="fa fa-comment"></i></a></li>
    </ul>
    </div> 
</div>