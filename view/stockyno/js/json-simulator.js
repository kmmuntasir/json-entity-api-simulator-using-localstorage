// var page = '';
// var base_url = '';
// var site_url = '';
// var admin_type = '';

// var fetch_action = '';
// var delete_action = '';
// var restore_action = '';
// var entity_id_post_name = '';


$(document).ready(function () {
	// Collecting necessary data
	load_databox();

	// ============= Sidebar Controlling Functions ============= //
	$("#sidebar").mCustomScrollbar({
		theme: "minimal"
	});

	$('.overlay').on('click', function () {
		// hide sidebar
		$('#sidebar').removeClass('active');
		// hide overlay
		$('.overlay').removeClass('active');
	});

	$('#sidebarCollapse').on('click', function () {
		// open sidebar
		$('#sidebar').toggleClass('active');
		// hide overlay

		// fade in the overlay
		$('.overlay').toggleClass('active');
		$('.collapse.in').toggleClass('in');
		$('a[aria-expanded=true]').attr('aria-expanded', 'false');
	});
	// Function for opening sidebar dropdowns by default if page is active
	$('.child_module_link.active').parents('ul').siblings('.a').click();


	// Binding Left/Right Arrow Keys to Confirmation "Yes"/"No" Buttons

	$(document).keyup(function (event) {
		var key = event.which;
		var confirmation_stat = $('#confirm_box_modal').css('display');
		if (confirmation_stat == 'block') {
			if (key == 39) $('#confirmation_no_button').focus();
			else if (key == 37) $('#confirmation_yes_button').focus();
		}
	});

	lightbox_title();

	// Function for making fields required.
	$('.required').attr('required', 'required');

	// Datepicker/Timepicker Functions

	$('.datepicker').datepicker({
		dateFormat: 'MM d, yy',
		//dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true
	});

	$('.timepicker').timepicker({
		zindex: 11000,
		interval: 15,
		scrollbar: true
	});

	$('.monthpicker').datepicker({
		//dateFormat: 'MM d, yy',
		//dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'MM yy',
		beforeShow: function (input) {
			$(input).datepicker("widget").addClass('hide-calendar');
		},
		onClose: function (dateText, inst) {
			$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
			$(this).datepicker('widget').removeClass('hide-calendar');
		}
	});

	// Function for changing datepicker format to mysql format before submitting

	$(document).on('submit', 'form', function () {
		$(this).find('.datepicker').each(function () {
			var d = $(this).val();
			//alert(d.indexOf('N'));
			if (d == '' || d.indexOf('NaN') != -1) {
				$(this).val('');
			} else {
				d = formatDate(d, 'yyyy-MM-dd');
				$(this).val(d);
			}
		});

		$(this).find('.monthpicker').each(function () {
			var d = $(this).val();
			if (d == '' || d.indexOf('NaN') != -1) {
				$(this).val('');
			} else {
				d = formatDate(d, 'yyyy-MM-01');
				$(this).val(d);
			}
		});

		$(this).find('.timepicker').each(function () {
			var d = $(this).val();
			if (d == '' || d.indexOf('NaN') != -1) {
				$(this).val('');
			} else {
				d = '2018-01-01 ' + d;
				d = formatDate(d, 'HH:mm:ss');
				$(this).val(d);
			}
		});
	});

	$('.datepicker').attr('autocomplete', 'off');
	$('.timepicker').attr('autocomplete', 'off');
	$('.monthpicker').attr('autocomplete', 'off');

});

function load_databox() {
	$('.databox').hide();
	$('.databox').children('input').each(function () {
		window[$(this).attr('id')] = $(this).val();
	});
}

function lightbox_title() {
	$('.lightbox_img').attr('title', 'Click to View Larger');
}

// Custom function for string replacing (replaces all occurances)
function replace_all(text, search, replacement) {
	while (text.indexOf(search) != -1) text = text.replace(search, replacement);
	return text;
}

// Duration Formatter Function

function formatDuration(duration) {
	// This function returns a formatted string (as hour and minute) for a time duration (as minute)

	if (duration < 1) return "Invalid Time Duration";

	var final_duration = '';

	var ex_hour = parseInt(duration / 60);
	if (ex_hour > 0) final_duration += ex_hour + ' hour';
	if (ex_hour > 1) final_duration += 's ';

	if (final_duration != '') final_duration += ' ';

	var ex_minute = duration % 60;
	if (ex_minute > 0) final_duration += ex_minute + ' minute';
	if (ex_minute > 1) final_duration += 's';

	return final_duration;
}


