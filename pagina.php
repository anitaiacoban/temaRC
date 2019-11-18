<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'bid.php';
include 'licitatie.php';

$licitatiie = new Licitatie();
$licit = $licitatiie->get('1');


$bidDb = new Bid();
$maxBidEu = $bidDb->iaValoareaMax('eu');
$maxBidPc = $bidDb->iaValoareaMax('pc');


if (!empty($_POST['valoare']) && isset($_POST['valoare'])) {

    try {

        $bidList = new Bid();
        $bidList->create('eu', $_POST['valoare']);
        if ($_POST['valoare'] > $licit['oferta_inceput']) {
            $licitatiie->updateOferta($_POST['valoare']);
        }
        $valoarePC = rand(0, 20);
        $bidList->create('pc', $valoarePC);
        if ($valoarePC > $licit['oferta_inceput']) {
            $licitatiie->updateOferta($valoarePC);
        }
        if ($licit['durata'] == '00:00:00') {
            $castigator = '';
            if ($_POST['valoare'] > $valoarePC) {
                $castigator = 'eu';
            } else if ($valoarePC > $_POST['valoare']) {
                $castigator = 'pc';
            }
            $licitatiie->updateCastigator($castigator);
        }

        header("Location: pagina.php");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="style.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="body-color">
    <div class="topnav">
        <ul>
            <li class="first-li">AUCTIONEER</li>
            <li class="secli">Home</li>
            <li class="secli">Auction House</li>
            <li class="secli">About</li>
        </ul>
    </div>

    <div class="auction-page-container">
        <h1>Auction house</h1>

        <div class="border-div-blue shadow p-3 mb-5">
            <div class="components-container">
                <div class="boder-div-red bdr1">
                    <div class="boder-div-green clear-div current-offer-div">
                        Current offer
                    </div>
                    <div class="boder-div-green clear-div oferta-container ">
                        <form method="GET">
                            <input class="licitatie-input shadow-inside" type="text" name="licitatiie" disabled="disabled" value="
                        <?php echo $licit["oferta_inceput"] ?>" placeholder="ofertaInceput">
                        </form>
                    </div>
                </div>
                <div class="boder-div-red bdr2">
                    <div class="boder-div-darkgreen">
                        <div class="boder-div-green container-label">
                            Current time
                        </div>
                        <div class="border-label-time container-label">
                            <div class="two-in-one common-two-in-one">
                                Time Left
                            </div>
                            <div class="acutal-two-in-one common-two-in-one">
                                0m 55s
                            </div>
                        </div>
                    </div>
                    <div class="boder-div-darkgreen">
                        <div class="boder-div-green container-label">
                            Current Winner
                        </div>
                        <div class="border-label-time container-label">
                            <div class="two-in-one common-two-in-one" style="background-color: green !important; color: white;">
                                You
                            </div>
                            <div class="acutal-two-in-one common-two-in-one">
                                Computer
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="place-bid-container">
            <h6>Place your bid</h6>
            </br>
            <form href="CreateLicitatie.php" method="POST">
                <span class="dolar-label">$</span><span>
                    <input type="text" name="valoare" class="input-bid"></span>
                <span>
                    <button type="submit" class="btn btn-primary">Bid amount</a>
                </span>
            </form>
        </div>

        <div class="statistics-container">
            <h3>Statistics</h3>
            <div class="statistics">
                <div class="bids-statistics">
                    <div class="statistics-label statistics-value">Top bids</div>
                    <div class="statistics-value">
                        $ <?php echo array_values($maxBidEu)[0] ?> eu
                    </div>
                    <div class="statistics-value">
                        $ <?php echo array_values($maxBidPc)[0] ?> pc
                    </div>
                </div>
            </div>



        </div>

    </div>
</body>

</html>