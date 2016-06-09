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
class opc_productos extends fs_model
{
   public $id;
   public $nombre;
   public $modelo;
   public $color;
   public $marca;
   public $cilindraje;
   public $cantidad;
   public $valor;
   public $categoria;
   public $exists;


public function __construct($t = FALSE)
    {
        parent::__construct('productos', '/plugins/VentasMotos/');

        if ($t)
        {
            $this->id =$t['id'];
            $this->nombre = $t['nombre'];
            $this->modelo = $t['modelo'];
            $this->color = $t['color'];
            $this->marca = $t['marca'];
            $this->cilindraje = $t['cilindraje'];
            $this->cantidad = $t['cantidad'];
            $this->valor = $t['valor'];
            $this->categoria = $t['categoria'];

        }
        else
        {
            $this->id = NULL;
            $this->nombre = NULL;
            $this->modelo = NULL;
            $this->color = NULL;
            $this->marca = NULL;
            $this->cilindraje = NULL;
            $this->cantidad = NULL;
            $this->valor = NULL;
            $this->categoria = NULL;

        }
    }

    protected function install() {
        return '';
    }
     public function get($id) {

         $data = $this->db->select("SELECT * FROM productos WHERE id= ".$this->var2str($id).";");

         if ($data)

         {
             return new opc_productos($data[0]);
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
           return $this->db->select("SELECT * FROM productos WHERE id = ".$this->var2str($this->id).';');
   }



     public function save() {

         if ($this->exists()){

         $sql ="UPDATE productos SET nombre = ".$this->var2str($this->nombre).
               ", modelo = ".$this->var2str($this->modelo).
               ", color = ".$this->var2str($this->color).
               ", marca = ".$this->var2str($this->marca).
               ", cilindraje = ".$this->var2str($this->cilindraje).
               ", cantidad = ".$this->var2str($this->cantidad).
               ", valor = ".$this->var2str($this->valor).
               ", categoria = ".$this->var2str($this->categoria).
               " WHERE id = ".$this->var2str($this->id).";";

       return $this->db->exec($sql);

         }
         else
         {

    $sql ="INSERT INTO productos (nombre,modelo,color,marca,cilindraje,cantidad,valor,categoria) VALUES
                     (".$this->var2str($this->nombre).
                     ",".$this->var2str($this->modelo).
                      ",".$this->var2str($this->color).
                     ",".$this->var2str($this->marca).
                      ",".$this->var2str($this->cilindraje).
                      ",".$this->var2str($this->cantidad).
                      ",".$this->var2str($this->valor).
                     ",".$this->var2str($this->categoria).");";

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
         return $this->db->exec("DELETE FROM productos WHERE id = "
                 .$this->var2str($this->id).";");
     }

     public function all() {

         $lista = array();

         $data= $this->db->select("SELECT * FROM productos ORDER BY id ;");

         if ($data)
         {
             foreach ($data as $d)

                 $lista[] = new opc_productos ($d);

         return $lista;
         }
     }

}
