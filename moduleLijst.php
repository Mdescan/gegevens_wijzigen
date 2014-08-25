<?php
require_once ("module.php");

class ModuleLijst{
    
    private $dbConn;
    private $dbUsername;
    private $dbPassword;
    
    public function __construct() {
        $this->dbConn ="mysql:host=localhost;dbname=cursusphp";
        $this->dbUsername = "cursusgebruiker";
        $this->dbPassword = "cursuspwd";
    }
    
    public function getLijst(){
        $Lijst = array();
        $sql = "select id,naam,prijs from modules order by naam";
        $dbh= new PDO($this->dbConn,  $this->dbUsername, $this->dbPassword);
        $resultSet = $dbh->query($sql);
        foreach($resultSet as $rij){
            $module = new module($rij["id"],$rij["naam"],$rij["prijs"]);
            array_push($Lijst, $module);
        }
        $dbh = null;
        return $Lijst;
    }
    
    public function getModuleById($id){
        $sql = "select naam,prijs form modules where id = ".$id;
        $dbh= new PDO($this->dbConn,  $this->dbUsername, $this->dbPassword);
        $resultSet = $dbh->query($sql);
        if ($resultSet){
            $rij = $resultSet->fetch();
            if($rij){
                $module = new module($id,$rij["naam"],$rij["prijs"]);
                $dbh = null;
                return $module;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
    public function updateModule($module){
        $sql ="update modules set naam:'".$module->getNaam()."',prijs =".$module->getPrijs()."where id =".$module->getId();
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $dbh->exec($sql);
        $dbh = null;
    }
}

