<div class="container pd-top-100" ng-controller="forumCtrl">
    <div ng-if="forum_post_details.post.title">
        <div class="jumbotron">
            <div class="row">
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 col-11">
                    <h1 class="display-4">{{forum_post_details.post.title}}</h1>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1">
                    <a ng-if="forum_post_details.post.identifier == $root.details.steamid" data-toggle="modal" data-target="#confirm-delete-modal-sm" ng-click="deletePost(forum_post_details.post.id, forum_post_details.post.comment_id)" style="cursor:pointer;">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </div>
            <p class="lead">{{forum_post_details.post.content}}</p>
            <hr class="my-4">
            <p>-{{forum_post_details.post.p_name}}, {{forum_post_details.post.post_date | date}}</p>
        </div><br>
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 col-9">
                <input type="text" class="form-control" ng-model="comment_post" placeholder="Enter comment" ng-disabled="!$root.isLogin">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                <button type="button" class="btn btn-light btn-block" ng-if="$root.isLogin" ng-click="post_comment($root.details.realname, $root.details.avatarfull, forum_post_details.post.comment_id, comment_post, $root.details.steamid);">Post</button>
                <a class="btn btn-light btn-block" ng-if="!$root.isLogin" href="{{server.ip}}/assets/steam_auth/steamauth/steamauth.php?login" ng-cloak>Login</a>
            </div>
        </div><br>
        <ul class="list-group" lazy-scroll="loadCounter()" lazy-scroll-trigger="80">
            <li class="list-group-item" ng-repeat="comment in forum_post_details.comment | limitTo : counter">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1">
                        <img ng-src="{{comment.img_url}}" height="50px">
                    </div>
                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 col-11">
                        {{comment.content}}<br>
                        <small>-{{comment.name}}, {{comment.post_date | date}}</small>
                    </div>
                </div>
            </li>
        </ul><br>
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
                    {{forum_post_details.post.title}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="confirmDelete(del_id,del_comment_id)">Delete</button>
                </div>
            </div>
        </div>
    </div><br>
</div>