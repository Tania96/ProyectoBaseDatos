<?php
require_once("../db/Database.php");
require_once("../interfaces/IRevista.php");


class Revista implements IRevista{

    private $con;
    private $id_rev;
    private $name_rev;
    private $name_edit;
    private $fact_impacto;
    private $id_cat_rev;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_rev)
    {
        $this->id_rev = $id_rev;
    }

    public function setIDR($id_cat_rev){

        $this->id_cat_rev = $id_cat_rev;
    }

    public function setEdit($name_edit)
    {
        $this->name_edit = $name_edit;
    }

    public function setFact($fact_impacto)
    {
        $this->fact_impacto = $fact_impacto;
    }

    public function setUsername($name_rev)
    {
        $this->name_rev = $name_rev;
    }

    //insertamos ciudades en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO REVISTA (id_rev, name_rev, name_edit, fact_impacto, id_cat_rev) values (?,?,?,?,?)');
 $query->bindParam(1, $this->id_rev, PDO::PARAM_INT);
 $query->bindParam(2, $this->name_rev, PDO::PARAM_STR);
 $query->bindParam(3, $this->name_edit, PDO::PARAM_STR);
 $query->bindParam(4, $this->fact_impacto, PDO::PARAM_STR);
 $query->bindParam(5, $this->id_cat_rev, PDO::PARAM_INT);
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
 $query = $this->con->prepare('UPDATE REVISTA SET name_rev = ?, name_edit = ?, fact_impacto = ?, id_cat_rev = ?  WHERE id_rev = ?');
 
 $query->bindParam(1, $this->name_rev, PDO::PARAM_STR);
 $query->bindParam(2, $this->name_edit, PDO::PARAM_STR);
 $query->bindParam(3, $this->fact_impacto, PDO::PARAM_STR);
 $query->bindParam(4, $this->id_cat_rev, PDO::PARAM_INT);
 $query->bindParam(5, $this->id_rev, PDO::PARAM_INT);
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
            if(is_int($this->id_rev))
            {
                $query = $this->con->prepare('SELECT * FROM REVISTA WHERE id_rev = ?');
                $query->bindParam(1, $this->id_rev, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM REVISTA');
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
         $query = $this->con->prepare('DELETE FROM REVISTA WHERE id_rev = ?');
         $query->bindParam(1, $this->id_rev, PDO::PARAM_INT);
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
         header("Location:" . Revista::baseurl() . "/list.php");
     }
 }


}