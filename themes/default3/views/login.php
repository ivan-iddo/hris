<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SiKuMis | User Login</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="<?php echo theme_path(); ?>/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo theme_path(); ?>/fonts/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo theme_path(); ?>/fonts/ionicons/css/ionicons.min.css" />

        <link rel="stylesheet" href="<?php echo theme_path(); ?>/css/AdminLTE.min.css">
        
        <link rel="stylesheet" href="<?php echo theme_path(); ?>/css/style.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo theme_path(); ?>/js/owl-carousel/owl.carousel.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo theme_path(); ?>/js/owl-carousel/owl.theme.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo theme_path(); ?>/js/owl-carousel/owl.transitions.css" rel="stylesheet"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">

    	<div id="login-slider" class="owl-carousel">
    		<div class="dm-owl-slide" style="background-image: url('<?php echo theme_path() ?>/img/bg01.jpg');">
				<div class="dm-owl-caption">
					<img src="<?php echo base_url('logo-pu.jpg'); ?>" alt="logo" width="100px">
					<h1>SiKuMis Ditjen Bina Marga</h1>
					<h4>Sistem Informasi E-Dokumen Teknis Ditjen Bina Marga - Kementerian Pekerjaan Umum dan Perumahan Rakyat</h4>
					<p class="margin">
						<a class="btn btn-danger" onclick="showLogin()"><i class="fa fa-lock"></i> &nbsp; Login</a>
						<a class="btn btn-primary" onclick="showHelp()"><i class="fa fa-question-circle"></i> &nbsp; Help</a>
					</p>
				</div>
			</div>
			<div class="dm-owl-slide" style="background-image: url('<?php echo theme_path() ?>/img/bg02.jpg');">
				<div class="dm-owl-caption">
					<img src="<?php echo base_url('logo-pu.jpg'); ?>" alt="logo" width="100px">
					<h1>SiKuMis Ditjen Bina Marga</h1>
					<h4>Sistem Informasi E-Dokumen Teknis Ditjen Bina Marga - Kementerian Pekerjaan Umum dan Perumahan Rakyat</h4>
					<p class="margin">
						<a class="btn btn-danger" onclick="showLogin()"><i class="fa fa-lock"></i> &nbsp; Login</a>
						<a class="btn btn-primary" onclick="showHelp()"><i class="fa fa-question-circle"></i> &nbsp; Help</a>
					</p>
				</div>
			</div>
    	</div>

    	<div id="loginModal" class="modal fade" tabindex="-1" role="dialog">
		    <div class="modal-dialog modal-sm">
		        <div class="modal-content">
		            <div class="modal-header red-modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title">UserAuth</h4>
		            </div>
			        <form action="login" role="form" method="post">
			        	<div class="modal-body">
			        		<div class="form-group has-feedback">
			                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
			                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
			                </div>
			                <div class="form-group has-feedback">
			                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
			                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
			                </div>
			        	</div>
			        	<div class="modal-footer">
	                        <input type="submit" value="Login" id="login" class="btn btn-danger btn-block btn-flat">
			        	</div>
			        </form>
		        </div>
		    </div>
		</div>

		<div id="helpModal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header red-modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title">UserHelp</h4>
		            </div>
		            <div class="modal-body">
		            	<table class="table table-bordered table-striped" id="table-user-help">
		            		<thead>
		            			<tr>
		            				<th width="2%"></th>
		            				<th>File Name</th>
		            				<th width="5%">Download</th>
		            			</tr>
		            		</thead>
		            		<tbody>
		            			
		            		</tbody>
		            		<!-- <tbody>
		            			<tr>
		            				<td>1</td>
		            				<td>Manual Book System Manajemen Arsip</td>
		            				<td align="center"><a href="<?php echo base_url('/docs/sample2.pdf'); ?>" target="_blank"><i class="fa fa-download"></i></a></td>
		            			</tr>
		            		</tbody> -->
		            	</table>
		            </div>
				</div>
			</div>
		</div>

    	<!-- JavaScript -->
        <script src="<?php echo theme_path(); ?>/js/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?php echo theme_path(); ?>/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo theme_path(); ?>/js/owl-carousel/owl.carousel.min.js"></script>
        
		<script>
		$("#login").click(function() {
			var username = $("#username").val();
			var password = $("#password").val();
			var token = $('input[name=insya_allah]').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('login'); ?>",
				data: "username=" + username + "&password=" + password + "&insya_allah=" + token,
				success: function(resp) {
					var obj = jQuery.parseJSON( resp );
					if(obj.success === true){
						window.location = "";
					} else {
						alert(obj.msg);
					}
				},
				beforeSend: function()
				{
					
				}
			});
			return false;
		});

		$(function () {
			var time = 11; 
 
			var $progressBar,
				$bar, 
				$elem, 
				isPause, 
				tick,
				percentTime;

			$('#login-slider').owlCarousel({
				singleItem:true,
				transitionStyle : "fadeUp",
      			lazyLoad : false,
				afterInit : progressBar,
      			afterMove : moved,
      			startDragging : pauseOnDragging
			});

			function progressBar(elem){
				$elem = elem;
				buildProgressBar();
				start();
			}
 
			//create div#progressBar and div#bar then prepend to $("#owl-demo")
			function buildProgressBar(){
				$progressBar = $("<div>",{
					id:"progressBar"
				});

				$bar = $("<div>",{
					id:"bar"
				});
				
				$progressBar.append($bar).prependTo($elem);
			}
 
			function start() {
				percentTime = 0;
				isPause = false;
				tick = setInterval(interval, 10);
			};
 
			function interval() {
				if(isPause === false){
					percentTime += 1 / time;
					$bar.css({
						width: percentTime+"%"
					});

					if(percentTime >= 100){
						$elem.trigger('owl.next')
					}
				}
			}
 
			function pauseOnDragging(){
				isPause = true;
			}
 
			function moved(){
				clearTimeout(tick);
				start();
			}


		}); /* end of jquery document ready */
		
		function showLogin(){
			$('#loginModal').modal('toggle');
		}

		function showHelp(){
			$('#helpModal').modal('toggle');
		}

		$(document).ready(function() {
			$.ajax({
				url: '/application/get_user_help' + '', /*escape url with empty string*/
	            onSubmit: function() {

	            },
	            success: function(result) {
	                // console.log(result);
	                var file = '';

	                $.each(JSON.parse(result), function(i, item) {
	                	file += '<tr><td>'+ parseInt(i+1) +'</td><td>' + item.name + '</td><td><a class="btn btn-default" title="Download File" href="<?php echo base_url();?>/docs/'+ item.name +'" target="_blank" download><i class="fa fa-download"></i></a> </td</tr>';
	                });
	                  
	                $('#table-user-help tbody').append(file);
	            }
			})			
		});
		</script>
    </body>
</html>