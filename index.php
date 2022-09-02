<!DOCTYPE html>
<html lang="en">
   <?php
include "configuration/config_include.php";
include "configuration/config_all_stat.php";
?>

<head>
        <meta charset="utf-8" />
        <title>Dashboard |Smart Payment Yayasan Al-Manshuriyah Kembangan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Aplikasi Kelola Keuangan Yayasan Bunayya" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
          <!-- Plugin css -->
         <link href="assets/libs/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />

<?php

head();
timing();
session();
connect();

//Setting Halaman

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//include "configuration/config_chmod.php";
$halaman = "kosong"; // halaman
$dataapa = "kosong"; // data
$tabeldatabase = "kosong"; // tabel database
//$chmod = $chmenu6; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
$sql = "SELECT id, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>



<?php

if (!login_check()) {
?>
<meta http-equiv="refresh" content="0; url=logout" />
<?php
exit(0);
}
?>

<?php
body();
theader();
menu();

?>


            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                           
                                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                           
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">

                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <div class="media">
                                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                            <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                                        </div>

                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Siswa</p>
                                            <h3 class="font-weight-medium my-2"> <span data-plugin="counterup"><?php echo $a1;?></span></h3>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                            <i class="mdi mdi-cash avatar-title font-30 text-white"></i>
                                        </div>

                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Pendapatan hari ini</p>
                                            <h3 class="font-weight-medium my-2"> <span data-plugin="counterup"><?php echo number_format($a3['income']);?></span></h3>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                            <i class="mdi mdi-cash avatar-title font-30 text-white"></i>
                                        </div>

                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Pengeluaran hari ini</p>
                                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup"><?php echo number_format($a2['expense']);?></span></h3>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                            <i class="mdi mdi-auto-fix  avatar-title font-30 text-white"></i>
                                        </div>

                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Tunggakan Bulanan</p>
                                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup"><?php echo number_format($a4['outstanding']);?></span></h3>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                        <!-- end row -->    




