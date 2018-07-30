-- -----------------------------------------------------
-- Kimberly Jimenez and Matt Lupino
-- CPSC 498: Capstone
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `office-hours` DEFAULT CHARACTER SET utf8 ;
USE `office-hours` ;

DROP TABLE IF EXISTS `office-hours`.`OfficeHour` ;
DROP TABLE IF EXISTS `office-hours`.`Professor` ;
-- -----------------------------------------------------
-- Table `mydb`.`Professor`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `office-hours`.`Professor` (
  `Prof_ID` INT NOT NULL AUTO_INCREMENT,
  `Prefix` VARCHAR(3) NULL,
  `FirstName` VARCHAR(20) NOT NULL,
  `LastName` VARCHAR(30) NOT NULL,
  `OfficeBuilding` VARCHAR(15) NOT NULL,
  `OfficeNumber` VARCHAR(5) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Prof_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`OfficeHour`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `office-hours`.`OfficeHour` (
  `dayOfWeek` VARCHAR(5) NOT NULL,
  `OfficeHourStart` VARCHAR(5) NOT NULL,
  `OfficeHourEnd` VARCHAR(5) NOT NULL,
  `Semester` VARCHAR(5) NOT NULL,
  `Prof_ID` INT NULL,
  INDEX `Prof_ID_idx` (`Prof_ID` ASC),
  CONSTRAINT `Prof_ID`
    FOREIGN KEY (`Prof_ID`)
    REFERENCES `office-hours`.`Professor` (`Prof_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- how to delete all records from a table. 
-- If a table has a foreign key, delete that table first.
delete from OfficeHour;
delete from Professor;

-- how to reset auto-incremenet...hopefully
ALTER TABLE Professor AUTO_INCREMENT = 1;

-- how to display every column from a table
-- select * from Professor;
-- select * from OfficeHour;

-- sample entry

-- insert into Professor(Prefix, FirstName, LastName, OfficeBuilding, OfficeNumber,email, byAppointment)
-- values ('','Christopher' , 'Kreider', 'Luter', '331', 'christopher.kreider@cnu.edu',true);

-- office hours of 1st entry
-- insert into OfficeHour(dayOfWeek,OfficeHourStart,OfficeHourEnd,Prof_ID)
-- values('MW','14:00','16:00',1);

-- insert into OfficeHour(dayOfWeek,OfficeHourStart,OfficeHourEnd,Prof_ID)
-- values('TR','13:00','14:00',1);


-- second entry
-- insert into Professor(Prefix,FirstName, LastName, OfficeBuilding, OfficeNumber,email, byAppointment)
-- values ('Dr.','David' , 'Pollio', 'MCM', '159D', 'david.pollio@cnu.edu',true);

-- insert into OfficeHour(dayOfWeek,OfficeHourStart,OfficeHourEnd,Prof_ID)
-- values('MWF','9:30','10:00',2);

-- insert into OfficeHour(dayOfWeek,OfficeHourStart,OfficeHourEnd,Prof_ID)
-- values('MWF','12:00','13:00',2);


-- third entry
-- insert into Professor(Prefix, FirstName, LastName, OfficeBuilding, OfficeNumber,email, byAppointment)
-- values ('','Keith' , 'Perkins', 'Luter', '207', 'keith.perkins@cnu.edu',true);

-- insert into OfficeHour(dayOfWeek,OfficeHourStart,OfficeHourEnd,Prof_ID)
-- values('MW','11:50','13:00',3);

-- insert into OfficeHour(dayOfWeek,OfficeHourStart,OfficeHourEnd,Prof_ID)
-- values('TR','10:45','12:00',3);

-- insert into OfficeHour(dayOfWeek,OfficeHourStart,OfficeHourEnd,Prof_ID)
-- values('F','13:00','14:00',3);


-- fourth entry
-- insert into Professor(Prefix,FirstName, LastName, OfficeBuilding, OfficeNumber,email, byAppointment)
-- values ('Dr.','Lynn' , 'Lambert', 'Luter', '320', 'lynn.lambert@cnu.edu',true);

-- insert into OfficeHour(dayOfWeek,OfficeHourStart,OfficeHourEnd,Prof_ID)
-- values('TR','15:00','16:15',4);

-- insert into OfficeHour(dayOfWeek,OfficeHourStart,OfficeHourEnd,Prof_ID)
-- values('W','12:50','13:50',4);


-- inserting Riedl and Gore
-- insert into Professor(Prefix, FirstName, LastName, OfficeBuilding, OfficeNumber, email, byAppointment)
-- values ('Dr.', 'Anton', 'Riedl', 'Luter','313', 'riedl@cnu.edu',1), 
	--   ('Dr.', 'David', 'Gore', 'Luter', '309', 'david.gore@cnu.edu',1);

-- mulitple inserts at same time

-- insert into OfficeHour (dayOfWeek, OfficeHourStart, OfficeHourEnd, Prof_ID) 
-- values ('M', '13:00', '14:30', 5), ('T', '11:00', '12:00', 5), ('W', '13:30', '14:30', 5), 
-- ('TR', '15:00', '16:30', 6), ('W', '19:30', '20:30', 6);

-- how to display results from two tables that have at least 1 common column
-- select Professor.Prefix,Professor.FirstName,Professor.LastName,Professor.email,
	  -- Professor.OfficeBuilding,Professor.OfficeNumber,OfficeHour.dayOfWeek,
     --  OfficeHour.OfficeHourStart,OfficeHour.OfficeHourEnd
       
 -- from Professor 
 -- inner join OfficeHour on Professor.Prof_ID = OfficeHour.Prof_ID
 -- order by Professor.LastName;
 
