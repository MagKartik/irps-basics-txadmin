<div class="display-4 text-center">Characters</div><br>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Money</th>
            <th scope="col">Bank</th>
            <th scope="col">Job</th>
            <th scope="col">Mobile</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="character in character_details">
            <th scope="row">{{character.firstname}} {{character.lastname}}</th>
            <td><i class="fas fa-rupee-sign"></i> {{character.money}}</td>
            <td><i class="fas fa-rupee-sign"></i> {{character.bank}}</td>
            <td>{{character.job}}</td>
            <td>{{character.phone_number}}</td>
        </tr>
    </tbody>
</table>