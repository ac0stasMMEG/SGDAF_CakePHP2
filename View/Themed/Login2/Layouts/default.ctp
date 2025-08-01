<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'Sistema Gestion DAF');
?>
<?php echo $this->Html->docType('html5'); ?>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template">
<!-- <html lang="en" class="light-style layout-menu-fixed layout-compact layout-menu-collapsed" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template"> -->

<head>
	<?php echo $this->Html->charset(); ?>

	<title>
		<?php echo $cakeDescription;
		?>
		<?php //echo $title_for_layout;
		?>
	</title>

	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th,
		td {
			border: 1px;
			padding: 4px;
			text-align: left;
			font-size: 12px;
		}
	</style>


	<?php

	echo $this->Html->meta('icon');
	echo $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no']);
	echo $this->fetch('meta');

	#************************************************************************
	#   TEMA PARA SISTEMA GESTION DE DATOS
	#************************************************************************
	#<!-- Canonical SEO -->
	/* echo $this->html->css('https://themeselection.com/item/sneat-bootstrap-html-admin-template/'); */

	#************************************************************************
	#<!-- Fonts -->
	#echo $this->Html->css('https://fonts.googleapis.com');
	#echo $this->Html->css('https://fonts.gstatic.com" crossorigin');
	echo $this->Html->css('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');
	#echo $this->Html->css('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap');
	#************************************************************************
	#<!-- Icons -->
	#/*
	echo $this->Html->css("../assets/vendor/fonts/boxicons.css");
	echo $this->Html->css("../assets/vendor/fonts/fontawesome.css");
	echo $this->Html->css("../assets/vendor/fonts/flag-icons.css");
	/*
    */
	#************************************************************************
	#<!-- Core CSS -->
	#/*
	echo $this->Html->css("../assets/vendor/css/rtl/core.css");
	echo $this->Html->css("../assets/vendor/css/rtl/theme-default.css");
	echo $this->Html->css("../assets/css/demo.css");
	echo $this->Html->css("../vendor/css/rtl/jgg.css");
	/*
    */
	#************************************************************************
	#<!-- Vendors CSS -->
	#/*
	echo $this->Html->css("../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css");
	echo $this->Html->css("../assets/vendor/libs/typeahead-js/typeahead.css");


	# TREE VIEW
	echo $this->Html->css("../assets/vendor/libs/jstree/jstree.css");

	#echo $this->Html->css("../assets/vendor/libs/bs-stepper/bs-stepper.css");
	echo $this->Html->css("../assets/vendor/libs/apex-charts/apex-charts.css");
	echo $this->Html->css("../assets/vendor/libs/animate-css/animate.css");


	# 	PICKER
	echo $this->Html->css("../assets/vendor/libs/flatpickr/flatpickr.css");
	echo $this->Html->css("../assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css");
	echo $this->Html->css("../assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css");
	echo $this->Html->css("../assets/vendor/libs/jquery-timepicker/jquery-timepicker.css");
	echo $this->Html->css("../assets/vendor/libs/pickr/pickr-themes.css");


	# 	EDITORS
	echo $this->Html->css("../assets/vendor/libs/quill/typography.css");
	echo $this->Html->css("../assets/vendor/libs/quill/katex.css");
	echo $this->Html->css("../assets/vendor/libs/quill/editor.css");
	#*/

	#	DATA TABLES
	echo $this->Html->css("//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css");

	echo $this->Html->css("../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css");
	echo $this->Html->css("../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css");
	echo $this->Html->css("../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css");
	echo $this->Html->css("../assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css");
	echo $this->Html->css("../assets/vendor/libs/flatpickr/flatpickr.css");

	# <!-- Row Group CSS -->
	echo $this->Html->css("../assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css");
	#*/

	#<!-- Helpers -->
	echo $this->Html->script("../assets/vendor/js/helpers.js");
	#<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
	#<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
	/* echo $this->Html->script("../assets/vendor/js/template-customizer.js"); */
	#<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
	echo $this->Html->script("../assets/js/config.js");

	// LOGIN
	#/*
	echo $this->Html->css("../assets/vendor/css/pages/page-auth.css");
	# */
	#************************************************************************

	echo $this->fetch('css');
	?>

</head>

