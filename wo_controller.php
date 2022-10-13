<?php


class WoController {

    public function get_wo($wo,$con){
        try{
        $con->prepare("SELECT * FROM WOS WHERE WO = :wo");
        $con->bindValue(":wo",$wo);
        $con->execute();
        $result = $con->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    
        }catch(Exeption $e){
            return $e;
        }
    }
    
    public function get_all($con){
        try{
        $select = $con->prepare("SELECT * FROM WOS");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);        
    }catch(Exeption $e){
        return $e;
    }
    return $result;
    }
    
    public function insert_wo($wo,$con){
        try{
        $insert = $con->prepare("INSERT INTO WOS (WO,NS,NCTS)
                                 VALUES(:wo,:ns,:ncts)");
        $insert->bindValue("wo",$wo->get_wo());
        $insert->bindValue("ns",$wo->get_ns());
        $insert->bindValue("ncts",$wo->get_ncts());
        $insert->execute();
        
        return $con;
    
        }catch(Exeption $e){
            return $e;
        }
    }
    
    public function delete_wo($wo,$con){
        try{
        $delete = $con->prepare("DELETE FROM WOS WHERE ID = :wo");
        $delete->bindValue(":wo",$wo->get_wo());
        $delete->execute();
        
        return $con;
    
        }catch(Exeption $e){
            return $e;
        }
    }
    
    public function update_wo($wo,$con){
        try{
        $con->prepare("UPDATE WOS SET NS = :ns , NCTS = :ncts WHERE WO = :wo");
        $con->bindValue(":wo",$wo->wo);
        $con->bindValue(":ns",$wo->ns);
        $con->bindValue(":ncts",$wo->ncts);
        $con->execute();
        
        return $con;
    
        }catch(Exeption $e){
            return $e;
        }
    }
}

?>