// Date Formatter Function
function formatDate(date = null, format = 'MMM d, yyyy') {
	// Requires jquery-dateFormat Plugin
	// yy = short year
	// yyyy = long year
	// M = month (1-12)
	// MM = month (01-12)
	// MMM = month abbreviation (Jan, Feb ... Dec)
	// MMMM = long month (January, February ... December)
	// d = day (1 - 31)
	// dd = day (01 - 31)
	// ddd = day of the week in words (Monday, Tuesday ... Sunday)
	// E = short day of the week in words (Mon, Tue ... Sun)
	// D - Ordinal day (1st, 2nd, 3rd, 21st, 22nd, 23rd, 31st, 4th...)
	// h = hour in am/pm (0-12)
	// hh = hour in am/pm (00-12)
	// H = hour in day (0-23)
	// HH = hour in day (00-23)
	// mm = minute
	// ss = second
	// SSS = milliseconds
	// a = AM/PM marker
	// p = a.m./p.m. marker

	if (date != null) var d = new Date(date);
	else var d = new Date();
	return $.format.date(d, format)
}


// Function for simulating clicking on a link with button.a


$(document).on('mousedown', '.a', function (event) {
	var url = $(this).attr('data-href');
	if (url) {
		if (event.which == 1) window.location.href = url; // Left Click
		else if (event.which == 2) {                      // Middle Button Click
			openUrlInNewTab(url, false);
		}
	}
});

function openUrlInNewTab(url, focus = true, allowMessage = 'Please allow popups for this website', msg_class = 'danger') {
	let win = window.open(url, '_blank');
	if (win) {
		//Browser has allowed it to be opened
		if (focus) win.focus();     // For auto focusing to the new tab
	} else {
		//Browser has blocked it
		notify(allowMessage, msg_class);
	}
}


// Functions for showing/hiding loader

function show_loader(loader_msg = null) {
	if (loader_msg != null) {
		$('#overlay_loader .loader_text').html(loader_msg)
		$('#overlay_loader .loader_text').show();
	}
	$('#overlay_loader').show();
}

function hide_loader() {
	$('#overlay_loader').hide();
	$('#overlay_loader .loader_text').hide();
}


// Function for showing user a notification for t seconds
function notify(msg_text, msg_class = 'info', t = 5000, modal_size = 'sm') {
	$('#notification_message').remove();
	var notification = '<div class="modal fade" id="notification_message" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-' + modal_size + '" role="document"><div class="modal-content bg-' + msg_class + ' text-white"><div class="modal-body"><b>' + msg_text + '</b><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div></div></div>';


	$('body').append(notification);
	$('#notification_message').modal({
		backdrop: false
	});

	setTimeout(function () {
		$('#notification_message').fadeOut(3000, function () {
			$(this).remove();
		});
	}, t);
}

// Function for checking if a string is proper JSON string
function isJson(str) {
	try {
		JSON.parse(str);
	} catch (e) {
		return false;
	}
	return true;
}


// Confirmation Mechanism
function confirmation(yes_fn = 'close_confirmation', yes_data = '', text = 'Are you sure?', no_fn = 'close_confirmation', no_data = '') {
	if (text == '') text = 'Are you sure?';
	var confirm_box_modal = '<div class="modal" id="confirm_box_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">' + text + '</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	//confirm_box_modal += '<div class="modal-body"></div>';
	confirm_box_modal += '<div class="modal-footer">';

	if ($.type(yes_data) !== 'string') yes_data = JSON.stringify(yes_data);
	if ($.type(no_data) !== 'string') yes_data = JSON.stringify(no_data);
	// no_data = JSON.stringify(no_data);

	confirm_box_modal += '<button type="button" id="confirmation_yes_button" do="' + yes_fn + '" do_data=\'' + yes_data + '\' class="confirmation_button btn btn-danger btn-sm">Yes</button>';
	confirm_box_modal += '<button type="button" id="confirmation_no_button" do="' + no_fn + '" do_data=\'' + no_data + '\' class="confirmation_button btn bg-dark text-white btn-sm">No</button>';
	confirm_box_modal += '</div></div></div></div>';

	$('#confirm_box_modal').remove();
	$('body').append(confirm_box_modal);
	$('#confirm_box_modal').modal('show');
	$('#confirmation_no_button').focus();
}

function close_confirmation(data = null) {
	$('#confirm_box_modal').modal('hide').remove();
}

$(document).on('click', '.confirmation_button ', function () {
	var confirmation_fn = $(this).attr('do');
	var confirmation_data = $(this).attr('do_data');
	if (isJson(confirmation_data)) confirmation_data = $.parseJSON(confirmation_data);
	window[confirmation_fn](confirmation_data); // calling the function matching the function name with the page string.
	close_confirmation();
});

