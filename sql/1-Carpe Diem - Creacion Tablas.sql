/* Borra tablas */

DROP TABLE Pagos CASCADE CONSTRAINTS;
DROP TABLE Viajes CASCADE CONSTRAINTS; 
DROP TABLE ViajeAlojamientos CASCADE CONSTRAINTS;
DROP TABLE Albergues CASCADE CONSTRAINTS;
DROP TABLE Apartamentos CASCADE CONSTRAINTS;
DROP TABLE Hoteles CASCADE CONSTRAINTS;
DROP TABLE ViajeActividades CASCADE CONSTRAINTS;
DROP TABLE Actividades CASCADE CONSTRAINTS;
DROP TABLE Billetes CASCADE CONSTRAINTS;
DROP TABLE Transportes CASCADE CONSTRAINTS;
DROP TABLE Estaciones CASCADE CONSTRAINTS;
DROP TABLE Nominas CASCADE CONSTRAINTS; 
DROP TABLE Empleados CASCADE CONSTRAINTS;
DROP TABLE Rangos CASCADE CONSTRAINTS; 
DROP TABLE Clientes CASCADE CONSTRAINTS;

/* Creación tabla Clientes */
CREATE TABLE Clientes (
    idCliente SMALLINT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellidos VARCHAR(30) NOT NULL,
    dnic VARCHAR(9) NOT NULL,
    fechaNacimiento DATE NOT NULL,
    domicilio VARCHAR(40) NOT NULL,
    poblacion VARCHAR(20) NOT NULL,
    email VARCHAR(30),
    telefono VARCHAR(14),
    foto VARCHAR(30),
    puntosTarjeta SMALLINT
);

/* Creación tabla Rangos */
CREATE TABLE Rangos (
    	idRango SMALLINT PRIMARY KEY,
      rango VARCHAR(30) NOT NULL,
      salario NUMBER(9,2) NOT NULL
);

/* Creación tabla Empleados */
CREATE TABLE Empleados (
    idEmpleado SMALLINT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellidos VARCHAR(30) NOT NULL,
    dniE VARCHAR(9) NOT NULL,
    fechaNacimiento DATE NOT NULL,
    domicilio VARCHAR(40) NOT NULL,
    poblacion VARCHAR(20) NOT NULL,
    fechaAlta DATE DEFAULT SYSDATE,
    fechaBaja DATE,
    viajesVendidos SMALLINT,
    email VARCHAR(70),
    telefono VARCHAR(14),
    cuenta VARCHAR(40) NOT NULL,
    usuario VARCHAR(20) NOT NULL,
    clave VARCHAR(30) NOT NULL,
    idRango SMALLINT, 
    FOREIGN KEY (idRango) REFERENCES Rangos
);

/* Creación tabla Nóminas */
CREATE TABLE Nominas (
      idEmpleado SMALLINT NOT NULL,   
    	IdNomina SMALLINT PRIMARY KEY,
      mes NUMBER(2) CHECK (MES BETWEEN 1 AND 12) NOT NULL,
      anyo NUMBER(4) NOT NULL,
      suplemento NUMBER(9,2),
      idRango SMALLINT, 
      FOREIGN KEY(idRango) REFERENCES rangos, 
      FOREIGN KEY(idEmpleado) REFERENCES empleados
);

/* Creación tabla Estaciones */
CREATE TABLE Estaciones(
	idEstacion SMALLINT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL, 
	codigoE VARCHAR(15), 
	tipo VARCHAR(20), CHECK (tipo IN ('aeropuerto', 'estacionTren', 'estacionBus')) 
);

/* Creación tabla Transportes */
CREATE TABLE Transportes(
	idTransporte SMALLINT PRIMARY KEY,
  origen VARCHAR(30) NOT NULL, 
	destino VARCHAR(30) NOT NULL, 
	compañía VARCHAR(30), 
	precioNominal NUMBER(9,2), 
	tipo VARCHAR(10), CHECK (tipo IN ('ida', 'idaVuelta')), 
	fechaI DATE NOT NULL,
 	fechaF DATE NOT NULL,  
	IdaYvuelta DATE,
  idEstacion SMALLINT NOT NULL,
	FOREIGN KEY(idEstacion) REFERENCES Estaciones
);

