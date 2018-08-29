<?php
require_once("../db/Database.php");
require_once("../interfaces/ICentroInvestigacion.php");


class CentroInvestigacion implements ICentroInvestigacion{

    private $con;
    private $id_centro;
    private $name_centro;
    private $telefono;
    private $id_ciu;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }


    public function setId($id_centro)
    {
        $this->id_centro = $id_centro;
    }


    public function setUsername($name_centro)
    {
        $this->name_centro = $name_centro;
    }


    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }


    public function setIDR($id_ciu)
    {
        $this->id_ciu = $id_ciu;
    }

    //insertamos centros en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO CENTRO_INVESTIGACION (id_centro, name_centro, telefono, id_ciu) values (?,?,?,?)');
 $query->bindParam(1, $this->id_centro, PDO::PARAM_INT);
 $query->bindParam(2, $this->name_centro, PDO::PARAM_STR);
 $query->bindParam(3, $this->telefono, PDO::PARAM_INT);
 $query->bindParam(4, $this->id_ciu, PDO::PARAM_INT);
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
 $query = $this->con->prepare('UPDATE CENTRO_INVESTIGACION SET  name_centro = ?, telefono = ?, id_ciu = ?  WHERE id_centro = ?');
 
 
 $query->bindParam(4, $this->id_centro, PDO::PARAM_INT);
 $query->bindParam(1, $this->name_centro, PDO::PARAM_STR);
 $query->bindParam(2, $this->telefono, PDO::PARAM_INT);
 $query->bindParam(3, $this->id_ciu, PDO::PARAM_INT);
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
            if(is_int($this->id_centro))
            {
                $query = $this->con->prepare('SELECT * FROM CENTRO_INVESTIGACION WHERE id_centro = ?');
                $query->bindParam(1, $this->id_centro, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM CENTRO_INVESTIGACION');
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
         $query = $this->con->prepare('DELETE FROM CENTRO_INVESTIGACION WHERE id_centro = ?');
         $query->bindParam(1, $this->id_centro, PDO::PARAM_INT);
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
         header("Location:" . CentroInvestigacion::baseurl() . "/list.php");
     }
 }


}