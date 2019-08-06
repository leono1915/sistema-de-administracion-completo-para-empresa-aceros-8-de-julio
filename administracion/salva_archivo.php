<?php

require_once('vendor/autoload.php');
$file_name = $_FILES['archivo']['name'];	//Nombre real del archivo
$file_tmp  = $_FILES['archivo']['tmp_name'];//Nombre temporal del archivo
$cadena    = explode(".", $file_name);		//Separa el nombre para obtener la extension
$ext       = $cadena[1];					//Extension
$dir       = "archivos/";					//carpeta donde se guardan los archivos
//$file_enc  = md5_file($file_tmp);			//Nombre del archivo encriptado


echo "file_name: $file_name <br>";
echo "file_tmp: $file_tmp <br>";
echo "ext: $ext <br>";
echo "file_enc: $file_enc <br>";






if ($file_name != '') {
	$fileName1  = "$file_name.$ext";	
	@copy($file_tmp, $dir.$fileName1);	
}

  
$mpdf= new \Mpdf\Mpdf([]);


$mpdf->writeHTML(' <form method="POST" action="salva_archivo.php"  enctype="multipart/form-data">
     
<input type="file" id="archivo" name="archivo">
<input type="submit" value="Upload Image" name="submit">

</form>');

$mpdf->Output('archi.pdf','I');
$mpdf->Output('archivos/archi2.pdf','F');




/*<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<li>
	<embed src="archivos/corcho1_17-03-2019.pdf.pdf" type="application/pdf" width="100%" height="600px" />
	</li>
</body>
</html>*/
?>

