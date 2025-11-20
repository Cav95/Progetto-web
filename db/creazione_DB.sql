-- Database Section
-- ________________ 

create database UniboPetTherapy;
use UniboPetTherapy;

-- Tables Section
-- _____________ 

create table Curiosita (
     ID_Curiosita int not null auto_increment,
     Titolo varchar(50) not null,
     Descrizione varchar(300) not null,
     constraint IDCURIOSITA primary key (ID_Curiosita)
);

create table Pet (
     ID_Pet int not null auto_increment,
     Nome varchar(50) not null,
     DataDiNascita date not null,
     Descrizione varchar(300) not null,
     Immagine varchar(255) not null,
     DescrizioneImmagine varchar(300) not null,
     Disponibile boolean not null,
     ID_Razza int not null,
     constraint IDPET primary key (ID_Pet)
);

create table Prenotazioni (
     ID_Prenotazione int not null auto_increment,
     Data date not null,
     Ora time not null,
     Utente varchar(50) not null,
     Stanza varchar(10) not null,
     constraint IDPRENOTAZIONE primary key (ID_Prenotazione)
);

create table Razze (
     ID_Razza int not null auto_increment,
     Nome varchar(50) not null,
     ID_Specie int not null,
     constraint IDRAZZA primary key (ID_Razza)
);

create table Specie (
     ID_Specie int not null auto_increment,
     Nome varchar(50) not null,
     constraint IDSPECIE primary key (ID_Specie)
);

create table Stanze (
     Numero varchar(10) not null,
     Piano int not null,
     Capienza int not null,
     constraint IDSTANZA primary key (Numero)
);

create table Utenti (
     E_Mail varchar(50) not null,
     Nome varchar(50) not null,
     Cognome varchar(50) not null,
     Immagine varchar(255) not null,
     Password varchar(255) not null,
     Bannato boolean not null,
     Admin boolean not null,
     constraint IDUtente primary key (E_Mail)
);


-- Constraints Section
-- ___________________ 

alter table Pet add constraint FKdi
     foreign key (ID_Razza)
     references Razze (ID_Razza);

alter table Prenotazioni add constraint FKesegue
     foreign key (Utente)
     references Utenti (E_Mail);

alter table Prenotazioni add constraint FKin
     foreign key (Stanza)
     references Stanze (Numero);

alter table Razze add constraint FKappartiene
     foreign key (ID_Specie)
     references Specie (ID_Specie);

