<!DOCTYPE html>
<?php
    
require_once('connectdb.php');
       if(!empty($_GET['user'])){
        
        $sql="select * from sys_user where id_user=".$_GET['user'];
        $result = mysqli_query($con,$sql);
        while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                 $sessiondata = array(
				'id' 	=> $r['id_user'],
				'_pnc_username' 	=> $r['username'],
				'_pnc_email' 		=> $r['email'],
				'_pnc_name' 		=> $r['name'],
				'_pnc_id_aplikasi' 	=> $r['id_aplikasi'],
                '_pnc_id_grup' 		=> $r['id_grup'],  
                'group' 		=> $r['id_grup'],  
				'_pnc_kode_klinik' 	=> $r['kode_klinik'],
				'id_uk' 	=> $r['id_uk']
				
                );
                 $_SESSION['userdata']=$sessiondata;
        }
        
       }
       
       if(empty($_SESSION['userdata'])){
			header("Location: http://gtpay.id/hris/index.html");
		 }
?>
<html lang="en">


<!-- Mirrored from www.themeon.net/nifty/v2.5/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 Feb 2017 11:35:40 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="ico.png" />
   <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 

    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
   
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link href="plugins/animate-css/animate.min.css" rel="stylesheet">

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	  <link href="plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="css/nifty.min.css" rel="stylesheet">
	 
	  


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo-icons.min.css" rel="stylesheet">


    <!--Demo [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo.min.css" rel="stylesheet">
	  


        
    <!--Switchery [ OPTIONAL ]-->
    <link href="plugins/switchery/switchery.min.css" rel="stylesheet">


    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">


    <!--Chosen [ OPTIONAL ]-->
    <link href="plugins/chosen/chosen.min.css" rel="stylesheet">


        
    <!--Morris.js [ OPTIONAL ]-->
    <link href="plugins/morris-js/morris.min.css" rel="stylesheet">


    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
    
    
    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <link href="plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <link href="plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">



    


    
    <!--JAVASCRIPT-->
    <!--=================================================-->
 
    <link href="css/pace.css" rel="stylesheet">
    <script src="js/pace.min.js"></script>


    <!--jQuery [ REQUIRED ]-->
    <script src="js/jquery-2.2.4.min.js"></script>
<script src="js/pagination.min.js"></script>


    <!--Chosen [ OPTIONAL ]-->
    <script src="plugins/chosen/chosen.jquery.min.js"></script>

    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="js/nifty.min.js"></script>
    <script src="js/idle-timer.min.js"></script>





    <!--=================================================-->
    
     <!-- Custom CSS --> 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!--Demo script [ DEMONSTRATION ]--> 

    
    <script src="plugins/bootbox/bootbox.min.js"></script>
    <!--Morris.js [ OPTIONAL ]-->


    <!--Sparkline [ OPTIONAL ]-->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    
<!--Bootstrap Timepicker [ OPTIONAL ]-->
    <script src="plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/AjaxFileUpload-1.0.0.min.js"></script>

     <script src="dist/ag-grid-enterprise.noStyle.js"></script>
  <link rel="stylesheet" href="dist/styles/ag-grid.css">
  <link rel="stylesheet" href="dist/styles/ag-theme-balham.css">
 <script src="js/myfunction.js"></script>
 
 <style>
 .modal-header{
		 
		
	}
	
	.modal-title{
		 
	}
    
    .datepicker{z-index:1151 !important;}
    </style>
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Brand logo & name-->
                <!--================================-->
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">
                       
                        <div class="brand-title">
                            <span class="brand-text"></span>
                        </div>
                    </a>
                </div>
                <!--================================-->
                <!--End brand logo & name-->


                <!--Navbar Dropdown-->
                <!--================================-->
                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-left">

                        <!--Navigation toogle button-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" id="collapsein" href="#">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
								<li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <i class="demo-pli-bell" style="color:#212121"></i>
                                <span class="badge badge-header badge-danger"></span>
                            </a>

                            <!--Notification dropdown menu-->
                            <div class="dropdown-menu dropdown-menu-md">
                                <div class="pad-all bord-btm">
                                    <p class="text-semibold text-main mar-no">You have 9 notifications.</p>
                                </div>
                                <div class="nano scrollable">
                                    <div class="nano-content">
                                        <ul class="head-list">

                                            <!-- Dropdown list-->
                                            <li>
                                                <a href="#">
                                                    <div class="clearfix">
                                                        <p class="pull-left">Database Repair</p>
                                                        <p class="pull-right">70%</p>
                                                    </div>
                                                    <div class="progress progress-sm">
                                                        <div style="width: 70%;" class="progress-bar">
                                                            <span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Dropdown list-->
                                            <li>
                                                <a href="#">
                                                    <div class="clearfix">
                                                        <p class="pull-left">Upgrade Progress</p>
                                                        <p class="pull-right">10%</p>
                                                    </div>
                                                    <div class="progress progress-sm">
                                                        <div style="width: 10%;" class="progress-bar progress-bar-warning">
                                                            <span class="sr-only">10% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Dropdown list-->
                                            <li>
                                                <a class="media" href="#">
                                            <span class="badge badge-success pull-right">90%</span>
                                                    <div class="media-left">
                                                        <i class="demo-pli-data-settings icon-2x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="text-nowrap">HDD is full</div>
                                                        <small class="text-muted">50 minutes ago</small>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Dropdown list-->
                                            <li>
                                                <a class="media" href="#">
                                                    <div class="media-left">
                                                        <i class="demo-pli-file-edit icon-2x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="text-nowrap">Write a news article</div>
                                                        <small class="text-muted">Last Update 8 hours ago</small>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Dropdown list-->
                                            <li>
                                                <a class="media" href="#">
                                            <span class="label label-danger pull-right">New</span>
                                                    <div class="media-left">
                                                        <i class="demo-pli-speech-bubble-7 icon-2x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="text-nowrap">Comment Sorting</div>
                                                        <small class="text-muted">Last Update 8 hours ago</small>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Dropdown list-->
                                            <li>
                                                <a class="media" href="#">
                                                    <div class="media-left">
                                                        <i class="demo-pli-add-user-plus-star icon-2x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="text-nowrap">New User Registered</div>
                                                        <small class="text-muted">4 minutes ago</small>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Dropdown list-->
                                            <li class="bg-gray">
                                                <a class="media" href="#">
                                                    <div class="media-left">
                                                        <img class="img-circle img-sm" alt="Profile Picture" src="img/profile-photos/9.png">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="text-nowrap">Lucy sent you a message</div>
                                                        <small class="text-muted">30 minutes ago</small>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Dropdown list-->
                                            <li class="bg-gray">
                                                <a class="media" href="#">
                                                    <div class="media-left">
                                                        <img class="img-circle img-sm" alt="Profile Picture" src="img/profile-photos/3.png">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="text-nowrap">Jackson sent you a message</div>
                                                        <small class="text-muted">40 minutes ago</small>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!--Dropdown footer-->
                                <div class="pad-all bord-top">
                                    <a href="#" class="btn-link text-dark box-block">
                                        <i class="fa fa-angle-right fa-lg pull-right"></i>Show All Notifications
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Navigation toogle button-->



                         


                        <!--Mega dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                         
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End mega dropdown-->

                    </ul>
                    <ul class="nav navbar-top-links pull-right">

                        <!--Language selector-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End language selector-->



                        <!--User dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End user dropdown-->

                         
                    </ul>
                </div>
                <!--================================-->
                <!--End Navbar Dropdown-->

            </div>
        </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed"> 
            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
					 
					<ol class="breadcrumb pad-all">
					<li><a href="#">Home</a></li>
					<li class="active judul-menu"></li>
                </ol>
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                 
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
                </div>
                
                <!--===================================================-->
                <!--End page content-->


            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
            

            
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">

                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">

                                <!--Profile Widget-->
                                <!--================================-->
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap">
                                        <div class="pad-btm">
                                            <span class="label label-success pull-right">New</span>
                                            <img class="img-circle img-sm img-border" src="images/logo.png" alt="Profile Picture">
                                        </div>
                                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                            <p class="mnp-name"> <?php echo $_SESSION['userdata']['_pnc_username']?></p>
                                            <span class="mnp-desc"></span>
                                          
                                        </a>
                                    </div>
                                    <div id="profile-nav" class="collapse list-group bg-trans">
                                         
                                         
                                        <a href="#" class="list-group-item" onClick="logout()">
                                            <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                                        </a>
                                    </div>
                                </div>

                                

<?php 
$idaplikasi = $_SESSION['userdata']['_pnc_id_aplikasi'];
$idgroup = $_SESSION['userdata']['_pnc_id_grup'];
			$sql="SELECT a.id_modul, b.modul, b.controller,b.icon
			FROM sys_user_access as a
			JOIN sys_mst_modul as b ON b.id_modul=a.id_modul
			WHERE
			
			
			";
			 
		$icon[0]='demo-psi-happy';
		$icon[1]='demo-psi-receipt-4';
		$icon[2]='demo-psi-split-vertical-2';
		$icon[3]='demo-psi-split-vertical-2';
		$icon[4]='demo-psi-split-vertical-2';
		$icon[5]='demo-psi-split-vertical-2';
		if(!empty($idaplikasi)){
				 
                $sql.="a.id_aplikasi = '".$idaplikasi."' AND ";
			}
			if(!empty($idgroup)){
				 
                $sql.="a.id_group = '".$idgroup."' AND ";
			}
			
		  $sql.=" b.id_aplikasi = a.id_aplikasi
        GROUP BY a.id_modul, b.modul, b.controller
        ORDER BY urutan ASC";
		   
        $result = mysqli_query($con,$sql);
		 
		 


?>
                                <ul id="mainnav-menu" class="list-group">
						
						            <!--Category name-->
						            <li class="list-header">Navigation</li>
						
						<?php
						
						$num=0;
						while($hasil = mysqli_fetch_array($result,MYSQLI_ASSOC)){
							$sql2='';
							$sql2.="SELECT a.id_modul, b.modul, c.url, c.menu
								FROM sys_user_access a
								LEFT JOIN sys_mst_modul b ON b.id_aplikasi=a.id_aplikasi	AND a.id_modul=b.id_modul	AND b.aktif='1'
								LEFT JOIN sys_mst_menu c ON c.id_aplikasi=a.id_aplikasi	AND c.id_modul=a.id_modul	AND c.id_menu=a.id_menu
								WHERE
								 
								
								";
										$idmodul =$hasil['id_modul'];	 
										
											if(!empty($idaplikasi)){
												$sql2.="a.id_aplikasi = '".$idaplikasi."' AND ";
												 
											}
											
											if(!empty($idgroup)){ 
												$sql2.="a.id_group = '".$idgroup."' AND ";
											}
											
											if(!empty($idmodul)){ 
												$sql2.="a.id_modul = '".$idmodul."' AND ";
											}
											
											
											$sql2.=" c.front = '1'"; 
										    $sql2.=" GROUP BY a.id_modul, b.modul, c.url, c.menu
											ORDER BY c.urutan ASC";
											
											$result2 = mysqli_query($con,$sql2);
											//$hasil2 = mysql_fetch_array($result2);
											
		  ?> 
						            <li>
						                <a href="#">
						                    <i class="<?php echo $hasil['icon']?>"></i>
						                    <span class="menu-title">
												<strong><?php echo $hasil['modul']?></strong>
											</span>
											<i class="arrow"></i>
						                </a>
											 <?php
											 ++$num;
											// $cek = count($hasil2);
											//if($cek > 0){?>
												<ul class="collapse">
													<?php 
													while($hasil2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){?>
													
													<li><a href="#" class="" onClick="Halaman('<?php echo $hasil2['url']?>.php?id_modul=<?php echo $hasil2['id_modul']?>')"><?php echo $hasil2['menu']?></a></li>
													<?php }?>
												</ul>
												
											<?php //}
											?>
						            </li>
										<?php }?>
										
						       </ul>
						


                                

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

         
        <footer id="footer">
 
            <div class="show-fixed pull-right">
                You have <a href="#" class="text-bold text-main"><span class="label label-danger">3</span> pending action.</a>
            </div>


 
            <div class="hide-fixed pull-right pad-rgt">
                14GB of <strong>512GB</strong> Free.
            </div>



          
            <p class="pad-lft">&#0169; 2016 Your Company</p>



        </footer>
		 
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->



    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->


    
        <!-- SETTINGS - DEMO PURPOSE ONLY -->
    <!--===================================================-->
     
    <!--===================================================-->
    <!-- END SETTINGS -->
	
    <script src="js/login.js"></script>
<script> 
    
 
   $('#f_tgl_start').datepicker(); 
     function Halaman(page){
         $("#page-content").load("view/"+page);
     }
     
     
   
                   
 
					
function klik(e){
	
	//$('.collapse').removeClass('in');
	$('.moron').removeClass('active');
$( "#moron"+e ).addClass( "active" );
 
if($('#collapse'+e).hasClass("collapse in")) {
	  $('.collapse').removeClass('in');
	 // $('.collapse').slideToggle('slow');
        }else{ 
			 $('.collapse').removeClass('in');
		//	 $('.collapse').slideToggle('slow').removeClass( "in" );
			$('#collapse'+e).addClass( "collapse in" );
			//$('#collapse'+e).slideToggle('slow').addClass( "collapse in" );
			 
		}

//$('.collapse').collapse({ parent: true, toggle: true }); 
}
 
	function logout(){
            window.location.href = BASE_URL2+"index.html";
									localStorage.setItem("Token",'');
									localStorage.setItem("nik",'');
        }	 

        
</script>

<style>
		 
		@media (min-width: 768px) {
			#nav-buy-now {
				margin-right: 0px;
			}
		}
		#bs-example-navbar-collapse-1 {
			display: none;
		}

		.wowbook {
			font-family: "Open Sans","Helvetica Neue",Arial,sans-serif;
		}
		.wowbook-page-content {
			padding: 1.5em;
		}
		.wowbook ul {
			padding-left: 1em;
		}
        .book-thumb {
            height: 150px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.5)
        }

		#book1-trigger, #book2-trigger, #book3-trigger {
			cursor: pointer;
		}
		#book1-trigger:hover, #book2-trigger:hover, #book3-trigger:hover {
			background: #f8f8f8;
		}

        .wowbook-lightbox > .wowbook-close {
            background: transparent !important;
            border: none !important;
            color: #222 !important;
            font-size: 2.5em;
        }
        .wowbook-lightbox > .wowbook-close:hover {
            background: #444 !important;
            color: white !important;
            border-radius: 3px;
        }


        .lightbox-images1 .wowbook-book-container {
            background: #6d6b92; /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover, #ffffff 0%, #6d6b92 100%); /* FF3.6-15 */
            background: -webkit-radial-gradient(center, ellipse cover, #ffffff 0%,#6d6b92 100%); /* Chrome10-25,Safari5.1-6 */
            background: radial-gradient(ellipse at center, #ffffff 0%,#6d6b92 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        }
        .lightbox-images1 > .wowbook-close,
        .lightbox-images2 > .wowbook-close {
            color: #ccc !important;
        }
        .lightbox-images2 .wowbook-book-container {
            background: #1E2831; /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover, #ffffff 0%, #1E2831 100%); /* FF3.6-15 */
            background: -webkit-radial-gradient(center, ellipse cover, #ffffff 0%,#1E2831 100%); /* Chrome10-25,Safari5.1-6 */
            background: radial-gradient(ellipse at center, #ffffff 0%,#1E2831 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        }



		.lightbox-pdf  .wowbook-book-container {
			background: #e5e5e5 url(img/bg-lightbox-pdf.png); /* Old browsers */
			background: #e5e5e5 -moz-radial-gradient(center, ellipse cover, #ffffff 20%, #bbbbbb 100%); /* FF3.6-15 */
			background: #e5e5e5 -webkit-radial-gradient(center, ellipse cover, #ffffff 20%,#bbbbbb 100%); /* Chrome10-25,Safari5.1-6 */
			background: #e5e5e5 radial-gradient(ellipse at center, #ffffff 20%,#bbbbbb 100%); /* W3C, IE10+, FF16+, Chrome26+,Opera12+, Safari7+*/
		}


		.lightbox-html  .wowbook-book-container {
			background: url(img/book_html/wood.jpg);
		}
		.lightbox-html .wowbook-toolbar {
			margin-top: 1em; /* FIXME */
			box-sizing: content-box !important;
		}

		.lightbox-html .wowbook-controls {
			border-radius: 6px;
			width: auto;
		}

		.lightbox-html.wowbook-mobile .wowbook-toolbar {
			margin: 0;
		}

		.lightbox-html.wowbook-mobile .wowbook-controls {
			border-radius: 0;
			width: 100%;
		}


/*		.lightbox-html .wowbook-controls {
			border-radius: 6px;
			width: auto;
			background: none;
			color: rgba(60, 20, 20, 0.8);
			text-shadow: 0 1px 0 #fff;
			box-shadow: none;
		}
		.lightbox-html .wowbook-control:hover {
			background: none;
			color: white;
			text-shadow: 0 1px 0 #fff, 0 0px 5px rgba(60, 20, 20, 1);
			text-shadow: 0 1px 0 #fff, 0 0px 3px #fff;
		}
*/
		hr {
			max-width: 450px;
		}
	</style>
  

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>

    <link rel="stylesheet" href="wow_book/wow_book.css" type="text/css" />
	<style>
		.wowbook-right .wowbook-gutter-shadow {
			background-image: url("img/page_right_background.png");
			background-position: 0 0;
			width: 75px;
		}
		.wowbook-left .wowbook-gutter-shadow {
			background-image: url("img/page_left_background.png");
			opacity: 0.5;
			width: 60px;
		}
        .wowbook-control-currentPage {
            font-family: "Segoe UI",Helvetica,Arial,sans-serif;
        }
	</style>
    <script type="text/javascript" src="wow_book/pdf.combined.min.js"></script>
    <script type="text/javascript" src="wow_book/wow_book.min.js"></script>
	 
    <script>Pace.stop();</script>
</body>
 </html>


          

  