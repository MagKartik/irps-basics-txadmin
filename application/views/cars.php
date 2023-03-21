<div ng-controller="carCtrl" class="gallery-car-bg">
    <div class="top-row section pd-top-60 bg-bc bg-h-car" style="background-image: url('assets/icons/gallery/cars/bg.webp');background-size: 100%">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-6 col-xs-12 pd-top-100">
                    <h1 class="display-4 font-weight-bold" style="font-size: 2.8rem;">CUSTOMIZED CARS</h1><br>
                    <p class="text-muted p-gallery-margin">One of the best parts about living life in the IRPS city is to see fun roleplay at every corner.
                        It makes you driving along the roads with an amazing experience. Browse and experience all exotics here at IRPS.</p><br>
                    <button class="btn car-browse-btn text-white">BROWSE IMAGES</button>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
            <span class="display-4 text-muted font-weight-bold" style="font-size: 2.8rem;">BRANDS</span> &nbsp; &nbsp;
            <span style="width: 120px;height: 5px;background: #FF1528 0% 0% no-repeat padding-box; opacity: 1;position: absolute;margin-top: 27px;"></span>
        </div><br><br>
        <div class="container">

        <ui-carousel slides="ctrl.multiple.slides" slides-to-show="3" slides-to-scroll="3" dots="true">
            <carousel-item>
                <h3>{{ item + 1 }}</h3>
            </carousel-item>
        </ui-carousel>



            <div class="row">
                <div class="col-1 text-center f-40 text-muted" style="line-height: 120px;"><a ng-click="scrollLeft()" class="arrowL"><i class="fas fa-angle-left"></i></a></div>
                <div class="col-10 testimonial-group text-center">
                    <div class="row text-center flex-nowrap item">
                        <div class="col-sm-4"><img src="assets/icons/gallery/cars/brand1.jpg" draggable="false" height="120px"></div><!--
                        --><div class="col-sm-4"><img src="assets/icons/gallery/cars/brand2.jpg" draggable="false" height="120px"></div><!--
                        --><div class="col-sm-4"><img src="assets/icons/gallery/cars/brand3.jpg" draggable="false" height="120px"></div><!--
                        --><div class="col-sm-4"><img src="assets/icons/gallery/cars/brand1.jpg" draggable="false" height="120px"></div><!--
                        --><div class="col-sm-4"><img src="assets/icons/gallery/cars/brand2.jpg" draggable="false" height="120px"></div><!--
                        --><div class="col-sm-4"><img src="assets/icons/gallery/cars/brand3.jpg" draggable="false" height="120px"></div><!--
                        --><div class="col-sm-4"><img src="assets/icons/gallery/cars/brand1.jpg" draggable="false" height="120px"></div><!--
                        --><div class="col-sm-4"><img src="assets/icons/gallery/cars/brand2.jpg" draggable="false" height="120px"></div><!--
                        --><div class="col-sm-4"><img src="assets/icons/gallery/cars/brand3.jpg" draggable="false" height="120px"></div>
                    </div>
                </div>
                <div class="col-1 text-center f-40 text-muted" style="line-height: 120px;"><a  ng-click="scrollright()" class="arrowR"><i class="fas fa-angle-right"></i></a></div>
            </div><br>
        </div>
    </div><br><br>
    <div class="top-row section pd-top-60 bg-bc bg2-h-car" style="background-image: url('assets/icons/gallery/cars/bg2.webp');">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h1 class="display-4 text-white" style="font-size: 1.2rem;">GET CUSTOM NUMBER PLATE</h1>
                    <small class="text-muted"><span class="font-weight-bold">Fun Fact</span> : IRPS (Indian Role-Play Server) give more flexibility to ingame players. Citizens inside can change there number plate with the text of there choice <span style="color: #880000;">(For Prime Users)</span>.</small>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-7">
                <span class="display-4 text-muted font-weight-bold" style="font-size: 2.8rem;">ALL CARS</span> &nbsp; &nbsp;
                <span style="width: 120px;height: 5px;background: #FF1528 0% 0% no-repeat padding-box; opacity: 1;position: absolute;margin-top: 27px;"></span>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col-6">
                        <div class="dropdown" style="line-height:53px;">
                            <button class="btn btn-light dropdown-toggle text-muted" style="background: #DEDEDE 0% 0% no-repeat padding-box; width: 200px;height: 45px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              BRAND
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Action</a>
                              <a class="dropdown-item" href="#">Another action</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dropdown" style="line-height:53px;">
                            <button class="btn btn-light dropdown-toggle text-muted" style="background: #DEDEDE 0% 0% no-repeat padding-box;width: 200px;height: 45px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Price (High-Low)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <?=$footer?>
</div>