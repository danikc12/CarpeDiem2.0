--Consultas 

--Viajes guardados
select * from VIAJES;

--Empleados y sus ventas
select nombre , VIAJESVENDIDOS from empleados;

--relación entre empleados y sus clientes;
select e.NOMBRE,cli.NOMBRE from clientes cli join (viajes v join empleados e on v.IDEMPLEADO = e.IDEMPLEADO) on v.IDCLIENTE=cli.IDCLIENTE;

--Viajes cancelados 
select * from viajes where CANCELADO = 'True';

--Nómina más alta
select max(n.SUPLEMENTO+r.SALARIO) from NOMINAS n join RANGOS r on n.IDRANGO = r.IDRANGO ;

--Todos los viajes de un cliente
select c.NOMBRE,v.IDVIAJE from viajes v join clientes c on v.IDCLIENTE = c.IDCLIENTE;  

-- cantidad total pagada por cada cliente
select cli.nombre, sum(p.cantidad) from pagos p join clientes cli on p.idCliente=cli.IDCLIENTE group by cli.NOMBRE;

--coste total de cada viaje
select p.IDVIAJE, sum(p.cantidad) from pagos p group by p.IDVIAJE;

--coste de cada viaje y nombre del cliente en cuestion
select p.IDVIAJE, sum(p.cantidad),cli.nombre from pagos p join clientes cli on p.IDCLIENTE=cli.IDCLIENTE group by p.IDVIAJE,cli.nombre;

 




/* PAQUETES */

CREATE OR REPLACE PACKAGE PRUEBAS_RANGOS AS 

   PROCEDURE inicializar;
   PROCEDURE insertar (nombre_prueba VARCHAR2,w_rango VARCHAR2, w_salario NUMBER, salidaEsperada BOOLEAN);
   PROCEDURE actualizar (nombre_prueba VARCHAR2,w_idRango INTEGER, w_rango VARCHAR2, w_salario NUMBER, salidaEsperada BOOLEAN);
   PROCEDURE eliminar (nombre_prueba VARCHAR2,w_idRango INTEGER, salidaEsperada BOOLEAN);

END PRUEBAS_RANGOS;
/

CREATE OR REPLACE FUNCTION ASSERT_EQUALS (salida BOOLEAN, salida_esperada BOOLEAN) RETURN VARCHAR2 AS 
BEGIN
  IF (salida = salida_esperada) THEN
    RETURN 'EXITO';
  ELSE
    RETURN 'FALLO';
  END IF;
END ASSERT_EQUALS;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_RANGOS AS

  /* INICIALIZACIÓN */
  PROCEDURE inicializar AS
  BEGIN

    /* Borrar contenido de la tabla */
      DELETE FROM Rangos;
    NULL;
  END inicializar;
  

/* PRUEBA PARA LA INSERCIÓN DE VIAJES */
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_rango VARCHAR2, w_salario NUMBER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    rango rangos%ROWTYPE;
    w_idRango INTEGER;
  BEGIN
    
    /* Insertar rango */
    INSERT INTO rangos VALUES(sec_ran.nextval, w_rango, w_salario);
    
    /* Seleccionar rango y comprobar que los datos se insertaron correctamente */
    w_idRango := sec_ran.currval;
    SELECT * INTO rango FROM rangos WHERE idRango=w_idRango;
    IF (rango.idRango<>w_idRango) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    
    /* Mostrar resultado de la prueba */
    DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(salida,salidaEsperada));
    
    EXCEPTION
    WHEN OTHERS THEN
          DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(false,salidaEsperada));
          ROLLBACK;
  END insertar;

/* PRUEBA PARA LA ACTUALIZACIÓN DE RANGOS */
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_idRango INTEGER, w_rango VARCHAR2, w_salario NUMBER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    rango rangos%ROWTYPE;
  BEGIN
    
    /* Actualizar rango */
    UPDATE rangos SET rango=w_rango WHERE idRango=w_idRango;
    
    /* Seleccionar rango y comprobar que los campos se actualizaron correctamente */
    SELECT * INTO rango FROM rangos WHERE idRango=w_idRango;
    IF (rango.idRango<>w_idRango) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    /* Mostrar resultado de la prueba */
    DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(salida,salidaEsperada));
    
    EXCEPTION
    WHEN OTHERS THEN
          DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(false,salidaEsperada));
          ROLLBACK;
  END actualizar;


