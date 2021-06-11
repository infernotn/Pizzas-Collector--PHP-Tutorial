<?php
// to connect to a database there are 2 methods: MySQLi and PD 
// connect to db
$conn=mysqli_connect('localhost','inferno','50626912','infernal_pizza');

// check connection
if(!$conn){
    echo 'connection error :'. mysqli_connect_error();
}
?>