/* Creación tabla Billetes */
CREATE TABLE Billetes(
	idBillete SMALLINT PRIMARY KEY,
  codigoB VARCHAR(30),
	asiento VARCHAR(5) NOT NULL, 
	tipo VARCHAR(30), CHECK (tipo IN ('economica', 'business', 'primeraClase')),
  idTransporte SMALLINT NOT NULL,
	FOREIGN KEY(idTransporte) REFERENCES Transportes,
	idCliente SMALLINT NOT NULL,
  FOREIGN KEY(idCliente) REFERENCES clientes
);


/* Creación tabla Actividades */
CREATE TABLE Actividades(
	idActividad SMALLINT PRIMARY KEY,
  localizacion VARCHAR(30) NOT NULL,
	precio NUMBER(9,2),
	tipo VARCHAR(7), CHECK (tipo IN ('privado', 'publico'))
);

/* Creación tabla ViajeActividades */
CREATE TABLE viajeActividades(
	idViajeActividad SMALLINT PRIMARY KEY, 
	fechaI DATE, 
	fechaF DATE, 
	guía VARCHAR(50),
  idActividad SMALLINT,
	FOREIGN KEY(idActividad) REFERENCES actividades
);

/* Creación tabla Hoteles */
CREATE TABLE Hoteles(
	idHotel SMALLINT PRIMARY KEY,
  nombre VARCHAR(100), 
	localización VARCHAR(100), 
	precio NUMBER(9,2), 
	servicios VARCHAR(50), 
	regimen VARCHAR(20), CHECK (regimen IN ('soloAlojamiento', 'alojamientoDesayuno', 'pensionCompleta', 'mediaPension', 'todoIncluido')), 
	habitación VARCHAR(10)
);

/* Creación tabla Apartamentos */
CREATE TABLE Apartamentos(
	idApartamento SMALLINT PRIMARY KEY,
  nombre VARCHAR(30), 
	localización VARCHAR(100), 
	precio NUMBER(9,2), 
	servicios VARCHAR(50), 
	habitación VARCHAR(10)
);

/* Creación tabla Albergues */
CREATE TABLE Albergues(
	idAlbergue SMALLINT PRIMARY KEY,
  nombre VARCHAR(30), 
	localización VARCHAR(100), 
	precio NUMBER(9,2), 
	servicios VARCHAR(50), 
	regimen VARCHAR(20), CHECK (regimen IN ('soloAlojamiento', 'alojamientoDesayuno', 'pensionCompleta', 'mediaPension', 'todoIncluido')),
	habitación VARCHAR(10)
);


/* Creación tabla ViajeAlojamientos */
CREATE TABLE viajeAlojamientos(
	idViajeAlojamiento SMALLINT PRIMARY KEY,
  fechaI DATE, 
	fechaF DATE, 
  idHotel SMALLINT,
  idApartamento SMALLINT,  
  idAlbergue SMALLINT,
	FOREIGN KEY(idHotel) REFERENCES hoteles,
	FOREIGN KEY(idApartamento) REFERENCES apartamentos,
	FOREIGN KEY(idAlbergue) REFERENCES albergues
);

/* Creación tabla Viajes */
CREATE TABLE Viajes(
	idViaje SMALLINT PRIMARY KEY,
  fechaI DATE NOT NULL, 
	fechaF DATE NOT NULL, 
  idCliente SMALLINT NOT NULL,
  idEmpleado SMALLINT NOT NULL,
  idViajeActividad SMALLINT,
  idTransporte SMALLINT,
  idViajeAlojamiento SMALLINT,
  cancelado VARCHAR(6), CHECK (cancelado IN ('True')),
  FOREIGN KEY(idCliente) REFERENCES clientes,
	FOREIGN KEY(idEmpleado) REFERENCES empleados,
	FOREIGN KEY(idViajeActividad) REFERENCES viajeActividades,
	FOREIGN KEY(idTransporte) REFERENCES transportes,
	FOREIGN KEY(idViajeAlojamiento) REFERENCES viajeAlojamientos
);



/* Creación tabla Pagos */
CREATE TABLE Pagos (
	idPago SMALLINT PRIMARY KEY, 
	cantidad NUMBER(9,2) NOT NULL, 
	fecha DATE NOT NULL,
  idCliente SMALLINT NOT NULL,
  idViaje SMALLINT NOT NULL,
	FOREIGN KEY(idCliente) REFERENCES Clientes,
	FOREIGN KEY(idViaje) REFERENCES Viajes
);


