<?php
require_once("../db/Database.php");
require_once("../interfaces/ICategoria.php");

class Categoria implements ICategoria{

    private $con;
    private $id_cat;
    private $descrip_cat;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_cat)
    {
        $this->id_cat = $id_cat;
    }
 
    public function setUsername($descrip_cat)
    {
        $this->descrip_cat = $descrip_cat;
    }

    //insertamos categorias en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO CATEGORIA (id_cat, descrip_cat) values (?,?)');
 $query->bindParam(1, $this->id_cat, PDO::PARAM_INT);
 $query->bindParam(2, $this->descrip_cat, PDO::PARAM_STR);
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
 $query = $this->con->prepare('UPDATE CATEGORIA SET  descrip_cat = ? WHERE id_cat = ?');
 
 $query->bindParam(1, $this->descrip_cat, PDO::PARAM_STR);
 $query->bindParam(2, $this->id_cat, PDO::PARAM_INT);
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
            if(is_int($this->id_cat))
            {
                $query = $this->con->prepare('SELECT * FROM CATEGORIA WHERE id_cat = ?');
                $query->bindParam(1, $this->id_cat, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM CATEGORIA');
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
         $query = $this->con->prepare('DELETE FROM CATEGORIA WHERE id_cat = ?');
         $query->bindParam(1, $this->id_cat, PDO::PARAM_INT);
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
         header("Location:" . Categoria::baseurl() . "/list.php");
     }
 }


}