<!--KALENDER ACARA-->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-lg btn-primary btn-block waves-effect mt-2 waves-light">
                                                <i class="fa fa-plus"></i> Tambah Kategori
                                            </a>
                                            <div id="external-events" class="mt-3">
                                                <br>
                                                <p class="text-muted">Gunakan Fitur Kalender dan Warna Kategori untuk mengatur jadwal kerja anda</p>
                                <?php $sqla=mysqli_query($conn,"SELECT * FROM event_colors ORDER BY no desc LIMIT 10");
                                        while($r=mysqli_fetch_assoc($sqla)){
                                         echo   '     <div>                                               
                                                    <a class="btn btn-xs btn-block waves-effect mt-2 waves-light" href="#modalwarna" data-toggle="modal" data-kat-name="'.$r['warna'].'" data-kat-color="'.$r['kodewarna'].'" data-kat-id="'.$r['no'].'"
                                                    style="background-color:'.$r['kodewarna'].';">'.$r['warna'].'</a>
                                                </div>';
                                               } ?>
                                                 
                                            </div>

                                            <!-- checkbox -->
                                          
                                        </div> <!-- end col-->
                                        <div class="col-lg-9">
                                            <div id="calendar"></div>
                                        </div> <!-- end col -->
                                    </div>  <!-- end row -->
                                </div>

                                
                                <!-- Modal Add Category warna -->
                                <div class="modal fade none-border" id="add-category" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Tambah Kategori Kegiatan</h4>
                                            </div>
                                            <div class="modal-body pb-0">
                                                <form class="form" method="post" action="index_warna.php">
                                                    <div class="form-group">
                                                        <label class="control-label">Nama Kategori</label>
                                                        <input class="form-control form-white" placeholder="Enter name" type="text" name="kategori" autocomplete="off"/>
                                                    </div>

                                                      <div class="form-group">
                                                        <label class="control-label">Kode Warna HTML</label>
                                                        <input class="form-control form-white" placeholder="Contoh: #64C5B1" type="text" name="kodewarna" autocomplete="off" />
                                                       
                                                    </div>

                                                     <div class="form-group">
                                                        <code>*Kode Warna HTML bisa anda cek dari halaman <a href="tabel_warna" target="_blank">berikut</a></code>
                                                     </div>
                                                   

                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                <button type="submit" name="save" class="btn btn-danger waves-effect waves-light save-category" >Save</button>
                                            </div>
                                             </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- MODAL Add Event -->

                                <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form class="form-horizontal" method="POST" action="index_event_add.php">
            
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Kegiatan</h4>
              </div>
              <div class="modal-body">
                
                 

                   <div class="row">
                            <div class="col-md-12">
                    <div class="form-group">
                    <label for="field-3" class="control-label">Nama Kegiatan</label>
                     <input type="text" name="title" class="form-control" id="title" placeholder="Nama Kegiatan/Acara" required autocomplete="off">
                                                 
                           </div>
                                </div>
                    </div>

                      <div class="row">
                            <div class="col-md-12">
                    <div class="form-group">
                    <label for="field-3" class="control-label">Kategori</label>
                     <select name="color" class="form-control" id="color">
                           <?php
        $sql=mysqli_query($conn,"select * from event_colors order by no desc");
        while ($row=mysqli_fetch_assoc($sql)){
          echo '<option style="color:'.$row['kodewarna'].';" value="'.$row['kodewarna'].'">&#9724; '.$row['warna'].'</option>';
        }
      ?>
                          
                        </select>
                                                 
                           </div>
                                </div>
                    </div>

                      <div class="row">
                            <div class="col-md-12">
                    <div class="form-group">
                    <label for="field-3" class="control-label">Mulai (FORMAT: <b>Tahun-Bulan-Tanggal Jam:Menit:Detik</b>)</label>
                     <input type="text" name="start" class="form-control" id="start" >
                                                 
                           </div>
                                </div>
                    </div>

                      <div class="row">
                            <div class="col-md-12">
                    <div class="form-group">
                    <label for="field-3" class="control-label">Selesai</label>
                   <input type="text" name="end" class="form-control" id="end">
                                                 
                           </div>
                                </div>
                    </div>
                
                 
                 
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
            </div>
          </div>
        </div>


        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form class="form-horizontal" method="POST" action="index_event_title.php">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
              </div>
              <div class="modal-body">
                
                
                   <div class="form-group row">
                        <label for="inputPassword4" class="col-3 col-form-label">Nama Kegiatan</label>
                          <div class="col-9">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Nama Kegiatan">
                           </div>
                    </div>
                   
                      <div class="form-group row">
                                                <label for="inputPassword4" class="col-3 col-form-label">Kategori warna</label>
                                                <div class="col-9">
                                                   <select name="color" class="form-control" id="color">
                       
                           <?php
        $sql=mysqli_query($conn,"select * from event_colors order by no desc");
        while ($row=mysqli_fetch_assoc($sql)){
          echo '<option style="color:'.$row['kodewarna'].';" value="'.$row['kodewarna'].'">&#9724; '.$row['warna'].'</option>';
        }
      ?>
                          
                        </select>


                                                </div>
                                            </div>

                                              <div class="form-group row">
                                                <div class="offset-3 col-9">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="checkbox2" type="checkbox" name="delete">
                                                        <label for="checkbox2">
                                                            Hapus Kegiatan ini
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                  
                  <input type="hidden" name="id" class="form-control" id="id">
                
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
            </div>
          </div>
        </div>
                                <!--modal new-->







                            </div>
                            <!-- end col-12 -->
                        </div> <!-- end row -->




<?php $sql=mysqli_query($conn,"SELECT * FROM info");
        $a=mysqli_fetch_assoc($sql);
        $usr=$a['userid'];


        $w=mysqli_fetch_assoc(mysqli_query($conn,"SELECT avatar FROM user WHERE no='$usr'"));



        ?>
                        <div class="row">
                            <div class="col-lg-12">


                                                              
                                 <div class="card">
                                    <div class="card-body">
                                        <div class="card-widgets">
                                             <img src="<?php echo $w['avatar'];?>" alt="" height="50" class="rounded-circle avatar-sm">
                                           
                                        </div>
                                        <h5 class="card-title mb-0"><?php echo $a['nama'];?> pada <?php echo $a['tanggal'];?></h5>

                                        <div id="cardCollpase1" class="collapse pt-3 show">
                                             <?php echo $a['isi'];?>
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                               


           
                            </div>
                            <!-- end col-12 -->
                        </div> <!-- end row -->

                          
                        </div>
                        <!--- end row -->
                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->

                

               <!--FOOTER-->
                
