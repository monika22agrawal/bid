<section class="banner">
    <div id="HomeSlider" class="owl-carousel">
      <!-- <div class="item">
        <img src="img/slide-1.jpg" alt="">
      </div> -->
      <div class="item">
        <img src="<?php echo base_url().FRONT_THEME;?>img/slide-5.png" alt="">
      </div>
      <!-- <div class="item">
        <img src="img/slide-3.jpg" alt="">
      </div> -->
    </div>
    <div class="sliderCaption">
        <h2>BID HOME</h2>
        <p>Bid Home is a revolutionary real estate agency. Bid Home assist you buy and sell property online. Bid home provide services such as home loan and valuation.</p>
        <a class="btn btn-theme" href="<?php echo base_url('buyer/propertyList');?>">Browse Property</a>
    </div>
</section>
<section id="AboutSec" class="at-about-sec pt-6">
    <div class="container">
        <div class="row animatedParent animateOnce">
            <div class="col-lg-7 col-md-8 col-sm-12">
                <div class="at-about-col at-col-default-mar">
                    <div class="at-about-title">
                        <h1>About <span>Bid Home</span></h1>
                    </div>
                    <p>Bid Home is an Australian property site with a difference. Bid Home lets you browse property listings, bid on property, auction property, all with the fairest price and lowest cost. Sign up now to start buying or selling property.</p>
                    <p>At Bid Home, we take the guesswork out of buying or selling property.</p>
                </div>
            </div>
            <div class="col-lg-5 col-md-4 col-sm-12 hidden-md">
                <div class="at-about-col">
                    <img src="<?php echo base_url().FRONT_THEME;?>img/1.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section id="info-banner" class="info-banner sec-pad parallax">
    <div class="container">
        <div class="info-dtl text-center">
            <h3 class="info-heading">How much is your home worth?</h3>
            <p class="info-post">Order a valuation report to find out how much your home or investment is worth. Selling
            a property? List for free with Bid Home, upload your photos and let buyers bid on our property. Sell your property for the best price.</p>
            <!-- <a href="#" class="btn btn-theme mt-5">Find Out</a> -->
        </div>
    </div>
</section>
<section class="FeaturedPr sec-pad gray-bg">
    <div class="container">
        <div class="mainHead">
            <h2>Recent <span>Listings</span></h2>
            <div class="at-heading-under-line">
                <div class="at-heading-inside-line"></div>
            </div>
            <p>Browse available property listings.</p>
        </div>
        <div class="prPart parallax mt-45">
            <div class="pr-carousel owl-carousel owl-theme">
                <?php if(!empty($property)) {
                        foreach ($property as $property) {  ?>
                <div class="item">
                    <div class="at-property-item <?php echo ($property->propertyStatus == '2') ? 'OldPr' : '' ?>">
                        <div class="at-property-img imgheight">
                            <img src="<?php echo $property->pImage; ?>" alt="">
                            <div class="at-property-overlayer"></div>
                            <a class="btn btn-default at-property-btn" href="<?php echo base_url('buyer/viewProperty/').$property->id;?>" role="button">View Details</a>
                            <!-- <h4>For Sale</h4> -->
                            <h5><?php echo ucwords($property->typeName); ?></h5>
                            <?php if($property->propertyStatus == '2'){?>
                                <div class="rightCor oldCor"><span>Old</span></div>
                            <?php } else{ ?>
                                <div class="rightCor newCor"><span>New</span></div>
                            <?php } ?>
                        </div>
                        <div class="at-property-dis">
                            <ul>
                                <li><i class="fa fa-object-group" aria-hidden="true"></i><?php echo $property->area; ?> sq ft</li>
                                <?php if(!empty($property->bedRoom)) {?>
                                    <li><i class="fa fa-bed" aria-hidden="true"></i> <?php echo $property->bedRoom; ?></li>
                                <?php } 
                                if(!empty($property->bathRoom)) {?>
                                    <li><i class="fa fa-bath" aria-hidden="true"></i> <?php echo $property->bathRoom; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="at-property-location">
                            <h3><a href="<?php echo base_url('buyer/viewProperty/').$property->id;?>"><?php echo ucwords($property->propertyName); ?></a></h3>
                            <h5>$ <?php echo $property->purchaseAmount; ?></h5>
                            <p><i class="fa fa-map-marker"></i> <?php echo $property->address; ?></p>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </div>
</section>
<section class="client-say-about ">
    <div class="opacity sec-pad">
        <div class="container">
            <h5>What Clients Say</h5>
            <div class="client-slider owl-carousel owl-theme owl-loaded">
                <div class="item">
                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit</p>
                    <div class="client-name">
                        <h6>foqrul islam</h6>
                        <!-- <img src="img/client-01.jpg" alt="image"> -->
                    </div>
                </div>
                <div class="item">
                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit</p>
                    <div class="client-name">
                        <h6>foqrul islam</h6>
                        <!-- <img src="img/client-03.jpg" alt="image"> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="Newsletter sec-pad">
    <div class="container">
        <div class="newsCnt">
        <div class="mainHead mb-5 Hcenter">
            <h2>Our <span>Services</span></h2>
            <div class="at-heading-under-line lCenter">
                <div class="at-heading-inside-line"></div>
            </div>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum totam et dolores voluptatem porro tempore temporibus ducimus</p> -->
        </div>
        <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <div class="h2">Residential Property Sales</div>
                        <p>Buy or sell new properties,established properties, off the plan properties and buyer agent services.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service">
                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                        <div class="h2">Property Valuation</div>
                        <p>Find out what your home or investment property is worth with a comprehensive property appraisal.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                        <div class="h2">Home Loan Services</div>
                        <p>Mortgage broking services to help with your property purchase or refinance your home loan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                        <div class="h2">Add Buyer Agency</div>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>