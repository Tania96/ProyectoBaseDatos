<?php
require_once("../db/Database.php");
require_once("../interfaces/IConferencia.php");

class Conferencia implements IConferencia{

    private $con;
    private $id_conf;
    private $name_conf;
    private $fecha_ini_conf;
    private $fecha_fin_conf;
    private $pais;
    private $name_resp;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_conf)
    {
        $this->id_conf = $id_conf;
    }
 
    public function setUsername($name_conf)
    {
        $this->name_conf = $name_conf;
    }

    public function setFini($fecha_ini_conf)
    {
        $this->fecha_ini_conf = $fecha_ini_conf;
    }

    public function setFin($fecha_fin_conf)
    {
        $this->fecha_fin_conf = $fecha_fin_conf;
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    public function setResp($name_resp)
    {
        $this->name_resp = $name_resp;
    }

    //insertamos regiones en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO CONFERENCIA (id_conf, name_conf, fecha_ini_conf, fecha_fin_conf, pais, name_resp) values (?,?,?,?,?,?)');
 $query->bindParam(1, $this->id_conf, PDO::PARAM_INT);
 $query->bindParam(2, $this->name_conf, PDO::PARAM_STR);
 $query->bindParam(3, $this->fecha_ini_conf, PDO::PARAM_STR);
 $query->bindParam(4, $this->fecha_fin_conf, PDO::PARAM_STR);
 $query->bindParam(5, $this->pais, PDO::PARAM_STR);
 $query->bindParam(6, $this->name_resp, PDO::PARAM_STR);
 $query->execute();
 $this->con->close();
 }
        catch(PDOException $e)
        {   
         echo  $e->getMessage();
     }
 }

 public function update()
 {
 try{
 $query = $this->con->prepare('UPDATE CONFERENCIA SET  name_conf = ?, fecha_ini_conf = ?, fecha_fin_conf = ?, pais = ?, name_resp = ? WHERE id_conf = ?');
 
 $query->bindParam(1, $this->name_conf, PDO::PARAM_STR);
 $query->bindParam(2, $this->fecha_ini_conf, PDO::PARAM_STR);
 $query->bindParam(3, $this->fecha_fin_conf, PDO::PARAM_STR);
 $query->bindParam(4, $this->pais, PDO::PARAM_STR);
 $query->bindParam(5, $this->name_resp, PDO::PARAM_STR);
 $query->bindParam(6, $this->id_conf, PDO::PARAM_INT);
 $query->execute();
 $this->con->close();
 }
        catch(PDOException $e)
        {
         echo  $e->getMessage();
     }
 }

 //obtenemos usuarios de una tabla con postgreSql
 public function get()
 {
 try{
            if(is_int($this->id_conf))
            {
                $query = $this->con->prepare('SELECT * FROM CONFERENCIA WHERE id_conf = ?');
                $query->bindParam(1, $this->id_conf, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM CONFERENCIA');
     $query->execute();
     $this->con->close();
     return $query->fetchAll(PDO::FETCH_OBJ);
            }
 }
        catch(PDOException $e)
        {
         echo  $e->getMessage();
     }
 }

  
 public function delete()
 {
     try{
         $query = $this->con->prepare('DELETE FROM CONFERENCIA WHERE id_conf = ?');
         $query->bindParam(1, $this->id_conf, PDO::PARAM_INT);
         $query->execute();
         $this->con->close();
         return true;
     }
     catch(PDOException $e)
     {
         echo  $e->getMessage();
     }
 }

 
 public static function baseurl()
 {
      return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/php/crudpgsql/";
 }

 public function checkUser($region)
 {
     if( ! $region )
     {
         header("Location:" . Conferencia::baseurl() . "/list.php");
     }
 }


}