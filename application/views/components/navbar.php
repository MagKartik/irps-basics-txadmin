<nav class="navbar navbar-expand-lg navbar-light bg-light bg-h-basic nav-box-shadow fixed-top" ng-controller="navCtrl">
  <div class="container">
    <a ng-href="#!" class="navbar-brand">
      <img src="assets/icons/icon.png" height="35px" class="d-inline-block align-top" alt="" draggable="false">
    </a>
    <button class="navbar-toggler nav-tog" style="margin-top:-10px;margin-right:10px;" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse bg-light" id="navbarNav" style="z-index: 1;margin-left:-10px;margin-right:-10px;padding-left:20px;padding-right:20px;">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item d-block d-xl-none d-lg-none d-sm-none cursor-pointer" ng-if="loginFlag" ng-cloak>
            <p><img ng-src="{{$root.details.avatar}}" style="border-radius: 50%;" height="45px"></p>
            <p>{{$root.details.personaname}}<br><small class="primary-color">Steam ID:{{$root.details.steamid}}</small><p>
        </li>
        <li class="nav-item d-block d-xl-none d-lg-none d-sm-none" ng-if="loginFlag" ng-cloak>
          <a class="nav-link f-14 cursor-pointer" style="display: block !important;" ng-click="redirectTo('/profile')"><i class="fas fa-id-badge"></i> &nbsp;My Profile <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link f-14 cursor-pointer"  ng-click="redirectTo('/')"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link f-14 cursor-pointer"  ng-click="discord()"><i class="fab fa-discord"></i> Discord</a>
        </li>
        <li class="nav-item">
          <a class="nav-link f-14 disabled" href="/pricing"><i class="fas fa-rupee-sign"></i> Get Priority</a>
        </li>
        <li class="nav-item">
          <a class="nav-link f-14 cursor-pointer"  ng-click="redirectTo('/forum')"><i class="fas fa-comments"></i> Forum</a>
        </li>
        <li class="nav-item d-block d-xl-none d-lg-none d-sm-none f-14">
          <a class="nav-link cursor-pointer" ng-if="loginFlag"  ng-click="logout()">Logout</a>
          <a class="nav-link cursor-pointer" ng-if="!loginFlag" ng-click="login()" ng-cloak>Login</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#eModalLong">Contact us</a>
        </li> -->
      </ul>
      
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" style="height: 50px;padding-top: 3px;border: 0;outline:none;" type="search" placeholder="Search" aria-label="Search" ng-model="$root.key" ng-keydown="$root.search_forum($root.key,$event)">
        <!-- <button class="btn p-button d-none d-lg-block d-xl-block" style="width:120px;height:35px;line-height: 20px;font-size:12px;color:#ffffff;" href="https://discord.gg/PYMcEQk">SEARCH</button> -->
      </form> &nbsp;&nbsp;&nbsp;
      <a class="nav-link  d-none d-md-block d-lg-block  cursor-pointer" ng-if="!loginFlag"  ng-click="login()" style="color:#4a4a4a;" ng-cloak>login</a>
      <!-- Example single danger button -->
      <div class="btn-group d-none d-md-block d-lg-block" ng-if="loginFlag" ng-cloak>
          <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img ng-src="{{$root.details.avatar}}" style="border-radius: 50%;" height="40px" draggable="false">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item primary-color bg-light bg-ff disabled" style="cursor: pointer !important;">Hey {{$root.details.personaname}}!</a>
            <a class="dropdown-item bg-light bg-f1" href="#!/profile">My Account</a>
            <small class="dropdown-item bg-light bg-f1 disabled">Steam ID:{{$root.details.steamid}}</small>
            <a class="dropdown-item bg-light bg-ff" href="#!/forum">Discussion</a>
            <a class="dropdown-item bg-light bg-ff disabled" href="#">Report a player</a>
            <div class="dropdown-divider bg-light bg-ff"></div>
            <a class="dropdown-item bg-light bg-ff cursor-pointer" ng-if="loginFlag" ng-click="logout()">Logout</a>
          </div>
        </div>
    </div>
  </div>
</nav>
<contact></contact>