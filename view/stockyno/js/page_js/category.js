function post_process_datatable() {
	$('.datatable tbody tr').each(function () {
		var p_flag = $(this).attr('rendered');
		if (p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:last-child()').html();

		if (dt_validate_id(id)) {
			var imgSrc = imageRoot + $(this).children('td:nth-child(3)').html();
			var imgElement = `<img class="dataTables_image_preview" src="${imgSrc}">`;
			$(this).children('td:nth-child(3)').html(imgElement);

			var data_status = $('.page_subtitle').html();
			var buttons = '<div class="header-dropdown"><div class="dropdown"><button class="btn btn-sm btn-dark dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i></button><ul class="dropdown-menu datatable_action_link">';

			buttons += '<button data-param="2" data-detail="Option" class="edit pointer dropdown-item" href="#" entity_id="' + id + '"><span class="dropdown-item-icon"><i class="fas fa-pencil-alt"></i></span> Edit</button>';
			if (data_status == 'Deleted')
				buttons += '<button class="restore pointer dropdown-item" href="#" entity_id="' + id + '"><span class="dropdown-item-icon"><i class="fas fa-undo"></i></span> Restore</button>';
			else buttons += '<button class="delete pointer dropdown-item" href="#" entity_id="' + id + '"><span class="dropdown-item-icon"><i class="fas fa-trash-alt"></i></span> Delete</button>';

			buttons += '</ul></div></div>';
			$(this).children('td:last-child()').html(buttons);
		}

	});
}


function edit_form_post_process(item_category) {
	$('#edit_modal .modal-title span').html(item_category.item_category_name);
	// $('#edit_modal .datepicker').val(formatDate($('#edit_modal .datepicker').val(), 'MMMM d, yyyy'));
}

