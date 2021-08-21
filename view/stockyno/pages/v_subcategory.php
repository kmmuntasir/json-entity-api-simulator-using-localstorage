<div class="card">
	<div class="card-header">
		<?php echo $this->router->fetch_class(); ?>
		<span class="page_subtitle">Active</span>
		<div class="card-header-btn-bar">
			<button id="add_button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add_modal">
				<i class="fas fa-plus"></i>
				<span>Add</span>
			</button>
			<div class="dropdown ml-2">
				<button class="btn btn-sm btn-dark dropdown-toggle" type="button" data-toggle="dropdown"
						aria-expanded="false">
					<i class="fas fa-cogs"></i>
					<?php if (false) { ?>
						<span class="badge badge-warning"><?php echo "2"; ?></span>
					<?php } ?>
				</button>
				<div class="dropdown-menu mobile_margin">
					<button data-param="0" data-detail="Active" class="pointer dtable_param dropdown-item" href="#">
						<span class="dropdown-item-icon"><i class="fas fa-check"></i></span> Active Items
					</button>
					<button data-param="1" data-detail="Deleted" class="pointer dtable_param dropdown-item" href="#">
						<span class="dropdown-item-icon"><i class="fas fa-trash-alt"></i></span> Deleted Items
					</button>
				</div>
			</div>

		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table data-sort-dir="desc" data-sort="1" data-server="yes" data-page="<?php echo $page; ?>"
				   data-source="<?php echo $data_source; ?>" class="table table-striped table-hover table-sm datatable">
				<thead>
				<tr>
					<th class="dt_xs">ID</th>
					<th>Subcategory</th>
					<th>Icon</th>
					<th>Category</th>
					<th>Updated</th>
					<th data-sortable="false" id="action_thead"></th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<td>ID</td>
					<td>Subcategory</td>
					<td>Icon</td>
					<td>Category</td>
					<td>Updated</td>
					<td id="action_tfoot"></td>
				</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

<!------------------ Modal ----------------------->

<!-- Add Subcategory Modal -->
<div id="add_modal" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add New Subcategory</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="ajax_form" id="add_form" message="Added Successfully" action="<?php echo $add_action; ?>"
					  method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Parent Category</label>
						<select name="category_id" class="required form-control">
							<?php foreach($categories as $category) { ?>
								<option value="<?php echo $category->category_id ?>"><?php echo $category->category_name ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Subcategory Name</label>
						<input type="text" name="subcategory_name" class="required form-control"
							   placeholder="Enter Subcategory Name">
					</div>
					<div class="form-group">
						<label>Subcategory Icon</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input required" name="subcategory_icon">
							<label class="custom-file-label" for="subcategory_icon" style="background-color: #ffd99e">Upload Image</label>
						</div>
						<div class="custom-upload-image-preview-container">
							<img class="custom-upload-image-preview" src="#">
						</div>
					</div>
					<div class="form-group">
						<p class="text-danger">*LIGHT ORANGE fields are required</p>
					</div>
					<div class="form-group">
						<button type="submit" class="float-right btn btn-primary">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Edit Subcategory Modal -->
<div id="edit_modal" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Subcategory: <span></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="ajax_form" id="edit_form" message="Updated Successfully"
					  action="<?php echo $update_action; ?>" method="post">
					<div class="form-group">
						<label>Parent Category</label>
						<select name="category_id" class="required form-control">
							<?php foreach($categories as $category) { ?>
							<option value="<?php echo $category->category_id ?>"><?php echo $category->category_name ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Subcategory Name</label>
						<input type="text" name="subcategory_name" class="required form-control"
							   placeholder="Enter Subcategory Name">
						<input type="hidden" name="<?php echo $entity_id_field_name; ?>">
					</div>
					<div class="form-group">
						<label>Subcategory Icon</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="subcategory_icon">
							<label class="custom-file-label" for="subcategory_icon">Upload Image</label>
						</div>
						<div class="custom-upload-image-preview-container">
							<img class="custom-upload-image-preview" src="#">
						</div>
					</div>
					<div class="form-group">
						<p class="text-danger">*LIGHT ORANGE fields are required</p>
					</div>
					<div class="form-group">
						<button type="submit" class="float-right btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
