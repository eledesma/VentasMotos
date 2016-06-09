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
class opc_zfacturas extends fs_model
{
   public $id;
   public $fecha;
   public $empresa;
   public $empleado;
   public $cliente;
   public $producto;
   public $cantidad;
   public $garantia;
   public $total;
   public $pago;
   public $credito;
   public $exists;


public function __construct($t = FALSE)
    {
        parent::__construct('zfacturas', '/plugins/VentasMotos/');

        if ($t)
        {
            $this->id =$t['id'];
            $this->fecha = $t['fecha'];
            $this->empresa = $t['empresa'];
            $this->empleado = $t['empleado'];
            $this->cliente = $t['cliente'];
            $this->producto = $t['producto'];
            $this->cantidad = $t['cantidad'];
            $this->garantia = $t['garantia'];
            $this->total = $t['total'];
            $this->pago = $t['pago'];
            $this->credito = $t['credito'];

        }
        else
        {
            $this->id = NULL;
            $this->fecha = NULL;
            $this->empresa = NULL;
            $this->empleado = NULL;
            $this->cliente = NULL;
            $this->producto = NULL;
            $this->cantidad = NULL;
            $this->garantia = NULL;
            $this->total = NULL;
            $this->pago = NULL;
            $this->credito = NULL;

        }
    }

    protected function install() {
        return '';
    }
     public function get($id) {

         $data = $this->db->select("SELECT * FROM zfacturas WHERE id= ".$this->var2str($id).";");

         if ($data)

         {
             return new opc_zfacturas($data[0]);
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
           return $this->db->select("SELECT * FROM zfacturas WHERE id = ".$this->var2str($this->id).';');
   }



     public function save() {

         if ($this->exists()){

         $sql ="UPDATE zfacturas SET fecha = ".$this->var2str($this->fecha).
               ", empresa = ".$this->var2str($this->empresa).
               ", empleado = ".$this->var2str($this->empleado).
               ", cliente = ".$this->var2str($this->cliente).
               ", producto = ".$this->var2str($this->producto).
               ", cantidad = ".$this->var2str($this->cantidad).
               ", garantia = ".$this->var2str($this->garantia).
               ", total = ".$this->var2str($this->total).
               ", pago = ".$this->var2str($this->pago).
               ", credito = ".$this->var2str($this->credito).
               " WHERE id = ".$this->var2str($this->id).";";

       return $this->db->exec($sql);

         }
         else
         {

    $sql ="INSERT INTO zfacturas (fecha,empresa,empleado,cliente,producto,cantidad,garantia,total,pago,credito) VALUES
                     (".$this->var2str($this->fecha).
                     ",".$this->var2str($this->empresa).
                      ",".$this->var2str($this->empleado).
                     ",".$this->var2str($this->cliente).
                      ",".$this->var2str($this->producto).
                      ",".$this->var2str($this->cantidad).
                      ",".$this->var2str($this->garantia).
                      ",".$this->var2str($this->total).
                      ",".$this->var2str($this->pago).
                     ",".$this->var2str($this->credito).");";

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
         return $this->db->exec("DELETE FROM zfacturas WHERE id = "
                 .$this->var2str($this->id).";");
     }

     public function all() {

         $lista = array();

         $data= $this->db->select("SELECT * FROM zfacturas ORDER BY id ;");

         if ($data)
         {
             foreach ($data as $d)

                 $lista[] = new opc_zfacturas ($d);

         return $lista;
         }
     }

}
