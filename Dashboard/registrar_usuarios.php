<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Dashboard - Softicket</title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

	<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

	<!-- inline styles related to this page -->

	<!-- ace settings handler -->

	<script src="assets/js/ace-extra.min.js"></script>

	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->

	<link rel="stylesheet" href="css/dashboard_registrar_usuario.css" />

</head>

<body class="no-skin">

	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try {
				ace.settings.loadState('main-container')
			} catch (e) {}
		</script>

		<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
			<script type="text/javascript">
				try {
					ace.settings.loadState('sidebar')
				} catch (e) {}
			</script>


			<ul class="nav nav-list">
				<li class="active">
					<a href="Dashboard.html">
						<i class="menu-icon fa fa-tachometer"></i>
						<span class="menu-text"> Dashboard </span>
					</a>

					<b class="arrow"></b>
				</li>


				<li class="">
					<a href="index.php">
						<i class="menu-icon fa fa-list-alt"></i>
						<span class="menu-text"> Administrador </span>
					</a>

					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-user"></i>
						<span class="menu-text"> Usuarios </span>

						<b class="arrow fa fa-angle-down"></b>
					</a>

					<b class="arrow"></b>

					<ul class="submenu">
						<li class="">
							<a href="registrar_usuarios.php">
								<i class="menu-icon fa fa-plus"></i>
								Registrar
							</a>
						</li>
					</ul>

					<ul class="submenu">
						<li class="">
							<a href="administrar_usuarios.php">
								<i class="menu-icon fa fa-cog"></i>
								Administrar
							</a>
						</li>
					</ul>
				</li>

				<b class="arrow"></b>

				<li class="">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-folder"></i>
						<span class="menu-text"> Grupos Soporte </span>

						<b class="arrow fa fa-angle-down"></b>
					</a>

					<b class="arrow"></b>

					<ul class="submenu">
						<li class="">
							<a href="registrar_usuarios.php">
								<i class="menu-icon fa fa-plus"></i>
								Registrar
							</a>
						</li>
					</ul>

					<ul class="submenu">
						<li class="">
							<a href="administrar_usuarios.php">
								<i class="menu-icon fa fa-cog"></i>
								Administrar
							</a>
						</li>
					</ul>
				</li>

				<b class="arrow"></b>
				</li>
			</ul>
			</li>


			</ul><!-- /.nav-list -->

			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
				<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>
		</div>

		<div class="main-content">
			<div class="main-content-inner">
				<div class="breadcrumbs ace-save-state" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="#">Home</a>
						</li>
						<li class="active">Dashboard</li>
					</ul><!-- /.breadcrumb -->


				</div>

				<div class="page-content">


					<div class="page-header">
						<h1>
							Dashboard
							<small>
								<i class="ace-icon fa fa-angle-double-right"></i>
								Registrar Usuarios
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->

						</div>

						<div class="col-sm-6">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="widget-title lighter smaller">
										<i class="ace-icon fa fa-user-plus blue"></i>
										Registrar Usuario
									</h4>
								</div>

								<div class="container">

									<form method="post" action=".">

										<div id="div_id_username" class="form-group required">
											<label for="id_username" class="control-label col-md-3 requiredField"> Username<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9">
												<input class="input-md textinput textInput form-control" id="id_username" maxlength="30" name="username" placeholder="Choose your username" style="margin-bottom: 10px" type="text" />
											</div>
										</div>

										<div id="div_id_email" class="form-group required">
											<label for="id_email" class="control-label col-md-3  requiredField"> E-mail<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9">
												<input class="input-md emailinput form-control" id="id_email" name="email" placeholder="Your current email address" style="margin-bottom: 10px" type="email" />
											</div>
										</div>

										<br />

										<div id="div_id_password1" class="form-group required">
											<label for="id_password1" class="control-label col-md-3  requiredField">Password<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9 ">
												<input class="input-md textinput textInput form-control" id="id_password1" name="password1" placeholder="Create a password" style="margin-bottom: 10px" type="password" />
											</div>
										</div>
										<div id="div_id_password2" class="form-group required">
											<label for="id_password2" class="control-label col-md-3  requiredField"> Re:password<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9 ">
												<input class="input-md textinput textInput form-control" id="id_password2" name="password2" placeholder="Confirm your password" style="margin-bottom: 10px" type="password" />
											</div>
										</div>
										<div id="div_id_name" class="form-group required">
											<label for="id_name" class="control-label col-md-3  requiredField"> full name<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9 ">
												<input class="input-md textinput textInput form-control" id="id_name" name="name" placeholder="Your Frist name and Last name" style="margin-bottom: 10px" type="text" />
											</div>
										</div>
										<div id="div_id_gender" class="form-group required">
											<label for="id_gender" class="control-label col-md-3  requiredField"> Gender<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9 " style="margin-bottom: 10px">
												<label class="radio-inline"> <input type="radio" name="gender" id="id_gender_1" value="M" style="margin-bottom: 10px">Male</label>
												<label class="radio-inline"> <input type="radio" name="gender" id="id_gender_2" value="F" style="margin-bottom: 10px">Female </label>
											</div>
										</div>
										<div id="div_id_company" class="form-group required">
											<label for="id_company" class="control-label col-md-3  requiredField"> company name<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9 ">
												<input class="input-md textinput textInput form-control" id="id_company" name="company" placeholder="your company name" style="margin-bottom: 10px" type="text" />
											</div>
										</div>
										<div id="div_id_catagory" class="form-group required">
											<label for="id_catagory" class="control-label col-md-3  requiredField"> catagory<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9 ">
												<input class="input-md textinput textInput form-control" id="id_catagory" name="catagory" placeholder="skills catagory" style="margin-bottom: 10px" type="text" />
											</div>
										</div>
										<div id="div_id_number" class="form-group required">
											<label for="id_number" class="control-label col-md-3  requiredField"> contact number<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9 ">
												<input class="input-md textinput textInput form-control" id="id_number" name="number" placeholder="provide your number" style="margin-bottom: 10px" type="text" />
											</div>
										</div>
										<div id="div_id_location" class="form-group required">
											<label for="id_location" class="control-label col-md-3  requiredField"> Your Location<span class="asteriskField">*</span> </label>
											<div class="controls col-md-9 ">
												<input class="input-md textinput textInput form-control" id="id_location" name="location" placeholder="Your Pincode and City" style="margin-bottom: 10px" type="text" />
											</div>
										</div>
										<div class="form-group">
											<div class="controls col-md-offset-3 col-md-9 ">
												<div id="div_id_terms" class="checkbox required">
													<label for="id_terms" class=" requiredField">
														<input class="input-ms checkboxinput" id="id_terms" name="terms" style="margin-bottom: 10px" type="checkbox" />
														Agree with the terms and conditions
													</label>
												</div>

											</div>
										</div>
										<div class="form-group">
											<div class="aab controls col-md-3 "></div>
											<div class="controls col-md-9 ">
												<input type="submit" name="Signup" value="Signup" class="btn btn-primary btn btn-info" id="submit-id-signup" />
												or <input type="button" name="Signup" value="Sign Up with Facebook" class="btn btn btn-primary" id="button-id-signup" />
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.widget-box -->
			</div><!-- /.col -->
		</div><!-- /.row -->

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
	</div><!-- /.row -->
	</div><!-- /.page-content -->
	</div>
	</div><!-- /.main-content -->

	<div class="footer">
		<div class="footer-inner">
			<div class="footer-content">
				<span class="bigger-120">
					<span class="blue bolder">Softicket</span>
					&copy; 2019
				</span>

				<!-- &nbsp; &nbsp;
				<span class="action-buttons">
					<a href="#">
						<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
					</a>

					<a href="#">
						<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
					</a>

					<a href="#">
						<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
					</a>
				</span> -->
			</div>
		</div>
	</div>

	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
	</a>
	</div><!-- /.main-container -->

	<!-- basic scripts -->

	<!--[if !IE]> -->
	<script src="assets/js/jquery-2.1.4.min.js"></script>

	<!-- <![endif]-->

	<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
	<script type="text/javascript">
		if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
	</script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- page specific plugin scripts -->

	<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
	<script src="assets/js/jquery-ui.custom.min.js"></script>
	<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
	<script src="assets/js/jquery.easypiechart.min.js"></script>
	<script src="assets/js/jquery.sparkline.index.min.js"></script>
	<script src="assets/js/jquery.flot.min.js"></script>
	<script src="assets/js/jquery.flot.pie.min.js"></script>
	<script src="assets/js/jquery.flot.resize.min.js"></script>

	<!-- ace scripts -->
	<script src="assets/js/ace-elements.min.js"></script>
	<script src="assets/js/ace.min.js"></script>

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
			$('.easy-pie-chart.percentage').each(function() {
				var $box = $(this).closest('.infobox');
				var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
				var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
				var size = parseInt($(this).data('size')) || 50;
				$(this).easyPieChart({
					barColor: barColor,
					trackColor: trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: parseInt(size / 10),
					animate: ace.vars['old_ie'] ? false : 1000,
					size: size
				});
			})

			$('.sparkline').each(function() {
				var $box = $(this).closest('.infobox');
				var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
				$(this).sparkline('html', {
					tagValuesAttribute: 'data-values',
					type: 'bar',
					barColor: barColor,
					chartRangeMin: $(this).data('min') || 0
				});
			});


			//flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			//but sometimes it brings up errors with normal resize event handlers
			$.resize.throttleWindow = false;

			var placeholder = $('#piechart-placeholder').css({
				'width': '90%',
				'min-height': '150px'
			});
			var data = [{
					label: "social networks",
					data: 38.7,
					color: "#68BC31"
				},
				{
					label: "search engines",
					data: 24.5,
					color: "#2091CF"
				},
				{
					label: "ad campaigns",
					data: 8.2,
					color: "#AF4E96"
				},
				{
					label: "direct traffic",
					data: 18.6,
					color: "#DA5430"
				},
				{
					label: "other",
					data: 10,
					color: "#FEE074"
				}
			]

			function drawPieChart(placeholder, data, position) {
				$.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt: 0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne",
						labelBoxBorderColor: null,
						margin: [-30, 15]
					},
					grid: {
						hoverable: true,
						clickable: true
					}
				})
			}
			drawPieChart(placeholder, data);

			/**
			we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			so that's not needed actually.
			*/
			placeholder.data('chart', data);
			placeholder.data('draw', drawPieChart);


			//pie chart tooltip example
			var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			var previousPoint = null;

			placeholder.on('plothover', function(event, pos, item) {
				if (item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent'] + '%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({
						top: pos.pageY + 10,
						left: pos.pageX + 10
					});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}

			});

			/////////////////////////////////////
			$(document).one('ajaxloadstart.page', function(e) {
				$tooltip.remove();
			});




			var d1 = [];
			for (var i = 0; i < Math.PI * 2; i += 0.5) {
				d1.push([i, Math.sin(i)]);
			}

			var d2 = [];
			for (var i = 0; i < Math.PI * 2; i += 0.5) {
				d2.push([i, Math.cos(i)]);
			}

			var d3 = [];
			for (var i = 0; i < Math.PI * 2; i += 0.2) {
				d3.push([i, Math.tan(i)]);
			}


			var sales_charts = $('#sales-charts').css({
				'width': '100%',
				'height': '220px'
			});
			$.plot("#sales-charts", [{
					label: "Domains",
					data: d1
				},
				{
					label: "Hosting",
					data: d2
				},
				{
					label: "Services",
					data: d3
				}
			], {
				hoverable: true,
				shadowSize: 0,
				series: {
					lines: {
						show: true
					},
					points: {
						show: true
					}
				},
				xaxis: {
					tickLength: 0
				},
				yaxis: {
					ticks: 10,
					min: -2,
					max: 2,
					tickDecimals: 3
				},
				grid: {
					backgroundColor: {
						colors: ["#fff", "#fff"]
					},
					borderWidth: 1,
					borderColor: '#555'
				}
			});


			$('#recent-box [data-rel="tooltip"]').tooltip({
				placement: tooltip_placement
			});

			function tooltip_placement(context, source) {
				var $source = $(source);
				var $parent = $source.closest('.tab-content')
				var off1 = $parent.offset();
				var w1 = $parent.width();

				var off2 = $source.offset();
				//var w2 = $source.width();

				if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
				return 'left';
			}


			$('.dialogs,.comments').ace_scroll({
				size: 300
			});


			//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
			//so disable dragging when clicking on label
			var agent = navigator.userAgent.toLowerCase();
			if (ace.vars['touch'] && ace.vars['android']) {
				$('#tasks').on('touchstart', function(e) {
					var li = $(e.target).closest('#tasks li');
					if (li.length == 0) return;
					var label = li.find('label.inline').get(0);
					if (label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation();
				});
			}

			$('#tasks').sortable({
				opacity: 0.8,
				revert: true,
				forceHelperSize: true,
				placeholder: 'draggable-placeholder',
				forcePlaceholderSize: true,
				tolerance: 'pointer',
				stop: function(event, ui) {
					//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
					$(ui.item).css('z-index', 'auto');
				}
			});
			$('#tasks').disableSelection();
			$('#tasks input:checkbox').removeAttr('checked').on('click', function() {
				if (this.checked) $(this).closest('li').addClass('selected');
				else $(this).closest('li').removeClass('selected');
			});


			//show the dropdowns on top or bottom depending on window height and menu position
			$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
				var offset = $(this).offset();

				var $w = $(window)
				if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
					$(this).addClass('dropup');
				else $(this).removeClass('dropup');
			});

		})
	</script>
</body>

</html>