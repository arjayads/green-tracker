<div class="cover-holder pd-t-20">
    <div class="container">

        <div class="cover pd-15 relative" ng-mousemove="hover = true" ng-mouseleave="hover = false;" ng-init="hover = false" ng-style="{'background-image':'url('+coverPhoto+')'}">
            <div ng-class="{hidden: !hover}" class="cover-top clearfix">
                <a ng-cloak="" ng-click="setCoverPic()" href="" class="btn btn-link text-white pull-sm-left"><i class="fa fa-camera"></i> Change Background</a>
                <a ng-cloak="" ng-click="showUpdateInfoModal()" href="" class="btn btn-default pull-sm-right text-success pd-y-5">Update Info</a>
            </div>

            <div class="row cover-avatar">
                <div class="col-sm-2 col-md-2">
                    <div class="avatar-holder">
                        <a href="" class="avatar-img block text-xs-center text-md-left">
                            <img ng-cloak="" ng-click="setProfilePic()"  ng-src="<%profilePhoto%>" class="img-circle bg-white bd-white bd-thick bd-solid" width="200" height="200"/>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-7">
                    <h1 class="h2 text-xs-center text-sm-left">{{ $myData->first_name }} {{ $myData->last_name }}  {{$myData->alias ? ('(' . $myData->alias . ')') : ''}}</h1>
                    <p class="mg-t-0 text-xs-center text-sm-left">{{ $myData->mood }}</p>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="incentives bg-white pd-15 text-center text-primary">
                        <strong class="incentive-counter text-primary block mg-t-0 mg-b-0"><% incentive | currency:"P ":2 %></strong>
                    </div>
                </div>
            </div>
        </div>

         @include('includes.menu') 

    </div>
</div>

<div id="profile-changer-modal" class="modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update profile photo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <span class="btn btn-default btn-file btn-success mg-b-10">
                                Select an image file <input type="file" id="profilePicInput" class="btn btn-success" accept="image/*">
                            </span>
                        </div>
                        <div class="cropArea">
                            <img-crop image="myImage" result-image="myCroppedImage" area-type="square"></img-crop>
                        </div>
                    </div>
                    <!-- <div class="col-md-5">
                        <div>Preview</div>
                        <div><img class="img-circle" ng-src="<% myCroppedImage %>" /></div>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button ng-click="saveProfilePic()" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div id="cover-changer-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update cover photo</h4>
            </div>
            <div class="modal-body">
                 <span class="btn btn-default btn-file btn-success mg-b-10">
                    Select an image file <input  type="file" ng-file-select="onFileSelect($files)" ng-model="imageSrc" class="btn btn-success" accept="image/*" />
                </span>
                    {{--<input type="file" ng-file-select="onFileSelect($files)" multiple>--}}
                <br />
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

<div id="info-changer-modal" class="modal">
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
                                    <input ng-init="info.alias='{{$myData->alias}}'" ng-model="info.alias" type="text" class="form-control" id="alias">
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
                                    <input ng-init='info.mood="{{$myData->mood}}"' ng-model="info.mood" type="text" class="form-control" id="mood">
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
                                <form-error err_field="errors.password"></form-error>
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
                                    <input ng-model="info.password_confirmation" type="password" class="form-control" id="confirm-password">
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