<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título555</title>
</head>

<body>
	
	<form action="testeCriarPasta.php" method="post">
		<label>Nome da pasta</label>
		<input name="nomePasta">
		<button type="submit">Criar Pasta</button>
	</form>
	<HR/>
	<?php
$ip_address = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

// Get JSON object
$jsondata = file_get_contents("http://timezoneapi.io/api/ip/?" . $ip_address);

// Decode
$data = json_decode($jsondata, true);
eco $data;
// Request OK?
if($data['meta']['code'] == '200'){

    // Example: Get the city parameter
    echo "City: " . $data['data']['city'] . "<br>";

    // Example: Get the users time
    echo "Time: " . $data['data']['datetime']['date_time_txt'] . "<br>";

}
	

// Retorna o domínio do servidor
echo $_SERVER['SERVER_NAME'] . "<br />";
// Retorna o path do arquivo onde está sendo executado
echo $_SERVER['PHP_SELF'] . "<br />";
// Retorna o path do pasta onde está sendo executado
echo $_SERVER['DOCUMENT_ROOT'] . "<br />";
// Retorna o path do arquivo onde está sendo executado o script
echo $_SERVER['SCRIPT_FILENAME'] . "<br />";
// Retorna o path e nome do arquivo que está executando
echo $_SERVER['SCRIPT_NAME'] . "<br />";
 
echo "<hr >";
$path = $_SERVER['SCRIPT_FILENAME'];
$path_parts = pathinfo($path);
// retorna o path absoluto do diretório no servidor
echo $path_parts['dirname'] . "<br />";
// retorna o nome do arquivo com extensão
echo $path_parts['basename'] . "<br />";
// retorna a extensão do arquivo
echo $path_parts['extension'] . "<br />";
// retorna o nome do arquivo sem extensão
echo $path_parts['filename'] . "<br />";
	?>
</body>
</html>