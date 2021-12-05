<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/chota.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>PMC Registration Portal</title>
</head>

<body>
    <div class="coner">
        <div class="text-center" style="margin-bottom:8px; display: flex; justify-content: center; align-items: center;">
            <img src="assets/logo.png" width="80px" alt="">
            <h4>PMC '21 <br> Registeration Portal</h4>
        </div>
        <h5><a href="<?=base_url('/')?>">Home</a> > Buy pin for registeration</h5>
        <div class="row">
            <!-- <a href="<?=base_url('payonline')?>" class="col border"> -->
            <a href="#!" class="col border">
                <h2>Pay Online</h2>
                <small>Instant Pin Vending for registeration</small>
            </a>
            <a href="<?=base_url('vendors')?>" class="col border">
                <h2>From Vendors</h2>
                <small>Make transfer to any available vendors</small>
            </a>
        </div>
    </div>
    <script src="assets/script.js"></script>
</body>

</html>