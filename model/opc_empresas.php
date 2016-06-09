<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tarea_agenda
 *
 * @author Administrador
 */
class opc_empresas extends fs_model
{
   public $id;
   public $nombre;
   public $direccion;
   public $telefono;
   public $correo;
   public $ciudad;
   public $pais;
   public $exists;


public function __construct($t = FALSE)
    {
        parent::__construct('empresas', '/plugins/VentasMotos/');

        if ($t)
        {
            $this->id =$t['id'];
            $this->nombre = $t['nombre'];
            $this->direccion = $t['direccion'];
            $this->telefono = $t['telefono'];
            $this->correo = $t['correo'];
            $this->ciudad = $t['ciudad'];
            $this->pais = $t['pais'];

        }
        else
        {
            $this->id = NULL;
            $this->nombre = NULL;
            $this->direccion = NULL;
            $this->telefono = NULL;
            $this->correo = NULL;
            $this->ciudad = NULL;
            $this->pais = NULL;

        }
    }

    protected function install() {
        return '';
    }
     public function get($id) {

         $data = $this->db->select("SELECT * FROM empresas WHERE id= ".$this->var2str($id).";");

         if ($data)

         {
             return new opc_empresas($data[0]);
         }
         else
         {
             return FALSE;
         }

     }

  public function exists() {
       if (is_null($this->id)) {
           return FALSE;
       } else
           return $this->db->select("SELECT * FROM empresas WHERE id = ".$this->var2str($this->id).';');
   }



     public function save() {

         if ($this->exists()){

         $sql ="UPDATE empresas SET nombre = ".$this->var2str($this->nombre).
               ", direccion = ".$this->var2str($this->direccion).
               ", telefono = ".$this->var2str($this->telefono).
               ", correo = ".$this->var2str($this->correo).
               ", ciudad = ".$this->var2str($this->ciudad).
               ", pais = ".$this->var2str($this->pais).
               " WHERE id = ".$this->var2str($this->id).";";

       return $this->db->exec($sql);

         }
         else
         {

    $sql ="INSERT INTO empresas (nombre,direccion,telefono,correo,ciudad,pais) VALUES
                     (".$this->var2str($this->nombre).
                     ",".$this->var2str($this->direccion).
                      ",".$this->var2str($this->telefono).
                     ",".$this->var2str($this->correo).
                      ",".$this->var2str($this->ciudad).
                     ",".$this->var2str($this->pais).");";

    if ($this->db->exec($sql))

    {
        /// $this->id = $this->db->lastval();
         return TRUE;
    }
 else
    {
        return FALSE;
    }

         }
      }

     public function delete() {
         return $this->db->exec("DELETE FROM empresas WHERE id = "
                 .$this->var2str($this->id).";");
     }

     public function all() {

         $lista = array();

         $data= $this->db->select("SELECT * FROM empresas ORDER BY id ;");

         if ($data)
         {
             foreach ($data as $d)

                 $lista[] = new opc_empresas ($d);

         return $lista;
         }
     }

}
