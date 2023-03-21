<div ng-controller="mainCtrl" class="gallery-car-bg">
    <div class="top-row section pd-top-60 bg-bc bg-h-landing" style="background-image: url('assets/icons/landing_bg.png');">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-xs-12 pd-top-150">
                    <h1 class="display-4 font-weight-bold bignoodle" style="font-size: 60px;">THE IRPS BASICS</h1><br>
                    <p class="text-muted">IRPS Basic is a Admin/Staff Panel for a roleplay server for Grand Theft Auto V.
                        This panel helps you to check player's progress, manage queue priority, manage players data.
                    </p><br>
                    <span ng-if="$root.details.steamid" ng-cloak>
                        <a class="cursor-pointer btn car-browse-btn text-white bignoodle" href="<?=base_url()?>profile" style="line-height: 40px; font-size:18px;border-radius: 2px;">CONTROL PANEL</a>
                    </span>
                    <span ng-if="!$root.details.steamid" ng-cloak>
                        <a class="cursor-pointer btn car-browse-btn text-white bignoodle" href="<?=base_url()?>login" style="line-height: 40px; font-size:18px;border-radius: 2px;">LOGIN</a>
                    </span>
                </div><div class="col-xl-1 col-lg-1 col-md-1 d-none d-lg-block d-xl-none col-xs-12"></div>
                <div class="col-xl-6 col-lg-6 d-none d-lg-block d-xl-block  col-xs-12 pd-top-50">
                    <div class="img-bakchod">
                        <img src="assets/icons/bakchod_aadmi.webp" draggable="false" style="max-width:74vh;" class="img-fluid img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>