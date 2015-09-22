<form method="POST" ng-submit="saveEmp()">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="col-md-2 col-lg-2">
                <label class="input-label" for="id_number">ID Number</label>
            </div>
            <div class="col-md-5 col-lg-5">
                <div class="input-group">
                    <span class="input-group-addon"><?= Config::get('hris_system.employee_id_prefix'); ?></span>
                    <input required="" placeholder="Enter ID Number" type="text" id="id_number" ng-model="employee.id_number" class="form-control">
                </div>
            </div>
            <div class="col-md-5 col-lg-5">
                <form-error err_field="errors.id_number"></form-error>
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
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input required="" placeholder="Enter email address" type="email" id="email" ng-model="employee.email" class="form-control">
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
                <label class="input-label" for="first_name">First name</label>
            </div>
            <div class="col-md-5 col-lg-5">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                    <input required="" placeholder="Enter first name" type="text" id="first_name" ng-model="employee.first_name" class="form-control">
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
                <label class="input-label" for="middle_name">Middle name</label>
            </div>
            <div class="col-md-5 col-lg-5">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                    <input placeholder="Enter middle name" type="text" id="middle_name" ng-model="employee.middle_name" class="form-control">
                </div>
            </div>
            <div class="col-md-5 col-lg-5">
                <form-error err_field="errors.middle_name"></form-error>
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
                    <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                    <input required="" placeholder="Enter last name" type="text" id="last_name" ng-model="employee.last_name" class="form-control">
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
                <label class="input-label" for="sex">Sex</label>
            </div>
            <div class="col-md-5 col-lg-2">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                    <select id="sex" ng-model="employee.sex" required="" class="form-control">
                        <option value="">Select sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
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
                <label class="input-label" for="birthday">Birthday</label>
            </div>
            <div class="col-md-5 col-lg-2">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input required="" placeholder="mm/dd/yyyy" type="text" id="birthday" ng-model="employee.birthday" class="datepicker form-control">
                </div>
            </div>
            <div class="col-md-5 col-lg-5">
                <form-error err_field="errors.birthday"></form-error>
            </div>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="col-md-2 col-lg-2">
                <label class="input-label" for="shift">Shift</label>
            </div>
            <div class="col-md-5 col-lg-5">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    <select required="" class="form-control" id="shift" ng-model="selectedShift"
                            ng-options="shift.description for shift in shifts track by shift.id">
                        <option value="">Select shift</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5 col-lg-5">
                <form-error err_field="errors.shift_id"></form-error>
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
                    <button ng-mousedown="submit = true" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> <% save %></button>
                    <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                </fieldset>
            </div>
        </div>
    </div>
</form>