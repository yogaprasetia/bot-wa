<?php
 session_start();
 session_destroy(); // menghapus session
 
 //setcookie( 'username' , '', time() + (86400 * 1), "/"); // 86400 = 1 day
 //setcookie( 'password' , '', time() + (86400 * 1), "/"); // 86400 = 1 day
 
 header("Location:../login"); // mengambalikan ke form_login.php
 ?>