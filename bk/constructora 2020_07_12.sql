-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2020 a las 19:42:38
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `constructora`
--
CREATE DATABASE IF NOT EXISTS `constructora` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `constructora`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `almacen_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `almacen_d` (IN `p_id` INT)  begin
	delete from almacen where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `almacen_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `almacen_get` (IN `p_id` INT)  begin
	select id, nombre, ubicacion from almacen where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `almacen_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `almacen_i` (IN `p_nombre` VARCHAR(100), IN `p_ubicacion` VARCHAR(200))  begin
	insert into almacen(nombre, ubicacion)
	values(p_nombre, _get_null_or_value_from_varchar(p_ubicacion));
END$$

DROP PROCEDURE IF EXISTS `almacen_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `almacen_list` ()  begin
	select id, nombre, ubicacion from almacen;
END$$

DROP PROCEDURE IF EXISTS `almacen_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `almacen_u` (IN `p_id` INT, IN `p_nombre` VARCHAR(100), IN `p_ubicacion` VARCHAR(200))  begin
	update almacen 
	set nombre = p_nombre,
	ubicacion = _get_null_or_value_from_varchar(p_ubicacion)
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `comprobante_pago_tipo_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobante_pago_tipo_d` (IN `p_codigo` CHAR(1))  begin
	delete from comprobante_pago_tipo where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `comprobante_pago_tipo_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobante_pago_tipo_get` (IN `p_codigo` CHAR(1))  begin
	select nombre
	from comprobante_pago_tipo where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `comprobante_pago_tipo_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobante_pago_tipo_i` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(100))  begin
	insert into comprobante_pago_tipo(codigo, nombre)
	values(p_codigo, p_nombre);
END$$

DROP PROCEDURE IF EXISTS `comprobante_pago_tipo_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobante_pago_tipo_list` ()  begin
	select codigo, nombre
	from comprobante_pago_tipo;
END$$

DROP PROCEDURE IF EXISTS `comprobante_pago_tipo_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobante_pago_tipo_u` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(100))  begin
	update comprobante_pago_tipo
	set nombre = p_nombre
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `documento_identidad_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `documento_identidad_d` (IN `p_codigo` VARCHAR(10))  begin
	delete from documento_identidad where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `documento_identidad_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `documento_identidad_get` (IN `p_codigo` VARCHAR(10))  begin
	select codigo, nombre, persona_tipo_id, longitud_minima, longitud_maxima
	from documento_identidad where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `documento_identidad_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `documento_identidad_i` (IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100), IN `p_persona_tipo_id` CHAR(1), IN `p_longitud_minima` INT, IN `p_longitud_maxima` INT)  begin
	insert into documento_identidad(codigo, nombre, persona_tipo_id, longitud_minima, longitud_maxima)
	values(p_codigo, p_nombre, p_persona_tipo_id, p_longitud_minima, p_longitud_maxima);
END$$

DROP PROCEDURE IF EXISTS `documento_identidad_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `documento_identidad_list` ()  begin
	select di.codigo, di.nombre, pt.nombre as persona_tipo,
	longitud_minima, longitud_maxima
	from documento_identidad di
	inner join persona_tipo pt on di.persona_tipo_id = pt.codigo;
END$$

DROP PROCEDURE IF EXISTS `documento_identidad_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `documento_identidad_u` (IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100), IN `p_persona_tipo_id` CHAR(1), IN `p_longitud_minima` INT, IN `p_longitud_maxima` INT)  begin
	update documento_identidad
	set nombre = p_nombre,
	persona_tipo_id = p_persona_tipo_id,
	longitud_minima = p_longitud_minima,
	longitud_maxima = p_longitud_maxima
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `email_tipo_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `email_tipo_d` (IN `p_codigo` VARCHAR(10))  begin
	delete from email_tipo where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `email_tipo_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `email_tipo_get` (IN `p_codigo` VARCHAR(10))  begin
	select nombre
	from email_tipo
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `email_tipo_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `email_tipo_i` (IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100))  begin
	insert into email_tipo(codigo, nombre)
	values(p_codigo, p_nombre);
END$$

DROP PROCEDURE IF EXISTS `email_tipo_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `email_tipo_list` ()  begin
	select codigo, nombre from email_tipo;
END$$

DROP PROCEDURE IF EXISTS `email_tipo_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `email_tipo_u` (IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100))  begin
	update email_tipo
	set nombre = p_nombre
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `estado_civil_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `estado_civil_d` (IN `p_codigo` CHAR(1))  begin
	delete from estado_civil where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `estado_civil_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `estado_civil_get` (IN `p_codigo` CHAR(1))  begin
	select nombre from estado_civil where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `estado_civil_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `estado_civil_i` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(100))  begin
	insert into estado_civil(codigo, nombre)
	values(p_codigo, p_nombre);
END$$

DROP PROCEDURE IF EXISTS `estado_civil_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `estado_civil_list` ()  begin
	select codigo, nombre from estado_civil;
END$$

DROP PROCEDURE IF EXISTS `estado_civil_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `estado_civil_u` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(100))  begin
	update estado_civil
	set nombre = p_nombre
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `forma_pago_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `forma_pago_d` (IN `p_codigo` CHAR(1))  begin
	delete from forma_pago where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `forma_pago_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `forma_pago_get` (IN `p_codigo` CHAR(1))  begin
	select nombre
	from forma_pago
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `forma_pago_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `forma_pago_i` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(100))  begin
	insert into forma_pago(codigo, nombre)
	values(p_codigo, p_nombre);
END$$

DROP PROCEDURE IF EXISTS `forma_pago_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `forma_pago_list` ()  begin
	select codigo, nombre
	from forma_pago;
END$$

DROP PROCEDURE IF EXISTS `forma_pago_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `forma_pago_u` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(100))  begin
	update forma_pago 
	set nombre = p_nombre 
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `genero_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `genero_d` (IN `p_codigo` CHAR(1))  begin
	delete from genero where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `genero_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `genero_get` (IN `p_codigo` CHAR(1))  begin
	select nombre from genero where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `genero_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `genero_i` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(20))  begin
	insert into genero(codigo, nombre)
	values(p_codigo, p_nombre);
END$$

DROP PROCEDURE IF EXISTS `genero_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `genero_list` ()  begin
	select codigo, nombre from genero;
END$$

DROP PROCEDURE IF EXISTS `genero_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `genero_u` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(20))  begin
	update genero
	set nombre = p_nombre
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `kardex_del`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_del` (IN `p_id` INT)  begin
	update kardex
	set del = true
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `kardex_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_i` (IN `p_almacen_id` INT, IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_cantidad` DECIMAL(20,2), IN `p_fecha_ingreso` VARCHAR(10), IN `p_fecha_vencimiento` VARCHAR(10))  begin
	insert into kardex(almacen_id, producto_id, unidad_medida_id, cantidad,
		fecha_ingreso,
		fecha_vencimiento)
	values(p_almacen_id, p_producto_id, p_unidad_medida_id, p_cantidad,
		_get_date_from_varchar(p_fecha_ingreso),
		_get_date_from_varchar(p_fecha_vencimiento));
	
	select max(id) as id
	from kardex
	where almacen_id = p_almacen_id and
		producto_id = p_producto_id and
		unidad_medida_id = p_unidad_medida_id and
		cantidad = p_cantidad and
		fecha_ingreso = _get_date_from_varchar(p_fecha_ingreso);
END$$

DROP PROCEDURE IF EXISTS `kardex_list_by_almacen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_list_by_almacen` (IN `p_almacen_id` INT)  begin
	select k.id, k.almacen_id, k.producto_id, k.cantidad,
	k.unidad_medida_id, um.nombre as unidad_medida,
	p.nombre as producto,
	_get_varchar_from_date(k.fecha_ingreso) as fecha_ingreso,
	ifnull(_get_varchar_from_date(k.fecha_vencimiento), '')as fecha_vencimiento
	from kardex k
	inner join producto p on k.producto_id = p.id
	inner join unidad_medida um on k.unidad_medida_id = um.codigo
	where k.almacen_id = p_almacen_id
	and del = false;
END$$

DROP PROCEDURE IF EXISTS `kardex_list_by_almacen_producto_unidad_medida`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_list_by_almacen_producto_unidad_medida` (IN `p_almacen_id` INT, IN `p_producto_id` INT, IN `p_unidad_medida_id` INT)  begin
	select cantidad,
		_get_varchar_from_date(fecha_ingreso) as fecha_ingreso,
		_get_varchar_from_date(fecha_vencimiento) as fecha_vencimiento
	where almacen_id = p_almacen_id and producto_id = p_producto_id
		and unidad_medida_id = p_unidad_medida_id and del = false;
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_get_max_id_by_kardex`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_get_max_id_by_kardex` (IN `p_kardex_id` INT)  begin
	select max(id) as id
	from kardex_movimiento
	where kardex_id = p_kardex_id;
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_i_almacen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_i_almacen` (IN `p_id` INT, IN `p_kardex_id` INT, IN `p_kardex_origen_id` INT, IN `p_almacen_origen_id` INT, IN `p_almacen_id` INT, IN `p_cantidad` DECIMAL(20,2), IN `p_per_reg_aud` VARCHAR(500))  begin
	insert into kardex_movimiento(kardex_id,
		tipo_movimiento,
		almacen_id,
		producto_id, unidad_medida_id, cantidad, motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo,
		guia_remision, guia_remision_pagada,
		per_reg_aud, fec_reg_aud, kardex_origen_id)
	select p_kardex_id, 
		'I_ALMACEN',
		p_almacen_id,
		producto_id, unidad_medida_id, p_cantidad, motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, p_almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo,
		guia_remision, guia_remision_pagada,
		p_per_reg_aud, now(), p_kardex_origen_id
	from kardex_movimiento
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_i_almacen_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_i_almacen_update` (IN `p_id` INT, IN `p_cantidad` DECIMAL(20,2), IN `p_per_reg_aud` VARCHAR(500))  begin
	insert into kardex_movimiento(kardex_id,
		tipo_movimiento,
		almacen_id,
		producto_id, unidad_medida_id, cantidad, motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo,
		guia_remision, guia_remision_pagada,
		per_reg_aud, fec_reg_aud, kardex_origen_id)
	select kardex_id, 
		if(p_cantidad > 0, 'I_ALMACEN_UPDATE', 'I_ALMACEN_UPDATE_FINISH'),
		almacen_id,
		producto_id, unidad_medida_id, p_cantidad, motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo,
		guia_remision, guia_remision_pagada,
		p_per_reg_aud, now(), kardex_origen_id
	from kardex_movimiento
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_i_convert_new`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_i_convert_new` (IN `p_id` INT, IN `p_kardex_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_cantidad` DECIMAL(20,2), IN `p_kardex_origen_id` INT, IN `p_per_reg_aud` VARCHAR(500))  begin
	insert into kardex_movimiento(kardex_id,
		tipo_movimiento,
		almacen_id,
		producto_id, unidad_medida_id, cantidad, motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo,
		guia_remision, guia_remision_pagada,
		per_reg_aud, fec_reg_aud, kardex_origen_id)
	select p_kardex_id, 
		'I_CONVERT_NEW',
		almacen_id,
		producto_id, p_unidad_medida_id, p_cantidad, motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo,
		guia_remision, guia_remision_pagada,
		p_per_reg_aud, now(), p_kardex_origen_id
	from kardex_movimiento
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_i_convert_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_i_convert_update` (IN `p_id` INT, IN `p_cantidad` DECIMAL(20,2), IN `p_per_reg_aud` VARCHAR(500))  begin
	insert into kardex_movimiento(kardex_id,
		tipo_movimiento,
		almacen_id,
		producto_id, unidad_medida_id, cantidad, motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo,
		guia_remision, guia_remision_pagada,
		per_reg_aud, fec_reg_aud, kardex_origen_id)
	select kardex_id, 
		if(p_cantidad > 0, 'I_CONVERT_UPDATE', 'I_CONVERT_UPDATE_FINISH'),
		almacen_id,
		producto_id, unidad_medida_id, p_cantidad, motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo,
		guia_remision, guia_remision_pagada,
		p_per_reg_aud, now(), kardex_origen_id
	from kardex_movimiento
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_i_orden_compra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_i_orden_compra` (IN `p_kardex_id` INT, IN `p_almacen_id` INT, IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_cantidad` DECIMAL(20,2), IN `p_fecha_movimiento` VARCHAR(10), IN `p_fecha_vencimiento` VARCHAR(10), IN `p_precio` DECIMAL(20,2), IN `p_per_reg_aud` VARCHAR(500), IN `p_guia_remision` VARCHAR(100), IN `p_orden_compra_id` INT)  begin
	insert into kardex_movimiento(kardex_id,
		tipo_movimiento, almacen_id, producto_id, unidad_medida_id,
		cantidad, fecha_movimiento,
		fecha_vencimiento,
		precio,
		per_reg_aud, fec_reg_aud,
		guia_remision, guia_remision_pagada,
		orden_compra_id)
	values(p_kardex_id,
		'I_OC', p_almacen_id, p_producto_id, p_unidad_medida_id,
		p_cantidad, _get_date_from_varchar(p_fecha_movimiento),
		_get_date_from_varchar(p_fecha_vencimiento), 
		p_precio,
		p_per_reg_aud, now(),
		p_guia_remision, false,
		p_orden_compra_id);
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_i_producto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_i_producto` (IN `p_kardex_id` INT, IN `p_almacen_id` INT, IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_cantidad` DECIMAL(20,2), IN `p_fecha_movimiento` VARCHAR(10), IN `p_fecha_vencimiento` VARCHAR(10), IN `p_precio` DECIMAL(20,2), IN `p_comprobante_pago_tipo_id` CHAR(1), IN `p_comprobante_pago_codigo` VARCHAR(100), IN `p_per_reg_aud` VARCHAR(500))  begin
	insert into kardex_movimiento(kardex_id,
		tipo_movimiento, almacen_id, producto_id, unidad_medida_id,
		cantidad, fecha_movimiento,
		fecha_vencimiento,
		precio,
		comprobante_pago_tipo_id,
		comprobante_pago_codigo,
		per_reg_aud, fec_reg_aud)
	values(p_kardex_id,
		'I_PRODUCTO', p_almacen_id, p_producto_id, p_unidad_medida_id,
		p_cantidad, _get_date_from_varchar(p_fecha_movimiento),
		_get_date_from_varchar(p_fecha_vencimiento), 
		p_precio,
		_get_null_or_value_from_varchar(p_comprobante_pago_tipo_id),
		_get_null_or_value_from_varchar(p_comprobante_pago_codigo),
		p_per_reg_aud, now());
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_i_s_proyecto_trabajo_partida`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_i_s_proyecto_trabajo_partida` (IN `p_id` INT, IN `p_cantidad` DECIMAL(20,2), IN `p_cantidad_salida` DECIMAL(20,2), IN `p_per_reg_aud` VARCHAR(500), IN `p_proyecto_trabajo_partida_salida_id` INT)  begin
	insert into kardex_movimiento(kardex_id,
		tipo_movimiento,
		almacen_id,
		producto_id, unidad_medida_id,
		cantidad, cantidad_salida,
		motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo, 
		guia_remision, guia_remision_pagada,
		per_reg_aud, fec_reg_aud, kardex_origen_id,
		proyecto_trabajo_partida_salida_id)
	select kardex_id, 
		'S_PARTIDA',
		almacen_id,
		producto_id, unidad_medida_id,
		p_cantidad, p_cantidad_salida,
		motivo, fecha_movimiento,
		fecha_vencimiento, fecha_termino, precio, almacen_origen_id,
		proyecto_origen_id, proyecto_trabajo_partida_origen_id,
		orden_compra_id,
		comprobante_pago_tipo_id, comprobante_pago_codigo, 
		guia_remision, guia_remision_pagada,
		p_per_reg_aud, now(), kardex_origen_id,
		p_proyecto_trabajo_partida_salida_id
	from kardex_movimiento
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_list_by_oc_and_guia_remision`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_list_by_oc_and_guia_remision` (IN `p_orden_compra_id` INT, IN `p_guia_remision` VARCHAR(100))  begin
	select km.id, km.producto_id, p.nombre as producto,
		km.unidad_medida_id, um.nombre as unidad_medida,
		km.cantidad, km.precio
	from kardex_movimiento km
	inner join producto p on km.producto_id = p.id
	inner join unidad_medida um on km.unidad_medida_id = um.codigo
	where km.orden_compra_id = p_orden_compra_id
		and km.guia_remision = p_guia_remision
		and km.tipo_movimiento = 'I_OC'
		and km.guia_remision_pagada = false;
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_report_by_almacen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_report_by_almacen` (IN `p_almacen_id` INT, IN `p_fecha_inicio` VARCHAR(10), IN `p_fecha_termino` VARCHAR(10))  begin
	select km.tipo_movimiento,
		p.nombre as producto,
		um.nombre as unidad_medida,
		cantidad,
		_get_varchar_from_date(fecha_movimiento) as fecha_movimiento,
		ifnull(_get_varchar_from_date(fecha_vencimiento), '') as fecha_vencimiento,
		ifnull(_get_varchar_from_date(fecha_termino), '') as fecha_termino,
		precio,
		ao.nombre as almacen_origen,
		pro.nombre as proyecto,
		ptp.nombre as proyecto_trabajo_partida,
		oc.codigo as orden_compra,
		cpt.nombre as comprobante_pago_tipo,
		ifnull(comprobante_pago_codigo, '') as comprobante_pago_codigo,
		per_reg_aud,
		fec_reg_aud,
		#kardex_origen_id
		ifnull(guia_remision, '') as guia_remision,
		if(guia_remision_pagada = 1, 'SI', 'NO') as guia_remision_pagada,
		ifnull(cantidad_salida, 0),
		ptps.nombre as proyecto_trabajo_partida_salida
	from kardex_movimiento km
	inner join producto p on km.producto_id = p.id
	inner join unidad_medida um on km.unidad_medida_id = um.codigo
	left join almacen ao on km.almacen_origen_id = ao.id
	left join proyecto pro on km.proyecto_origen_id = pro.id
	left join proyecto_trabajo_partida ptp on km.proyecto_trabajo_partida_origen_id = ptp.id
	left join orden_compra oc on km.orden_compra_id = oc.id
	left join comprobante_pago_tipo cpt on km.comprobante_pago_tipo_id = cpt.codigo
	left join proyecto_trabajo_partida ptps on km.proyecto_trabajo_partida_salida_id = ptps.id 
	where km.almacen_id = p_almacen_id
		and (km.fecha_movimiento between _get_date_from_varchar(p_fecha_inicio) and _get_date_from_varchar(p_fecha_termino));
END$$

DROP PROCEDURE IF EXISTS `kardex_movimiento_u_guia_remision_pagada`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_movimiento_u_guia_remision_pagada` (IN `p_id` INT, IN `p_guia_remision_pagada` BOOL)  begin
	update kardex_movimiento
	set guia_remision_pagada = p_guia_remision_pagada
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `kardex_u_cantidad`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kardex_u_cantidad` (IN `p_id` INT, IN `p_cantidad` DECIMAL(20,2))  begin
	update kardex 
	set cantidad = p_cantidad,
	fecha_termino = if(p_cantidad=0, now(), null),
	del = if(p_cantidad=0, true, false)
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_d` (IN `p_id` INT)  begin
	delete from orden_compra where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_detalle_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_detalle_d` (IN `p_id` INT)  begin
	delete from orden_compra_detalle where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_detalle_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_detalle_get` (IN `p_id` INT)  begin
	select producto_id, unidad_medida_id, cantidad, precio_unitario
	from orden_compra_detalle
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_detalle_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_detalle_i` (IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_cantidad` DECIMAL(20,2), IN `p_precio_unitario` DECIMAL(20,2), IN `p_orden_compra_id` INT)  begin
	insert into orden_compra_detalle(producto_id, unidad_medida_id, cantidad,
		cantidad_restante,
		precio_unitario, orden_compra_id)
	values(p_producto_id, p_unidad_medida_id, p_cantidad,
		p_cantidad,
		p_precio_unitario, p_orden_compra_id);
END$$

DROP PROCEDURE IF EXISTS `orden_compra_detalle_list_by_orden_compra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_detalle_list_by_orden_compra` (IN `p_orden_compra_id` INT)  begin
	select oc.id, p.nombre as producto, um.nombre as unidad_medida,
	oc.cantidad, oc.cantidad_usada, oc.cantidad_restante,
	oc.precio_unitario, oc.in_progress, oc.used
	from orden_compra_detalle oc
		inner join producto p on oc.producto_id = p.id
		inner join unidad_medida um on oc.unidad_medida_id = um.codigo
	where oc.orden_compra_id = p_orden_compra_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_detalle_list_dont_used_by_orden_compra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_detalle_list_dont_used_by_orden_compra` (IN `p_orden_compra_id` INT)  begin
	select oc.id, p.nombre as producto, um.nombre as unidad_medida,
	oc.cantidad, oc.cantidad_usada, oc.cantidad_restante, oc.precio_unitario,
	oc.producto_id, oc.unidad_medida_id, oc.in_progress 
	from orden_compra_detalle oc
		inner join producto p on oc.producto_id = p.id
		inner join unidad_medida um on oc.unidad_medida_id = um.codigo
	where oc.orden_compra_id = p_orden_compra_id
	and oc.used = false;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_detalle_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_detalle_u` (IN `p_id` INT, IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_cantidad` DECIMAL(20,2), IN `p_precio_unitario` DECIMAL(20,2))  begin
	update orden_compra_detalle
	set producto_id = p_producto_id,
		unidad_medida_id = p_unidad_medida_id,
		cantidad = p_cantidad,
		precio_unitario = p_precio_unitario
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_detalle_u_in_progress_and_used_and_cantidad`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_detalle_u_in_progress_and_used_and_cantidad` (IN `p_id` INT, IN `p_in_progress` BOOL, IN `p_used` BOOL, IN `p_cantidad_usada` DECIMAL(20,2))  begin
	update orden_compra_detalle
	set used = p_used,
		in_progress = p_in_progress,
		cantidad_usada = cantidad_usada + p_cantidad_usada,
		cantidad_restante = cantidad_restante - p_cantidad_usada 
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_generate_next_codigo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_generate_next_codigo` ()  begin
	select CONCAT('OC-', lpad(ifnull(max(replace(codigo, 'OC-', '')), 0) + 1, 6, 0)) as next_codigo from orden_compra;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_get` (IN `p_id` INT)  begin
	select id, persona_proveedor_id, _get_varchar_from_date(fecha) as fecha,
	proforma_codigo, codigo
	from orden_compra
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_i` (IN `p_persona_proveedor_id` INT, IN `p_fecha` VARCHAR(10), IN `p_proforma_codigo` VARCHAR(100), IN `p_codigo` VARCHAR(100))  begin
	insert into orden_compra(persona_proveedor_id, fecha, proforma_codigo, codigo)
	values(p_persona_proveedor_id, _get_date_from_varchar(p_fecha), p_proforma_codigo, p_codigo);
	
	select max(id) id
	from orden_compra
	where persona_proveedor_id = p_persona_proveedor_id and fecha = _get_date_from_varchar(p_fecha)
		and proforma_codigo = p_proforma_codigo and codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_list` ()  begin
	select oc.id, 
	p.nombre_1 as proveedor, 
	_get_varchar_from_date(oc.fecha) as fecha,
	oc.proforma_codigo, oc.codigo,
	oc.used,
	oc.can_delete
	from orden_compra oc
	inner join persona p on oc.persona_proveedor_id = p.id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_list_dont_used`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_list_dont_used` ()  begin
	select oc.id, 
		p.nombre_1 as proveedor, 
		_get_varchar_from_date(oc.fecha) as fecha,
		oc.proforma_codigo, oc.codigo,
		oc.can_delete
	from orden_compra oc
	inner join persona p on oc.persona_proveedor_id = p.id
	where oc.used = false;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_report_by_fecha_inicio_termino`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_report_by_fecha_inicio_termino` (IN `p_fecha_inicio` VARCHAR(10), IN `p_fecha_termino` VARCHAR(10))  begin
	select oc.id, 
	p.nombre_1 as proveedor, 
	_get_varchar_from_date(oc.fecha) as fecha,
	oc.proforma_codigo, oc.codigo,
	oc.used,
	oc.can_delete
	from orden_compra oc
	inner join persona p on oc.persona_proveedor_id = p.id
	where oc.fecha between _get_date_from_varchar(p_fecha_inicio) and _get_date_from_varchar(p_fecha_termino);
END$$

DROP PROCEDURE IF EXISTS `orden_compra_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_u` (IN `p_id` INT, IN `p_persona_proveedor_id` INT, IN `p_fecha` VARCHAR(10), IN `p_proforma_codigo` VARCHAR(100), IN `p_codigo` VARCHAR(100))  begin
	update orden_compra
	set persona_proveedor_id = p_persona_proveedor_id,
	fecha = _get_date_from_varchar(p_fecha),
	proforma_codigo = p_proforma_codigo,
	codigo = p_codigo
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_u_can_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_u_can_delete` (IN `p_id` INT, IN `p_can_delete` BOOL)  begin
	update orden_compra
	set can_delete = p_can_delete
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `orden_compra_u_used`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orden_compra_u_used` (IN `p_id` INT, IN `p_used` BOOL)  begin
	update orden_compra
	set used = p_used
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `pago_contratista_count_by_proyecto_trabajo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_contratista_count_by_proyecto_trabajo` (IN `p_proyecto_trabajo_id` INT)  begin
	select count(*) as cantidad
	from pago_contratista
	where proyecto_trabajo_id = p_proyecto_trabajo_id;
END$$

DROP PROCEDURE IF EXISTS `pago_contratista_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_contratista_d` (IN `p_id` INT)  begin
	delete from pago_contratista where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `pago_contratista_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_contratista_get` (IN `p_id` INT)  begin
	select persona_contratista_id,
		proyecto_trabajo_id,
		proyecto_id,
		_get_varchar_from_date(fecha_inicio) as fecha_inicio,
		_get_varchar_from_date(fecha_termino) as fecha_termino,
		valor_venta,
		amortizacion_adelanto,
		retencion_fondo_garantia,
		sub_total,
		igv,
		total,
		detraccion,
		neto_pagar,
		pagado
	from pago_contratista
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `pago_contratista_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_contratista_i` (IN `p_persona_contratista_id` INT, IN `p_proyecto_trabajo_id` INT, IN `p_proyecto_id` INT, IN `p_fecha_inicio` VARCHAR(10), IN `p_fecha_termino` VARCHAR(10), IN `p_valor_venta` DECIMAL(20,2), IN `p_amortizacion_adelanto` DECIMAL(20,2), IN `p_retencion_fondo_garantia` DECIMAL(20,2), IN `p_sub_total` DECIMAL(20,2), IN `p_igv` DECIMAL(20,2), IN `p_total` DECIMAL(20,2), IN `p_detraccion` DECIMAL(20,2), IN `p_neto_pagar` DECIMAL(20,2), IN `p_pagado` BOOL)  begin
	insert into pago_contratista(persona_contratista_id, proyecto_trabajo_id,
		proyecto_id,
		fecha_inicio,
		fecha_termino,
		valor_venta,
		amortizacion_adelanto,
		retencion_fondo_garantia,
		sub_total,
		igv,
		total,
		detraccion,
		neto_pagar,
		pagado)
	values(p_persona_contratista_id, p_proyecto_trabajo_id,
		p_proyecto_id,
		_get_date_from_varchar(p_fecha_inicio),
		_get_date_from_varchar(p_fecha_termino),
		p_valor_venta,
		p_amortizacion_adelanto,
		p_retencion_fondo_garantia,
		p_sub_total,
		p_igv,
		p_total,
		p_detraccion,
		p_neto_pagar,
		p_pagado);
	
	select max(id) as id
	from pago_contratista
	where persona_contratista_id = p_persona_contratista_id
		and proyecto_trabajo_id = p_proyecto_trabajo_id
		and proyecto_id = p_proyecto_id
		and fecha_inicio = _get_date_from_varchar(p_fecha_inicio)
		and fecha_termino = _get_date_from_varchar(p_fecha_termino)
		and valor_venta = p_valor_venta
		and pagado = p_pagado;
END$$

DROP PROCEDURE IF EXISTS `pago_contratista_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_contratista_list` ()  begin
	select pc.id,
		pc.persona_contratista_id, p.nombre_1 as contratista,
		pc.proyecto_trabajo_id, pt.nombre as proyecto_trabajo,
		pc.proyecto_id, pro.nombre as proyecto,
		_get_varchar_from_date(pc.fecha_inicio) as fecha_inicio,
		_get_varchar_from_date(pc.fecha_termino) as fecha_termino,
		pc.valor_venta,
		pc.amortizacion_adelanto,
		pc.retencion_fondo_garantia,
		pc.sub_total,
		pc.igv,
		pc.total,
		pc.detraccion,
		pc.neto_pagar,
		pc.pagado
	from pago_contratista pc
	inner join persona p on pc.persona_contratista_id = p.id
	inner join proyecto_trabajo pt on pc.proyecto_trabajo_id = pt.id
	inner join proyecto pro on pc.proyecto_id = pro.id;
END$$

DROP PROCEDURE IF EXISTS `pago_contratista_u_pagado`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_contratista_u_pagado` (IN `p_id` INT, IN `p_pagado` BOOL)  begin
	update pago_contratista
	set pagado = p_pagado
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_d` (IN `p_id` INT)  begin
	delete from pago_proveedor where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_detalle_d_by_pago_proveedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_detalle_d_by_pago_proveedor` (IN `p_pago_proveedor_id` INT)  begin
	delete from pago_proveedor_detalle where pago_proveedor_id = p_pago_proveedor_id;
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_detalle_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_detalle_i` (IN `p_pago_proveedor_id` INT, IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_precio_unitario` DECIMAL(20,2), IN `p_cantidad` DECIMAL(20,2), IN `p_sub_total` DECIMAL(20,2))  begin
	insert into pago_proveedor_detalle(pago_proveedor_id, producto_id,
		unidad_medida_id, precio_unitario, cantidad, sub_total)
	values(p_pago_proveedor_id, p_producto_id,
		p_unidad_medida_id, p_precio_unitario, p_cantidad, p_sub_total);
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_detalle_list_by_pago_proveedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_detalle_list_by_pago_proveedor` (IN `p_pago_proveedor_id` INT)  begin
	select ppd.id, p.nombre as producto, um.nombre as unidad_medida,
		ppd.precio_unitario, ppd.cantidad, ppd.sub_total
	from pago_proveedor_detalle ppd
	inner join producto p on ppd.producto_id = p.id
	inner join unidad_medida um on ppd.unidad_medida_id = um.codigo
	where ppd.pago_proveedor_id = p_pago_proveedor_id;
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_get` (IN `p_id` INT)  begin
	select orden_compra_id, guia_remision, persona_proveedor,
		comprobante_pago_tipo_id, comprobante_pago_codigo,
		_get_varchar_from_date(fecha_pago) as fecha_pago,
		monto_total,
		pagado
	from pago_proveedor
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_i` (IN `p_orden_compra_id` INT, IN `p_guia_remision` VARCHAR(100), IN `p_persona_proveedor` VARCHAR(100), IN `p_comprobante_pago_tipo_id` CHAR(1), IN `p_comprobante_pago_codigo` VARCHAR(100), IN `p_fecha_pago` VARCHAR(10), IN `p_monto_total` DECIMAL(20,2), IN `p_pagado` BOOL)  begin
	insert into pago_proveedor(orden_compra_id, guia_remision, persona_proveedor,
		comprobante_pago_tipo_id, comprobante_pago_codigo, fecha_pago,
		monto_total, pagado)
	values(p_orden_compra_id, p_guia_remision, p_persona_proveedor,
		p_comprobante_pago_tipo_id, p_comprobante_pago_codigo, _get_date_from_varchar(p_fecha_pago),
		p_monto_total, p_pagado);
	
	select max(id) as id
	from pago_proveedor
	where orden_compra_id = p_orden_compra_id and guia_remision = p_guia_remision
		and comprobante_pago_tipo_id = p_comprobante_pago_tipo_id
		and comprobante_pago_codigo = p_comprobante_pago_codigo
		and monto_total = p_monto_total;
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_list` ()  begin
	select pp.id, oc.codigo as orden_compra, pp.guia_remision, pp.persona_proveedor,
		cpt.nombre as comprobante_pago_tipo, comprobante_pago_codigo,
		_get_varchar_from_date(fecha_pago) as fecha_pago,
		monto_total,
		pagado
	from pago_proveedor pp
	inner join orden_compra oc on pp.orden_compra_id = oc.id
	inner join comprobante_pago_tipo cpt on pp.comprobante_pago_tipo_id = cpt.codigo;
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_report_by_fecha_pago_inicio_termino`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_report_by_fecha_pago_inicio_termino` (IN `p_fecha_pago_inicio` VARCHAR(10), IN `p_fecha_pago_termino` VARCHAR(10))  begin
	select pp.id, oc.codigo as orden_compra, pp.guia_remision, pp.persona_proveedor,
		cpt.nombre as comprobante_pago_tipo, comprobante_pago_codigo,
		_get_varchar_from_date(fecha_pago) as fecha_pago,
		monto_total,
		pagado
	from pago_proveedor pp
	inner join orden_compra oc on pp.orden_compra_id = oc.id
	inner join comprobante_pago_tipo cpt on pp.comprobante_pago_tipo_id = cpt.codigo
	where pp.fecha_pago between _get_date_from_varchar(p_fecha_pago_inicio) and _get_date_from_varchar(p_fecha_pago_termino);
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_u` (IN `p_id` INT, IN `p_comprobante_pago_tipo_id` CHAR(1), IN `p_comprobante_pago_codigo` VARCHAR(100), IN `p_fecha_pago` VARCHAR(10), IN `p_pagado` BOOL)  begin
	update pago_proveedor
	set comprobante_pago_tipo_id = p_comprobante_pago_tipo_id,
		comprobante_pago_codigo = p_comprobante_pago_codigo,
		fecha_pago = _get_date_from_varchar(p_fecha_pago),
		pagado = p_pagado
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_u_monto_total`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_u_monto_total` (IN `p_id` INT, IN `p_monto_total` DECIMAL(20,2))  begin
	update pago_proveedor
	set monto_total = p_monto_total
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `pago_proveedor_u_pagado`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pago_proveedor_u_pagado` (IN `p_id` INT, IN `p_pagado` BOOL)  begin
	update pago_proveedor
	set pagado = p_pagado
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_d` (IN `p_id` INT)  begin
	delete from persona where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_direccion_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_direccion_d` (IN `p_id` INT)  begin
	delete from persona_direccion where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_direccion_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_direccion_get` (IN `p_id` INT)  begin
	select ubigeo_peru_department_id,
		ubigeo_peru_province_id,
		ubigeo_peru_district_id,
		direccion,
		referencia
	from persona_direccion
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_direccion_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_direccion_i` (IN `p_ubigeo_peru_department_id` VARCHAR(2), IN `p_ubigeo_peru_province_id` VARCHAR(4), IN `p_ubigeo_peru_district_id` VARCHAR(6), IN `p_direccion` VARCHAR(200), IN `p_referencia` VARCHAR(200), IN `p_persona_id` INT)  begin
	insert into persona_direccion(ubigeo_peru_department_id, ubigeo_peru_province_id,
		ubigeo_peru_district_id, direccion, referencia, persona_id)
	values(p_ubigeo_peru_department_id, p_ubigeo_peru_province_id,
		p_ubigeo_peru_district_id, p_direccion, p_referencia, p_persona_id);
	
	select max(id) as id
	from persona_direccion
	where ubigeo_peru_department_id = p_ubigeo_peru_department_id
		and ubigeo_peru_province_id = p_ubigeo_peru_province_id
		and ubigeo_peru_district_id = p_ubigeo_peru_district_id
		and direccion = p_direccion
		and referencia = p_referencia
		and persona_id = p_persona_id;
