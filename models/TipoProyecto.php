<?php
require_once("../db/Database.php");
require_once("../interfaces/ITipoProyecto.php");

class TipoProyecto implements ITipoProyecto{

    private $con;
    private $id_tipo;
    private $descrip_tipo;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_tipo)
    {
        $this->id_tipo = $id_tipo;
    }
 
    public function setUsername($descrip_tipo)
    {
        $this->descrip_tipo = $descrip_tipo;
    }

    //insertamos tipos en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO TIPO_PROYECTO (id_tipo, descrip_tipo) values (?,?)');
 $query->bindParam(1, $this->id_tipo, PDO::PARAM_INT);
 $query->bindParam(2, $this->descrip_tipo, PDO::PARAM_STR);
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
 $query = $this->con->prepare('UPDATE TIPO_PROYECTO SET  descrip_tipo = ? WHERE id_tipo = ?');
 
 $query->bindParam(1, $this->descrip_tipo, PDO::PARAM_STR);
 $query->bindParam(2, $this->id_tipo, PDO::PARAM_INT);
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
            if(is_int($this->id_tipo))
            {
                $query = $this->con->prepare('SELECT * FROM TIPO_PROYECTO WHERE id_tipo = ?');
                $query->bindParam(1, $this->id_tipo, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM TIPO_PROYECTO');
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
         $query = $this->con->prepare('DELETE FROM TIPO_PROYECTO WHERE id_tipo = ?');
         $query->bindParam(1, $this->id_tipo, PDO::PARAM_INT);
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
         header("Location:" . TipoProyecto::baseurl() . "/list.php");
     }
 }


}