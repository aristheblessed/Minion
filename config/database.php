// PHP Data Objects(PDO) Sample Code:
try {
    $db = new PDO("sqlsrv:server = tcp:laptop-g4pdd4eo.database.windows.net,1433; Database = Minions", "minionAdmin", "Miniononthego123");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "minionAdmin@laptop-g4pdd4eo", "pwd" => "Miniononthego123", "Database" => "Minions", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:laptop-g4pdd4eo.database.windows.net,1433";
$db = sqlsrv_connect($serverName, $connectionInfo);