END$$

DROP PROCEDURE IF EXISTS `persona_direccion_list_by_persona`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_direccion_list_by_persona` (IN `p_persona_id` INT)  begin
	select pd.id,
		upd.name as departamento,
		upp.name as provincia,
		updi.name as distrito,
		direccion,
		referencia
	from persona_direccion pd
	inner join ubigeo_peru_departments upd on pd.ubigeo_peru_department_id = upd.id
	inner join ubigeo_peru_provinces upp on pd.ubigeo_peru_province_id = upp.id
	inner join ubigeo_peru_districts updi on pd.ubigeo_peru_district_id = updi.id
	where persona_id = p_persona_id;
END$$

DROP PROCEDURE IF EXISTS `persona_direccion_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_direccion_u` (IN `p_id` INT, IN `p_ubigeo_peru_department_id` VARCHAR(2), IN `p_ubigeo_peru_province_id` VARCHAR(4), IN `p_ubigeo_peru_district_id` VARCHAR(6), IN `p_direccion` VARCHAR(200), IN `p_referencia` VARCHAR(200))  begin
	update persona_direccion
	set ubigeo_peru_department_id = p_ubigeo_peru_department_id,
		ubigeo_peru_province_id = p_ubigeo_peru_province_id,
		ubigeo_peru_district_id = p_ubigeo_peru_district_id,
		direccion = p_direccion,
		referencia = p_referencia
	where id = p_id;
end$$

DROP PROCEDURE IF EXISTS `persona_email_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_email_d` (IN `p_id` INT)  begin
	delete from persona_email where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_email_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_email_get` (IN `p_id` INT)  begin
	select email_tipo_id, email
	from persona_email
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_email_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_email_i` (IN `p_email_tipo_id` VARCHAR(10), IN `p_email` VARCHAR(100), IN `p_persona_id` INT)  begin
	insert into persona_email(email_tipo_id, email, persona_id)
	values(p_email_tipo_id, p_email, p_persona_id);

	select max(id) as id
	from persona_email
	where email_tipo_id = p_email_tipo_id
		and email = p_email and persona_id = p_persona_id;
END$$

DROP PROCEDURE IF EXISTS `persona_email_list_by_persona`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_email_list_by_persona` (IN `p_persona_id` INT)  begin
	select id, et.nombre as email_tipo, pe.email
	from persona_email pe
	inner join email_tipo et on pe.email_tipo_id = et.codigo
	where persona_id = persona_id;
END$$

DROP PROCEDURE IF EXISTS `persona_email_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_email_u` (IN `p_id` INT, IN `p_email_tipo_id` VARCHAR(10), IN `p_email` VARCHAR(100))  begin
	update persona_email
	set email_tipo_id = p_email_tipo_id,
	email = p_email
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_get` (IN `p_id` INT)  begin
	select persona_tipo_id,
		documento_identidad_id,
		numero_documento_identidad,
		nombre_1, nombre_2, nombre_3,
		apellido_paterno, apellido_materno,
		genero_id,
		_get_varchar_from_date(fecha_nacimiento) as fecha_nacimiento,
		estado_civil_id,
		profile_image
	from persona
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_get_usuario_clave`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_get_usuario_clave` (IN `p_id` INT)  begin
	select usuario, _get_varchar_from_blob(clave) as clave
	from persona
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_i` (IN `p_persona_tipo_id` CHAR(1), IN `p_documento_identidad_id` CHAR(1), IN `p_numero_documento_identidad` VARCHAR(100), IN `p_nombre_1` VARCHAR(100), IN `p_nombre_2` VARCHAR(100), IN `p_nombre_3` VARCHAR(100), IN `p_apellido_paterno` VARCHAR(100), IN `p_apellido_materno` VARCHAR(100), IN `p_genero_id` CHAR(1), IN `p_fecha_nacimiento` VARCHAR(10), IN `p_estado_civil_id` CHAR(1), IN `p_profile_image` VARCHAR(100))  begin
	insert into 
	persona(persona_tipo_id, documento_identidad_id, numero_documento_identidad,
			nombre_1, nombre_2, nombre_3,
			apellido_paterno, apellido_materno,
			genero_id, fecha_nacimiento, estado_civil_id,
			profile_image)
	values (p_persona_tipo_id, p_documento_identidad_id, p_numero_documento_identidad,
			p_nombre_1, _get_null_or_value_from_varchar(p_nombre_2), _get_null_or_value_from_varchar(p_nombre_3),
			_get_null_or_value_from_varchar(p_apellido_paterno), _get_null_or_value_from_varchar(p_apellido_materno),
			_get_null_or_value_from_varchar(p_genero_id), _get_date_from_varchar(p_fecha_nacimiento), _get_null_or_value_from_varchar(p_estado_civil_id),
			_get_null_or_value_from_varchar(p_profile_image));
END$$

DROP PROCEDURE IF EXISTS `persona_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_list` ()  begin
	select id, 
		p.persona_tipo_id,
		di.nombre as documento_identidad,
		numero_documento_identidad,
		nombre_1, nombre_2, nombre_3,
		apellido_paterno, apellido_materno
	from persona p
	inner join documento_identidad di on p.documento_identidad_id = di.codigo;
END$$

DROP PROCEDURE IF EXISTS `persona_list_by_persona_tipo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_list_by_persona_tipo` (IN `p_persona_tipo_id` CHAR(1))  begin
	select id,
		numero_documento_identidad,
		nombre_1,
		nombre_2,
		nombre_3,
		apellido_paterno,
		apellido_materno
	from persona p
	where persona_tipo_id = p_persona_tipo_id;
END$$

DROP PROCEDURE IF EXISTS `persona_login`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_login` (IN `p_usuario` VARCHAR(20), IN `p_clave` VARCHAR(20))  begin
	select id, nombre_1, nombre_2, apellido_paterno, apellido_materno,
	profile_image, usuario
	from persona
	where usuario = p_usuario
	and _get_varchar_from_blob(clave) = p_clave;
END$$

DROP PROCEDURE IF EXISTS `persona_rol_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_rol_d` (IN `p_id` INT)  begin
	delete from persona_rol where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_rol_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_rol_i` (IN `p_persona_id` INT, IN `p_rol_id` INT)  begin
	insert into persona_rol(persona_id, rol_id)
	values(p_persona_id, p_rol_id);

	select max(id) as id
	from persona_rol
	where persona_id = p_persona_id and rol_id = p_rol_id;
END$$

DROP PROCEDURE IF EXISTS `persona_rol_list_by_persona`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_rol_list_by_persona` (IN `p_persona_id` INT)  begin
	select id, rol_id
	from persona_rol
	where persona_id = p_persona_id;
END$$

DROP PROCEDURE IF EXISTS `persona_rol_list_by_persona_tipo_and_rol_nombre`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_rol_list_by_persona_tipo_and_rol_nombre` (IN `p_persona_tipo_id` CHAR(1), IN `p_rol_nombre` VARCHAR(100))  begin
	select p.id,
		p.numero_documento_identidad,
		p.nombre_1,
		p.nombre_2,
		p.nombre_3,
		p.apellido_paterno,
		p.apellido_materno
	from persona_rol pr
	inner join persona p on pr.persona_id = p.id and p.persona_tipo_id = p_persona_tipo_id
	inner join rol r on pr.rol_id = r.id and r.nombre = p_rol_nombre;
END$$

DROP PROCEDURE IF EXISTS `persona_telefono_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_telefono_d` (IN `p_id` INT)  begin
	delete from persona_telefono where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_telefono_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_telefono_get` (IN `p_id` INT)  begin
	select telefono_tipo_id, telefono
	from persona_telefono
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_telefono_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_telefono_i` (IN `p_telefono_tipo_id` VARCHAR(10), IN `p_telefono` VARCHAR(20), IN `p_persona_id` INT)  begin
	insert into persona_telefono(telefono_tipo_id, telefono, persona_id)
	values(p_telefono_tipo_id, p_telefono, p_persona_id);

	select max(id) as id
	from persona_telefono
	where telefono_tipo_id = p_telefono_tipo_id
		and telefono = p_telefono and persona_id = p_persona_id;
END$$

DROP PROCEDURE IF EXISTS `persona_telefono_list_by_persona`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_telefono_list_by_persona` (IN `p_persona_id` INT)  begin
	select pt.id, tt.nombre as telefono_tipo, telefono
	from persona_telefono pt
	inner join telefono_tipo tt on pt.telefono_tipo_id = tt.codigo
	where pt.persona_id = p_persona_id;
END$$

DROP PROCEDURE IF EXISTS `persona_telefono_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_telefono_u` (IN `p_id` INT, IN `p_telefono_tipo_id` VARCHAR(10), IN `p_telefono` VARCHAR(20))  begin
	update persona_telefono
	set telefono_tipo_id = p_telefono_tipo_id,
	telefono = p_telefono
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `persona_tipo_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_tipo_d` (IN `p_codigo` CHAR(1))  begin
	delete from persona_tipo where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `persona_tipo_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_tipo_get` (IN `p_codigo` CHAR(1))  begin
	select nombre
	from persona_tipo
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `persona_tipo_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_tipo_i` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(100))  begin
	insert into persona_tipo(codigo, nombre)
	values(p_codigo, p_nombre);
END$$

DROP PROCEDURE IF EXISTS `persona_tipo_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_tipo_list` ()  begin
	select codigo, nombre
	from persona_tipo;
END$$

DROP PROCEDURE IF EXISTS `persona_tipo_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_tipo_u` (IN `p_codigo` CHAR(1), IN `p_nombre` VARCHAR(100))  begin
	update persona_tipo
	set nombre = p_nombre
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `persona_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_u` (IN `p_id` INT, IN `p_persona_tipo_id` CHAR(1), IN `p_documento_identidad_id` CHAR(1), IN `p_numero_documento_identidad` VARCHAR(100), IN `p_nombre_1` VARCHAR(100), IN `p_nombre_2` VARCHAR(100), IN `p_nombre_3` VARCHAR(100), IN `p_apellido_paterno` VARCHAR(100), IN `p_apellido_materno` VARCHAR(100), IN `p_genero_id` CHAR(1), IN `p_fecha_nacimiento` VARCHAR(10), IN `p_estado_civil_id` CHAR(1), IN `p_profile_image` VARCHAR(100))  begin
	update persona
	set persona_tipo_id = p_persona_tipo_id,
		documento_identidad_id = p_documento_identidad_id,
		numero_documento_identidad = p_numero_documento_identidad,
		nombre_1 = p_nombre_1,
		nombre_2 = _get_null_or_value_from_varchar(p_nombre_2),
		nombre_3 = _get_null_or_value_from_varchar(p_nombre_3),
		apellido_paterno = _get_null_or_value_from_varchar(p_apellido_paterno),
		apellido_materno = _get_null_or_value_from_varchar(p_apellido_materno),
		genero_id = _get_null_or_value_from_varchar(p_genero_id),
		fecha_nacimiento = _get_date_from_varchar(p_fecha_nacimiento),
		estado_civil_id = _get_null_or_value_from_varchar(p_estado_civil_id)
	where id = p_id;

	if p_profile_image <> '' then
		update persona
		set profile_image = p_profile_image
		where id = p_id;
	end if;
END$$

DROP PROCEDURE IF EXISTS `persona_u_usuario_clave`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_u_usuario_clave` (IN `p_id` INT, IN `p_usuario` VARCHAR(20), IN `p_clave` VARCHAR(20))  begin
	update persona 
	set usuario = p_usuario,
	clave = _get_blob_from_varchar(p_clave)
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_d` (IN `p_id` INT)  begin
	delete from producto where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_generate_next_codigo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_generate_next_codigo` ()  begin
	select CONCAT('PR-', lpad(ifnull(max(replace(codigo, 'PR-', '')), 0) + 1, 6, 0)) as next_codigo from producto;
END$$

DROP PROCEDURE IF EXISTS `producto_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_get` (IN `p_id` INT)  begin
	select codigo, nombre, descripcion, producto_marca_id 
	from producto
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_i` (IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100), IN `p_descripcion` VARCHAR(200), IN `p_producto_marca_id` INT)  begin
	insert into producto(codigo, nombre, descripcion, producto_marca_id)
	values(p_codigo, p_nombre, _get_null_or_value_from_varchar(p_descripcion), _get_null_or_value_from_int(p_producto_marca_id));
END$$

DROP PROCEDURE IF EXISTS `producto_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_list` ()  begin
	select p.id, p.codigo, p.nombre, p.descripcion, pm.nombre as marca
	from producto p
	left join producto_marca pm on p.producto_marca_id = pm.id;
END$$

DROP PROCEDURE IF EXISTS `producto_marca_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_marca_d` (IN `p_id` INT)  begin
	delete from producto_marca where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_marca_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_marca_get` (IN `p_id` INT)  begin
	select nombre from producto_marca where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_marca_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_marca_i` (IN `p_nombre` VARCHAR(100))  begin
	insert into producto_marca(nombre)
	values(p_nombre);
END$$

DROP PROCEDURE IF EXISTS `producto_marca_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_marca_list` ()  begin
	select id, nombre
	from producto_marca;
END$$

DROP PROCEDURE IF EXISTS `producto_marca_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_marca_u` (IN `p_id` INT, IN `p_nombre` VARCHAR(100))  begin
	update producto_marca
	set nombre = p_nombre
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_stock_minimo_alert_stock_minimo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_stock_minimo_alert_stock_minimo` ()  begin
	select psm.unidad_medida_id, psm.stock_minimo,
		p.codigo, p.nombre
	from producto_stock_minimo psm
	inner join producto p on psm.producto_id = p.id
	inner join unidad_medida um on psm.unidad_medida_id = um.codigo
	where psm.stock_minimo >= (
								select sum(k.cantidad)
								from kardex k
								where k.del = false
									and k.producto_id = psm.producto_id
									and k.unidad_medida_id = psm.unidad_medida_id
							   );
END$$

DROP PROCEDURE IF EXISTS `producto_stock_minimo_count_by_producto_and_unidad_medida`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_stock_minimo_count_by_producto_and_unidad_medida` (IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10))  begin
	select count(*) as cantidad
	from producto_stock_minimo
	where producto_id = p_producto_id
		and unidad_medida_id = p_unidad_medida_id;
END$$

DROP PROCEDURE IF EXISTS `producto_stock_minimo_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_stock_minimo_d` (IN `p_id` INT)  begin
	delete from producto_stock_minimo where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_stock_minimo_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_stock_minimo_get` (IN `p_id` INT)  begin
	select unidad_medida_id, stock_minimo
	from producto_stock_minimo
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_stock_minimo_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_stock_minimo_i` (IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_stock_minimo` DECIMAL(20,2))  begin
	insert into producto_stock_minimo(producto_id, unidad_medida_id, stock_minimo)
	values(p_producto_id, p_unidad_medida_id, p_stock_minimo);
END$$

DROP PROCEDURE IF EXISTS `producto_stock_minimo_list_by_producto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_stock_minimo_list_by_producto` (IN `p_producto_id` INT)  begin
	select id, unidad_medida_id, stock_minimo 
	from producto_stock_minimo
	where producto_id = producto_id;
END$$

DROP PROCEDURE IF EXISTS `producto_stock_minimo_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_stock_minimo_u` (IN `p_id` INT, IN `p_stock_minimo` DECIMAL(20,2))  begin
	update producto_stock_minimo
	set stock_minimo = p_stock_minimo
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_u` (IN `p_id` INT, IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100), IN `p_descripcion` VARCHAR(200), IN `p_producto_marca_id` INT)  begin
	update producto 
	set codigo = p_codigo,
		nombre = p_nombre,
		descripcion= _get_null_or_value_from_varchar(p_descripcion),
		producto_marca_id  = _get_null_or_value_from_int(p_producto_marca_id)
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_unidad_medida_count_by_producto_and_um_i_and_um_s`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_unidad_medida_count_by_producto_and_um_i_and_um_s` (IN `p_producto_id` INT, IN `p_unidad_medida_ingreso_id` VARCHAR(10), IN `p_unidad_medida_salida_id` VARCHAR(10))  begin
	select count(*) as cantidad
	from producto_unidad_medida
	where producto_id = p_producto_id
	and unidad_medida_ingreso_id = p_unidad_medida_ingreso_id
	and unidad_medida_salida_id = p_unidad_medida_salida_id;
END$$

DROP PROCEDURE IF EXISTS `producto_unidad_medida_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_unidad_medida_d` (IN `p_id` INT)  begin
	delete from producto_unidad_medida where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_unidad_medida_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_unidad_medida_get` (IN `p_id` INT)  begin
	select unidad_medida_ingreso_id, unidad_medida_salida_id,
	factor, cantidad
	from producto_unidad_medida
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `producto_unidad_medida_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_unidad_medida_i` (IN `p_producto_id` INT, IN `p_unidad_medida_ingreso_id` VARCHAR(10), IN `p_unidad_medida_salida_id` VARCHAR(10), IN `p_factor` CHAR(1), IN `p_cantidad` DECIMAL(20,2))  begin
	insert into producto_unidad_medida(producto_id, unidad_medida_ingreso_id, unidad_medida_salida_id,
	factor, cantidad)
	values(p_producto_id, p_unidad_medida_ingreso_id, p_unidad_medida_salida_id,
	p_factor, p_cantidad);
END$$

DROP PROCEDURE IF EXISTS `producto_unidad_medida_list_by_producto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_unidad_medida_list_by_producto` (IN `p_producto_id` INT)  begin
	select id, unidad_medida_ingreso_id, unidad_medida_salida_id,
	factor, cantidad
	from producto_unidad_medida
	where producto_id = p_producto_id;
END$$

DROP PROCEDURE IF EXISTS `producto_unidad_medida_list_by_producto_and_um_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_unidad_medida_list_by_producto_and_um_i` (IN `p_producto_id` INT, IN `p_unidad_medida_ingreso` VARCHAR(10))  begin
	select pum.unidad_medida_salida_id,
	um.nombre as unidad_medida_salida,
	pum.factor, pum.cantidad
	from producto_unidad_medida pum
	inner join unidad_medida um on pum.unidad_medida_salida_id = um.codigo
	where pum.producto_id = p_producto_id
	and pum.unidad_medida_ingreso_id = p_unidad_medida_ingreso;
END$$

DROP PROCEDURE IF EXISTS `producto_unidad_medida_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_unidad_medida_u` (IN `p_id` INT, IN `p_unidad_medida_ingreso_id` VARCHAR(10), IN `p_unidad_medida_salida_id` VARCHAR(10), IN `p_factor` CHAR(1), IN `p_cantidad` DECIMAL(20,2))  begin
	update producto_unidad_medida
	set unidad_medida_ingreso_id = p_unidad_medida_ingreso_id,
	unidad_medida_salida_id = p_unidad_medida_salida_id,
	factor = p_factor,
	cantidad = p_cantidad
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_d` (IN `p_id` INT)  begin
	delete from proyecto where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_get` (IN `p_id` INT)  begin
	select id, codigo, nombre, ubicacion,
		presupuesto_plan, valor_venta, presupuesto_por_ejecutar,
		_get_varchar_from_date(fecha_inicio_plan) as fecha_inicio_plan,
		_get_varchar_from_date(fecha_termino_plan) as fecha_termino_plan,
		_get_varchar_from_date(fecha_inicio_real) as fecha_inicio_real,
		_get_varchar_from_date(fecha_termino_real) as fecha_termino_real
	from proyecto
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_i` (IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(200), IN `p_ubicacion` VARCHAR(200))  begin
	insert into proyecto (codigo, nombre, ubicacion)
	values(p_codigo, p_nombre, _get_null_or_value_from_varchar(p_ubicacion));
END$$

DROP PROCEDURE IF EXISTS `proyecto_inmueble_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_inmueble_d` (IN `p_id` INT)  begin
	delete from proyecto_inmueble where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_inmueble_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_inmueble_get` (IN `p_id` INT)  begin
	select codigo, nombre, precio
	from proyecto_inmueble
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_inmueble_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_inmueble_i` (IN `p_proyecto_id` INT, IN `p_codigo` VARCHAR(100), IN `p_nombre` VARCHAR(200), IN `p_precio` DECIMAL(20,2))  begin
	insert into proyecto_inmueble(proyecto_id, codigo, nombre, precio)
	values(p_proyecto_id, p_codigo, p_nombre, p_precio);
END$$

DROP PROCEDURE IF EXISTS `proyecto_inmueble_list_by_proyecto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_inmueble_list_by_proyecto` (IN `p_proyecto_id` INT)  begin
	select id, codigo, nombre, precio
	from proyecto_inmueble
	where proyecto_id = p_proyecto_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_inmueble_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_inmueble_u` (IN `p_id` INT, IN `p_codigo` VARCHAR(100), IN `p_nombre` VARCHAR(200), IN `p_precio` DECIMAL(20,2))  begin
	update proyecto_inmueble
	set codigo = p_codigo,
		nombre = p_nombre,
		precio = p_precio
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_list` ()  begin
	select id, codigo, nombre, presupuesto_plan, ubicacion,
		_get_varchar_from_date(fecha_inicio_plan) as fecha_inicio_plan,
		_get_varchar_from_date(fecha_termino_plan) as fecha_termino_plan
	from proyecto p;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_alert_new`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_alert_new` ()  begin
	select codigo,
		_get_varchar_from_date(fecha_pedido) as fecha_pedido
	from proyecto_requerimiento
	where alert_new_checked = false;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_d` (IN `p_id` INT)  begin
	delete from proyecto_requerimiento where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_detalle_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_detalle_d` (IN `p_id` INT)  begin
delete from proyecto_requerimiento_detalle where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_detalle_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_detalle_get` (IN `p_id` INT)  begin
select prd.proyecto_trabajo_partida_id,
 prd.producto_id,
 prd.unidad_medida_id,
 prd.cantidad,
 if(prd.fecha_en_obra='0000-00-00', '', date_format(prd.fecha_en_obra, '%d/%m/%Y')) as fecha_en_obra,
 prd.proyecto_requerimiento_id,
 ptp.proyecto_trabajo_id
from proyecto_requerimiento_detalle prd
inner join proyecto_trabajo_partida ptp on prd.proyecto_trabajo_partida_id = ptp.id
where prd.id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_detalle_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_detalle_i` (IN `p_proyecto_trabajo_partida_id` INT, IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_cantidad` DECIMAL(20,2), IN `p_fecha_en_obra` VARCHAR(10), IN `p_proyecto_requerimiento_id` INT)  begin
 insert into proyecto_requerimiento_detalle(proyecto_trabajo_partida_id, producto_id,
  unidad_medida_id, cantidad, fecha_en_obra, proyecto_requerimiento_id)
 values(p_proyecto_trabajo_partida_id, p_producto_id,
  p_unidad_medida_id, p_cantidad, if(p_fecha_en_obra='', null, str_to_date(p_fecha_en_obra, '%d/%m/%Y')), p_proyecto_requerimiento_id);
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_detalle_list_by_proyecto_requerimiento`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_detalle_list_by_proyecto_requerimiento` (IN `p_proyecto_requerimiento_id` INT)  begin
 select prd.id,
  ptp.nombre as partida,
  p.nombre as producto,
  um.nombre as unidad_medida,
  prd.cantidad,
  if(prd.fecha_en_obra='0000-00-00', '', date_format(prd.fecha_en_obra, '%d/%m/%Y')) as fecha_en_obra,
  pt.nombre as trabajo
 from proyecto_requerimiento_detalle prd
  inner join producto p on prd.producto_id = p.id
  inner join unidad_medida um on prd.unidad_medida_id = um.codigo
  inner join proyecto_trabajo_partida ptp on prd.proyecto_trabajo_partida_id = ptp.id
  inner join proyecto_trabajo pt on ptp.proyecto_trabajo_id = pt.id
 where proyecto_requerimiento_id = p_proyecto_requerimiento_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_detalle_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_detalle_u` (IN `p_id` INT, IN `p_cantidad` DECIMAL(20,2), IN `p_fecha_en_obra` VARCHAR(10))  begin
 update proyecto_requerimiento_detalle
 set cantidad = p_cantidad,
  fecha_en_obra = if(p_fecha_en_obra='', null, str_to_date(p_fecha_en_obra, '%d/%m/%Y'))
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_generate_next_codigo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_generate_next_codigo` ()  begin
	select CONCAT('RQ-', lpad(ifnull(max(replace(codigo, 'RQ-', '')), 0) + 1, 6, 0)) as next_codigo from proyecto_requerimiento;
end$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_get` (IN `p_id` INT)  begin
 select proyecto_id, codigo, if(fecha_pedido='0000-00-00', '', date_format(fecha_pedido, '%d/%m/%Y')) as fecha_pedido,
  alert_new_checked
 from proyecto_requerimiento
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_i` (IN `p_proyecto_id` INT, IN `p_codigo` VARCHAR(100), IN `p_fecha_pedido` VARCHAR(10), IN `p_per_reg_aud` VARCHAR(500))  begin
	insert into proyecto_requerimiento(proyecto_id, codigo, fecha_pedido, per_reg_aud)
	values(p_proyecto_id, p_codigo, _get_date_from_varchar(p_fecha_pedido), p_per_reg_aud);

	select max(id) as id
	from proyecto_requerimiento
	where proyecto_id = p_proyecto_id and codigo = p_codigo
		and per_reg_aud = p_per_reg_aud;
