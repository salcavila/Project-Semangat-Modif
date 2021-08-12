<!DOCTYPE HTML>
<html>
<head>
    <title>Project Semangat</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <?php
        $file = file_get_contents("data.json");
        $arrjsn = json_decode($file, true);
    ?>

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Travel Mangats</a>
    </nav>
    <div class="parallax">
        <h1 class="display-4" style="color:white;">Pendaftaran Rute Penerbangan</h1>
        <p style="color:white;">Web ini digunakan untuk mendaftarkan penerbangan dan melihat rute yang tersedia.</p>
        <p >
            <a class="btn btn-primary btn-lg" href="#section1" role="button">Daftar Sekarang</a>
        </p>
    </div>

    <h3 class="text-center" id="section1">Form Pendaftaran</h3> 
    <p class="text-center">Silahkan isi data disini</p>
    <hr>
    <!-- Form start-->
    <div class="wrapper">
        <form action="" method="POST">
            <!-- Form Maskapai -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Maskapai</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="maskapai" placeholder="Nama Maskapai">
                </div>
            </div>
            <!-- Form Bandara Asal -->
            <div class="form-group row"> 
                <label class="col-sm-2 col-form-label">Bandara Asal</label>
                <div class="col-sm-10">
                    <select class="custom-select my-1 mr-sm-2" name="bandaraAsal">
                        <option value="Soekarno-Hatta (CGK)">Soekarno-Hatta (CGK)</option>
                        <option value="Husein Sastranegara (BDO)">Husein Sastranegara (BDO)</option>
                        <option value="Abdul Rachman Saleh (MLG)">Abdul Rachman Saleh (MLG)</option>
                        <option value="Juanda (SUB)">Juanda (SUB)</option>
                    </select>
                </div>
            </div>
            <!-- Form Bandara Tujuan -->
            <div class="form-group row"> 
                <label class="col-sm-2 col-form-label">Bandara Tujuan</label>
                <div class="col-sm-10">
                    <select class="custom-select my-1 mr-sm-2" name="bandaraTujuan">
                        <option value="Ngurah Rai (DPS)">Ngurah Rai (DPS)</option>
                        <option value="Hasanudin (UPG)">Hasanudin (UPG)</option>
                        <option value="Inanwatan (INX)">Inanwatan (INX)</option>
                        <option value="Sultan Iskandar Muda (BTJ)">Sultan Iskandar Muda (BTJ)</option>
                    </select>
                </div>
            </div>
            <!-- Form Harga Tiket -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Harga Tiket</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="hargaTiket" placeholder="Harga Tiket">
                </div>
            </div>
            <!-- Form SUBMIT -->
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        </form>
    </div>
    <!-- Form End-->

    <?php 

    function pajak($arrPajakAsal, $arrPajakTujuan, $bandaraAsal, $bandaraTujuan){
        $pajak = $arrPajakAsal["name" == $bandaraAsal][1] + $arrPajakTujuan["name" == $bandaraTujuan][1];
        return $pajak;
    }

        $arrPajakAsal = array(
            array ("Soekarno-Hatta (CGK)", 50000),
            array ("Husein Sastranegara (BDO)", 30000),
            array ("Abdul Rachman Saleh (MLG)", 40000),
            array ("Juanda (SUB)", 40000)
        );
        $arrPajakTujuan = array (
            array ("Ngurah Rai (DPS)", 80000),
            array ("Hasanuddin (UPG)", 70000),
            array ("Inanwatan (INX)", 90000),
            array ("Sultan Iskandarmuda (BTJ)", 70000)
        );

        

    if (isset($_POST['submit'])) 
    {
        $maskapai = $_POST['maskapai'];
        $bandaraAsal = $_POST['bandaraAsal'];
        $bandaraTujuan = $_POST['bandaraTujuan'];
        $hargaTiket = (int)$_POST['hargaTiket'];
    
        $pajak = pajak($arrPajakAsal, $arrPajakTujuan, $bandaraAsal, $bandaraTujuan);

        $totalHarga = $pajak + $hargaTiket;
        $arrjsn[] = ['maskapai' => $maskapai, 'bandaraAsal' => $bandaraAsal, 'bandaraTujuan' => $bandaraTujuan, 'hargaTiket' => $hargaTiket, 'pajak' => $pajak, 'totalHarga' => $totalHarga];
        $file = json_encode($arrjsn, JSON_PRETTY_PRINT);
        file_put_contents('data.json', $file);
    }
?>

<h3 class="text-center" id="section1">Daftar Rute Tersedia</h3> 
<hr>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>Maskapai</th>
            <th>Asal Penerbangan</th>
            <th>Tujuan Penerbangan</th>
            <th>Harga Tiket</th>
            <th>Pajak</th>
            <th>Total Harga Tiket</th>
        </tr>
    </thead>

	<?php 
	//sort($datamhs);

	//menampilkan array yg ada pada file json dengan nama array arrjsn
	for ($i=0; $i < count($arrjsn); $i++) { 
			echo "<tr>";
			echo "<td>".$arrjsn[$i]['maskapai']."</td>";
			echo "<td>".$arrjsn[$i]['bandaraAsal']."</td>";
			echo "<td>".$arrjsn[$i]['bandaraTujuan']."</td>";
            echo "<td>".$arrjsn[$i]['hargaTiket']."</td>";
            echo "<td>".$arrjsn[$i]['pajak']."</td>";
            echo "<td>".$arrjsn[$i]['totalHarga']."</td>";
	}
	?>
</table>
<footer style="background-color: black; color:blanchedalmond; text-align: center;">Salcavila @ 2021</footer>
</body>
</html>