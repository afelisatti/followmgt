<?
	session_start();
	
	define("APP_KEY", "nG7Ia1gvelA2icZI4KOyp8DoKsgRJ7x28zCqVaeqEMKkTYzjW3");
	define("APP_SECRET", "FX3KyHJfIeKf9WMfAQjiEiX8jM8zs5FH3Fw2vFIN8DRHuIFPcI");
	
	define("CALLBACK", "http://felisatti.com.ar/anita/followMGT/callback.php");
	
	require_once("tumblroauth/OAuth.php");
	require_once("tumblroauth/tumblroauth.php");
	require_once("followmgt.php");
	
?>