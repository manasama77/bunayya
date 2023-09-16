<!DOCTYPE html>
<html lang="en">
<?php
include "configuration/config_include.php";
include "configuration/config_all_stat.php";
?>

<head>
    <meta charset="utf-8" />
    <title>Dashboard |<?php echo $app; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Plugin css -->
    <link href="../assets/libs/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />

    <?php

    head();
    timing();
    session();
    connect();

    //Setting Halaman

    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    //include "configuration/config_chmod.php";
    $halaman = "index"; // halaman
    $dataapa = "kosong"; // data
    $tabeldatabase = "kosong"; // tabel database
    //$chmod = $chmenu6; // Hak akses Menu
    $forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
    $forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman

    $id = $_SESSION['id'];
    $e = mysqli_fetch_assoc(mysqli_query($conn, "SELECT status FROM student WHERE student_id='$id'"));

    //End Setting Halaman

    $sql = "SELECT id, title, start, end, color FROM events ";

    $req = $bdd->prepare($sql);
    $req->execute();

    $events = $req->fetchAll();

    ?>



    <?php
    body();
    theader();
    menu();

    ?>


    <?php

    $a1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bulanan_bill) as monthlybill FROM bulanan WHERE student_id='$id'"));

    $a2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bill) as bill FROM bebasan WHERE student_id='$id'"));

    $a12 = $a1['monthlybill'] + $a2['bill'];


    $a3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bulanan_bayar) as paidbill FROM bulanan WHERE student_id='$id'"));

    $a4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(sudahbayar) as paid FROM bebasan WHERE student_id='$id'"));

    $a34 = $a3['paidbill'] + $a4['paid'];

    $a5 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bulanan_bill) as due FROM bulanan WHERE period_id='$t' AND bulanan_status LIKE '%belum%' AND student_id='$id' AND month_id<='$mon'"));
    $a6 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bill) as unpaid FROM bebasan WHERE student_id='$id' AND status='belum'"));

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

                <?php if ($e['status'] == 'inactive') { ?>
                    <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>Akunmu Sudah dinonaktifkan!</strong> Segera hubungi Pihak Sekolah apabila ingin mengaktifkan kembali
                    </div>
                <?php } ?>

                <div class="row">

                    <div class="col-xl-3 col-sm-6">
                        <div class="card-box widget-box-two widget-two-custom">
                            <div class="media">
                                <div class="avatar-lg rounded-circle bg-warning widget-two-icon align-self-center">
                                    <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                                </div>

                                <div class="wigdet-two-content media-body">
                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Estimasi Total Tagihan</p>
                                    <h3 class="font-weight-medium my-2"> <span data-plugin="counterup"><?php echo number_format($a12); ?></span></h3>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-sm-6">
                        <div class="card-box widget-box-two widget-two-custom ">
                            <div class="media">
                                <div class="avatar-lg rounded-circle bg-success widget-two-icon align-self-center">
                                    <i class="mdi mdi-cash avatar-title font-30 text-white"></i>
                                </div>

                                <div class="wigdet-two-content media-body">
                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Sudah dibayar</p>
                                    <h3 class="font-weight-medium my-2"> <span data-plugin="counterup"><?php echo number_format($a34); ?></span></h3>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-sm-6">
                        <div class="card-box widget-box-two widget-two-custom ">
                            <div class="media">
                                <div class="avatar-lg rounded-circle bg-danger widget-two-icon align-self-center">
                                    <i class="mdi mdi-cash avatar-title font-30 text-white"></i>
                                </div>

                                <div class="wigdet-two-content media-body">
                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Tagihan Per <?php echo $moname; ?></p>
                                    <h3 class="font-weight-medium my-2"><span data-plugin="counterup"><?php echo number_format($a5['due']); ?></span></h3>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-sm-6">
                        <div class="card-box widget-box-two widget-two-custom ">
                            <div class="media">
                                <div class="avatar-lg rounded-circle bg-info widget-two-icon align-self-center">
                                    <i class="mdi mdi-auto-fix  avatar-title font-30 text-white"></i>
                                </div>

                                <div class="wigdet-two-content media-body">
                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Sisa Tagihan Lain</p>
                                    <h3 class="font-weight-medium my-2"><span data-plugin="counterup"><?php echo number_format($a6['unpaid']); ?></span></h3>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->




                <!--KALENDER ACARA-->


                <?php $sql = mysqli_query($conn, "SELECT * FROM info");
                $a = mysqli_fetch_assoc($sql);
                $usr = $a['userid'];


                $w = mysqli_fetch_assoc(mysqli_query($conn, "SELECT avatar FROM user WHERE no='$usr'"));


                $subject = $a['isi'];
                $search = 'student/';
                $trimmed = str_replace($search, '', $subject);


                ?>
                <div class="row">
                    <div class="col-lg-12">



                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <img src="../<?php echo $w['avatar']; ?>" alt="" height="50" class="rounded-circle avatar-sm">

                                </div>
                                <h5 class="card-title mb-0"><?php echo $a['nama']; ?> pada <?php echo $a['tanggal']; ?></h5>

                                <div id="cardCollpase1" class="collapse pt-3 show">
                                    <?php echo $trimmed; ?>
                                </div>
                            </div>
                        </div> <!-- end card-->




                    </div>
                    <!-- end col-12 -->
                </div> <!-- end row -->


                <div class="row">
                    <div class="col-lg-12">

                        <div class="card-box">



                            <div id="calendar"></div>

                        </div>




                        <!--modal view-->

                        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form class="form-horizontal" method="POST" action="index_event_title.php">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Kegiatan</h4>
                                        </div>
                                        <div class="modal-body">



                                            <div class="form-group row">
                                                <label for="inputPassword4" class="col-3 col-form-label">Informasi</label>
                                                <div class="col-9">
                                                    <textarea class="form-control" id="title" readonly></textarea>
                                                </div>
                                            </div>




                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <!--modal new-->







                    </div>
                    <!-- end col-12 -->
                </div> <!-- end row -->





            </div>
            <!--- end row -->

        </div> <!-- end container-fluid -->

    </div> <!-- end content -->



    <!--FOOTER-->

    <?php footer(); ?>

    <!-- END FOOTER-->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Sidebar Kanan -->


    <!-- End Sidebar Kanan -->


    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!--C3 Chart-->
    <script src="../assets/libs/d3/d3.min.js"></script>
    <script src="../assets/libs/c3/c3.min.js"></script>

    <script src="../assets/libs/echarts/echarts.min.js"></script>

    <script src="../assets/js/pages/dashboard.init.js"></script>

    <script src="../assets/libs/moment/moment.min.js"></script>
    <script src="../assets/libs/jquery-ui/jquery-ui.min.js"></script>
    <script src="../assets/libs/fullcalendar/fullcalendar.min.js"></script>


    <!-- Calendar init -->


    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>



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
                eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

                    edit(event);

                },
                events: [
                    <?php foreach ($events as $event) :

                        $start = explode(" ", $event['start']);
                        $end = explode(" ", $event['end']);
                        if ($start[1] == '00:00:00') {
                            $start = $start[0];
                        } else {
                            $start = $event['start'];
                        }
                        if ($end[1] == '00:00:00') {
                            $end = $end[0];
                        } else {
                            $end = $event['end'];
                        }
                    ?> {
                            id: '<?php echo $event['id']; ?>',
                            title: '<?php echo $event['title']; ?>',
                            start: '<?php echo $start; ?>',
                            end: '<?php echo $end; ?>',
                            color: '<?php echo $event['color']; ?>',
                        },
                    <?php endforeach; ?>
                ]
            });



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