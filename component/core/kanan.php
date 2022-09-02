 <?php 

 include 'configuration/config_connect.php';
 $queryback="SELECT * FROM backset";
        $resultback=mysqli_query($conn,$queryback);
        $rowback=mysqli_fetch_assoc($resultback);
        $themes=$rowback['themesback'];

        if($themes=='2'){
            $act="";
            $act2="checked";
        } else {
            $act2="";
            $act="checked";
        }

 ?>

 <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h4 class="font-16 m-0 text-white">Tampilan Aplikasi</h4>
            </div>
            <div class="slimscroll-menu">
        
                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Berpindah </strong> dari mode terang ke tema gelap
                    </div>
                    <div class="mb-2">
                        <img src="assets/images/layouts/light.png" class="img-fluid img-thumbnail" alt="">
                    </div>

                    <form method="post">
                    <div class="custom-control custom-switch mb-3">
                        
                        <?php      if($themes !='1'){ ?>
                       
                        <input type="hidden" value="1" name="mode">
                          <button type="submit" class="btn btn-primary btn-xs">Pilih </button>
                      <?php } ?>
                    </div>
                </form>

            
                    <div class="mb-2">
                        <img src="assets/images/layouts/dark.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                             <form method="post">
                      
                             <input type="hidden" value="2" name="mode">
                       <?php      if($themes !='2'){ ?>
                               <button type="submit" class="btn btn-primary btn-xs">Pilih </button>
                           <?php } ?>
                         </form>
                      
                    </div>
            
                    

                   
                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn d-print-none">
            <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Beralih Mode
        </a>

        <?php 


if(isset($_POST['mode'])){
 error_reporting(E_ALL ^ E_DEPRECATED);
 $mode=$_POST['mode'];
    $sql="UPDATE backset SET themesback='$mode'";
    mysqli_query($conn,$sql);
    echo "<script type='text/javascript'>window.location = 'index';</script>";
}



        ?>