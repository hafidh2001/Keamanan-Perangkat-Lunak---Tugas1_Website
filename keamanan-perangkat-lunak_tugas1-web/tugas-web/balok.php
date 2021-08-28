<?php
    // cek apakah tombol submit dengan nama = "konversi" sudah ditekan atau belum
    if (isset($_POST['hitung'])) {
        $p = (double)$_POST["panjang"];
        $l = (double)$_POST["lebar"];
        $t = (double)$_POST["tinggi"];
        
        // Check apakah sudah memenuhi syarat atau belum
        if ( ($p < 0) || ($l < 0) || ($t < 0) ) {
            echo "<script>
                alert( 'Only be filled with a positive value with max 2 decimal' );
                document.location.href = 'balok.php';
            </script>";
        } else {
            // Luas : 2 ( p.l + p.t + l.t )
            $luas = 2 * ( ($p * $l) + ($p * $t) + ($l * $t));
            $luas = number_format($luas, 2, '.', ' ');
            
            // Volume : p.l.t
            $volume = $p * $l * $t;
            $volume = number_format($volume, 2, '.', ' ');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Balok | Hafidh Ahmad F.</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <!-- Link CSS -->
    <link rel="stylesheet" href="data/all.css">
</head>

<body>
    <div class="container">
        <a href="index.php">
            <button class="btn bg-secondary" style="margin-top: 5px; margin-left: -10px; ">
                Back to Main Menu
            </button>
        </a>
        
        <h4 class="mt-2">Hitung Luas dan Volume Balok</h4>
        <h6>by Hafidh Ahmad Fauzan</h6>
        <h6 class="mb-3">19051397027</h6>

        <div class="row justify-content-between">
            <div class="col-6 my-3 border border-1">
                <h5 style="text-align: center;">Insert Data</h5>

                <form action="balok.php" method="post">
                    <div class="form-group mx-5 my-3">
                        <label for="panjang">Panjang Balok :</label>
                        <input 
                            type="text" 
                            name="panjang" id="panjang" class="form-control" 
                            min="0"
                            step="0.01"
                            minlength="1"
                            pattern="([0-9])+(\.[0-9][0-9]?)?"
                            title="This field only be filled with a positive value with max 2 decimal (.00)"
                            placeholder="Panjang Balok (only positive numbers & decimals)"
                            required>
                    </div>
                    <div class="form-group mx-5 my-3">
                        <label for="lebar">Lebar Balok :</label>
                        <input 
                            type="text" 
                            name="lebar" id="lebar" class="form-control" 
                            min="0"
                            step="0.01"
                            minlength="1"
                            pattern="([0-9])+(\.[0-9][0-9]?)?"
                            title="This field only be filled with a positive value with max 2 decimal (.00)"
                            placeholder="Lebar Balok (only positive numbers & decimals)"
                            required>
                    </div>
                    <div class="form-group mx-5 mt-3 mb-5">
                        <label for="tinggi">Tinggi Balok :</label>
                        <input 
                            type="text" 
                            name="tinggi" id="tinggi" class="form-control" 
                            min="0"
                            step="0.01"
                            minlength="1"
                            pattern="([0-9]{1,2})+(\.[0-9][0-9]?)?"
                            title="Nilai UAS only be filled with a value range of 0-100 with max 2 decimal (.00)"
                            placeholder="Tinggi Balok (only positive numbers & decimals)"
                            required>
                    </div>

                    <div class="form-group mx-5 mb-5">
                        <div class="float-end mb-3">
                            <button type="reset" class="btn btn-secondary btn-sm">Reset Form</button>
                            <button type="submit" name="hitung" class="btn btn-primary btn-sm">Hitung</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- START SHOW HASIL KONVERSI -->
            <div class="col-5 my-3">
                <h5 style="text-align: center;">Hasil Luas & Volume Balok</h5>
                <table class="table align-middle" style="width: 550px">
                    <tr>
                        <td style="width: 200px">Panjang Balok</td>
                        <td>:</td>
                        <?php if ( isset($p)) : ?>
                            <td style="width: 300px"><?= $p ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Lebar Balok</td>
                        <td>:</td>
                        <?php if ( isset($l)) : ?>
                            <td><?= $l ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Tinggi Balok</td>
                        <td>:</td>
                        <?php if ( isset($t)) : ?>
                            <td><?= $t ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Luas Balok</td>
                        <td>:</td>
                        <?php if ( isset($luas)) : ?>
                            <td><?= $luas ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Volume Balok</td>
                        <td>:</td>
                        <?php if ( isset($volume)) : ?>
                            <td><?= $volume ?></td>
                        <?php endif; ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous">
    </script>
</body>

</html>