end$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_list` ()  begin
 select pr.id, pr.proyecto_id, p.nombre as proyecto, 
  pr.codigo, _get_varchar_from_date(pr.fecha_pedido) as fecha_pedido,
  per_reg_aud,
  alert_new_checked
 from proyecto_requerimiento pr
 inner join proyecto p on pr.proyecto_id = p.id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_u` (IN `p_id` INT, IN `p_proyecto_id` INT, IN `p_codigo` VARCHAR(100), IN `p_fecha_pedido` VARCHAR(10))  begin
 update proyecto_requerimiento
 set proyecto_id = p_proyecto_id,
  codigo = p_codigo,
  fecha_pedido = if(p_fecha_pedido='', null, str_to_date(p_fecha_pedido, '%d/%m/%Y'))
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_requerimiento_u_alert_new_checked`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_requerimiento_u_alert_new_checked` (IN `p_id` INT, IN `p_alert_new_checked` BOOL)  begin
 update proyecto_requerimiento
 set alert_new_checked = p_alert_new_checked
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_d` (IN `p_id` INT)  begin
	delete from proyecto_trabajo where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_generate_cantidad_adelanto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_generate_cantidad_adelanto` (IN `p_id` INT)  begin
	declare v_cantidad_adelanto decimal(20, 2);
	
	set v_cantidad_adelanto =  (
								select ifnull(sum(ptp.precio_plan), 0)
								from proyecto_trabajo_partida ptp
								where ptp.proyecto_trabajo_id = p_id
							   );
	
	update proyecto_trabajo
	set cantidad_adelanto = v_cantidad_adelanto,
		cantidad_adelanto_restante = v_cantidad_adelanto
	where id = p_id;

	select v_cantidad_adelanto as cantidad_adelanto;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_get` (IN `p_id` INT)  begin
	select nombre, persona_contratista_id, cantidad_adelanto, cantidad_adelanto_restante,
		porcentaje_amortizacion_adelanto, porcentaje_retencion_fondo_garantia
	from proyecto_trabajo
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_get_can_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_get_can_delete` (IN `p_id` INT)  begin
 select can_delete
 from proyecto_trabajo
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_get_can_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_get_can_update` (IN `p_id` INT)  begin
 select can_update
 from proyecto_trabajo
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_i` (IN `p_nombre` VARCHAR(100), IN `p_proyecto_id` INT, IN `p_persona_contratista_id` INT, IN `p_porcentaje_amortizacion_adelanto` DECIMAL(5,2), IN `p_porcentaje_retencion_fondo_garantia` DECIMAL(5,2))  begin
	insert into proyecto_trabajo(nombre, proyecto_id, persona_contratista_id,
		porcentaje_amortizacion_adelanto, porcentaje_retencion_fondo_garantia)
	values(p_nombre, p_proyecto_id, p_persona_contratista_id,
		p_porcentaje_amortizacion_adelanto, p_porcentaje_retencion_fondo_garantia);
	 
	select max(id) as id
	from proyecto_trabajo
	where nombre = p_nombre and proyecto_id = p_proyecto_id
		and persona_contratista_id = p_persona_contratista_id
		and porcentaje_amortizacion_adelanto = p_porcentaje_amortizacion_adelanto
		and porcentaje_retencion_fondo_garantia = p_porcentaje_retencion_fondo_garantia;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_list_by_proyecto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_list_by_proyecto` (IN `p_proyecto_id` INT)  begin
	select pt.id, pt.nombre, pt.persona_contratista_id,
		p.nombre_1 as 'contratista',
		cantidad_adelanto,
		can_update, can_delete,
		porcentaje_amortizacion_adelanto,
		porcentaje_retencion_fondo_garantia
	from proyecto_trabajo pt
	inner join persona p on pt.persona_contratista_id = p.id
	where pt.proyecto_id = p_proyecto_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_list_by_proyecto_and_contratista`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_list_by_proyecto_and_contratista` (IN `p_proyecto_id` INT, IN `p_persona_contratista_id` INT)  begin
	select id, nombre, cantidad_adelanto_restante,
		porcentaje_amortizacion_adelanto, porcentaje_retencion_fondo_garantia
	from proyecto_trabajo
	where persona_contratista_id = p_persona_contratista_id
		and proyecto_id = p_proyecto_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_list_contratistas_by_proyecto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_list_contratistas_by_proyecto` (IN `p_proyecto_id` INT)  begin
 select distinct pt.persona_contratista_id,
  p.nombre_1 as 'contratista'
 from proyecto_trabajo pt
 inner join persona p on pt.persona_contratista_id = p.id
 where pt.proyecto_id = p_proyecto_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_alert_by_90_percent_from_presupuesto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_alert_by_90_percent_from_presupuesto` ()  begin
select ptp.codigo, ptp.nombre as partida, ptp.unidad_medida_id,
 pt.nombre as trabajo, p.nombre as proyecto
from proyecto_trabajo_partida ptp
inner join proyecto_trabajo pt on ptp.proyecto_trabajo_id = pt.id
inner join proyecto p on pt.proyecto_id = p.id
where ptp.precio_plan * 0.9 <= ptp.precio_real_acumulado;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_count_by_id_and_ptp_and_dates`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_count_by_id_and_ptp_and_dates` (IN `p_id` INT, IN `p_proyecto_trabajo_partida_id` INT, IN `p_fecha_inicio_avance` VARCHAR(10), IN `p_fecha_termino_avance` VARCHAR(10))  begin
 select count(*) as cantidad
 from proyecto_trabajo_partida_avance
 where ((if(p_fecha_inicio_avance='', null, str_to_date(p_fecha_inicio_avance, '%d/%m/%Y')) between fecha_inicio_avance and fecha_termino_avance)
  or (if(p_fecha_termino_avance='', null, str_to_date(p_fecha_termino_avance, '%d/%m/%Y')) between fecha_inicio_avance and fecha_termino_avance))
  and proyecto_trabajo_partida_id = p_proyecto_trabajo_partida_id
  and id <> p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_count_by_ptp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_count_by_ptp` (IN `p_proyecto_trabajo_partida_id` INT)  begin
	select count(*) as cantidad
	from proyecto_trabajo_partida_avance
	where proyecto_trabajo_partida_id = p_proyecto_trabajo_partida_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_count_by_ptp_and_dates`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_count_by_ptp_and_dates` (IN `p_proyecto_trabajo_partida_id` INT, IN `p_fecha_inicio_avance` VARCHAR(10), IN `p_fecha_termino_avance` VARCHAR(10))  begin
 select count(*) as cantidad
 from proyecto_trabajo_partida_avance
 where ((if(p_fecha_inicio_avance='', null, str_to_date(p_fecha_inicio_avance, '%d/%m/%Y')) between fecha_inicio_avance and fecha_termino_avance)
  or (if(p_fecha_termino_avance='', null, str_to_date(p_fecha_termino_avance, '%d/%m/%Y')) between fecha_inicio_avance and fecha_termino_avance))
  and proyecto_trabajo_partida_id = p_proyecto_trabajo_partida_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_d` (IN `p_id` INT)  begin
	delete from proyecto_trabajo_partida_avance where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_get` (IN `p_id` INT)  begin
select _get_varchar_from_date(fecha_inicio_avance) as fecha_inicio_avance,
 _get_varchar_from_date(fecha_termino_avance) as fecha_termino_avance,
 precio_unitario_avance,
 cantidad_avance,
 precio_avance,
 per_reg_aud,
 fec_reg_aud
from proyecto_trabajo_partida_avance
where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_get_max_and_sum_by_ptp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_get_max_and_sum_by_ptp` (IN `p_proyecto_trabajo_partida_id` INT)  begin
 select
  if(min(ptpa.fecha_inicio_avance)='0000-00-00', '', date_format(min(ptpa.fecha_inicio_avance), '%d/%m/%Y')) as min_fecha_inicio_avance,
  if(max(ptpa.fecha_termino_avance)='0000-00-00', '', date_format(max(ptpa.fecha_termino_avance), '%d/%m/%Y')) as max_fecha_termino_avance,
  sum(ptpa.cantidad_avance) as sum_cantidad_avance,
  sum(ptpa.precio_avance) as sum_precio_avance
 from proyecto_trabajo_partida_avance ptpa
 where ptpa.proyecto_trabajo_partida_id = p_proyecto_trabajo_partida_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_i` (IN `p_proyecto_trabajo_partida_id` INT, IN `p_fecha_inicio_avance` VARCHAR(10), IN `p_fecha_termino_avance` VARCHAR(10), IN `p_precio_unitario_avance` DECIMAL(9,2), IN `p_cantidad_avance` DECIMAL(9,2), IN `p_precio_avance` DECIMAL(9,2), IN `p_per_reg_aud` VARCHAR(100))  begin
 insert into proyecto_trabajo_partida_avance(proyecto_trabajo_partida_id,
  fecha_inicio_avance,
  fecha_termino_avance,
  precio_unitario_avance, cantidad_avance, precio_avance,
  per_reg_aud,fec_reg_aud)
 values(p_proyecto_trabajo_partida_id,
  if(p_fecha_inicio_avance='', null, str_to_date(p_fecha_inicio_avance, '%d/%m/%Y')),
  if(p_fecha_termino_avance='', null, str_to_date(p_fecha_termino_avance, '%d/%m/%Y')),
  p_precio_unitario_avance, p_cantidad_avance, p_precio_avance,
  p_per_reg_aud, now());
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_list_by_pago_contratista`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_list_by_pago_contratista` (IN `p_pago_contratista_id` INT)  begin
 select ptpa.id,
  if(ptpa.fecha_inicio_avance='0000-00-00', '', date_format(ptpa.fecha_inicio_avance, '%d/%m/%Y')) as fecha_inicio_avance,
  if(ptpa.fecha_termino_avance='0000-00-00', '', date_format(ptpa.fecha_termino_avance, '%d/%m/%Y')) as fecha_termino_avance,
  ptpa.precio_unitario_avance,
  ptpa.cantidad_avance,
  ptpa.precio_avance,
  ptp.codigo,
  ptp.nombre as partida
 from proyecto_trabajo_partida_avance ptpa
 inner join proyecto_trabajo_partida ptp on ptpa.proyecto_trabajo_partida_id = ptp.id
 where ptpa.pago_contratista_id = p_pago_contratista_id
 order by ptp.codigo desc;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_list_by_ptp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_list_by_ptp` (IN `p_proyecto_trabajo_partida_id` INT)  begin
 select id,
  if(fecha_inicio_avance='0000-00-00', '', date_format(fecha_inicio_avance, '%d/%m/%Y')) as fecha_inicio_avance,
  if(fecha_termino_avance='0000-00-00', '', date_format(fecha_termino_avance, '%d/%m/%Y')) as fecha_termino_avance,
  precio_unitario_avance,
  cantidad_avance,
  precio_avance,
  per_reg_aud,
  fec_reg_aud
 from proyecto_trabajo_partida_avance
 where proyecto_trabajo_partida_id = p_proyecto_trabajo_partida_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_list_by_pt_and_date_ranges`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_list_by_pt_and_date_ranges` (IN `p_proyecto_trabajo_id` INT, IN `p_fecha_inicio` VARCHAR(10), IN `p_fecha_termino` VARCHAR(10))  begin
 select ptpa.id,
  if(ptpa.fecha_inicio_avance='0000-00-00', '', date_format(ptpa.fecha_inicio_avance, '%d/%m/%Y')) as fecha_inicio_avance,
  if(ptpa.fecha_termino_avance='0000-00-00', '', date_format(ptpa.fecha_termino_avance, '%d/%m/%Y')) as fecha_termino_avance,
  ptpa.precio_unitario_avance,
  ptpa.cantidad_avance,
  ptpa.precio_avance,
  ptp.codigo,
  ptp.nombre as partida
 from proyecto_trabajo_partida_avance ptpa
 inner join proyecto_trabajo_partida ptp on ptpa.proyecto_trabajo_partida_id = ptp.id
 where ptpa.proyecto_trabajo_partida_id in (select ptp2.id
              from proyecto_trabajo_partida ptp2
              where ptp2.proyecto_trabajo_id = p_proyecto_trabajo_id)
 and (ptpa.fecha_inicio_avance between if(p_fecha_inicio='', null, str_to_date(p_fecha_inicio, '%d/%m/%Y')) and if(p_fecha_termino='', null, str_to_date(p_fecha_termino, '%d/%m/%Y')))
 and (ptpa.fecha_termino_avance between if(p_fecha_inicio='', null, str_to_date(p_fecha_inicio, '%d/%m/%Y')) and if(p_fecha_termino='', null, str_to_date(p_fecha_termino, '%d/%m/%Y')))
 and ptpa.pago_generado = false
 order by ptp.codigo desc;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_report_avance_proyecto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_report_avance_proyecto` (IN `p_proyecto_trabajo_partida_id` INT, IN `p_fecha_inicio_avance` VARCHAR(10), IN `p_fecha_termino_avance` VARCHAR(10))  begin
	select ifnull(sum(ifnull(cantidad_avance, 0)), 0) as cantidad_avance,
		ifnull(sum(ifnull(precio_avance, 0)), 0) as precio_avance
	from proyecto_trabajo_partida_avance ptpa
	where proyecto_trabajo_partida_id = p_proyecto_trabajo_partida_id
		and (fecha_inicio_avance between _get_date_from_varchar(p_fecha_inicio_avance) and _get_date_from_varchar(p_fecha_termino_avance))
		and (fecha_termino_avance between _get_date_from_varchar(p_fecha_inicio_avance) and _get_date_from_varchar(p_fecha_termino_avance));
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_report_avance_proyecto_acu_ant`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_report_avance_proyecto_acu_ant` (IN `p_proyecto_trabajo_partida_id` INT, IN `p_fecha_termino_avance` VARCHAR(10))  begin
 select ifnull(sum(ifnull(cantidad_avance, 0)), 0) as cantidad_acumulada,
  ifnull(sum(ifnull(precio_avance, 0)), 0) as precio_acumulado
 from proyecto_trabajo_partida_avance ptpa
 where proyecto_trabajo_partida_id = p_proyecto_trabajo_partida_id
  and fecha_termino_avance < _get_date_from_varchar(p_fecha_termino_avance);
end$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_u` (IN `p_id` INT, IN `p_fecha_inicio_avance` VARCHAR(10), IN `p_fecha_termino_avance` VARCHAR(10), IN `p_precio_unitario_avance` DECIMAL(9,2), IN `p_cantidad_avance` DECIMAL(9,2), IN `p_precio_avance` DECIMAL(9,2), IN `p_per_reg_aud` VARCHAR(100))  begin
 update proyecto_trabajo_partida_avance
 set fecha_inicio_avance = if(p_fecha_inicio_avance='', null, str_to_date(p_fecha_inicio_avance, '%d/%m/%Y')),
  fecha_termino_avance = if(p_fecha_termino_avance='', null, str_to_date(p_fecha_termino_avance, '%d/%m/%Y')),
  precio_unitario_avance = p_precio_unitario_avance,
  cantidad_avance = p_cantidad_avance,
  precio_avance = p_precio_avance,
  per_reg_aud = p_per_reg_aud,
  fec_reg_aud = now()
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_u_not_pago`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_u_not_pago` (IN `p_pago_contratista_id` INT)  begin
 update proyecto_trabajo_partida_avance
 set pago_contratista_id = null,
  pago_generado = false
 where pago_contratista_id = p_pago_contratista_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_avance_u_pago`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_avance_u_pago` (IN `p_id` INT, IN `p_pago_generado` BOOL, IN `p_pago_contratista_id` INT)  begin
 update proyecto_trabajo_partida_avance
 set pago_generado = p_pago_generado,
  pago_contratista_id = p_pago_contratista_id
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_count_by_id_and_trabajo_and_codigo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_count_by_id_and_trabajo_and_codigo` (IN `p_id` INT, IN `p_proyecto_trabajo_id` INT, IN `p_codigo` VARCHAR(10))  begin
	select count(*) as cantidad
	from proyecto_trabajo_partida
	where id <> p_id and proyecto_trabajo_id = p_proyecto_trabajo_id
		and codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_count_by_proyecto_trabajo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_count_by_proyecto_trabajo` (IN `p_proyecto_trabajo_id` INT)  begin
 select count(*) as cantidad
 from proyecto_trabajo_partida
 where proyecto_trabajo_id = p_proyecto_trabajo_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_count_by_proyecto_trabajo_and_codigo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_count_by_proyecto_trabajo_and_codigo` (IN `p_proyecto_trabajo_id` INT, IN `p_codigo` VARCHAR(10))  begin
 select count(*) as cantidad
 from proyecto_trabajo_partida
 where proyecto_trabajo_id = p_proyecto_trabajo_id and codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_count_sons`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_count_sons` (IN `p_proyecto_trabajo_partida_id` INT)  begin
	select count(*) as cantidad
	from proyecto_trabajo_partida
	where proyecto_trabajo_partida_id = p_proyecto_trabajo_partida_id; 
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_d` (IN `p_id` INT)  begin
	delete from proyecto_trabajo_partida where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_get` (IN `p_id` INT)  begin
 select codigo, nombre, unidad_medida_id, precio_unitario_plan,
  cantidad_plan, precio_plan,
  cantidad_real_acumulada, precio_real_acumulado,
  if(fecha_inicio_plan='0000-00-00', '', date_format(fecha_inicio_plan, '%d/%m/%Y')) as fecha_inicio_plan,
  _get_varchar_from_date(fecha_termino_plan) as fecha_termino_plan,
  _get_varchar_from_date(fecha_inicio_real) as fecha_inicio_real,
  _get_varchar_from_date(fecha_termino_real) as fecha_termino_real,
  can_delete
 from proyecto_trabajo_partida
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_get_can_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_get_can_delete` (IN `p_id` INT)  begin
	select can_delete
	from proyecto_trabajo_partida
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_get_max_values_by_proyecto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_get_max_values_by_proyecto` (IN `p_proyecto_id` INT)  begin
	select 
	if(min(ptp.fecha_inicio_plan)='0000-00-00', '', date_format(min(ptp.fecha_inicio_plan), '%d/%m/%Y')) as min_fecha_inicio_plan,
	if(max(ptp.fecha_termino_plan)='0000-00-00', '', date_format(max(ptp.fecha_termino_plan), '%d/%m/%Y')) as max_fecha_termino_plan,
	if(min(ptp.fecha_inicio_real)='0000-00-00', '', date_format(min(ptp.fecha_inicio_real), '%d/%m/%Y')) as min_fecha_inicio_real,
	if(max(ptp.fecha_termino_real)='0000-00-00', '', date_format(max(ptp.fecha_termino_real), '%d/%m/%Y')) as max_fecha_termino_real,
	if(sum(ptp.precio_plan) is null, '', sum(ptp.precio_plan)) as sum_precio_plan,
	if(sum(ptp.precio_real_acumulado) is null, '', sum(ptp.precio_real_acumulado)) as sum_precio_real_acumulado,
	if(sum(ptp.precio_por_ejecutar) is null, '', sum(ptp.precio_por_ejecutar)) as sum_precio_por_ejecutar
	from proyecto_trabajo_partida ptp
	where ptp.proyecto_trabajo_id in (
										select pt.id
										from proyecto_trabajo pt
										where pt.proyecto_id = p_proyecto_id
									 );
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_i` (IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100), IN `p_unidad_medida_id` VARCHAR(10), IN `p_precio_unitario_plan` DECIMAL(20,2), IN `p_cantidad_plan` DECIMAL(20,2), IN `p_precio_plan` DECIMAL(20,2), IN `p_fecha_inicio_plan` VARCHAR(10), IN `p_fecha_termino_plan` VARCHAR(10), IN `p_proyecto_trabajo_id` INT, IN `p_proyecto_trabajo_partida_id` INT)  begin
 insert into proyecto_trabajo_partida(codigo, nombre,
  unidad_medida_id, 
  precio_unitario_plan,
  cantidad_plan,
  precio_plan,
  fecha_inicio_plan,
  fecha_termino_plan,
  proyecto_trabajo_id, proyecto_trabajo_partida_id)
 values(p_codigo, p_nombre, 
  nullif(p_unidad_medida_id, ''),
  nullif(p_precio_unitario_plan, 0.00),
  nullif(p_cantidad_plan, 0.00),
  nullif(p_precio_plan, 0.00),
  if(p_fecha_inicio_plan='', null, str_to_date(p_fecha_inicio_plan, '%d/%m/%Y')),
  if(p_fecha_termino_plan='', null, str_to_date(p_fecha_termino_plan, '%d/%m/%Y')),
  p_proyecto_trabajo_id, nullif(p_proyecto_trabajo_partida_id, 0));
 
 select max(id) as id
 from proyecto_trabajo_partida
 where codigo = p_codigo and nombre = p_nombre and proyecto_trabajo_id = p_proyecto_trabajo_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_list_by_proyecto_trabajo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_list_by_proyecto_trabajo` (IN `p_proyecto_trabajo_id` INT)  begin
	select ptp.id, ptp.codigo, ptp.nombre, ptp.unidad_medida_id, um.nombre as unidad_medida,
		ptp.precio_unitario_plan,
		ptp.cantidad_plan, ptp.precio_plan,
		ptp.cantidad_real_acumulada, ptp.precio_real_acumulado,
		ptp.cantidad_por_ejecutar, ptp.precio_por_ejecutar,
		ptp.proyecto_trabajo_partida_id,
		ifnull(_get_varchar_from_date(ptp.fecha_inicio_plan), '') as fecha_inicio_plan,
		ifnull(_get_varchar_from_date(ptp.fecha_termino_plan), '') as fecha_termino_plan,
		ifnull(_get_varchar_from_date(ptp.fecha_inicio_real), '') as fecha_inicio_real,
		ifnull(_get_varchar_from_date(ptp.fecha_termino_real), '') as fecha_termino_real,
		ptp_padre.codigo as codigo_padre,
		ptp.can_delete as can_delete
	from proyecto_trabajo_partida ptp
	left join proyecto_trabajo_partida ptp_padre on ptp.proyecto_trabajo_partida_id = ptp_padre.id
	left join unidad_medida um on ptp.unidad_medida_id = um.codigo
	where ptp.proyecto_trabajo_id = p_proyecto_trabajo_id
	order by ptp.codigo asc;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_producto_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_producto_d` (IN `p_id` INT)  begin
 delete from proyecto_trabajo_partida_producto where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_producto_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_producto_i` (IN `p_producto_id` INT, IN `p_unidad_medida_id` VARCHAR(10), IN `p_cantidad` DECIMAL(20,2), IN `p_fecha_ingreso` VARCHAR(10), IN `p_fecha_vencimiento` VARCHAR(10), IN `p_kardex_id` INT, IN `p_proyecto_trabajo_partida_id` INT)  begin
    insert into proyecto_trabajo_partida_producto(producto_id, unidad_medida_id, cantidad,
  fecha_ingreso,
  fecha_vencimiento,
  kardex_id,
  proyecto_trabajo_partida_id) 
    values(p_producto_id, p_unidad_medida_id, p_cantidad,
           if(p_fecha_ingreso='', null, str_to_date(p_fecha_ingreso, '%d/%m/%Y')),
           if(p_fecha_vencimiento='', null, str_to_date(p_fecha_vencimiento, '%d/%m/%Y')),
           p_kardex_id,
           p_proyecto_trabajo_partida_id);
end$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_producto_list_by_ptp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_producto_list_by_ptp` (IN `p_proyecto_trabajo_partida_id` INT)  begin
    select ptpp.id, 
     p.nombre as producto,
     um.nombre as unidad_medida,
     cantidad,
  if(fecha_ingreso='0000-00-00', '', date_format(fecha_ingreso, '%d/%m/%Y')) as fecha_ingreso,
  if(fecha_vencimiento='0000-00-00', '', date_format(fecha_vencimiento, '%d/%m/%Y')) as fecha_vencimiento
    from proyecto_trabajo_partida_producto ptpp 
    inner join producto p on ptpp.producto_id = p.id
    inner join unidad_medida um on ptpp.unidad_medida_id = um.codigo
    where proyecto_trabajo_partida_id = p_proyecto_trabajo_partida_id;
end$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_report_avance_proyecto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_report_avance_proyecto` (IN `p_proyecto_trabajo_id` INT)  begin
 select ptp.id, ptp.codigo, ptp.nombre as partida,
  um.nombre as unidad_medida,
  ptp.cantidad_plan, ptp.precio_plan 
 from proyecto_trabajo_partida ptp
 inner join unidad_medida um on ptp.unidad_medida_id = um.codigo
 where proyecto_trabajo_id = p_proyecto_trabajo_id
 order by ptp.codigo desc;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_u` (IN `p_id` INT, IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100), IN `p_unidad_medida_id` VARCHAR(10), IN `p_precio_unitario_plan` DECIMAL(20,2), IN `p_cantidad_plan` DECIMAL(20,2), IN `p_precio_plan` DECIMAL(20,2), IN `p_fecha_inicio_plan` VARCHAR(10), IN `p_fecha_termino_plan` VARCHAR(10))  begin
 update proyecto_trabajo_partida 
 set codigo = p_codigo, 
  nombre = p_nombre, 
  unidad_medida_id = nullif(p_unidad_medida_id, ''), 
  precio_unitario_plan = nullif(p_precio_unitario_plan, 0.00), 
  cantidad_plan = _get_null_or_value_from_decimal(p_cantidad_plan),
  precio_plan = _get_null_or_value_from_decimal(p_precio_plan),
  cantidad_por_ejecutar = _get_null_or_value_from_decimal(cantidad_plan) - _get_null_or_value_from_decimal(cantidad_real_acumulada),
  precio_por_ejecutar = _get_null_or_value_from_decimal(precio_plan) - _get_null_or_value_from_decimal(precio_real_acumulado),
  fecha_inicio_plan = if(p_fecha_inicio_plan='', null, str_to_date(p_fecha_inicio_plan, '%d/%m/%Y')),
  fecha_termino_plan = if(p_fecha_termino_plan='', null, str_to_date(p_fecha_termino_plan, '%d/%m/%Y'))
 where id = p_id;

 select cantidad_por_ejecutar, precio_por_ejecutar
 from proyecto_trabajo_partida
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_u_acumulados_and_por_ejecutar`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_u_acumulados_and_por_ejecutar` (IN `p_id` INT, IN `p_cantidad_real_acumulada` DECIMAL(20,2), IN `p_precio_real_acumulado` DECIMAL(20,2), IN `p_fecha_inicio_real` VARCHAR(10), IN `p_fecha_termino_real` VARCHAR(10))  begin
 update proyecto_trabajo_partida
 set cantidad_real_acumulada = nullif(p_cantidad_real_acumulada, 0.00),
  precio_real_acumulado = _get_null_or_value_from_decimal(p_precio_real_acumulado),
  cantidad_por_ejecutar = ifnull(cantidad_plan, 0) - _get_null_or_value_from_decimal(cantidad_real_acumulada),
  precio_por_ejecutar = ifnull(precio_plan, 0) - _get_null_or_value_from_decimal(precio_real_acumulado),
  fecha_inicio_real = _get_date_from_varchar(p_fecha_inicio_real),
  fecha_termino_real = _get_date_from_varchar(p_fecha_termino_real)
 where id = p_id;

 select cantidad_real_acumulada, precio_real_acumulado,
  cantidad_por_ejecutar, precio_por_ejecutar,
  _get_varchar_from_date(fecha_inicio_real) as fecha_inicio_real,
  _get_varchar_from_date(fecha_termino_real) as fecha_termino_real
 from proyecto_trabajo_partida
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_partida_u_can_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_partida_u_can_delete` (IN `p_id` INT, IN `p_can_delete` BOOL)  begin
	update proyecto_trabajo_partida
	set can_delete = p_can_delete
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_u` (IN `p_id` INT, IN `p_nombre` VARCHAR(100), IN `p_persona_contratista_id` INT, IN `p_cantidad_adelanto` DECIMAL(20,2))  begin
 update proyecto_trabajo
 set nombre = p_nombre,
 persona_contratista_id = p_persona_contratista_id,
 cantidad_adelanto = p_cantidad_adelanto,
 cantidad_adelanto_restante = p_cantidad_adelanto - cantidad_adelanto_usado 
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_u_cantidad_adelanto_usado`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_u_cantidad_adelanto_usado` (IN `p_id` INT, IN `p_cantidad_adelanto_usado` DECIMAL(20,2))  begin
 update proyecto_trabajo 
 set cantidad_adelanto_usado = cantidad_adelanto_usado + p_cantidad_adelanto_usado,
  cantidad_adelanto_restante = cantidad_adelanto_restante - p_cantidad_adelanto_usado
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_u_can_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_u_can_delete` (IN `p_id` INT, IN `p_can_delete` BOOL)  begin
 update proyecto_trabajo
 set can_delete = p_can_delete
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_trabajo_u_can_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_trabajo_u_can_update` (IN `p_id` INT, IN `p_can_update` BOOL)  begin
 update proyecto_trabajo
 set can_update = p_can_update
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_u` (IN `p_id` INT, IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(200), IN `p_ubicacion` VARCHAR(200))  begin
	update proyecto 
	set codigo = p_codigo,
		nombre = p_nombre,
		ubicacion =	nullif(p_ubicacion, '')
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_u_plan_and_real`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_u_plan_and_real` (IN `p_id` INT, IN `p_presupuesto_plan` DECIMAL(20,2), IN `p_fecha_inicio_plan` VARCHAR(10), IN `p_fecha_termino_plan` VARCHAR(10), IN `p_fecha_inicio_real` VARCHAR(10), IN `p_fecha_termino_real` VARCHAR(10))  begin
 update proyecto
 set presupuesto_plan = nullif(p_presupuesto_plan, 0.00),
  fecha_inicio_plan = if(p_fecha_inicio_plan='', null, str_to_date(p_fecha_inicio_plan, '%d/%m/%Y')),
  fecha_termino_plan = if(p_fecha_termino_plan='', null, str_to_date(p_fecha_termino_plan, '%d/%m/%Y')),
  fecha_inicio_real = if(p_fecha_inicio_real='', null, str_to_date(p_fecha_inicio_real, '%d/%m/%Y')),
  fecha_termino_real = if(p_fecha_termino_real='', null, str_to_date(p_fecha_termino_real, '%d/%m/%Y'))
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_cronograma_pago_alert_8_days`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_cronograma_pago_alert_8_days` ()  begin
	select p.nombre_1, p.nombre_2, p.nombre_3, p.apellido_paterno, p.apellido_materno,
	 pvcp.fecha_programada 
	from proyecto_venta_cronograma_pago pvcp
	inner join proyecto_venta pv on pvcp.proyecto_venta_id = pv.id 
	inner join persona p on pv.persona_cliente_id = p.id 
	where adddate(curdate(), 8) >= pvcp.fecha_programada;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_cronograma_pago_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_cronograma_pago_d` (IN `p_id` INT)  begin
 delete from proyecto_venta_cronograma_pago where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_cronograma_pago_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_cronograma_pago_get` (IN `p_id` INT)  begin
 select monto_a_pagar, if(fecha_programada='0000-00-00', '', date_format(fecha_programada, '%d/%m/%Y')) as fecha_programada
 from proyecto_venta_cronograma_pago
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_cronograma_pago_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_cronograma_pago_i` (IN `p_proyecto_venta_id` INT, IN `p_monto_a_pagar` DECIMAL(20,2), IN `p_fecha_programada` VARCHAR(10))  begin
 insert into proyecto_venta_cronograma_pago(proyecto_venta_id, monto_a_pagar, fecha_programada)
 values(p_proyecto_venta_id, p_monto_a_pagar, if(p_fecha_programada='', null, str_to_date(p_fecha_programada, '%d/%m/%Y')));
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_cronograma_pago_list_by_proyecto_venta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_cronograma_pago_list_by_proyecto_venta` (IN `p_proyecto_venta_id` INT)  begin
 select id, monto_a_pagar, if(fecha_programada='0000-00-00', '', date_format(fecha_programada, '%d/%m/%Y')) as fecha_programada
 from proyecto_venta_cronograma_pago
 where proyecto_venta_id = p_proyecto_venta_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_cronograma_pago_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_cronograma_pago_u` (IN `p_id` INT, IN `p_monto_a_pagar` DECIMAL(20,2), IN `p_fecha_programada` VARCHAR(10))  begin
 update proyecto_venta_cronograma_pago
 set monto_a_pagar = p_monto_a_pagar,
  fecha_programada = if(p_fecha_programada='', null, str_to_date(p_fecha_programada, '%d/%m/%Y'))
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_d` (IN `p_id` INT)  begin
 delete from proyecto_venta where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_detalle_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_detalle_d` (IN `p_id` INT)  begin
 delete from proyecto_venta_detalle where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_detalle_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_detalle_get` (IN `p_id` INT)  begin
 select proyecto_venta_id, precio
 from proyecto_venta_detalle where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_detalle_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_detalle_i` (IN `p_proyecto_venta_id` INT, IN `p_proyecto_inmueble_id` INT, IN `p_precio` DECIMAL(20,2))  begin
 insert into proyecto_venta_detalle(proyecto_venta_id, proyecto_inmueble_id, precio)
 values(p_proyecto_venta_id, p_proyecto_inmueble_id, p_precio);
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_detalle_list_by_proyecto_venta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_detalle_list_by_proyecto_venta` (IN `p_proyecto_venta_id` INT)  begin
 select pvd.id, pi.codigo, pi.nombre as inmueble, pi.precio
 from proyecto_venta_detalle pvd
 inner join proyecto_inmueble pi on pvd.proyecto_inmueble_id = pi.id
 where pvd.proyecto_venta_id = p_proyecto_venta_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_get` (IN `p_id` INT)  begin
	select proyecto_id, persona_cliente_id,
		moneda, total_a_pagar, acumulado_pagado, saldo_por_pagar
	from proyecto_venta
	where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_i` (IN `p_proyecto_id` INT, IN `p_persona_cliente_id` INT, IN `p_moneda` VARCHAR(10))  begin
 insert into proyecto_venta(proyecto_id, persona_cliente_id, moneda,
  total_a_pagar, acumulado_pagado, saldo_por_pagar)
 values(p_proyecto_id, p_persona_cliente_id, p_moneda,
  0, 0, 0);
 
 select max(id) as id
 from proyecto_venta
 where proyecto_id = p_proyecto_id
  and persona_cliente_id = p_persona_cliente_id
  and moneda = p_moneda;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_list` ()  begin
	select v.id, pr.nombre as proyecto,
		concat(
	  		ifnull(pe.nombre_1, ''), ' ', 
	  		ifnull(pe.nombre_2, ''), ' ',
	  		ifnull(pe.apellido_paterno, ''), ' ',
	  		ifnull(pe.apellido_materno, '')
		) as cliente,
		v.moneda, v.total_a_pagar, v.acumulado_pagado, v.saldo_por_pagar
	from proyecto_venta v
	inner join proyecto pr on v.proyecto_id = pr.id
	inner join persona pe on v.persona_cliente_id = pe.id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_pago_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_pago_d` (IN `p_id` INT)  begin
 delete from proyecto_venta_pago where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_pago_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_pago_get` (IN `p_id` INT)  begin
 select proyecto_venta_id,
  if(fecha='0000-00-00', '', date_format(fecha, '%d/%m/%Y')) as fecha,
  comprobante_codigo,
  monto_moneda_venta,
  moneda_pago,
  moneda_pago_valor_conversion,
  monto_moneda_pago,
  igv,
  monto_total_moneda_pago
 from proyecto_venta_pago
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_pago_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_pago_i` (IN `p_proyecto_venta_id` INT, IN `p_fecha` VARCHAR(10), IN `p_comprobante_codigo` VARCHAR(100), IN `p_monto_moneda_venta` DECIMAL(20,2), IN `p_moneda_pago` VARCHAR(10), IN `p_moneda_pago_valor_conversion` DECIMAL(20,2), IN `p_monto_moneda_pago` DECIMAL(20,2), IN `p_igv` DECIMAL(20,2), IN `p_monto_total_moneda_pago` DECIMAL(20,2), IN `p_detraccion` DECIMAL(20,2))  begin
 insert into proyecto_venta_pago(proyecto_venta_id,
  fecha,
  comprobante_codigo,
  monto_moneda_venta, moneda_pago, moneda_pago_valor_conversion,
  monto_moneda_pago, igv, monto_total_moneda_pago, detraccion)
 values(p_proyecto_venta_id,
  if(p_fecha='', null, str_to_date(p_fecha, '%d/%m/%Y')),
  p_comprobante_codigo,
  p_monto_moneda_venta, p_moneda_pago, p_moneda_pago_valor_conversion,
  p_monto_moneda_pago, p_igv, p_monto_total_moneda_pago, p_detraccion);
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_pago_list_by_proyecto_venta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_pago_list_by_proyecto_venta` (IN `p_proyecto_venta_id` INT)  begin
 select id,
  if(fecha='0000-00-00', '', date_format(fecha, '%d/%m/%Y')) as fecha,
  comprobante_codigo,
  monto_moneda_venta,
  moneda_pago,
  moneda_pago_valor_conversion,
  monto_moneda_pago,
  igv,
  monto_total_moneda_pago
 from proyecto_venta_pago
 where proyecto_venta_id = p_proyecto_venta_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_pago_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_pago_u` (IN `p_id` INT, IN `p_fecha` VARCHAR(10), IN `p_comprobante_codigo` VARCHAR(100), IN `p_monto_moneda_venta` DECIMAL(20,2), IN `p_moneda_pago` VARCHAR(10), IN `p_moneda_pago_valor_conversion` DECIMAL(20,2), IN `p_monto_moneda_pago` DECIMAL(20,2), IN `p_igv` DECIMAL(20,2), IN `p_monto_total_moneda_pago` DECIMAL(20,2), IN `p_detraccion` DECIMAL(20,2))  begin
 update proyecto_venta_pago
 set fecha = if(p_fecha='', null, str_to_date(p_fecha, '%d/%m/%Y')),
  comprobante_codigo = p_comprobante_codigo,
  monto_moneda_venta = p_monto_moneda_venta,
  monto_moneda_venta = p_monto_moneda_venta,
  moneda_pago = p_moneda_pago,
  moneda_pago_valor_conversion = p_moneda_pago_valor_conversion,
  monto_moneda_pago = p_monto_moneda_pago,
  igv = p_igv,
  monto_total_moneda_pago = p_monto_total_moneda_pago,
  detraccion = p_detraccion
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `proyecto_venta_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proyecto_venta_u` (IN `p_id` INT, IN `p_total_a_pagar` DECIMAL(20,2), IN `p_acumulado_pagado` DECIMAL(20,2), IN `p_saldo_por_pagar` DECIMAL(20,2))  begin
 update proyecto_venta 
 set total_a_pagar = p_total_a_pagar,
  acumulado_pagado = p_acumulado_pagado,
  saldo_por_pagar = p_saldo_por_pagar
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `rol_permiso_by_persona`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rol_permiso_by_persona` (IN `p_persona_id` INT)  begin
select distinct rp.tipo, rp.accion, rp.url
from rol_permiso rp
inner join persona_rol pr on rp.rol_id = pr.rol_id and pr.persona_id = p_persona_id;
END$$

DROP PROCEDURE IF EXISTS `rol_permiso_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rol_permiso_d` (IN `p_id` INT)  begin
delete from rol_permiso where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `rol_permiso_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rol_permiso_get` (IN `p_id` INT)  begin
 select rol_id, tipo, accion, url
 from rol_permiso
 where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `rol_permiso_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rol_permiso_i` (IN `p_rol_id` INT, IN `p_tipo` VARCHAR(50), IN `p_accion` VARCHAR(200), IN `p_url` VARCHAR(500))  begin
insert into rol_permiso(rol_id, tipo, accion, url)
values(p_rol_id, p_tipo, p_accion, p_url);
END$$

DROP PROCEDURE IF EXISTS `rol_permiso_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rol_permiso_list` ()  begin
select rp.id, r.nombre as rol, rp.tipo, rp.accion, rp.url
from rol_permiso rp
inner join rol r on rp.rol_id = r.id;
END$$

DROP PROCEDURE IF EXISTS `rol_permiso_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rol_permiso_u` (IN `p_id` INT, IN `p_rol_id` INT, IN `p_tipo` VARCHAR(50), IN `p_accion` VARCHAR(200), IN `p_url` VARCHAR(500))  begin
update rol_permiso
set rol_id = p_rol_id,
 tipo = p_tipo,
 accion = p_accion,
 url = p_url
where id = p_id;
END$$

DROP PROCEDURE IF EXISTS `ubigeo_peru_departments_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ubigeo_peru_departments_list` ()  begin
 select id, name
 from ubigeo_peru_departments;
END$$

DROP PROCEDURE IF EXISTS `ubigeo_peru_districts_list_by_department_and_province`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ubigeo_peru_districts_list_by_department_and_province` (IN `p_department_id` VARCHAR(2), IN `p_province_id` VARCHAR(4))  begin
 select id, name
 from ubigeo_peru_districts
 where department_id = p_department_id and province_id = p_province_id;
