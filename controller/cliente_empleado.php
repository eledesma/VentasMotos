<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_model('opc_clientes.php');
/**
 * Description of oportunidad_inicio
 *
 * @author Administrador
 */
class cliente_empleado extends fs_controller
{
    public $listado;
    public $editar;
    public $opc_clientes;




    public function __construct() {
        parent::__construct(__CLASS__, 'Iniciar Clientes', 'Clientes');
    }

    protected function private_core() {

        $this->opc_clientes = new opc_clientes();
        $this->editar= FALSE;
        $this->listado= $this->opc_clientes->all();




        if (isset($_POST['id'])) /// Editar Cliente
        {
         $this->opc_clientes->id = $_POST['id'];
         $this->editar = $this->opc_clientes->get($_POST['id']);
         if ($this->editar)
         {

          $this->opc_clientes->nombre = $_POST['nombre'];
          $this->opc_clientes->cedula = $_POST['cedula'];
          $this->opc_clientes->telefono = $_POST['telefono'];
          $this->opc_clientes->correo = $_POST['correo'];

            if ($this->opc_clientes->save())
                {
                    $this->new_message('Datos Modificados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Modificar Datos');
                }
         }
        }

        else if (isset($_POST['nombre'])) ///Nuevo Cliente
            {

              $this->opc_clientes->nombre = $_POST['nombre'];
              $this->opc_clientes->cedula = $_POST['cedula'];
              $this->opc_clientes->telefono = $_POST['telefono'];
              $this->opc_clientes->correo = $_POST['correo'];

            if($this->opc_clientes->save())

                {
                    $this->new_message('Datos Guardados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Guardar Datos');
                }
            }

        else if (isset ($_GET['id'])) ///Mostrar Cliente
            {
             $this->editar = $this->opc_clientes->get($_GET['id']);
            }

            else if (isset ($_GET['delete'])) ///Eliminar Cliente
            {
             $aux = $this->opc_clientes->get($_GET['delete']);
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
            $this->new_error_msg('Cliente NO Encontrado');
            }


            }
    }


}
