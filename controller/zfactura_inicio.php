<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_model('opc_zfacturas.php');
/**
 * Description of oportunidad_inicio
 *
 * @author Administrador
 */
class zfactura_inicio extends fs_controller
{
    public $listado;
    public $editar;
    public $opc_zfacturas;
    public $consulta1;
    public $consulta2;
    public $consulta3;
    public $consulta4;
    public $consulta5;
    public $consulta6;
    public $consulta7;
    public $ver;


    public function __construct() {
        parent::__construct(__CLASS__, 'Administrar Facturas', 'Facturas');
    }

    protected function private_core() {

        $this->consulta1 = $this->db->select("SELECT * FROM empresas;");
        $this->consulta2 = $this->db->select("SELECT * FROM fs_users;");
        $this->consulta3 = $this->db->select("SELECT * FROM clientes;");
        $this->consulta4 = $this->db->select("SELECT * FROM productos;");
        $this->consulta5 = $this->db->select("SELECT * FROM creditos;");
        //$this->consulta6 = $this->db->select("SELECT valor FROM productos WHERE nombre='producto';");
        //$this->consulta7 = $this->db->select("UPDATE productos SET cantidad WHERE nombre='producto' AND cantidad-cantidad;");
        $this->opc_zfacturas = new opc_zfacturas();
        $this->editar= FALSE;
        $this->listado= $this->opc_zfacturas->all();

        //$this->consulta6 = $_POST['cantidad'] * $consulta6;


        if (isset($_POST['id'])) /// Editar Factura
        {
         $this->opc_zfacturas->id = $_POST['id'];
         $this->editar = $this->opc_zfacturas->get($_POST['id']);
         if ($this->editar)
         {

          $this->opc_zfacturas->fecha = $_POST['fecha'];
          $this->opc_zfacturas->empresa = $_POST['empresa'];
          $this->opc_zfacturas->empleado = $_POST['empleado'];
          $this->opc_zfacturas->cliente = $_POST['cliente'];
          $this->opc_zfacturas->producto = $_POST['producto'];
          $this->opc_zfacturas->cantidad = $_POST['cantidad'];
          $this->opc_zfacturas->garantia = $_POST['garantia'];
          $this->opc_zfacturas->total = $_POST['total'];
          $this->opc_zfacturas->pago = $_POST['pago'];
          $this->opc_zfacturas->credito = $_POST['credito'];

            if ($this->opc_zfacturas->save())
                {
                    $this->new_message('Datos Modificados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Modificar Datos');
                }
         }
        }

        else if (isset($_POST['fecha'])) ///Nueva Factura
            {

              $this->opc_zfacturas->fecha = $_POST['fecha'];
              $this->opc_zfacturas->empresa = $_POST['empresa'];
              $this->opc_zfacturas->empleado = $_POST['empleado'];
              $this->opc_zfacturas->cliente = $_POST['cliente'];
              $this->opc_zfacturas->producto = $_POST['producto'];
              $this->opc_zfacturas->cantidad = $_POST['cantidad'];
              $this->opc_zfacturas->garantia = $_POST['garantia'];
              $this->opc_zfacturas->total = $_POST['total'];
              $this->opc_zfacturas->pago = $_POST['pago'];
              $this->opc_zfacturas->credito = $_POST['credito'];

            if($this->opc_zfacturas->save())

                {
                    $this->new_message('Datos Guardados Correctamante');

                }
                else
                {
                    $this->new_error_msg('Error al Guardar Datos');
                }
            }

        else if (isset ($_GET['id'])) ///Mostrar Factura
            {
             $this->editar = $this->opc_zfacturas->get($_GET['id']);
            }

            else if (isset ($_GET['delete'])) ///Eliminar Factura
            {
             $aux = $this->opc_zfacturas->get($_GET['delete']);
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
            $this->new_error_msg('Factura NO Encontrada');
            }


            }
    }


}
