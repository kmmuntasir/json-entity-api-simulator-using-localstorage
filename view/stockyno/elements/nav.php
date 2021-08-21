<nav id="main_nav" class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<div class="container-fluid">

		<button type="button" id="sidebarCollapse" class="btn btn-success">
			<i class="fas fa-align-justify"></i>
			<span>Toggle Sidebar</span>
		</button>
		<!-- Navigation Buttons -->
		<button class="btn btn-dark btn-sm ml-2" onclick="window.history.go(-1); return false;">
			<i class="fas fa-arrow-left"></i>
		</button>
		<button class="btn btn-dark btn-sm ml-1" onclick="window.history.go(1); return false;">
			<i class="fas fa-arrow-right"></i>
		</button>
		<button class="btn btn-dark btn-sm ml-1" onclick="window.location.reload()">
			<i class="fas fa-sync"></i>
		</button>

		<button class="a navbar-brand" data-href="<?php echo site_url('dashboard'); ?>">
			<span id="navbar_brand_name" class="ml-3">Json Simulator<span>
		</button>

		<div class="ml-auto"></div>
	</div>
</nav>
