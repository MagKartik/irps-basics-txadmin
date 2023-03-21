<div class="bg text-center" ng-controller="forumCtrl">
    <div class="container pd-top-100">
        <p class="h-font raleway">
            The IRPS <span class="primary-color">Forum</span>
        </p>
        <p class="raleway">
            Lets share our views and idea to make this server great. We read, we care, we apply.
        </p><br>
        <div class="row justify-content-center mx-auto" style="max-width: 1000px;">
            <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6 col-xs-6 d-none d-md-block d-lg-block">
                <!-- <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav> -->
                 
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" style="height: 50px;padding-top: 3px;width:100%;outline:none;" type="search" placeholder="Search" aria-label="Search" ng-model="$root.key" ng-keydown="$root.search_forum($root.key,$event)">
                    <!-- <button class="btn p-button d-none d-lg-block d-xl-block" style="width:120px;height:35px;line-height: 20px;font-size:12px;color:#ffffff;" href="https://discord.gg/PYMcEQk">SEARCH</button> -->
                </form> &nbsp;&nbsp;&nbsp;
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-right">
                <span class="raleway">Category : </span>&nbsp;
                <span class="dropdown" ng-init="selected='Discussion'">
                    <button class="btn btn-light dropdown-toggle select-form" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{selected}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item a-form" ng-repeat="link in forum_cat" ng-click="selectFilter(link.cat_name)">{{link.cat_name}}</a>
                    </div>
                </span>
            </div>
        </div>
        <br><br>
        <div class="row mx-auto" style="max-width: 1000px;" lazy-scroll="loadCounter()" lazy-scroll-trigger="80">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12" ng-repeat="f_details in forum_details | filter:$root.key | limitTo : counter" ng-if="selected==f_details.category">
                <div class="card card-form card-radius" style="padding:20px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                                <div><br>
                                    <img ng-src="{{f_details.img_url}}" height="100px" style="border-radius: 18px;">
                                </div><br>
                                <small class="raleway">{{f_details.p_name}}</small>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-12 text-left">
                                <div class="row primary-color">
                                    <div class="col-lg-8 col-md-8 col-xs-8 col-8">
                                        <a class="primary-color" href="<?php echo base_url();?>view-post?post={{f_details.comment_id}}"><small><i class="fas fa-eye"></i></small> <small>View post</small></a>,&nbsp; 
                                        <small>{{f_details.post_date | date}}</small>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-4 col-4 text-right">
                                        <!-- <a ng-class="forum_comment_details[0].liked==1 ? 'primary-color' : 'c3'" ng-click="toggleData(f_details.comment_id)">
                                            <i class="fas fa-thumbs-up"></i></a> &nbsp; -->
                                        <a data-toggle="collapse"  data-toggle="collapse" data-target="#collapseE{{f_details.id}}" aria-expanded="false" aria-controls="collapseE" style="cursor:pointer;">
                                            <small><i class="fas fa-reply"></i>&nbsp;</small>
                                        </a>&nbsp;<small>
                                        <a ng-if="f_details.identifier == $root.details.steamid" data-toggle="modal" data-target="#confirm-delete-modal-sm" ng-click="deletePost(f_details.id,f_details.comment_id)" style="cursor:pointer;">
                                            <i class="fas fa-trash-alt"></i>
                                        </a></small>
                                    </div>
                                </div>
                                <h3 class="raleway" style="color:#4A4A4A;">{{f_details.title}} <span style="font-size: 16px;">({{f_details.category}})</span></h3>
                                <span>
                                    {{f_details.content}}
                                </span>
                                    <div class="collapse" id="collapseE{{f_details.id}}"><br>
                                        <textarea class="form-control" ng-model="comment1" ng-disabled="!$root.isLogin"></textarea>
                                        <div class="text-right" style="padding-top: 10px;">
                                            <a class="btn p-button" ng-if="$root.isLogin" style="width:100px;height:28px;line-height: 17px;font-size:12px;color:#ffffff;" ng-click="post_comment($root.details.realname, $root.details.avatarfull, f_details.comment_id, comment1, $root.details.steamid);" ng-cloak>Send</a>
                                            <a class="btn p-button" ng-if="!$root.isLogin"style="width:150px;height:28px;line-height: 17px;font-size:12px;color:#ffffff;" href="{{server.ip}}/assets/steam_auth/steamauth/steamauth.php?login" ng-cloak>Login to reply</a>
                                        </div>
                                        <br>
                                        <div class="card card-body raleway border-top-0 border-left-0 border-right-0" style="background-color: #f3f3f3;color:#4a4a4a;" ng-repeat="comment in forum_comment_details" ng-if="comment.post_id==f_details.comment_id">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 col-3 text-center">
                                                    <img src="{{comment.img_url}}" height="70px" style="border-radius: 18px;"><br>
                                                    <small class="raleway">{{comment.name}}</small>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 col-9">
                                                    {{comment.content}}
                                                </div>
                                            </div><br>
                                        </div><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="modal fade" id="confirm-delete-modal-sm" tabindex="-1" role="dialog" aria-labelledby="confirmModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="eModalLongTitle">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{f_details.title}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="confirmDelete(del_id,del_comment_id,$root.details.steamid)">Delete</button>
                            </div>
                        </div>
                    </div>
                </div><br>
            </div>
        </div>
    </div>
</div>
<!-- <footer></footer> -->