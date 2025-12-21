<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMC Tags</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/paper.css')?>">
     <!-- Set page size here: A5, A4, A4 landscape, letter, legal or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>@page { size: A4 }</style>
    <style>
        body{
            font-family: 'Tahoma';
        }
        .container{
            display: flex;
            flex-direction:row;
            flex-wrap: wrap;
            align-content: flex-start;
            justify-content: space-between;
            align-items: center;
        }
        .card{
            height: 88mm;
            width: 44mm;
            background-color: #fff;
            border: 2px #000 solid;
            padding: 1mm 3mm;
            margin: 0;
        }
        .center{
            text-align: center;
        }
        .logo{
            line-height: 0.99rem;
        }
        .m-0{
            margin: 0;
            text-transform: Capitalize;
        }
        .mt-1{
            margin-top: 3px;
        }
    </style>
</head>
<body class="A4">

    <?php
        function ab($val){
            return strtoupper(substr($val,0,1));
        }
        function ab1($val){
            return strtoupper(substr($val,0,2));
        }
        function ib($val){
            if ($val > 0 && $val < 10) {
                return '00'.$val;
            }elseif ($val > 10 && $val < 100) {
                return '0'.$val;
            }else{
                return $val;
            }
        }
        $counter = 1;
            echo"<div class='container sheet'>";

        foreach ($del as $key => $de) {
            if ($counter == 12) {
                $counter = 0;
                echo"
    <div class='card'>
        <div class='center logo'>
            <div style='display: flex; align-items: center;  justify-content: space-between;'>
                <img src='https://camp.phfogun.org.ng/assets/logo.png' alt='' width='50mm'>

                <img src='https://api.qrserver.com/v1/create-qr-code/?data=". urlencode($de[0]['fname']." ".$de[0]['lname']." PMC".ab1($de[0]['lb']).ab($de[0]['gender']).ib($de[0]['id']))."&size=100x100' alt='QR Code' width='50mm'>
            </div>
            <h2 class='m-0'>PMC '25</h2>
            <small>https://camp.phfogun.org.ng</small>
        </div>
        <br>
        <div class='m-0'>
            <p class='m-0'>Name:</p>
            <h4 class='m-0'>".$de[0]['fname']." ".$de[0]['lname']."</h4>
        </div>
         <br>
        <div class='m-0'>
            <p class='m-0'>Local Branch & House:</p>
            <h4 class='m-0'>".$de[0]['lb']." || ".$de[0]['house']."</h4>
        </div>
        <br>
        <div class='m-0'>
            <p class='m-0'>Category:</p>
            <h4 class='m-0'>".$de[0]['category']."</h4>
        </div>
        <br>

        <div class='center logo mt-1'>
            <h1 style='font-family: consolas;' class='m-0'>PMC".ab1($de[0]['lb']).ab($de[0]['gender']).ib($de[0]['id'])."</h1>
            <small style='font-size: 0.6rem;'>...returning to Allah with PURE HEART</small>
        </div>
    </div>

            </div>
                <div class='container sheet'>";
            }else{
                echo "
    <div class='card'>
        <div class='center logo'>
            <div style='display: flex; align-items: center; justify-content: space-between;'>
                <img src='https://camp.phfogun.org.ng/assets/logo.png' alt='' width='50mm'>

                <img src='https://api.qrserver.com/v1/create-qr-code/?data=". urlencode($de[0]['fname']." ".$de[0]['lname']." PMC".ab1($de[0]['lb']).ab($de[0]['gender']).ib($de[0]['id']))."&size=100x100' alt='QR Code' width='50mm'>
            </div>
            <h2 class='m-0'>PMC '25</h2>
            <small>https://camp.phfogun.org.ng</small>
        </div>
        <br>
        <div class='m-0'>
            <p class='m-0'>Name:</p>
            <h4 class='m-0'>".$de[0]['fname']." ".$de[0]['lname']."</h4>
        </div>
         <br>
        <div class='m-0'>
            <p class='m-0'>Local Branch & House:</p>
            <h4 class='m-0'>".$de[0]['lb']." || ".$de[0]['house']."</h4>
        </div>
        <br>
        <div class='m-0'>
            <p class='m-0'>Category:</p>
            <h4 class='m-0'>".$de[0]['category']."</h4>
        </div>
        <br>

        <div class='center logo mt-1'>
            <h1 style='font-family: consolas;' class='m-0'>PMC".ab1($de[0]['lb']).ab($de[0]['gender']).ib($de[0]['id'])."</h1>
            <small style='font-size: 0.6rem;'>...returning to Allah with PURE HEART</small>
        </div>
    </div>

                ";
            }
            $counter++;
        }
    echo"</div>";
    ?>


</body>
</html>