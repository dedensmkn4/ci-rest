<!DOCTYPE html>
<html lang="en">

<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>OTA Xperience</title>

  <!-- Custom fonts for this theme -->
  <link href="<?php echo base_url('resources/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="<?php echo base_url('resources/css/freelancer.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('resources/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet">

</head>

<body id="page-top">
 <?php $this->load->view("header_layout"); ?>
 <?php $this->load->view($view); ?>
 <?php $this->load->view("footer_layout"); ?>
</body>
</html>