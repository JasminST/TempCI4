-- Archivo que contiene los Scripts utilizados para Triggers, Eventos y Vistas;
-- Toda línea debe: Tener Create or replace para fácil implementación, quitar Definer (Evitar problemas con usuarios en distintos entornos)

-- Vista vmenu para la barra de links
use dbrppsd;
CREATE OR REPLACE
    ALGORITHM = UNDEFINED 
VIEW `vmenu` AS
    SELECT 
        `t`.`IdTUsu` AS `IdTUsu`,
        `m`.`IdMenu` AS `IdMenu`,
        `m`.`NomMenu` AS `NomMenu`,
        `m`.`IconMenu` AS `IconMenu`,
        `m`.`SubMenu` AS `SubMenu`,
        `m`.`UrlMenu` AS `UrlMenu`,
        `m`.`PadMenu` AS `PadMenu`,
        `m`.`OrdMenu` AS `OrdMenu`
    FROM
        ((`tusuarios` `t`
        JOIN `menus_tusuarios` `mt` ON ((`t`.`IdTUsu` = `mt`.`IdTUsu`)))
        JOIN `menus` `m` ON ((`mt`.`IdMenu` = `m`.`IdMenu`)))
    ORDER BY `t`.`IdTUsu` , `m`.`IdMenu` , `m`.`OrdMenu`;