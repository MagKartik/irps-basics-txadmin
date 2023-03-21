<div class="bg text-center" ng-controller="priorityCtrl" ng-cloak>
    <div class="container pd-top-100">
        <p class="h-font raleway">
            The IRPS <span class="primary-color raleway">Priority</span>
        </p>
        <div class="alert alert-danger" ng-if="!canWatch" role="alert" ng-cloak>
            You Do Not Have The Access
        </div>
        <!-- <p class="raleway">
            Lets share our views and idea to make this server great. We read, we care, we apply.
        </p><br> -->
        <div class="row justify-content-center mx-auto" style="max-width: 600px;" ng-if="canWatch" ng-cloak>
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <input class="form-control border-0" type="text" style="max-width: 500px; background-color: #f3f3f3;" placeholder="Search players" ng-model = "$root.key_val">
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-12 noselect">
                <a style="font-size: 25px;cursor:pointer;"  ng-if="access" data-toggle="modal" data-target="#eModal"><i style="color:#f46c00;" class="fas fa-user-plus"></i></a> &nbsp; &nbsp;
                <a style="font-size: 25px;cursor:pointer;" ng-click="warning_f()"><i class="fas fa-radiation" ng-class="warning==0?'text-info':warning==1?'text-warning':warning==2?'text-danger':'text-success'"></i></a> &nbsp; &nbsp;
                <!-- <a style="cursor:pointer;" data-toggle="modal" data-target="weModal"><span class="text-warning">Send warning</span></a> -->
            </div>
        </div><br>
        <div ng-if="spinner" ng-cloak><br><br>
            <div class="spinner-grow text-info" style="width: 10rem; height: 10rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <small ng-if="!spinner" ng-cloak>
            <table class="table table-striped table-light" ng-if="canWatch" ng-cloak>
                <thead>
                    <tr>
                        <th scope="col text-right">Steam ID</th>
                        <th scope="col text-right">Level</th>
                        <th scope="col text-right">Name</th>
                        <th scope="col text-right">Priority Date</th>
                        <th scope="col text-right">Priority Ends</th>
                        <th scope="col text-right">Priority Added</th>
                        <th scope="col text-right">Days Left</th>
                        <th scope="col text-right" ng-if="access">Amount</th>
                        <th scope="col text-right" ng-if="access" >Delete</th>
                    </tr>
                </thead>
                <tbody ng-if="warning==1">
                    <tr ng-repeat="player in priority_details | filter:$root.key_val" ng-if="(((((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) < 4)&&(((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) > 0))?1:0)" ng-class="((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) > 3 ? 'back-success':(((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) < 3 && ((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) > 0 ? 'back-warning':'back-danger')">
                        <th scope="row text-left">
                            {{player.steam}}
                        </th>
                        <th>
                            {{(player.power==8||player.power==7||player.power==6)?'Level 1':((player.power==5)?'Level 2':((player.power==4)?'Level 3':((player.power==3)?'Level 4':((player.power==2)?'Level 5':((player.power==1)?'Level 6':'')))))}}
                        </th>
                        <th>
                            {{player.name}}
                        </th>
                        <th>
                            {{player.start_time*1000 | date}}
                        </th>
                        <th>
                            {{player.end_time*1000 | date}}
                        </th>
                        <th>
                            {{player.add_on}}
                        </th>
                        <th>
                            {{((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) >= 0 ? ((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) : 0 | number:0}}
                        </th>
                        <th ng-if="access">
                            {{player.amount_paid}}
                        </th>
                        <th ng-if="access" >
                            <a class="text-danger cursor-pointer" data-toggle="modal" data-target="#confirm_del" ng-click="delete_priority(player.name,player.steam)"><i class="fas fa-trash-alt"></i></a>
                        </th>
                    </tr>
                </tbody>
                <tbody ng-if="warning==2">
                    <tr ng-repeat="player in priority_details | filter:$root.key_val" ng-if="(((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) <= 0)" ng-class="((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) > 3 ? 'back-success':(((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) < 3 && ((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) > 0 ? 'back-warning':'back-danger')">
                        <th scope="row text-left">
                            {{player.steam}}
                        </th>
                        <th>
                            {{(player.power==8||player.power==7||player.power==6)?'Level 1':((player.power==5)?'Level 2':((player.power==4)?'Level 3':((player.power==3)?'Level 4':((player.power==2)?'Level 5':((player.power==1)?'Level 6':'')))))}}
                        </th>
                        <th>
                            {{player.name}}
                        </th>
                        <th>
                            {{player.start_time*1000 | date}}
                        </th>
                        <th>
                            {{player.end_time*1000 | date}}
                        </th>
                        <th>
                            {{player.add_on}}
                        </th>
                        <th>
                            {{((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) >= 0 ? ((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) : 0 | number:0}}
                        </th>
                        <th ng-if="access">
                            {{player.amount_paid}}
                        </th>
                        <th ng-if="access" >
                            <a class="text-danger cursor-pointer" data-toggle="modal" data-target="#confirm_del" ng-click="delete_priority(player.name,player.steam)"><i class="fas fa-trash-alt"></i></a>
                        </th>
                    </tr>
                </tbody>
                <tbody ng-if="warning==3">
                    <tr ng-repeat="player in priority_details | filter:$root.key_val" ng-if="(((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) >= 4)" ng-class="((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) > 3 ? 'back-success':(((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) < 3 && ((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) > 0 ? 'back-warning':'back-danger')">
                        <th scope="row text-left">
                            {{player.steam}}
                        </th>
                        <th>
                            {{(player.power==8||player.power==7||player.power==6)?'Level 1':((player.power==5)?'Level 2':((player.power==4)?'Level 3':((player.power==3)?'Level 4':((player.power==2)?'Level 5':((player.power==1)?'Level 6':'')))))}}
                        </th>
                        <th>
                            {{player.name}}
                        </th>
                        <th>
                            {{player.start_time*1000 | date}}
                        </th>
                        <th>
                            {{player.end_time*1000 | date}}
                        </th>
                        <th>
                            {{player.add_on}}
                        </th>
                        <th>
                            {{((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) >= 0 ? ((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) : 0 | number:0}}
                        </th>
                        <th ng-if="access">
                            {{player.amount_paid}}
                        </th>
                        <th ng-if="access" >
                            <a class="text-danger cursor-pointer" data-toggle="modal" data-target="#confirm_del" ng-click="delete_priority(player.name,player.steam)"><i class="fas fa-trash-alt"></i></a>
                        </th>
                    </tr>
                </tbody>
                <tbody ng-if="warning==0">
                    <tr ng-repeat="player in priority_details | filter:$root.key_val" ng-class="((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) > 3 ? 'back-success':(((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) < 3 && ((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) > 0 ? 'back-warning':'back-danger')">
                        <th scope="row text-left">
                            {{player.steam}}
                        </th>
                        <th>
                            {{(player.power==8||player.power==7||player.power==6)?'Level 1':((player.power==5)?'Level 2':((player.power==4)?'Level 3':((player.power==3)?'Level 4':((player.power==2)?'Level 5':((player.power==1)?'Level 6':'')))))}}
                        </th>
                        <th>
                            {{player.name}}
                        </th>
                        <th>
                            {{player.start_time*1000 | date}}
                        </th>
                        <th>
                            {{player.end_time*1000 | date}}
                        </th>
                        <th>
                            {{player.add_on}}
                        </th>
                        <th>
                            {{((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) >= 0 ? ((player.end_time)/(60*60*24) - (nowT)/(60*60*24)) : 0 | number:0}}
                        </th>
                        <th ng-if="access">
                            {{player.amount_paid}}
                        </th>
                        <th ng-if="access" >
                            <a class="text-danger cursor-pointer" data-toggle="modal" data-target="#confirm_del" ng-click="delete_priority(player.name,player.steam)"><i class="fas fa-trash-alt"></i></a>
                        </th>
                    </tr>
                </tbody>
            </table>
        </small>
        <div class="modal fade" id="eModal" tabindex="-1" role="dialog" aria-labelledby="eModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD PRIORITY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                                            
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" ng-model="steamLink" placeholder="Validate steam link" aria-label="Validate steam link" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn" ng-class="validate_color" type="button" ng-click="getSteam64(steamLink)" ng-disabled="steam_spinner">
                                    <span ng-if="steam_spinner" ng-cloak class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    <span ng-if="steam_spinner" ng-cloak>Loading</span>
                                    <span ng-if="!steam_spinner" ng-cloak>Validate</span>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="steamId" placeholder="Steam ID">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="name" placeholder="Name">
                        </div>
                        <div class="form-group row">
                            <div class="col-3 primary-color"><h3>LEVEL:</h3></div>
                            <div class="col-9">
                                <select ng-model="level_selected" class="form-control" ng-options="_option.value as _option.level for _option in level"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4 primary-color"><h5 style="line-height: 35px;">Starting Date:</h5></div>
                            <div class="col-8">
                                <input type="date" class="form-control" ng-model="startDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4 primary-color"><h5 style="line-height: 35px;">Ending Date:</h5></div>
                            <div class="col-8">
                                <input type="date" class="form-control" ng-model="endDate">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="amountPaid" placeholder="Amount Paid">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn p-button" data-dismiss="modal" ng-click="addPriority(steamId,name,level_selected,startDate,endDate,amountPaid)">Add Priority</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="confirm_del" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirm Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Do you want to remove <span class="text-info font-weight-bold">{{_del._name}}</span> (<span class="font-weight-bold">{{_del._steam}}</span>) from the list?</p>
            </div>
            <div class="modal-footer">
              <button type="button" ng-click="confirm_delete(_del._steam)" class="btn btn-warning" data-dismiss="modal">Delete!</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <?=$priority_success?>
    <?=$priority_error?>
</div>