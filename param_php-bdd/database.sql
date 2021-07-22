#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------
CREATE TABLE Utilisateur(
        Id_User    Int NOT NULL ,
        Pseudo     Varchar (50) NOT NULL ,
        Mail       Varchar (50) NOT NULL ,
        MotDePasse Varchar (50) NOT NULL
	,CONSTRAINT Utilisateur_PK PRIMARY KEY (Id_User)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MessageEnDirect
#------------------------------------------------------------

CREATE TABLE MessageEnDirect(
        Id_MessageEnDirect Int NOT NULL ,
        DataChatDirect     Varchar (300) NOT NULL ,
        Time               Time NOT NULL ,
        Date               Date NOT NULL ,
        Id_User            Int NOT NULL
	,CONSTRAINT MessageEnDirect_PK PRIMARY KEY (Id_MessageEnDirect)

	,CONSTRAINT MessageEnDirect_Utilisateur_FK FOREIGN KEY (Id_User) REFERENCES Utilisateur(Id_User)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PropositionRadio
#------------------------------------------------------------

CREATE TABLE PropositionRadio(
        Id_PropositionRadio Int NOT NULL ,
        NomRadioProposer    Varchar (100) NOT NULL ,
        DateAjoutRadio      Date NOT NULL ,
        Id_User             Int NOT NULL
	,CONSTRAINT PropositionRadio_PK PRIMARY KEY (Id_PropositionRadio)

	,CONSTRAINT PropositionRadio_Utilisateur_FK FOREIGN KEY (Id_User) REFERENCES Utilisateur(Id_User)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Categorie
#------------------------------------------------------------

CREATE TABLE Categorie(
        Id_Categorie Varchar (200) NOT NULL
	,CONSTRAINT Categorie_PK PRIMARY KEY (Id_Categorie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Radio
#------------------------------------------------------------

CREATE TABLE Radio(
        Id_Radio         Int NOT NULL ,
        UrlRadio         Varchar (200) NOT NULL ,
        NomRadio         Varchar (100) NOT NULL ,
        DateAjoutRadio   Date NOT NULL ,
        DescriptionRadio Varchar (200) NOT NULL ,
        Id_Categorie     Varchar (200) NOT NULL
	,CONSTRAINT Radio_PK PRIMARY KEY (Id_Radio)

	,CONSTRAINT Radio_Categorie_FK FOREIGN KEY (Id_Categorie) REFERENCES Categorie(Id_Categorie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commenter
#------------------------------------------------------------

CREATE TABLE Commenter(
        Id_Radio        Int NOT NULL ,
        Id_User         Int NOT NULL ,
        DataCommentaire Varchar (300) NOT NULL ,
        Time            Time NOT NULL ,
        Date            Date NOT NULL
	,CONSTRAINT Commenter_PK PRIMARY KEY (Id_Radio,Id_User)

	,CONSTRAINT Commenter_Radio_FK FOREIGN KEY (Id_Radio) REFERENCES Radio(Id_Radio)
	,CONSTRAINT Commenter_Utilisateur0_FK FOREIGN KEY (Id_User) REFERENCES Utilisateur(Id_User)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Liker
#------------------------------------------------------------

CREATE TABLE Liker(
        Id_Radio Int NOT NULL ,
        Id_User  Int NOT NULL
	,CONSTRAINT Liker_PK PRIMARY KEY (Id_Radio,Id_User)

	,CONSTRAINT Liker_Radio_FK FOREIGN KEY (Id_Radio) REFERENCES Radio(Id_Radio)
	,CONSTRAINT Liker_Utilisateur0_FK FOREIGN KEY (Id_User) REFERENCES Utilisateur(Id_User)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MettreEnFavoris
#------------------------------------------------------------

CREATE TABLE MettreEnFavoris(
        Id_Radio Int NOT NULL ,
        Id_User  Int NOT NULL
	,CONSTRAINT MettreEnFavoris_PK PRIMARY KEY (Id_Radio,Id_User)

	,CONSTRAINT MettreEnFavoris_Radio_FK FOREIGN KEY (Id_Radio) REFERENCES Radio(Id_Radio)
	,CONSTRAINT MettreEnFavoris_Utilisateur0_FK FOREIGN KEY (Id_User) REFERENCES Utilisateur(Id_User)
)ENGINE=InnoDB;

