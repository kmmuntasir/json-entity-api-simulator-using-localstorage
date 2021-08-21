<!DOCTYPE html>
<html>

<?php require_once('elements/head.php'); ?>

<body>
<div class="databox">
	<input type="hidden" id="page" value="<?php echo $page; ?>">
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
	<input type="hidden" id="fetch_action" value="<?php echo $fetch_action; ?>">
	<input type="hidden" id="delete_action" value="<?php echo $delete_action; ?>">
	<input type="hidden" id="restore_action" value="<?php echo $restore_action; ?>">
	<input type="hidden" id="entity_id_post_name" value="<?php echo $entity_id_post_name; ?>">
</div>

<?php require_once('elements/nav.php'); ?>
<div class="wrapper">
	<?php require_once('elements/sidebar.php'); ?>

	<!-- Page Content -->
	<div id="content">
		<!-- Loader -->
		<div id="overlay_loader">
			<div id="loader_content">
				<span><i class="fas fa-spinner fa-spin"></i></span>
				<div class="clearfix"></div>
				<div class="text-center full_width loader_text alert bg-dark text-white"></div>
			</div>
		</div> <!-- Loader end -->
		<?php require_once('pages/v_' . $page . '.php'); ?>
	</div>

</div><!-- wrapper end -->

<?php require_once('elements/scripts.php'); ?>

</body>

</html>
