<?php 
require_once("monae.class.php");

try {
	$monae = new MonAE('email', 'firmid','login','motdepasse');

	var_dump($monae->getCustomers());

	echo "test";

} catch(MonaeException $e) {
	echo $e->getMessage();
}
?>