<?php
class Arreglos{
  private $db;
  public function __construct(){
    $this->db = new Base;
  }

  public function index(){

  }

  public function arreglo_Restaurantes(){
    $is_status = true;
    $this->db->query("SELECT idNegocio, negocio, direccion   FROM vv_negocio WHERE status=:nstatus");
    $this->db->bind(':nstatus',  $is_status);
    return $this->db->registros();
  }
  public function arreglo_Puestos(){
    $is_status = true;
    $this->db->query("SELECT idPuesto, puesto, vv_negocio_idNegocio  FROM vv_puesto WHERE status=:nstatus");
    $this->db->bind(':nstatus', $is_status);
    return $this->db->registros();
  }
  public function arreglo_NivelUsuarios(){
    $is_status = true;
    $this->db->query("SELECT idNivel, nivel  FROM vv_nivelusuario WHERE status=:nstatus");
    $this->db->bind(':nstatus',  $is_status);
    return $this->db->registros();
  }
  public function arreglo_genero(){
    $is_status = true;
    $this->db->query("SELECT idGenero, genero  FROM vv_genero WHERE status=:nstatus");
    $this->db->bind(':nstatus',  $is_status);
    return $this->db->registros();
  }


  public function arreglo_Usuario(){
   // $is_status = true;
    $this->db->query("SELECT  U.status, U.idUsuario, CONCAT(u.nombres ,' ', u.apellidos ) AS nombre, (SELECT puesto FROM vv_puesto WHERE idPuesto = U.vv_puesto_idPuesto) AS textPuesto, (SELECT nivel FROM vv_nivelusuario WHERE idNivel = SS.vv_nivelusuario_idNivel) AS textNivUsuario, SS.bar_acceso FROM vv_usuarios U INNER JOIN vv_sesion SS ON SS.vv_usuarios_idUsuario = U.idUsuario");
   // $this->db->bind(':nstatus',  $is_status);
    return $this->db->registros();
  }

