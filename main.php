<?php 
require_once("monae.class.php");

try {
	$monae = new MonAE("FIRMID","LOGIN","PASSWORD");

	print_r($monae->getCustomers());
} catch(MonaeException $e) {
	echo $e->getMessage();
}
?>