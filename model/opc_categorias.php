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
class opc_categorias extends fs_model
{
   public $id;
   public $nombre;
   public $descripcion;
   public $exists;


public function __construct($t = FALSE)
    {
        parent::__construct('categorias', '/plugins/VentasMotos/');

        if ($t)
        {
            $this->id =$t['id'];
            $this->nombre = $t['nombre'];
            $this->descripcion = $t['descripcion'];

        }
        else
        {
            $this->id = NULL;
            $this->nombre = NULL;
            $this->descripcion = NULL;

        }
    }

    protected function install() {
        return '';
    }
     public function get($id) {

         $data = $this->db->select("SELECT * FROM categorias WHERE id= ".$this->var2str($id).";");

         if ($data)

         {
             return new opc_categorias($data[0]);
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
           return $this->db->select("SELECT * FROM categorias WHERE id = ".$this->var2str($this->id).';');
   }



     public function save() {

         if ($this->exists()){

         $sql ="UPDATE categorias SET nombre = ".$this->var2str($this->nombre).
               ", descripcion = ".$this->var2str($this->descripcion).
               " WHERE id = ".$this->var2str($this->id).";";

       return $this->db->exec($sql);

         }
         else
         {

    $sql ="INSERT INTO categorias (nombre,descripcion) VALUES
                     (".$this->var2str($this->nombre).
                     ",".$this->var2str($this->descripcion).");";

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
         return $this->db->exec("DELETE FROM categorias WHERE id = "
                 .$this->var2str($this->id).";");
     }

     public function all() {

         $lista = array();

         $data= $this->db->select("SELECT * FROM categorias ORDER BY id ;");

         if ($data)
         {
             foreach ($data as $d)

                 $lista[] = new opc_categorias($d);

         return $lista;
         }
     }

}
