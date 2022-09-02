<?php
 error_reporting(0);
include 'configuration/config_connect.php';
        $queryback="SELECT * FROM backset";
        $resultback=mysqli_query($conn,$queryback);
        $rowback=mysqli_fetch_assoc($resultback);
        $footer=$rowback['footer'];

                        
                
 ?>
                <!-- Footer -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                              2021 &copy; <?php echo $footer;?> Powered By <a href="https://trijayasolution.co.id/">    Trijaya Solution </a>, All Right Reserved.
                            </div>
                          
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->