-- Borrar secuencias

DROP SEQUENCE sec_cli; 
DROP SEQUENCE sec_ran; 
DROP SEQUENCE sec_emp; 
DROP SEQUENCE sec_nom; 
DROP SEQUENCE sec_trans;
DROP SEQUENCE sec_est;
DROP SEQUENCE sec_bil;
DROP SEQUENCE sec_act;
DROP SEQUENCE sec_va;
DROP SEQUENCE sec_hot;
DROP SEQUENCE sec_apar;
DROP SEQUENCE sec_alb;
DROP SEQUENCE sec_val;
DROP SEQUENCE sec_via; 
DROP SEQUENCE sec_pag;

-- Creación de secuencia para generar PK de las tablas

CREATE SEQUENCE sec_cli;
CREATE SEQUENCE sec_ran;
CREATE SEQUENCE sec_emp;
CREATE SEQUENCE sec_nom;
CREATE SEQUENCE sec_est;
CREATE SEQUENCE sec_trans;
CREATE SEQUENCE sec_bil;
CREATE SEQUENCE sec_act;
CREATE SEQUENCE sec_va;
CREATE SEQUENCE sec_hot;
CREATE SEQUENCE sec_apar;
CREATE SEQUENCE sec_alb;
CREATE SEQUENCE sec_val;
CREATE SEQUENCE sec_via;
CREATE SEQUENCE sec_pag;



-- Creación de Trigger de secuencias para generar PK de las tablas

CREATE OR REPLACE TRIGGER clientes_PK 
BEFORE INSERT ON clientes
FOR EACH ROW 
BEGIN 
SELECT sec_cli.nextval INTO :new.idCliente FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER rango_PK 
BEFORE INSERT ON rangos 
FOR EACH ROW 
BEGIN 
SELECT sec_ran.nextval INTO :new.idRango FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER empleados_PK 
BEFORE INSERT ON empleados 
FOR EACH ROW 
BEGIN 
SELECT sec_emp.nextval INTO :new.idEmpleado FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER nominas_PK 
BEFORE INSERT ON nominas
FOR EACH ROW 
BEGIN 
SELECT sec_nom.nextval INTO :new.IdNomina FROM dual; 
END; 
/


CREATE OR REPLACE TRIGGER estaciones_PK 
BEFORE INSERT ON estaciones
FOR EACH ROW 
BEGIN 
SELECT sec_est.nextval INTO :new.idEstacion FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER transportes_PK 
BEFORE INSERT ON transportes 
FOR EACH ROW 
BEGIN 
SELECT sec_trans.nextval INTO :new.idTransporte FROM dual; 
END; 
/


CREATE OR REPLACE TRIGGER billetes_PK 
BEFORE INSERT ON billetes 
FOR EACH ROW 
BEGIN 
SELECT sec_bil.nextval INTO :new.idBillete FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER actividades_PK 
BEFORE INSERT ON actividades
FOR EACH ROW 
BEGIN 
SELECT sec_act.nextval INTO :new.idActividad FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER viajeActividades_PK 
BEFORE INSERT ON viajeActividades
FOR EACH ROW 
BEGIN 
SELECT sec_va.nextval INTO :new.idViajeActividad FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER hoteles_PK 
BEFORE INSERT ON hoteles
FOR EACH ROW 
BEGIN 
SELECT sec_hot.nextval INTO :new.idHotel FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER apartamentos_PK 
BEFORE INSERT ON apartamentos
FOR EACH ROW 
BEGIN 
SELECT sec_apar.nextval INTO :new.idApartamento FROM dual; 
END; 
/ 

CREATE OR REPLACE TRIGGER albergues_PK 
BEFORE INSERT ON albergues
FOR EACH ROW 
BEGIN 
SELECT sec_alb.nextval INTO :new.idAlbergue FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER viajeAlojamientos_PK 
BEFORE INSERT ON viajeAlojamientos
FOR EACH ROW 
BEGIN 
SELECT sec_val.nextval INTO :new.idViajeAlojamiento FROM dual; 
END; 
/


