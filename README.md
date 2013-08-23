PHPmonAE
========

Class PHP pour utiliser l'API de monAE.fr

How to use ?

You just have to include the file "monae.class.php" and create an instance of it.

Example :

require_once("monae.class.php");
$monae = new MonAE("my firmid","my login","my password");

You can get exceptions with the try/catch like that :

try {

	$monae = new MonAE("my firmid","my login","my password");

} catch(MonaeException $e) {

	echo $e->getMessage();

}