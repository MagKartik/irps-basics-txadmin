<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card-counter primary">
            <i class="fas fa-user-tag"></i>
            <span class="count-numbers">{{role_details.role}}</span>
            <span class="count-name">Role</span>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card-counter danger">
            <i class="fas fa-level-up-alt"></i>
            <span class="count-numbers">{{priority_details.level >= 6 ?'Level 1':priority_details.level == 5 ? 'Level 2':priority_details.level == 4 ? 'Level 3':priority_details.level == 3?'Level 4':'No Priority'}}</span>
            <span class="count-name">Priority</span>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card-counter success">
            <i class="fab fa-wpforms"></i>
            <span class="count-numbers">{{forum_details}}</span>
            <span class="count-name">My Posts</span>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card-counter info">
            <i class="fa fa-users"></i>
            <span class="count-numbers">{{character_details.length}}</span>
            <span class="count-name">Characters</span>
            </div>
        </div>
    </div>
</div> 