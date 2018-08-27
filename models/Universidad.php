<?php
require_once("../db/Database.php");
require_once("../interfaces/IUniversidad.php");


class Universidad implements IUniversidad{

    private $con;
    private $id_u;
    private $name_u;
    private $id_ciu;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_u)
    {
        $this->id_u = $id_u;
    }

    public function setIDR($id_ciu){

        $this->id_ciu = $id_ciu;
    }
 
    public function setUsername($name_u)
    {
        $this->name_u = $name_u;
    }

    //insertamos ciudades en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO UNIVERSIDAD (id_u, name_u,id_ciu) values (?,?,?)');
 $query->bindParam(1, $this->id_u, PDO::PARAM_INT);
 $query->bindParam(2, $this->name_u, PDO::PARAM_STR);
 $query->bindParam(3, $this->id_ciu, PDO::PARAM_INT);
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
 $query = $this->con->prepare('UPDATE UNIVERSIDAD SET name_u = ?, id_ciu = ?  WHERE id_u = ?');
 
 
 $query->bindParam(1, $this->name_u, PDO::PARAM_STR);
 $query->bindParam(2, $this->id_ciu, PDO::PARAM_INT);
 $query->bindParam(3, $this->id_u, PDO::PARAM_INT);
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
            if(is_int($this->id_u))
            {
                $query = $this->con->prepare('SELECT * FROM UNIVERSIDAD WHERE id_u = ?');
                $query->bindParam(1, $this->id_u, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM UNIVERSIDAD');
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
         $query = $this->con->prepare('DELETE FROM UNIVERSIDAD WHERE id_u = ?');
         $query->bindParam(1, $this->id_u, PDO::PARAM_INT);
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
         header("Location:" . Universidad::baseurl() . "/list.php");
     }
 }


}