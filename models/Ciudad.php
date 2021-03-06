<?php
require_once("../db/Database.php");
require_once("../interfaces/ICiudad.php");


class Ciudad implements ICiudad{

    private $con;
    private $id_ciu;
    private $name_ciu;
    private $id_reg;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_ciu)
    {
        $this->id_ciu = $id_ciu;
    }

    public function setIDR($id_reg){

        $this->id_reg = $id_reg;
    }
 
    public function setUsername($name_ciu)
    {
        $this->name_ciu = $name_ciu;
    }

    //insertamos ciudades en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO CIUDAD (id_ciu, name_ciu,id_reg) values (?,?,?)');
 $query->bindParam(1, $this->id_ciu, PDO::PARAM_INT);
 $query->bindParam(2, $this->name_ciu, PDO::PARAM_STR);
 $query->bindParam(3, $this->id_reg, PDO::PARAM_INT);
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
 $query = $this->con->prepare('UPDATE CIUDAD SET name_ciu = ?, id_reg = ?  WHERE id_ciu = ?');
 
 
 $query->bindParam(1, $this->name_ciu, PDO::PARAM_STR);
 $query->bindParam(2, $this->id_reg, PDO::PARAM_INT);
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
            if(is_int($this->id_ciu))
            {
                $query = $this->con->prepare('SELECT * FROM CIUDAD WHERE id_ciu = ?');
                $query->bindParam(1, $this->id_ciu, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM CIUDAD');
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
         $query = $this->con->prepare('DELETE FROM CIUDAD WHERE id_ciu = ?');
         $query->bindParam(1, $this->id_ciu, PDO::PARAM_INT);
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
         header("Location:" . Ciudad::baseurl() . "/list.php");
     }
 }


}