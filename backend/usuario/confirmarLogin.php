<?php
session_start();

if (isset($_SESSION["loggedin"])) {
    header("location: http://localhost/Projeto_SUS/");
}

?>