<?php

$host = "127.0.0.1";
$port = 25003;
$message = "Hello Server";
//echo "Message To server :" . $message;
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// connect to server
$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n"); //127.0.0.1:25003 portuna bağlanıyoruz.


// send string to server
socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n"); //sunucuya data yolladık
// get server response
$result = socket_read($socket, 1024) or die("Could not read server response\n");  //sunucudan bize donen response değerini aldık
echo "<pre>";
$result = explode('|', $result);
print_r($result);


// close socket
socket_close($socket); //ve bağlantıyı kapattık...
?>