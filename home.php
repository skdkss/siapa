<?php
	require("config/config.default.php");
	require("config/config.function.php");
	require("config/functions.crud.php");
	echo "
<!DOCTYPE html>
<html>
<head>
<title>CBT | Computer Based Test</title>
<link rel='shortcut icon' type='image/x-icon' href='$homeurl/favicon.ico' />
<link rel='stylesheet' href='$homeurl/dist/css/bootstrap.min.css'>
<link rel='stylesheet' href='$homeurl/dist/css/bootstrap-select.css'>
<link href='$homeurl/dist/css/style.css' rel='stylesheet' type='text/css' media='all' />
<link rel='stylesheet' href='$homeurl/dist/css/flexslider.css' type='text/css' media='screen' />
<link rel='stylesheet' href='$homeurl/dist/css/font-awesome.min.css' />
<!-- for-mobile-apps -->
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='computer based test' />
<script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--//fonts-->	
<!-- js -->
<script type='text/javascript' src='$homeurl/dist/js/jquery.min.js'></script>
<!-- js -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src='$homeurl/dist/js/bootstrap.min.js'></script>
<script src='$homeurl/dist/js/bootstrap-select.js'></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<script type='text/javascript' src='$homeurl/dist/js/jquery.leanModal.min.js'></script>
<link href='$homeurl/dist/css/jquery.uls.css' rel='stylesheet'/>
<link href='$homeurl/dist/css/jquery.uls.grid.css' rel='stylesheet'/>
<link href='$homeurl/dist/css/jquery.uls.lcd.css' rel='stylesheet'/>
<!-- Source -->
<script src='$homeurl/dist/js/jquery.uls.data.js'></script>
<script src='$homeurl/dist/js/jquery.uls.data.utils.js'></script>
<script src='$homeurl/dist/js/jquery.uls.lcd.js'></script>
<script src='$homeurl/dist/js/jquery.uls.languagefilter.js'></script>
<script src='$homeurl/dist/js/jquery.uls.regionfilter.js'></script>
<script src='$homeurl/dist/js/jquery.uls.core.js'></script>
<script>
			$( document ).ready( function() {
				$( '.uls-trigger' ).uls( {
					onSelect : function( language ) {
						var languageName = $.uls.data.getAutonym( language );
						$( '.uls-trigger' ).text( languageName );
					},
					quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr'] //FIXME
				} );
			} );
		</script>
</head>
<body><br><br>
<center><img src='$homeurl/$setting[logo]' height=100 width=100>

	                    <h3>$setting[sekolah]</h3>
	                    <p class='caption'>
	                        $setting[alamat]
	                    </p></center>
		<!-- content-starts-here -->
		<div class='content'>
			<div class='categories'>
				<div class='container'>
					<div class='col-md-4 focus-grid'>
						<a href='admin'>
							<div class='focus-border'>
								<div class='focus-layout'>
									<div class='focus-image'><i class='fa fa-user'></i></div>
									<h4 class='clrchg'>ADMIN</h4>
								</div>
							</div>
						</a>
					</div>
					<div class='col-md-4 focus-grid'>
						<a href='guru'>
							<div class='focus-border'>
								<div class='focus-layout'>
									<div class='focus-image'><i class='fa fa-graduation-cap'></i></div>
									<h4 class='clrchg'>GURU</h4>
								</div>
							</div>
						</a>
					</div>
					<div class='col-md-4 focus-grid'>
						<a href='login.php'>
							<div class='focus-border'>
								<div class='focus-layout'>
									<div class='focus-image'><i class='fa fa-users'></i></div>
									<h4 class='clrchg'>SISWA</h4>
								</div>
							</div>
						</a>
					</div>	
					
					<div class='clearfix'></div>
				</div>
			</div>

			<!-- //slider -->				
			</div>

		</div>
		<center> <a href='CBT | PONPES AL QUDS PEKNABARU' class='btn btn-primary  btn-block' style='border-radius:0;'>
                            
                       <img src='$homeurl/dist/img/logo1.png' height=32 width=32> CBT | PONPES AL QUDS PEKNABARU </center>
		<!--footer section start-->		

        <!--footer section end-->
</body>
</html>";
?>