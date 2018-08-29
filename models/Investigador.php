<?php
require_once("../db/Database.php");
require_once("../interfaces/IInvestigador.php");


class Investigador implements IInvestigador{

    private $con;
    private $id_inv;
    private $rut_inv;
    private $name_inv;
    private $calle_inv;
    private $numero_inv;
    private $id_cat;
    private $id_ciu;
    private $id_rol;
    
    public function __construct(Database $db)
    {
    $this->con = new $db;
    }

    public function setId($id_inv){
        $this->id_inv = $id_inv;
    }

    public function setRUT($rut_inv)
    {
        $this->rut_inv = $rut_inv;
    }

    public function setIDC($id_cat){

        $this->id_cat = $id_cat;
    }
 
    public function setIDCIU($id_ciu){

        $this->id_ciu = $id_ciu;
    }

    public function setIDR($id_rol){

        $this->id_rol = $id_rol;
    }
 
    public function setUsername($name_inv)
    {
        $this->name_inv = $name_inv;
    }

    public function setCalle($calle_inv)
    {
        $this->calle_inv = $calle_inv;
    }

    public function setNumber($numero_inv)
    {
        $this->numero_inv = $numero_inv;
    }
    //insertamos investigadores en una tabla con postgreSql
 public function save()
 {
 try{
 $query = $this->con->prepare('INSERT INTO INVESTIGADOR (id_inv,rut_inv, name_inv, calle_inv, numero_inv, id_cat, id_ciu, id_rol) values (?,?,?,?,?,?,?,?)');
 $query->bindParam(1, $this->id_inv, PDO::PARAM_INT);
 $query->bindParam(2, $this->rut_inv, PDO::PARAM_STR);
 $query->bindParam(3, $this->name_inv, PDO::PARAM_STR);
 $query->bindParam(4, $this->calle_inv, PDO::PARAM_STR);
 $query->bindParam(5, $this->numero_inv, PDO::PARAM_INT);
 $query->bindParam(6, $this->id_cat, PDO::PARAM_INT);
 $query->bindParam(7, $this->id_ciu, PDO::PARAM_INT);
 $query->bindParam(8, $this->id_rol, PDO::PARAM_INT);
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
 $query = $this->con->prepare('UPDATE INVESTIGADOR SET  rut_inv = ?,name_inv = ?, calle_inv = ?, numero_inv = ?, id_cat = ?, id_ciu = ?, id_rol = ?  WHERE id_inv = ?');
 
 $query->bindParam(1, $this->rut_inv, PDO::PARAM_STR);
 $query->bindParam(2, $this->name_inv, PDO::PARAM_STR);
 $query->bindParam(3, $this->calle_inv, PDO::PARAM_STR);
 $query->bindParam(4, $this->numero_inv, PDO::PARAM_INT);
 $query->bindParam(5, $this->id_cat, PDO::PARAM_INT);
 $query->bindParam(6, $this->id_ciu, PDO::PARAM_INT);
 $query->bindParam(7, $this->id_rol, PDO::PARAM_INT);
 $query->bindParam(8, $this->id_inv, PDO::PARAM_INT);

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
            if(is_int($this->id_inv))
            {
                $query = $this->con->prepare('SELECT * FROM INVESTIGADOR WHERE id_inv = ?');
                $query->bindParam(1, $this->id_inv, PDO::PARAM_INT);
                $query->execute();
     $this->con->close();
     return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM INVESTIGADOR');
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
         $query = $this->con->prepare('DELETE FROM INVESTIGADOR WHERE id_inv = ?');
         $query->bindParam(1, $this->id_inv, PDO::PARAM_INT);
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

 public function checkUser($investigador)
 {
     if( ! $investigador )
     {
         header("Location:" . Investigador::baseurl() . "/list.php");
     }
 }


}