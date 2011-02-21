<? 
$ref = getenv("HTTP_REFERER"); 

session_start();
session_destroy();

	header("location:" . $ref);

?>