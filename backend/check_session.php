<?php 
    if(!isset($_SESSION['id'])) {
        header("Location: ../auth/login.php ");
    }
