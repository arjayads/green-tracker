<div class="cover-holder">
    <div class="container">

        <div class="cover pd-15 relative" ng-mousemove="hover = true" ng-mouseleave="hover = false;" ng-init="hover = false" ng-style="{'background-image':'url('+coverPhoto+')'}">
            <div ng-class="{hidden: !hover}" class="cover-top clearfix">
                <a ng-cloak="" ng-click="setCoverPic()" href="" class="btn btn-link text-white pull-sm-left"><i class="fa fa-camera"></i> Change Background</a>
                <a ng-cloak="" ng-click="showUpdateInfoModal()" href="" class="btn btn-default pull-sm-right text-primary pd-y-5">Update Info</a>
            </div>

            <div class="row cover-avatar">
                <div class="col-sm-2 col-md-2">
                    <div class="avatar-holder">
                        <a href="" class="avatar-img block text-xs-center text-md-left">
                            <img ng-cloak="" ng-click="setProfilePic()"  ng-src="<%profilePhoto%>" class="img-circle" width="200" height="200"/>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-7">
                    <h1 class="h2 text-xs-center text-sm-left">{{ $myData->first_name }} {{ $myData->last_name }} ({{$myData->alias}})</h1>
                    <p class="mg-t-0 text-xs-center text-sm-left">{{ $myData->mood }}</p>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="incentives bg-white pd-15 text-center text-primary">
                        <label class="text-uppercase font-heading h4 text-primary incentive-label">Total Incentive</label>
                        <strong class="incentive-counter text-primary block mg-t-0 mg-b-0">P 43,290.40</strong>
                    </div>
                </div>
            </div>
        </div>


        <div class="cover-menu bg-white bd-b clearfix" style="border-color: #e6e9ea; position: relative;">


            <ul class="list-inline mg-b-0 pull-sm-left tab-list">
                <li class="active"><a target="_blank" href="/sales/create" class="block pd-y-20 pd-x-10">Create Sale</a></li>
                <li><a href="" class="block pd-y-20 pd-x-10">Post Sale</a></li>
                <li><a href="" class="block pd-y-20 pd-x-10">Profile</a></li>
                <li><a href="" class="block pd-y-20 pd-x-10">Agents</a></li>
                <li><a href="" class="block pd-y-20 pd-x-10">Campaigns</a></li>
            </ul>

            <ul class="list-inline mg-b-0 pull-sm-right">
                <li><a href="" class="block pd-y-20 pd-x-10"><i class="fa fa-calendar"></i></a></li>
                <li><a href="" class="block pd-y-20 pd-x-10"><i class="fa fa-bell"></i></a></li>
                <li><a href="" class="block pd-y-20 pd-x-10"><i class="fa fa-music"></i></a></li>
                <li><a href="" class="block pd-y-20 pd-x-10"><i class="fa fa-comment"></i></a></li>
            </ul>
        </div>
    </div>
</div>

<div id="profile-changer-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update profile photo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <div>Select an image file: <input type="file" id="profilePicInput" accept="image/*" /></div>
                        <div class="cropArea">
                            <img-crop image="myImage" result-image="myCroppedImage"></img-crop>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div>Preview</div>
                        <div><img ng-src="<% myCroppedImage %>" /></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button ng-click="saveProfilePic()" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div id="cover-changer-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update cover photo</h4>
            </div>
            <div class="modal-body">
                    <input type="file" ng-file-select="onFileSelect($files)" ng-model="imageSrc" accept="image/*">
                    {{--<input type="file" ng-file-select="onFileSelect($files)" multiple>--}}
                <b>Preview:</b>
                <br />
                <i ng-hide="imageSrc">No image choosed</i>
                <img ng-src="<%imageSrc%>" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button ng-click="saveCoverPic()" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div id="info-changer-modal" class="modal fade">
    <div class="modal-dialog modal-md">
        <form ng-submit="saveInfo()">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Update Info</h4>
                </div>
                <div class="modal-body">
                    <div ng-show="updateInfoMessage" class="alert alert-<% alertType ? alertType : 'info'%>">
                        <%updateInfoMessage%>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="input-label" for="alias">Alias</label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input ng-init="info.alias='{{$myData->alias}}'" ng-model="info.alias" type="text" class="form-control" id="alias"">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 10px;"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="input-label" for="email">Email</label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input ng-init="info.email='{{$myData->email}}'" ng-model="info.email" type="email" class="form-control" id="email">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 10px;"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="input-label" for="mood">Mood</label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-apple"></i></span>
                                    <input ng-init="info.mood='{{$myData->mood}}'" ng-model="info.mood" type="text" class="form-control" id="mood">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 10px;"></div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="input-label" for="password">Password</label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn"></i></span>
                                    <input ng-model="info.password" type="password" class="form-control" id="password">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 10px;"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="input-label" for="confirm-password">Confirm</label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn"></i></span>
                                    <input ng-model="info.confirmPassword" type="password" class="form-control" id="confirm-password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <fieldset ng-disabled="savingInfo">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><% savingInfoButton %> </button>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
</div>