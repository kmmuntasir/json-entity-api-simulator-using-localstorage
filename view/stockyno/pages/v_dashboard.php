<div class="card">
	<div class="card-header">
		<?php echo $this->router->fetch_class(); ?>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-3">
				<div class="card">
					<div class="card-header bg-info text-light p-0 pl-2">
						Stock Quantity
						<!--								 <span class="page_subtitle">Active</span>-->
					</div>
					<div class="card-body">
						<h1 class="text-info text-right">7,861</h1>
					</div>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header bg-warning text-light p-0 pl-2">
						Stock Cost
						<!--								 <span class="page_subtitle">Active</span>-->
					</div>
					<div class="card-body">
						<h1 class="text-warning text-right">৳12,456</h1>
					</div>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header bg-success text-light p-0 pl-2">
						Stock Value
						<!--								 <span class="page_subtitle">Active</span>-->
					</div>
					<div class="card-body">
						<h1 class="text-success text-right">৳20,456</h1>
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="row">
					<div class="col-sm-6">
						<div class="card">
							<div class="card-header bg-danger text-light p-0 pl-2">
								Sale Due
								<!--								 <span class="page_subtitle">Active</span>-->
							</div>
							<div class="card-body">
								<h1 class="text-danger text-right">৳320,456</h1>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card">
							<div class="card-header bg-primary text-light p-0 pl-2">
								Purchase Due
								<!--								 <span class="page_subtitle">Active</span>-->
							</div>
							<div class="card-body">
								<h1 class="text-primary text-right">৳120,456</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header">
						Income Summary
						<!-- <span class="page_subtitle">Active</span> -->
					</div>
					<div class="card-body">
						<div class="alert alert-lg alert-success">Today: 12,456/=</div>
						<div class="alert alert-lg alert-success">This Month: 312,456/=</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header">
						Expense Summary
						<!-- <span class="page_subtitle">Active</span> -->
					</div>
					<div class="card-body">
						<div class="alert alert-lg alert-warning">Today: 12,456/=</div>
						<div class="alert alert-lg alert-warning">This Month: 312,456/=</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header">
						Profit Summary
						<!-- <span class="page_subtitle">Active</span> -->
					</div>
					<div class="card-body">
						<div class="alert alert-lg alert-primary">Today: 12,456/=</div>
						<div class="alert alert-lg alert-primary">This Month: 312,456/=</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						This Month Sales Graph
						<!-- <span class="page_subtitle">Active</span> -->
					</div>
					<div class="card-body">
						<img src="<?php echo $fullpath; ?>/img/line-graph.jpg" style="width: 100%; height: 300px;">
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
