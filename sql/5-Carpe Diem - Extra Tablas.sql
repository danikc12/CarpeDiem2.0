/* Creacion de filas */ 
-- + Clientes
-- + Estaciones (aeropuertos)
-- + Hoteles



-- Tabla Clientes

-- Más Clientes
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Peter','Roca','37686645H', '14/06/1975','Av. Concejal Alberto Jiménez-Becerril, 24','Sevilla','pedrito@correo.net','677744415', 'C:Fotodn\cliente7', 18);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Elvis','Rios','27115479C', '16/03/1966', 'Calle Feria, 122','Sevilla', 'consequat@Aenean.net','646741415', 'C:Fotodn\cliente8', 3);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Victor','Quintana','43419465L', '22/12/1963','Calle Betis 28','Sevilla', 'consequat@Aenean.net','674141415', 'C:Fotodn\cliente9', 13);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Elaine','Pastor','82110330P', '24/11/1952','Calle Maria Auxiliadora 41','Sevilla','consequat@Aenean.net','676741515', 'C:Fotodn\cliente10', 16);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Camilo','Hugo','96888556K', '06/06/1993','Avenida Luis Montoto 65','Sevilla','consequat@Aenean.net','647741465', 'C:Fotodn\cliente11', 7);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Ulises','Smith','71594865M', '10/03/1984','Avenida República Argentina 22','Sevilla','consequat@Aenean.net','648641415', 'C:Fotodn\cliente12', 11);

INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Francisco','Condequinto','54101982W', '07/08/1981','Avenida de las Ciencias 17', 'Sevilla','Phasellus@placerat.ca','655630123', 'C:Fotodn\cliente13', 18);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Yen','Fitzgerald','46963865G', '08/07/1963','Calle Tetuán 17','Sevilla','tempor.est@etmagna.net','647630762', 'C:Fotodn\cliente14', 9);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Rodrigo','Cruz','20264928C', '09/06/1979','Calle Sierpes 23','Sevilla','penatibus.et@nonummy.net','647915762', 'C:Fotodn\cliente15', 4);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Fernando','Rojas','27588556D', '07/03/1969','Calle Ardilla 22','Sevilla','corper@Intincidunt.co.uk','647914702', 'C:Fotodn\cliente16', 15);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Orlando','Bloom','47505646D', '13/01/1977','Calle Evangelista 70','Sevilla','legolas@archer.co.uk','647914702', 'C:Fotodn\cliente17', 13);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Violeta','Amor','26587124F', '05/01/1957','Avenida Ramón y Cajal 7','Sevilla','neque@augueutlacus.org','651514702', 'C:Fotodn\cliente18', 11);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Sara','de la Sierra','47505646G', '08/07/1989','Avenida Reina Mercedes 47','Sevilla','et@ante.co.uk','6708935118', 'C:Fotodn\cliente19', 7);
INSERT INTO clientes (nombre, apellidos, dniC, fechaNacimiento, domicilio, poblacion, email, telefono, foto, puntosTarjeta) 
VALUES ('Melinda','Channel','49266507H', '03/06/1967','Avenida de las Ciencias 21','Sevilla','mchannel@channel.org','6708942438', 'C:Fotodn\cliente20', 6);







-- Tabla Estaciones 6-10
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Aeropuerto Internacional de Singapur', 'SIN', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES (' Barcelona–El Prat Airport', 'BCN', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Malaga-Costa del Sol Airport', 'AGP', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Aeropuerto de Jerez', 'XRY', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Aeropuerto de Tenerife Sur', 'TFS', 'aeropuerto');

-- Tabla Estaciones 11-15
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('London Heathrow Airport', 'LHR', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Paris-Charles de Gaulle Airport', 'CDG', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Amsterdam Airport Schiphol', 'AMS', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Frankfurt Airport', 'FRA', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('John F. Kennedy International Airport', 'JFK', 'aeropuerto');

-- Tabla Estaciones 15-20
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Hartsfield–Jackson Atlanta International Airport', 'ATL', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Beijing Capital International Airport', 'PEK', 'aeropuerto');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Los Angeles International Airport', 'LAX', 'aeropuerto');



INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Estacion de autobuses de Jerez','XRY',  'estacionBus');
INSERT INTO estaciones (nombre, codigoE, tipo)
VALUES ('Estación de Autobuses de Málaga','AGP',  'estacionBus');


