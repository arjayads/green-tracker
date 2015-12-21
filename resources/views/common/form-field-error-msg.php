<span ng-show="errField">
    <ul class="error pd-0 mg-0">
        <li ng-repeat="err in errField track by $index" class="fs-13 text-danger">{{ err }}</li>
    </ul>
</span>