<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_model('opc_productos.php');
/**
 * Description of oportunidad_inicio
 *
 * @author Administrador
 */
class producto_empleado extends fs_controller
{
    public $listado;
    public $editar;
    public $opc_productos;
    public $consultar;




    public function __construct() {
        parent::__construct(__CLASS__, 'Iniciar Productos', 'Productos');
    }

    protected function private_core() {

        $this->consultar = $this->db->select("SELECT * FROM categorias;");
        $this->opc_productos = new opc_productos();
        $this->editar= FALSE;
        $this->listado= $this->opc_productos->all();




        if (isset($_POST['id'])) /// Editar Producto
        {
         $this->opc_productos->id = $_POST['id'];
         $this->editar = $this->opc_productos->get($_POST['id']);
         if ($this->editar)
         {

          $this->opc_productos->nombre = $_POST['nombre'];
          $this->opc_productos->modelo = $_POST['modelo'];
          $this->opc_productos->color = $_POST['color'];
          $this->opc_productos->marca = $_POST['marca'];
          $this->opc_productos->cilindraje = $_POST['cilindraje'];
          $this->opc_productos->cantidad = $_POST['cantidad'];
          $this->opc_productos->valor = $_POST['valor'];
          $this->opc_productos->categoria = $_POST['categoria'];

            if ($this->opc_productos->save())
                {
                    $this->new_message('Datos Modificados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Modificar Datos');
                }
         }
        }

        else if (isset($_POST['nombre'])) ///Nuevo Producto
            {

              $this->opc_productos->nombre = $_POST['nombre'];
              $this->opc_productos->modelo = $_POST['modelo'];
              $this->opc_productos->color = $_POST['color'];
              $this->opc_productos->marca = $_POST['marca'];
              $this->opc_productos->cilindraje = $_POST['cilindraje'];
              $this->opc_productos->cantidad = $_POST['cantidad'];
              $this->opc_productos->valor= $_POST['valor'];
              $this->opc_productos->categoria= $_POST['categoria'];

            if($this->opc_productos->save())

                {
                    $this->new_message('Datos Guardados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Guardar Datos');
                }
            }

        else if (isset ($_GET['id'])) ///Mostrar Producto
            {
             $this->editar = $this->opc_productos->get($_GET['id']);
            }

            else if (isset ($_GET['delete'])) ///Eliminar Producto
            {
             $aux = $this->opc_productos->get($_GET['delete']);
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
            $this->new_error_msg('Producto NO Encontrado');
            }


            }
    }


}
