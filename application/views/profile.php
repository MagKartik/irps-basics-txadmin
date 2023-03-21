<?php
    if(isset($player_data["role"]->access)){
        if($player_data["role"]->access==1){
            echo '<script> var isStaff = 1; </script>';
        }
        else {
            echo '<script> var isStaff = 0; </script>';
        }
    }
    else {
        echo '<script> var isStaff = 0; </script>';
    }
?>
<div ng-controller="loadingCtrl">
    <div class="container pd-top-80" ng-controller="mainCtrl">
        <div class="row" ng-cloak>
            <div class="col-sm-4">
                <div class="page-sidebar expandit mx-auto">
                    <div class="sidebar-inner" id="main-menu-wrapper">   
                        <div class="profile-image ">
                            <img ng-if="$root.details.avatarfull" ng-src="{{$root.details.avatarfull}}" style="width:260px;" class="img-inline img-responsive img-circle">
                        </div>
                        <div class="profile-info">
                            <div class="profile-details">
                                <h3>
                                    <a>{{$root.details.personaname}}</a> 
                                </h3>
                                <p class="profile-title">{{$root.details.realname}}</p>
                                <p class="profile-title primary-color" ng-if="<?php echo json_encode($priority["level"]);?> > 3" ng-cloak>Priority Ends : {{<?php echo $priority["days"];?>*1000 | date}}</p>
                            </div>
                        </div>
                        
                        <ul class="wraplist" id="myTab" role="tablist" style="height: auto;">	
                            <li class="nav-item cursor-pointer"><a class="nav-link active" id="profile-tab"  data-target="#profile" role="tab" aria-controls="profile" aria-selected="true" data-toggle="tab"><span class="sidebar-icon"><i class="fas fa-id-card"></i></span> <span class="menu-title">My Page</span></a></li>
                            <?php if(isset($player_data["role"]->access)){if($player_data["role"]->access){?><li class="nav-item cursor-pointer"><a class="nav-link" id="staff-tab" data-toggle="tab" data-target="#staff" role="tab" aria-controls="staff" aria-selected="false"><span class="sidebar-icon"><i class="fa fa-calendar"></i></span> <span class="menu-title">Staff Panel</span></a></li><?php }}?>
                        </ul>
                    </div>
                </div><br>
            </div><!--/col-3-->
            <div class="col-sm-8">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- <div class="display-4 text-center">My Page</div><br> -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-counter primary">
                                    <i class="fas fa-user-tag"></i>
                                    <span class="count-numbers"><?php if(isset($player_data["role"]->role)){echo $player_data["role"]->role;}else echo "Player";?></span>
                                    <span class="count-name">Role</span>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="card-counter danger">
                                    <i class="fas fa-level-up-alt"></i>
                                    <span class="count-numbers">{{<?php echo json_encode($priority["level"]);?> >= 6 ?'Level 1':<?php echo json_encode($priority["level"]);?> == 5 ? 'Level 2':<?php echo json_encode($priority["level"]);?> == 4 ? 'Level 3':<?php echo json_encode($priority["level"]);?> == 3?'Level 4':'No Priority'}}</span>
                                    <span class="count-name">Priority</span>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                    <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="staff-tab">
                        <div class="display-4 text-center">Staff Panel</div><br>
                        <div class="collapse show collapseTable">
                            <a href="<?php echo base_url();?>player" style="text-decoration: none;" class="card bg-info text-white text-center p-3 cursor-pointer">
                                <blockquote class="blockquote mb-0">
                                    <h4>Players</h4>
                                    <!-- <div class="blockquote-footer text-white"> -->
                                    <small>
                                        Search player by steam name/hex, first/last name, mobile number, car-plate number
                                    </small>
                                <!-- </div> -->
                                </blockquote>
                            </a><br>
                            <a href="<?php echo base_url();?>staff-management" style="text-decoration: none;" class="card bg-warning text-white text-center p-3 cursor-pointer">
                                <blockquote class="blockquote mb-0">
                                    <h4>Staff Management</h4>
                                    <!-- <div class="blockquote-footer text-white"> -->
                                    <small>
                                        Issue Discussion
                                    </small>
                                <!-- </div> -->
                                </blockquote>
                            </a><br>
                            <?php
                                if(isset($player_data["role"]->identity)){
                                    if(($player_data["role"]->identity==1)||($player_data["role"]->identity==2)){?>
                                        <a href="<?php echo base_url();?>priority" style="text-decoration: none;" class="card bg-secondary text-white text-center p-3 cursor-pointer">
                                            <blockquote class="blockquote mb-0">
                                                <h4>Priority</h4>
                                                <!-- <div class="blockquote-footer text-white"> -->
                                                <small>
                                                    Add players priority by (must have steam-2 Id, name, priority proof and details)
                                                </small>
                                            <!-- </div> -->
                                            </blockquote>
                                        </a><br>
                            <?php }}?>
                        </div>
                        <?php
                            if(isset($player_data["role"]->identity)){
                                if(($player_data["role"]->identity==1)||($player_data["role"]->identity==2)){?>
                                    <div class="text-center">
                                        <a class="btn btn-warning"  ng-click="staffPanel()" data-toggle="collapse" data-target=".collapseTable" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            {{editFlag?"COST EDIT OPTION":"UP MENU"}}
                                        </a>
                                    </div><br>
                        <?php }}?>
                        <div class="collapse collapseTable">
                            <div class="card card-body border-0" style="height:60vh;">
                                <small>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" ng-model="vehicle_cat_flag" ng-change="setVehicleCat(vehicle_cat_flag)" id="myonoffswitch" checked>
                                                <label class="onoffswitch-label" for="myonoffswitch">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <select ng-model="_category" class="form-control" ng-options="_option.name as _option.name for _option in vehicle_cat">
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control border-0" ng-model="vehicle_key" ng-change="getVehicleList(_category,vehicle_key)" type="text" style="max-width: 500px; background-color: #f3f3f3;" placeholder="Search Vehicle"><br>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table" style="height: 45vh;overflow-y: scroll;display: block;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col" style="min-width:100px!important;">Price</th>
                                                <th scope="col text-warning"><i class="far fa-edit"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="_item in vehicle_list | filter:vehicle_key" ng-if="_item.category==_category||_category=='Select a category'">
                                                <th scope="row">{{$index+1}}</th>
                                                <td>{{_item.name}}</td>
                                                <td>{{_item.category}}</td>
                                                <td style="min-width:100px!important;">{{_item.price}}<br>
                                                    <div class="collapse" id="collapsePrice{{$index+1}}">
                                                        <input type="number" class="form-control" style="width:100px!important;font-size: 12px;padding-left: 3px" ng-model="setMoney" aria-label="input" aria-describedby="inputGroup-sizing-sm">
                                                        <a class="btn btn-info cursor-pointer text-white" style="margin-top:5px;width:100px!important;height: 25px;font-size: 12px;line-height: 12px;" ng-click="changePrice(!vehicle_cat_flag,_item.model,setMoney,vehicle_cat_flag)">Change!</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="cursor-pointer text-info" data-toggle="collapse" data-target="#collapsePrice{{$index+1}}" aria-expanded="false" aria-controls="collapsePrice"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </small>
                            </div>
                        </div>
                    </div>
                    
                <br><br>
                
            </div><!--/col-9-->
        </div><!--/row-->
        
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
      </div>
    </div>
    <div class="text-center" ng-show="loading">
        <!-- <footer></footer> -->
    </div>
</div>