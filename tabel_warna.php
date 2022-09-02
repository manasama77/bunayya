<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Pelanggan |<?php echo $app;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Aplikasi Kelola Sales dan Keuangan" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
<?php
connect();
head();timing();
session();
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
etc();


//Setting Halaman

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "configuration/config_chmod.php";

$halaman = "kosong"; // halaman
$dataapa = "kosong"; // data
$tabeldatabase = "kosong"; // tabel database
$chmod = 5; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->




<!-- END Letak Kode PHP atas -->





  <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->


            <div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- halaman dan breadcrumbs -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index">DashBoard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaturan</a></li>
                                            <li class="breadcrumb-item active"><?php echo $dataapa;?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $dataapa;?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end halaman dan breadcrumbs --> 


<!-- ISI HALAMAN -->


                        	 <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title">Tabel Kode Warna HTML</h4>
                                    <p class="sub-header">
                                       Kode Warna HTML berikut tidak lengkap, anda bisa menemukan kode warna lainnya di internet
                                    </p>

                                   <div class="table-responsive">
<table class="table-bordered table-padding" width="100%"><thead><tr><th width="100px"></th>
<th>Nama Warna</th>
<th>Kode Warna HTML</th>
<th>Kode dalam RGB</th>
</tr></thead><tbody><tr><td>
<div style="background: #f0f8ff; text-align: center;">.</div>
</td>
<td>Alice Blue</td>
<td>#F0F8FF</td>
<td>rgb(240, 248, 254)</td>
</tr><tr><td>
<div style="background: #faebd7; text-align: center;">.</div>
</td>
<td>Antique White</td>
<td>#FAEBD7</td>
<td>rgb(251, 235, 217)</td>
</tr><tr><td>
<div style="background: #00ffff; text-align: center;">.</div>
</td>
<td>Aqua</td>
<td>#00FFFF</td>
<td>rgb(0, 255, 254)</td>
</tr><tr><td>
<div style="background: #7fffd4; text-align: center;">.</div>
</td>
<td>Aquamarine</td>
<td>#7FFFD4</td>
<td>rgb(115, 255, 216)</td>
</tr><tr><td>
<div style="background: #f0ffff; text-align: center;">.</div>
</td>
<td>Azure</td>
<td>#F0FFFF</td>
<td>rgb(239, 255, 255)</td>
</tr><tr><td>
<div style="background: #f5f5dc; text-align: center;">.</div>
</td>
<td>Beige</td>
<td>#F5F5DC</td>
<td>rgb(245, 245, 223)</td>
</tr><tr><td>
<div style="background: #ffe4c4; text-align: center;">.</div>
</td>
<td>Bisque</td>
<td>#FFE4C4</td>
<td>rgb(255, 227, 200)</td>
</tr><tr><td>
<div style="background: #000000; text-align: center;">.</div>
</td>
<td>Black</td>
<td>#000000</td>
<td>rgb(0, 0, 0)</td>
</tr><tr><td>
<div style="background: #ffebcd; text-align: center;">.</div>
</td>
<td>Blanched Almond</td>
<td>#FFEBCD</td>
<td>rgb(255, 234, 208)</td>
</tr><tr><td>
<div style="background: #0000ff; text-align: center;">.</div>
</td>
<td>Blue</td>
<td>#0000FF</td>
<td>rgb(0, 0, 255)</td>
</tr><tr><td>
<div style="background: #8a2be2; text-align: center;">.</div>
</td>
<td>Blue Violet</td>
<td>#8A2BE2</td>
<td>rgb(138, 43, 226)</td>
</tr><tr><td>
<div style="background: #a52a2a; text-align: center;">.</div>
</td>
<td>Brown</td>
<td>#A52A2A</td>
<td>rgb(165, 42, 42)</td>
</tr><tr><td>
<div style="background: #deb887; text-align: center;">.</div>
</td>
<td>Burly Wood</td>
<td>#DEB887</td>
<td>rgb(222, 184, 135)</td>
</tr><tr><td>
<div style="background: #5f9ea0; text-align: center;">.</div>
</td>
<td>Cadet Blue</td>
<td>#5F9EA0</td>
<td>rgb(95, 158, 160)</td>
</tr><tr><td>
<div style="background: #7fff00; text-align: center;">.</div>
</td>
<td>Chartreuse</td>
<td>#7FFF00</td>
<td>rgb(127, 255, 1)</td>
</tr><tr><td>
<div style="background: #d2691e; text-align: center;">.</div>
</td>
<td>Chocolate</td>
<td>#D2691E</td>
<td>rgb(210, 105, 30)</td>
</tr><tr><td>
<div style="background: #ff7f50; text-align: center;">.</div>
</td>
<td>Coral</td>
<td>#FF7F50</td>
<td>rgb(251, 127, 80)</td>
</tr><tr><td>
<div style="background: #6495ed; text-align: center;">.</div>
</td>
<td>Cornflower Blue</td>
<td>#6495ED</td>
<td>rgb(100, 149, 237)</td>
</tr><tr><td>
<div style="background: #fff8dc; text-align: center;">.</div>
</td>
<td>Cornsilk</td>
<td>#FFF8DC</td>
<td>rgb(225, 248, 220)</td>
</tr><tr><td>
<div style="background: #dc143c; text-align: center;">.</div>
</td>
<td>Crimson</td>
<td>#DC143C</td>
<td>rgb(220, 20, 60)</td>
</tr><tr><td>
<div style="background: #00ffff; text-align: center;">.</div>
</td>
<td>Cyan</td>
<td>#00FFFF</td>
<td>rgb(62, 254, 255)</td>
</tr><tr><td>
<div style="background: #00008b; text-align: center;">.</div>
</td>
<td>Dark Blue</td>
<td>#00008B</td>
<td>rgb(0, 0, 139)</td>
</tr><tr><td>
<div style="background: #008b8b; text-align: center;">.</div>
</td>
<td>Dark Cyan</td>
<td>#008B8B</td>
<td>rgb(29, 139, 139)</td>
</tr><tr><td>
<div style="background: #b8860b; text-align: center;">.</div>
</td>
<td>Dark Golden Rod</td>
<td>#B8860B</td>
<td>rgb(184, 134, 11)</td>
</tr><tr><td>
<div style="background: #a9a9a9; text-align: center;">.</div>
</td>
<td>Dark Gray</td>
<td>#A9A9A9</td>
<td>rgb(169, 169, 169)</td>
</tr><tr><td>
<div style="background: #006400; text-align: center;">.</div>
</td>
<td>Dark Green</td>
<td>#006400</td>
<td>rgb(19, 100, 0)</td>
</tr><tr><td>
<div style="background: #bdb76b; text-align: center;">.</div>
</td>
<td>Dark Khaki</td>
<td>#BDB76B</td>
<td>rgb(189, 183, 107)</td>
</tr><tr><td>
<div style="background: #8b008b; text-align: center;">.</div>
</td>
<td>Dark Magenta</td>
<td>#8B008B</td>
<td>rgb(139, 0, 140)</td>
</tr><tr><td>
<div style="background: #556b2f; text-align: center;">.</div>
</td>
<td>Dark Olive Green</td>
<td>#556B2F</td>
<td>rgb(85, 107, 47)</td>
</tr><tr><td>
<div style="background: #ff8c00; text-align: center;">.</div>
</td>
<td>Dark Orange</td>
<td>#FF8C00</td>
<td>rgb(251, 140, 1)</td>
</tr><tr><td>
<div style="background: #9932cc; text-align: center;">.</div>
</td>
<td>Dark Orchid</td>
<td>#9932CC</td>
<td>rgb(153, 50, 204)</td>
</tr><tr><td>
<div style="background: #8b0000; text-align: center;">.</div>
</td>
<td>Dark Red</td>
<td>#8B0000</td>
<td>rgb(139, 5, 0)</td>
</tr><tr><td>
<div style="background: #e9967a; text-align: center;">.</div>
</td>
<td>Dark Salmon</td>
<td>#E9967A</td>
<td>rgb(233, 150, 122)</td>
</tr><tr><td>
<div style="background: #8fbc8f; text-align: center;">.</div>
</td>
<td>Dark Sea Green</td>
<td>#8FBC8F</td>
<td>rgb(143, 188, 144)</td>
</tr><tr><td>
<div style="background: #483d8b; text-align: center;">.</div>
</td>
<td>Dark Slate Blue</td>
<td>#483D8B</td>
<td>rgb(72, 61, 139)</td>
</tr><tr><td>
<div style="background: #2f4f4f; text-align: center;">.</div>
</td>
<td>Dark Slate Gray</td>
<td>#2F4F4F</td>
<td>rgb(47, 79, 79)</td>
</tr><tr><td>
<div style="background: #00CED1; text-align: center;">.</div>
</td>
<td>Dark Turquoise</td>
<td>#00CED1</td>
<td>rgb(48, 206, 209)</td>
</tr><tr><td>
<div style="background: #9400D3; text-align: center;">.</div>
</td>
<td>Dark Violet</td>
<td>#9400D3</td>
<td>rgb(148, 0, 211)</td>
</tr><tr><td>
<div style="background: #FF1493; text-align: center;">.</div>
</td>
<td>Deep Pink</td>
<td>#FF1493</td>
<td>rgb(249, 19, 147)</td>
</tr><tr><td>
<div style="background: #00BFFF; text-align: center;">.</div>
</td>
<td>Deep Sky Blue</td>
<td>#00BFFF</td>
<td>rgb(43, 191, 254)</td>
</tr><tr><td>
<div style="background: #696969; text-align: center;">.</div>
</td>
<td>Dim Gray</td>
<td>#696969</td>
<td>rgb(105, 105, 105)</td>
</tr><tr><td>
<div style="background: #1e90ff; text-align: center;">.</div>
</td>
<td>Dodger Blue</td>
<td>#1E90FF</td>
<td>rgb(30, 144, 255)</td>
</tr><tr><td>
<div style="background: #b22222; text-align: center;">.</div>
</td>
<td>Fire Brick</td>
<td>#B22222</td>
<td>rgb(178, 34, 33)</td>
</tr><tr><td>
<div style="background: #fffaf0; text-align: center;">.</div>
</td>
<td>Floral White</td>
<td>#FFFAF0</td>
<td>rgb(255, 250, 240)</td>
</tr><tr><td>
<div style="background: #228b22; text-align: center;">.</div>
</td>
<td>Forest Green</td>
<td>#228B22</td>
<td>rgb(34, 139, 35)</td>
</tr><tr><td>
<div style="background: #ff00ff; text-align: center;">.</div>
</td>
<td>Fuchsia</td>
<td>#FF00FF</td>
<td>rgb(249, 0, 255)</td>
</tr><tr><td>
<div style="background: #dcdcdc; text-align: center;">.</div>
</td>
<td>Gainsboro</td>
<td>#DCDCDC</td>
<td>rgb(220, 220, 220)</td>
</tr><tr><td>
<div style="background: #f8f8ff; text-align: center;">.</div>
</td>
<td>Ghost White</td>
<td>#F8F8FF</td>
<td>rgb(248, 248, 255)</td>
</tr><tr><td>
<div style="background: #ffd700; text-align: center;">.</div>
</td>
<td>Gold</td>
<td>#FFD700</td>
<td>rgb(253, 215, 3)</td>
</tr><tr><td>
<div style="background: #daa520; text-align: center;">.</div>
</td>
<td>Golden Rod</td>
<td>#DAA520</td>
<td>rgb(218, 165, 32)</td>
</tr><tr><td>
<div style="background: #808080; text-align: center;">.</div>
</td>
<td>Gray</td>
<td>#808080</td>
<td>rgb(128, 128, 128)</td>
</tr><tr><td>
<div style="background: #008000; text-align: center;">.</div>
</td>
<td>Green</td>
<td>#008000</td>
<td>rgb(27, 128, 1)</td>
</tr><tr><td>
<div style="background: #adff2f; text-align: center;">.</div>
</td>
<td>Green Yellow</td>
<td>#ADFF2F</td>
<td>rgb(173, 255, 48)</td>
</tr><tr><td>
<div style="background: #f0fff0; text-align: center;">.</div>
</td>
<td>Honey Dew</td>
<td>#F0FFF0</td>
<td>rgb(240, 255, 240)</td>
</tr><tr><td>
<div style="background: #ff69b4; text-align: center;">.</div>
</td>
<td>Hot Pink</td>
<td>#FF69B4</td>
<td>rgb(240, 255, 240)</td>
</tr><tr><td>
<div style="background: #cd5c5c; text-align: center;">.</div>
</td>
<td>Indian Red</td>
<td>#CD5C5C</td>
<td>rgb(205, 92, 92)</td>
</tr><tr><td>
<div style="background: #4b0082; text-align: center;">.</div>
</td>
<td>Indigo</td>
<td>#4B0082</td>
<td>rgb(75, 0, 130)</td>
</tr><tr><td>
<div style="background: #fffff0; text-align: center;">.</div>
</td>
<td>Ivory</td>
<td>#FFFFF0</td>
<td>rgb(255, 255, 239)</td>
</tr><tr><td>
<div style="background: #f0e68c; text-align: center;">.</div>
</td>
<td>Khaki</td>
<td>#F0E68C</td>
<td>rgb(240, 230, 140)</td>
</tr><tr><td>
<div style="background: #e6e6fa; text-align: center;">.</div>
</td>
<td>Lavender</td>
<td>#E6E6FA</td>
<td>rgb(230, 230, 250)</td>
</tr><tr><td>
<div style="background: #fff0f5; text-align: center;">.</div>
</td>
<td>Lavender Blush</td>
<td>#FFF0F5</td>
<td>rgb(254, 240, 245)</td>
</tr><tr><td>
<div style="background: #7cfc00; text-align: center;">.</div>
</td>
<td>Lawn Green</td>
<td>#7CFC00</td>
<td>rgb(124, 252, 2)</td>
</tr><tr><td>
<div style="background: #fffacd; text-align: center;">.</div>
</td>
<td>Lemon Chiffon</td>
<td>#FFFACD</td>
<td>rgb(255, 250, 205)</td>
</tr><tr><td>
<div style="background: #add8e6; text-align: center;">.</div>
</td>
<td>Light Blue</td>
<td>#ADD8E6</td>
<td>rgb(173, 216, 230)</td>
</tr><tr><td>
<div style="background: #f08080; text-align: center;">.</div>
</td>
<td>Light Coral</td>
<td>#F08080</td>
<td>rgb(240, 128, 128)</td>
</tr><tr><td>
<div style="background: #e0ffff; text-align: center;">.</div>
</td>
<td>Light Cyan</td>
<td>#E0FFFF</td>
<td>rgb(224, 255, 255)</td>
</tr><tr><td>
<div style="background: #fafad2; text-align: center;">.</div>
</td>
<td>Light Golden Rod Yellow</td>
<td>#FAFAD2</td>
<td>rgb(250, 250, 210)</td>
</tr><tr><td>
<div style="background: #d3d3d3; text-align: center;">.</div>
</td>
<td>Light Gray</td>
<td>#D3D3D3</td>
<td>rgb(211, 211, 211)</td>
</tr><tr><td>
<div style="background: #90ee90; text-align: center;">.</div>
</td>
<td>Light Green</td>
<td>#90EE90</td>
<td>rgb(144, 238, 144)</td>
</tr><tr><td>
<div style="background: #ffb6c1; text-align: center;">.</div>
</td>
<td>Light Pink</td>
<td>#FFB6C1</td>
<td>rgb(252, 182, 193)</td>
</tr><tr><td>
<div style="background: #ffa07a; text-align: center;">.</div>
</td>
<td>Light Salmon</td>
<td>#FFA07A</td>
<td>rgb(251, 160, 122)</td>
</tr><tr><td>
<div style="background: #20b2aa; text-align: center;">.</div>
</td>
<td>Light Sea Green</td>
<td>#20B2AA</td>
<td>rgb(40, 178, 170)</td>
</tr><tr><td>
<div style="background: #87cefa; text-align: center;">.</div>
</td>
<td>Light Sky Blue</td>
<td>#87CEFA</td>
<td>rgb(135, 206, 250)</td>
</tr><tr><td>
<div style="background: #778899; text-align: center;">.</div>
</td>
<td>Light Slate Gray</td>
<td>#778899</td>
<td>rgb(119, 136, 153)</td>
</tr><tr><td>
<div style="background: #b0c4de; text-align: center;">.</div>
</td>
<td>Light Steel Blue</td>
<td>#B0C4DE</td>
<td>rgb(176, 196, 222)</td>
</tr><tr><td>
<div style="background: #ffffe0; text-align: center;">.</div>
</td>
<td>Light Yellow</td>
<td>#FFFFE0</td>
<td>rgb(255, 255, 224)</td>
</tr><tr><td>
<div style="background: #00ff00; text-align: center;">.</div>
</td>
<td>Lime</td>
<td>#00FF00</td>
<td>rgb(63, 255, 0)</td>
</tr><tr><td>
<div style="background: #32cd32; text-align: center;">.</div>
</td>
<td>Lime Green</td>
<td>#32CD32</td>
<td>rgb(50, 205, 50)</td>
</tr><tr><td>
<div style="background: #faf0e6; text-align: center;">.</div>
</td>
<td>Linen</td>
<td>#FAF0E6</td>
<td>rgb(250, 240, 230)</td>
</tr><tr><td>
<div style="background: #ff00ff; text-align: center;">.</div>
</td>
<td>Magenta</td>
<td>#FF00FF</td>
<td>rgb(249, 0, 255)</td>
</tr><tr><td>
<div style="background: #800000; text-align: center;">.</div>
</td>
<td>Maroon</td>
<td>#800000</td>
<td>rgb(128, 4, 0)</td>
</tr><tr><td>
<div style="background: #66cdaa; text-align: center;">.</div>
</td>
<td>Medium Aqua Marine</td>
<td>#66CDAA</td>
<td>rgb(102, 205, 170)</td>
</tr><tr><td>
<div style="background: #0000cd; text-align: center;">.</div>
</td>
<td>Medium Blue</td>
<td>#0000CD</td>
<td>rgb(0, 0, 205)</td>
</tr><tr><td>
<div style="background: #ba55d3; text-align: center;">.</div>
</td>
<td>Medium Orchid</td>
<td>#BA55D3</td>
<td>rgb(186, 85, 211)</td>
</tr><tr><td>
<div style="background: #9370db; text-align: center;">.</div>
</td>
<td>Medium Purple</td>
<td>#9370DB</td>
<td>rgb(147, 112, 219)</td>
</tr><tr><td>
<div style="background: #3cb371; text-align: center;">.</div>
</td>
<td>Medium Sea Green</td>
<td>#3CB371</td>
<td>rgb(60, 179, 113)</td>
</tr><tr><td>
<div style="background: #7b68ee; text-align: center;">.</div>
</td>
<td>Medium Slate Blue</td>
<td>#7B68EE</td>
<td>rgb(123, 103, 238)</td>
</tr><tr><td>
<div style="background: #00fa9a; text-align: center;">.</div>
</td>
<td>Medium Spring Green</td>
<td>#00FA9A</td>
<td>rgb(62, 250, 153)</td>
</tr><tr><td>
<div style="background: #48d1cc; text-align: center;">.</div>
</td>
<td>Medium Turquoise</td>
<td>#48D1CC</td>
<td>rgb(72, 209, 204)</td>
</tr><tr><td>
<div style="background: #c71585; text-align: center;">.</div>
</td>
<td>Medium Violet Red</td>
<td>#C71585</td>
<td>rgb(199, 21, 133)</td>
</tr><tr><td>
<div style="background: #191970; text-align: center;">.</div>
</td>
<td>Midnight Blue</td>
<td>#191970</td>
<td>rgb(25, 25, 112)</td>
</tr><tr><td>
<div style="background: #f5fffa; text-align: center;">.</div>
</td>
<td>Mint Cream</td>
<td>#F5FFFA</td>
<td>rgb(245, 255, 250)</td>
</tr><tr><td>
<div style="background: #ffe4e1; text-align: center;">.</div>
</td>
<td>Misty Rose</td>
<td>#FFE4E1</td>
<td>rgb(254, 228, 225)</td>
</tr><tr><td>
<div style="background: #ffe4b5; text-align: center;">.</div>
</td>
<td>Moccasin</td>
<td>#FFE4B5</td>
<td>rgb(254, 228, 181)</td>
</tr><tr><td>
<div style="background: #ffdead; text-align: center;">.</div>
</td>
<td>Navajo White</td>
<td>#FFDEAD</td>
<td>rgb(254, 222, 173)</td>
</tr><tr><td>
<div style="background: #000080; text-align: center;">.</div>
</td>
<td>Navy</td>
<td>#000080</td>
<td>rgb(0, 0, 128)</td>
</tr><tr><td>
<div style="background: #fdf5e6; text-align: center;">.</div>
</td>
<td>Old Lace</td>
<td>#FDF5E6</td>
<td>rgb(253, 245, 230)</td>
</tr><tr><td>
<div style="background: #808000; text-align: center;">.</div>
</td>
<td>Olive</td>
<td>#808000</td>
<td>rgb(128, 128, 1)</td>
</tr><tr><td>
<div style="background: #6b8e23; text-align: center;">.</div>
</td>
<td>Olive Drab</td>
<td>#6B8E23</td>
<td>rgb(107, 142, 35)</td>
</tr><tr><td>
<div style="background: #ffa500; text-align: center;">.</div>
</td>
<td>Orange</td>
<td>#FFA500</td>
<td>rgb(252, 165, 3)</td>
</tr><tr><td>
<div style="background: #ff4500; text-align: center;">.</div>
</td>
<td>Orange Red</td>
<td>#FF4500</td>
<td>rgb(250, 69, 1)</td>
</tr><tr><td>
<div style="background: #da70d6; text-align: center;">.</div>
</td>
<td>Orchid</td>
<td>#DA70D6</td>
<td>rgb(218, 112, 214)</td>
</tr><tr><td>
<div style="background: #eee8aa; text-align: center;">.</div>
</td>
<td>Pale Golden Rod</td>
<td>#EEE8AA</td>
<td>rgb(238, 232, 170)</td>
</tr><tr><td>
<div style="background: #98fb98; text-align: center;">.</div>
</td>
<td>Pale Green</td>
<td>#98FB98</td>
<td>rgb(152, 251, 153)</td>
</tr><tr><td>
<div style="background: #afeeee; text-align: center;">.</div>
</td>
<td>Pale Turquoise</td>
<td>#AFEEEE</td>
<td>rgb(175, 238, 239)</td>
</tr><tr><td>
<div style="background: #db7093; text-align: center;">.</div>
</td>
<td>Pale Violet Red</td>
<td>#DB7093</td>
<td>rgb(219, 112, 147)</td>
</tr><tr><td>
<div style="background: #ffefd5; text-align: center;">.</div>
</td>
<td>Papaya Whip</td>
<td>#FFEFD5</td>
<td>rgb(254, 239, 213)</td>
</tr><tr><td>
<div style="background: #ffdab9; text-align: center;">.</div>
</td>
<td>Peach Puff</td>
<td>#FFDAB9</td>
<td>rgb(253, 218, 185)</td>
</tr><tr><td>
<div style="background: #cd853f; text-align: center;">.</div>
</td>
<td>Peru</td>
<td>#CD853F</td>
<td>rgb(205, 133, 63)</td>
</tr><tr><td>
<div style="background: #ffc0cb; text-align: center;">.</div>
</td>
<td>Pink</td>
<td>#FFC0CB</td>
<td>rgb(252, 192, 203)</td>
</tr><tr><td>
<div style="background: #dda0dd; text-align: center;">.</div>
</td>
<td>Plum</td>
<td>#DDA0DD</td>
<td>rgb(221, 160, 221)</td>
</tr><tr><td>
<div style="background: #b0e0e6; text-align: center;">.</div>
</td>
<td>Powder Blue</td>
<td>#B0E0E6</td>
<td>rgb(176, 224, 230)</td>
</tr><tr><td>
<div style="background: #800080; text-align: center;">.</div>
</td>
<td>Purple</td>
<td>#800080</td>
<td>rgb(128, 0, 128)</td>
</tr><tr><td>
<div style="background: #663399; text-align: center;">.</div>
</td>
<td>Rebecca Purple</td>
<td>#663399</td>
<td>rgb(102, 51, 153)</td>
</tr><tr><td>
<div style="background: #ff0000; text-align: center;">.</div>
</td>
<td>Red</td>
<td>#FF0000</td>
<td>rgb(255, 0, 0)</td>
</tr><tr><td>
<div style="background: #bc8f8f; text-align: center;">.</div>
</td>
<td>Rosy Brown</td>
<td>#BC8F8F</td>
<td>rgb(188, 143, 142)</td>
</tr><tr><td>
<div style="background: #4169e1; text-align: center;">.</div>
</td>
<td>Royal Blue</td>
<td>#4169E1</td>
<td>rgb(65, 105, 225)</td>
</tr><tr><td>
<div style="background: #8b4513; text-align: center;">.</div>
</td>
<td>Saddle Brown</td>
<td>#8B4513</td>
<td>rgb(139, 69, 19)</td>
</tr><tr><td>
<div style="background: #fa8072; text-align: center;">.</div>
</td>
<td>Salmon</td>
<td>#FA8072</td>
<td>rgb(250, 128, 114)</td>
</tr><tr><td>
<div style="background: #f4a460; text-align: center;">.</div>
</td>
<td>Sandy Brown</td>
<td>#F4A460</td>
<td>rgb(244, 164, 95)</td>
</tr><tr><td>
<div style="background: #2e8b57; text-align: center;">.</div>
</td>
<td>Sea Green</td>
<td>#2E8B57</td>
<td>rgb(46, 139, 87)</td>
</tr><tr><td>
<div style="background: #fff5ee; text-align: center;">.</div>
</td>
<td>Sea Shell</td>
<td>#FFF5EE</td>
<td>rgb(255, 245, 238)</td>
</tr><tr><td>
<div style="background: #a0522d; text-align: center;">.</div>
</td>
<td>Sienna</td>
<td>#A0522D</td>
<td>rgb(160, 82, 45)</td>
</tr><tr><td>
<div style="background: #c0c0c0; text-align: center;">.</div>
</td>
<td>Silver</td>
<td>#C0C0C0</td>
<td>rgb(192, 192, 192)</td>
</tr><tr><td>
<div style="background: #87ceeb; text-align: center;">.</div>
</td>
<td>Sky Blue</td>
<td>#87CEEB</td>
<td>rgb(135, 206, 235)</td>
</tr><tr><td>
<div style="background: #6a5acd; text-align: center;">.</div>
</td>
<td>Slate Blue</td>
<td>#6A5ACD</td>
<td>rgb(106, 90, 205)</td>
</tr><tr><td>
<div style="background: #708090; text-align: center;">.</div>
</td>
<td>Slate Gray</td>
<td>#708090</td>
<td>rgb(112, 128, 145)</td>
</tr><tr><td>
<div style="background: #fffafa; text-align: center;">.</div>
</td>
<td>Snow</td>
<td>#FFFAFA</td>
<td>rgb(255, 250, 250)</td>
</tr><tr><td>
<div style="background: #00ff7f; text-align: center;">.</div>
</td>
<td>Spring Green</td>
<td>#00FF7F</td>
<td>rgb(63, 255, 128)</td>
</tr><tr><td>
<div style="background: #4682b4; text-align: center;">.</div>
</td>
<td>Steel Blue</td>
<td>#4682B4</td>
<td>rgb(70, 130, 180)</td>
</tr><tr><td>
<div style="background: #d2b48c; text-align: center;">.</div>
</td>
<td>Tan</td>
<td>#D2B48C</td>
<td>rgb(210, 180, 140)</td>
</tr><tr><td>
<div style="background: #008080; text-align: center;">.</div>
</td>
<td>Teal</td>
<td>#008080</td>
<td>rgb(26, 128, 127)</td>
</tr><tr><td>
<div style="background: #d8bfd8; text-align: center;">.</div>
</td>
<td>Thistle</td>
<td>#D8BFD8</td>
<td>rgb(216, 191, 216)</td>
</tr><tr><td>
<div style="background: #ff6347; text-align: center;">.</div>
</td>
<td>Tomato</td>
<td>#FF6347</td>
<td>rgb(250, 99, 71)</td>
</tr><tr><td>
<div style="background: #40e0d0; text-align: center;">.</div>
</td>
<td>Turquoise</td>
<td>#40E0D0</td>
<td>rgb(64, 224, 208)</td>
</tr><tr><td>
<div style="background: #ee82ee; text-align: center;">.</div>
</td>
<td>Violet</td>
<td>#EE82EE</td>
<td>rgb(238, 130, 238)</td>
</tr><tr><td>
<div style="background: #f5deb3; text-align: center;">.</div>
</td>
<td>Wheat</td>
<td>#F5DEB3</td>
<td>rgb(245, 222, 179)</td>
</tr><tr><td>
<div style="background: #ffffff; text-align: center;">.</div>
</td>
<td>White</td>
<td>#FFFFFF</td>
<td>rgb(255, 255, 255)</td>
</tr><tr><td>
<div style="background: #f5f5f5; text-align: center;">.</div>
</td>
<td>White Smoke</td>
<td>#F5F5F5</td>
<td>rgb(245, 245, 245)</td>
</tr><tr><td>
<div style="background: #ffff00; text-align: center;">.</div>
</td>
<td>Yellow</td>
<td>#FFFF00</td>
<td>rgb(255, 255, 0)</td>
</tr><tr><td>
<div style="background: #9acd32; text-align: center;">.</div>
</td>
<td>Yellow Green</td>
<td>#9ACD32</td>
<td>rgb(154, 205, 49)</td>
</tr></tbody></table></div>
                                </div>
                            </div>
                        </div>
                     


   <!-- END ISI HALAMAN -->


                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->
<!--FOOTER-->
                
<?php footer();?>

<!-- END FOOTER-->

            </div>



              <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->






<!-- Sidebar Kanan -->
<?php

right();

?>

<!-- End Sidebar Kanan -->





<!-- Letak Kode PHP Bawah -->




<!-- END Letak Kode PHP bawah -->




<!-- Library & Pluggins-->
  <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <script src="assets/libs/switchery/switchery.min.js"></script>
        <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="assets/libs/select2/select2.min.js"></script>
        <script src="assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
        <script src="assets/libs/autocomplete/jquery.autocomplete.min.js"></script>
        <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

         <script src="assets/libs/moment/moment.min.js"></script>
        <script src="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
      

      <!-- Daterange dan Select2-->

       <script src="assets/datepicker/bootstrap-datepicker.js"></script>
         <script src="assets/daterangepicker/daterangepicker.js"></script>
            <script src="assets/libs/select2/select2.min.js"></script>

              <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <script src="assets/js/pages/sweet-alerts.init.js"></script>


         <!-- Init js-->
        <script src="assets/js/pages/form-pickers.init.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

<!-- END Lib & Plugins-->






</body>
</html>