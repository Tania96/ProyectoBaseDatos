<?php
require_once("../db/Database.php");
require_once("../interfaces/IAreaConocimiento.php");

class AreaConocimiento implements IAreaConocimiento{

    private $con;
    private $id_area;
    private $descrip_area;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_area)
    {
        $this->id_area = $id_area;
    }
 
    public function setUsername($descrip_area)
    {
        $this->descrip_area = $descrip_area;
    }

    //insertamos areas en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO AREA_CONOCIMIENTO (id_area, descrip_area) values (?,?)');
 $query->bindParam(1, $this->id_area, PDO::PARAM_INT);
 $query->bindParam(2, $this->descrip_area, PDO::PARAM_STR);
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
 $query = $this->con->prepare('UPDATE AREA_CONOCIMIENTO SET  descrip_area = ? WHERE id_area = ?');
 
 $query->bindParam(1, $this->descrip_area, PDO::PARAM_STR);
 $query->bindParam(2, $this->id_area, PDO::PARAM_INT);
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
            if(is_int($this->id_area))
            {
                $query = $this->con->prepare('SELECT * FROM AREA_CONOCIMIENTO WHERE id_area = ?');
                $query->bindParam(1, $this->id_area, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM AREA_CONOCIMIENTO');
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
         $query = $this->con->prepare('DELETE FROM AREA_CONOCIMIENTO WHERE id_area = ?');
         $query->bindParam(1, $this->id_area, PDO::PARAM_INT);
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
         header("Location:" . AreaConocimiento::baseurl() . "/list.php");
     }
 }


}