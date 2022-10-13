<?php

try{

    $pdo = new PDO("mysql:dbname=PDOTESTE;host=localhost","root","");

}catch(Exeption $e){
    echo $e;

}


try{
    $insert = $pdo->prepare("INSERT INTO WOS (WO,NS,NCTS) 
                                        VALUE(:wo,:ns,:ncts)");
    $insert->bindValue("wo","WO0001");
    $insert->bindValue("ns","12:00");
    $insert->bindValue("ncts","2022-10-22");
    
    $insert->execute();
    
    $consulta = $pdo->prepare("SELECT * FROM WOS");
    $consulta->execute();
    $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
    // print_r($result);

    foreach ($result as $key => $value) {
        echo var_dump($value["WO"]);
        echo "<BR>";
    }
    

    // $delete = $pdo->prepare("DELETE FROM WOS");  
    // $delete->execute();

}catch(Exeption $e){
    echo $e;

}



?>

