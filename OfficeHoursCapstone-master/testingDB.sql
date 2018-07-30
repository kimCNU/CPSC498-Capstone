select * from `office-hours`.`Professor`;
select * from `office-hours`.`OfficeHour`;

select `office-hours`.`Professor`.`Prefix`,`office-hours`.`Professor`.`FirstName`,`office-hours`.`Professor`.`LastName`,`office-hours`.`Professor`.`email`,
	   `office-hours`.`Professor`.`OfficeBuilding`,`office-hours`.`Professor`.`OfficeNumber`,`office-hours`.`OfficeHour`.`dayOfWeek`,
      `office-hours`.`OfficeHour`.`OfficeHourStart`,`office-hours`.`OfficeHour`.`OfficeHourEnd`
       
 from `office-hours`.`Professor` 
 inner join `office-hours`.`OfficeHour` on `office-hours`.`Professor`.`Prof_ID` = `office-hours`.`OfficeHour`.`Prof_ID` and `office-hours`.`OfficeHour`.`Semester` = 'SP-18'
 order by `office-hours`.`Professor`.`LastName`;
 