// Lightbox Mechanism
$(document).on('click', '.lightbox_img', function () {
	var src = $(this).attr('src');
	show_lightbox(src);
});

function show_lightbox(src) {

	var lightbox_modal = '<div class="modal" id="lightbox_modal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-md" role="document"><div class="modal-content bg-dark"><div class="modal-header"><h5 class="modal-title text-white">Image Viewer</h5><button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	lightbox_modal += '<div class="modal-body">';
	lightbox_modal += '<img src="' + src + '" class="lightbox_modal_img" >';
	lightbox_modal += '</div>';
	// lightbox_modal += '<div class="modal-footer">';


	// lightbox_modal += '<button type="button" class="btn btn-danger btn-sm">Hi</button>';
	// lightbox_modal += '</div>'; // Finishing Footer
	lightbox_modal += '</div></div></div>';

	$('#lightbox_modal').remove();
	$('body').append(lightbox_modal);
	$('#lightbox_modal').modal('show');
}

function new_window(destination = null, blocked_msg = "Please allow popups for this website", blank = true) {
	if (destination == null) return;
	if (blank) blank = '_blank';
	var win = window.open(destination, blank);
	if (win) {
		//Browser has allowed it to be opened
		win.focus();
		return true;
	} else {
		//Browser has blocked it
		notify(blocked_msg);
	}
}

function dt_validate_id(id) {
	if (id != null && id != '' && id != undefined && id != 'Loading...' && id != 'No data available in table' && id != 'No matching records found') return true;
	return false;
}


// Function for resetting add_form
$('#add_modal').on('shown.bs.modal', function (e) {
	$('#add_modal form')[0].reset();
	$('.custom-file-label').html('Upload Image');
	$('.custom-upload-image-preview').attr('src', '#').hide();
})

// Function for Adding =============================================================
/*
$(document).on('submit', '#add_form', function() {
    confirmation('add_final', 1)
    event.preventDefault();
    return;
});

function add_final(arg) {
    show_loader();

    var form = $('#add_form')[0];
    var formData = new FormData(form);

    var action = $('#add_form').attr('action');
    var entity = $('#add_form').attr('entity');
    if(entity == undefined) entity = page;
    $.ajax({
        url: action,
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data){
            hide_loader();
            if(data == 'success') {
                notify('Added Successfully', 'success');
                reload_dtable();
                $('#add_modal').modal('toggle');
            }
            else notify(data, 'danger');
        }
    });
}
/* ============================================================= */

$(document).on('click', '.add_sub_item_button', function () {
	var entity_id = $(this).attr('entity_id');
	$('#add_sub_item_form')[0].reset();
	$('#sub_parent_id').val(entity_id);
	$('#add_sub_item_modal').modal('toggle');
});

$(document).on('submit', '.ajax_form', function () {
	var id = '#' + $(this).attr('id');
	var callback = $(this).attr('callback');
	var form_submit_data = {
		'id': id,
		'callback': callback
	};
	confirmation('form_submit_final', form_submit_data)
	event.preventDefault();
	return;
});

function form_submit_final(form_submit_data) {
	show_loader();

	var form = $(form_submit_data.id)[0];
	var formData = new FormData(form);

	var action = $(form_submit_data.id).attr('action');
	var success_msg = $(form_submit_data.id).attr('message');
	if (success_msg == undefined) success_msg = 'Success';
	var entity = $(form_submit_data.id).attr('entity');
	if (entity == undefined) entity = page;

	// console.log(action);
	// console.log(success_msg);
	// console.log(entity);
	// event.preventDefault();
	// return;
	$.ajax({
		url: action,
		data: formData,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function (data) {
			hide_loader();
			if (data == 'success') {
				notify(success_msg, 'success');
				reload_dtable();
				// $('#add_modal').modal('toggle');
				$(form_submit_data.id).parents('.modal').modal('toggle');

				if (form_submit_data.callback != undefined)
					window[form_submit_data.callback]();
			} else notify(data, 'danger');
		}
	});
}


// This function returns the tagname of the element provided to this function, in lowercase
// function tagger(obj) {
//   return obj.prop("tagName").toLowerCase();
// };