CREATE OR REPLACE TRIGGER pagos_PK 
BEFORE INSERT ON pagos 
FOR EACH ROW 
BEGIN 
SELECT sec_pag.nextval INTO :new.idPago FROM dual; 
END; 
/

CREATE OR REPLACE TRIGGER viajes_PK 
BEFORE INSERT ON viajes 
FOR EACH ROW 
BEGIN 
SELECT sec_via.nextval INTO :new.idViaje FROM dual; 
END; 
/


/* Creacion de filas */ 

-- Tabla Clientes
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email,telefono, foto,puntosTarjeta) 
VALUES ('Marcos', 'Cifuente Rodriguez', '73425189E', '12/07/1980', 'Calle Uruguay, 1', 'Sevilla', 'marcoscifuente@gmail.com', '634786945', 'C:Fotodn\cliente1', 10);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Tashya','Moses Hodges','27856873Q','30/04/1982','5025 Neque. Avenue','Peine','urna@convallis.com','677780302', 'C:Fotodn\cliente2', 13);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Harry','Potter Evans','26607265R', '20/01/1979','Ap #987-1579 Sagittis Av.','Bevel','risus.varius@hotmail.com','636863141', 'C:Fotodn\cliente3', 6);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Issac','Marsh Rios','20078316P', '28/03/1998','P.O. Box 291, 239 Per St.','Tiruchirapalli','augue.ac@gmail.es','697205673', 'C:Fotodn\cliente4', 20);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Hermione','Granger Velez','49716566S', '30/06/1968','Ap #816-2261 Imperdiet Road','Couillet','sit@us.es','608798551', 'C:Fotodn\cliente5', 17);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Lavinia','Walsh','24213631D', '14/06/1975','2520 Magna Road','Sint-Martens-Lennik','consequat@Aenean.net','646741415', 'C:Fotodn\cliente6', 9);


-- Tabla Rangos
INSERT INTO rangos (rango, salario) 
VALUES  ('Empleada', 1050.67);
INSERT INTO rangos (rango, salario) 
VALUES  ('Director', 3050.70);

-- Tabla Empleados
INSERT INTO empleados (nombre, apellidos, dniE, fechaNacimiento, domicilio, poblacion, fechaAlta, viajesVendidos, email, telefono, cuenta, usuario, clave, idRango) 
VALUES ('Carlotas', 'Rivas Martin', '76234561H', '13/01/1971', 'Calle Tajo, 1', 'Sevilla', '13/09/2017', 10,
  'carlotasrivas@gmail.com', '67391893', 'ES12-1234-1234-12-1234567890', '76234561', '1726', 1);
INSERT INTO empleados (nombre, apellidos, dniE, fechaNacimiento, domicilio, poblacion, fechaAlta, fechaBaja, viajesVendidos, email, telefono, cuenta, usuario, clave, idRango) 
VALUES ('Anacleto', 'Agente Secreto', '39180922H', '08/07/1996','462-9271 Massa. Rd.','San Pietro Mussolino', '20/05/2016', '31/08/2018', 72, 
'demo@demo.com', '673688754','ES21-7344-9117-14-526941118', '39180922', '0000', 1);
INSERT INTO empleados (nombre, apellidos, dniE, fechaNacimiento, domicilio, poblacion, fechaAlta, viajesVendidos, email, telefono, cuenta, usuario, clave, idRango) 
VALUES ('Germaine','Robbins Garrison', '25225826R','04/11/1972','7815 Orci Road', 'Tavistock', '17/02/2017', 31, 
'ultrices.Vivamus.rhoncus@celeri.com', '694754780', 'ES75-0008-3686-28-308572817','25225826', '9554',2);
INSERT INTO empleados (nombre, apellidos, dniE, fechaNacimiento, domicilio, poblacion, fechaAlta, viajesVendidos, email, telefono, cuenta, usuario, clave, idRango) 
VALUES ('Hunter','Mercer Lang','50603295W', '14/06/1965','262-3650 Erat Rd.', 'Barasat', '16/12/2013', 80, 
'est.ac.facilisis@litoratorquent.org','623502924','ES20-3569-2660-17-943739785','50603295' ,'6967', 1);
INSERT INTO empleados (nombre, apellidos, dniE, fechaNacimiento, domicilio, poblacion, fechaAlta, fechaBaja, viajesVendidos, email, telefono, cuenta, usuario, clave, idRango) 
VALUES ('Alfreda','Coleman Guy','36180269L','20/07/1966','Ap 398-2504 Est. Road','Offida','22/11/2014', '04/03/2017', 7, 
'nulla@gmail.com', '602307466','ES93-5089-0281-25-429742325','36180269','3660',1);
INSERT INTO empleados (nombre, apellidos, dniE, fechaNacimiento, domicilio, poblacion, fechaAlta, fechaBaja, viajesVendidos, email, telefono, cuenta, usuario, clave, idRango) 
VALUES ('Kuame','Parrish Wallace', '14754897N','10/07/1992','P.O. Box 503, 8814 Amet Rd.', 'Balen', '03/01/2014', '29/10/2015', 11, 
'vitae.odio@hotmail.com','681480261','ES58-2025-7252-20-064772472','14754897', '4803',1);

