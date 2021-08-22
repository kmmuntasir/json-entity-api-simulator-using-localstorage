<div class="card">
	<div class="card-header">
		<?php echo $this->router->fetch_class(); ?>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-4">
						<div class="card mb-4">
							<div class="card-header bg-primary text-light p-1 pl-2">Category</div>
							<div class="card-body">
								<h1 class="text-warning text-right"><?php echo $category_count; ?></h1>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card mb-4">
							<div class="card-header bg-warning text-light p-1 pl-2">Subcategory</div>
							<div class="card-body">
								<h1 class="text-success text-right"><?php echo $subcategory_count; ?></h1>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card mb-4">
							<div class="card-header bg-success text-light p-1 pl-2">Post</div>
							<div class="card-body">
								<h1 class="text-success text-right"><?php echo $post_count; ?></h1>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-4">
					<div class="card-header">
						JSON Actions
					</div>
					<div class="card-body">
						<a href="<?php echo $rebuild_json_url; ?>" class="btn btn-primary">Rebuild JSONs</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header">
						Recent Posts
					</div>
					<div class="card-body">
						<table class="table">
							<?php foreach ($recent_posts as $post) { ?>
							<tr>
								<td width="50">
									<img src="<?php echo base_url('images/'.$post->post_image) ?>" style="width: 50px;">
								</td>
								<td>
									<h5><?php echo $post->post_title; ?></h5>
									<small><?php echo date('M d, Y, h:i a', strtotime($post->timestamp)); ?></small>
								</td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