END$$

DROP PROCEDURE IF EXISTS `ubigeo_peru_provinces_list_by_department`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ubigeo_peru_provinces_list_by_department` (IN `p_department_id` VARCHAR(2))  begin
 select id, name
 from ubigeo_peru_provinces
 where department_id = p_department_id;
END$$

DROP PROCEDURE IF EXISTS `unidad_medida_d`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `unidad_medida_d` (IN `p_codigo` VARCHAR(10))  begin
	delete from unidad_medida where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `unidad_medida_get`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `unidad_medida_get` (IN `p_codigo` VARCHAR(10))  begin
	select nombre
	from unidad_medida
	where codigo = p_codigo;
END$$

DROP PROCEDURE IF EXISTS `unidad_medida_i`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `unidad_medida_i` (IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100))  begin
	insert into unidad_medida(codigo, nombre)
	values(p_codigo, p_nombre);
END$$

DROP PROCEDURE IF EXISTS `unidad_medida_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `unidad_medida_list` ()  begin
	select codigo, nombre
	from unidad_medida;
END$$

DROP PROCEDURE IF EXISTS `unidad_medida_u`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `unidad_medida_u` (IN `p_codigo` VARCHAR(10), IN `p_nombre` VARCHAR(100))  begin
	update unidad_medida
	set codigo = p_codigo,
		nombre = p_nombre
	where codigo = p_codigo;
END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `_get_blob_from_varchar`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `_get_blob_from_varchar` (`p_data` VARCHAR(200)) RETURNS BLOB begin
	DECLARE response_data blob;

	SET response_data = ENCODE(p_data, 'SkyTechnologies');

	RETURN response_data;
END$$

DROP FUNCTION IF EXISTS `_get_date_from_varchar`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `_get_date_from_varchar` (`p_date` VARCHAR(10)) RETURNS DATE BEGIN
	DECLARE response_data date;

	SET response_data = if(p_date='', null, str_to_date(p_date, '%d/%m/%Y'));

	RETURN response_data;

END$$

DROP FUNCTION IF EXISTS `_get_null_or_value_from_decimal`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `_get_null_or_value_from_decimal` (`p_data` DECIMAL(5,2)) RETURNS DECIMAL(5,2) BEGIN
	DECLARE response_data decimal(5, 2);

	SET response_data = nullif(p_data, 0.00);

	RETURN response_data;

END$$

DROP FUNCTION IF EXISTS `_get_null_or_value_from_int`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `_get_null_or_value_from_int` (`p_data` INT) RETURNS INT(11) BEGIN
	DECLARE response_data int;

	SET response_data = nullif(p_data, 0);

	RETURN response_data;

END$$

DROP FUNCTION IF EXISTS `_get_null_or_value_from_varchar`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `_get_null_or_value_from_varchar` (`p_data` VARCHAR(1000)) RETURNS VARCHAR(1000) CHARSET latin1 COLLATE latin1_spanish_ci BEGIN
	DECLARE response_data varchar(1000);
						
	SET response_data = nullif(p_data, '');

	RETURN response_data;

END$$

DROP FUNCTION IF EXISTS `_get_varchar_from_blob`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `_get_varchar_from_blob` (`p_data` BLOB) RETURNS VARCHAR(1000) CHARSET latin1 COLLATE latin1_spanish_ci begin
	DECLARE response_data varchar(1000);

	SET response_data = DECODE(p_data, 'SkyTechnologies');

	RETURN response_data;
END$$

DROP FUNCTION IF EXISTS `_get_varchar_from_date`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `_get_varchar_from_date` (`p_date` VARCHAR(10)) RETURNS VARCHAR(10) CHARSET latin1 COLLATE latin1_spanish_ci BEGIN
	DECLARE response_data varchar(10);
	
	SET response_data = if(p_date='0000-00-00', '', date_format(p_date, '%d/%m/%Y'));

	RETURN response_data;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `ubicacion` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `nombre`, `ubicacion`) VALUES
