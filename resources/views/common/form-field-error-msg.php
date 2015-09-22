<style>
    ul.error {
        list-style-type: none;
        text-align: left;
    }
</style>
<span style="color: red !important;" ng-show="errField">
    <ul class="error">
        <li ng-repeat="err in errField track by $index">{{ err }}</li>
    </ul>
</span>