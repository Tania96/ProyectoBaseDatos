<?php
require_once("../db/Database.php");
require_once("../interfaces/IRegion.php");

class Region implements IRegion{

    private $con;
    private $id_reg;
    private $name_reg;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_reg)
    {
        $this->id_reg = $id_reg;
    }
 
    public function setUsername($name_reg)
    {
        $this->name_reg = $name_reg;
    }

    //insertamos regiones en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO REGION (id_reg, name_reg) values (?,?)');
 $query->bindParam(1, $this->id_reg, PDO::PARAM_INT);
 $query->bindParam(2, $this->name_reg, PDO::PARAM_STR);
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
 $query = $this->con->prepare('UPDATE REGION SET  name_reg = ? WHERE id_reg = ?');
 
 $query->bindParam(1, $this->name_reg, PDO::PARAM_STR);
 $query->bindParam(2, $this->id_reg, PDO::PARAM_INT);
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
            if(is_int($this->id_reg))
            {
                $query = $this->con->prepare('SELECT * FROM REGION WHERE id_reg = ?');
                $query->bindParam(1, $this->id_reg, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM REGION');
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
         $query = $this->con->prepare('DELETE FROM REGION WHERE id_reg = ?');
         $query->bindParam(1, $this->id_reg, PDO::PARAM_INT);
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
         header("Location:" . Region::baseurl() . "/list.php");
     }
 }


}