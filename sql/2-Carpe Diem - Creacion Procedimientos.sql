-- Script de Procedures

/*creación de procedures*/
--Procedure de nuevo cliente
CREATE OR REPLACE PROCEDURE nuevo_cliente
(w_nombre IN CLIENTES.NOMBRE%TYPE,
 w_apellidos IN CLIENTES.APELLIDOS%TYPE,
 w_dnic IN CLIENTES.DNIC%TYPE,
 w_fechaNacimiento IN CLIENTES.FECHANACIMIENTO%TYPE,
 w_domicilio IN CLIENTES.DOMICILIO%TYPE,
 w_poblacion IN CLIENTES.POBLACION%TYPE,
 w_email IN CLIENTES.EMAIL%TYPE,
 w_telefono IN CLIENTES.TELEFONO%TYPE,
 w_foto IN CLIENTES.FOTO%TYPE) IS
BEGIN
INSERT INTO clientes (nombre, apellidos, dnic, fechaNacimiento, domicilio, poblacion, email, telefono, foto)
 VALUES (w_nombre, w_apellidos, w_dnic, w_fechaNacimiento, w_domicilio, w_poblacion, w_email, w_telefono, w_foto);
COMMIT WORK;
END;
/


-- Procedure para crear nuevo rango
create or replace PROCEDURE nuevo_rango
(w_rango IN RANGOS.RANGO%TYPE,
w_salario IN RANGOS.SALARIO%TYPE) IS
BEGIN
INSERT INTO rangos (rango, salario)
 VALUES (w_rango, w_salario);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_empleado
(w_nombre IN EMPLEADOS.NOMBRE%TYPE,
 w_apellidos IN EMPLEADOS.APELLIDOS%TYPE,
 w_dniE IN EMPLEADOS.DNIE%TYPE,
 w_fechaNacimiento IN EMPLEADOS.FECHANACIMIENTO%TYPE,
 w_domicilio IN EMPLEADOS.DOMICILIO%TYPE,
 w_poblacion IN EMPLEADOS.POBLACION%TYPE,
 w_fechaAlta IN EMPLEADOS.FECHAALTA%TYPE,
 w_fechaBaja IN EMPLEADOS.FECHABAJA%TYPE,
 w_viajesVendidos IN EMPLEADOS.VIAJESVENDIDOS%TYPE,
 w_email IN EMPLEADOS.EMAIL%TYPE,
 w_telefono IN EMPLEADOS.TELEFONO%TYPE,
 w_cuenta IN EMPLEADOS.CUENTA%TYPE,
 w_usuario IN EMPLEADOS.USUARIO%TYPE,
 w_clave IN EMPLEADOS.CLAVE%TYPE,
 w_idRango IN EMPLEADOS.IDRANGO%TYPE) IS
BEGIN
INSERT INTO empleados (nombre, apellidos, dnie, fechaNacimiento, domicilio, poblacion,  fechaAlta, fechaBaja, viajesVendidos, email, telefono,
cuenta, usuario, clave, idRango)
 VALUES (w_nombre, w_apellidos, w_dnie, w_fechaNacimiento, w_domicilio, w_poblacion,  w_fechaAlta, w_fechaBaja, w_viajesVendidos, w_email, w_telefono,
w_cuenta, w_usuario, w_clave, w_idRango);
COMMIT WORK;
END;
/

--procedure de actualización de empleados
create or replace procedure actualiza_empleado(
  in_usuario in empleados.usuario%type,
  in_telefono in empleados.telefono%type,
  in_email in empleados.email%type,
  in_cuenta in empleados.cuenta%type,
  in_domicilio in empleados.domicilio%type,
  in_poblacion in empleados.poblacion%type) is 
begin
  update empleados set telefono = in_telefono where usuario = in_usuario;
  update empleados set email = in_email where usuario = in_usuario;
  update empleados set cuenta = in_cuenta where usuario = in_usuario;
  update empleados set domicilio = in_domicilio where usuario = in_usuario;
  update empleados set poblacion = in_poblacion where usuario = in_usuario;
commit work;
end;
/

