<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_model('opc_empresas.php');
/**
 * Description of oportunidad_inicio
 *
 * @author Administrador
 */
class empresa_inicio extends fs_controller
{
    public $listado;
    public $editar;
    public $opc_empresas;


    public function __construct() {
        parent::__construct(__CLASS__, 'Administrar Empresas', 'Empresas');
    }

    protected function private_core() {

        $this->opc_empresas = new opc_empresas();
        $this->editar= FALSE;
        $this->listado= $this->opc_empresas->all();




        if (isset($_POST['id'])) /// Editar Empresa
        {
         $this->opc_empresas->id = $_POST['id'];
         $this->editar = $this->opc_empresas->get($_POST['id']);
         if ($this->editar)
         {

          $this->opc_empresas->nombre = $_POST['nombre'];
          $this->opc_empresas->direccion = $_POST['direccion'];
          $this->opc_empresas->telefono = $_POST['telefono'];
          $this->opc_empresas->correo = $_POST['correo'];
          $this->opc_empresas->ciudad = $_POST['ciudad'];
          $this->opc_empresas->pais = $_POST['pais'];

            if ($this->opc_empresas->save())
                {
                    $this->new_message('Datos Modificados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Modificar Datos');
                }
         }
        }

        else if (isset($_POST['nombre'])) ///Nueva Empresa
            {

              $this->opc_empresas->nombre = $_POST['nombre'];
              $this->opc_empresas->direccion = $_POST['direccion'];
              $this->opc_empresas->telefono = $_POST['telefono'];
              $this->opc_empresas->correo = $_POST['correo'];
              $this->opc_empresas->ciudad = $_POST['ciudad'];
              $this->opc_empresas->pais = $_POST['pais'];

            if($this->opc_empresas->save())

                {
                    $this->new_message('Datos Guardados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Guardar Datos');
                }
            }

        else if (isset ($_GET['id'])) ///Mostrar Empresa
            {
             $this->editar = $this->opc_empresas->get($_GET['id']);
            }

            else if (isset ($_GET['delete'])) ///Eliminar Empresa
            {
             $aux = $this->opc_empresas->get($_GET['delete']);
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
            $this->new_error_msg('Empresa NO Encontrada');
            }


            }
    }


}
