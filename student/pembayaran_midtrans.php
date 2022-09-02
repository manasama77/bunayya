<?php
session_start();
if (!$_SESSION['snap_token']) {
    header('location:summary');
}

$snap_token = $_SESSION['snap_token'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="hidden" id="snap_token" value="<?= $snap_token; ?>" />
</body>

</html>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Q8fsKFh_-jm0ltah"></script>

<script>
    let snapToken = document.getElementById('snap_token')
    window.snap.pay(snapToken.value, {
        onSuccess: function(result) {
            /* You may add your own implementation here */
            alert("Pembayaran Berhasil");
            window.location.replace('summary?status=finish')
            console.log(result);
        },
        onPending: function(result) {
            /* You may add your own implementation here */
            alert("Pembayaran belum selesai");
            console.log(result);
        },
        onError: function(result) {
            /* You may add your own implementation here */
            console.log(result);
            alert("Pembayaran Gagal");
        },
        onClose: function() {
            window.location.replace('summary')
        }
    })
</script>