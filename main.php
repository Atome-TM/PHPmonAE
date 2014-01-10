<?php 
require_once("monae.class.php");

try {
	$monae = new MonAE('mail@example.com', 'FIRMID','LOGIN','PASSWORD');

	print_r($monae->getCustomers());
} catch(MonaeException $e) {
	echo $e->getMessage();
}
?>