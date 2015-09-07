<div class="container text-left">
    <h2>Register new user</h2>
    <form method="POST" ng-submit="createUser()">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="col-md-2 col-lg-2">
                    <label class="input-label" for="first_name">First name</label>
                </div>
                <div class="col-md-5 col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-leaf"></i></span>
                        <input required="" placeholder="Enter first name" type="text" id="first_name" ng-model="user.first_name" class="form-control">
                    </div>
                </div>
                <div class="col-md-5 col-lg-5">
                    <form-error err_field="errors.first_name"></form-error>
                </div>
            </div>
        </div>

        <div style="margin-top: 10px;"></div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="col-md-2 col-lg-2">
                    <label class="input-label" for="last_name">Last name</label>
                </div>
                <div class="col-md-5 col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-leaf"></i></span>
                        <input required="" placeholder="Enter last name" type="text" id="last_name" ng-model="user.last_name" class="form-control">
                    </div>
                </div>
                <div class="col-md-5 col-lg-5">
                    <form-error err_field="errors.last_name"></form-error>
                </div>
            </div>
        </div>

        <div style="margin-top: 10px;"></div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="col-md-2 col-lg-2">
                    <label class="input-label" for="email">Email</label>
                </div>
                <div class="col-md-5 col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-leaf"></i></span>
                        <input required="" placeholder="Enter email address" type="email" name="email" ng-model="user.email" class="form-control">
                    </div>
                </div>
                <div class="col-md-5 col-lg-5">
                    <form-error err_field="errors.email"></form-error>
                </div>
            </div>
        </div>

        <div style="margin-top: 10px;"></div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="col-md-2 col-lg-2">
                    <label class="input-label" for="email">Sex</label>
                </div>
                <div class="col-md-5 col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-leaf"></i></span>
                        <select name="sex" ng-model="user.sex" required="" class="form-control">
                            <option value="">Select sex</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5 col-lg-5">
                    <form-error err_field="errors.sex"></form-error>
                </div>
            </div>
        </div>

        <div style="margin-top: 10px;"></div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="col-md-2 col-lg-2">
                </div>
                <div class="col-md-10 col-lg-10">
                    <fieldset ng-disabled="submitting">
                        <button ng-mousedown="submit = true" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> {{save}}</button>
                        <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>
</div>