/* PRUEBA PARA LA ELIMINACIÓN DE RANGOS */
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_idRango INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_rangos INTEGER;
  BEGIN
    
    /* Eliminar rango */
    DELETE FROM rangos WHERE idRango=w_idRango;
    
    /* Verificar que el rango no se encuentra en la BD */
    SELECT COUNT(*) INTO n_rangos FROM rangos WHERE idRango=w_idRango;
    IF (n_rangos <> 0) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    /* Mostrar resultado de la prueba */
    DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(salida,salidaEsperada));
    
    EXCEPTION
    WHEN OTHERS THEN
          DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(false,salidaEsperada));
          ROLLBACK;
  END eliminar;
END PRUEBAS_RANGOS;
/

/* PAQUETES */

CREATE OR REPLACE PACKAGE PRUEBAS_VIAJES AS 

   PROCEDURE inicializar;
   PROCEDURE insertar (nombre_prueba VARCHAR2, w_fechaI DATE, w_fechaF DATE, w_idCliente SMALLINT, w_idEmpleado SMALLINT, salidaEsperada BOOLEAN);
   PROCEDURE actualizar (nombre_prueba VARCHAR2,w_idViaje INTEGER, w_fechaI DATE, w_fechaF DATE, salidaEsperada BOOLEAN);
   PROCEDURE eliminar (nombre_prueba VARCHAR2,w_idViaje INTEGER, salidaEsperada BOOLEAN);

END PRUEBAS_VIAJES;
/

CREATE OR REPLACE FUNCTION ASSERT_EQUALS (salida BOOLEAN, salida_esperada BOOLEAN) RETURN VARCHAR2 AS 
BEGIN
  IF (salida = salida_esperada) THEN
    RETURN 'EXITO';
  ELSE
    RETURN 'FALLO';
  END IF;
END ASSERT_EQUALS;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_VIAJES AS

  /* INICIALIZACIÓN */
  PROCEDURE inicializar AS
  BEGIN

    /* Borrar contenido de la tabla */
      
      --DELETE FROM Viajes;
      
      DELETE FROM Viajes WHERE idViaje=2;     
      DELETE FROM Viajes WHERE idViaje=3;     
      DELETE FROM Viajes WHERE idViaje=4;     
      DELETE FROM Viajes WHERE idViaje=5;

  END inicializar;
  

/* PRUEBA PARA LA INSERCIÓN DE VIAJES */
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_fechaI DATE, w_fechaF DATE, w_idCliente SMALLINT, w_idEmpleado SMALLINT, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    viaje viajes%ROWTYPE;
    w_idViaje INTEGER;
  BEGIN
    
    /* Insertar viaje */
    INSERT INTO viajes(fechaI, fechaF, idCliente, idEmpleado) VALUES(w_fechaI, w_fechaF, w_idCliente, w_idEmpleado);
    
    /* Seleccionar viaje y comprobar que los datos se insertaron correctamente */
    w_idViaje := sec_via.currval;
    SELECT * INTO viaje FROM viajes WHERE idViaje=w_idViaje;
    IF (viaje.idViaje<>w_idViaje) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    /* Mostrar resultado de la prueba */
    DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(salida,salidaEsperada));
    
    EXCEPTION
    WHEN OTHERS THEN
          DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(false,salidaEsperada));
          ROLLBACK;
  END insertar;

/* PRUEBA PARA LA ACTUALIZACIÓN DE VIAJES */
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_idViaje INTEGER, w_fechaI DATE, w_fechaF DATE, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    viaje viajes%ROWTYPE;
  BEGIN
    
    /* Actualizar viaje */
    UPDATE viajes SET fechaI=w_fechaI WHERE idViaje=w_idViaje;
    UPDATE viajes SET fechaF=w_fechaF WHERE idViaje=w_idViaje;
    
    
    /* Seleccionar viaje y comprobar que los campos se actualizaron correctamente */
    SELECT * INTO viaje FROM viajes WHERE idViaje=w_idViaje;
    IF (viaje.idViaje<>w_idViaje) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    /* Mostrar resultado de la prueba */
    DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(salida,salidaEsperada));
    
    EXCEPTION
    WHEN OTHERS THEN
          DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(false,salidaEsperada));
          ROLLBACK;
  END actualizar;


