 
<?php
error_reporting(0);
include 'configuration/config_connect.php';
        $queryback="SELECT * FROM backset";
        $resultback=mysqli_query($conn,$queryback);
        $rowback=mysqli_fetch_assoc($resultback);
        $themes=$rowback['themesback'];
if($themes == '2'){?>
<!--DARK-->
    <link href="assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
         <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

<?php } else {?>
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
         <link href="assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

 <?php } ?> 


        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
      
         
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
     


    </head>
