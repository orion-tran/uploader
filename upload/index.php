<html>
	<head>
		<title>upload file</title>
		<link rel="icon" href="../favicon.ico" type="image/x-icon"/>
		<style>
		#main{
			background-color: #23272a;
		}
		#cen{
			border-radius: 25px;
			background: #2C2F33;
			padding: 20px; 
			width: 45%;
			height: 45%; 
			margin: auto;
			margin-top: 15%;
			background-image: url("cloud.png");
			background-repeat: no-repeat;
			background-position: center; 
		}
		#und{
			margin: auto;
			text-align: center;
			color: #ffffff;
			font-family: Arial;
		}
		#spl{
			margin: auto;
			text-align: center;
			color: #ffffff;
			font-family: Arial;
		}
		form input{
			position: absolute;
			margin: 0;
			padding: 0;
			width: 45%;
			height: 45%;
			outline: none;
			opacity: 0;
		}
		a:link {
			color: skyblue;
		}

		a:visited {
			color: skyblue;
		}

		a:hover {
			color: limegreen;
		}

		a:active {
			color: limegreen;
		}
		</style>
	</head>
	<body id="main">
		<form action="../upload/" method="POST" enctype="multipart/form-data" id="ularea">
			<div id="cen">
				<input type="file" name="fileToUpload" id="ulinp" multiple>
			</div>
			<div id="und">
				<br/>
				<p>drag and drop or click to select a file above</p>
			</div>
		</form>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
		<script>
			$('#ulinp').change(function() {
				$('#ularea').submit();
			});
		</script>
	</body>
</html>
<?php
if(isset($_FILES["fileToUpload"])){
	function generateRandomString($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	$uid = generateRandomString(4) . "-" . generateRandomString(4);
	$target_dir = "../" . $uid . "/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if(isset($_POST["submit"])) {
		$uploadOk = 1;
	}
	if (file_exists($target_file)) {
		echo "<p id='spl'>sorry, file already exists.</p>";
		$uploadOk = 0;
	}
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
		echo "<p id='spl'>sorry, your file is too large.</p>";
		$uploadOk = 0;
	}
	if($fileType == "php") {
		echo "<p id='spl'>sorry, php is disallowed.</p>";
		$uploadOk = 0;
	}
	if($fileType == "html") {
		echo "<p id='spl'>sorry, html is disallowed.</p>";
		$uploadOk = 0;
	}
	if($fileType == "htm") {
		echo "<p id='spl'>sorry, htm is disallowed.</p>";
		$uploadOk = 0;
	}
	if($fileType == "jsp") {
		echo "<p id='spl'>sorry, jsp is disallowed.</p>";
		$uploadOk = 0;
	}
	if($fileType == "aspx") {
		echo "<p id='spl'>sorry, aspx is disallowed.</p>";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		echo "<p id='spl'>sorry, your file was not uploaded.</p>";
	} else {
		mkdir("../" . $uid . "/");
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "<p id='spl'>the file ". basename( $_FILES["fileToUpload"]["name"]) . " has been uploaded. <a href='../" . $uid . "/" . basename( $_FILES["fileToUpload"]["name"]) . "'>link.</a> upload another: <a href='' onclick='location.reload();'>here</a></p>";
		} else {
			echo "<p id='spl'>sorry, there was an error uploading your file.</p>";
		}
	}
}
?>
