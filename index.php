<html>
<head>
	<meta charset="utf-8">
	<title>Form Kehadiran Peserta Seminar Informatika ITK 2019</title>
</head>
<body>
	 <div class="starter-template"> <br><br><br>
        <h1>Form Kehadiran Peserta Seminar Informatika ITK 2019</h1>
        <p class="lead">Silahkan isi form dibawah ini.</p> <br>
        <span class="border-top my-3"></span>
      </div>
        <form action="index.php" method="POST">
          <div class="form-group">
            <label for="name">Nama: </label>
            <input type="text" class="form-control" name="nama" id="name" required="" >
	        </div>
	        <div class="form-group">
	            <label for="email">Nomor Induk Mahasiswa (NIM): </label>
	            <input type="text" class="form-control" name="nim" id="nim" required=""maxlength="15">
	        </div>
	        <div class="form-group">
	            <label for="NPK">Tanda Nomor Kendaraan Bermotor (TKNB): </label>
	            <input type="text" class="form-control" name="npk" id="npk" required=""maxlength="8">
	        </div>
        <!-- <div class="form-group" action="index.php" method="post" enctype="multipart/form-data">
            <label for="upload">Unggah Foto Kendaraan : </label> <br>
            <input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png" required="">
            <br><br> -->
            <input type="submit" class="btn btn-success" name="submit" value="Submit Data Kendaraan">
        </form>
        <!-- <br><br> -->
        <form action="index.php" method="GET">
          <div class="form-group">
            <input type="submit" class="btn btn-info" name="load_data" value="Lihat Data Yang Sudah Registrasi">
          </div>
        </form>   

        <?php
		    $host = "dicodingappserver2.database.windows.net";
		    $user = "dicoding";
		    $pass = "poseidon123";
		    $db = "submission1web";
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
		            $email = $_POST['email'];
		            // Insert data
		            $sql_insert = "INSERT INTO Registration (namalengkap, asalkampus, prodi, email) 
		                        VALUES (?,?,?,?)";
		            $stmt = $conn->prepare($sql_insert);
		            $stmt->bindValue(1, $namalengkap);
		            $stmt->bindValue(2, $asalkampus);
		            $stmt->bindValue(3, $prodi);
		            $stmt->bindValue(4, $email);
		            $stmt->execute();
		        } catch(Exception $e) {
		            echo "Failed: " . $e;
		        }
		        echo "<h3>Your're registered!</h3>";
		    } else if (isset($_GET['load_data'])) {
		        try {
		            $sql_select = "SELECT * FROM Registration";
		            $stmt = $conn->query($sql_select);
		            $registrants = $stmt->fetchAll(); 
		            if(count($registrants) > 0) {
		                echo "<h2>Mahasiswa yang sudah teregistrasi kendaraannya sebanyak : ".count($registrants)." Orang</h2>";
		                echo "<table class='table table-hover'><thead>";
		                echo "<tr><th>Nama Lengkap</th>";
		                echo "<th>Asal Kampus</th>";
		                echo "<th>Prodi</th>";
		                echo "<th>E-Mail</th>";
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
		 </div>
	</body>
</html>