-- Tabla Nominas
INSERT INTO nominas (idEmpleado, mes, anyo, suplemento, idRango)
 VALUES (1,09,2017,200,1);
 INSERT INTO nominas (idEmpleado, mes, anyo, suplemento, idRango)
 VALUES (3,01,2017,100,2);
 INSERT INTO nominas (idEmpleado, mes, anyo, suplemento, idRango)
 VALUES (3,09,2015,50,2);
 INSERT INTO nominas (idEmpleado, mes, anyo, suplemento, idRango)
 VALUES (4,06,2018,100,1);
 INSERT INTO nominas (idEmpleado, mes, anyo, suplemento, idRango)
 VALUES (1,12,2012,30,1);

-- Tabla Estaciones
INSERT INTO estaciones (nombre, codigoE, tipo)
 VALUES ('Aeropuerto de Ibiz', 'IBZ','aeropuerto');
 INSERT INTO estaciones (nombre, codigoE, tipo)
 VALUES ('Aeropuerto de Zaragoza', 'ZAZ', 'aeropuerto');
 INSERT INTO estaciones (nombre, codigoE, tipo)
 VALUES ('Estacion de Zaragoza','ZAZ',  'estacionBus');
 INSERT INTO estaciones (nombre, codigoE, tipo)
 VALUES ('Estacion Maria Zambrano','Malaga','estacionTren');
 INSERT INTO estaciones (nombre, codigoE, tipo)
 VALUES ('Aeropuerto de Sevilla', 'SVQ', 'aeropuerto');
 INSERT INTO estaciones (nombre, codigoE, tipo)
 VALUES ('Aeropuerto Adolfo Suárez Madrid-Barajas', 'MAD', 'aeropuerto');

-- Tabla Transportes
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Ibiza','Punta Cana', 'Dominicanfly', 330.90, 'idaVuelta', '22/10/2017', '22/10/2017', '03/11/2017',1);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Madrid','Nueva York', 'Delta', 435.90, 'ida', '20/01/2019','02/02/2019', '', 6);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Zaragoza','Londres', 'Comes', 12.90, 'idaVuelta', '22/10/2018',  '22/10/2018','26/10/2018', 2);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Malaga','Madrid', 'AVE', 100.90, 'idaVuelta', '18/06/2017', '18/06/2017','25/06/2017',3);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Sevilla','Noruega', 'Norweigan', 130.90, 'idaVuelta', '28/07/2018', '28/07/2018', '08/08/2018',5);

-- Tabla Billetes
INSERT INTO Billetes (codigoB, asiento, tipo, idTransporte, idCliente) VALUES ('B76354', '35a', 'economica', 1, 1); 
INSERT INTO Billetes (codigoB,asiento,tipo, idTransporte, idCliente) VALUES ('U67092','12a','economica',1, 3);
INSERT INTO Billetes (codigoB,asiento,tipo, idTransporte, idCliente) VALUES ('E72271','17b','economica',2, 4);
INSERT INTO Billetes (codigoB,asiento,tipo, idTransporte, idCliente) VALUES ('e10739','34f','primeraClase', 3, 5);
INSERT INTO Billetes (codigoB,asiento,tipo, idTransporte, idCliente) VALUES ('o02578','23f','economica',4 ,2);
INSERT INTO Billetes (codigoB,asiento,tipo, idTransporte, idCliente) VALUES ('U46251','17e','primeraClase', 5, 1);

