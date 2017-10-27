<?php 

require "db.php";

unset($_SESSION['logged-user']);

header('Location: /');