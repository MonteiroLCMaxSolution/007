<?php
$variavel = '23,24,25,26';
$variavel = explode(',',$variavel);
echo $count =  count($variavel);
$countStart = 0;
while($count != $countStart){
	echo "<BR/>".$variavel[$countStart];
	$countStart++;
}


?>