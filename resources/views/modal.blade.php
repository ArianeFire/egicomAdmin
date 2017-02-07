<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@{{ title }}</h4>
            </div>
            <div class="modal-body">
                <h3>@{{ description }}</h3>

                <button type="button" ng-click="delete();" class="btn btn-primary">YES</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>
</div>
