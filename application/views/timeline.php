<div class="bg-bc" style="background-image: url('assets/icons/landing_bg.png');">
    <div class="pd-top-60 bg-bc container" ng-controller="mainCtrl">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pd-top-40 ">
                <?=$sidenav?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pd-top-40" style="overflow: scroll;height:670px;">
                <div class="row">
                    <div class="col-12">
                        <?=$upload?><br><br>
                    </div>
                    <div class="col-12">
                        <div class="card card-form" style="padding:20px; border-radius: 5px;background-color: rgba(0,0,0,0.1);">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12 col-12">
                                        <div class="margin-top-5">
                                            <img ng-src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/95/95bec292b92ab415b350ef3866ac422db790a215_full.jpg" height="40px" style="border-radius: 20px;">
                                        </div><br>
                                    </div>
                                    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 col-12 text-left">
                                        <div class="row primary-color">
                                            <div class="col-lg-8 col-md-8 col-xs-8 col-8">
                                                <small>
                                                    <span class="raleway font-weight-bold text-muted">Ganesh Kumar</span>
                                                    <span class="f-12 text-muted" style="font-size: 16px;">
                                                        (<small>Dec 20, 2019<!-- {{f_details.post_date | date}} --></small>)
                                                    </span><br>
                                                </small>
                                                <a class="primary-color" style="text-decoration:none;" href="<?php echo base_url();?>view-post?post={{f_details.comment_id}}">
                                                    <small class="f-10">View post</small>
                                                </a>&nbsp; 
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-xs-4 col-4 text-right">
                                                <a data-toggle="collapse"  data-toggle="collapse" data-target="#collapseE{{f_details.id}}" aria-expanded="false" aria-controls="collapseE" style="cursor:pointer;">
                                                    <small><i class="fas fa-reply"></i>&nbsp;</small>
                                                </a>&nbsp;
                                                <small>
                                                    <a data-toggle="modal" data-target="#confirm-delete-modal-sm" ng-click="deletePost(f_details.id,f_details.comment_id)" style="cursor:pointer;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-left">
                                        <h3 class="raleway" style="color:#5F5F5F;">Awesome Status</h3><br>
                                        <span>
                                            <img ng-src="https://cdn.discordapp.com/attachments/649596405299544076/649606684452585492/4.JPG" style="border-radius:5px;width:100%;">
                                        </span>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12"><br>
                                        <textarea class="form-control" style="resize:none;" placeholder="Post a comment" ng-model="comment1" ng-disabled="!$root.isLogin"></textarea>
                                        <div class="text-right" style="padding-top: 10px;">
                                            <a class="btn p-button" ng-if="$root.isLogin" style="width:100px;height:28px;line-height: 17px;font-size:12px;color:#ffffff;" ng-click="post_comment($root.details.realname, $root.details.avatarfull, f_details.comment_id, comment1, $root.details.steamid);" ng-cloak>Send</a>
                                            <a class="btn p-button" ng-if="!$root.isLogin"style="width:150px;height:28px;line-height: 17px;font-size:12px;color:#ffffff;" href="{{server.ip}}/assets/steam_auth/steamauth/steamauth.php?login" ng-cloak>Login to reply</a>
                                        </div>
                                        <br>
                                        <div class="card card-body raleway border-0 collapse" id="collapseE{{f_details.id}}" style="background-color: rgba(0,0,0,0.08);color:#4a4a4a;" >
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                                    <div id="messages">
                                                        <div class="msg-left">
                                                            <small  class="f-14 raleway text-muted font-weight-bold">Some Name</small>&nbsp;&nbsp;<small class="f-10 text-muted">(Dec 20, 2019<!-- {{f_details.post_date | date}} -->)</small><br>
                                                            Some big content
                                                        </div>
                                                        <div class="msg-left">
                                                            <small  class="f-14 raleway text-muted font-weight-bold">Some Name</small>&nbsp;&nbsp;<small class="f-10 text-muted">(Dec 20, 2019<!-- {{f_details.post_date | date}} -->)</small><br>
                                                            Some big content
                                                        </div>
                                                        <div class="msg-left">
                                                            <small  class="f-14 raleway text-muted font-weight-bold">Some Name</small>&nbsp;&nbsp;<small class="f-10 text-muted">(Dec 20, 2019<!-- {{f_details.post_date | date}} -->)</small><br>
                                                            fine
                                                        </div>
                                                        <div class="msg-right">
                                                            <small  class="f-16 raleway font-weight-bold" style="color:#fff;">Some Name</small>&nbsp;&nbsp;<small class="f-10 text-muted" style="color:#fff !important;">(Dec 20, 2019<!-- {{f_details.post_date | date}} -->)</small><br>
                                                            Some big contentSome big contentSome big contentSome big contentSome big content
                                                            Some big contentSome big contentSome big contentSome big contentSome big content
                                                            Some big contentSome big contentSome big content
                                                        </div>
                                                        <div class="msg-left">
                                                            <small  class="f-16 raleway text-muted font-weight-bold">Some Name</small>&nbsp;&nbsp;<small class="f-10 text-muted">(Dec 20, 2019<!-- {{f_details.post_date | date}} -->)</small><br>
                                                            Some big content
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>
                                        </div><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
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
</div>