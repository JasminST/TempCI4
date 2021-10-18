use dbasistenciarp;
SET GLOBAL event_scheduler=ON; # Levantar el Scheduler

DELIMITER |
CREATE or replace EVENT diarioverfaltas
    ON SCHEDULE EVERY 1 DAY #1 HOUR
    STARTS now() #concat(current_date(),' 06:00:00')
    DO
    BEGIN
		IF dayofweek(NOW()) != 1 THEN
			insert into faltas(IdArea,IdPers,FecFalt,DesFalt,TurFalt,TipoFalt)
				select p.IdArea as ida,p.IdPers as idp,subdate(current_date(), 1) as dt,'',p.TurPers as tur,p.EstPers as tipo
				from personal p 
				left join (select IdPers from asistencias where date(IngAsis) = subdate(current_date(), 1)) o 
				on p.IdPers = o.IdPers 
				where o.IdPers is null and p.PuestPers != 'EE' and p.EstPers < 3; #Listado de personal activo,en vacaciones o en descanso sin una asistencia en el dia anterior y que no es empleado
			insert into eventos(NomEvent,TipEvent,CreEvent) values("Diario ver Faltas",2,now());
		END IF;
	END |
DELIMITER ;
            
DELIMITER |
CREATE or replace EVENT diarioentradaincompleta
    ON SCHEDULE EVERY 1 DAY #1 HOUR
    STARTS now() #concat(current_date(),' 06:00:00')
    DO
    BEGIN
		IF dayofweek(NOW()) != 1 THEN
			update asistencias set EstAsis = 3 where date(IngAsis) = subdate(current_date(), 1) and EstAsis = 0 and IdAsis > 0; #Estado incompleto si no se terminó ayer
            insert into eventos(NomEvent,TipEvent,CreEvent) values("Diario entrada Incompleta",1,now());
		END IF;
	END |
DELIMITER ;
        
DELIMITER |
CREATE or replace EVENT semanaaceptar
	ON SCHEDULE EVERY 1 WEEK # 2 HOUR
    STARTS now() #concat(current_date(),' 06:00:00')
    DO
	BEGIN
		update asistencias set AcepAsis = 1 where EstAsis = 1 and IdAsis > 0; #Estado en Salida completa se acepta en una semana
        update faltas set AcepFalt = 1 where EstFalt > 0 and IdFalt > 0; #Faltas se aceptan por defecto en una semana si no son normales
        insert into eventos(NomEvent,TipEvent,CreEvent) values("Semanal aceptar",3,now());
	END |
DELIMITER ;