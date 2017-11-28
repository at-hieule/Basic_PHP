<?php
session_start();
if (session_destroy()) 
    header('Location:login.php');
else
    echo "KO thể thoát dc, có lỗi trong việc hủy session";
?>