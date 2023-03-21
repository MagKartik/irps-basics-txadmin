<transnav></transnav>
<div class="bg text-center" ng-controller="bannedCtrl">
    <div class="container pd-top-100">
        <p class="h-font raleway">
            WALL OF <span class="primary-color">SHAME!</span>
        </p>
        <div>Why dont you do something more productive with your time</div>
        <small>Cheating or injecting scripts or to Disturb others gameplay poisons our IRPS Infra.<br>
        In the mean while we permanently banned and listed them here.</small><br><br>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Steam ID</th>
                <th scope="col">Name</th>
                <th scope="col">Profile Link</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="player in banned">
                <th scope="row"><img ng-src="{{player.img}}" height="100px"></th>
                <td>{{player.steamId}}<br>
                    <small class="primary-color">HEX : {{player.steamHex}}</small>
                </td>
                <td>{{player.name}}</td>
                <td><a class="primary-color" href="{{player.url}}">details</a></td>
              </tr>
            </tbody>
        </table>
    </div>
</div>
