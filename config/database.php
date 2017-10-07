<?php
try {
    $db = new PDO ('mysql:host=localhost; dbname=minions', 'root', '' );
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e ) {
    die('Error:' .$e->getMessage());
}