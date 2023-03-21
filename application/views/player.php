<div class="bg text-center" ng-controller="playerCtrl" ng-cloak>
    <div class="container pd-top-100">
        <p class="h-font raleway">
            The IRPS <span class="primary-color">Players</span>
        </p>
        <!-- <p class="raleway">
            Lets share our views and idea to make this server great. We read, we care, we apply.
        </p><br> -->
        <div class="row justify-content-center mx-auto" style="max-width: 600px;">
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control border-0" type="text" style="max-width: 500px; background-color: #f3f3f3;" placeholder="Search players" ng-model="search_key" ng-change="getData(search_key)"><br>
            </div>
        </div><br><small>
        <table class="table table-striped table-light">
            <thead>
                <tr>
                <th scope="col text-right">Steam ID</th>
                <th scope="col text-right">Loadout</th>
                <th scope="col text-right">Name</th>
                <th scope="col text-right">Phone Number</th>
                <th scope="col text-right">Money</th>
                <th scope="col text-right">Job</th>
                <th scope="col text-right">Status</th>
                <th scope="col text-right" ng-if="identity=='1'||identity=='2'">Edit</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="player in player_details | orderBy : 'name'">
                    <th scope="row text-left">
                        {{player.identifier}}<br>
                        <a class="primary-color" data-toggle="modal" data-target=".bd-inventory-modal-sm" style="font-weight: 400;cursor:pointer;" ng-click="checkInventory(player.identifier)">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </a> &nbsp;|&nbsp; 
                        <a class="text-info" data-toggle="modal" data-target=".bd-car-modal-sm" style="font-weight: 400;cursor:pointer;" ng-click="userVehicles(player.identifier)">
                            <i class="fas fa-car"></i>
                        </a> &nbsp;|&nbsp; 
                        <a class="text-muted" data-toggle="modal" data-target=".bd-home-modal-sm" style="font-weight: 400;cursor:pointer;" ng-click="userProperties(player.identifier)">
                            <i class="fas fa-home"></i>
                        </a> &nbsp;&rarr;&nbsp; 
                        <a class="text-muted" data-toggle="modal" data-target=".bd-home-inventory-modal-sm" style="font-weight: 400;cursor:pointer;" ng-click="checkHomeInventory(player.identifier)">
                            <i class="fas fa-luggage-cart"></i>
                        </a>
                    </th>
                    <td class="text-left">
                        <span ng-repeat="items in player.loadout" ng-if="player.loadout.length" ng-cloak><span class="primary-color">{{items.name | lowercase | strReplace:'_':' '}} : </span>{{items.ammo}}<br></span>
                        <span ng-if="player.loadout.length == 0" class="primary-color" ng-cloak>Gareeb <i class="fas fa-ban"></i></span>
                    </td>
                    <td>{{player.name}}<br><span class="primary-color">({{player.firstname}} {{player.lastname}})</span></td>
                    <td>{{player.phone_number}}</td>
                    <td class="text-left"><span class="primary-color"><i class="fas fa-wallet"></i> </span> {{player.money | shortNumber}}<br>
                        <span class="primary-color"><i class="fas fa-university"></i> </span> {{player.bank | shortNumber}}
                    </td>
                    <td>{{player.job}}</td>
                    <td>
                        <i class="fas fa-drumstick-bite text-warning"></i>  <span>{{player.status[0].percent | number:0}}%</span><br>
                        <i class="fas fa-tint text-info"></i>  {{player.status[1].percent | number:0}}%
                    </td>
                    <td  ng-if="identity=='1'||identity=='2'">
                        <a ng-click="changePlayerData(player.identifier,player.phone_number,player.dead)" class="text-secondary cursor-pointer" data-toggle="modal" data-target="#exModal" ><i class="fas fa-user-edit"></i></a>
                    </td>
                </tr>
            </tbody>
        </table></small>
        <!-- <div class="display-1" ng-hide="access">YOU DO NOT HAVE THE <span class="primary-color">ACCESS!</span></div> -->
    </div>

    <div class="modal fade bd-inventory-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <table class="table">
                    <thead class="thead-light">
                        <tr class="text-left">
                            <th scope="col">Item</th>
                            <th scope="col">Count</th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <tr ng-repeat="item in userInventory" ng-if="userInventory.length > 0" ng-cloak>
                            <th scope="row"><small>{{item.item}}</small></th>
                            <td><small>{{item.count | lowercase | strReplace:'_':' '}}</small></td>
                        </tr>
                        <tr ng-if="userInventory.length == 0" class="primary-color" ng-cloak>
                            <th scope="row">Gareeb</th>
                            <th><i class="fas fa-ban"></i></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade bd-car-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mycarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <table class="table">
                    <thead class="thead-light">
                        <tr class="text-left">
                            <th scope="col">LIST</th>
                            <th scope="col">CHECK</th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <tr ng-repeat="item in carList" ng-if="carList.length > 0" ng-cloak>
                            <th scope="row" class="primary-color"><small>{{item.plate}} </small></th>
                            <th class="primary-color"><small>
                                <a class="text-secondary dropdown-toggle" style="cursor:pointer;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ng-click="checkCarInventory(item.plate)">Inventory
                                    <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuButton">
                                        <small class="dropdown-item bg-light" ng-repeat="(key, value) in carInventory">
                                            <div class="text-primary" ng-if="value.length == 0">No Items!</div>
                                            <div class="text-dark" ng-repeat="_obj1 in value">
                                                <span class="text-secondary">{{_obj1.name | lowercase | strReplace:'_':' '}}</span> : 
                                                <span class="text-secondary">{{_obj1.count}}</span>
                                                <span class="text-secondary">{{_obj1.ammo}}</span>
                                            </div>
                                        <!-- <a class="dropdown-item primary-color" ng-if="carInventory.length == 0" ng-cloak>No items!</a> -->
                                        </small>
                                    </div>
                                </a></small>
                            </th>
                        </tr>
                        <tr ng-if="carList.length == 0" class="primary-color" ng-cloak>
                            <th scope="row">Gareeb</th>
                            <th><i class="fas fa-ban"></i></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade bd-home-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myhomeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <table class="table">
                    <thead class="thead-light">
                        <tr class="text-left">
                            <th scope="col">LIST</th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <tr ng-repeat="item in propertyList" ng-if="propertyList.length > 0" ng-cloak>
                            <th scope="row" class="primary-color"><small>{{item.name | strCapSpace}} </small></th>
                        </tr>
                        <tr ng-if="propertyList.length == 0" class="primary-color" ng-cloak>
                            <th scope="row">Gareeb &nbsp; <i class="fas fa-ban"></i></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade bd-home-inventory-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myhomeInventoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <table class="table">
                    <thead class="thead-light">
                        <tr class="text-left">
                            <th scope="col">LIST</th>
                            <th scope="col">COUNT</th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <tr ng-repeat="item in homeInventory" ng-if="homeInventory.length > 0" ng-cloak>
                            <th scope="row" class="primary-color"><small>{{item.name | strCapSpace}} </small></th>
                            <th scope="row" class="primary-color"><small>{{item.count | strCapSpace}} </small></th>
                        </tr>
                        <tr ng-if="homeInventory.length == 0" class="primary-color" ng-cloak>
                            <th scope="row">Gareeb &nbsp;</th>
                            <th scope="row"><i class="fas fa-ban"></i></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exModal" tabindex="-1" role="dialog" aria-labelledby="exModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <small class="modal-content">
                <div class="row">
                    <div class="col-3">
                        <table class="table">
                            <thead class="thead-light">
                                <tr class="text-left">
                                    <th scope="col"><small>CARS</small></th>
                                    <th scope="col"><small>PLATE</small></th>
                                    <th scope="col"><small>DELETE</small></th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                                <tr>
                                    <div class="collapse" id="collapseExe">
                                        <div class="card card-body">
                                            <input type="text" class="form-control" aria-label="Sizing example input" ng-model="plateNo" ng-change="checkPlateAvail(plateNo);" aria-describedby="inputGroup-sizing-sm"><br>
                                            <small class="text-muted">Character limit (4-7)</small>
                                            <button type="button" ng-click="changePlate(selected_plate,plateNo)" ng-disabled="!correct_plate_flag" ng-class="!correct_plate_flag ? 'btn btn-warning':'btn btn-success'">
                                                    <span class="text-danger" ng-if="!correct_plate_flag"><i class="fas fa-times"></i></span>
                                                    Change</button>
                                            <br><hr>
                                            <span class="text-info">{{selected_plate}}</span>
                                        </div>
                                    </div>
                                </tr>
                                <tr class="border-0" ng-repeat="item in carList" ng-if="carList.length > 0" ng-cloak>
                                    <td scope="row" class="primary-color"><small>{{item.plate}}</small> </td>
                                    <td scope="row" class="text-warning"><small><a class="cursor-pointer" ng-click="selectPlate(item.plate)" data-toggle="collapse" data-target="#collapseExe" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-edit"></i></small></a></td>
                                    <td class="primary-color">
                                        <a ng-click="selectPlate(item.plate)" data-toggle="modal" data-target=".bd-delete-modal-sm" class="text-danger cursor-pointer" >
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table class="table">
                            <thead class="thead-light">
                                <tr class="text-left">
                                    <th scope="col"><small>PROPERTY</small></th>
                                    <th scope="col"><small>DELETE</small></th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                                <tr ng-repeat="item in propertyList" ng-if="propertyList.length > 0" ng-cloak>
                                    <th scope="row" class="text-info"><small>{{item.name | strCapSpace}} </small></th>
                                    <th class="primary-color">
                                        <a ng-click="selectHouse(item.name)" data-toggle="modal" data-target=".bd-delete-house-modal-sm" class="text-danger cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </th>
                                </tr>
                                <tr ng-if="propertyList.length == 0" class="primary-color" ng-cloak>
                                    <th scope="row">Gareeb &nbsp;</th>
                                    <th scope="row"> <i class="fas fa-ban"></i></th>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table class="table">
                            <thead class="thead-light">
                                <tr class="text-left">
                                    <th scope="col"><small>INVENTORY ITEM</small></th>
                                    <th scope="col"><small>COUNT</small></th>
                                    <th scope="col"><small>EDIT</small></th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                                <tr ng-repeat="item in userInventory" ng-if="userInventory.length > 0" ng-cloak>
                                    <th scope="row" class="text-secondary"><small>{{item.item}}</small></th>
                                    <td><small>{{item.count | lowercase | strReplace:'_':' '}}</small></td>
                                    <td class="text-info"><small><i class="fas fa-edit"></i></small></td>
                                </tr>
                                <tr ng-if="userInventory.length == 0" class="primary-color" ng-cloak>
                                    <th scope="row">Gareeb</th>
                                    <th scope="row"></th>
                                    <th><i class="fas fa-ban"></i></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-2">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr class="text-left">
                                        <th scope="col"><small>User Data</small></th>
                                        <!-- <th scope="col"><small>CHANGE</small></th> -->
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    <tr>
                                        <div class="collapse" id="collapsemobile">
                                            <div class="card card-body">
                                                <input type="text" class="form-control" style="font-size:16px;width:100px;margin-left: -17px;" aria-label="Sizing example input" ng-model="newPhoneNo"  ng-change="checkPhoneAvail(newPhoneNo);" aria-describedby="inputGroup-sizing-sm"><br>
                                                <small class="text-muted">Valid No.<br>(XXX-XXXX)</small>
                                                <button style="height:25px;font-size:12px;" class=" btn-sm" type="button" ng-click="changePhone(phoneNumber_selected,newPhoneNo)" ng-disabled="!correct_phone_flag" ng-class="!correct_phone_flag ? 'btn btn-warning':'btn btn-success'">Change</button>
                                                <br><hr>
                                                <span class="text-info">{{phoneNumber_selected}}</span>
                                            </div>
                                        </div>
                                    </tr>
                                    <tr ng-cloak>
                                        <!-- <th scope="row"><small>Mobile No.</small></th> -->
                                        <td class="text-warning"><small><a class="cursor-pointer" data-toggle="collapse" data-target="#collapsemobile" >Edit Mobile</a></small></td>
                                    </tr>
                                    <tr ng-cloak>
                                        <!-- <th scope="row"><small>Dead</small></th> -->
                                        <td>
                                            <small>
                                                <label class="switch"><input ng-model="alive_status" ng-change="deadOrAlive(identifier_selected, alive_status)" type="checkbox" id="togBtn"><div class="slider round"><!--ADDED HTML --><span class="on">ALIVE&nbsp;&nbsp;&nbsp;</span><span class="off">&nbsp;&nbsp;&nbsp;DEAD</span><!--END--></div></label>
                                            </small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-info btn-small" ng-click="getPlayerData(identifier_selected)">OVERALL CAR ITEMS</button><br><br>
                        </div>
                        <div class="col-3">
                            <div ng-if="overall==1">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr class="text-left">
                                            <th scope="col"><small>Car Items</small></th>
                                            <th scope="col"><small>Amount</small></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        <tr ng-repeat="_caritem in car_inventory_all.weapons" ng-cloak>
                                            <th scope="row"><small>{{_caritem.label}}</small></th>
                                            <td><small>{{_caritem.ammo}}</small></td>
                                        </tr><tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr ng-repeat="_caritem in car_inventory_all.coffre" ng-cloak>
                                            <th scope="row"><small>{{_caritem.name}}</small></th>
                                            <td><small>{{_caritem.count}}</small></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                    </div>
                </div>
            </small>
        </div>
        <div class="modal fade bd-delete-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Delete Plate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>Are you sure you want to delete car with Licene Plate {{selected_plate}}</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" ng-click="deleteCar(selected_plate);" class="btn btn-warning" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-delete-house-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Delete House</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>Are you sure you want to delete House with name {{selected_house}}</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" ng-click="deleteHouse(selected_house,identifier_selected);" class="btn btn-warning" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>