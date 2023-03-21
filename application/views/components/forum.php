<div class="card card-form card-radius" style="padding:20px;">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                <div>
                    <img ng-src="{{forumvar.img_url}}" height="100px" style="border-radius: 18px;">
                </div><br>
                <small class="raleway">{{forumvar.p_name}}</small>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-12 text-left">
                <div class="row primary-color">
                    <div class="col-xs-6 col-6">
                        <i class="fas fa-comment"></i> <span>3</span> &nbsp; <span>{{forumvar.post_date | date}}</span>
                    </div>
                    <div class="col-xs-6 col-6 text-right">
                        <i class="fas fa-thumbs-up" style="color:#c3c3c3;"></i> &nbsp;
                        <a data-toggle="collapse"  data-toggle="collapse" data-target="#collapseE{{forumvar.id}}" aria-expanded="false" aria-controls="collapseE">
                            <i class="fas fa-reply"></i> &nbsp;
                        </a>
                        <a ng-if="forumvar.identifier == $root.details.steamid" data-toggle="modal" data-target="#confirm-delete-modal-sm">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <h3 class="raleway" style="color:#4A4A4A;">{{forumvar.title}}</h3>
                <span>
                    {{forumvar.content}}
                </span>
                  <div class="collapse" id="collapseE{{forumvar.id}}"><br>
                        <textarea class="form-control">
                        </textarea>
                        <div class="text-right" style="padding-top: 10px;">
                            <a class="btn p-button" style="width:100px;height:28px;line-height: 17px;font-size:12px;color:#ffffff;" href="">Send</a>
                        </div>
                        <br>
                    <div class="card card-body raleway" style="background-color: #f1f1f1;color:#4a4a4a;">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2 text-center">
                                <img src="assets/icons/profile.jpg" height="70px" style="border-radius: 18px;"><br>
                                <small class="raleway">Full Name</small>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 col-10">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                            </div>
                        </div>
                    </div><br>
                  </div>
            </div>
        </div>
    </div>
</div>