(1, 'GENERAL', 'UBICACION GENERAL'),
(2, 'SECUNDARIO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_pago_tipo`
--
-- Creación: 16-04-2020 a las 02:56:40
--

DROP TABLE IF EXISTS `comprobante_pago_tipo`;
CREATE TABLE IF NOT EXISTS `comprobante_pago_tipo` (
  `codigo` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `comprobante_pago_tipo`
--

INSERT INTO `comprobante_pago_tipo` (`codigo`, `nombre`) VALUES
('B', 'BOLETA'),
('F', 'FACTURA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_identidad`
--
-- Creación: 16-04-2020 a las 02:56:40
--

DROP TABLE IF EXISTS `documento_identidad`;
CREATE TABLE IF NOT EXISTS `documento_identidad` (
  `codigo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `persona_tipo_id` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `longitud_minima` int(11) NOT NULL,
  `longitud_maxima` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `documento_identidad`
--

INSERT INTO `documento_identidad` (`codigo`, `nombre`, `persona_tipo_id`, `longitud_minima`, `longitud_maxima`) VALUES
('C', 'CARNET DE EXTRANJERÍA', 'N', 20, 15),
('D', 'DNI', 'J', 8, 8),
('R', 'RUC', 'J', 11, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_tipo`
--
-- Creación: 16-04-2020 a las 02:56:40
--

DROP TABLE IF EXISTS `email_tipo`;
CREATE TABLE IF NOT EXISTS `email_tipo` (
  `codigo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `email_tipo`
--

INSERT INTO `email_tipo` (`codigo`, `nombre`) VALUES
('P', 'PERSONAL'),
('T', 'TRABAJO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--
-- Creación: 16-04-2020 a las 02:56:40
--

DROP TABLE IF EXISTS `estado_civil`;
CREATE TABLE IF NOT EXISTS `estado_civil` (
  `codigo` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `estado_civil`
--

INSERT INTO `estado_civil` (`codigo`, `nombre`) VALUES
('C', 'CASAD@'),
('D', 'DIVORCIAD@'),
('E', 'EN RELACIÓN'),
('N', 'NOVIAZGO'),
('O', 'COMPROMETID@'),
('P', 'SEPARAD@'),
('S', 'SOLTER@'),
('U', 'UNIÓN LIBRE / CONVIVIENTE'),
('V', 'VIUD@');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--
-- Creación: 16-04-2020 a las 02:56:40
--

DROP TABLE IF EXISTS `forma_pago`;
CREATE TABLE IF NOT EXISTS `forma_pago` (
  `codigo` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`codigo`, `nombre`) VALUES
('C', 'CONTRA ENTREGA'),
('E', 'EFECTIVO'),
('T', 'TARJETA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--
-- Creación: 16-04-2020 a las 02:56:40
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `codigo` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`codigo`, `nombre`) VALUES
('F', 'FEMENINO'),
('M', 'MASCULINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `kardex`;
CREATE TABLE IF NOT EXISTS `kardex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `almacen_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `unidad_medida_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` decimal(20,2) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_termino` datetime DEFAULT NULL,
  `del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id`, `almacen_id`, `producto_id`, `unidad_medida_id`, `cantidad`, `fecha_ingreso`, `fecha_vencimiento`, `fecha_termino`, `del`) VALUES
(35, 1, 6, 'KG', '10.00', '2020-05-20', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_movimiento`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `kardex_movimiento`;
CREATE TABLE IF NOT EXISTS `kardex_movimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kardex_id` int(11) NOT NULL,
  `tipo_movimiento` varchar(100) COLLATE latin1_spanish_ci NOT NULL COMMENT 'I_PRODUCTO=INGRESO POR PRODUCTO\r\nI_OC=INGRESO POR ORDEN DE COMPRA\r\nI_ALMACEN=INGRESO POR ALMACEN\r\nI_CONVERT_UPDATE=REGISTRO DE MOVIMIENTO CUANDO SE REALIZA UNA CONVERSIÓN\r\nI_CONVERT_UPDATE_FINISH=REGISTRO DE MOVIMIENTO CUANDO SE REALIZA UNA CONVERSIÓN Y LA CANTIDAD QUEDA EN 0\r\nI_CONVERT_NEW=NUEVO REGISTRO DE MOVIMIENTO YA CONVERTIDO\r\nI_ALMACEN_UPDATE=REGISTRO DE MOVIMIENTO CUANDO SE REALIZA UN MOVIMIENTO DE ALMACEN\r\nI_ALMACEN_UPDATE_FINISH=REGISTRO DE MOVIMIENTO CUANDO SE REALIZA UN MOVIMIENTO DE ALMACEN Y LA CANTIDAD QUEDA EN 0\r\n\r\nS_PARTIDA=SALIDA A PARTIDA DE PROYECTO',
  `almacen_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `unidad_medida_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` decimal(20,2) NOT NULL,
  `motivo` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_movimiento` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `precio` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `almacen_origen_id` int(11) DEFAULT NULL,
  `proyecto_origen_id` int(11) DEFAULT NULL,
  `proyecto_trabajo_partida_origen_id` int(11) DEFAULT NULL,
  `orden_compra_id` int(11) DEFAULT NULL,
  `comprobante_pago_tipo_id` char(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `comprobante_pago_codigo` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `per_reg_aud` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `fec_reg_aud` datetime NOT NULL,
  `kardex_origen_id` int(11) DEFAULT NULL,
  `guia_remision` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `guia_remision_pagada` tinyint(1) DEFAULT 0,
  `cantidad_salida` decimal(20,2) DEFAULT NULL,
  `proyecto_trabajo_partida_salida_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `kardex_movimiento`
--

INSERT INTO `kardex_movimiento` (`id`, `kardex_id`, `tipo_movimiento`, `almacen_id`, `producto_id`, `unidad_medida_id`, `cantidad`, `motivo`, `fecha_movimiento`, `fecha_vencimiento`, `fecha_termino`, `precio`, `almacen_origen_id`, `proyecto_origen_id`, `proyecto_trabajo_partida_origen_id`, `orden_compra_id`, `comprobante_pago_tipo_id`, `comprobante_pago_codigo`, `per_reg_aud`, `fec_reg_aud`, `kardex_origen_id`, `guia_remision`, `guia_remision_pagada`, `cantidad_salida`, `proyecto_trabajo_partida_salida_id`) VALUES
(39, 35, 'I_OC', 1, 6, 'KG', '10.00', NULL, '2020-05-20', NULL, NULL, '50.00', NULL, NULL, NULL, 9, NULL, NULL, ' JOSÉ HERNÁN QUISPE CHILCÓN', '2020-05-16 18:13:34', NULL, 'Y', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `orden_compra`;
CREATE TABLE IF NOT EXISTS `orden_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_proveedor_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `proforma_codigo` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `codigo` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `can_delete` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id`, `persona_proveedor_id`, `fecha`, `proforma_codigo`, `codigo`, `used`, `can_delete`) VALUES
(9, 2, '2020-05-18', 'XXXXXXXXXX', 'OC-000001', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra_detalle`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `orden_compra_detalle`;
CREATE TABLE IF NOT EXISTS `orden_compra_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `unidad_medida_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` decimal(20,2) NOT NULL,
  `cantidad_usada` decimal(20,2) NOT NULL DEFAULT 0.00,
  `cantidad_restante` decimal(20,2) NOT NULL DEFAULT 0.00,
  `precio_unitario` decimal(20,2) NOT NULL,
  `orden_compra_id` int(11) NOT NULL,
  `in_progress` tinyint(1) NOT NULL DEFAULT 0,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `orden_compra_detalle_fk` (`orden_compra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `orden_compra_detalle`
--

INSERT INTO `orden_compra_detalle` (`id`, `producto_id`, `unidad_medida_id`, `cantidad`, `cantidad_usada`, `cantidad_restante`, `precio_unitario`, `orden_compra_id`, `in_progress`, `used`) VALUES
(8, 6, 'KG', '10.00', '10.00', '0.00', '50.00', 9, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_contratista`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `pago_contratista`;
CREATE TABLE IF NOT EXISTS `pago_contratista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_contratista_id` int(11) NOT NULL,
  `proyecto_trabajo_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `valor_venta` decimal(20,2) NOT NULL,
  `amortizacion_adelanto` decimal(20,2) NOT NULL,
  `retencion_fondo_garantia` decimal(20,2) NOT NULL,
  `sub_total` decimal(20,2) NOT NULL,
  `igv` decimal(20,2) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `detraccion` decimal(20,2) NOT NULL,
  `neto_pagar` decimal(20,2) NOT NULL,
  `pagado` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pago_contratista`
--

INSERT INTO `pago_contratista` (`id`, `persona_contratista_id`, `proyecto_trabajo_id`, `proyecto_id`, `fecha_inicio`, `fecha_termino`, `valor_venta`, `amortizacion_adelanto`, `retencion_fondo_garantia`, `sub_total`, `igv`, `total`, `detraccion`, `neto_pagar`, `pagado`) VALUES
(13, 2, 12, 3, '2020-04-01', '2020-04-24', '342.00', '100.00', '0.00', '242.00', '43.56', '285.56', '34.27', '319.83', 1),
(15, 2, 17, 5, '2020-05-01', '2020-05-01', '135.00', '13.50', '6.75', '114.75', '20.66', '135.41', '16.25', '151.65', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_proveedor`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `pago_proveedor`;
CREATE TABLE IF NOT EXISTS `pago_proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orden_compra_id` int(11) NOT NULL,
  `guia_remision` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `persona_proveedor` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `comprobante_pago_tipo_id` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `comprobante_pago_codigo` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto_total` decimal(20,2) NOT NULL,
  `pagado` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `pago_proveedor_fk` (`orden_compra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pago_proveedor`
--

INSERT INTO `pago_proveedor` (`id`, `orden_compra_id`, `guia_remision`, `persona_proveedor`, `comprobante_pago_tipo_id`, `comprobante_pago_codigo`, `fecha_pago`, `monto_total`, `pagado`) VALUES
(13, 9, 'Y', 'SODIMAC SAC', 'B', '1', '2020-05-20', '500.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_proveedor_detalle`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `pago_proveedor_detalle`;
CREATE TABLE IF NOT EXISTS `pago_proveedor_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pago_proveedor_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `unidad_medida_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `precio_unitario` decimal(20,2) NOT NULL,
  `cantidad` decimal(20,2) NOT NULL,
  `sub_total` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pago_proveedor_detalle_fk` (`pago_proveedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pago_proveedor_detalle`
--

INSERT INTO `pago_proveedor_detalle` (`id`, `pago_proveedor_id`, `producto_id`, `unidad_medida_id`, `precio_unitario`, `cantidad`, `sub_total`) VALUES
(8, 13, 6, 'KG', '50.00', '10.00', '500.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_tipo_id` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `documento_identidad_id` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `numero_documento_identidad` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_1` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_2` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nombre_3` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `apellido_paterno` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `apellido_materno` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `genero_id` char(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `estado_civil_id` char(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `profile_image` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `usuario` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `clave` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `persona_tipo_id`, `documento_identidad_id`, `numero_documento_identidad`, `nombre_1`, `nombre_2`, `nombre_3`, `apellido_paterno`, `apellido_materno`, `genero_id`, `fecha_nacimiento`, `estado_civil_id`, `profile_image`, `usuario`, `clave`) VALUES
(1, 'N', 'D', '71247631', 'JOSÉ', NULL, NULL, 'QUISPE', 'CHILCÓN', 'M', '1992-05-18', 'S', '20200414030231988626.jpg', 'josehernan', 0x1aafac),
(2, 'J', 'R', '22222222222', 'SODIMAC SAC', NULL, NULL, NULL, NULL, NULL, '2020-03-25', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_direccion`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `persona_direccion`;
CREATE TABLE IF NOT EXISTS `persona_direccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubigeo_peru_department_id` varchar(2) COLLATE latin1_spanish_ci NOT NULL,
  `ubigeo_peru_province_id` varchar(4) COLLATE latin1_spanish_ci NOT NULL,
  `ubigeo_peru_district_id` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `referencia` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `persona_direccion`
--

INSERT INTO `persona_direccion` (`id`, `ubigeo_peru_department_id`, `ubigeo_peru_province_id`, `ubigeo_peru_district_id`, `direccion`, `referencia`, `persona_id`) VALUES
(6, '13', '1301', '130101', 'xxxx2', 'yyyy3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_email`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `persona_email`;
CREATE TABLE IF NOT EXISTS `persona_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_tipo_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `persona_email`
--

INSERT INTO `persona_email` (`id`, `email_tipo_id`, `email`, `persona_id`) VALUES
(1, 'P', 'jose@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_rol`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `persona_rol`;
CREATE TABLE IF NOT EXISTS `persona_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `persona_rol_fk` (`persona_id`),
  KEY `persona_rol_fk_1` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `persona_rol`
--

INSERT INTO `persona_rol` (`id`, `persona_id`, `rol_id`) VALUES
(32, 1, 1),
(33, 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_telefono`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `persona_telefono`;
CREATE TABLE IF NOT EXISTS `persona_telefono` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefono_tipo_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `persona_telefono`
--

INSERT INTO `persona_telefono` (`id`, `telefono_tipo_id`, `telefono`, `persona_id`) VALUES
(1, 'C', '239849234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_tipo`
--
-- Creación: 16-04-2020 a las 02:56:40
--

DROP TABLE IF EXISTS `persona_tipo`;
CREATE TABLE IF NOT EXISTS `persona_tipo` (
  `codigo` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `persona_tipo`
--

INSERT INTO `persona_tipo` (`codigo`, `nombre`) VALUES
('J', 'JURÍDICA'),
('N', 'NATURAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `producto_marca_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_marca_id` (`producto_marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `descripcion`, `producto_marca_id`) VALUES
(6, 'PR-000001', 'TUBO DE 0.5\" PVC', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_marca`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `producto_marca`;
CREATE TABLE IF NOT EXISTS `producto_marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `producto_marca`
--

INSERT INTO `producto_marca` (`id`, `nombre`) VALUES
(2, 'Marca de Prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_stock_minimo`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `producto_stock_minimo`;
CREATE TABLE IF NOT EXISTS `producto_stock_minimo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `unidad_medida_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `stock_minimo` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_stock_minimo_fk` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_unidad_medida`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `producto_unidad_medida`;
CREATE TABLE IF NOT EXISTS `producto_unidad_medida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `unidad_medida_ingreso_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `unidad_medida_salida_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `factor` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_unidad_medida_fk` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE IF NOT EXISTS `proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `presupuesto_plan` decimal(20,2) DEFAULT NULL,
  `valor_venta` decimal(20,2) DEFAULT NULL,
  `presupuesto_por_ejecutar` decimal(20,2) DEFAULT NULL,
  `ubicacion` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_inicio_plan` date DEFAULT NULL,
  `fecha_termino_plan` date DEFAULT NULL,
  `fecha_inicio_real` date DEFAULT NULL,
  `fecha_termino_real` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `codigo`, `nombre`, `presupuesto_plan`, `valor_venta`, `presupuesto_por_ejecutar`, `ubicacion`, `fecha_inicio_plan`, `fecha_termino_plan`, `fecha_inicio_real`, `fecha_termino_real`) VALUES
(3, 'BOSCO-825', 'Bosco 825 - La Merced', '240.00', '354.00', '-126.00', NULL, '2020-03-31', '2020-04-02', '2020-03-31', '2020-04-18'),
(5, 'ARBO-1000', 'ARBOLEDA 1000', NULL, NULL, NULL, 'URB. ARBOLEDA 1000', NULL, NULL, NULL, NULL),
(6, 'REAL', 'REALMMM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_inmueble`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_inmueble`;
CREATE TABLE IF NOT EXISTS `proyecto_inmueble` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `codigo` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `precio` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_inmueble_fk` (`proyecto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_inmueble`
--

INSERT INTO `proyecto_inmueble` (`id`, `proyecto_id`, `codigo`, `nombre`, `precio`) VALUES
(5, 3, '201', 'Departamento', '91250.00'),
(6, 3, '1', 'Estacionamiento', '10000.00'),
(7, 5, '101', 'DEPARTAMENTO 101', '50000.00'),
(8, 5, '102', 'DEPARTAMENTO 102', '60000.00'),
(9, 5, 'CO-01', 'COCHERA 01', '1000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_requerimiento`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_requerimiento`;
CREATE TABLE IF NOT EXISTS `proyecto_requerimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `codigo` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_pedido` date NOT NULL,
  `alert_new_checked` tinyint(1) DEFAULT 0,
  `per_reg_aud` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_requerimiento_detalle`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_requerimiento_detalle`;
CREATE TABLE IF NOT EXISTS `proyecto_requerimiento_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_trabajo_partida_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `unidad_medida_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` decimal(20,2) NOT NULL,
  `fecha_en_obra` date NOT NULL,
  `proyecto_requerimiento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_requerimiento_detalle_fk` (`proyecto_requerimiento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_trabajo`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_trabajo`;
CREATE TABLE IF NOT EXISTS `proyecto_trabajo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `persona_contratista_id` int(11) NOT NULL,
  `porcentaje_amortizacion_adelanto` decimal(5,2) NOT NULL DEFAULT 0.00,
  `porcentaje_retencion_fondo_garantia` decimal(5,2) NOT NULL DEFAULT 0.00,
  `cantidad_adelanto` decimal(20,2) NOT NULL DEFAULT 0.00,
  `cantidad_adelanto_usado` decimal(20,2) NOT NULL DEFAULT 0.00,
  `cantidad_adelanto_restante` decimal(20,2) NOT NULL DEFAULT 0.00,
  `can_update` tinyint(1) NOT NULL DEFAULT 1,
  `can_delete` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_trabajo`
--

INSERT INTO `proyecto_trabajo` (`id`, `nombre`, `proyecto_id`, `persona_contratista_id`, `porcentaje_amortizacion_adelanto`, `porcentaje_retencion_fondo_garantia`, `cantidad_adelanto`, `cantidad_adelanto_usado`, `cantidad_adelanto_restante`, `can_update`, `can_delete`) VALUES
(12, 'DEMOLICIÓN', 3, 2, '0.00', '0.00', '100.00', '100.00', '0.00', 0, 0),
(14, 'TST', 3, 2, '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0),
(15, 'PRUEBA', 3, 2, '0.00', '0.00', '22.00', '0.00', '22.00', 1, 0),
(17, 'OBRAS PRELIMINARES', 5, 2, '10.00', '5.00', '540.00', '13.50', '526.50', 0, 0),
(18, 'ARBOLEDA XXXX', 5, 2, '2.00', '3.00', '0.00', '0.00', '0.00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_trabajo_partida`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_trabajo_partida`;
CREATE TABLE IF NOT EXISTS `proyecto_trabajo_partida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `unidad_medida_id` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `precio_unitario_plan` decimal(20,2) DEFAULT NULL,
  `cantidad_plan` decimal(20,2) DEFAULT NULL,
  `precio_plan` decimal(20,2) DEFAULT NULL,
  `fecha_inicio_plan` date DEFAULT NULL,
  `fecha_termino_plan` date DEFAULT NULL,
  `proyecto_trabajo_id` int(11) DEFAULT NULL,
  `proyecto_trabajo_partida_id` int(11) DEFAULT NULL,
  `can_delete` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_inicio_real` date DEFAULT NULL,
  `fecha_termino_real` date DEFAULT NULL,
  `cantidad_real_acumulada` decimal(20,2) DEFAULT NULL,
  `precio_real_acumulado` decimal(20,2) DEFAULT NULL,
  `cantidad_por_ejecutar` decimal(20,2) DEFAULT NULL,
  `precio_por_ejecutar` decimal(20,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_trabajo_partida`
--

INSERT INTO `proyecto_trabajo_partida` (`id`, `codigo`, `nombre`, `unidad_medida_id`, `precio_unitario_plan`, `cantidad_plan`, `precio_plan`, `fecha_inicio_plan`, `fecha_termino_plan`, `proyecto_trabajo_id`, `proyecto_trabajo_partida_id`, `can_delete`, `fecha_inicio_real`, `fecha_termino_real`, `cantidad_real_acumulada`, `precio_real_acumulado`, `cantidad_por_ejecutar`, `precio_por_ejecutar`) VALUES
(93, '1', 'ESTRUCTURAS', NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(94, '1.1', 'OBRAS PRELIMINARES', NULL, NULL, NULL, NULL, NULL, NULL, 12, 93, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(95, '1.1.1', 'Trazo, Nivelacion y Replanteo durante ejecucion de obra', 'KG', '6.00', '5.00', '30.00', '2020-04-01', '2020-04-01', 12, 94, 0, '2020-04-01', '2020-04-03', '4.00', '12.00', '1.00', '18.00'),
(96, '1.1.2', 'Pruebaaaaa', 'TN', '3.00', '66.00', '198.00', '2020-03-31', '2020-04-01', 12, 94, 0, '2020-03-31', '2020-04-18', '10.00', '342.00', '56.00', '-144.00'),
(102, '2', 'OBRAS PRELIMINARES', 'KG', '3.00', '4.00', '12.00', '2020-04-01', '2020-04-02', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(103, '1', '222', NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(104, '3', '4444', NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(105, '4', '555', NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(106, '2', '3', NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(128, '1', 'DEMOLICIONES', 'KG', '45.00', '12.00', '540.00', '2020-05-01', '2020-05-02', 17, NULL, 0, '2020-05-01', '2020-05-01', '3.00', '135.00', '9.00', '405.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_trabajo_partida_avance`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_trabajo_partida_avance`;
CREATE TABLE IF NOT EXISTS `proyecto_trabajo_partida_avance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_trabajo_partida_id` int(11) NOT NULL,
  `fecha_inicio_avance` date NOT NULL,
  `fecha_termino_avance` date NOT NULL,
  `precio_unitario_avance` decimal(20,2) NOT NULL,
  `cantidad_avance` decimal(20,2) NOT NULL,
  `precio_avance` decimal(20,2) NOT NULL,
  `per_reg_aud` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `fec_reg_aud` datetime NOT NULL,
  `pago_generado` tinyint(1) NOT NULL DEFAULT 0,
  `pago_contratista_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_trabajo_partida_avance`
--

INSERT INTO `proyecto_trabajo_partida_avance` (`id`, `proyecto_trabajo_partida_id`, `fecha_inicio_avance`, `fecha_termino_avance`, `precio_unitario_avance`, `cantidad_avance`, `precio_avance`, `per_reg_aud`, `fec_reg_aud`, `pago_generado`, `pago_contratista_id`) VALUES
(38, 95, '2020-04-01', '2020-04-03', '3.00', '4.00', '12.00', ' JOSÉ HERNÁN QUISPE CHILCÓN', '2020-04-15 00:06:49', 1, 13),
(39, 96, '2020-04-01', '2020-04-18', '55.00', '6.00', '330.00', ' JOSÉ HERNÁN QUISPE CHILCÓN', '2020-04-21 07:51:34', 1, 13),
(44, 96, '2020-03-31', '2020-03-31', '3.00', '4.00', '12.00', ' JOSÉ HERNÁN QUISPE CHILCÓN', '2020-04-25 09:01:31', 0, NULL),
(49, 128, '2020-05-01', '2020-05-01', '45.00', '3.00', '135.00', ' JOSÉ HERNÁN QUISPE CHILCÓN', '2020-05-16 11:47:36', 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_trabajo_partida_producto`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_trabajo_partida_producto`;
CREATE TABLE IF NOT EXISTS `proyecto_trabajo_partida_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `unidad_medida_id` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` decimal(20,2) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `kardex_id` int(11) NOT NULL,
  `proyecto_trabajo_partida_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_trabajo_partida_producto_fk` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_venta`
--
-- Creación: 12-07-2020 a las 17:32:51
-- Última actualización: 12-07-2020 a las 17:24:53
--

DROP TABLE IF EXISTS `proyecto_venta`;
CREATE TABLE IF NOT EXISTS `proyecto_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `persona_cliente_id` int(11) NOT NULL,
  `moneda` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `total_a_pagar` decimal(20,2) NOT NULL,
  `acumulado_pagado` decimal(20,2) NOT NULL DEFAULT 0.00,
  `saldo_por_pagar` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_venta_fk` (`proyecto_id`),
  KEY `proyecto_venta_fk_1` (`persona_cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_venta`
--

INSERT INTO `proyecto_venta` (`id`, `proyecto_id`, `persona_cliente_id`, `moneda`, `total_a_pagar`, `acumulado_pagado`, `saldo_por_pagar`) VALUES
(5, 3, 1, 'USD', '101250.00', '0.00', '101250.00'),
(6, 5, 1, 'USD', '110000.00', '10.00', '109990.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_venta_cronograma_pago`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_venta_cronograma_pago`;
CREATE TABLE IF NOT EXISTS `proyecto_venta_cronograma_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_venta_id` int(11) NOT NULL,
  `monto_a_pagar` decimal(20,2) NOT NULL,
  `fecha_programada` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_venta_cronograma_pago_fk` (`proyecto_venta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_venta_cronograma_pago`
--

INSERT INTO `proyecto_venta_cronograma_pago` (`id`, `proyecto_venta_id`, `monto_a_pagar`, `fecha_programada`) VALUES
(2, 5, '60.00', '2020-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_venta_detalle`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_venta_detalle`;
CREATE TABLE IF NOT EXISTS `proyecto_venta_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_venta_id` int(11) NOT NULL,
  `proyecto_inmueble_id` int(11) NOT NULL,
  `precio` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_venta_detalle_fk` (`proyecto_venta_id`),
  KEY `proyecto_venta_detalle_fk_1` (`proyecto_inmueble_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_venta_detalle`
--

INSERT INTO `proyecto_venta_detalle` (`id`, `proyecto_venta_id`, `proyecto_inmueble_id`, `precio`) VALUES
(9, 5, 5, '91250.00'),
(10, 5, 6, '10000.00'),
(11, 6, 7, '50000.00'),
(12, 6, 8, '60000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_venta_pago`
--
-- Creación: 12-07-2020 a las 17:32:51
-- Última actualización: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `proyecto_venta_pago`;
CREATE TABLE IF NOT EXISTS `proyecto_venta_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_venta_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `comprobante_codigo` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `monto_moneda_venta` decimal(20,2) NOT NULL,
  `moneda_pago` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `moneda_pago_valor_conversion` decimal(20,2) NOT NULL,
  `monto_moneda_pago` decimal(20,2) NOT NULL,
  `igv` decimal(20,2) NOT NULL,
  `monto_total_moneda_pago` decimal(20,2) NOT NULL,
  `detraccion` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_venta_pago_fk` (`proyecto_venta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_venta_pago`
--

INSERT INTO `proyecto_venta_pago` (`id`, `proyecto_venta_id`, `fecha`, `comprobante_codigo`, `monto_moneda_venta`, `moneda_pago`, `moneda_pago_valor_conversion`, `monto_moneda_pago`, `igv`, `monto_total_moneda_pago`, `detraccion`) VALUES
(3, 5, '2020-05-01', '22222', '20.00', 'USD', '1.00', '20.00', '3.59', '23.60', '0.00'),
(4, 6, '2020-07-01', 'wqdqw', '10.00', 'USD', '1.00', '10.00', '4.58', '5.41', '0.40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `descripcion`) VALUES
(1, 'ADMINISTRADOR', NULL),
(3, 'EMPLEADO', NULL),
(4, 'CONTRATISTA', NULL),
(5, 'CLIENTE', NULL),
(6, 'PROVEEDOR', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--
-- Creación: 12-07-2020 a las 17:32:51
--

DROP TABLE IF EXISTS `rol_permiso`;
CREATE TABLE IF NOT EXISTS `rol_permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `accion` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `url` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_permiso_fk` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`id`, `rol_id`, `tipo`, `accion`, `url`) VALUES
(3, 1, 'MENU', 'menu-rolPermiso', 'rol_permiso/list.html'),
(4, 1, 'MENU', 'menu-proyectoVenta', 'proyecto_venta/list.html'),
(5, 1, 'MENU', 'menu-productoMarca', 'producto_marca/list.html'),
(6, 1, 'MENU', 'menu-avanceProyecto', 'reporte/avance_proyecto.html'),
(7, 1, 'MENU', 'menu-proyectoRequerimiento', 'proyecto_requerimiento/list.html'),
(8, 1, 'MENU', 'menu-pagoContratista', 'pago_contratista/list.html'),
(9, 1, 'MENU', 'menu-genero', 'genero/list.html'),
(10, 1, 'MENU', 'menu-documentoIdentidad', 'documento_identidad/list.html'),
(11, 1, 'MENU', 'menu-personaTipo', 'persona_tipo/list.html'),
(12, 1, 'MENU', 'menu-rol', 'rol/list.html'),
(13, 1, 'MENU', 'menu-formaPago', 'forma_pago/list.html'),
(14, 1, 'MENU', 'menu-comprobantePagoTipo', 'comprobante_pago_tipo/list.html'),
(15, 1, 'MENU', 'menu-estadoCivil', 'estado_civil/list.html'),
(16, 1, 'MENU', 'menu-telefonoTipo', 'telefono_tipo/list.html'),
(17, 1, 'MENU', 'menu-emailTipo', 'email_tipo/list.html'),
(18, 1, 'MENU', 'menu-unidadMedida', 'unidad_medida/list.html'),
(19, 1, 'MENU', 'menu-almacen', 'almacen/list.html'),
(20, 1, 'MENU', 'menu-producto', 'producto/list.html'),
(21, 1, 'MENU', 'menu-persona', 'persona/list.html'),
(22, 1, 'MENU', 'menu-ordenCompra', 'orden_compra/list.html'),
(23, 1, 'MENU', 'menu-proyecto', 'proyecto/list.html'),
(24, 1, 'MENU', 'menu-kardex', 'kardex/list.html'),
(29, 1, 'MODULO', 'modulo-reportes', NULL),
(30, 1, 'MODULO', 'modulo-menu', NULL),
(31, 1, 'MODULO', 'modulo-maestros', NULL),
(32, 1, 'MODULO', 'modulo-sistema', NULL),
(33, 1, 'MENU', 'menu-pagoProveedor', 'pago_proveedor/list.html'),
(34, 1, 'MENU', 'menu-ventas', 'reporte/ventas.html'),
(37, 1, 'MENU', 'menu-pagoProveedores', 'reporte/pago_proveedores.html'),
(38, 1, 'MENU', 'menu-reportOrdenesCompra', 'reporte/ordenes_compra.html'),
(39, 1, 'MENU', 'menu-reportMovimientosAlmacen', 'reporte/movimientos_almacen.html');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono_tipo`
--
-- Creación: 16-04-2020 a las 02:56:40
--

DROP TABLE IF EXISTS `telefono_tipo`;
CREATE TABLE IF NOT EXISTS `telefono_tipo` (
  `codigo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `telefono_tipo`
--

INSERT INTO `telefono_tipo` (`codigo`, `nombre`) VALUES
('C', 'CELULAR'),
('W', 'WHATSAPP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo_peru_departments`
--
-- Creación: 13-05-2020 a las 05:40:37
--

DROP TABLE IF EXISTS `ubigeo_peru_departments`;
CREATE TABLE IF NOT EXISTS `ubigeo_peru_departments` (
  `id` varchar(2) COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ubigeo_peru_departments`
--

INSERT INTO `ubigeo_peru_departments` (`id`, `name`) VALUES
('01', 'Amazonas'),
('02', 'Áncash'),
('03', 'Apurímac'),
('04', 'Arequipa'),
('05', 'Ayacucho'),
('06', 'Cajamarca'),
('07', 'Callao'),
('08', 'Cusco'),
('09', 'Huancavelica'),
('10', 'Huánuco'),
('11', 'Ica'),
('12', 'Junín'),
('13', 'La Libertad'),
('14', 'Lambayeque'),
('15', 'Lima'),
('16', 'Loreto'),
('17', 'Madre de Dios'),
('18', 'Moquegua'),
('19', 'Pasco'),
('20', 'Piura'),
('21', 'Puno'),
('22', 'San Martín'),
('23', 'Tacna'),
('24', 'Tumbes'),
('25', 'Ucayali');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo_peru_districts`
--
-- Creación: 13-05-2020 a las 05:40:37
--

DROP TABLE IF EXISTS `ubigeo_peru_districts`;
CREATE TABLE IF NOT EXISTS `ubigeo_peru_districts` (
  `id` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `province_id` varchar(4) COLLATE latin1_spanish_ci DEFAULT NULL,
  `department_id` varchar(2) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ubigeo_peru_districts`
--

INSERT INTO `ubigeo_peru_districts` (`id`, `name`, `province_id`, `department_id`) VALUES
('010101', 'Chachapoyas', '0101', '01'),
('010102', 'Asunción', '0101', '01'),
('010103', 'Balsas', '0101', '01'),
('010104', 'Cheto', '0101', '01'),
('010105', 'Chiliquin', '0101', '01'),
('010106', 'Chuquibamba', '0101', '01'),
('010107', 'Granada', '0101', '01'),
('010108', 'Huancas', '0101', '01'),
('010109', 'La Jalca', '0101', '01'),
('010110', 'Leimebamba', '0101', '01'),
('010111', 'Levanto', '0101', '01'),
('010112', 'Magdalena', '0101', '01'),
('010113', 'Mariscal Castilla', '0101', '01'),
('010114', 'Molinopampa', '0101', '01'),
('010115', 'Montevideo', '0101', '01'),
('010116', 'Olleros', '0101', '01'),
('010117', 'Quinjalca', '0101', '01'),
('010118', 'San Francisco de Daguas', '0101', '01'),
('010119', 'San Isidro de Maino', '0101', '01'),
('010120', 'Soloco', '0101', '01'),
('010121', 'Sonche', '0101', '01'),
('010201', 'Bagua', '0102', '01'),
('010202', 'Aramango', '0102', '01'),
('010203', 'Copallin', '0102', '01'),
('010204', 'El Parco', '0102', '01'),
('010205', 'Imaza', '0102', '01'),
('010206', 'La Peca', '0102', '01'),
('010301', 'Jumbilla', '0103', '01'),
('010302', 'Chisquilla', '0103', '01'),
('010303', 'Churuja', '0103', '01'),
('010304', 'Corosha', '0103', '01'),
('010305', 'Cuispes', '0103', '01'),
('010306', 'Florida', '0103', '01'),
('010307', 'Jazan', '0103', '01'),
('010308', 'Recta', '0103', '01'),
('010309', 'San Carlos', '0103', '01'),
('010310', 'Shipasbamba', '0103', '01'),
('010311', 'Valera', '0103', '01'),
('010312', 'Yambrasbamba', '0103', '01'),
('010401', 'Nieva', '0104', '01'),
('010402', 'El Cenepa', '0104', '01'),
('010403', 'Río Santiago', '0104', '01'),
('010501', 'Lamud', '0105', '01'),
('010502', 'Camporredondo', '0105', '01'),
('010503', 'Cocabamba', '0105', '01'),
('010504', 'Colcamar', '0105', '01'),
('010505', 'Conila', '0105', '01'),
('010506', 'Inguilpata', '0105', '01'),
('010507', 'Longuita', '0105', '01'),
('010508', 'Lonya Chico', '0105', '01'),
('010509', 'Luya', '0105', '01'),
('010510', 'Luya Viejo', '0105', '01'),
('010511', 'María', '0105', '01'),
('010512', 'Ocalli', '0105', '01'),
('010513', 'Ocumal', '0105', '01'),
('010514', 'Pisuquia', '0105', '01'),
('010515', 'Providencia', '0105', '01'),
('010516', 'San Cristóbal', '0105', '01'),
('010517', 'San Francisco de Yeso', '0105', '01'),
('010518', 'San Jerónimo', '0105', '01'),
('010519', 'San Juan de Lopecancha', '0105', '01'),
('010520', 'Santa Catalina', '0105', '01'),
('010521', 'Santo Tomas', '0105', '01'),
('010522', 'Tingo', '0105', '01'),
('010523', 'Trita', '0105', '01'),
('010601', 'San Nicolás', '0106', '01'),
('010602', 'Chirimoto', '0106', '01'),
('010603', 'Cochamal', '0106', '01'),
('010604', 'Huambo', '0106', '01'),
('010605', 'Limabamba', '0106', '01'),
('010606', 'Longar', '0106', '01'),
('010607', 'Mariscal Benavides', '0106', '01'),
('010608', 'Milpuc', '0106', '01'),
('010609', 'Omia', '0106', '01'),
('010610', 'Santa Rosa', '0106', '01'),
('010611', 'Totora', '0106', '01'),
('010612', 'Vista Alegre', '0106', '01'),
('010701', 'Bagua Grande', '0107', '01'),
('010702', 'Cajaruro', '0107', '01'),
('010703', 'Cumba', '0107', '01'),
('010704', 'El Milagro', '0107', '01'),
('010705', 'Jamalca', '0107', '01'),
('010706', 'Lonya Grande', '0107', '01'),
('010707', 'Yamon', '0107', '01'),
('020101', 'Huaraz', '0201', '02'),
('020102', 'Cochabamba', '0201', '02'),
('020103', 'Colcabamba', '0201', '02'),
('020104', 'Huanchay', '0201', '02'),
('020105', 'Independencia', '0201', '02'),
('020106', 'Jangas', '0201', '02'),
('020107', 'La Libertad', '0201', '02'),
('020108', 'Olleros', '0201', '02'),
('020109', 'Pampas Grande', '0201', '02'),
('020110', 'Pariacoto', '0201', '02'),
('020111', 'Pira', '0201', '02'),
('020112', 'Tarica', '0201', '02'),
('020201', 'Aija', '0202', '02'),
('020202', 'Coris', '0202', '02'),
('020203', 'Huacllan', '0202', '02'),
('020204', 'La Merced', '0202', '02'),
('020205', 'Succha', '0202', '02'),
('020301', 'Llamellin', '0203', '02'),
('020302', 'Aczo', '0203', '02'),
('020303', 'Chaccho', '0203', '02'),
('020304', 'Chingas', '0203', '02'),
('020305', 'Mirgas', '0203', '02'),
('020306', 'San Juan de Rontoy', '0203', '02'),
('020401', 'Chacas', '0204', '02'),
('020402', 'Acochaca', '0204', '02'),
('020501', 'Chiquian', '0205', '02'),
('020502', 'Abelardo Pardo Lezameta', '0205', '02'),
('020503', 'Antonio Raymondi', '0205', '02'),
('020504', 'Aquia', '0205', '02'),
('020505', 'Cajacay', '0205', '02'),
('020506', 'Canis', '0205', '02'),
('020507', 'Colquioc', '0205', '02'),
('020508', 'Huallanca', '0205', '02'),
('020509', 'Huasta', '0205', '02'),
('020510', 'Huayllacayan', '0205', '02'),
('020511', 'La Primavera', '0205', '02'),
('020512', 'Mangas', '0205', '02'),
('020513', 'Pacllon', '0205', '02'),
('020514', 'San Miguel de Corpanqui', '0205', '02'),
('020515', 'Ticllos', '0205', '02'),
('020601', 'Carhuaz', '0206', '02'),
('020602', 'Acopampa', '0206', '02'),
('020603', 'Amashca', '0206', '02'),
('020604', 'Anta', '0206', '02'),
('020605', 'Ataquero', '0206', '02'),
('020606', 'Marcara', '0206', '02'),
('020607', 'Pariahuanca', '0206', '02'),
('020608', 'San Miguel de Aco', '0206', '02'),
('020609', 'Shilla', '0206', '02'),
('020610', 'Tinco', '0206', '02'),
('020611', 'Yungar', '0206', '02'),
('020701', 'San Luis', '0207', '02'),
('020702', 'San Nicolás', '0207', '02'),
('020703', 'Yauya', '0207', '02'),
('020801', 'Casma', '0208', '02'),
('020802', 'Buena Vista Alta', '0208', '02'),
('020803', 'Comandante Noel', '0208', '02'),
('020804', 'Yautan', '0208', '02'),
('020901', 'Corongo', '0209', '02'),
('020902', 'Aco', '0209', '02'),
('020903', 'Bambas', '0209', '02'),
('020904', 'Cusca', '0209', '02'),
('020905', 'La Pampa', '0209', '02'),
('020906', 'Yanac', '0209', '02'),
('020907', 'Yupan', '0209', '02'),
('021001', 'Huari', '0210', '02'),
('021002', 'Anra', '0210', '02'),
('021003', 'Cajay', '0210', '02'),
('021004', 'Chavin de Huantar', '0210', '02'),
('021005', 'Huacachi', '0210', '02'),
('021006', 'Huacchis', '0210', '02'),
('021007', 'Huachis', '0210', '02'),
('021008', 'Huantar', '0210', '02'),
('021009', 'Masin', '0210', '02'),
('021010', 'Paucas', '0210', '02'),
('021011', 'Ponto', '0210', '02'),
('021012', 'Rahuapampa', '0210', '02'),
('021013', 'Rapayan', '0210', '02'),
('021014', 'San Marcos', '0210', '02'),
('021015', 'San Pedro de Chana', '0210', '02'),
('021016', 'Uco', '0210', '02'),
('021101', 'Huarmey', '0211', '02'),
('021102', 'Cochapeti', '0211', '02'),
('021103', 'Culebras', '0211', '02'),
('021104', 'Huayan', '0211', '02'),
('021105', 'Malvas', '0211', '02'),
('021201', 'Caraz', '0212', '02'),
('021202', 'Huallanca', '0212', '02'),
('021203', 'Huata', '0212', '02'),
('021204', 'Huaylas', '0212', '02'),
('021205', 'Mato', '0212', '02'),
('021206', 'Pamparomas', '0212', '02'),
('021207', 'Pueblo Libre', '0212', '02'),
('021208', 'Santa Cruz', '0212', '02'),
('021209', 'Santo Toribio', '0212', '02'),
('021210', 'Yuracmarca', '0212', '02'),
('021301', 'Piscobamba', '0213', '02'),
('021302', 'Casca', '0213', '02'),
('021303', 'Eleazar Guzmán Barron', '0213', '02'),
('021304', 'Fidel Olivas Escudero', '0213', '02'),
('021305', 'Llama', '0213', '02'),
('021306', 'Llumpa', '0213', '02'),
('021307', 'Lucma', '0213', '02'),
('021308', 'Musga', '0213', '02'),
('021401', 'Ocros', '0214', '02'),
('021402', 'Acas', '0214', '02'),
('021403', 'Cajamarquilla', '0214', '02'),
('021404', 'Carhuapampa', '0214', '02'),
('021405', 'Cochas', '0214', '02'),
('021406', 'Congas', '0214', '02'),
('021407', 'Llipa', '0214', '02'),
('021408', 'San Cristóbal de Rajan', '0214', '02'),
('021409', 'San Pedro', '0214', '02'),
('021410', 'Santiago de Chilcas', '0214', '02'),
('021501', 'Cabana', '0215', '02'),
('021502', 'Bolognesi', '0215', '02'),
('021503', 'Conchucos', '0215', '02'),
('021504', 'Huacaschuque', '0215', '02'),
('021505', 'Huandoval', '0215', '02'),
('021506', 'Lacabamba', '0215', '02'),
('021507', 'Llapo', '0215', '02'),
('021508', 'Pallasca', '0215', '02'),
('021509', 'Pampas', '0215', '02'),
('021510', 'Santa Rosa', '0215', '02'),
('021511', 'Tauca', '0215', '02'),
('021601', 'Pomabamba', '0216', '02'),
('021602', 'Huayllan', '0216', '02'),
('021603', 'Parobamba', '0216', '02'),
('021604', 'Quinuabamba', '0216', '02'),
('021701', 'Recuay', '0217', '02'),
('021702', 'Catac', '0217', '02'),
('021703', 'Cotaparaco', '0217', '02'),
('021704', 'Huayllapampa', '0217', '02'),
('021705', 'Llacllin', '0217', '02'),
('021706', 'Marca', '0217', '02'),
('021707', 'Pampas Chico', '0217', '02'),
('021708', 'Pararin', '0217', '02'),
('021709', 'Tapacocha', '0217', '02'),
('021710', 'Ticapampa', '0217', '02'),
('021801', 'Chimbote', '0218', '02'),
('021802', 'Cáceres del Perú', '0218', '02'),
('021803', 'Coishco', '0218', '02'),
('021804', 'Macate', '0218', '02'),
('021805', 'Moro', '0218', '02'),
('021806', 'Nepeña', '0218', '02'),
('021807', 'Samanco', '0218', '02'),
('021808', 'Santa', '0218', '02'),
('021809', 'Nuevo Chimbote', '0218', '02'),
('021901', 'Sihuas', '0219', '02'),
('021902', 'Acobamba', '0219', '02'),
('021903', 'Alfonso Ugarte', '0219', '02'),
('021904', 'Cashapampa', '0219', '02'),
('021905', 'Chingalpo', '0219', '02'),
('021906', 'Huayllabamba', '0219', '02'),
('021907', 'Quiches', '0219', '02'),
('021908', 'Ragash', '0219', '02'),
('021909', 'San Juan', '0219', '02'),
('021910', 'Sicsibamba', '0219', '02'),
('022001', 'Yungay', '0220', '02'),
('022002', 'Cascapara', '0220', '02'),
('022003', 'Mancos', '0220', '02'),
('022004', 'Matacoto', '0220', '02'),
('022005', 'Quillo', '0220', '02'),
('022006', 'Ranrahirca', '0220', '02'),
('022007', 'Shupluy', '0220', '02'),
('022008', 'Yanama', '0220', '02'),
('030101', 'Abancay', '0301', '03'),
('030102', 'Chacoche', '0301', '03'),
('030103', 'Circa', '0301', '03'),
('030104', 'Curahuasi', '0301', '03'),
('030105', 'Huanipaca', '0301', '03'),
('030106', 'Lambrama', '0301', '03'),
('030107', 'Pichirhua', '0301', '03'),
('030108', 'San Pedro de Cachora', '0301', '03'),
('030109', 'Tamburco', '0301', '03'),
('030201', 'Andahuaylas', '0302', '03'),
('030202', 'Andarapa', '0302', '03'),
('030203', 'Chiara', '0302', '03'),
('030204', 'Huancarama', '0302', '03'),
('030205', 'Huancaray', '0302', '03'),
('030206', 'Huayana', '0302', '03'),
('030207', 'Kishuara', '0302', '03'),
('030208', 'Pacobamba', '0302', '03'),
('030209', 'Pacucha', '0302', '03'),
('030210', 'Pampachiri', '0302', '03'),
('030211', 'Pomacocha', '0302', '03'),
('030212', 'San Antonio de Cachi', '0302', '03'),
('030213', 'San Jerónimo', '0302', '03'),
('030214', 'San Miguel de Chaccrampa', '0302', '03'),
('030215', 'Santa María de Chicmo', '0302', '03'),
('030216', 'Talavera', '0302', '03'),
('030217', 'Tumay Huaraca', '0302', '03'),
('030218', 'Turpo', '0302', '03'),
('030219', 'Kaquiabamba', '0302', '03'),
('030220', 'José María Arguedas', '0302', '03'),
('030301', 'Antabamba', '0303', '03'),
('030302', 'El Oro', '0303', '03'),
('030303', 'Huaquirca', '0303', '03'),
('030304', 'Juan Espinoza Medrano', '0303', '03'),
('030305', 'Oropesa', '0303', '03'),
('030306', 'Pachaconas', '0303', '03'),
('030307', 'Sabaino', '0303', '03'),
('030401', 'Chalhuanca', '0304', '03'),
('030402', 'Capaya', '0304', '03'),
('030403', 'Caraybamba', '0304', '03'),
('030404', 'Chapimarca', '0304', '03'),
('030405', 'Colcabamba', '0304', '03'),
('030406', 'Cotaruse', '0304', '03'),
('030407', 'Ihuayllo', '0304', '03'),
('030408', 'Justo Apu Sahuaraura', '0304', '03'),
('030409', 'Lucre', '0304', '03'),
('030410', 'Pocohuanca', '0304', '03'),
('030411', 'San Juan de Chacña', '0304', '03'),
('030412', 'Sañayca', '0304', '03'),
('030413', 'Soraya', '0304', '03'),
('030414', 'Tapairihua', '0304', '03'),
('030415', 'Tintay', '0304', '03'),
('030416', 'Toraya', '0304', '03'),
('030417', 'Yanaca', '0304', '03'),
('030501', 'Tambobamba', '0305', '03'),
('030502', 'Cotabambas', '0305', '03'),
('030503', 'Coyllurqui', '0305', '03'),
('030504', 'Haquira', '0305', '03'),
('030505', 'Mara', '0305', '03'),
('030506', 'Challhuahuacho', '0305', '03'),
('030601', 'Chincheros', '0306', '03'),
('030602', 'Anco_Huallo', '0306', '03'),
('030603', 'Cocharcas', '0306', '03'),
('030604', 'Huaccana', '0306', '03'),
('030605', 'Ocobamba', '0306', '03'),
('030606', 'Ongoy', '0306', '03'),
('030607', 'Uranmarca', '0306', '03'),
('030608', 'Ranracancha', '0306', '03'),
('030609', 'Rocchacc', '0306', '03'),
('030610', 'El Porvenir', '0306', '03'),
('030611', 'Los Chankas', '0306', '03'),
('030701', 'Chuquibambilla', '0307', '03'),
('030702', 'Curpahuasi', '0307', '03'),
('030703', 'Gamarra', '0307', '03'),
('030704', 'Huayllati', '0307', '03'),
('030705', 'Mamara', '0307', '03'),
('030706', 'Micaela Bastidas', '0307', '03'),
('030707', 'Pataypampa', '0307', '03'),
('030708', 'Progreso', '0307', '03'),
('030709', 'San Antonio', '0307', '03'),
('030710', 'Santa Rosa', '0307', '03'),
('030711', 'Turpay', '0307', '03'),
('030712', 'Vilcabamba', '0307', '03'),
('030713', 'Virundo', '0307', '03'),
('030714', 'Curasco', '0307', '03'),
('040101', 'Arequipa', '0401', '04'),
('040102', 'Alto Selva Alegre', '0401', '04'),
('040103', 'Cayma', '0401', '04'),
('040104', 'Cerro Colorado', '0401', '04'),
('040105', 'Characato', '0401', '04'),
('040106', 'Chiguata', '0401', '04'),
('040107', 'Jacobo Hunter', '0401', '04'),
('040108', 'La Joya', '0401', '04'),
('040109', 'Mariano Melgar', '0401', '04'),
('040110', 'Miraflores', '0401', '04'),
('040111', 'Mollebaya', '0401', '04'),
('040112', 'Paucarpata', '0401', '04'),
('040113', 'Pocsi', '0401', '04'),
('040114', 'Polobaya', '0401', '04'),
('040115', 'Quequeña', '0401', '04'),
('040116', 'Sabandia', '0401', '04'),
('040117', 'Sachaca', '0401', '04'),
('040118', 'San Juan de Siguas', '0401', '04'),
('040119', 'San Juan de Tarucani', '0401', '04'),
('040120', 'Santa Isabel de Siguas', '0401', '04'),
('040121', 'Santa Rita de Siguas', '0401', '04'),
('040122', 'Socabaya', '0401', '04'),
('040123', 'Tiabaya', '0401', '04'),
('040124', 'Uchumayo', '0401', '04'),
('040125', 'Vitor', '0401', '04'),
('040126', 'Yanahuara', '0401', '04'),
('040127', 'Yarabamba', '0401', '04'),
('040128', 'Yura', '0401', '04'),
('040129', 'José Luis Bustamante Y Rivero', '0401', '04'),
('040201', 'Camaná', '0402', '04'),
('040202', 'José María Quimper', '0402', '04'),
('040203', 'Mariano Nicolás Valcárcel', '0402', '04'),
('040204', 'Mariscal Cáceres', '0402', '04'),
('040205', 'Nicolás de Pierola', '0402', '04'),
('040206', 'Ocoña', '0402', '04'),
('040207', 'Quilca', '0402', '04'),
('040208', 'Samuel Pastor', '0402', '04'),
('040301', 'Caravelí', '0403', '04'),
('040302', 'Acarí', '0403', '04'),
('040303', 'Atico', '0403', '04'),
('040304', 'Atiquipa', '0403', '04'),
('040305', 'Bella Unión', '0403', '04'),
('040306', 'Cahuacho', '0403', '04'),
('040307', 'Chala', '0403', '04'),
('040308', 'Chaparra', '0403', '04'),
('040309', 'Huanuhuanu', '0403', '04'),
('040310', 'Jaqui', '0403', '04'),
('040311', 'Lomas', '0403', '04'),
('040312', 'Quicacha', '0403', '04'),
('040313', 'Yauca', '0403', '04'),
('040401', 'Aplao', '0404', '04'),
('040402', 'Andagua', '0404', '04'),
('040403', 'Ayo', '0404', '04'),
('040404', 'Chachas', '0404', '04'),
('040405', 'Chilcaymarca', '0404', '04'),
('040406', 'Choco', '0404', '04'),
('040407', 'Huancarqui', '0404', '04'),
('040408', 'Machaguay', '0404', '04'),
('040409', 'Orcopampa', '0404', '04'),
('040410', 'Pampacolca', '0404', '04'),
('040411', 'Tipan', '0404', '04'),
('040412', 'Uñon', '0404', '04'),
('040413', 'Uraca', '0404', '04'),
('040414', 'Viraco', '0404', '04'),
('040501', 'Chivay', '0405', '04'),
('040502', 'Achoma', '0405', '04'),
('040503', 'Cabanaconde', '0405', '04'),
('040504', 'Callalli', '0405', '04'),
('040505', 'Caylloma', '0405', '04'),
('040506', 'Coporaque', '0405', '04'),
('040507', 'Huambo', '0405', '04'),
('040508', 'Huanca', '0405', '04'),
('040509', 'Ichupampa', '0405', '04'),
('040510', 'Lari', '0405', '04'),
('040511', 'Lluta', '0405', '04'),
('040512', 'Maca', '0405', '04'),
('040513', 'Madrigal', '0405', '04'),
('040514', 'San Antonio de Chuca', '0405', '04'),
('040515', 'Sibayo', '0405', '04'),
('040516', 'Tapay', '0405', '04'),
('040517', 'Tisco', '0405', '04'),
('040518', 'Tuti', '0405', '04'),
('040519', 'Yanque', '0405', '04'),
('040520', 'Majes', '0405', '04'),
('040601', 'Chuquibamba', '0406', '04'),
('040602', 'Andaray', '0406', '04'),
('040603', 'Cayarani', '0406', '04'),
('040604', 'Chichas', '0406', '04'),
('040605', 'Iray', '0406', '04'),
('040606', 'Río Grande', '0406', '04'),
('040607', 'Salamanca', '0406', '04'),
('040608', 'Yanaquihua', '0406', '04'),
('040701', 'Mollendo', '0407', '04'),
('040702', 'Cocachacra', '0407', '04'),
('040703', 'Dean Valdivia', '0407', '04'),
('040704', 'Islay', '0407', '04'),
('040705', 'Mejia', '0407', '04'),
('040706', 'Punta de Bombón', '0407', '04'),
('040801', 'Cotahuasi', '0408', '04'),
('040802', 'Alca', '0408', '04'),
('040803', 'Charcana', '0408', '04'),
('040804', 'Huaynacotas', '0408', '04'),
('040805', 'Pampamarca', '0408', '04'),
('040806', 'Puyca', '0408', '04'),
('040807', 'Quechualla', '0408', '04'),
('040808', 'Sayla', '0408', '04'),
('040809', 'Tauria', '0408', '04'),
('040810', 'Tomepampa', '0408', '04'),
('040811', 'Toro', '0408', '04'),
('050101', 'Ayacucho', '0501', '05'),
('050102', 'Acocro', '0501', '05'),
('050103', 'Acos Vinchos', '0501', '05'),
('050104', 'Carmen Alto', '0501', '05'),
('050105', 'Chiara', '0501', '05'),
('050106', 'Ocros', '0501', '05'),
('050107', 'Pacaycasa', '0501', '05'),
('050108', 'Quinua', '0501', '05'),
('050109', 'San José de Ticllas', '0501', '05'),
('050110', 'San Juan Bautista', '0501', '05'),
('050111', 'Santiago de Pischa', '0501', '05'),
('050112', 'Socos', '0501', '05'),
('050113', 'Tambillo', '0501', '05'),
('050114', 'Vinchos', '0501', '05'),
('050115', 'Jesús Nazareno', '0501', '05'),
('050116', 'Andrés Avelino Cáceres Dorregaray', '0501', '05'),
('050201', 'Cangallo', '0502', '05'),
('050202', 'Chuschi', '0502', '05'),
('050203', 'Los Morochucos', '0502', '05'),
('050204', 'María Parado de Bellido', '0502', '05'),
('050205', 'Paras', '0502', '05'),
('050206', 'Totos', '0502', '05'),
('050301', 'Sancos', '0503', '05'),
('050302', 'Carapo', '0503', '05'),
('050303', 'Sacsamarca', '0503', '05'),
('050304', 'Santiago de Lucanamarca', '0503', '05'),
('050401', 'Huanta', '0504', '05'),
('050402', 'Ayahuanco', '0504', '05'),
('050403', 'Huamanguilla', '0504', '05'),
('050404', 'Iguain', '0504', '05'),
('050405', 'Luricocha', '0504', '05'),
('050406', 'Santillana', '0504', '05'),
('050407', 'Sivia', '0504', '05'),
('050408', 'Llochegua', '0504', '05'),
('050409', 'Canayre', '0504', '05'),
('050410', 'Uchuraccay', '0504', '05'),
('050411', 'Pucacolpa', '0504', '05'),
('050412', 'Chaca', '0504', '05'),
('050501', 'San Miguel', '0505', '05'),
('050502', 'Anco', '0505', '05'),
('050503', 'Ayna', '0505', '05'),
('050504', 'Chilcas', '0505', '05'),
('050505', 'Chungui', '0505', '05'),
('050506', 'Luis Carranza', '0505', '05'),
('050507', 'Santa Rosa', '0505', '05'),
('050508', 'Tambo', '0505', '05'),
('050509', 'Samugari', '0505', '05'),
('050510', 'Anchihuay', '0505', '05'),
('050511', 'Oronccoy', '0505', '05'),
('050601', 'Puquio', '0506', '05'),
('050602', 'Aucara', '0506', '05'),
('050603', 'Cabana', '0506', '05'),
('050604', 'Carmen Salcedo', '0506', '05'),
('050605', 'Chaviña', '0506', '05'),
('050606', 'Chipao', '0506', '05'),
('050607', 'Huac-Huas', '0506', '05'),
('050608', 'Laramate', '0506', '05'),
('050609', 'Leoncio Prado', '0506', '05'),
('050610', 'Llauta', '0506', '05'),
('050611', 'Lucanas', '0506', '05'),
('050612', 'Ocaña', '0506', '05'),
('050613', 'Otoca', '0506', '05'),
('050614', 'Saisa', '0506', '05'),
('050615', 'San Cristóbal', '0506', '05'),
('050616', 'San Juan', '0506', '05'),
('050617', 'San Pedro', '0506', '05'),
('050618', 'San Pedro de Palco', '0506', '05'),
('050619', 'Sancos', '0506', '05'),
('050620', 'Santa Ana de Huaycahuacho', '0506', '05'),
('050621', 'Santa Lucia', '0506', '05'),
('050701', 'Coracora', '0507', '05'),
('050702', 'Chumpi', '0507', '05'),
('050703', 'Coronel Castañeda', '0507', '05'),
('050704', 'Pacapausa', '0507', '05'),
('050705', 'Pullo', '0507', '05'),
('050706', 'Puyusca', '0507', '05'),
('050707', 'San Francisco de Ravacayco', '0507', '05'),
('050708', 'Upahuacho', '0507', '05'),
('050801', 'Pausa', '0508', '05'),
('050802', 'Colta', '0508', '05'),
('050803', 'Corculla', '0508', '05'),
('050804', 'Lampa', '0508', '05'),
('050805', 'Marcabamba', '0508', '05'),
('050806', 'Oyolo', '0508', '05'),
('050807', 'Pararca', '0508', '05'),
('050808', 'San Javier de Alpabamba', '0508', '05'),
('050809', 'San José de Ushua', '0508', '05'),
('050810', 'Sara Sara', '0508', '05'),
('050901', 'Querobamba', '0509', '05'),
('050902', 'Belén', '0509', '05'),
('050903', 'Chalcos', '0509', '05'),
('050904', 'Chilcayoc', '0509', '05'),
('050905', 'Huacaña', '0509', '05'),
('050906', 'Morcolla', '0509', '05'),
('050907', 'Paico', '0509', '05'),
('050908', 'San Pedro de Larcay', '0509', '05'),
('050909', 'San Salvador de Quije', '0509', '05'),
('050910', 'Santiago de Paucaray', '0509', '05'),
('050911', 'Soras', '0509', '05'),
('051001', 'Huancapi', '0510', '05'),
('051002', 'Alcamenca', '0510', '05'),
('051003', 'Apongo', '0510', '05'),
('051004', 'Asquipata', '0510', '05'),
('051005', 'Canaria', '0510', '05'),
('051006', 'Cayara', '0510', '05'),
('051007', 'Colca', '0510', '05'),
('051008', 'Huamanquiquia', '0510', '05'),
('051009', 'Huancaraylla', '0510', '05'),
('051010', 'Hualla', '0510', '05'),
('051011', 'Sarhua', '0510', '05'),
('051012', 'Vilcanchos', '0510', '05'),
('051101', 'Vilcas Huaman', '0511', '05'),
('051102', 'Accomarca', '0511', '05'),
('051103', 'Carhuanca', '0511', '05'),
('051104', 'Concepción', '0511', '05'),
('051105', 'Huambalpa', '0511', '05'),
('051106', 'Independencia', '0511', '05'),
('051107', 'Saurama', '0511', '05'),
('051108', 'Vischongo', '0511', '05'),
('060101', 'Cajamarca', '0601', '06'),
('060102', 'Asunción', '0601', '06'),
('060103', 'Chetilla', '0601', '06'),
('060104', 'Cospan', '0601', '06'),
('060105', 'Encañada', '0601', '06'),
('060106', 'Jesús', '0601', '06'),
('060107', 'Llacanora', '0601', '06'),
('060108', 'Los Baños del Inca', '0601', '06'),
('060109', 'Magdalena', '0601', '06'),
('060110', 'Matara', '0601', '06'),
('060111', 'Namora', '0601', '06'),
('060112', 'San Juan', '0601', '06'),
('060201', 'Cajabamba', '0602', '06'),
('060202', 'Cachachi', '0602', '06'),
('060203', 'Condebamba', '0602', '06'),
('060204', 'Sitacocha', '0602', '06'),
('060301', 'Celendín', '0603', '06'),
('060302', 'Chumuch', '0603', '06'),
('060303', 'Cortegana', '0603', '06'),
('060304', 'Huasmin', '0603', '06'),
('060305', 'Jorge Chávez', '0603', '06'),
('060306', 'José Gálvez', '0603', '06'),
('060307', 'Miguel Iglesias', '0603', '06'),
('060308', 'Oxamarca', '0603', '06'),
('060309', 'Sorochuco', '0603', '06'),
('060310', 'Sucre', '0603', '06'),
('060311', 'Utco', '0603', '06'),
('060312', 'La Libertad de Pallan', '0603', '06'),
('060401', 'Chota', '0604', '06'),
('060402', 'Anguia', '0604', '06'),
('060403', 'Chadin', '0604', '06'),
('060404', 'Chiguirip', '0604', '06'),
('060405', 'Chimban', '0604', '06'),
('060406', 'Choropampa', '0604', '06'),
('060407', 'Cochabamba', '0604', '06'),
('060408', 'Conchan', '0604', '06'),
('060409', 'Huambos', '0604', '06'),
('060410', 'Lajas', '0604', '06'),
('060411', 'Llama', '0604', '06'),
('060412', 'Miracosta', '0604', '06'),
('060413', 'Paccha', '0604', '06'),
('060414', 'Pion', '0604', '06'),
('060415', 'Querocoto', '0604', '06'),
('060416', 'San Juan de Licupis', '0604', '06'),
('060417', 'Tacabamba', '0604', '06'),
('060418', 'Tocmoche', '0604', '06'),
('060419', 'Chalamarca', '0604', '06'),
('060501', 'Contumaza', '0605', '06'),
('060502', 'Chilete', '0605', '06'),
('060503', 'Cupisnique', '0605', '06'),
('060504', 'Guzmango', '0605', '06'),
('060505', 'San Benito', '0605', '06'),
('060506', 'Santa Cruz de Toledo', '0605', '06'),
('060507', 'Tantarica', '0605', '06'),
('060508', 'Yonan', '0605', '06'),
('060601', 'Cutervo', '0606', '06'),
('060602', 'Callayuc', '0606', '06'),
('060603', 'Choros', '0606', '06'),
('060604', 'Cujillo', '0606', '06'),
('060605', 'La Ramada', '0606', '06'),
('060606', 'Pimpingos', '0606', '06'),
('060607', 'Querocotillo', '0606', '06'),
('060608', 'San Andrés de Cutervo', '0606', '06'),
('060609', 'San Juan de Cutervo', '0606', '06'),
('060610', 'San Luis de Lucma', '0606', '06'),
('060611', 'Santa Cruz', '0606', '06'),
('060612', 'Santo Domingo de la Capilla', '0606', '06'),
('060613', 'Santo Tomas', '0606', '06'),
('060614', 'Socota', '0606', '06'),
('060615', 'Toribio Casanova', '0606', '06'),
('060701', 'Bambamarca', '0607', '06'),
('060702', 'Chugur', '0607', '06'),
('060703', 'Hualgayoc', '0607', '06'),
('060801', 'Jaén', '0608', '06'),
('060802', 'Bellavista', '0608', '06'),
('060803', 'Chontali', '0608', '06'),
('060804', 'Colasay', '0608', '06'),
('060805', 'Huabal', '0608', '06'),
('060806', 'Las Pirias', '0608', '06'),
('060807', 'Pomahuaca', '0608', '06'),
('060808', 'Pucara', '0608', '06'),
('060809', 'Sallique', '0608', '06'),
('060810', 'San Felipe', '0608', '06'),
('060811', 'San José del Alto', '0608', '06'),
('060812', 'Santa Rosa', '0608', '06'),
('060901', 'San Ignacio', '0609', '06'),
('060902', 'Chirinos', '0609', '06'),
('060903', 'Huarango', '0609', '06'),
('060904', 'La Coipa', '0609', '06'),
('060905', 'Namballe', '0609', '06'),
('060906', 'San José de Lourdes', '0609', '06'),
('060907', 'Tabaconas', '0609', '06'),
('061001', 'Pedro Gálvez', '0610', '06'),
('061002', 'Chancay', '0610', '06'),
('061003', 'Eduardo Villanueva', '0610', '06'),
('061004', 'Gregorio Pita', '0610', '06'),
('061005', 'Ichocan', '0610', '06'),
('061006', 'José Manuel Quiroz', '0610', '06'),
('061007', 'José Sabogal', '0610', '06'),
('061101', 'San Miguel', '0611', '06'),
('061102', 'Bolívar', '0611', '06'),
('061103', 'Calquis', '0611', '06'),
('061104', 'Catilluc', '0611', '06'),
('061105', 'El Prado', '0611', '06'),
('061106', 'La Florida', '0611', '06'),
('061107', 'Llapa', '0611', '06'),
('061108', 'Nanchoc', '0611', '06'),
('061109', 'Niepos', '0611', '06'),
('061110', 'San Gregorio', '0611', '06'),
('061111', 'San Silvestre de Cochan', '0611', '06'),
('061112', 'Tongod', '0611', '06'),
('061113', 'Unión Agua Blanca', '0611', '06'),
('061201', 'San Pablo', '0612', '06'),
('061202', 'San Bernardino', '0612', '06'),
('061203', 'San Luis', '0612', '06'),
('061204', 'Tumbaden', '0612', '06'),
('061301', 'Santa Cruz', '0613', '06'),
('061302', 'Andabamba', '0613', '06'),
('061303', 'Catache', '0613', '06'),
('061304', 'Chancaybaños', '0613', '06'),
('061305', 'La Esperanza', '0613', '06'),
('061306', 'Ninabamba', '0613', '06'),
('061307', 'Pulan', '0613', '06'),
('061308', 'Saucepampa', '0613', '06'),
('061309', 'Sexi', '0613', '06'),
('061310', 'Uticyacu', '0613', '06'),
('061311', 'Yauyucan', '0613', '06'),
('070101', 'Callao', '0701', '07'),
('070102', 'Bellavista', '0701', '07'),
('070103', 'Carmen de la Legua Reynoso', '0701', '07'),
('070104', 'La Perla', '0701', '07'),
('070105', 'La Punta', '0701', '07'),
('070106', 'Ventanilla', '0701', '07'),
('070107', 'Mi Perú', '0701', '07'),
('080101', 'Cusco', '0801', '08'),
('080102', 'Ccorca', '0801', '08'),
('080103', 'Poroy', '0801', '08'),
('080104', 'San Jerónimo', '0801', '08'),
('080105', 'San Sebastian', '0801', '08'),
('080106', 'Santiago', '0801', '08'),
('080107', 'Saylla', '0801', '08'),
('080108', 'Wanchaq', '0801', '08'),
('080201', 'Acomayo', '0802', '08'),
('080202', 'Acopia', '0802', '08'),
('080203', 'Acos', '0802', '08'),
('080204', 'Mosoc Llacta', '0802', '08'),
('080205', 'Pomacanchi', '0802', '08'),
('080206', 'Rondocan', '0802', '08'),
('080207', 'Sangarara', '0802', '08'),
('080301', 'Anta', '0803', '08'),
('080302', 'Ancahuasi', '0803', '08'),
('080303', 'Cachimayo', '0803', '08'),
('080304', 'Chinchaypujio', '0803', '08'),
('080305', 'Huarocondo', '0803', '08'),
('080306', 'Limatambo', '0803', '08'),
('080307', 'Mollepata', '0803', '08'),
('080308', 'Pucyura', '0803', '08'),
('080309', 'Zurite', '0803', '08'),
('080401', 'Calca', '0804', '08'),
('080402', 'Coya', '0804', '08'),
('080403', 'Lamay', '0804', '08'),
('080404', 'Lares', '0804', '08'),
('080405', 'Pisac', '0804', '08'),
('080406', 'San Salvador', '0804', '08'),
('080407', 'Taray', '0804', '08'),
('080408', 'Yanatile', '0804', '08'),
('080501', 'Yanaoca', '0805', '08'),
('080502', 'Checca', '0805', '08'),
('080503', 'Kunturkanki', '0805', '08'),
('080504', 'Langui', '0805', '08'),
('080505', 'Layo', '0805', '08'),
('080506', 'Pampamarca', '0805', '08'),
('080507', 'Quehue', '0805', '08'),
('080508', 'Tupac Amaru', '0805', '08'),
('080601', 'Sicuani', '0806', '08'),
('080602', 'Checacupe', '0806', '08'),
('080603', 'Combapata', '0806', '08'),
('080604', 'Marangani', '0806', '08'),
('080605', 'Pitumarca', '0806', '08'),
('080606', 'San Pablo', '0806', '08'),
('080607', 'San Pedro', '0806', '08'),
('080608', 'Tinta', '0806', '08'),
('080701', 'Santo Tomas', '0807', '08'),
('080702', 'Capacmarca', '0807', '08'),
('080703', 'Chamaca', '0807', '08'),
('080704', 'Colquemarca', '0807', '08'),
('080705', 'Livitaca', '0807', '08'),
('080706', 'Llusco', '0807', '08'),
('080707', 'Quiñota', '0807', '08'),
('080708', 'Velille', '0807', '08'),
('080801', 'Espinar', '0808', '08'),
('080802', 'Condoroma', '0808', '08'),
('080803', 'Coporaque', '0808', '08'),
('080804', 'Ocoruro', '0808', '08'),
('080805', 'Pallpata', '0808', '08'),
('080806', 'Pichigua', '0808', '08'),
('080807', 'Suyckutambo', '0808', '08'),
('080808', 'Alto Pichigua', '0808', '08'),
('080901', 'Santa Ana', '0809', '08'),
('080902', 'Echarate', '0809', '08'),
('080903', 'Huayopata', '0809', '08'),
('080904', 'Maranura', '0809', '08'),
('080905', 'Ocobamba', '0809', '08'),
('080906', 'Quellouno', '0809', '08'),
('080907', 'Kimbiri', '0809', '08'),
('080908', 'Santa Teresa', '0809', '08'),
('080909', 'Vilcabamba', '0809', '08'),
('080910', 'Pichari', '0809', '08'),
('080911', 'Inkawasi', '0809', '08'),
('080912', 'Villa Virgen', '0809', '08'),
('080913', 'Villa Kintiarina', '0809', '08'),
('080914', 'Megantoni', '0809', '08'),
('081001', 'Paruro', '0810', '08'),
('081002', 'Accha', '0810', '08'),
('081003', 'Ccapi', '0810', '08'),
('081004', 'Colcha', '0810', '08'),
('081005', 'Huanoquite', '0810', '08'),
('081006', 'Omachaç', '0810', '08'),
('081007', 'Paccaritambo', '0810', '08'),
('081008', 'Pillpinto', '0810', '08'),
('081009', 'Yaurisque', '0810', '08'),
('081101', 'Paucartambo', '0811', '08'),
('081102', 'Caicay', '0811', '08'),
('081103', 'Challabamba', '0811', '08'),
('081104', 'Colquepata', '0811', '08'),
('081105', 'Huancarani', '0811', '08'),
('081106', 'Kosñipata', '0811', '08'),
('081201', 'Urcos', '0812', '08'),
('081202', 'Andahuaylillas', '0812', '08'),
('081203', 'Camanti', '0812', '08'),
('081204', 'Ccarhuayo', '0812', '08'),
('081205', 'Ccatca', '0812', '08'),
('081206', 'Cusipata', '0812', '08'),
('081207', 'Huaro', '0812', '08'),
('081208', 'Lucre', '0812', '08'),
('081209', 'Marcapata', '0812', '08'),
('081210', 'Ocongate', '0812', '08'),
('081211', 'Oropesa', '0812', '08'),
('081212', 'Quiquijana', '0812', '08'),
('081301', 'Urubamba', '0813', '08'),
('081302', 'Chinchero', '0813', '08'),
('081303', 'Huayllabamba', '0813', '08'),
('081304', 'Machupicchu', '0813', '08'),
('081305', 'Maras', '0813', '08'),
('081306', 'Ollantaytambo', '0813', '08'),
('081307', 'Yucay', '0813', '08'),
('090101', 'Huancavelica', '0901', '09'),
('090102', 'Acobambilla', '0901', '09'),
('090103', 'Acoria', '0901', '09'),
('090104', 'Conayca', '0901', '09'),
('090105', 'Cuenca', '0901', '09'),
('090106', 'Huachocolpa', '0901', '09'),
('090107', 'Huayllahuara', '0901', '09'),
('090108', 'Izcuchaca', '0901', '09'),
('090109', 'Laria', '0901', '09'),
('090110', 'Manta', '0901', '09'),
('090111', 'Mariscal Cáceres', '0901', '09'),
('090112', 'Moya', '0901', '09'),
('090113', 'Nuevo Occoro', '0901', '09'),
('090114', 'Palca', '0901', '09'),
('090115', 'Pilchaca', '0901', '09'),
('090116', 'Vilca', '0901', '09'),
('090117', 'Yauli', '0901', '09'),
('090118', 'Ascensión', '0901', '09'),
('090119', 'Huando', '0901', '09'),
('090201', 'Acobamba', '0902', '09'),
('090202', 'Andabamba', '0902', '09'),
('090203', 'Anta', '0902', '09'),
('090204', 'Caja', '0902', '09'),
('090205', 'Marcas', '0902', '09'),
('090206', 'Paucara', '0902', '09'),
('090207', 'Pomacocha', '0902', '09'),
('090208', 'Rosario', '0902', '09'),
('090301', 'Lircay', '0903', '09'),
('090302', 'Anchonga', '0903', '09'),
('090303', 'Callanmarca', '0903', '09'),
('090304', 'Ccochaccasa', '0903', '09'),
('090305', 'Chincho', '0903', '09'),
('090306', 'Congalla', '0903', '09'),
('090307', 'Huanca-Huanca', '0903', '09'),
('090308', 'Huayllay Grande', '0903', '09'),
('090309', 'Julcamarca', '0903', '09'),
('090310', 'San Antonio de Antaparco', '0903', '09'),
('090311', 'Santo Tomas de Pata', '0903', '09'),
('090312', 'Secclla', '0903', '09'),
('090401', 'Castrovirreyna', '0904', '09'),
('090402', 'Arma', '0904', '09'),
('090403', 'Aurahua', '0904', '09'),
('090404', 'Capillas', '0904', '09'),
('090405', 'Chupamarca', '0904', '09'),
('090406', 'Cocas', '0904', '09'),
('090407', 'Huachos', '0904', '09'),
('090408', 'Huamatambo', '0904', '09'),
('090409', 'Mollepampa', '0904', '09'),
('090410', 'San Juan', '0904', '09'),
('090411', 'Santa Ana', '0904', '09'),
('090412', 'Tantara', '0904', '09'),
('090413', 'Ticrapo', '0904', '09'),
('090501', 'Churcampa', '0905', '09'),
('090502', 'Anco', '0905', '09'),
('090503', 'Chinchihuasi', '0905', '09'),
('090504', 'El Carmen', '0905', '09'),
('090505', 'La Merced', '0905', '09'),
('090506', 'Locroja', '0905', '09'),
('090507', 'Paucarbamba', '0905', '09'),
('090508', 'San Miguel de Mayocc', '0905', '09'),
('090509', 'San Pedro de Coris', '0905', '09'),
('090510', 'Pachamarca', '0905', '09'),
('090511', 'Cosme', '0905', '09'),
('090601', 'Huaytara', '0906', '09'),
('090602', 'Ayavi', '0906', '09'),
('090603', 'Córdova', '0906', '09'),
('090604', 'Huayacundo Arma', '0906', '09'),
('090605', 'Laramarca', '0906', '09'),
('090606', 'Ocoyo', '0906', '09'),
('090607', 'Pilpichaca', '0906', '09'),
('090608', 'Querco', '0906', '09'),
('090609', 'Quito-Arma', '0906', '09'),
('090610', 'San Antonio de Cusicancha', '0906', '09'),
('090611', 'San Francisco de Sangayaico', '0906', '09'),
('090612', 'San Isidro', '0906', '09'),
('090613', 'Santiago de Chocorvos', '0906', '09'),
('090614', 'Santiago de Quirahuara', '0906', '09'),
('090615', 'Santo Domingo de Capillas', '0906', '09'),
('090616', 'Tambo', '0906', '09'),
('090701', 'Pampas', '0907', '09'),
('090702', 'Acostambo', '0907', '09'),
('090703', 'Acraquia', '0907', '09'),
('090704', 'Ahuaycha', '0907', '09'),
('090705', 'Colcabamba', '0907', '09'),
('090706', 'Daniel Hernández', '0907', '09'),
('090707', 'Huachocolpa', '0907', '09'),
('090709', 'Huaribamba', '0907', '09'),
('090710', 'Ñahuimpuquio', '0907', '09'),
('090711', 'Pazos', '0907', '09'),
('090713', 'Quishuar', '0907', '09'),
('090714', 'Salcabamba', '0907', '09'),
('090715', 'Salcahuasi', '0907', '09'),
('090716', 'San Marcos de Rocchac', '0907', '09'),
('090717', 'Surcubamba', '0907', '09'),
('090718', 'Tintay Puncu', '0907', '09'),
('090719', 'Quichuas', '0907', '09'),
('090720', 'Andaymarca', '0907', '09'),
('090721', 'Roble', '0907', '09'),
('090722', 'Pichos', '0907', '09'),
('090723', 'Santiago de Tucuma', '0907', '09'),
('100101', 'Huanuco', '1001', '10'),
('100102', 'Amarilis', '1001', '10'),
('100103', 'Chinchao', '1001', '10'),
('100104', 'Churubamba', '1001', '10'),
('100105', 'Margos', '1001', '10'),
('100106', 'Quisqui (Kichki)', '1001', '10'),
('100107', 'San Francisco de Cayran', '1001', '10'),
('100108', 'San Pedro de Chaulan', '1001', '10'),
('100109', 'Santa María del Valle', '1001', '10'),
('100110', 'Yarumayo', '1001', '10'),
('100111', 'Pillco Marca', '1001', '10'),
('100112', 'Yacus', '1001', '10'),
('100113', 'San Pablo de Pillao', '1001', '10'),
('100201', 'Ambo', '1002', '10'),
('100202', 'Cayna', '1002', '10'),
('100203', 'Colpas', '1002', '10'),
('100204', 'Conchamarca', '1002', '10'),
('100205', 'Huacar', '1002', '10'),
('100206', 'San Francisco', '1002', '10'),
('100207', 'San Rafael', '1002', '10'),
('100208', 'Tomay Kichwa', '1002', '10'),
('100301', 'La Unión', '1003', '10'),
('100307', 'Chuquis', '1003', '10'),
('100311', 'Marías', '1003', '10'),
('100313', 'Pachas', '1003', '10'),
('100316', 'Quivilla', '1003', '10'),
('100317', 'Ripan', '1003', '10'),
('100321', 'Shunqui', '1003', '10'),
('100322', 'Sillapata', '1003', '10'),
('100323', 'Yanas', '1003', '10'),
('100401', 'Huacaybamba', '1004', '10'),
('100402', 'Canchabamba', '1004', '10'),
('100403', 'Cochabamba', '1004', '10'),
('100404', 'Pinra', '1004', '10'),
('100501', 'Llata', '1005', '10'),
('100502', 'Arancay', '1005', '10'),
('100503', 'Chavín de Pariarca', '1005', '10'),
('100504', 'Jacas Grande', '1005', '10'),
('100505', 'Jircan', '1005', '10'),
('100506', 'Miraflores', '1005', '10'),
('100507', 'Monzón', '1005', '10'),
('100508', 'Punchao', '1005', '10'),
('100509', 'Puños', '1005', '10'),
('100510', 'Singa', '1005', '10'),
('100511', 'Tantamayo', '1005', '10'),
('100601', 'Rupa-Rupa', '1006', '10'),
('100602', 'Daniel Alomía Robles', '1006', '10'),
('100603', 'Hermílio Valdizan', '1006', '10'),
('100604', 'José Crespo y Castillo', '1006', '10'),
('100605', 'Luyando', '1006', '10'),
('100606', 'Mariano Damaso Beraun', '1006', '10'),
('100607', 'Pucayacu', '1006', '10'),
('100608', 'Castillo Grande', '1006', '10'),
('100609', 'Pueblo Nuevo', '1006', '10'),
('100610', 'Santo Domingo de Anda', '1006', '10'),
('100701', 'Huacrachuco', '1007', '10'),
('100702', 'Cholon', '1007', '10'),
('100703', 'San Buenaventura', '1007', '10'),
('100704', 'La Morada', '1007', '10'),
('100705', 'Santa Rosa de Alto Yanajanca', '1007', '10'),
('100801', 'Panao', '1008', '10'),
('100802', 'Chaglla', '1008', '10'),
('100803', 'Molino', '1008', '10'),
('100804', 'Umari', '1008', '10'),
('100901', 'Puerto Inca', '1009', '10'),
('100902', 'Codo del Pozuzo', '1009', '10'),
('100903', 'Honoria', '1009', '10'),
('100904', 'Tournavista', '1009', '10'),
('100905', 'Yuyapichis', '1009', '10'),
('101001', 'Jesús', '1010', '10'),
('101002', 'Baños', '1010', '10'),
('101003', 'Jivia', '1010', '10'),
('101004', 'Queropalca', '1010', '10'),
('101005', 'Rondos', '1010', '10'),
('101006', 'San Francisco de Asís', '1010', '10'),
('101007', 'San Miguel de Cauri', '1010', '10'),
('101101', 'Chavinillo', '1011', '10'),
('101102', 'Cahuac', '1011', '10'),
('101103', 'Chacabamba', '1011', '10'),
('101104', 'Aparicio Pomares', '1011', '10'),
('101105', 'Jacas Chico', '1011', '10'),
('101106', 'Obas', '1011', '10'),
('101107', 'Pampamarca', '1011', '10'),
('101108', 'Choras', '1011', '10'),
('110101', 'Ica', '1101', '11'),
('110102', 'La Tinguiña', '1101', '11'),
('110103', 'Los Aquijes', '1101', '11'),
('110104', 'Ocucaje', '1101', '11'),
('110105', 'Pachacutec', '1101', '11'),
('110106', 'Parcona', '1101', '11'),
('110107', 'Pueblo Nuevo', '1101', '11'),
('110108', 'Salas', '1101', '11'),
('110109', 'San José de Los Molinos', '1101', '11'),
('110110', 'San Juan Bautista', '1101', '11'),
('110111', 'Santiago', '1101', '11'),
('110112', 'Subtanjalla', '1101', '11'),
('110113', 'Tate', '1101', '11'),
('110114', 'Yauca del Rosario', '1101', '11'),
('110201', 'Chincha Alta', '1102', '11'),
('110202', 'Alto Laran', '1102', '11'),
('110203', 'Chavin', '1102', '11'),
('110204', 'Chincha Baja', '1102', '11'),
('110205', 'El Carmen', '1102', '11'),
('110206', 'Grocio Prado', '1102', '11'),
('110207', 'Pueblo Nuevo', '1102', '11'),
('110208', 'San Juan de Yanac', '1102', '11'),
('110209', 'San Pedro de Huacarpana', '1102', '11'),
('110210', 'Sunampe', '1102', '11'),
('110211', 'Tambo de Mora', '1102', '11'),
('110301', 'Nasca', '1103', '11'),
('110302', 'Changuillo', '1103', '11'),
('110303', 'El Ingenio', '1103', '11'),
('110304', 'Marcona', '1103', '11'),
('110305', 'Vista Alegre', '1103', '11'),
('110401', 'Palpa', '1104', '11'),
('110402', 'Llipata', '1104', '11'),
('110403', 'Río Grande', '1104', '11'),
('110404', 'Santa Cruz', '1104', '11'),
('110405', 'Tibillo', '1104', '11'),
('110501', 'Pisco', '1105', '11'),
('110502', 'Huancano', '1105', '11'),
('110503', 'Humay', '1105', '11'),
('110504', 'Independencia', '1105', '11'),
('110505', 'Paracas', '1105', '11'),
('110506', 'San Andrés', '1105', '11'),
('110507', 'San Clemente', '1105', '11'),
('110508', 'Tupac Amaru Inca', '1105', '11'),
('120101', 'Huancayo', '1201', '12'),
('120104', 'Carhuacallanga', '1201', '12'),
('120105', 'Chacapampa', '1201', '12'),
('120106', 'Chicche', '1201', '12'),
('120107', 'Chilca', '1201', '12'),
('120108', 'Chongos Alto', '1201', '12'),
('120111', 'Chupuro', '1201', '12'),
('120112', 'Colca', '1201', '12'),
('120113', 'Cullhuas', '1201', '12'),
('120114', 'El Tambo', '1201', '12'),
('120116', 'Huacrapuquio', '1201', '12'),
('120117', 'Hualhuas', '1201', '12'),
('120119', 'Huancan', '1201', '12'),
('120120', 'Huasicancha', '1201', '12'),
('120121', 'Huayucachi', '1201', '12'),
('120122', 'Ingenio', '1201', '12'),
('120124', 'Pariahuanca', '1201', '12'),
('120125', 'Pilcomayo', '1201', '12'),
('120126', 'Pucara', '1201', '12'),
('120127', 'Quichuay', '1201', '12'),
('120128', 'Quilcas', '1201', '12'),
('120129', 'San Agustín', '1201', '12'),
('120130', 'San Jerónimo de Tunan', '1201', '12'),
('120132', 'Saño', '1201', '12'),
('120133', 'Sapallanga', '1201', '12'),
('120134', 'Sicaya', '1201', '12'),
('120135', 'Santo Domingo de Acobamba', '1201', '12'),
('120136', 'Viques', '1201', '12'),
('120201', 'Concepción', '1202', '12'),
('120202', 'Aco', '1202', '12'),
('120203', 'Andamarca', '1202', '12'),
('120204', 'Chambara', '1202', '12'),
('120205', 'Cochas', '1202', '12'),
('120206', 'Comas', '1202', '12'),
('120207', 'Heroínas Toledo', '1202', '12'),
('120208', 'Manzanares', '1202', '12'),
('120209', 'Mariscal Castilla', '1202', '12'),
('120210', 'Matahuasi', '1202', '12'),
('120211', 'Mito', '1202', '12'),
('120212', 'Nueve de Julio', '1202', '12'),
('120213', 'Orcotuna', '1202', '12'),
('120214', 'San José de Quero', '1202', '12'),
('120215', 'Santa Rosa de Ocopa', '1202', '12'),
('120301', 'Chanchamayo', '1203', '12'),
('120302', 'Perene', '1203', '12'),
('120303', 'Pichanaqui', '1203', '12'),
('120304', 'San Luis de Shuaro', '1203', '12'),
('120305', 'San Ramón', '1203', '12'),
('120306', 'Vitoc', '1203', '12'),
('120401', 'Jauja', '1204', '12'),
('120402', 'Acolla', '1204', '12'),
('120403', 'Apata', '1204', '12'),
('120404', 'Ataura', '1204', '12'),
('120405', 'Canchayllo', '1204', '12'),
('120406', 'Curicaca', '1204', '12'),
('120407', 'El Mantaro', '1204', '12'),
('120408', 'Huamali', '1204', '12'),
('120409', 'Huaripampa', '1204', '12'),
('120410', 'Huertas', '1204', '12'),
('120411', 'Janjaillo', '1204', '12'),
('120412', 'Julcán', '1204', '12'),
('120413', 'Leonor Ordóñez', '1204', '12'),
('120414', 'Llocllapampa', '1204', '12'),
('120415', 'Marco', '1204', '12'),
('120416', 'Masma', '1204', '12'),
('120417', 'Masma Chicche', '1204', '12'),
('120418', 'Molinos', '1204', '12'),
('120419', 'Monobamba', '1204', '12'),
('120420', 'Muqui', '1204', '12'),
('120421', 'Muquiyauyo', '1204', '12'),
('120422', 'Paca', '1204', '12'),
('120423', 'Paccha', '1204', '12'),
('120424', 'Pancan', '1204', '12'),
('120425', 'Parco', '1204', '12'),
('120426', 'Pomacancha', '1204', '12'),
('120427', 'Ricran', '1204', '12'),
('120428', 'San Lorenzo', '1204', '12'),
('120429', 'San Pedro de Chunan', '1204', '12'),
('120430', 'Sausa', '1204', '12'),
('120431', 'Sincos', '1204', '12'),
('120432', 'Tunan Marca', '1204', '12'),
('120433', 'Yauli', '1204', '12'),
('120434', 'Yauyos', '1204', '12'),
('120501', 'Junin', '1205', '12'),
('120502', 'Carhuamayo', '1205', '12'),
('120503', 'Ondores', '1205', '12'),
('120504', 'Ulcumayo', '1205', '12'),
('120601', 'Satipo', '1206', '12'),
('120602', 'Coviriali', '1206', '12'),
('120603', 'Llaylla', '1206', '12'),
('120604', 'Mazamari', '1206', '12'),
('120605', 'Pampa Hermosa', '1206', '12'),
('120606', 'Pangoa', '1206', '12'),
('120607', 'Río Negro', '1206', '12'),
('120608', 'Río Tambo', '1206', '12'),
('120609', 'Vizcatan del Ene', '1206', '12'),
('120701', 'Tarma', '1207', '12'),
('120702', 'Acobamba', '1207', '12'),
('120703', 'Huaricolca', '1207', '12'),
('120704', 'Huasahuasi', '1207', '12'),
('120705', 'La Unión', '1207', '12'),
('120706', 'Palca', '1207', '12'),
('120707', 'Palcamayo', '1207', '12'),
('120708', 'San Pedro de Cajas', '1207', '12'),
('120709', 'Tapo', '1207', '12'),
('120801', 'La Oroya', '1208', '12'),
('120802', 'Chacapalpa', '1208', '12'),
('120803', 'Huay-Huay', '1208', '12'),
('120804', 'Marcapomacocha', '1208', '12'),
('120805', 'Morococha', '1208', '12'),
('120806', 'Paccha', '1208', '12'),
('120807', 'Santa Bárbara de Carhuacayan', '1208', '12'),
('120808', 'Santa Rosa de Sacco', '1208', '12'),
('120809', 'Suitucancha', '1208', '12'),
('120810', 'Yauli', '1208', '12'),
('120901', 'Chupaca', '1209', '12'),
('120902', 'Ahuac', '1209', '12'),
('120903', 'Chongos Bajo', '1209', '12'),
('120904', 'Huachac', '1209', '12'),
('120905', 'Huamancaca Chico', '1209', '12'),
('120906', 'San Juan de Iscos', '1209', '12'),
('120907', 'San Juan de Jarpa', '1209', '12'),
('120908', 'Tres de Diciembre', '1209', '12'),
('120909', 'Yanacancha', '1209', '12'),
('130101', 'Trujillo', '1301', '13'),
('130102', 'El Porvenir', '1301', '13'),
('130103', 'Florencia de Mora', '1301', '13'),
('130104', 'Huanchaco', '1301', '13'),
('130105', 'La Esperanza', '1301', '13'),
('130106', 'Laredo', '1301', '13'),
('130107', 'Moche', '1301', '13'),
('130108', 'Poroto', '1301', '13'),
('130109', 'Salaverry', '1301', '13'),
('130110', 'Simbal', '1301', '13'),
('130111', 'Victor Larco Herrera', '1301', '13'),
('130201', 'Ascope', '1302', '13'),
('130202', 'Chicama', '1302', '13'),
('130203', 'Chocope', '1302', '13'),
('130204', 'Magdalena de Cao', '1302', '13'),
('130205', 'Paijan', '1302', '13'),
('130206', 'Rázuri', '1302', '13'),
('130207', 'Santiago de Cao', '1302', '13'),
('130208', 'Casa Grande', '1302', '13'),
('130301', 'Bolívar', '1303', '13'),
('130302', 'Bambamarca', '1303', '13'),
('130303', 'Condormarca', '1303', '13'),
('130304', 'Longotea', '1303', '13'),
('130305', 'Uchumarca', '1303', '13'),
('130306', 'Ucuncha', '1303', '13'),
('130401', 'Chepen', '1304', '13'),
('130402', 'Pacanga', '1304', '13'),
('130403', 'Pueblo Nuevo', '1304', '13'),
('130501', 'Julcan', '1305', '13'),
('130502', 'Calamarca', '1305', '13'),
('130503', 'Carabamba', '1305', '13'),
('130504', 'Huaso', '1305', '13'),
('130601', 'Otuzco', '1306', '13'),
('130602', 'Agallpampa', '1306', '13'),
('130604', 'Charat', '1306', '13'),
('130605', 'Huaranchal', '1306', '13'),
('130606', 'La Cuesta', '1306', '13'),
('130608', 'Mache', '1306', '13'),
('130610', 'Paranday', '1306', '13'),
('130611', 'Salpo', '1306', '13'),
('130613', 'Sinsicap', '1306', '13'),
('130614', 'Usquil', '1306', '13'),
('130701', 'San Pedro de Lloc', '1307', '13'),
('130702', 'Guadalupe', '1307', '13'),
('130703', 'Jequetepeque', '1307', '13'),
('130704', 'Pacasmayo', '1307', '13'),
('130705', 'San José', '1307', '13'),
('130801', 'Tayabamba', '1308', '13'),
('130802', 'Buldibuyo', '1308', '13'),
('130803', 'Chillia', '1308', '13'),
('130804', 'Huancaspata', '1308', '13'),
('130805', 'Huaylillas', '1308', '13'),
('130806', 'Huayo', '1308', '13'),
('130807', 'Ongon', '1308', '13'),
('130808', 'Parcoy', '1308', '13'),
('130809', 'Pataz', '1308', '13'),
('130810', 'Pias', '1308', '13'),
('130811', 'Santiago de Challas', '1308', '13'),
('130812', 'Taurija', '1308', '13'),
('130813', 'Urpay', '1308', '13'),
('130901', 'Huamachuco', '1309', '13'),
('130902', 'Chugay', '1309', '13'),
('130903', 'Cochorco', '1309', '13'),
('130904', 'Curgos', '1309', '13'),
('130905', 'Marcabal', '1309', '13'),
('130906', 'Sanagoran', '1309', '13'),
('130907', 'Sarin', '1309', '13'),
('130908', 'Sartimbamba', '1309', '13'),
('131001', 'Santiago de Chuco', '1310', '13'),
('131002', 'Angasmarca', '1310', '13'),
('131003', 'Cachicadan', '1310', '13'),
('131004', 'Mollebamba', '1310', '13'),
('131005', 'Mollepata', '1310', '13'),
('131006', 'Quiruvilca', '1310', '13'),
('131007', 'Santa Cruz de Chuca', '1310', '13'),
('131008', 'Sitabamba', '1310', '13'),
('131101', 'Cascas', '1311', '13'),
('131102', 'Lucma', '1311', '13'),
('131103', 'Marmot', '1311', '13'),
('131104', 'Sayapullo', '1311', '13'),
('131201', 'Viru', '1312', '13'),
('131202', 'Chao', '1312', '13'),
('131203', 'Guadalupito', '1312', '13'),
('140101', 'Chiclayo', '1401', '14'),
('140102', 'Chongoyape', '1401', '14'),
('140103', 'Eten', '1401', '14'),
('140104', 'Eten Puerto', '1401', '14'),
('140105', 'José Leonardo Ortiz', '1401', '14'),
('140106', 'La Victoria', '1401', '14'),
('140107', 'Lagunas', '1401', '14'),
('140108', 'Monsefu', '1401', '14'),
('140109', 'Nueva Arica', '1401', '14'),
('140110', 'Oyotun', '1401', '14'),
('140111', 'Picsi', '1401', '14'),
('140112', 'Pimentel', '1401', '14'),
('140113', 'Reque', '1401', '14'),
('140114', 'Santa Rosa', '1401', '14'),
('140115', 'Saña', '1401', '14'),
('140116', 'Cayalti', '1401', '14'),
('140117', 'Patapo', '1401', '14'),
('140118', 'Pomalca', '1401', '14'),
('140119', 'Pucala', '1401', '14'),
('140120', 'Tuman', '1401', '14'),
('140201', 'Ferreñafe', '1402', '14'),
('140202', 'Cañaris', '1402', '14'),
('140203', 'Incahuasi', '1402', '14'),
('140204', 'Manuel Antonio Mesones Muro', '1402', '14'),
('140205', 'Pitipo', '1402', '14'),
('140206', 'Pueblo Nuevo', '1402', '14'),
('140301', 'Lambayeque', '1403', '14'),
('140302', 'Chochope', '1403', '14'),
('140303', 'Illimo', '1403', '14'),
('140304', 'Jayanca', '1403', '14'),
('140305', 'Mochumi', '1403', '14'),
('140306', 'Morrope', '1403', '14'),
('140307', 'Motupe', '1403', '14'),
('140308', 'Olmos', '1403', '14'),
('140309', 'Pacora', '1403', '14'),
('140310', 'Salas', '1403', '14'),
('140311', 'San José', '1403', '14'),
('140312', 'Tucume', '1403', '14'),
('150101', 'Lima', '1501', '15'),
('150102', 'Ancón', '1501', '15'),
('150103', 'Ate', '1501', '15'),
('150104', 'Barranco', '1501', '15'),
('150105', 'Breña', '1501', '15'),
('150106', 'Carabayllo', '1501', '15'),
('150107', 'Chaclacayo', '1501', '15'),
('150108', 'Chorrillos', '1501', '15'),
('150109', 'Cieneguilla', '1501', '15'),
('150110', 'Comas', '1501', '15'),
('150111', 'El Agustino', '1501', '15'),
('150112', 'Independencia', '1501', '15'),
('150113', 'Jesús María', '1501', '15'),
('150114', 'La Molina', '1501', '15'),
('150115', 'La Victoria', '1501', '15'),
('150116', 'Lince', '1501', '15'),
('150117', 'Los Olivos', '1501', '15'),
('150118', 'Lurigancho', '1501', '15'),
('150119', 'Lurin', '1501', '15'),
('150120', 'Magdalena del Mar', '1501', '15'),
('150121', 'Pueblo Libre', '1501', '15'),
('150122', 'Miraflores', '1501', '15'),
('150123', 'Pachacamac', '1501', '15'),
('150124', 'Pucusana', '1501', '15'),
('150125', 'Puente Piedra', '1501', '15'),
('150126', 'Punta Hermosa', '1501', '15'),
('150127', 'Punta Negra', '1501', '15'),
('150128', 'Rímac', '1501', '15'),
('150129', 'San Bartolo', '1501', '15'),
('150130', 'San Borja', '1501', '15'),
('150131', 'San Isidro', '1501', '15'),
('150132', 'San Juan de Lurigancho', '1501', '15'),
('150133', 'San Juan de Miraflores', '1501', '15'),
('150134', 'San Luis', '1501', '15'),
('150135', 'San Martín de Porres', '1501', '15'),
('150136', 'San Miguel', '1501', '15'),
('150137', 'Santa Anita', '1501', '15'),
('150138', 'Santa María del Mar', '1501', '15'),
('150139', 'Santa Rosa', '1501', '15'),
('150140', 'Santiago de Surco', '1501', '15'),
('150141', 'Surquillo', '1501', '15'),
('150142', 'Villa El Salvador', '1501', '15'),
('150143', 'Villa María del Triunfo', '1501', '15'),
('150201', 'Barranca', '1502', '15'),
('150202', 'Paramonga', '1502', '15'),
('150203', 'Pativilca', '1502', '15'),
('150204', 'Supe', '1502', '15'),
('150205', 'Supe Puerto', '1502', '15'),
('150301', 'Cajatambo', '1503', '15'),
('150302', 'Copa', '1503', '15'),
('150303', 'Gorgor', '1503', '15'),
('150304', 'Huancapon', '1503', '15'),
('150305', 'Manas', '1503', '15'),
('150401', 'Canta', '1504', '15'),
('150402', 'Arahuay', '1504', '15'),
('150403', 'Huamantanga', '1504', '15'),
('150404', 'Huaros', '1504', '15'),
('150405', 'Lachaqui', '1504', '15'),
('150406', 'San Buenaventura', '1504', '15'),
('150407', 'Santa Rosa de Quives', '1504', '15');
INSERT INTO `ubigeo_peru_districts` (`id`, `name`, `province_id`, `department_id`) VALUES
('150501', 'San Vicente de Cañete', '1505', '15'),
('150502', 'Asia', '1505', '15'),
('150503', 'Calango', '1505', '15'),
('150504', 'Cerro Azul', '1505', '15'),
('150505', 'Chilca', '1505', '15'),
('150506', 'Coayllo', '1505', '15'),
('150507', 'Imperial', '1505', '15'),
('150508', 'Lunahuana', '1505', '15'),
('150509', 'Mala', '1505', '15'),
('150510', 'Nuevo Imperial', '1505', '15'),
('150511', 'Pacaran', '1505', '15'),
('150512', 'Quilmana', '1505', '15'),
('150513', 'San Antonio', '1505', '15'),
('150514', 'San Luis', '1505', '15'),
('150515', 'Santa Cruz de Flores', '1505', '15'),
('150516', 'Zúñiga', '1505', '15'),
('150601', 'Huaral', '1506', '15'),
('150602', 'Atavillos Alto', '1506', '15'),
('150603', 'Atavillos Bajo', '1506', '15'),
('150604', 'Aucallama', '1506', '15'),
('150605', 'Chancay', '1506', '15'),
('150606', 'Ihuari', '1506', '15'),
('150607', 'Lampian', '1506', '15'),
('150608', 'Pacaraos', '1506', '15'),
('150609', 'San Miguel de Acos', '1506', '15'),
('150610', 'Santa Cruz de Andamarca', '1506', '15'),
('150611', 'Sumbilca', '1506', '15'),
('150612', 'Veintisiete de Noviembre', '1506', '15'),
('150701', 'Matucana', '1507', '15'),
('150702', 'Antioquia', '1507', '15'),
('150703', 'Callahuanca', '1507', '15'),
('150704', 'Carampoma', '1507', '15'),
('150705', 'Chicla', '1507', '15'),
('150706', 'Cuenca', '1507', '15'),
('150707', 'Huachupampa', '1507', '15'),
('150708', 'Huanza', '1507', '15'),
('150709', 'Huarochiri', '1507', '15'),
('150710', 'Lahuaytambo', '1507', '15'),
('150711', 'Langa', '1507', '15'),
('150712', 'Laraos', '1507', '15'),
('150713', 'Mariatana', '1507', '15'),
('150714', 'Ricardo Palma', '1507', '15'),
('150715', 'San Andrés de Tupicocha', '1507', '15'),
('150716', 'San Antonio', '1507', '15'),
('150717', 'San Bartolomé', '1507', '15'),
('150718', 'San Damian', '1507', '15'),
('150719', 'San Juan de Iris', '1507', '15'),
('150720', 'San Juan de Tantaranche', '1507', '15'),
('150721', 'San Lorenzo de Quinti', '1507', '15'),
('150722', 'San Mateo', '1507', '15'),
('150723', 'San Mateo de Otao', '1507', '15'),
('150724', 'San Pedro de Casta', '1507', '15'),
('150725', 'San Pedro de Huancayre', '1507', '15'),
('150726', 'Sangallaya', '1507', '15'),
('150727', 'Santa Cruz de Cocachacra', '1507', '15'),
('150728', 'Santa Eulalia', '1507', '15'),
('150729', 'Santiago de Anchucaya', '1507', '15'),
('150730', 'Santiago de Tuna', '1507', '15'),
('150731', 'Santo Domingo de Los Olleros', '1507', '15'),
('150732', 'Surco', '1507', '15'),
('150801', 'Huacho', '1508', '15'),
('150802', 'Ambar', '1508', '15'),
('150803', 'Caleta de Carquin', '1508', '15'),
('150804', 'Checras', '1508', '15'),
('150805', 'Hualmay', '1508', '15'),
('150806', 'Huaura', '1508', '15'),
('150807', 'Leoncio Prado', '1508', '15'),
('150808', 'Paccho', '1508', '15'),
('150809', 'Santa Leonor', '1508', '15'),
('150810', 'Santa María', '1508', '15'),
('150811', 'Sayan', '1508', '15'),
('150812', 'Vegueta', '1508', '15'),
('150901', 'Oyon', '1509', '15'),
('150902', 'Andajes', '1509', '15'),
('150903', 'Caujul', '1509', '15'),
('150904', 'Cochamarca', '1509', '15'),
('150905', 'Navan', '1509', '15'),
('150906', 'Pachangara', '1509', '15'),
('151001', 'Yauyos', '1510', '15'),
('151002', 'Alis', '1510', '15'),
('151003', 'Allauca', '1510', '15'),
('151004', 'Ayaviri', '1510', '15'),
('151005', 'Azángaro', '1510', '15'),
('151006', 'Cacra', '1510', '15'),
('151007', 'Carania', '1510', '15'),
('151008', 'Catahuasi', '1510', '15'),
('151009', 'Chocos', '1510', '15'),
('151010', 'Cochas', '1510', '15'),
('151011', 'Colonia', '1510', '15'),
('151012', 'Hongos', '1510', '15'),
('151013', 'Huampara', '1510', '15'),
('151014', 'Huancaya', '1510', '15'),
('151015', 'Huangascar', '1510', '15'),
('151016', 'Huantan', '1510', '15'),
('151017', 'Huañec', '1510', '15'),
('151018', 'Laraos', '1510', '15'),
('151019', 'Lincha', '1510', '15'),
('151020', 'Madean', '1510', '15'),
('151021', 'Miraflores', '1510', '15'),
('151022', 'Omas', '1510', '15'),
('151023', 'Putinza', '1510', '15'),
('151024', 'Quinches', '1510', '15'),
('151025', 'Quinocay', '1510', '15'),
('151026', 'San Joaquín', '1510', '15'),
('151027', 'San Pedro de Pilas', '1510', '15'),
('151028', 'Tanta', '1510', '15'),
('151029', 'Tauripampa', '1510', '15'),
('151030', 'Tomas', '1510', '15'),
('151031', 'Tupe', '1510', '15'),
('151032', 'Viñac', '1510', '15'),
('151033', 'Vitis', '1510', '15'),
('160101', 'Iquitos', '1601', '16'),
('160102', 'Alto Nanay', '1601', '16'),
('160103', 'Fernando Lores', '1601', '16'),
('160104', 'Indiana', '1601', '16'),
('160105', 'Las Amazonas', '1601', '16'),
('160106', 'Mazan', '1601', '16'),
('160107', 'Napo', '1601', '16'),
('160108', 'Punchana', '1601', '16'),
('160110', 'Torres Causana', '1601', '16'),
('160112', 'Belén', '1601', '16'),
('160113', 'San Juan Bautista', '1601', '16'),
('160201', 'Yurimaguas', '1602', '16'),
('160202', 'Balsapuerto', '1602', '16'),
('160205', 'Jeberos', '1602', '16'),
('160206', 'Lagunas', '1602', '16'),
('160210', 'Santa Cruz', '1602', '16'),
('160211', 'Teniente Cesar López Rojas', '1602', '16'),
('160301', 'Nauta', '1603', '16'),
('160302', 'Parinari', '1603', '16'),
('160303', 'Tigre', '1603', '16'),
('160304', 'Trompeteros', '1603', '16'),
('160305', 'Urarinas', '1603', '16'),
('160401', 'Ramón Castilla', '1604', '16'),
('160402', 'Pebas', '1604', '16'),
('160403', 'Yavari', '1604', '16'),
('160404', 'San Pablo', '1604', '16'),
('160501', 'Requena', '1605', '16'),
('160502', 'Alto Tapiche', '1605', '16'),
('160503', 'Capelo', '1605', '16'),
('160504', 'Emilio San Martín', '1605', '16'),
('160505', 'Maquia', '1605', '16'),
('160506', 'Puinahua', '1605', '16'),
('160507', 'Saquena', '1605', '16'),
('160508', 'Soplin', '1605', '16'),
('160509', 'Tapiche', '1605', '16'),
('160510', 'Jenaro Herrera', '1605', '16'),
('160511', 'Yaquerana', '1605', '16'),
('160601', 'Contamana', '1606', '16'),
('160602', 'Inahuaya', '1606', '16'),
('160603', 'Padre Márquez', '1606', '16'),
('160604', 'Pampa Hermosa', '1606', '16'),
('160605', 'Sarayacu', '1606', '16'),
('160606', 'Vargas Guerra', '1606', '16'),
('160701', 'Barranca', '1607', '16'),
('160702', 'Cahuapanas', '1607', '16'),
('160703', 'Manseriche', '1607', '16'),
('160704', 'Morona', '1607', '16'),
('160705', 'Pastaza', '1607', '16'),
('160706', 'Andoas', '1607', '16'),
('160801', 'Putumayo', '1608', '16'),
('160802', 'Rosa Panduro', '1608', '16'),
('160803', 'Teniente Manuel Clavero', '1608', '16'),
('160804', 'Yaguas', '1608', '16'),
('170101', 'Tambopata', '1701', '17'),
('170102', 'Inambari', '1701', '17'),
('170103', 'Las Piedras', '1701', '17'),
('170104', 'Laberinto', '1701', '17'),
('170201', 'Manu', '1702', '17'),
('170202', 'Fitzcarrald', '1702', '17'),
('170203', 'Madre de Dios', '1702', '17'),
('170204', 'Huepetuhe', '1702', '17'),
('170301', 'Iñapari', '1703', '17'),
('170302', 'Iberia', '1703', '17'),
('170303', 'Tahuamanu', '1703', '17'),
('180101', 'Moquegua', '1801', '18'),
('180102', 'Carumas', '1801', '18'),
('180103', 'Cuchumbaya', '1801', '18'),
('180104', 'Samegua', '1801', '18'),
('180105', 'San Cristóbal', '1801', '18'),
('180106', 'Torata', '1801', '18'),
('180201', 'Omate', '1802', '18'),
('180202', 'Chojata', '1802', '18'),
('180203', 'Coalaque', '1802', '18'),
('180204', 'Ichuña', '1802', '18'),
('180205', 'La Capilla', '1802', '18'),
('180206', 'Lloque', '1802', '18'),
('180207', 'Matalaque', '1802', '18'),
('180208', 'Puquina', '1802', '18'),
('180209', 'Quinistaquillas', '1802', '18'),
('180210', 'Ubinas', '1802', '18'),
('180211', 'Yunga', '1802', '18'),
('180301', 'Ilo', '1803', '18'),
('180302', 'El Algarrobal', '1803', '18'),
('180303', 'Pacocha', '1803', '18'),
('190101', 'Chaupimarca', '1901', '19'),
('190102', 'Huachon', '1901', '19'),
('190103', 'Huariaca', '1901', '19'),
('190104', 'Huayllay', '1901', '19'),
('190105', 'Ninacaca', '1901', '19'),
('190106', 'Pallanchacra', '1901', '19'),
('190107', 'Paucartambo', '1901', '19'),
('190108', 'San Francisco de Asís de Yarusyacan', '1901', '19'),
('190109', 'Simon Bolívar', '1901', '19'),
('190110', 'Ticlacayan', '1901', '19'),
('190111', 'Tinyahuarco', '1901', '19'),
('190112', 'Vicco', '1901', '19'),
('190113', 'Yanacancha', '1901', '19'),
('190201', 'Yanahuanca', '1902', '19'),
('190202', 'Chacayan', '1902', '19'),
('190203', 'Goyllarisquizga', '1902', '19'),
('190204', 'Paucar', '1902', '19'),
('190205', 'San Pedro de Pillao', '1902', '19'),
('190206', 'Santa Ana de Tusi', '1902', '19'),
('190207', 'Tapuc', '1902', '19'),
('190208', 'Vilcabamba', '1902', '19'),
('190301', 'Oxapampa', '1903', '19'),
('190302', 'Chontabamba', '1903', '19'),
('190303', 'Huancabamba', '1903', '19'),
('190304', 'Palcazu', '1903', '19'),
('190305', 'Pozuzo', '1903', '19'),
('190306', 'Puerto Bermúdez', '1903', '19'),
('190307', 'Villa Rica', '1903', '19'),
('190308', 'Constitución', '1903', '19'),
('200101', 'Piura', '2001', '20'),
('200104', 'Castilla', '2001', '20'),
('200105', 'Catacaos', '2001', '20'),
('200107', 'Cura Mori', '2001', '20'),
('200108', 'El Tallan', '2001', '20'),
('200109', 'La Arena', '2001', '20'),
('200110', 'La Unión', '2001', '20'),
('200111', 'Las Lomas', '2001', '20'),
('200114', 'Tambo Grande', '2001', '20'),
('200115', 'Veintiseis de Octubre', '2001', '20'),
('200201', 'Ayabaca', '2002', '20'),
('200202', 'Frias', '2002', '20'),
('200203', 'Jilili', '2002', '20'),
('200204', 'Lagunas', '2002', '20'),
('200205', 'Montero', '2002', '20'),
('200206', 'Pacaipampa', '2002', '20'),
('200207', 'Paimas', '2002', '20'),
('200208', 'Sapillica', '2002', '20'),
('200209', 'Sicchez', '2002', '20'),
('200210', 'Suyo', '2002', '20'),
('200301', 'Huancabamba', '2003', '20'),
('200302', 'Canchaque', '2003', '20'),
('200303', 'El Carmen de la Frontera', '2003', '20'),
('200304', 'Huarmaca', '2003', '20'),
('200305', 'Lalaquiz', '2003', '20'),
('200306', 'San Miguel de El Faique', '2003', '20'),
('200307', 'Sondor', '2003', '20'),
('200308', 'Sondorillo', '2003', '20'),
('200401', 'Chulucanas', '2004', '20'),
('200402', 'Buenos Aires', '2004', '20'),
('200403', 'Chalaco', '2004', '20'),
('200404', 'La Matanza', '2004', '20'),
('200405', 'Morropon', '2004', '20'),
('200406', 'Salitral', '2004', '20'),
('200407', 'San Juan de Bigote', '2004', '20'),
('200408', 'Santa Catalina de Mossa', '2004', '20'),
('200409', 'Santo Domingo', '2004', '20'),
('200410', 'Yamango', '2004', '20'),
('200501', 'Paita', '2005', '20'),
('200502', 'Amotape', '2005', '20'),
('200503', 'Arenal', '2005', '20'),
('200504', 'Colan', '2005', '20'),
('200505', 'La Huaca', '2005', '20'),
('200506', 'Tamarindo', '2005', '20'),
('200507', 'Vichayal', '2005', '20'),
('200601', 'Sullana', '2006', '20'),
('200602', 'Bellavista', '2006', '20'),
('200603', 'Ignacio Escudero', '2006', '20'),
('200604', 'Lancones', '2006', '20'),
('200605', 'Marcavelica', '2006', '20'),
('200606', 'Miguel Checa', '2006', '20'),
('200607', 'Querecotillo', '2006', '20'),
('200608', 'Salitral', '2006', '20'),
('200701', 'Pariñas', '2007', '20'),
('200702', 'El Alto', '2007', '20'),
('200703', 'La Brea', '2007', '20'),
('200704', 'Lobitos', '2007', '20'),
('200705', 'Los Organos', '2007', '20'),
('200706', 'Mancora', '2007', '20'),
('200801', 'Sechura', '2008', '20'),
('200802', 'Bellavista de la Unión', '2008', '20'),
('200803', 'Bernal', '2008', '20'),
('200804', 'Cristo Nos Valga', '2008', '20'),
('200805', 'Vice', '2008', '20'),
('200806', 'Rinconada Llicuar', '2008', '20'),
('210101', 'Puno', '2101', '21'),
('210102', 'Acora', '2101', '21'),
('210103', 'Amantani', '2101', '21'),
('210104', 'Atuncolla', '2101', '21'),
('210105', 'Capachica', '2101', '21'),
('210106', 'Chucuito', '2101', '21'),
('210107', 'Coata', '2101', '21'),
('210108', 'Huata', '2101', '21'),
('210109', 'Mañazo', '2101', '21'),
('210110', 'Paucarcolla', '2101', '21'),
('210111', 'Pichacani', '2101', '21'),
('210112', 'Plateria', '2101', '21'),
('210113', 'San Antonio', '2101', '21'),
('210114', 'Tiquillaca', '2101', '21'),
('210115', 'Vilque', '2101', '21'),
('210201', 'Azángaro', '2102', '21'),
('210202', 'Achaya', '2102', '21'),
('210203', 'Arapa', '2102', '21'),
('210204', 'Asillo', '2102', '21'),
('210205', 'Caminaca', '2102', '21'),
('210206', 'Chupa', '2102', '21'),
('210207', 'José Domingo Choquehuanca', '2102', '21'),
('210208', 'Muñani', '2102', '21'),
('210209', 'Potoni', '2102', '21'),
('210210', 'Saman', '2102', '21'),
('210211', 'San Anton', '2102', '21'),
('210212', 'San José', '2102', '21'),
('210213', 'San Juan de Salinas', '2102', '21'),
('210214', 'Santiago de Pupuja', '2102', '21'),
('210215', 'Tirapata', '2102', '21'),
('210301', 'Macusani', '2103', '21'),
('210302', 'Ajoyani', '2103', '21'),
('210303', 'Ayapata', '2103', '21'),
('210304', 'Coasa', '2103', '21'),
('210305', 'Corani', '2103', '21'),
('210306', 'Crucero', '2103', '21'),
('210307', 'Ituata', '2103', '21'),
('210308', 'Ollachea', '2103', '21'),
('210309', 'San Gaban', '2103', '21'),
('210310', 'Usicayos', '2103', '21'),
('210401', 'Juli', '2104', '21'),
('210402', 'Desaguadero', '2104', '21'),
('210403', 'Huacullani', '2104', '21'),
('210404', 'Kelluyo', '2104', '21'),
('210405', 'Pisacoma', '2104', '21'),
('210406', 'Pomata', '2104', '21'),
('210407', 'Zepita', '2104', '21'),
('210501', 'Ilave', '2105', '21'),
('210502', 'Capazo', '2105', '21'),
('210503', 'Pilcuyo', '2105', '21'),
('210504', 'Santa Rosa', '2105', '21'),
('210505', 'Conduriri', '2105', '21'),
('210601', 'Huancane', '2106', '21'),
('210602', 'Cojata', '2106', '21'),
('210603', 'Huatasani', '2106', '21'),
('210604', 'Inchupalla', '2106', '21'),
('210605', 'Pusi', '2106', '21'),
('210606', 'Rosaspata', '2106', '21'),
('210607', 'Taraco', '2106', '21'),
('210608', 'Vilque Chico', '2106', '21'),
('210701', 'Lampa', '2107', '21'),
('210702', 'Cabanilla', '2107', '21'),
('210703', 'Calapuja', '2107', '21'),
('210704', 'Nicasio', '2107', '21'),
('210705', 'Ocuviri', '2107', '21'),
('210706', 'Palca', '2107', '21'),
('210707', 'Paratia', '2107', '21'),
('210708', 'Pucara', '2107', '21'),
('210709', 'Santa Lucia', '2107', '21'),
('210710', 'Vilavila', '2107', '21'),
('210801', 'Ayaviri', '2108', '21'),
('210802', 'Antauta', '2108', '21'),
('210803', 'Cupi', '2108', '21'),
('210804', 'Llalli', '2108', '21'),
('210805', 'Macari', '2108', '21'),
('210806', 'Nuñoa', '2108', '21'),
('210807', 'Orurillo', '2108', '21'),
('210808', 'Santa Rosa', '2108', '21'),
('210809', 'Umachiri', '2108', '21'),
('210901', 'Moho', '2109', '21'),
('210902', 'Conima', '2109', '21'),
('210903', 'Huayrapata', '2109', '21'),
('210904', 'Tilali', '2109', '21'),
('211001', 'Putina', '2110', '21'),
('211002', 'Ananea', '2110', '21'),
('211003', 'Pedro Vilca Apaza', '2110', '21'),
('211004', 'Quilcapuncu', '2110', '21'),
('211005', 'Sina', '2110', '21'),
('211101', 'Juliaca', '2111', '21'),
('211102', 'Cabana', '2111', '21'),
('211103', 'Cabanillas', '2111', '21'),
('211104', 'Caracoto', '2111', '21'),
('211105', 'San Miguel', '2111', '21'),
('211201', 'Sandia', '2112', '21'),
('211202', 'Cuyocuyo', '2112', '21'),
('211203', 'Limbani', '2112', '21'),
('211204', 'Patambuco', '2112', '21'),
('211205', 'Phara', '2112', '21'),
('211206', 'Quiaca', '2112', '21'),
('211207', 'San Juan del Oro', '2112', '21'),
('211208', 'Yanahuaya', '2112', '21'),
('211209', 'Alto Inambari', '2112', '21'),
('211210', 'San Pedro de Putina Punco', '2112', '21'),
('211301', 'Yunguyo', '2113', '21'),
('211302', 'Anapia', '2113', '21'),
('211303', 'Copani', '2113', '21'),
('211304', 'Cuturapi', '2113', '21'),
('211305', 'Ollaraya', '2113', '21'),
('211306', 'Tinicachi', '2113', '21'),
('211307', 'Unicachi', '2113', '21'),
('220101', 'Moyobamba', '2201', '22'),
('220102', 'Calzada', '2201', '22'),
('220103', 'Habana', '2201', '22'),
('220104', 'Jepelacio', '2201', '22'),
('220105', 'Soritor', '2201', '22'),
('220106', 'Yantalo', '2201', '22'),
('220201', 'Bellavista', '2202', '22'),
('220202', 'Alto Biavo', '2202', '22'),
('220203', 'Bajo Biavo', '2202', '22'),
('220204', 'Huallaga', '2202', '22'),
('220205', 'San Pablo', '2202', '22'),
('220206', 'San Rafael', '2202', '22'),
('220301', 'San José de Sisa', '2203', '22'),
('220302', 'Agua Blanca', '2203', '22'),
('220303', 'San Martín', '2203', '22'),
('220304', 'Santa Rosa', '2203', '22'),
('220305', 'Shatoja', '2203', '22'),
('220401', 'Saposoa', '2204', '22'),
('220402', 'Alto Saposoa', '2204', '22'),
('220403', 'El Eslabón', '2204', '22'),
('220404', 'Piscoyacu', '2204', '22'),
('220405', 'Sacanche', '2204', '22'),
('220406', 'Tingo de Saposoa', '2204', '22'),
('220501', 'Lamas', '2205', '22'),
('220502', 'Alonso de Alvarado', '2205', '22'),
('220503', 'Barranquita', '2205', '22'),
('220504', 'Caynarachi', '2205', '22'),
('220505', 'Cuñumbuqui', '2205', '22'),
('220506', 'Pinto Recodo', '2205', '22'),
('220507', 'Rumisapa', '2205', '22'),
('220508', 'San Roque de Cumbaza', '2205', '22'),
('220509', 'Shanao', '2205', '22'),
('220510', 'Tabalosos', '2205', '22'),
('220511', 'Zapatero', '2205', '22'),
('220601', 'Juanjuí', '2206', '22'),
('220602', 'Campanilla', '2206', '22'),
('220603', 'Huicungo', '2206', '22'),
('220604', 'Pachiza', '2206', '22'),
('220605', 'Pajarillo', '2206', '22'),
('220701', 'Picota', '2207', '22'),
('220702', 'Buenos Aires', '2207', '22'),
('220703', 'Caspisapa', '2207', '22'),
('220704', 'Pilluana', '2207', '22'),
('220705', 'Pucacaca', '2207', '22'),
('220706', 'San Cristóbal', '2207', '22'),
('220707', 'San Hilarión', '2207', '22'),
('220708', 'Shamboyacu', '2207', '22'),
('220709', 'Tingo de Ponasa', '2207', '22'),
('220710', 'Tres Unidos', '2207', '22'),
('220801', 'Rioja', '2208', '22'),
('220802', 'Awajun', '2208', '22'),
('220803', 'Elías Soplin Vargas', '2208', '22'),
('220804', 'Nueva Cajamarca', '2208', '22'),
('220805', 'Pardo Miguel', '2208', '22'),
('220806', 'Posic', '2208', '22'),
('220807', 'San Fernando', '2208', '22'),
('220808', 'Yorongos', '2208', '22'),
('220809', 'Yuracyacu', '2208', '22'),
('220901', 'Tarapoto', '2209', '22'),
('220902', 'Alberto Leveau', '2209', '22'),
('220903', 'Cacatachi', '2209', '22'),
('220904', 'Chazuta', '2209', '22'),
('220905', 'Chipurana', '2209', '22'),
('220906', 'El Porvenir', '2209', '22'),
('220907', 'Huimbayoc', '2209', '22'),
('220908', 'Juan Guerra', '2209', '22'),
('220909', 'La Banda de Shilcayo', '2209', '22'),
('220910', 'Morales', '2209', '22'),
('220911', 'Papaplaya', '2209', '22'),
('220912', 'San Antonio', '2209', '22'),
('220913', 'Sauce', '2209', '22'),
('220914', 'Shapaja', '2209', '22'),
('221001', 'Tocache', '2210', '22'),
('221002', 'Nuevo Progreso', '2210', '22'),
('221003', 'Polvora', '2210', '22'),
('221004', 'Shunte', '2210', '22'),
('221005', 'Uchiza', '2210', '22'),
('230101', 'Tacna', '2301', '23'),
('230102', 'Alto de la Alianza', '2301', '23'),
('230103', 'Calana', '2301', '23'),
('230104', 'Ciudad Nueva', '2301', '23'),
('230105', 'Inclan', '2301', '23'),
('230106', 'Pachia', '2301', '23'),
('230107', 'Palca', '2301', '23'),
('230108', 'Pocollay', '2301', '23'),
('230109', 'Sama', '2301', '23'),
('230110', 'Coronel Gregorio Albarracín Lanchipa', '2301', '23'),
('230111', 'La Yarada los Palos', '2301', '23'),
('230201', 'Candarave', '2302', '23'),
('230202', 'Cairani', '2302', '23'),
('230203', 'Camilaca', '2302', '23'),
('230204', 'Curibaya', '2302', '23'),
('230205', 'Huanuara', '2302', '23'),
('230206', 'Quilahuani', '2302', '23'),
('230301', 'Locumba', '2303', '23'),
('230302', 'Ilabaya', '2303', '23'),
('230303', 'Ite', '2303', '23'),
('230401', 'Tarata', '2304', '23'),
('230402', 'Héroes Albarracín', '2304', '23'),
('230403', 'Estique', '2304', '23'),
('230404', 'Estique-Pampa', '2304', '23'),
('230405', 'Sitajara', '2304', '23'),
('230406', 'Susapaya', '2304', '23'),
('230407', 'Tarucachi', '2304', '23'),
('230408', 'Ticaco', '2304', '23'),
('240101', 'Tumbes', '2401', '24'),
('240102', 'Corrales', '2401', '24'),
('240103', 'La Cruz', '2401', '24'),
('240104', 'Pampas de Hospital', '2401', '24'),
('240105', 'San Jacinto', '2401', '24'),
('240106', 'San Juan de la Virgen', '2401', '24'),
('240201', 'Zorritos', '2402', '24'),
('240202', 'Casitas', '2402', '24'),
('240203', 'Canoas de Punta Sal', '2402', '24'),
('240301', 'Zarumilla', '2403', '24'),
('240302', 'Aguas Verdes', '2403', '24'),
('240303', 'Matapalo', '2403', '24'),
('240304', 'Papayal', '2403', '24'),
('250101', 'Calleria', '2501', '25'),
('250102', 'Campoverde', '2501', '25'),
('250103', 'Iparia', '2501', '25'),
('250104', 'Masisea', '2501', '25'),
('250105', 'Yarinacocha', '2501', '25'),
('250106', 'Nueva Requena', '2501', '25'),
('250107', 'Manantay', '2501', '25'),
('250201', 'Raymondi', '2502', '25'),
('250202', 'Sepahua', '2502', '25'),
('250203', 'Tahuania', '2502', '25'),
('250204', 'Yurua', '2502', '25'),
('250301', 'Padre Abad', '2503', '25'),
('250302', 'Irazola', '2503', '25'),
('250303', 'Curimana', '2503', '25'),
('250304', 'Neshuya', '2503', '25'),
('250305', 'Alexander Von Humboldt', '2503', '25'),
('250401', 'Purus', '2504', '25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo_peru_provinces`
--
-- Creación: 13-05-2020 a las 05:40:37
--

DROP TABLE IF EXISTS `ubigeo_peru_provinces`;
CREATE TABLE IF NOT EXISTS `ubigeo_peru_provinces` (
  `id` varchar(4) COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `department_id` varchar(2) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ubigeo_peru_provinces`
--

INSERT INTO `ubigeo_peru_provinces` (`id`, `name`, `department_id`) VALUES
('0101', 'Chachapoyas', '01'),
('0102', 'Bagua', '01'),
('0103', 'Bongará', '01'),
('0104', 'Condorcanqui', '01'),
('0105', 'Luya', '01'),
('0106', 'Rodríguez de Mendoza', '01'),
('0107', 'Utcubamba', '01'),
('0201', 'Huaraz', '02'),
('0202', 'Aija', '02'),
('0203', 'Antonio Raymondi', '02'),
('0204', 'Asunción', '02'),
('0205', 'Bolognesi', '02'),
('0206', 'Carhuaz', '02'),
('0207', 'Carlos Fermín Fitzcarrald', '02'),
('0208', 'Casma', '02'),
('0209', 'Corongo', '02'),
('0210', 'Huari', '02'),
('0211', 'Huarmey', '02'),
('0212', 'Huaylas', '02'),
('0213', 'Mariscal Luzuriaga', '02'),
('0214', 'Ocros', '02'),
('0215', 'Pallasca', '02'),
('0216', 'Pomabamba', '02'),
('0217', 'Recuay', '02'),
('0218', 'Santa', '02'),
('0219', 'Sihuas', '02'),
('0220', 'Yungay', '02'),
('0301', 'Abancay', '03'),
('0302', 'Andahuaylas', '03'),
('0303', 'Antabamba', '03'),
('0304', 'Aymaraes', '03'),
('0305', 'Cotabambas', '03'),
('0306', 'Chincheros', '03'),
('0307', 'Grau', '03'),
('0401', 'Arequipa', '04'),
('0402', 'Camaná', '04'),
('0403', 'Caravelí', '04'),
('0404', 'Castilla', '04'),
('0405', 'Caylloma', '04'),
('0406', 'Condesuyos', '04'),
('0407', 'Islay', '04'),
('0408', 'La Uniòn', '04'),
('0501', 'Huamanga', '05'),
('0502', 'Cangallo', '05'),
('0503', 'Huanca Sancos', '05'),
('0504', 'Huanta', '05'),
('0505', 'La Mar', '05'),
('0506', 'Lucanas', '05'),
('0507', 'Parinacochas', '05'),
('0508', 'Pàucar del Sara Sara', '05'),
('0509', 'Sucre', '05'),
('0510', 'Víctor Fajardo', '05'),
('0511', 'Vilcas Huamán', '05'),
('0601', 'Cajamarca', '06'),
('0602', 'Cajabamba', '06'),
('0603', 'Celendín', '06'),
('0604', 'Chota', '06'),
('0605', 'Contumazá', '06'),
('0606', 'Cutervo', '06'),
('0607', 'Hualgayoc', '06'),
('0608', 'Jaén', '06'),
('0609', 'San Ignacio', '06'),
('0610', 'San Marcos', '06'),
('0611', 'San Miguel', '06'),
('0612', 'San Pablo', '06'),
('0613', 'Santa Cruz', '06'),
('0701', 'Prov. Const. del Callao', '07'),
('0801', 'Cusco', '08'),
('0802', 'Acomayo', '08'),
('0803', 'Anta', '08'),
('0804', 'Calca', '08'),
('0805', 'Canas', '08'),
('0806', 'Canchis', '08'),
('0807', 'Chumbivilcas', '08'),
('0808', 'Espinar', '08'),
('0809', 'La Convención', '08'),
('0810', 'Paruro', '08'),
('0811', 'Paucartambo', '08'),
('0812', 'Quispicanchi', '08'),
('0813', 'Urubamba', '08'),
('0901', 'Huancavelica', '09'),
('0902', 'Acobamba', '09'),
('0903', 'Angaraes', '09'),
('0904', 'Castrovirreyna', '09'),
('0905', 'Churcampa', '09'),
('0906', 'Huaytará', '09'),
('0907', 'Tayacaja', '09'),
('1001', 'Huánuco', '10'),
('1002', 'Ambo', '10'),
('1003', 'Dos de Mayo', '10'),
('1004', 'Huacaybamba', '10'),
('1005', 'Huamalíes', '10'),
('1006', 'Leoncio Prado', '10'),
('1007', 'Marañón', '10'),
('1008', 'Pachitea', '10'),
('1009', 'Puerto Inca', '10'),
('1010', 'Lauricocha ', '10'),
('1011', 'Yarowilca ', '10'),
('1101', 'Ica ', '11'),
('1102', 'Chincha ', '11'),
('1103', 'Nasca ', '11'),
('1104', 'Palpa ', '11'),
('1105', 'Pisco ', '11'),
('1201', 'Huancayo ', '12'),
('1202', 'Concepción ', '12'),
('1203', 'Chanchamayo ', '12'),
('1204', 'Jauja ', '12'),
('1205', 'Junín ', '12'),
('1206', 'Satipo ', '12'),
('1207', 'Tarma ', '12'),
('1208', 'Yauli ', '12'),
('1209', 'Chupaca ', '12'),
('1301', 'Trujillo ', '13'),
('1302', 'Ascope ', '13'),
('1303', 'Bolívar ', '13'),
('1304', 'Chepén ', '13'),
('1305', 'Julcán ', '13'),
('1306', 'Otuzco ', '13'),
('1307', 'Pacasmayo ', '13'),
('1308', 'Pataz ', '13'),
('1309', 'Sánchez Carrión ', '13'),
('1310', 'Santiago de Chuco ', '13'),
('1311', 'Gran Chimú ', '13'),
('1312', 'Virú ', '13'),
('1401', 'Chiclayo ', '14'),
('1402', 'Ferreñafe ', '14'),
('1403', 'Lambayeque ', '14'),
('1501', 'Lima ', '15'),
('1502', 'Barranca ', '15'),
('1503', 'Cajatambo ', '15'),
('1504', 'Canta ', '15'),
('1505', 'Cañete ', '15'),
('1506', 'Huaral ', '15'),
('1507', 'Huarochirí ', '15'),
('1508', 'Huaura ', '15'),
('1509', 'Oyón ', '15'),
('1510', 'Yauyos ', '15'),
('1601', 'Maynas ', '16'),
('1602', 'Alto Amazonas ', '16'),
('1603', 'Loreto ', '16'),
('1604', 'Mariscal Ramón Castilla ', '16'),
('1605', 'Requena ', '16'),
('1606', 'Ucayali ', '16'),
('1607', 'Datem del Marañón ', '16'),
('1608', 'Putumayo', '16'),
('1701', 'Tambopata ', '17'),
('1702', 'Manu ', '17'),
('1703', 'Tahuamanu ', '17'),
('1801', 'Mariscal Nieto ', '18'),
('1802', 'General Sánchez Cerro ', '18'),
('1803', 'Ilo ', '18'),
('1901', 'Pasco ', '19'),
('1902', 'Daniel Alcides Carrión ', '19'),
('1903', 'Oxapampa ', '19'),
('2001', 'Piura ', '20'),
('2002', 'Ayabaca ', '20'),
('2003', 'Huancabamba ', '20'),
('2004', 'Morropón ', '20'),
('2005', 'Paita ', '20'),
('2006', 'Sullana ', '20'),
('2007', 'Talara ', '20'),
('2008', 'Sechura ', '20'),
('2101', 'Puno ', '21'),
('2102', 'Azángaro ', '21'),
('2103', 'Carabaya ', '21'),
('2104', 'Chucuito ', '21'),
('2105', 'El Collao ', '21'),
('2106', 'Huancané ', '21'),
('2107', 'Lampa ', '21'),
('2108', 'Melgar ', '21'),
('2109', 'Moho ', '21'),
('2110', 'San Antonio de Putina ', '21'),
('2111', 'San Román ', '21'),
('2112', 'Sandia ', '21'),
('2113', 'Yunguyo ', '21'),
('2201', 'Moyobamba ', '22'),
('2202', 'Bellavista ', '22'),
('2203', 'El Dorado ', '22'),
('2204', 'Huallaga ', '22'),
('2205', 'Lamas ', '22'),
('2206', 'Mariscal Cáceres ', '22'),
('2207', 'Picota ', '22'),
('2208', 'Rioja ', '22'),
('2209', 'San Martín ', '22'),
('2210', 'Tocache ', '22'),
('2301', 'Tacna ', '23'),
('2302', 'Candarave ', '23'),
('2303', 'Jorge Basadre ', '23'),
('2304', 'Tarata ', '23'),
('2401', 'Tumbes ', '24'),
('2402', 'Contralmirante Villar ', '24'),
('2403', 'Zarumilla ', '24'),
('2501', 'Coronel Portillo ', '25'),
('2502', 'Atalaya ', '25'),
('2503', 'Padre Abad ', '25'),
('2504', 'Purús', '25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--
-- Creación: 16-04-2020 a las 02:56:40
--

DROP TABLE IF EXISTS `unidad_medida`;
CREATE TABLE IF NOT EXISTS `unidad_medida` (
  `codigo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`codigo`, `nombre`) VALUES
('KG', 'KILOGRAMO'),
('TN', 'TONELADA'),
('TRA', 'TRAILADA'),
('UND', 'UNIDAD');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orden_compra_detalle`
--
ALTER TABLE `orden_compra_detalle`
  ADD CONSTRAINT `orden_compra_detalle_fk` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`id`);

--
-- Filtros para la tabla `pago_proveedor`
--
ALTER TABLE `pago_proveedor`
  ADD CONSTRAINT `pago_proveedor_fk` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`id`);

--
-- Filtros para la tabla `pago_proveedor_detalle`
--
ALTER TABLE `pago_proveedor_detalle`
  ADD CONSTRAINT `pago_proveedor_detalle_fk` FOREIGN KEY (`pago_proveedor_id`) REFERENCES `pago_proveedor` (`id`);

--
-- Filtros para la tabla `persona_rol`
--
ALTER TABLE `persona_rol`
  ADD CONSTRAINT `persona_rol_fk` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `persona_rol_fk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`producto_marca_id`) REFERENCES `producto_marca` (`id`);

--
-- Filtros para la tabla `producto_stock_minimo`
--
ALTER TABLE `producto_stock_minimo`
  ADD CONSTRAINT `producto_stock_minimo_fk` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `producto_unidad_medida`
--
ALTER TABLE `producto_unidad_medida`
  ADD CONSTRAINT `producto_unidad_medida_fk` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `proyecto_inmueble`
--
ALTER TABLE `proyecto_inmueble`
  ADD CONSTRAINT `proyecto_inmueble_fk` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `proyecto_requerimiento_detalle`
--
ALTER TABLE `proyecto_requerimiento_detalle`
  ADD CONSTRAINT `proyecto_requerimiento_detalle_fk` FOREIGN KEY (`proyecto_requerimiento_id`) REFERENCES `proyecto_requerimiento` (`id`);

--
-- Filtros para la tabla `proyecto_trabajo_partida_producto`
--
ALTER TABLE `proyecto_trabajo_partida_producto`
  ADD CONSTRAINT `proyecto_trabajo_partida_producto_fk` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `proyecto_venta`
--
ALTER TABLE `proyecto_venta`
  ADD CONSTRAINT `proyecto_venta_fk` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`),
  ADD CONSTRAINT `proyecto_venta_fk_1` FOREIGN KEY (`persona_cliente_id`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `proyecto_venta_cronograma_pago`
--
ALTER TABLE `proyecto_venta_cronograma_pago`
  ADD CONSTRAINT `proyecto_venta_cronograma_pago_fk` FOREIGN KEY (`proyecto_venta_id`) REFERENCES `proyecto_venta` (`id`);

--
-- Filtros para la tabla `proyecto_venta_detalle`
--
ALTER TABLE `proyecto_venta_detalle`
  ADD CONSTRAINT `proyecto_venta_detalle_fk` FOREIGN KEY (`proyecto_venta_id`) REFERENCES `proyecto_venta` (`id`),
  ADD CONSTRAINT `proyecto_venta_detalle_fk_1` FOREIGN KEY (`proyecto_inmueble_id`) REFERENCES `proyecto_inmueble` (`id`);

--
-- Filtros para la tabla `proyecto_venta_pago`
--
ALTER TABLE `proyecto_venta_pago`
  ADD CONSTRAINT `proyecto_venta_pago_fk` FOREIGN KEY (`proyecto_venta_id`) REFERENCES `proyecto_venta` (`id`);

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `rol_permiso_fk` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
