<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Form Kehadiran Peserta Seminar Informatika ITK 2019</title>
</head>
<body>
	<div class="box">
		<h2 align="left">Form Kehadiran Peserta Seminar Informatika ITK 2019</h2>
		<h3 align="left">Silahkan isi form dibawah ini</h3>
    </div>
		<form action="index.php" method="POST">
			<label for="namalengkap">Nama Lengkap</label>
				<input type="text" name="namalengkap" id="namalengkap" required=""><br><br>
			<label for="asalkampus">asalkampus</label>
				<input type="text" name="asalkampus" id="asalkampus" required=""><br><br>
			<label for="prodi">Prodi/Jurusan/Email</label>
				<input type="text" name="prodi" id="prodi" required=""><br><br>
			<label for="email">Email</label>
				<input type="text" name="email" id="email" required=""><br><br>
		</form>

        <input type="submit" name="submit" value="Submit">
            </form>

            <form action="index.php" method="GET">
                <input type="submit"  name="load_data" value="Lihat Daftar Peserta">
            </form>   

	<?php
    $host = "dicodingappserver2.database.windows.net";
    $user = "dicoding";
    $pass = "poseidon123";
    $db = "submission1";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
    if (isset($_POST['submit'])) {
        try {
            $namalengkap = $_POST['namalengkap'];
            $asalkampus = $_POST['asalkampus'];
            $prodi = $_POST['prodi'];
            ##$date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO Registration (namalengkap, asalkampus, prodi)##, date) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $namalengkap);
            $stmt->bindValue(2, $asalkampus);
            $stmt->bindValue(3, $prodi);
            ##$stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Anda Telah Terdaftar!</h3>";
    } else if (isset($_GET['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>Daftar Peserta Seminar Informatika 2019 yang telah terdaftar : </h2>";
                echo "<table class='table table-hover'><thead>";
                echo "<tr><th>Name</th>";
                echo "<th>NIM</th>";
                echo "<th>TKNB</th>";
                echo "<th>Date</th></tr></thead><tbody>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['namalengkap']."</td>";
                    echo "<td>".$registrant['asalkampus']."</td>";
                    echo "<td>".$registrant['prodi']."</td>";
                    echo "<td>".$registrant['email']."</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
</body>