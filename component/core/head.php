 <?php
  error_reporting(E_ALL);
  include 'configuration/config_connect.php';
  $queryback = "SELECT * FROM backset";
  $resultback = mysqli_query($conn, $queryback);
  $rowback = mysqli_fetch_assoc($resultback);
  $themes = $rowback['themesback'];
  if ($themes == '2') { ?>
   <!--DARK-->
   <link href="assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
   <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

 <?php } else { ?>
   <!-- App css -->
   <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
   <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

 <?php } ?>


 <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
 <link href="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
 <link href="assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
 <link href="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
 <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />

 <!-- Date Picker -->
 <link rel="stylesheet" href="assets/datepicker/datepicker3.css">
 <!-- Daterange picker -->
 <link rel="stylesheet" href="assets/daterangepicker/daterangepicker.css">

 <!-- Footable css -->
 <link href="assets/libs/footable/footable.core.min.css" rel="stylesheet" type="text/css" />


 <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


 <!-- third party css -->
 <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
 <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
 <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
 <style>
   .card-header {
     padding: 0.1rem 0.9rem !important;
   }
 </style>



 </head>