-- Tabla Hoteles 6-10
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación)
VALUES ('Hotel Barcelona 1882','Carrer Corsega 482, 08025 Barcelona, España', 165, 'fumadores','todoIncluido',222);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Catalonia Granada','Avenida de Madrid 10, 18012 Granada, España', 100, 'fumadores','todoIncluido',104);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Hard Rock Hotel Tenerife','Avenida Adeje 300 S/n | Playa Paraiso, 38678, Adeje, Tenerife, España', 138, 'fumadores','todoIncluido', 486);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Barcelo Malaga','Heroe de Sostoa 2 | Estacion Vialia Maria Zambrano, 29002 Málaga, España', 150, 'fumadores','todoIncluido',351);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Arima Hotel','Paseo de Miramón, 162, 20014 San Sebastián - Donostia, España', 116, 'fumadores','todoIncluido', 193);
-- Tabla Hoteles 11-15
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Hilton Garden Inn Frankfurt Airport','The Squaire | The Squaire, Am Flughafen, 60549 Frankfurt, Hesse, Alemania', 93, 'fumadores','todoIncluido', 401);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Steigenberger Airport Hotel','Unterschweinstiege 16, 60549 Frankfurt, Hesse, Alemania', 104, 'fumadores','todoIncluido', 337);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Park Plaza Westminster Bridge London','200 Westminster Bridge Road, Londres SE1 7UT, Inglaterra', 193, 'fumadores','todoIncluido', 231);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('The Tower Hotel','St Katharine''s Way, Londres E1W 1LD, Inglaterra', 134, 'fumadores','todoIncluido', 117);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('XO Hotels Couture','Delflandlaan 15, 1062 EA Ámsterdam, Países Bajos', 120, 'fumadores','todoIncluido', 391);
-- Tabla Hoteles 16-20
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('New World Beijing Hotel','No.8 Qi'nian Street, Chongwenmen, Dongcheng District, Pekín (Beijing), China', 137, 'fumadores','todoIncluido', 391);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Hotel Da Vinci & Spa','25 Rue des Saints-Peres, 75006 París, Francia', 294, 'fumadores','todoIncluido', 287);
INSERT INTO Hoteles (nombre, localización, precio, servicios, regimen, habitación) 
VALUES ('Crowne Plaza Los Angeles International Airport','5985 West Century Boulevard, Los Ángeles, CA', 138, 'fumadores','todoIncluido', 510);



Crowne Plaza Los Angeles International Airport

-- Tabla Apartamentos y Albergues
--INSERT INTO Apartamentos (nombre, localización, precio, servicios, habitación) VALUES (null, null, null, null, null);
--INSERT INTO Albergues (nombre, localización, precio, servicios, regimen, habitación) VALUES (null, null, null, null, null, null);


-- Tabla Transportes 6-10
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Málaga','Beijing', 'China Airlines', 800.90, 'idaVuelta', '12/06/2019', '12/06/2019', '12/07/2019', 17);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Sevilla','Frankfurt', 'Ryanair', 75.90, 'idaVuelta', '17/06/2019', '17/06/2019', '27/06/2019', 14);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Jerez','Amsterdam', 'Iberia', 45.90, 'idaVuelta', '10/06/2019', '10/06/2019', '15/06/2019', 13);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Sevilla','Londres', 'Ryanair', 36.90, 'idaVuelta', '06/06/2019', '06/06/2019', '11/06/2019', 11);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Sevilla','Barcelona', 'Ryanair', 20.90, 'idaVuelta', '07/06/2019', '07/06/2019', '09/06/2019', 7);
-- Tabla Transportes 11-15
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Sevilla','Los Ángeles', 'Norwegian', 1000.75, 'ida', '15/07/2019', '15/07/2019', '30/07/2019', 17);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Sevilla','Paris', 'Iberia', 100.90, 'ida', '24/07/2019', '24/07/2019', '30/07/2019', 12);
INSERT INTO transportes (origen, destino, compañía, precioNominal, tipo, fechaI, fechaF, idaYvuelta, idEstacion)
VALUES ('Sevilla','Tenerife', 'Iberia', 89.90, 'ida', '15/08/2019', '15/08/2019', '31/08/2019', 16);


-- Tabla ViajeAlojamientos 6-10
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('06/06/2019', '11/06/2019', 13);
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('07/06/2019', '09/06/2019', 6);
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('10/06/2019', '15/06/2019', 15);
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('12/06/2019', '12/07/2019', 16);
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('17/06/2019', '27/06/2019', 11);
-- Tabla ViajeAlojamientos 11-15
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('15/07/2019', '30/07/2019', 17);
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('24/07/2019', '30/07/2019', 18);
INSERT INTO ViajeAlojamientos (fechaI, fechaF, IdHotel) VALUES ('15/08/2019', '31/08/2019', 8);


-- Tabla Viajes 6-10
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('12/06/2019', '12/07/2019', 6, 2, 4, 6, 9);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('17/06/2019','27/06/2019', 10, 3, 2, 7, 10);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('10/06/2019','15/06/2019', 11, 4, 1, 8, 8);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('06/06/2019','11/06/2019', 12, 1, 5, 9, 6);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('07/06/2019','09/06/2019', 13, 4, 3, 10, 7);

-- Tabla Viajes 11-15
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('15/07/2019', '30/07/2019', 7, 2, 4, 11, 11);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('24/07/2019', '30/07/2019', 8, 2, 4, 12, 12);
INSERT INTO Viajes (fechaI, fechaF, idCliente, idEmpleado, idViajeActividad, idTransporte, IdViajeAlojamiento) 
VALUES ('15/08/2019', '31/08/2019', 9, 2, 4, 13, 13);


