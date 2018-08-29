<?php
require_once("../db/Database.php");
require_once("../interfaces/IArticulo.php");

class Articulo implements IArticulo{

    private $con;
    private $id_art;
    private $titulo_art;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_art)
    {
        $this->id_art = $id_art;
    }
 
    public function setUsername($titulo_art)
    {
        $this->titulo_art = $titulo_art;
    }

    //insertamos categorias en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO ARTICULO (id_art, titulo_art) values (?,?)');
 $query->bindParam(1, $this->id_art, PDO::PARAM_INT);
 $query->bindParam(2, $this->titulo_art, PDO::PARAM_STR);
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
 $query = $this->con->prepare('UPDATE ARTICULO SET  titulo_art = ? WHERE id_art = ?');
 
 $query->bindParam(1, $this->titulo_art, PDO::PARAM_STR);
 $query->bindParam(2, $this->id_art, PDO::PARAM_INT);
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
            if(is_int($this->id_art))
            {
                $query = $this->con->prepare('SELECT * FROM ARTICULO WHERE id_art = ?');
                $query->bindParam(1, $this->id_art, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM ARTICULO');
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
         $query = $this->con->prepare('DELETE FROM ARTICULO WHERE id_art = ?');
         $query->bindParam(1, $this->id_art, PDO::PARAM_INT);
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
         header("Location:" . Articulo::baseurl() . "/list.php");
     }
 }


}