// Functions for showing Edit Form with existing data =============================================================
$(document).on('click', '.edit', function () {
	// alert(fetch_action);
	// return;
	show_loader();
	var id = $(this).attr('entity_id');
	var datastring = {};
	datastring[entity_id_post_name] = id;
	$('#edit_form')[0].reset();

	$('.custom-file-label').html('Upload Image');
	$('.custom-upload-image-preview').attr('src', '#').css('display', 'none');

	// alert(id);

	// var entity_id_post_input = "<input type='hidden' id='"+entity_id_post_name+"_input' name='" + entity_id_post_name + "' value='" + id + "'>";

	// // alert(entity_id_post_input);

	// $('#' + entity_id_post_name + "_input").remove();
	// $('#edit_form').append(entity_id_post_input);

	$.post(fetch_action, datastring, function (data) {
		// alert(data);
		// return;
		var entity = $.parseJSON(data);

		// $.each(entity, function(key,val){

		// });

		$('#edit_form input, #edit_form select, #edit_form textarea').each(
			function (index) {
				var element = $(this);
				var tag = element.prop("tagName").toLowerCase();
				var type = element.attr('type');
				var name = element.attr('name');
				var value = element.val();
				var possible_value = entity[name];

				// alert('Tag: ' + tag + ', Type: ' + element.attr('type') + ', Name: ' + element.attr('name') + ', Value: ' + element.val());

				if (tag == 'input') {
					if (type == 'password' || type == 'file') {
						// Do nothing
					} else if (type != 'radio' && type != 'checkbox') {
						element.val(possible_value);
					} else {
						element.removeAttr('checked');
						if (value == possible_value) element.attr('checked', 'checked');
					}
				} else if (tag == 'select') {
					$(this).children('option').each(function () {

						if ($(this).attr('value') == possible_value) {
							element.attr('selected', 'selected')
							element.val(possible_value);
						}
					});
				} else { // Textarea
					var possible_value = entity[name];
					element.val(possible_value);
				}
			}
		);
		edit_form_post_process(entity);
		// $('#edit_form').attr('action', update_action);
		hide_loader();
		$('#edit_modal').modal('toggle');
		$('#edit_form .form_focus').focus();
	});
});


// Function for Updating
/* ====================================================
$(document).on('submit', '#edit_form', function() {
    confirmation('update_final', 1);
    event.preventDefault();
    return;
});

function update_final(arg) {
    show_loader();

    var form = $('#edit_form')[0];
    var formData = new FormData(form);

    var action = $('#edit_form').attr('action');
    var entity = $('#edit_form').attr('entity');
    if(entity == undefined) entity = page;

    $.ajax({
        url: action,
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data){
            hide_loader();
            if(data == 'success') {
                notify('Updated Successfully', 'success');
                reload_dtable();
                //$('#edit_form')[0].reset();
                $('#edit_modal').modal('toggle');
            }
            else notify(data, 'danger');
        }
    });
}
/* =========================================================== */


// Functions for deleting =============================================================
$(document).on('click', '.delete', function () {
	var id = $(this).attr('entity_id');
	var entity = $(this).attr('entity');
	if (entity == undefined) entity = page;
	confirmation('delete_final', id, 'You are going to delete this ' + entity + '.<br>Are you sure?');
});

function delete_final(id) {
	show_loader();
	var datastring = {};
	datastring[entity_id_post_name] = id;
	$.post(delete_action, datastring, function (data) {
		hide_loader();
		if (data == 'success') {
			notify('Deleted Successfully', 'success');
			reload_dtable();
		} else notify(data, 'danger');
	});
}


// Functions for restoring =============================================================
$(document).on('click', '.restore', function () {
	var id = $(this).attr('entity_id');
	var entity = $(this).attr('entity');
	if (entity == undefined) entity = page;
	confirmation('restore_final', id, 'You are going to restore this ' + entity + '.<br>Are you sure?');
});

function restore_final(id) {
	show_loader();
	var datastring = {};
	datastring[entity_id_post_name] = id;
	$.post(restore_action, datastring, function (data) {
		hide_loader();
		if (data == 'success') {
			notify('Restored Successfully', 'success');
			reload_dtable();
		} else notify(data, 'danger');
	});
}

function scrollToTop() {
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}


// Select2 Basic Ajax Sourced Processing Function =============================

$('.select2_ajax').each(function () {
	var selector = $(this);
	$(selector).css('width', '100%');
	$(selector).select2({
		ajax: {
			url: $(selector).attr('data-source'),
			dataType: 'json',
			delay: 150,
			data: function (params) {
				return {
					query: params.term, // search term
					page: params.page
				};
			},
			cache: false
		},
		placeholder: $(selector).attr('placeholder'),
		// minimumInputLength: 1,
		dropdownParent: $(selector).parent()
	});
});


$('.custom-file-input').change(function() {
	var fileToBeUploaded = $('.custom-file-input')[0].files[0];
	var fileName = fileToBeUploaded.name;
	$(this).siblings('.custom-file-label').html(fileName);

	var thumbnailSource = URL.createObjectURL(fileToBeUploaded);

	var imgElement = $(this).parent('div').siblings('div').children('.custom-upload-image-preview');
	imgElement.attr("src", thumbnailSource);
	imgElement.css('display', 'block');
});
