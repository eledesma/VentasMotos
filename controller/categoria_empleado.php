<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_model('opc_categorias.php');
/**
 * Description of oportunidad_inicio
 *
 * @author Administrador
 */
class categoria_empleado extends fs_controller
{
    public $listado;
    public $editar;
    public $opc_categorias;




    public function __construct() {
        parent::__construct(__CLASS__, 'Iniciar Categorías', 'Categorías');
    }

    protected function private_core() {

        $this->opc_categorias = new opc_categorias();
        $this->editar= FALSE;
        $this->listado= $this->opc_categorias->all();




        if (isset($_POST['id'])) /// Editar Categoria
        {
         $this->opc_categorias->id = $_POST['id'];
         $this->editar = $this->opc_categorias->get($_POST['id']);
         if ($this->editar)
         {

          $this->opc_categorias->nombre = $_POST['nombre'];
          $this->opc_categorias->descripcion = $_POST['descripcion'];

            if ($this->opc_categorias->save())
                {
                    $this->new_message('Datos Modificados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Modificar Datos');
                }
         }
        }

        else if (isset($_POST['nombre'])) ///Nueva Categoria
            {

              $this->opc_categorias->nombre = $_POST['nombre'];
              $this->opc_categorias->descripcion = $_POST['descripcion'];

            if($this->opc_categorias->save())

                {
                    $this->new_message('Datos Guardados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Guardar Datos');
                }
            }

        else if (isset ($_GET['id'])) ///Mostrar Categoria
            {
             $this->editar = $this->opc_categorias->get($_GET['id']);
            }

            else if (isset ($_GET['delete'])) ///Eliminar Categoria
            {
             $aux = $this->opc_categorias->get($_GET['delete']);
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
            $this->new_error_msg('Categoria NO Encontrada');
            }


            }
    }


}
