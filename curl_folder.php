<?php
// VERIFICAR O STATUS DO PAGAMENTO - LEÔNIDAS MONTEIRO - 12/01/2022

if ( !empty( $_GET[ 'payment_status' ] ) ) {
	
  $result = array( 'code' => '2', 'message' => 'ooi');
    echo json_encode( $result );
    exit();
}
// .VERIFICAR O STATUS DO PAGAMENTO 
if ( !empty( $_GET[ 'valid_folder' ] ) ) {
  $folder = $_GET[ 'folder' ];
  $platform = $_SERVER[ 'SERVER_NAME' ];
  $curl = curl_init();
  curl_setopt_array( $curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://lcmaxsolution.com.br/Help-Desk/controllers/WS/MaxComanda/validarPasta.php/?valid_folder=1&folder=' . $folder . '&platform=' . $platform
  ] );
  $response = curl_exec( $curl );
  echo $response;
  curl_close( $curl );
}
if ( !empty( $_GET[ 'btnRecord' ] ) ) {

	$dados = array(
	'CNPJ_CPF' => $_GET[ 'CNPJ_CPF' ],
	'folder' => $_GET[ 'folder' ],
	'folders' => $_GET[ 'folders' ],
	'platform' => $_SERVER['SERVER_NAME'],
	'name_contact' => $_GET[ 'name_contact' ],
	'mail_contact' => $_GET[ 'mail_contact' ],
	'whatsapp' => $_GET[ 'whatsapp' ],
	'CEP' => $_GET[ 'CEP' ],
);
  	
 $curl = curl_init();
  curl_setopt_array( $curl, [CURLOPT_HTTPGET => false,
    CURLOPT_RETURNTRANSFER => 1,CURLOPT_POSTFIELDS => $dados, CURLOPT_URL => 'https://lcmaxsolution.com.br/Help-Desk/controllers/WS/MaxComanda/validarPasta.php/?btnRecord=1'
  ] );
  $response = curl_exec( $curl );
  echo $response;
  curl_close( $curl );
	//*******************************************
	

}
?>