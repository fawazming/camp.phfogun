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
        <h5>Welcome! </h5>
        <div class="row">
            <a href="<?=base_url('buypin')?>" class="col border">
                <h2>Buy Pin</h2>
            </a>
            <a href="<?=base_url('register')?>" class="col border">
                <h2>Register</h2>
                <small>I have pin, I want to register</small>
            </a>
            <a href="<?=base_url('pinstatus')?>" class="col border">
                <h2>Status</h2>
                <small>Is my registeration successful?</small>
            </a>
        </div>
    </div>
    <script src="assets/script.js"></script>
</body>

</html>