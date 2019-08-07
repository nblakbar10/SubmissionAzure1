<html>
 <head>
 <Title>Form Registrasi Seminar</Title>
	 <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

            <!-- Bootstrap core CSS -->
            <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="starter-template.css" rel="stylesheet">

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <style type="text/css">
 	body { background-color: #fff; border-top: solid 10px #000;
 	    color: #333; font-size: .85em; margin: 20; padding: 20;
 	    font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
 	}
	 .navbar {
            background-image: linear-gradient(to right, #1E9883, #FFFFFF);
        }
        .nav-link {
            color : blue;
 	h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
 	h1 { font-size: 2em; }
 	h2 { font-size: 1.75em; }
 	h3 { font-size: 1.2em; }
 	table { margin-top: 0.75em; }
 	th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
 	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
 </style>
 </head>
 <body>
	 <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="https://webappsubmission1.azurewebsites.net/">Home</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="https://webappsubmission2.azurewebsites.net/">Analisis Gambar<span class="sr-only">(current)</span></a>
			</li>
		</div>
		</nav>
 <h1>Seminar Nasional Informatika ITK 2019</h1>
 <p>Silahkan isi form dibawah ini, lalu tekan <strong>Submit</strong> untuk mendaftar.</p>
 <form method="post" action="index.php" enctype="multipart/form-data" >
       Nama Lengkap  <input type="text" name="namalengkap" id="namalengkap"/></br></br>
       Asal Kampus  <input type="text" name="asalkampus" id="asalkampus"/></br></br>
       Prodi/Jurusan/Fakultas <input type="text" name="prodi" id="prodi"/></br></br>
       Email <input type="text" name="email" id="email"/></br></br>
       <input type="submit" name="submit" value="Submit" />
       <input type="submit" name="load_data" value="Load Data" />
 </form>
 <?php
	    $host = "serversubmission1.database.windows.net";
	    $user = "dicoding";
	    $pass = "poseidon123.";
	    $db = "databasesubmission1";
  
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:serversubmission1.database.windows.net,1433; Database = databasesubmission1", "dicoding", "{poseidon123.}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
    if (isset($_POST['submit'])) {
        try {
            $namalengkap = $_POST['namalengkap'];
            $asalkampus = $_POST['asalkampus'];
            $prodi = $_POST['prodi'];
            ##$email = $_POST['email'];
	    $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO Registration (namalengkap, asalkampus, prodi, date) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $namalengkap);
            $stmt->bindValue(2, $asalkampus);
            $stmt->bindValue(3, $prodi);
            ##$stmt->bindValue(4, $email);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Anda Telah Terdaftar !</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>Daftar Peserta Seminar Informatika ITK 2019 :</h2>";
                echo "<table>";
                echo "<tr><th>Nama Lengkap</th>";
                echo "<th>Asal Kampus</th>";
                echo "<th>Prodi</th>";
                ##echo "<th>Email</th></tr>";
		echo "<th>Date</th></tr>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['namalengkap']."</td>";
                    echo "<td>".$registrant['asalkampus']."</td>";
                    echo "<td>".$registrant['prodi']."</td>";
                    ##echo "<td>".$registrant['email']."</td></tr>";
		    echo "<td>".$registrant['date']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>Tidak ada yang terdaftar.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>
