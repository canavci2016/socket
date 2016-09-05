<?php
// set some variables
$host = "127.0.0.1";
$port = 25003;
// don't timeout!
set_time_limit(0);
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
// bind socket to port
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n"); //oluşturulan socketi sunucumuzun portuna bağladık..
// start listening for connections
$result = socket_listen($socket, 5) or die("Could not set up socket listener\n"); // sokcetimiz şuanda dinlemeye başladı..
// accept incoming connections
// spawn another socket to handle communication
while ($spawn = socket_accept($socket) or die("Could not accept incoming connection\n")) {  //bağlantımızı sınırsız sureli açık tututtak..yani her sockete cevap verir durumdayız.
// read client input
    $input = socket_read($spawn, 1024) or die("Could not read input\n"); //bağlantı açan kişinin yolladığı verileri aldık $spawn ile
    // clean up input string
    $input = trim($input);
    echo "Client Message : " . $input;
    // reverse client input and send back
    $output = strrev($input) . "\n";

    socket_write($spawn, $output, strlen($output)) or die("Could not write output\n"); //bağlantı açan kişiye cevap verelim
    socket_close($spawn); //bağlantıyı bu kişi ile keselim

}

//hatalı bir durum olduğunda servis otomatik oalrak connection kapatır...




// close sockets
socket_close($socket);

?>