  public function obtenerDetUsuariosId($datos, $id){
    $this->db->query("SELECT U.idUsuario,
    U.vv_genero_idGenero,
    (SELECT genero FROM vv_genero WHERE idGenero  = U.vv_genero_idGenero) AS txtGenero,
    U.nombres,
    U.apellidos,
    U.direccion,
    U.nacimiento,
    U.telefono,
    U.status,
    U.vv_puesto_idPuesto,
    (SELECT puesto FROM vv_puesto WHERE idPuesto = U.vv_puesto_idPuesto ) AS txtPuesto,
    S.vv_nivelusuario_idNivel,
    (SELECT nivel FROM vv_nivelusuario WHERE idNivel = S.vv_nivelusuario_idNivel) AS txtnivSession,
    S.bar_acceso
    FROM vv_usuarios U
    LEFT JOIN vv_sesion S
    ON S.vv_usuarios_idUsuario = U.idUsuario
    WHERE
    U.idUsuario = :nUId");
    $this->db->bind(':nUId', $id );
  return $this->db->registros();
  }




  public function arreglo_Preveedores(){
    $is_status = true;
    $this->db->query("SELECT P.idProveedores, LPAD(P.idProveedores,6,'0')AS CodProveedor, P.nombre, P.direccion, P.telefono, P.ext, P.email, CONCAT(CP.nombres, ' ', CP.apellidos) AS contacto FROM vv_proveedores P right JOIN vv_contactosproveedor CP ON CP.vv_proveedores_idProveedores = P.idProveedores WHERE p.status= :nstatus GROUP BY (p.idProveedores) ");
    $this->db->bind(':nstatus',  $is_status);
    return $this->db->registros();
  }



  public function arreglo_Producto(){
    $is_status = true;
    //$this->db->query("SELECT P.idProducto, P.producto, bar_ProInterno, (SELECT tipo FROM vv_clasificaproducto WHERE idTipoProducto = P.vv_tipoproducto) AS clasificacion, (SELECT IF(COUNT(vv_producto_idProducto) < 1, 0,1) AS bool_result FROM vv_producto_unimedida WHERE vv_producto_idProducto = P.idProducto) AS ProConfigurado FROM vv_producto P  WHERE P.status=:nstatus");
    $this->db->query("SELECT CPX.idbarexterno, CPX.bar_extcodigo, P.idProducto, IF(PUM.idProUniMedida IS NULL, 0 ,PUM.idProUniMedida ) AS idConfMedida,  P.producto, bar_ProInterno, P.vv_tipoproducto, (SELECT tipo FROM vv_clasificaproducto WHERE idTipoProducto = P.vv_tipoproducto) AS clasificacion, (SELECT IF(COUNT(vv_producto_idProducto) < 1, 0,1) AS bool_result FROM vv_producto_unimedida WHERE vv_producto_idProducto = P.idProducto) AS ProConfigurado, PUM.vv_unidad_medida_entrada,(SELECT medida FROM vv_unidad_medida WHERE idUniMedida = PUM.vv_unidad_medida_entrada) AS uniMedEntrada, PUM.unidades_porsalida, PUM.vv_unidad_medida_salida, (SELECT medida FROM vv_unidad_medida WHERE idUniMedida = PUM.vv_unidad_medida_salida) AS uniMedSalida, PUM.bar_interno, PUM.chk_SolMedida,(SELECT IF(COUNT(vv_producto_idProducto) < 1, 0,1) AS bool_result FROM vv_producto_unimedida WHERE vv_producto_idProducto = P.idProducto) AS ProConfigurado FROM vv_producto P LEFT JOIN vv_producto_unimedida PUM ON PUM.vv_producto_idProducto = P.idProducto LEFT JOIN vv_codbarras_extproducto CPX ON CPX.vv_producto_idProducto = P.idProducto WHERE P.status=:nstatus");

    $this->db->bind(':nstatus',  $is_status);
    return $this->db->registros();
  }

  public function arreglo_UniMedida(){
    $is_status = true;
    $this->db->query("SELECT idUniMedida, medida, status FROM vv_unidad_medida WHERE status=:nstatus");
    $this->db->bind(':nstatus',  $is_status);
    return $this->db->registros();
  }


  public function arreglo_ClasProducto(){
    $is_status = true;
    $this->db->query("SELECT idTipoProducto, tipo  FROM vv_clasificaproducto WHERE status=:nstatus");
    $this->db->bind(':nstatus',  $is_status);
    return $this->db->registros();
  }







  public function arreglo_OrdenesEnProceso(){
    session_start();
    $is_status = true;
    $is_statusProceso = false;
    $is_NivUsuario = $_SESSION['sid'];
    $this->db->query("SELECT (O.id) AS noOrden, DATE_FORMAT(O.creado, '%m/%d/%Y') AS fecha, (SELECT CONCAT(nombres , ' ' ,apellidos) as solicita FROM vv_usuarios WHERE idUsuario = O.vv_solicitaa_orden) AS solicita, (SELECT nombre FROM vv_proveedores WHERE idProveedores = O.vv_proveedores_idProveedores) AS nomProveedor, (SELECT COUNT(noOrden) AS noProducto FROM vv_orden_de_producto WHERE noOrden = O.id AND status = :nstatus ) AS NoProductos FROM vv_solicita_orden O WHERE O.status= :nstatus and O.proceso = :nstatusProceso and O.vv_solicitaa_orden like :nIdUsuario ");
     $this->db->bind(':nstatus',  $is_status);
     $this->db->bind(':nstatusProceso',  $is_statusProceso);
     $this->db->bind(':nIdUsuario', $is_NivUsuario);
    return $this->db->registros();
  }


  public function arreglo_dtOrdenesRecibidas(){
    $is_status = 1;
    $is_statusProceso = 0;
    $this->db->query("SELECT OP.noOrden, LPAD(OP.noOrden,6,'0') AS noOrdenCero, DATE_FORMAT(OP.creado, '%m/%d/%Y') AS fecOrdenada, DATE_FORMAT(RP.creado, '%m/%d/%Y') AS fecRecibida, (SELECT nombre FROM vv_proveedores WHERE idProveedores = SO.vv_proveedores_idProveedores)  AS requerio FROM vv_orden_de_producto OP LEFT JOIN vv_recibido_producto RP ON RP.vv_producto_idProducto =  OP.idProducto INNER JOIN vv_solicita_orden SO ON SO.id = OP.noOrden WHERE SO.status = :nstatus AND SO.proceso > :nstatusProceso GROUP BY (OP.noOrden)");
     $this->db->bind(':nstatus',  $is_status);
     $this->db->bind(':nstatusProceso',  $is_statusProceso);
    return $this->db->registros();
  }



  public function obtenerDetallesPedidoId($datos, $id){ /// Consultar detalles de Pedidos
    $is_status = true;
    $this->db->query("SELECT O.noOrden, O.idOrdProducto, O.idProducto, (SELECT producto FROM vv_producto WHERE idProducto = O.idProducto) as producto, O.idUniMedidaSolicitada, (SELECT CONCAT( O.cantidad, ' ' , medida) as cantidad FROM vv_unidad_medida WHERE idUniMedida = O.idUniMedidaSolicitada ) AS cantidad, (SELECT unidades_porsalida FROM  vv_producto_unimedida WHERE vv_producto_idProducto = O.idProducto ) AS cantValUnitario, (SELECT vv_unidad_medida_salida FROM vv_producto_unimedida WHERE vv_producto_idProducto = O.idProducto) AS idUniMedSalida  FROM vv_orden_de_producto O WHERE O.status=:nstatus and O.noOrden = :id ");
    $this->db->bind(':nstatus',  $is_status);
    $this->db->bind(':id', $id);
      return $this->db->registros();
  }

  public function obtenerDetallesRecibidosId($datos, $id){ /// Consultar Detalles de Recibido
    $is_status = true;
    $this->db->query("SELECT OP.noOrden, LPAD(OP.noOrden,6,'0') AS noOrdenCero, idOrdProducto, OP.idProducto,(SELECT producto FROM vv_producto P WHERE P.idProducto = OP.idProducto) as nomProducto, (OP.cantidad) AS cantSolicitada, (SELECT cantRecibida FROM vv_recibido_producto WHERE vv_orden_de_producto_idOrdProducto = OP.idOrdProducto) AS cantRecibida, (SELECT UM.medida FROM vv_unidad_medida UM WHERE UM.idUniMedida = OP.idUniMedidaSolicitada) AS UniMedida FROM vv_orden_de_producto OP WHERE OP.noOrden = :id AND OP.status=:nstatus");
    $this->db->bind(':nstatus',  $is_status);
    $this->db->bind(':id', $id);
      return $this->db->registros();
  }



public function obtenerListProdProvedorId($datos, $id){
  $is_status = true;
  // $this->db->query("SELECT no_Listado, MAX(LPP.no_Listado) AS NoMaxListado, idProducto, producto, vv_pro_unimedida_entrada, (SELECT medida FROM vv_unidad_medida WHERE idUniMedida = vv_pro_unimedida_entrada) AS nomProducto, bar_ProInterno FROM vv_predlistprodproveedor LPP INNER JOIN vv_producto ON idProducto =  vv_producto_idProducto INNER JOIN  vv_producto_unimedida PUM ON  PUM.vv_unidad_medida_entrada = vv_pro_unimedida_entrada WHERE LPP.status= :nstatus AND  LPP.vv_proveedores_idProveedores = :nId");
  $this->db->query("SELECT LPP.idListProdProveedor, LPP.vv_proveedores_idProveedores, LPP.vv_producto_idProducto, (SELECT producto FROM vv_producto WHERE idProducto = LPP.vv_producto_idProducto ) AS nomProducto, LPP.vv_pro_unimedida_entrada, (SELECT medida FROM vv_unidad_medida WHERE idUniMedida = LPP.vv_pro_unimedida_entrada ) AS tipMedida, LPP.no_Listado FROM vv_predlistprodproveedor LPP WHERE LPP.no_Listado = :nId AND LPP.status = :nstatus");
  $this->db->bind(':nstatus',  $is_status);
  $this->db->bind(':nId',  $id);
    return $this->db->registros();
}


 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /*Historial de Salida de Producto */


public function obtenerHistSalProductoDate($array, $fecha){
 // $is_status = true;
 session_start();
 $acceso = '%';
//  $acceso = ($_SESSION['idPermisos']==1)? '%' : $_SESSION['sid'] ;

  $this->db->query("SELECT  RP.idRetProducto, LPAD(RP.idRetProducto,6,'0') AS noSalida, (SELECT CONCAT(nombres, ' ' , apellidos) as fullNombre FROM vv_usuarios WHERE idUsuario = RP.vv_usuarios_idUsuario) as fullNombre, DATE_FORMAT(RP.creado, '%d/%m/%Y - %h:%i %p') AS creado, (SELECT COUNT(vv_retira_producto_idRetProducto) FROM vv_salida_producto WHERE vv_retira_producto_idRetProducto =  RP.idRetProducto) AS cantProducto FROM vv_retira_producto RP WHERE  RP.vv_usuarios_idUsuario  LIKE :nIdUsuario AND RP.creado between :ndDateFrom AND :ndDateTo");
  $this->db->bind(':ndDateFrom', $fecha.' 00:00:00');
  $this->db->bind(':ndDateTo',  $fecha.' 23:59:59');
  $this->db->bind(':nIdUsuario', $acceso);

  //$this->db->bind(':nstatus', $is_status);
  return $this->db->registros();
}

public function obtenerDetHistSalProductoId($array, $id){

  $this->db->query("SELECT SP.vv_retira_producto_idRetProducto, P.producto, SP.cantSalida, (SELECT medida FROM vv_unidad_medida WHERE idUniMedida = SP.id_ProUniMedidaSalida) AS UniMedida FROM vv_salida_producto SP INNER JOIN vv_producto P ON p.idProducto = SP.vv_producto_idProducto WHERE SP.vv_retira_producto_idRetProducto = :nIdDetSalProducto AND P.status = 1");

  $this->db->bind(':nIdDetSalProducto', $id);
  //$this->db->bind(':nstatus', $is_status);
  return $this->db->registros();
}



 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /*Reportes */

  public function arreglo_RepProductoTotal(){
    $is_status = true;
    $this->db->query("SELECT RP.vv_producto_idProducto, SUM(OP.cantidad) AS TotSolicitado, (SELECT medida FROM vv_unidad_medida WHERE idUniMedida = OP.idUniMedidaSolicitada ) AS Entmedida, SUM(RP.cantRecibida) AS cantRecibida, (SELECT PUM.unidades_porsalida FROM vv_producto_unimedida PUM WHERE PUM.vv_producto_idProducto = RP.vv_producto_idProducto) AS CantUnitariar, (SUM(RP.cantRecibida) * PUM.unidades_porsalida) totDisponible, (SELECT producto FROM vv_producto WHERE idProducto = rp.vv_producto_idProducto) AS nomProducto, (SELECT medida FROM vv_unidad_medida WHERE idUniMedida = PUM.vv_unidad_medida_salida ) AS Salmedida FROM vv_recibido_producto RP INNER JOIN vv_producto_unimedida PUM ON PUM.vv_producto_idProducto = RP.vv_producto_idProducto INNER JOIN vv_orden_de_producto OP ON OP.idOrdProducto = RP.vv_orden_de_producto_idOrdProducto AND RP.status = :nstatus GROUP BY (RP.vv_producto_idProducto)");
    $this->db->bind(':nstatus', $is_status);
    return $this->db->registros();
  }

  public function arreglo_RepProdTotSalida(){
    $is_status = true;
    $this->db->query("SELECT P.idProducto, P.bar_ProInterno, P.producto, (SUM(cantSalida)) AS TotProducto, medida FROM vv_salida_producto INNER JOIN vv_producto P ON vv_producto_idProducto = idProducto INNER JOIN vv_unidad_medida ON id_ProUniMedidaSalida = idUniMedida WHERE P.status = :nstatus GROUP BY (vv_producto_idProducto) ");
    $this->db->bind(':nstatus', $is_status);
    return $this->db->registros();
  }
  public function arreglo_RepProdTotGeneral(){
    $is_status = true;
    $this->db->query("SELECT RP.vv_producto_idProducto, P.bar_ProInterno,
    P.producto, SUM(RP.cantRecibida) AS TotEntrada, (SELECT medida FROM vv_unidad_medida WHERE idUniMedida = PUM.vv_unidad_medida_entrada ) AS UniMedEntrada, (SUM(RP.cantRecibida) * PUM.unidades_porsalida) AS TotSalida, (SELECT medida FROM vv_unidad_medida WHERE idUniMedida = PUM.vv_unidad_medida_salida ) AS UniMedSalida, (SELECT CASE NULL  WHEN SUM(cantSalida) IS NULL THEN 0 ELSE SUM(cantSalida) END FROM vv_salida_producto WHERE vv_producto_idProducto = RP.vv_producto_idProducto group by vv_producto_idProducto) AS TotSalUnitaria FROM vv_recibido_producto RP INNER JOIN vv_producto P ON P.idProducto = RP.vv_producto_idProducto INNER JOIN vv_producto_unimedida PUM ON PUM.vv_producto_idProducto = RP.vv_producto_idProducto WHERE P.status = :nstatus GROUP BY (RP.vv_producto_idProducto)");
    $this->db->bind(':nstatus', $is_status);
    return $this->db->registros();
  }



}
 ?>