<?php
require_once("../db/Database.php");
require_once("../interfaces/IRol.php");

class Rol implements IRol{

    private $con;
    private $id_rol;
    private $descrip_rol;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_rol)
    {
        $this->id_rol = $id_rol;
    }
 
    public function setUsername($descrip_rol)
    {
        $this->descrip_rol = $descrip_rol;
    }

    //insertamos roles en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO ROL (id_rol, descrip_rol) values (?,?)');
 $query->bindParam(1, $this->id_rol, PDO::PARAM_INT);
 $query->bindParam(2, $this->descrip_rol, PDO::PARAM_STR);
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
 $query = $this->con->prepare('UPDATE ROL SET  descrip_rol = ? WHERE id_rol = ?');
 
 $query->bindParam(1, $this->descrip_rol, PDO::PARAM_STR);
 $query->bindParam(2, $this->id_rol, PDO::PARAM_INT);
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
            if(is_int($this->id_rol))
            {
                $query = $this->con->prepare('SELECT * FROM ROL WHERE id_rol = ?');
                $query->bindParam(1, $this->id_rol, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM ROL');
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
         $query = $this->con->prepare('DELETE FROM ROL WHERE id_rol = ?');
         $query->bindParam(1, $this->id_rol, PDO::PARAM_INT);
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
         header("Location:" . Rol::baseurl() . "/list.php");
     }
 }


}