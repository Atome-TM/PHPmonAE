PHPmonAE
========

Class PHP to work with the API of [Mon AE](http://monae.fr/ "Mon AE")

How to use?
-------------

You just have to include the file "monae.class.php" and create an instance of it.

<i>Example :</i>

<pre>
require_once("path/to/monae.class.php");
$monae = new MonAE("my firmid","my login","my password");
</pre>


Exceptions
-------------

You can get exceptions with the try/catch block like that :

<pre>
try {
	$monae = new MonAE("my firmid","my login","my password");
} catch(MonaeException $e) {
	echo $e->getMessage();
}
</pre>
