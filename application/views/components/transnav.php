<div class="fixed-top nav-drag mob-color" ng-controller="navCtrl">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light  scrolling-navbar">
            <a class="navbar-brand cursor-pointer" ng-click="redirectTo('')">
                <img src="assets/icons/logo_new_nav.png" height="15px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none d-lg-none d-sm-none cursor-pointer" ng-if="loginFlag" ng-cloak>
                        <p><br><img ng-src="{{$root.details.avatar}}" style="border-radius: 50%;" height="45px"></p>
                        <p>{{$root.details.personaname}}<br><small class="new-primary">Steam ID:{{$root.details.steamid}}</small><p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cursor-pointer" ng-click="discord()">DISCORD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cursor-pointer" ng-click="discord()">GITHUB</a>
                    </li>
                    <li class="nav-item active-danger d-block d-xl-none d-lg-none d-sm-none f-14">
                        <a class="nav-link cursor-pointer" ng-if="loginFlag"  ng-click="logout()">LOGOUT</a>
                        <a class="nav-link cursor-pointer" ng-if="!loginFlag" ng-click="login()" ng-cloak>LOGIN</a>
                    </li> &nbsp;&nbsp;&nbsp;
                    <a class="nav-link active-danger d-none d-md-block d-lg-block  cursor-pointer" ng-if="!loginFlag"  ng-click="login()" ng-cloak>LOGIN</a>
                    <!-- Example single danger button -->
                    <div class="btn-group d-none d-md-block d-lg-block" ng-if="loginFlag" ng-cloak>
                        <a class="dropdown-toggle cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img ng-src="{{$root.details.avatar}}" style="border-radius: 50%;" height="40px" draggable="false">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item bg-light bg-ff disabled new-primary" style="cursor: pointer !important;">Hey {{$root.details.personaname}}!</a>
                            <a class="dropdown-item bg-light bg-f1" href="<?php echo base_url();?>profile">Control Panel</a>
                            <small class="dropdown-item bg-light bg-f1 disabled">Steam ID:{{$root.details.steamid}}</small>
                            <a class="dropdown-item bg-light bg-ff disabled" href="#">Powered by IRPS</a>
                            <div class="dropdown-divider bg-light bg-ff"></div>
                            <a class="dropdown-item bg-light bg-ff cursor-pointer" ng-if="loginFlag" ng-click="logout()">Logout</a>
                        </div>
                    </div>
                </ul>
            </div>
        </nav>
    </div>
</div>