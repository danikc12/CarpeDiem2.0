-- Triggers no asociados a secuencias

/* Trigger para evitar que un viaje tenga la misma fecha que una ya creada*/
CREATE OR REPLACE TRIGGER FechasViajes
BEFORE INSERT ON Viajes
FOR EACH ROW 
DECLARE 
V_Res Integer; 
BEGIN 
  SELECT COUNT(*) INTO V_Res 
  FROM Viajes A 
  WHERE idCliente = :NEW.idCliente
  AND (FechaI, FechaF) 
  OVERLAPS (:NEW.FechaI, :NEW.FechaF);
  
  IF (V_Res >= 1) THEN 
    RAISE_APPLICATION_ERROR 
    (-20600,'Para dicho cliente ya existe un viaje con los mismos días');
    END IF; 
END; 
/