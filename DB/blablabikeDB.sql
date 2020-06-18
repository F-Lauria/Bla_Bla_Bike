CREATE DATABASE Bla_bla_bike;
USE Bla_bla_bike;




CREATE TABLE Utente (
  ID_Utente int(10) NOT NULL,
  Nome_Utente varchar (30) UNIQUE,
  Password varchar (30) NOT NULL,
  PRIMARY KEY (ID_Utente),
  UNIQUE (Nome_Utente)
);

CREATE TABLE FiltroUscita(
  ID_FiltroUscita int(10) NOT NULL,
  Utente int(10) NOT NULL,
  Durata int(4) NOT NULL,
  Livello_di_difficolta enum('basso','medio','alto') NOT NULL,
  Tipo_Uscita enum('corsa', 'mountain bike') NOT NULL,
  Luogo varchar(30) NOT NULL,
  PRIMARY KEY (ID_FiltroUscita),
  INDEX (Utente),
  FOREIGN KEY (Utente) REFERENCES Utente (ID_Utente) ON DELETE CASCADE
);


CREATE TABLE FiltroAnnuncio(
  ID_FiltroAnnuncio int(10) NOT NULL,
  Utente int(10) NOT NULL,
  Marca varchar(30) NOT NULL,
  Colore varchar(10)NOT NULL,
  Prezzo int(6) NOT NULL,
  PRIMARY KEY (ID_FiltroAnnuncio),
  INDEX (Utente),
  FOREIGN KEY (Utente) REFERENCES Utente (ID_Utente) ON DELETE CASCADE
);


CREATE TABLE Profilo(
  ID_Utente  int(10) NOT NULL,
  Nome varchar (30) NOT NULL,
  Cognome varchar (30) NOT NULL,
  Data_Nascita date NOT NULL,
  Luogo_Nascita varchar (30) NOT NULL,
  Citta varchar (30) NOT NULL,
  E_mail varchar (30) UNIQUE NOT NULL,
  Sesso varchar (10) NOT NULL,
  Numero_Followers int(10),
  Tipo_Profilo enum('esperto','amatore') NOT NULL,
  PRIMARY KEY (ID_Utente),
  INDEX(ID_Utente),
  FOREIGN KEY (ID_Utente) REFERENCES Utente (ID_Utente) ON DELETE CASCADE
);

CREATE TABLE Segue (
  Seguace int(10) NOT NULL,
  Seguito int(10) NOT NULL,
  Data date,
  PRIMARY KEY (Seguace,Seguito),
  INDEX(Seguace),
  FOREIGN KEY (Seguace) REFERENCES Utente (ID_Utente) ON DELETE CASCADE,
  INDEX(Seguito),
  FOREIGN KEY (Seguito) REFERENCES Utente (ID_Utente)
);

CREATE TABLE Bicicletta(
  ID_Bike int(10) NOT NULL,
  Proprietario int(10) NOT NULL,
  Marca varchar(30) NOT NULL,
  Colore varchar(10)NOT NULL,
  Anno_Produzione int(4),
  Anno_Acquisto int(4),
  Tipo_Bicicletta enum('corsa', 'mountain bike') NOT NULL,
  Peso float(5,1),
  Dimensione_Ruote enum('26','27.5','29'),
  PRIMARY KEY (ID_Bike),
  INDEX(Proprietario),
  FOREIGN KEY (Proprietario) REFERENCES Utente (ID_Utente) ON DELETE CASCADE
);

CREATE TABLE Uscita (
  ID_Uscita int(10) NOT NULL,
  Organizzatore int(10) NOT NULL,
  Titolo text NOT NULL,
  Tipo_Uscita enum('corsa', 'mountain bike') NOT NULL,
  Livello_di_difficolta enum('basso','medio','alto') NOT NULL,
  Livello_di_visibilita enum('privata','pubblica') NOT NULL DEFAULT 'pubblica',
  Durata int(4) NOT NULL,
  Distanza int(3) NOT NULL,
  Dislivello int(4) NOT NULL,
  Ora time NOT NULL,
  Data date NOT NULL,
  Luogo varchar(50) NOT NULL,
  Valutazione enum('0','1','2','3','4','5'),
  Note text,
  PRIMARY KEY (ID_Uscita),
  INDEX (Organizzatore),
  FOREIGN KEY (Organizzatore) REFERENCES Utente (ID_Utente) ON DELETE CASCADE
);

CREATE TABLE Tappa(
	Numero_Progressivo int(3) NOT NULL,
	ID_Uscita int(10) NOT NULL,
	Lunghezza int(4) NOT NULL,
	Tipo_Tappa enum('salita','discesa','pianeggiante') NOT NULL,
	PRIMARY KEY(Numero_Progressivo, ID_Uscita),
	INDEX(ID_Uscita),
	FOREIGN KEY(ID_Uscita) REFERENCES Uscita(ID_Uscita) ON DELETE CASCADE
);

CREATE TABLE Partecipanti(
	ID_Utente int(10) NOT NULL,
	ID_Uscita int(10) NOT NULL,
	ID_Bike int(10) NOT NULL,
  Validita enum('SI','NO') NOT NULL default 'NO',
	PRIMARY KEY(ID_Utente, ID_Uscita, ID_Bike),
	INDEX (ID_Utente),
	FOREIGN KEY(ID_Utente) REFERENCES Utente(ID_Utente) ON DELETE CASCADE,
	INDEX (ID_Utente),
	FOREIGN KEY(ID_Uscita) REFERENCES Uscita(ID_Uscita) ON DELETE CASCADE,
	FOREIGN KEY(ID_Bike) REFERENCES Bicicletta(ID_Bike)
);

CREATE TABLE Annuncio(
	ID_Annuncio int(10) NOT NULL,
	Venditore int(10) NOT NULL,
	Bicicletta int(10) NOT NULL,
	Titolo text NOT NULL,
	Prezzo int(6) NOT NULL,
	Descrizione text,
	Stato enum('In vendita', 'Venduta') NOT NULL DEFAULT 'In vendita',
	Data_Vendita date,
	PRIMARY KEY(ID_Annuncio),
	INDEX(Venditore),
	FOREIGN KEY(Venditore) REFERENCES Utente(ID_Utente) ON DELETE CASCADE,
	INDEX(Bicicletta),
	FOREIGN KEY(Bicicletta) REFERENCES Bicicletta(ID_Bike) ON DELETE CASCADE
);

CREATE TABLE Commento(
	ID_Commento int(10) NOT NULL,
	Commentatore int(10) NOT NULL,
	Annuncio int(10) NOT NULL,
	Data date NOT NULL,
	Ora time NOT NULL,
	Testo text NOT NULL,
	PRIMARY KEY (ID_Commento),
	INDEX(Commentatore),
	FOREIGN KEY(Commentatore) REFERENCES Utente(ID_Utente) ON DELETE CASCADE,
	INDEX(Annuncio),
	FOREIGN KEY(Annuncio) REFERENCES Annuncio(ID_Annuncio) ON DELETE CASCADE
);