-- Tabla Actividades
INSERT INTO Actividades (localizacion, precio, tipo) VALUES ('Oxford Street, 13', 35.89, 'publico');
INSERT INTO Actividades (localizacion, precio, tipo) VALUES ('Times Square, 13', 300.00, 'privado');
INSERT INTO Actividades (localizacion, precio, tipo) VALUES ('Gran Via, 15', 28.89, 'publico');
INSERT INTO Actividades (localizacion, precio, tipo) VALUES ('Frijolito ,12', 73.50, 'publico');
INSERT INTO Actividades (localizacion, precio, tipo) VALUES ('Skolem, 1', 15.22, 'publico');

-- Tabla ViajeActividades
INSERT INTO ViajeActividades(fechaI, fechaF, guía, idActividad) VALUES ('23/10/2018', '23/10/2018', 'Julían Maluma', 4);
INSERT INTO ViajeActividades(fechaI, fechaF, guía, idActividad) VALUES ('23/01/19', '23/01/19', 'Mike Smith', 2);
INSERT INTO ViajeActividades(fechaI, fechaF, guía, idActividad) VALUES ('25/10/2018', '25/10/2018', 'Christian Grey', 1);
INSERT INTO ViajeActividades(fechaI, fechaF, guía, idActividad) VALUES ('19/06/2017', '19/06/2017', 'Brad Pit', 5);
INSERT INTO ViajeActividades(fechaI, fechaF, guía, idActividad) VALUES ('29/07/2018', '29/07/2018', 'Don Quijote', 3);

-- Tabla Hoteles
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Royal Garden London', '2-24 Kensignton High St, London W8 4PT, Reino Unido', 567.90, 'Fumadores', 'soloAlojamiento', 230);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Radisson Blu Royal Hotel, Bergen','Dreggsallmenningen 1, 5003 Bergen, Noruega',890.45,'onlyAdult','soloAlojamiento', 182);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Hotel Persa','Calle de Atocha, 49 Madrid', 106.90, 'fumadores','soloAlojamiento', 145 );
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('1 Hotel Brooklyn Bridge','60 Furman St, Brooklyn, Nueva York',423.90,'onlyAdult', 'mediaPension', 26);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Occidental Punta Cana','S/N. Playa, Avenida España, Punta Cana 23301, República Dominicana, Punta Cana', 1781.98 , 'fumadores','todoIncluido',978);

-- Tabla Apartamentos y Albergues
--INSERT INTO Apartamentos (nombre, localización, precio, servicios, habitación) VALUES (null, null, null, null, null);
--INSERT INTO Albergues (nombre, localización, precio, servicios, regimen, habitación) VALUES (null, null, null, null, null, null);

-- Tabla ViajeAlojamientos
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('22/10/2017', '03/11/2017', 5); 
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('22/10/2018', '26/10/2018', 4);
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('22/10/2018', '26/10/2018', 1);
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('18/06/2017', '25/06/2017', 3);
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('28/07/2018', '08/08/2018', 2); 

-- Tabla Viajes*
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('22/10/2017', '03/11/2017', 1, 2, 4, 1, 5);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('20/01/2019','02/02/2019', 2, 3, 2, 2, 4);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('22/10/2018','26/10/2018', 5, 4, 1, 3, 1);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('18/06/2017','25/06/2017', 4, 1, 5, 4, 3);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('28/07/2018','08/08/2018', 3, 4, 3, 5, 2);

-- Tabla Pagos
INSERT INTO Pagos (cantidad, fecha, idCliente, idViaje) 
VALUES (550,'15/08/2017', 1, 1);
INSERT INTO Pagos (cantidad, fecha, idCliente, idViaje) 
VALUES (650,'15/11/2019', 2, 2);
INSERT INTO Pagos (cantidad, fecha, idCliente, idViaje) 
VALUES (550,'15/08/2018', 5, 3);
INSERT INTO Pagos (cantidad, fecha, idCliente, idViaje) 
VALUES (60,'15/03/2017', 4, 4);
INSERT INTO Pagos (cantidad, fecha, idCliente, idViaje) 
VALUES (250,'29/03/2017', 3, 5);




