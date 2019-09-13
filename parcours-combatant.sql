#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: status
#------------------------------------------------------------

CREATE TABLE status(
        id_role  Int  Auto_increment  NOT NULL ,
        nom_role Varchar (50) NOT NULL
	,CONSTRAINT status_PK PRIMARY KEY (id_role)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: soldat
#------------------------------------------------------------

CREATE TABLE soldat(
        id_soldat Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL ,
        prenom    Varchar (50) NOT NULL ,
        email     Varchar (50) NOT NULL ,
        grade     Varchar (50) NOT NULL ,
        matricule Varchar (50) NOT NULL ,
        id_role   Int NOT NULL
	,CONSTRAINT soldat_AK UNIQUE (matricule)
	,CONSTRAINT soldat_PK PRIMARY KEY (id_soldat)

	,CONSTRAINT soldat_status_FK FOREIGN KEY (id_role) REFERENCES status(id_role)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: parcours
#------------------------------------------------------------

CREATE TABLE parcours(
        id_parcours  Int  Auto_increment  NOT NULL ,
        nom_parcours Varchar (50) NOT NULL
	,CONSTRAINT parcours_AK UNIQUE (nom_parcours)
	,CONSTRAINT parcours_PK PRIMARY KEY (id_parcours)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: niveau
#------------------------------------------------------------

CREATE TABLE niveau(
        id_niveau  Int  Auto_increment  NOT NULL ,
        nom_niveau Varchar (50) NOT NULL ,
        bonus      Int NOT NULL
	,CONSTRAINT niveau_PK PRIMARY KEY (id_niveau)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: obstacle
#------------------------------------------------------------

CREATE TABLE obstacle(
        id_obstacle  Int  Auto_increment  NOT NULL ,
        note_min     Float NOT NULL ,
        nom_obstacle Varchar (50) NOT NULL ,
        id_niveau    Int NOT NULL
	,CONSTRAINT obstacle_AK UNIQUE (nom_obstacle)
	,CONSTRAINT obstacle_PK PRIMARY KEY (id_obstacle)

	,CONSTRAINT obstacle_niveau_FK FOREIGN KEY (id_niveau) REFERENCES niveau(id_niveau)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: passage
#------------------------------------------------------------

CREATE TABLE passage(
        id_passage          Int  Auto_increment  NOT NULL ,
        date                Float NOT NULL ,
        note_instructeur    Float NOT NULL ,
        note_finale         Float NOT NULL ,
        note_reel           Float NOT NULL ,
        id_soldat           Int NOT NULL ,
        id_soldat_instruire Int NOT NULL ,
        id_parcours         Int NOT NULL ,
        id_obstacle         Int NOT NULL
	,CONSTRAINT passage_PK PRIMARY KEY (id_passage)

	,CONSTRAINT passage_soldat_FK FOREIGN KEY (id_soldat) REFERENCES soldat(id_soldat)
	,CONSTRAINT passage_soldat0_FK FOREIGN KEY (id_soldat_instruire) REFERENCES soldat(id_soldat)
	,CONSTRAINT passage_parcours1_FK FOREIGN KEY (id_parcours) REFERENCES parcours(id_parcours)
	,CONSTRAINT passage_obstacle2_FK FOREIGN KEY (id_obstacle) REFERENCES obstacle(id_obstacle)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: participer
#------------------------------------------------------------

CREATE TABLE participer(
        id_parcours Int NOT NULL ,
        id_soldat   Int NOT NULL
	,CONSTRAINT participer_PK PRIMARY KEY (id_parcours,id_soldat)

	,CONSTRAINT participer_parcours_FK FOREIGN KEY (id_parcours) REFERENCES parcours(id_parcours)
	,CONSTRAINT participer_soldat0_FK FOREIGN KEY (id_soldat) REFERENCES soldat(id_soldat)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contenir
#------------------------------------------------------------

CREATE TABLE contenir(
        id_obstacle Int NOT NULL ,
        id_parcours Int NOT NULL
	,CONSTRAINT contenir_PK PRIMARY KEY (id_obstacle,id_parcours)

	,CONSTRAINT contenir_obstacle_FK FOREIGN KEY (id_obstacle) REFERENCES obstacle(id_obstacle)
	,CONSTRAINT contenir_parcours0_FK FOREIGN KEY (id_parcours) REFERENCES parcours(id_parcours)
)ENGINE=InnoDB;