create or replace PROCEDURE nueva_nomina
(w_idEmpleado IN NOMINAS.IDEMPLEADO%TYPE,
w_mes IN NOMINAS.MES%TYPE,
w_anyo IN NOMINAS.ANYO%TYPE,
w_suplemento IN NOMINAS.SUPLEMENTO%TYPE,
w_idRango IN NOMINAS.IDRANGO%TYPE) IS
BEGIN
INSERT INTO nominas (idEmpleado, mes, anyo, suplemento, idRango)
 VALUES (w_idEmpleado, w_mes, w_anyo, w_suplemento, w_idRango);
COMMIT WORK;
END;
/


create or replace PROCEDURE nueva_estacion
(w_nombre IN ESTACIONES.NOMBRE%TYPE,
w_codigoE IN ESTACIONES.CODIGOE%TYPE,
w_tipo IN ESTACIONES.TIPO%TYPE) IS
BEGIN
INSERT INTO estaciones (nombre, codigoE, tipo)
 VALUES (w_nombre, w_codigoE, w_tipo);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_transporte
(w_origen IN TRANSPORTES.ORIGEN%TYPE,
w_destino IN TRANSPORTES.DESTINO%TYPE,
w_compañía IN TRANSPORTES.COMPAÑÍA%TYPE,
w_precioNominal IN TRANSPORTES.PRECIONOMINAL%TYPE,
w_tipo IN TRANSPORTES.TIPO%TYPE,
w_fechaI IN TRANSPORTES.FECHAI%TYPE,
w_fechaF IN TRANSPORTES.FECHAF%TYPE,
w_idaYVuelta IN TRANSPORTES.IDAYVUELTA%TYPE,
w_idEstacion IN TRANSPORTES.IDESTACION%TYPE) IS
BEGIN
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
 VALUES (w_origen, w_destino, w_compañía, w_precioNominal, w_tipo, w_fechaI, w_fechaF, w_idaYvuelta, w_idEstacion);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_billete
(w_codigoB IN BILLETES.CODIGOB%TYPE,
w_asiento IN BILLETES.ASIENTO%TYPE,
w_tipo IN BILLETES.TIPO%TYPE,
w_idTransporte IN BILLETES.IDTRANSPORTE%TYPE,
w_idCliente IN BILLETES.IDCLIENTE%TYPE) IS
BEGIN
INSERT INTO billetes (codigoB, asiento, tipo, idTransporte, idCliente)
 VALUES (w_codigoB, w_asiento, w_tipo, w_idTransporte, w_idCliente);
COMMIT WORK;
END;
/

create or replace PROCEDURE nueva_actividad
(w_localizacion IN ACTIVIDADES.LOCALIZACION%TYPE,
w_precio IN ACTIVIDADES.PRECIO%TYPE,
w_tipo IN ACTIVIDADES.TIPO%TYPE) IS
BEGIN
INSERT INTO actividades (localizacion, precio, tipo)
 VALUES (w_localizacion, w_precio, w_tipo);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_viajeActividad
(w_fechaI IN VIAJEACTIVIDADES.FECHAI%TYPE,
w_fechaF IN VIAJEACTIVIDADES.FECHAF%TYPE,
w_guía IN VIAJEACTIVIDADES.GUÍA%TYPE,
w_idActividad IN VIAJEACTIVIDADES.IDACTIVIDAD%TYPE) IS
BEGIN
INSERT INTO viajeActividades (fechaI, fechaF, guía, idActividad)
 VALUES (w_fechaI, w_fechaF, w_guía, w_idActividad);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_hotel
(w_nombre IN HOTELES.NOMBRE%TYPE,
w_localización IN HOTELES.LOCALIZACIÓN%TYPE,
w_precio IN HOTELES.PRECIO%TYPE,
w_servicios IN HOTELES.SERVICIOS%TYPE,
w_regimen IN HOTELES.REGIMEN%TYPE,
w_habitación IN HOTELES.HABITACIÓN%TYPE) IS
BEGIN
INSERT INTO hoteles (nombre, localización, precio, servicios, regimen, habitación)
 VALUES (w_nombre, w_localización, w_precio, w_servicios, w_regimen, w_habitación);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_apartamento