/* PRUEBA PARA LA ELIMINACIÓN DE VIAJES */
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_idViaje INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_viajes INTEGER;
  BEGIN
    
    /* Eliminar viaje */
    DELETE FROM viajes WHERE idViaje=w_idViaje;
    
    /* Verificar que el viaje no se encuentra en la BD */
    SELECT COUNT(*) INTO n_viajes FROM viajes WHERE idViaje=w_idViaje;
    IF (n_viajes <> 0) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    /* Mostrar resultado de la prueba */
    DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(salida,salidaEsperada));
    
    EXCEPTION
    WHEN OTHERS THEN
          DBMS_OUTPUT.put_line(nombre_prueba || ASSERT_EQUALS(false,salidaEsperada));
          ROLLBACK;
  END eliminar;
END PRUEBAS_VIAJES;
/

/* Activar salida de texto por pantalla */
SET SERVEROUTPUT ON;

DECLARE
    idRango INTEGER;
  CR_LF CHAR(2) := CHR(13)||CHR(10); 
BEGIN

  /*********************************************************************
        PRUEBAS DE LAS OPERACIONES SOBRE LA TABLA RANGOS 
  **********************************************************************/
  --PRUEBAS_RANGOS.INICIALIZAR;
  DBMS_OUTPUT.PUT_LINE(CR_LF||'Pruebas sobre tabla de Rangos (Código Prueba/Acción/Título Prueba/Punto de Sincronismo esperado-->Resultado!)'||CR_LF);
  PRUEBAS_RANGOS.INSERTAR  ('Rang-01/Insert-"Rango=Empleado"                                  /Commit  --> ','Empleada', 900,true);
  idRango := sec_ran.currval;
  PRUEBAS_RANGOS.INSERTAR  ('Rang-02/Insert/"Rango=Null"                                      /Rollback--> ',null,null,false);
  PRUEBAS_RANGOS.ACTUALIZAR('Rang-03/Update/"Rango=Empleada"                                  /Commit  --> ',idRango,'Empleada', 900,true);
  PRUEBAS_RANGOS.ACTUALIZAR('Rang-04/Update/"Rango=Null"                                      /Rollback--> ',idRango,null, null, false);
  PRUEBAS_RANGOS.ELIMINAR  ('Rang-05/Delete/"Rango=Empleada"                                  /Commit  --> ',idRango,true);
  
END;
/

/* Activar salida de texto por pantalla */
SET SERVEROUTPUT ON;

DECLARE
    idViaje INTEGER;
  CR_LF CHAR(2) := CHR(13)||CHR(10); 
BEGIN

  /*********************************************************************
        PRUEBAS DE LAS OPERACIONES SOBRE LA TABLA VIAJES 
  **********************************************************************/
  --PRUEBAS_VIAJES.INICIALIZAR;
  DBMS_OUTPUT.PUT_LINE(CR_LF||'Pruebas sobre tabla de Viajes (Código Prueba/Acción/Título Prueba/Punto de Sincronismo esperado-->Resultado!)'||CR_LF);
  PRUEBAS_VIAJES.INSERTAR  ('Viaje-01/Insert-"FechaI=22/10/2019"-"FechaF=03/11/2019"            /Commit  --> ', '22/10/2019', '03/11/2019', 1, 1, true);
  idViaje := sec_via.currval;
  PRUEBAS_VIAJES.INSERTAR  ('Viaje-02/Insert-"FechaI=22/10/2019"-"FechaF=03/11/2019"            /Rollback--> ','22/10/2019', '03/11/2019', 1, 1, false);
  PRUEBAS_VIAJES.INSERTAR  ('Viaje-03/Insert/"FechaI=null"-"FechaF=null"                        /Rollback--> ',null, null, null, null, false);
  PRUEBAS_VIAJES.ACTUALIZAR('Viaje-04/Update/"FechaI=28/07/2019"-"FechaF=08/08/2019"            /Commit  --> ',idViaje,'16/07/2019', '08/08/2019', true);
  PRUEBAS_VIAJES.ACTUALIZAR('Viaje-05/Update/"FechaI=null"-"FechaF=null"                        /Rollback--> ',idViaje,null, null, false);
  PRUEBAS_VIAJES.ELIMINAR  ('Viaje-06/Delete/"FechaI=28/07/2019"-"FechaF=08/08/2019"            /Commit  --> ',idViaje,true);
  
  
END;
/
