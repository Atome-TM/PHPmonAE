<?php 
require_once("monae.class.php");

try {
	$monae = new MonAE("22260","21791","kTBeMXjFh9P1q4DKXJ4M");

	print_r($monae->getCustomers());
} catch(MonaeException $e) {
	echo $e->getMessage();
}
?>