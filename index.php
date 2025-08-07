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
                <img class="menu-logo" src="images/logo@2x.png" alt="Bacchus" id="adminTrigger">
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
                        <div class="row no-gutter"> 
                            <div class="col-lg-5 animate">                            
                                <h2 class="big-title">Services With Clean Code & Awesome Design</h2> 
                                <p>
                                    The regret on our side is, they used to say years ago, we are reading about you in science class. Now they say, we are reading about you in history class.
                                </p>
                                <br>
                                <p>
                                    We choose to go to the moon in this decade and do the other things, not because they are easy, but because they are hard, because that goal will serve to organize and measure the best of our energies and skills.                                    
                                </p>
                            </div>
                            <div class="col-lg-5 offset-lg-2 service-items-holder"> 
                                <div class="row no-gutter animate">                                                                                                
                                    <div class="service-holder">
                                        <div class="service-img"> 
                                            <img src="images/icon_interactive@2x.png" alt="">
                                        </div>
                                        <div class="service-txt">
                                            <h4>Interactive</h4>
                                            <p>For those who have seen the Earth from space, and for the hundreds and perhaps thousands more.</p>
                                        </div>
                                    </div>
                                </div>
                                <br>                                
                                <br>                                
                                <div class="row no-gutter animate">   
                                    <div class="service-holder">
                                        <div class="service-img"> 
                                            <img src="images/icon_brand@2x.png" alt="">
                                        </div>
                                        <div class="service-txt">
                                            <h4>Brand</h4>
                                            <p>Astronomy compels the soul to look upward, and leads us from this world to another.</p>
                                        </div>
                                    </div>      
                                </div>      
                                <br>                                
                                <br>                                
                                <div class="row no-gutter animate">
                                    <div class="service-holder">
                                        <div class="service-img"> 
                                            <img src="images/icon_print@2x.png" alt="">
                                        </div>
                                        <div class="service-txt">
                                            <h4>Print</h4>
                                            <p>I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.</p>
                                        </div>
                                    </div>
                                </div>      
                            </div>
                        </div>
                    </div>                                          
                </div>
            </div>
        </div>

        <!-- PORTFOLIO SECTION -->

        <div id="portfolio" class="section">                                
            <div class="box-wrapper">                                                                                                      
                <div class="grid" id="portfolio-grid">
                    <div class="grid-sizer"></div>
                    <div class="grid-item element-item p_2x2">
                        <a data-rel="prettyPhoto[gallery1]" href="https://vimeo.com/157276599">
                            <img src="images/portfolio_item_01.jpg" alt="">
                            <div class="portfolio-text-holder">
                                <div class="portfolio-text-wrapper">
                                    <p class="portfolio-type">
                                        <img src="images/icon_play@2x.png" alt="">
                                    </p>                               
                                    <p class="portfolio-text">VIDEO</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="grid-item element-item p_1x1">
                        <a data-rel="prettyPhoto[gallery1]" href="images/portfolio_item_02_large.jpg">
                            <img src="images/portfolio_item_02.jpg" alt="">
                            <div class="portfolio-text-holder">
                                <div class="portfolio-text-wrapper">
                                    <p class="portfolio-type">
                                        <img src="images/icon_view@2x.png" alt="">
                                    </p>                               
                                    <p class="portfolio-text">IMAGE</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="grid-item element-item p_1x1">
                        <a href="single.php">
                            <img src="images/portfolio_item_03.jpg" alt="">
                            <div class="portfolio-text-holder">
                                <div class="portfolio-text-wrapper">
                                    <p class="portfolio-type">
                                        <img src="images/icon_post@2x.png" alt="">
                                    </p>                               
                                    <p class="portfolio-text">TEXT</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="grid-item element-item p_1x1">
                        <a href="http://cocobasic.com" target="_blank">
                            <img src="images/portfolio_item_04.jpg" alt="">
                            <div class="portfolio-text-holder">
                                <div class="portfolio-text-wrapper">
                                    <p class="portfolio-type">
                                        <img src="images/icon_external@2x.png" alt="">
                                    </p>                               
                                    <p class="portfolio-text">LINK</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="grid-item element-item p_1x1">
                        <a href="single.php">
                            <img src="images/portfolio_item_05.jpg" alt="">
                            <div class="portfolio-text-holder">
                                <div class="portfolio-text-wrapper">
                                    <p class="portfolio-type">
                                        <img src="images/icon_post@2x.png" alt="">
                                    </p>     
                                    <p class="portfolio-text">TEXT</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="grid-item element-item p_1x1">
                        <a data-rel="prettyPhoto[gallery1]" href="images/portfolio_item_06_large.jpg">
                            <img src="images/portfolio_item_06.jpg" alt="">
                            <div class="portfolio-text-holder">
                                <div class="portfolio-text-wrapper">
                                    <p class="portfolio-type">
                                        <img src="images/icon_view@2x.png" alt="">
                                    </p>   
                                    <p class="portfolio-text">IMAGE</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="clear"></div>                          
                </div>
                <!-- CRUD! -->
                <?php include 'includes/portfolio.php'; ?>
                <!-- // CRUD! -->
            </div>                    
        </div>            

        <!-- NEWS SECTION -->

        <div id="news" class="section">                                
            <div class="box-wrapper">                                                                                              
                <div class="container-fluid">  
                    <div class="row no-gutter news-holder"> 
                        <div class="col-sm-6 col-md-6 post post-1">                            
                            <p class="category">INSPIRATIONAL</p>
                            <h2 class="entry-title">Time is on Our Side</h2>   
                            <p class="excerpt">Talent she for lively eat led sister. Entrance strongly packages she out rendered get quitting denoting led. Dwelling confined improved it he no doubtful raptures.</p>
                            <a class="read-more" href="single.php">Read More</a>
                        </div>
                        <div class="col-sm-6 col-md-6 post post-2">                            
                            <p class="category">THOUGHTS</p>
                            <h2 class="entry-title">Hello to my Second Post</h2>   
                            <p class="excerpt">Smile spoke total few great had never their too. Amongst moments do in arrived at my replied. Fat weddings servants but man believed prospect.</p>
                            <a class="read-more" href="single.php">Read More</a>
                        </div>
                    </div>
                </div>                                         
            </div>
        </div>

        <!-- SUPPORT SECTION -->

        <div id="support" class="section">                                
            <div class="box-wrapper">                                                                                              
                <div class="container-fluid">  
                    <div class="row no-gutter"> 
                        <div class="col-md-6 offset-md-6">
                            <div class="quote">
                                <h2 class="entry-title animate">The art and science of asking questions is the source of all knowledge</h2>                               
                            </div>
                        </div>                        
                    </div>
                    <div class="row no-gutter"> 
                        <div class="col-md-9 offset-md-3 support-service">                                                                                
                            <div class="row no-gutter">                                          
                                <div class="col-sm-2 text-center animate wait-03s"> 
                                    <img class="support-img" src="images/icon_photo@2x.png" alt="Photo Sessions">
                                    <p class="support-item-text">Photo Sessions</p>
                                </div>
                                <div class="col-sm-2 offset-sm-3 text-center animate wait-03s">                                                                 
                                    <img class="support-img" src="images/icon_support@2x.png" alt="24/7 Support">
                                    <p class="support-item-text">24/7 Support</p>
                                </div>
                                <div class="col-sm-2 offset-sm-3 text-center animate wait-03s">
                                    <img class="support-img" src="images/icon_diamond@2x.png" alt="Pixel Precise">
                                    <p class="support-item-text">Pixel Precise</p>
                                </div>
                            </div>    
                            <div class="row no-gutter"> 
                                <div class="col-md-11 m-top-40 animate wait-03s">
                                    Drawings me opinions returned absolute in. Otherwise therefore hex did are unfeeling something. Certain be ye amiable by exposed so. To celebrated estimating excellence do.
                                </div>
                            </div>
                        </div>                                                                   
                    </div>
                </div>                                         
            </div>
        </div>

        <!-- FOCUS SECTION -->
        
        <div id="focus" class="section">                                
            <div class="box-wrapper">                                                                                              
                <div class="container-fluid">  
                    <div class="row no-gutter"> 
                        <div class="col-md-6">                            
                            <img src="images/image_icons.jpg" alt="">                                           
                        </div>
                        <div class="col-md-6">
                            <div class="focus-holder">
                                <h2 class="entry-title">Focus and Photo by Professionals</h2>  
                                <br>
                                <br>
                                <p>
                                    We choose to go to the moon in this decade and do the other things, not because they are easy, but because they are hard, because that goal will serve to organize and measure the best of our energies and skills.
                                </p>
                                <br>
                                <p>
                                    We won’t be doing it just to get out there in space we’ll be doing it because the things we learn out there will be making life better for a lot of people.
                                </p>
                            </div>
                        </div>                  
                    </div>      
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
                        <div class="col-sm-6 col-md-6 contact-info">
                            <p>
                                Consectetur adipisicing elit sed eiusmod tempor incididunt ut dolore magna labore eiusmod. Lorem ipsum dolor sit amet consectetur est adipisicing elit, sed do eiusmod tempor.
                            </p>
                            <br>
                            <p><b>Address:</b> New York, NY, United States</p>
                            <p><b>Phone:</b> +1 234-567-890</p>
                            <p><b>Hours:</b> 9:00 am – 5:00 pm</p>
                        </div>                        
                        <div class="col-sm-6 col-md-6 contact-form-holder">
                            <div class="contact-form">
                                <p><input id="name" type="text" name="your-name" placeholder="Name"></p>
                                <p><input id="contact-email" type="email" name="your-email" placeholder="Email"></p>
                                <p><input id="subject" type="text" name="your-subject" placeholder="Subject"></p>
                                <p><textarea id="message" name="your-message" placeholder="Message"></textarea></p>
                                <p><input type="submit" value="SEND"></p>                                
                            </div>
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
        <script>
        let count = 0;
        document.getElementById("adminTrigger").addEventListener("click", () => {
        count++;
        if (count === 1) {
            window.location.href = "admin/panel.php";
        }
        });
        </script>

    </body>
</html>