(w_nombre IN APARTAMENTOS.NOMBRE%TYPE,
w_localización IN APARTAMENTOS.LOCALIZACIÓN%TYPE,
w_precio IN APARTAMENTOS.PRECIO%TYPE,
w_servicios IN APARTAMENTOS.SERVICIOS%TYPE,
w_habitación IN APARTAMENTOS.HABITACIÓN%TYPE) IS
BEGIN
INSERT INTO apartamentos (nombre, localización, precio, servicios, habitación)
 VALUES (w_nombre, w_localización, w_precio, w_servicios, w_habitación);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_albergue
(w_nombre IN ALBERGUES.NOMBRE%TYPE,
w_localización IN ALBERGUES.LOCALIZACIÓN%TYPE,
w_precio IN ALBERGUES.PRECIO%TYPE,
w_servicios IN ALBERGUES.SERVICIOS%TYPE,
w_regimen IN ALBERGUES.REGIMEN%TYPE,
w_habitación IN ALBERGUES.HABITACIÓN%TYPE) IS
BEGIN
INSERT INTO albergues (nombre, localización, precio, servicios, regimen, habitación)
 VALUES (w_nombre, w_localización, w_precio, w_servicios, w_regimen, w_habitación);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_viajeAlojamientos
(w_fechaI IN VIAJEALOJAMIENTOS.FECHAI%TYPE,
w_fechaF IN VIAJEALOJAMIENTOS.FECHAF%TYPE,
w_idHotel IN VIAJEALOJAMIENTOS.IDHOTEL%TYPE,
w_idApartamento IN VIAJEALOJAMIENTOS.IDAPARTAMENTO%TYPE,
w_idAlbergue IN VIAJEALOJAMIENTOS.IDALBERGUE%TYPE) IS
BEGIN
INSERT INTO viajeAlojamientos (fechaI, fechaF, idHotel, idApartamento, idAlbergue)
 VALUES (w_fechaI, w_fechaF, w_idHotel, w_idApartamento, w_idAlbergue);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_viaje
(w_fechaI IN VIAJES.FECHAI%TYPE,
w_fechaF IN VIAJES.FECHAF%TYPE,
w_idCliente IN VIAJES.IDCLIENTE%TYPE,
w_idEmpleado IN VIAJES.IDEMPLEADO%TYPE,
w_idViajeActividad IN VIAJES.IDVIAJEACTIVIDAD%TYPE,
w_idTransporte IN VIAJES.IDTRANSPORTE%TYPE,
w_idViajeAlojamiento IN VIAJES.IDVIAJEALOJAMIENTO%TYPE) IS
BEGIN
INSERT INTO viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, idViajeAlojamiento)
 VALUES (w_fechaI, w_fechaF, w_idCliente, w_idEmpleado, w_idViajeActividad, w_idTransporte, w_idViajeAlojamiento);
COMMIT WORK;
END;
/

create or replace PROCEDURE nuevo_pago
(w_cantidad IN PAGOS.CANTIDAD%TYPE,
w_fecha IN PAGOS.FECHA%TYPE,
w_idCliente IN PAGOS.IDCLIENTE%TYPE,
w_idViaje IN PAGOS.IDVIAJE%TYPE) IS
BEGIN
INSERT INTO pagos (cantidad, fecha, idCliente, idViaje) 
VALUES (w_cantidad, w_fecha, w_idCliente, w_idViaje);
COMMIT WORK;
END;
/




/* Procedure para cancelar viajes*/
create or replace procedure cancela_viaje(
  in_idViaje in viajes.idViaje%type) is 
begin
  update viajes set cancelado = 'True' where idViaje = in_idViaje;
commit work;
end;
/


--Procedure de destinos más visitados
create or replace PROCEDURE destinos_mas_visitados(
numero number) IS
  cursor cur is 
          select destino, count(*)as cuenta from transportes
          group by destino order by 2 desc;
BEGIN
for fila in cur loop
  exit when cur%rowcount > numero;
  dbms_output.put_line('El destino ' || fila.destino || ' se ha visitado ' || fila.cuenta || ' veces.');
  end loop;
END;
/

