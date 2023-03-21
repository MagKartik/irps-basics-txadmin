<transnav></transnav>
<div class="pd-top-80 container-fluid" ng-controller="appController">
    <table class="table" ng-if="staffFlag">
        <thead class="staff-gradient">
            <tr class="text-center border-0">
                <th scope="col helvetical font-weight-bold" style="border:0">Issue</th>
                <th scope="col helvetical font-weight-bold" style="border:0">Minor</th>
                <th scope="col helvetical font-weight-bold" style="border:0">Major</th>
                <th scope="col helvetical font-weight-bold" style="border:0">Critical</th>
                <th scope="col helvetical font-weight-bold" style="border:0">In Progress</th>
                <th scope="col helvetical font-weight-bold" style="border:0">Resolved</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center f-35"><a class="cursor-pointer text-primary" ng-click="addUserInList('Request','req')" data-toggle="modal" data-target=".add-player-modal-lg" ><i class="fas fa-flushed"></i></a></td>
                <td class="text-center f-35"><a class="cursor-pointer text-warning" ng-click="addUserInList('Warning','warn')" data-toggle="modal" data-target=".add-player-modal-lg" ><i class="fas fa-flushed"></i></a></td>
                <td class="text-center f-35"><a class="cursor-pointer text-secondary" ng-click="addUserInList('Kicked','kick')" data-toggle="modal" data-target=".add-player-modal-lg" ><i class="fas fa-flushed"></i></a></td>
                <td class="text-center f-35"><a class="cursor-pointer text-danger" ng-click="addUserInList('Banned','ban')" data-toggle="modal" data-target=".add-player-modal-lg" ><i class="fas fa-flushed"></i></a></td>
                <td class="text-center f-35"><a class="cursor-pointer text-info" ng-click="addUserInList('Revoked','_revoke')" data-toggle="modal" data-target=".add-player-modal-lg" ><i class="fas fa-flushed"></i></a></td>
                <td class="text-center f-35"><a class="cursor-pointer text-success" ng-click="addUserInList('Response','res')" data-toggle="modal" data-target=".add-player-modal-lg" ><i class="fas fa-flushed"></i></a></td>
            </tr>
            <tr>
                <td>
                    <center><ul ui-sortable="sortableOptions" class="staff-ul apps-container screen floatleft first" ng-model="requestList">
                        <li class="staff-li app app-request noselect helvetical" ng-repeat="app in requestList track by $index" ng-click="targetPlayer(app)" data-toggle="modal" data-target=".check-player-modal-lg" >
                            <small class="font-weight-bold">{{app.name}}</small><div>
                            <small class="text-muted f-10">{{app.identifier}}
                                <div class="f-10" ng-class="((today)/(60*60*24) - (app.timestamp)/(60*60*24))>7?'text-danger':'text-muted'">{{app.timestamp*1000 | date:'MM/dd/yyyy | h:mma'}}</div>
                            </small></div>
                        </li>
                    </ul></center>
                </td>
                <td><center>
                    <ul ui-sortable="sortableOptions" class="staff-ul apps-container screen floatleft third" ng-model="warnedList">
                        <li class="staff-li app app-warned noselect helvetical" ng-repeat="app in warnedList track by $index" ng-click="targetPlayer(app)" data-toggle="modal" data-target=".check-player-modal-lg" >
                            <small class="font-weight-bold">{{app.name}}</small><div>
                            <small class="text-muted f-10">{{app.identifier}}
                                <div class="f-10" ng-class="((today)/(60*60*24) - (app.timestamp)/(60*60*24))>7?'text-danger':'text-muted'">{{app.timestamp*1000 | date:'MM/dd/yyyy | h:mma'}}</div>
                            </small></div>
                        </li>
                    </ul></center>
                </td>
                <td><center>
                    <ul ui-sortable="sortableOptions" class="staff-ul apps-container screen floatleft third" ng-model="kickedList">
                        <li class="staff-li app app-kicked noselect helvetical" ng-repeat="app in kickedList track by $index" ng-click="targetPlayer(app)" data-toggle="modal" data-target=".check-player-modal-lg" >
                            <small class="font-weight-bold">{{app.name}}</small><div>
                            <small class="text-muted f-10">{{app.identifier}}
                                <div class="f-10" ng-class="((today)/(60*60*24) - (app.timestamp)/(60*60*24))>7?'text-danger':'text-muted'">{{app.timestamp*1000 | date:'MM/dd/yyyy | h:mma'}}</div>
                            </small></div>
                        </li>
                    </ul></center>
                </td>
                <td><center>
                    <ul ui-sortable="sortableOptions" class="staff-ul apps-container screen floatleft third" ng-model="bannedList">
                        <li class="staff-li app app-banned noselect helvetical" ng-repeat="app in bannedList track by $index" ng-click="targetPlayer(app)" data-toggle="modal" data-target=".check-player-modal-lg" >
                            <small class="font-weight-bold">{{app.name}}</small><div>
                            <small class="text-muted f-10">{{app.identifier}}
                                <div class="f-10" ng-class="((today)/(60*60*24) - (app.timestamp)/(60*60*24))>7?'text-danger':'text-muted'">{{app.timestamp*1000 | date:'MM/dd/yyyy | h:mma'}}</div>
                            </small></div>
                        </li>
                    </ul></center>
                </td>
                <td><center>
                    <ul ui-sortable="sortableOptions" class="staff-ul apps-container screen floatleft third" ng-model="revokedList">
                        <li class="staff-li app app-revoked noselect helvetical" ng-repeat="app in revokedList track by $index" ng-click="targetPlayer(app)" data-toggle="modal" data-target=".check-player-modal-lg" >
                            <small class="font-weight-bold">{{app.name}}</small><div>
                            <small class="text-muted f-10">{{app.identifier}}
                                <div class="f-10" ng-class="((today)/(60*60*24) - (app.timestamp)/(60*60*24))>7?'text-danger':'text-muted'">{{app.timestamp*1000 | date:'MM/dd/yyyy | h:mma'}}</div>
                            </small></div>
                        </li>
                    </ul></center>
                </td>
                <td><center>
                    <ul ui-sortable="sortableOptions" class="staff-ul apps-container screen floatleft second" ng-model="responseList">
                        <li class="staff-li app app-response noselect helvetical" ng-repeat="app in responseList track by $index" ng-click="targetPlayer(app)" data-toggle="modal" data-target=".check-player-modal-lg" >
                            <small class="font-weight-bold">{{app.name}}</small><div>
                            <small class="text-muted f-10">{{app.identifier}}
                                <div class="f-10" ng-class="((today)/(60*60*24) - (app.timestamp)/(60*60*24))>7?'text-danger':'text-muted'">{{app.timestamp*1000 | date:'MM/dd/yyyy | h:mma'}}</div>
                            </small></div>
                        </li>
                    </ul></center>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="modal fade check-player-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{modalName}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" id="textFormControlTextarea1" disabled rows="3">{{modalMessage}}</textarea>
                        <small class="text-muted">{{modalIdentifier}}<div class="f-12 text-right">OWNER : {{modalOwner}} &nbsp;&nbsp;|&nbsp;&nbsp;{{modalTime*1000 | date:'MM/dd/yyyy | h:mma'}}</div></small>
                        <div class="text-right"><br>
                            <small class="text-danger">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Delete Reason" ng-model="delete_reason" aria-label="Recipient's username" aria-describedby="basic-addon2"  ng-change="c_delete(delete_reason,modalId,modalOwnerId,$root.details.steamid,manegerFlag)" >
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" ng-disabled="deleteFlag==false" type="button" data-dismiss="modal" ng-click="s_delete(delete_reason,modalId,modalOwnerId,$root.details.steamid,manegerFlag,modalName,modalIdentifier)" >Confirm Delete</button>
                                    </div>
                                </div>
                            </small><br>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade add-player-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{modalTitle}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search by player's keyword" ng-model="searchThisKey" ng-change="getPlayers(searchThisKey)" aria-label="Recipient's username" aria-describedby="button-addon2">
                        </div>
                        <div class="mb-3 card" ng-if="selectedFlag" ng-cloak>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" ng-repeat="player in player_details | limitTo:5"><a class="cursor-pointer" ng-click="selectPlayer(player.identifier, player.name, player.firstname+' '+player.lastname)"><small>{{player.name}} ({{player.firstname}} {{player.lastname}}) - <span class="primary-color">{{player.identifier}}</span></small></a></li>
                            </ul>
                        </div>
                        <div class="mb-3" ng-if="!selectedFlag" ng-cloak>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="row">Steam Name</th>
                                        <th>{{selectedname}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Steam ID</th>
                                        <td>{{selectedIdentifier}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group" ng-if="!selectedFlag" ng-cloak>
                            <textarea class="form-control" id="textFormControlTextarea1" rows="3" ng-model="$root.enteredtext"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn" ng-class="modalBtn" data-dismiss="modal" ng-click="addRequest(selectedIdentifier,selectedname,$root.enteredtext,modalBtn,$root.details.personaname,$root.details.steamid)">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" style="position: fixed;top: 85px;right: 35px;">
        <div class="toast-header">
            <svg width="20" height="20" class="mr-2" viewBox="0 0 24 24">
                <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M11,16.5L18,9.5L16.59,8.09L11,13.67L7.91,10.59L6.5,12L11,16.5Z" fill="#ccc"></path>
            </svg>
          <strong class="mr-auto">IRPS Message</strong>
          <small>Just now</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>
        <div class="toast-body">
            {{toastBody}}
        </div>
      </div>
</div>