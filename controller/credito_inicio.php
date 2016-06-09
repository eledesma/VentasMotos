<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_model('opc_creditos.php');
/**
 * Description of oportunidad_inicio
 *
 * @author Administrador
 */
class credito_inicio extends fs_controller
{
    public $listado;
    public $editar;
    public $opc_creditos;



    public function __construct() {
        parent::__construct(__CLASS__, 'Administrar Créditos', 'Créditos');
    }

    protected function private_core() {

        $this->opc_creditos = new opc_creditos();
        $completado = FALSE;
        $this->editar= FALSE;
        $this->listado= $this->opc_creditos->all();




        if (isset($_POST['id'])) /// Editar Credito
        {
         $this->opc_creditos->id = $_POST['id'];
         $this->editar = $this->opc_creditos->get($_POST['id']);
         if ($this->editar)
         {
          $this->opc_creditos->completado = isset($_POST['completado']);
          $this->opc_creditos->financiar= $_POST['financiar'];
          $this->opc_creditos->tiempo= $_POST['tiempo'];
          $this->opc_creditos->valor= $_POST['valor'];
          $this->opc_creditos->cuotas= $_POST['cuotas'];
          $this->opc_creditos->valorcuotas= $_POST['valorcuotas'];

            if ($this->opc_creditos->save())
                {
                    $this->new_message('Datos Modificados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Modificar');
                }
         }
        }
        else if (isset($_POST['financiar'])) ///Nuevo Credito
            {
              $this->opc_creditos->financiar= $_POST['financiar'];
              $this->opc_creditos->tiempo= $_POST['tiempo'];
              $this->opc_creditos->valor= $_POST['valor'];
              $this->opc_creditos->cuotas= $_POST['cuotas'];
              $this->opc_creditos->valorcuotas= $_POST['valorcuotas'];

            if($this->opc_creditos->save())

                {
                    $this->new_message('Datos Guardados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Guardar');
                }
            }
        else if (isset ($_GET['id'])) ///Mostrar Credito
            {
             $this->editar = $this->opc_creditos->get($_GET['id']);
            }
            else if (isset ($_GET['delete'])) ///Eliminar Credito
            {
             $aux = $this->opc_creditos->get($_GET['delete']);
             if ($aux)
             {
             if ($aux->delete())
                {
                $this->new_message('Datos Eliminados Correctamante');
                }
                else
                {
                $this->new_error_msg('Error al Eliminar');
                }
             }
            else
            {
            $this->new_error_msg('Credito NO Encontrado');
            }


            }
    }


}