<?php footer();?>

<!-- END FOOTER-->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <div class="modal fade" id="modalwarna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
           
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Kategori</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" method="post" action="index_warna.php">
                
                   <div class="form-group row">
                        <label for="inputPassword4" class="col-3 col-form-label">Kategori</label>
                          <div class="col-9">
                            <input type="text" class="form-control" name="kat">
                           </div>
                    </div>

                      <div class="form-group row">
                        <label for="inputPassword4" class="col-3 col-form-label">Kode Warna HTML</label>
                          <div class="col-9">
                             <input type="text" class="form-control" name="katcolor">
                           </div>
                    </div>
                   
                    

                                              <div class="form-group row">
                                                <div class="offset-3 col-9">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="checkbox3" type="checkbox" name="hapus">
                                                        <label for="checkbox3">
                                                            Hapus Kategori ini
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                  
                  <input type="hidden" name="katid" class="form-control" >
                
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" name="kasave" class="btn btn-primary">Simpan</button>
              </div>
            </form>
            </div>
          </div>
        </div>


<!-- Sidebar Kanan -->
<?php

right();

?>

<!-- End Sidebar Kanan -->


        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!--C3 Chart-->
        <script src="assets/libs/d3/d3.min.js"></script>
        <script src="assets/libs/c3/c3.min.js"></script>

        <script src="assets/libs/echarts/echarts.min.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

         <script src="assets/libs/moment/moment.min.js"></script>
        <script src="assets/libs/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/libs/fullcalendar/fullcalendar.min.js"></script>
      

        <!-- Calendar init -->
       

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>




<script>

    $(document).ready(function() {
        
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                
                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
            },
            eventRender: function(event, element) {
                element.bind('dblclick', function() {
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #color').val(event.color);
                    $('#ModalEdit').modal('show');
                });
            },
            eventDrop: function(event, delta, revertFunc) { // si changement de position

                edit(event);

            },
            eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                edit(event);

            },
            events: [
            <?php foreach($events as $event): 
            
                $start = explode(" ", $event['start']);
                $end = explode(" ", $event['end']);
                if($start[1] == '00:00:00'){
                    $start = $start[0];
                }else{
                    $start = $event['start'];
                }
                if($end[1] == '00:00:00'){
                    $end = $end[0];
                }else{
                    $end = $event['end'];
                }
            ?>
                {
                    id: '<?php echo $event['id']; ?>',
                    title: '<?php echo $event['title']; ?>',
                    start: '<?php echo $start; ?>',
                    end: '<?php echo $end; ?>',
                    color: '<?php echo $event['color']; ?>',
                },
            <?php endforeach; ?>
            ]
        });
        
        function edit(event){
            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }
            
            id =  event.id;
            
            Event = [];
            Event[0] = id;
            Event[1] = start;
            Event[2] = end;
            
            $.ajax({
             url: 'editEventDate.php',
             type: "POST",
             data: {Event:Event},
             success: function(rep) {
                    if(rep == 'OK'){
                        alert('Saved');
                    }else{
                        alert('Could not be saved. try again.'); 
                    }
                }
            });
        }
        
    });

</script>



<script>
    $('#modalwarna').on('show.bs.modal', function(e) {
    var kat = $(e.relatedTarget).data('kat-name');
     var katcolor = $(e.relatedTarget).data('kat-color');
      var katid = $(e.relatedTarget).data('kat-id');
    $(e.currentTarget).find('input[name="kat"]').val(kat);
     $(e.currentTarget).find('input[name="katcolor"]').val(katcolor);
      $(e.currentTarget).find('input[name="katid"]').val(katid);
});
</script>
        
    </body>
</html>