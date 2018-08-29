<?php
require_once("../db/Database.php");
require_once("../interfaces/ICategoriaRevista.php");

class CategoriaRevista implements ICategoriaRevista{

    private $con;
    private $id_cat_rev;
    private $descrip_cat_rev;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_cat_rev)
    {
        $this->id_cat_rev = $id_cat_rev;
    }
 
    public function setUsername($descrip_cat_rev)
    {
        $this->descrip_cat_rev = $descrip_cat_rev;
    }

    //insertamos areas en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO CATEGORIA_REVISTA (id_cat_rev, descrip_cat_rev) values (?,?)');
 $query->bindParam(1, $this->id_cat_rev, PDO::PARAM_INT);
 $query->bindParam(2, $this->descrip_cat_rev, PDO::PARAM_STR);
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
 $query = $this->con->prepare('UPDATE CATEGORIA_REVISTA SET  descrip_cat_rev = ? WHERE id_cat_rev = ?');
 
 $query->bindParam(1, $this->descrip_cat_rev, PDO::PARAM_STR);
 $query->bindParam(2, $this->id_cat_rev, PDO::PARAM_INT);
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
            if(is_int($this->id_cat_rev))
            {
                $query = $this->con->prepare('SELECT * FROM CATEGORIA_REVISTA WHERE id_cat_rev = ?');
                $query->bindParam(1, $this->id_cat_rev, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM CATEGORIA_REVISTA');
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
         $query = $this->con->prepare('DELETE FROM CATEGORIA_REVISTA WHERE id_cat_rev = ?');
         $query->bindParam(1, $this->id_cat_rev, PDO::PARAM_INT);
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
         header("Location:" . CategoriaRevista::baseurl() . "/list.php");
     }
 }


}