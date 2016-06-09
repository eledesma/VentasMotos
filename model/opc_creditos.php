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
class opc_creditos extends fs_model
{
   public $id;
   public $financiar;
   public $tiempo;
   public $valor;
   public $cuotas;
   public $valorcuotas;
   public $completado;
   public $exists;


public function __construct($t = FALSE)
    {
        parent::__construct('creditos', '/plugins/VentasMotos/');

        if ($t)
        {
            $this->id =$t['id'];
            $this->financiar = $t['financiar'];
            $this->tiempo = $t['tiempo'];
            $this->valor = $t['valor'];
            $this->cuotas = $t['cuotas'];
            $this->valorcuotas = $t['valorcuotas'];
            $this->completado = $this->str2bool($t['completado']);
        }
        else
        {
            $this->id = NULL;
            $this->financiar = NULL;
            $this->tiempo = NULL;
            $this->valor = NULL;
            $this->cuotas = NULL;
            $this->valorcuotas = NULL;
            $this->completado = NULL;
        }
    }

    protected function install() {
        return '';
    }
     public function get($id) {

         $data = $this->db->select("SELECT * FROM creditos WHERE id= ".$this->var2str($id).";");

         if ($data)

         {
             return new opc_creditos($data[0]);
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
           return $this->db->select("SELECT * FROM creditos WHERE id = ".$this->var2str($this->id).';');
   }



     public function save() {

         if ($this->exists()){

         $sql ="UPDATE creditos SET financiar = ".$this->var2str($this->financiar).
               ", tiempo = ".$this->var2str($this->tiempo).
               ", valor = ".$this->var2str($this->valor).
               ", cuotas = ".$this->var2str($this->cuotas).
               ", valorcuotas = ".$this->var2str($this->valorcuotas).
               ", completado = ".$this->var2str($this->completado).
               " WHERE id = ".$this->var2str($this->id).";";

       return $this->db->exec($sql);

         }
         else
         {

    $sql ="INSERT INTO creditos (financiar,tiempo,valor,cuotas,valorcuotas) VALUES
                     (".$this->var2str($this->financiar).
                     ",".$this->var2str($this->tiempo).
                      ",".$this->var2str($this->valor).
                     ",".$this->var2str($this->cuotas).
                     ",".$this->var2str($this->valorcuotas).");";

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
         return $this->db->exec("DELETE FROM creditos WHERE id = "
                 .$this->var2str($this->id).";");
     }

     public function all() {

         $lista = array();

         $data= $this->db->select("SELECT * FROM creditos ORDER BY id;");

         if ($data)
         {
             foreach ($data as $d)

                 $lista[] = new opc_creditos ($d);

         return $lista;
         }
     }


}
