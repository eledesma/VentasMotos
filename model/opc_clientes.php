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
class opc_clientes extends fs_model
{
   public $id;
   public $nombre;
   public $cedula;
   public $telefono;
   public $correo;
   public $exists;


public function __construct($t = FALSE)
    {
        parent::__construct('clientes', '/plugins/VentasMotos/');

        if ($t)
        {
            $this->id =$t['id'];
            $this->nombre = $t['nombre'];
            $this->cedula = $t['cedula'];
            $this->telefono = $t['telefono'];
            $this->correo = $t['correo'];

        }
        else
        {
            $this->id = NULL;
            $this->nombre = NULL;
            $this->cedula = NULL;
            $this->telefono = NULL;
            $this->correo = NULL;

        }
    }

    protected function install() {
        return '';
    }
     public function get($id) {

         $data = $this->db->select("SELECT * FROM clientes WHERE id= ".$this->var2str($id).";");

         if ($data)

         {
             return new opc_clientes($data[0]);
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
           return $this->db->select("SELECT * FROM clientes WHERE id = ".$this->var2str($this->id).';');
   }



     public function save() {

         if ($this->exists()){

         $sql ="UPDATE clientes SET nombre = ".$this->var2str($this->nombre).
               ", cedula = ".$this->var2str($this->cedula).
               ", telefono = ".$this->var2str($this->telefono).
               ", correo = ".$this->var2str($this->correo).
               " WHERE id = ".$this->var2str($this->id).";";

       return $this->db->exec($sql);

         }
         else
         {

    $sql ="INSERT INTO clientes (nombre,cedula,telefono,correo) VALUES
                     (".$this->var2str($this->nombre).
                     ",".$this->var2str($this->cedula).
                      ",".$this->var2str($this->telefono).
                     ",".$this->var2str($this->correo).");";

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
         return $this->db->exec("DELETE FROM clientes WHERE id = "
                 .$this->var2str($this->id).";");
     }

     public function all() {

         $lista = array();

         $data= $this->db->select("SELECT * FROM clientes ORDER BY id ;");

         if ($data)
         {
             foreach ($data as $d)

                 $lista[] = new opc_clientes ($d);

         return $lista;
         }
     }

}
