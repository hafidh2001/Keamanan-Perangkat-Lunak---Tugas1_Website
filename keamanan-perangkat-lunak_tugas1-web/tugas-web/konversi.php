<?php
    // cek apakah tombol submit dengan nama = "konversi" sudah ditekan atau belum
    if (isset($_POST['konversi'])) {
        $nama = $_POST["nama_lengkap"];
        $nis = $_POST["nis"];
        $mk = $_POST["mataKuliah"];
        $np = (double)$_POST["partisipasi"];
        $nt = (double)$_POST["tugas"];
        $n_uts = (double)$_POST["uts"];
        $n_uas = (double)$_POST["uas"];

        // Check apakah sudah memenuhi syarat atau belum
        if ( ($np < 0) || ($np > 100) || ($nt < 0) || ($nt > 100) || ($n_uts < 0) || ($n_uts > 100) || ($n_uas < 0) || ($n_uas > 100) ) {
            echo "<script>
                alert( 'Value range : 0.00 - 100' );
                document.location.href = 'konversi.php';
            </script>";
        } else {
            // Penilaian :
            $np = $np*0.2;
            $np = number_format($np, 2, '.', ' ');
            $nt = $nt*0.3;
            $nt = number_format($nt, 2, '.', ' ');
            $n_uts = $n_uts*0.2;
            $n_uts = number_format($n_uts, 2, '.', ' ');
            $n_uas = $n_uas*0.3;
            $n_uas = number_format($n_uas, 2, '.', ' ');

            // Total Penilaian
            $total = $np + $nt + $n_uts + $n_uas;
            $total = number_format($total, 2, '.', ' ');

            // Nilai dan Indeks :
            if ($total < 40 ) { $nilai = 0 ; $indeks = "E"; } 
            elseif ($total < 55 ) { $nilai = 1 ; $indeks = "D"; }
            elseif ($total < 60 ) { $nilai = 2 ; $indeks = "C"; }
            elseif ($total < 65 ) { $nilai = 2.5 ; $indeks = "C+"; }
            elseif ($total < 70 ) { $nilai = 2.75 ; $indeks = "B-"; }
            elseif ($total < 75 ) { $nilai = 3 ; $indeks = "B"; }
            elseif ($total < 80 ) { $nilai = 3.5 ; $indeks = "B+"; }
            elseif ($total < 85 ) { $nilai = 3.75 ; $indeks = "A-"; }
            elseif ($total <= 100 ) { $nilai = 4 ; $indeks = "A"; }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Konversi | Hafidh Ahmad F.</title>

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
        
        <h4 class="mt-2">Konversi Nilai Mahasiswa Unesa</h4>
        <h6>by Hafidh Ahmad Fauzan</h6>
        <h6 class="mb-3">19051397027</h6>

        <div class="row justify-content-between">
            <div class="col-6 my-3 border border-1">
                <h5 style="text-align: center;">Insert Data</h5>

                <form action="konversi.php" method="post">
                    <div class="form-group mx-5 mt-5 mb-3">
                        <label for="nama_lengkap">Nama Lengkap :</label> <!-- HTML ASCII -->
                        <input 
                            type="text" 
                            name="nama_lengkap" id="nama_lengkap" class="form-control"
                            minlength="3"
                            maxlength="100"
                            onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"
                            title="Nama Lengkap must be 3-100 character and contain only letters"
                            placeholder="Nama Lengkap"
                            required>
                    </div>
                    <div class="form-group mx-5 my-3">
                        <label for="mataKuliah">MataKuliah :</label> <!-- HTML ASCII -->
                        <input 
                            type="text" 
                            name="mataKuliah" id="mataKuliah" class="form-control"
                            minlength="3"
                            maxlength="100"
                            onkeypress="return (event.charCode > 48 && event.charCode < 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"
                            title="Mata Kuliah must be 3-100 character and contain only letters and numbers"
                            placeholder="MataKuliah"
                            required>
                    </div>
                    <div class="form-group mx-5 my-3">
                        <label for="nis">NIS :</label>
                        <input 
                            type="text" 
                            name="nis" id="nis" class="form-control"
                            min="0"
                            minlength="11"
                            maxlength="11"
                            pattern="[0-9]{11}"
                            title="NIS must be 11 characters in length and contain only numbers"
                            placeholder="NIS"
                            required>
                    </div>
                    <div class="form-group mx-5 my-3">
                        <label for="partisipasi">Nilai Partisipasi (20%):</label>
                        <input 
                            type="text" 
                            name="partisipasi" id="partisipasi" class="form-control" 
                            min="0"
                            max="100"
                            step="0.01"
                            minlength="1"
                            maxlength="5"
                            pattern="([0-9])+(\.[0-9][0-9]?)?"
                            title="Nilai Partisipasi only be filled with a value range of 0-100 with max 2 decimal (.00)"
                            placeholder="Value range : 0.00 - 100"
                            required>
                        
                        <?php if( isset($error) ) : ?>
                            <div class="invalid-feedback">
                                Value range : 0.00 - 100
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mx-5 my-3">
                        <label for="tugas">Nilai Tugas (30%) :</label>
                        <input 
                            type="text" 
                            name="tugas" id="tugas" class="form-control" 
                            min="0"
                            max="100"
                            step="0.01"
                            minlength="1"
                            maxlength="5"
                            pattern="([0-9]{1,2})+(\.[0-9][0-9]?)?"
                            title="Nilai Tugas only be filled with a value range of 0-100 with max 2 decimal (.00)"
                            placeholder="Value range : 0.00 - 100"
                            required>

                        <?php if( isset($error) ) : ?>
                            <div class="invalid-feedback">
                                Value range : 0.00 - 100
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mx-5 my-3">
                        <label for="uts">Nilai UTS (20%):</label>
                        <input 
                            type="text" 
                            name="uts" id="uts" class="form-control" 
                            min="0"
                            max="100"
                            step="0.01"
                            minlength="1"
                            maxlength="5"
                            pattern="([0-9]{1,2})+(\.[0-9][0-9]?)?"
                            title="Nilai UTS only be filled with a value range of 0-100 with max 2 decimal (.00)"
                            placeholder="Value range : 0.00 - 100"
                            required>

                        <?php if( isset($error) ) : ?>
                            <div class="invalid-feedback">
                                Value range : 0.00 - 100
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mx-5 mt-3 mb-5">
                        <label for="uas">Nilai UAS (30%) :</label>
                        <input 
                            type="text" 
                            name="uas" id="uas" class="form-control" 
                            min="0"
                            max="100"
                            step="0.01"
                            minlength="1"
                            maxlength="5"
                            pattern="([0-9]{1,2})+(\.[0-9][0-9]?)?"
                            title="Nilai UAS only be filled with a value range of 0-100 with max 2 decimal (.00)"
                            placeholder="Value range : 0.00 - 100"
                            required>

                        <?php if( isset($error) ) : ?>
                            <div class="invalid-feedback">
                                Value range : 0.00 - 100
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mx-5 mb-5">
                        <div class="float-end mb-3">
                            <button type="reset" class="btn btn-secondary btn-sm">Reset Form</button>
                            <button type="submit" name="konversi" class="btn btn-primary btn-sm">Konversi</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- START SHOW HASIL KONVERSI -->
            <div class="col-5 my-3">
                <h5 style="text-align: center;">Hasil Konversi Data</h5>
                <table class="table align-middle" style="width: 550px">
                    <tr>
                        <td style="width: 200px">Nama Lengkap</td>
                        <td>:</td>
                        <?php if ( isset($nama)) : ?>
                            <td style="width: 300px"><?= $nama ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <?php if ( isset($nis)) : ?>
                            <td><?= $nis ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>MataKuliah</td>
                        <td>:</td>
                        <?php if ( isset($mk)) : ?>
                            <td><?= $mk ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Nilai Partisipasi</td>
                        <td>:</td>
                        <?php if ( isset($np)) : ?>
                            <td><?= $np ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Nilai Tugas</td>
                        <td>:</td>
                        <?php if ( isset($nt)) : ?>
                            <td><?= $nt ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Nilai UTS</td>
                        <td>:</td>
                        <?php if ( isset($n_uts)) : ?>
                            <td><?= $n_uts ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Nilai UAS</td>
                        <td>:</td>
                        <?php if ( isset($n_uas)) : ?>
                            <td><?= $n_uas ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Nilai Akhir</td>
                        <td>:</td>
                        <?php if ( isset($total)) : ?>
                            <td><?= $total ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Indeks Angka </td>
                        <td>:</td>
                        <?php if ( isset($nilai)) : ?>
                            <td><?= $nilai ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Indeks Huruf</td>
                        <td>:</td>
                        <?php if ( isset($indeks)) : ?>
                            <td><?= $indeks ?></td>
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