<body>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<?php echo $this->element('menu/top_left_sidebar'); ?>
	</div>
	<!-- ./wrapper -->
	<?php
	#************************************************************************
	#   BOOSTRAP 5.0.2
	#************************************************************************
	#echo $this->Html->script("https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js");
	#echo $this->Html->script("https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js");
	#echo $this->Html->script("https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js");
	#************************************************************************

	#************************************************************************************************************************************************
	#************************************************************************************************************************************************
	#************************************************************************************************************************************************
	#   TEMA PARA SISTEMA GESTION DE DATOS
	#************************************************************************************************************************************************
	#	<!-- Core JS -->
	#/*	<!-- build:js assets/vendor/js/core.js -->
	echo $this->Html->script("../assets/vendor/libs/jquery/jquery.js");
	echo $this->Html->script("../assets/vendor/libs/popper/popper.js");
	echo $this->Html->script("../assets/vendor/js/bootstrap.js");
	echo $this->Html->script("../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js");
	echo $this->Html->script("../assets/vendor/libs/hammer/hammer.js");
	echo $this->Html->script("../assets/vendor/libs/i18n/i18n.js");
	echo $this->Html->script("../assets/vendor/libs/typeahead-js/typeahead.js");
	echo $this->Html->script("../assets/vendor/js/menu.js");
	#*/	<!-- endbuild -->
	#************************************************************************

	#	<!-- Vendors JS -->
	#/*
	echo $this->Html->script("../assets/vendor/libs/moment/moment.js");

	echo $this->Html->script("../assets/vendor/libs/sortablejs/sortable.js");
	echo $this->Html->script("../assets/vendor/libs/apex-charts/apexcharts.js");
	echo $this->Html->script("../assets/vendor/libs/bootstrap-select/bootstrap-select.js");
	echo $this->Html->script("../assets/vendor/libs/select2/select2.js");
	#echo $this->Html->script("../assets/vendor/libs/bs-stepper/bs-stepper.js");

	#	DATA TABLES
	echo $this->Html->script("../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js");

	#	Form Validation
	#echo $this->Html->script("../assets/vendor/libs/40form-validation/umd/bundle/popular.min.js");
	#echo $this->Html->script("../assets/vendor/libs/40form-validation/umd/plugin-bootstrap5/index.min.js");
	#echo $this->Html->script("../assets/vendor/libs/40form-validation/umd/plugin-auto-focus/index.min.js");
	echo $this->Html->script("../assets/vendor/libs/@form-validation/umd/bundle/popular.min.js");
	#echo $this->Html->script("../assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js");
	#echo $this->Html->script("../assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js");


	#	FLATPICKER
	echo $this->Html->script("../assets/vendor/libs/moment/moment.js");
	echo $this->Html->script("../assets/vendor/libs/flatpickr/flatpickr.js");

	echo $this->Html->script("../assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js");
	echo $this->Html->script("../assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js");
	echo $this->Html->script("../assets/vendor/libs/jquery-timepicker/jquery-timepicker.js");
	echo $this->Html->script("../assets/vendor/libs/pickr/pickr.js");

	#************************************************************************
	#<!-- Main JS -->
	echo $this->Html->script("../assets/js/main.js");
	#*/


	#***********************************************************************
	# JS TEEVIEW
	#<!-- Vendor -->
	echo $this->Html->script("../assets/vendor/libs/jstree/jstree.js");
	#<!-- Page JS -->
	echo $this->Html->script("../assets/js/extended-ui-treeview.js");

	#EDITORS
	#echo $this->Html->script("../assets/js/forms-editors.js");
	#echo $this->Html->script("../assets/vendor/libs/quill/katex.js");
	#echo $this->Html->script("../assets/vendor/libs/quill/quill.js");
	#*/

	#	NOSE
	echo $this->Html->script("../assets/js/dashboards-crm.js");
	echo $this->Html->script("../assets/js/dashboards-analytics.js");
	echo $this->Html->script("../assets/js/ui-modals.js");
	echo $this->Html->script("../assets/js/extended-ui-drag-and-drop.js");
	echo $this->Html->script("../assets/js/forms-pickers.js");

	#	DATA TABLES
	#echo $this->Html->script("../assets/js/tables-datatables-basic.js");
	#*/

	#	CARD ACTIONS
	echo $this->Html->script("../assets/js/cards-actions.js");
	#*/

	#************************************************************************
	echo $this->fetch('script');
	?>
</body>

</html>
