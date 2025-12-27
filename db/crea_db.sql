-- Database Section
-- ________________ 

drop database if exists Unibo_Pet_Therapy;
create database Unibo_Pet_Therapy;
use Unibo_Pet_Therapy;

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

-- Popolamento tabelle

INSERT INTO Utenti (E_Mail, Nome, Cognome, Immagine, Password, Bannato, Admin) VALUES
('mattia.cavina2@studio.unibo.it', 'Mattia', 'Cavina', 'upload/profile/mattia.png', 'password123', false, true),
('matteo.grandini@studio.unibo.it', 'Matteo', 'Grandini', 'upload/profile/matteo.png', 'password123', false, true),
('luca@gmail.com', 'Luca', 'Verdi', 'upload/profile/luca.jpg', 'password123', false, false),
('alice@gmail.com', 'Alice', 'Rossi', 'upload/profile/alice.jpg', 'password123', false, false);
     
INSERT INTO Specie (Nome) VALUES
('Cane'),
('Gatto');

INSERT INTO Razze (Nome, ID_Specie) VALUES
('Labrador', 1),
('Barboncino', 1),
('Siamese', 2),
('Persiano', 2);

INSERT INTO Stanze (Numero, Piano, Capienza) VALUES
('A101', 1, 2),
('B201', 2, 3),
('C301', 3, 1);

INSERT INTO Curiosita (Titolo, Descrizione) VALUES
('Benefici della Pet Therapy', 'La pet therapy aiuta a ridurre stress e ansia in pazienti di tutte le età.'),
('Addestramento Base', 'I nostri pet sono addestrati per interagire in modo sicuro con gli utenti.'),
('Visite Programmate', 'Le visite si svolgono su prenotazione nelle stanze dedicate.');

INSERT INTO Pet (Nome, DataDiNascita, Descrizione, Immagine, DescrizioneImmagine, Disponibile, ID_Razza) VALUES
('Fido', '2019-06-01', 'Cane adulto di taglia media, pelo corto e sguardo vivace', 'upload/pet/dog_1.jpg', 'Cane seduto con lingua fuori', 1, 1),
('Rocky', '2020-03-12', 'Cane di piccola taglia con pelo riccio, molto affettuoso', 'upload/pet/dog_2.jpg', 'Cane di piccola taglia in primo piano', 1, 2),
('Max', '2017-10-05', 'Cane più anziano, tranquillo e adatto a terapie', 'upload/pet/dog_3.jpg', 'Cane sdraiato e rilassato', 0, 1),
('Timmy', '2021-01-20', 'Gatto giovane, pelo tigrato, curioso e vivace', 'upload/pet/cat_1.jpg', 'Gatto tigrato che osserva', 1, 3),
('Micia', '2018-08-14', 'Gatta dal pelo lungo, elegante e calma', 'upload/pet/cat_2.jpg', 'Gatta dal pelo lungo seduta', 1, 4),
('Lulu', '2022-02-28', 'Gatto molto socievole e giocherellone', 'upload/pet/cat_3.jpg', 'Gatto in posizione di gioco', 1, 3),
('Lui', '2020-11-11', 'Gatto calmo e affettuoso, adatto alle visite', 'upload/pet/cat_4.jpg', 'Gatto disteso su un cuscino', 1, 4);

INSERT INTO Prenotazioni (Data, Ora, Utente, Stanza) VALUES
('2025-12-01', '10:00:00', 'luca@gmail.com', 'A101'),
('2025-12-02', '14:30:00', 'alice@gmail.com', 'B201');