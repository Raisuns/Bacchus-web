<?php include 'includes/contact_form.php'; ?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <title>Bacchus - Html Responsive One Page Template</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="Template by CocoBasic" />
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP" />
        <meta name="author" content="CocoBasic" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link rel="shortcut icon" href="images/favicon.ico" />    
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:300i,400,600' rel='stylesheet' type='text/css'>	

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href='css/common.css' />
        <link rel="stylesheet" type="text/css" href='css/font-awesome.min.css' />
        <link rel="stylesheet" type="text/css" href='css/slick.css' />
        <link rel="stylesheet" type="text/css" href='css/prettyPhoto.css' />
        <link rel="stylesheet" type="text/css" href='css/sm-clean.css' /> 
        <link href="style.css" rel="stylesheet">        

        <!--[if lt IE 9]>
                <script src="js/html5.js"></script>            
                <script src="js/respond.min.js"></script>       
        <![endif]-->

    </head>                                                                     
    <body>

        <!-- Preloader Gif -->
        <div class="doc-loader">                        
            <img src="images/preloader@2x.gif" alt="Loading..." />            
        </div>

        <!-- Menu -->
        <div class="menu-wrapper center-relative">	
            <nav id="header-main-menu">
                <?php include 'includes/logo.php'; ?>
                <div class="mob-menu">MENU</div>
                <ul class="main-menu sm sm-clean">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#support">Support</a></li>
                    <li><a href="#focus">Focus</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#contact">Contact</a></li>                                  
                </ul>
            </nav>            
        </div>    

        <!-- HOME SECTION -->

        <div id="home" class="section">
            <div class="box-wrapper">                                                                                             
                <div class="container-fluid">  
                    <div class="row no-gutter"> 
                        <div class="col-md-12">      
                            <script>
                                var slider1_speed = "1800";
                                var slider1_auto = "true";
                                var slider1_hover = "false";
                            </script>
                                <?php include 'includes/slider.php'; ?>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <!-- SERVICE SECTION -->
        <div id="services" class="section">
            <div class="box-wrapper">                                                
                <div class="content-980">                                                
                    <div class="container-fluid">  
                    <?php include 'includes/services.php'; ?>
                    </div>                                          
                </div>
            </div>
        </div>
        <!-- PORTFOLIO SECTION -->
        <div id="portfolio" class="section">                                
            <div class="box-wrapper">                                                                                                      
                <div class="grid" id="portfolio-grid">
                    <?php include 'includes/portfolio1.php'; ?>                        
                </div>
                <?php include 'includes/portfolio2.php'; ?>
            </div>                    
        </div>            
        <!-- NEWS SECTION -->
        <div id="news" class="section">                                
            <div class="box-wrapper">                                                                                              
                <div class="container-fluid">
                    <?php include 'includes/news.php'; ?>  
                </div>                                         
            </div>
        </div>
        <!-- SUPPORT SECTION -->
        <div id="support" class="section">                                
            <div class="box-wrapper">                                                                                              
                <div class="container-fluid">
                    <?php include 'includes/support.php'; ?>  
                </div>                                         
            </div>
        </div>
        <!-- FOCUS SECTION -->
        <div id="focus" class="section">                                
            <div class="box-wrapper">                                                                                              
                <div class="container-fluid">  
                    <div class="row no-gutter"> 
                        <?php include 'includes/focus.php'; ?>
                    <div class="row no-gutter"> 
                        <div class="col-md-12">
                            <script>
                                var text1_speed = "1800";
                                var text1_auto = "false";
                                var text1_hover = "true";
                            </script>
                            <?php include 'includes/testimonial.php'; ?>
                        </div>                        
                    </div>
                </div>                  
            </div>                  
        </div>                  
        <!-- PRICING SECTION -->
        <div id="pricing" class="section">                                
            <div class="box-wrapper">                                                                                              
                <div class="container-fluid">
                    <div class="content-980">
                        <div class="row no-gutter"> 
                            <div class="col-md-8 offset-md-2 pricing-intro">
                                Pricing me opinions returned absolute in. Otherwise therefore hex did are unfeeling something. Certain be ye amiable by exposed so. To celebrated estimating excellence do.
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row no-gutter"> 
                            <?php include 'includes/pricing.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TEAM SECTION -->
        <div id="team" class="section">                                
            <div class="box-wrapper">                                                                                              
                <div class="container-fluid">                      
                    <div class="row no-gutter"> 
                        <div class="col-md-12">
                            <img src="images/about_img_01.jpg" alt="Peter Johansen"/>
                        </div>
                        <?php include 'includes/team.php'; ?>
                    </div>                                         
                </div>
            </div>
        </div>
        <!-- CONTACT SECTION -->
        <div id="contact" class="section">                                
            <div class="box-wrapper">                                                                                              
                <div class="container-fluid"> 
                    <div class="row no-gutter">
                        <div class="col-md-12">
                            <?php include 'includes/counters.php'; ?>
                        </div>
                    </div>
                    <div class="row no-gutter">
                        <?php include 'includes/contact.php'; ?>                     
                        <div class="col-sm-6 col-md-6 contact-form-holder">
                            <?php include 'includes/contact_section.php'; ?>
                            <?php include 'includes/contact_form.php'; ?>
                        </div>
                    </div>
                </div>                                         
            </div>                  
        </div>
        <!-- Footer -->
        <footer>
            <div class="footer box-wrapper">	
                <div class="container-fluid">  
                    <div class="row no-gutter"> 
                        <div class="col-md-12 text-center">
                            <div class="footer-text">Hey, you can connect with us via major social network sites. Click on the logo below.</div>
                            <div class="social-footer">                
                                <a href="#"><span class="fa fa-twitter"></span></a>
                                <a href="#"><span class="fa fa-behance"></span></a>
                                <a href="#"><span class="fa fa-dribbble"></span></a>
                                <a href="#"><span class="fa fa-facebook"></span></a>
                                <a href="#"><span class="fa fa-rss"></span></a>           
                            </div>                            
                            <div class="copyright">© 2017 All Rights Reserved. - <a href="http://cocobasic.com">CocoBasic</a>.</div>
                        </div>                        
                    </div>
                </div>
            </div>
        </footer>
	    <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.smartmenus.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/jquery.onePageMenu.js"></script>
        <script src="js/isotope.pkgd.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/imagesloaded.pkgd.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>