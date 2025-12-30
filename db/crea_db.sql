drop database if exists Unibo_Pet_Therapy;
create database Unibo_Pet_Therapy;
use Unibo_Pet_Therapy;

-- TABLE CREATION
create table Curiosita (
    ID_Curiosita int not null auto_increment,
    Titolo varchar(50) not null,
    Descrizione varchar(300) not null,
    constraint IDCURIOSITA primary key (ID_Curiosita)
);

create table Pet (
    ID_Pet int not null auto_increment,
    Nomepet varchar(50) not null,
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
    Utente INT not null,
    Luogo varchar(10) not null,
    constraint IDPRENOTAZIONE primary key (ID_Prenotazione)
);

create table Razze (
    ID_Razza int not null auto_increment,
    Nomerazza varchar(50) not null,
    ID_Specie int not null,
    constraint IDRAZZA primary key (ID_Razza)
);

create table Specie (
    ID_Specie int not null auto_increment,
    Nomespecie varchar(50) not null,
    constraint IDSPECIE primary key (ID_Specie)
);

create table Luoghi (
    Codice varchar(4) not null,
    Nome varchar(50) not null,
    Piano int not null,
    Capienza int not null,
    constraint IDLUOGO primary key (Codice)
);

create table Utenti (
    ID_Utente INT not null auto_increment,
    Email varchar(50) not null,
    Nome varchar(50) not null,
    Cognome varchar(50) not null,
    Password varchar(255) not null,
    Bannato boolean not null default 0,
    Admin boolean not null default 0,
    constraint IDUtente primary key (ID_Utente)
);

alter table Utenti
add constraint UniqueMail unique key Email (Email);

alter table Pet
add constraint FKdi foreign key (ID_Razza) references Razze (ID_Razza);

alter table Prenotazioni
add constraint FKesegue foreign key (Utente) references Utenti (ID_Utente);

alter table Prenotazioni
add constraint FKin foreign key (Luogo) references Luoghi (Codice);

alter table Razze
add constraint FKappartiene foreign key (ID_Specie) references Specie (ID_Specie);

-- TABLE POPULATION
INSERT INTO Utenti (ID_Utente, Email, Nome, Cognome, Password, Bannato, Admin)
VALUES (
        1,
        'matteo.grandini@studio.unibo.it',
        'Matteo',
        'Grandini',
        '$argon2id$v=19$m=65536,t=4,p=1$eEZndnRnOWNLYkg5Z2pTaQ$5+ICstABNtlqqzg9l/tZwruJaSSs6GEQyiiXaXfgWAU',
        0,
        1
    ),
    (
        2,
        'mattia.cavina2@studio.unibo.it',
        'Mattia',
        'Cavina',
        '$argon2id$v=19$m=65536,t=4,p=1$aGtVTHVSOTd0UzdVbFNjMg$kxiZ2HGQuJaEsbGKlLzFALKfkwSTlNFEWFCvYxQ/vHI',
        0,
        1
    ),
    (
        3,
        'cippa.lippa@studio.unibo.it',
        'Cippa',
        'Lippa',
        '$argon2id$v=19$m=65536,t=4,p=1$LzdyS2JpY1FNWkN3MkJPSA$3fMw2imWe5ZomTwosEpotSUEp3jGsLMTbNRiM4y5e2c',
        0,
        0
    ),
    (
        4,
        'gino.pino@studio.unibo.it',
        'Gino',
        'Pino',
        '$argon2id$v=19$m=65536,t=4,p=1$cEFjV3BoMzJQNjZMY01RdA$WfEEvTo5BDg279iw1C+f2nlRA/CVWtsRBMIkJ5luKOs',
        0,
        0
    );
    

INSERT INTO Specie (Nomespecie)
VALUES ('Cane'),
    ('Gatto');

INSERT INTO Razze (Nomerazza, ID_Specie)
VALUES ('Labrador', 1),
    ('Barboncino', 1),
    ('Siamese', 2),
    ('Persiano', 2);

INSERT INTO Luoghi (Codice, Nome, Piano, Capienza)
VALUES ('A101', 'Aula 1.1', 1, 2),
    ('A201', 'Aula 2.1', 2, 3),
    ('C001', 'Cortile interno', 0, 10);

INSERT INTO Curiosita (Titolo, Descrizione)
VALUES (
        'Benefici della Pet Therapy',
        'La pet therapy aiuta a ridurre stress e ansia in pazienti di tutte le età.'
    ),
    (
        'Addestramento Base',
        'I nostri pet sono addestrati per interagire in modo sicuro con gli utenti.'
    ),
    (
        'Specie Adatte',
        'Cani e gatti sono le specie più comunemente utilizzate nella pet therapy.'
    ),
    (
        'I gatti hanno sviluppato il "miagolio" per noi',
        'I gattini miagolano per attirare l attenzione della madre, ma i gatti adulti selvatici raramente miagolano tra loro (comunicano principalmente tramite odori, feromoni e linguaggio del corpo)..'
    ),
    (
        'Importanza della Socializzazione',
        'La socializzazione tra pet e utenti è cruciale per ottenere benefici terapeutici.'
    ),
    (
        'Il naso del cane',
        'Sapevi che il naso di un cane è unico, proprio come l impronta digitale di un essere umano? Se osservi da vicino il tartufo (il naso) del tuo cane, vedrai una serie di creste e fessure.'
    );

INSERT INTO Pet (
        Nomepet,
        DataDiNascita,
        Descrizione,
        Immagine,
        DescrizioneImmagine,
        Disponibile,
        ID_Razza
    )
VALUES (
        'Fido',
        '2019-06-01',
        'Cane adulto di taglia media, pelo corto e sguardo vivace',
        'dog_1.jpg',
        'Cane seduto con lingua fuori',
        1,
        1
    ),
    (
        'Rocky',
        '2020-03-12',
        'Cane di piccola taglia con pelo riccio, molto affettuoso',
        'dog_2.jpg',
        'Cane di piccola taglia in primo piano',
        1,
        2
    ),
    (
        'Max',
        '2017-10-05',
        'Cane più anziano, tranquillo e adatto a terapie',
        'dog_3.jpg',
        'Cane sdraiato e rilassato',
        0,
        1
    ),
    (
        'Timmy',
        '2021-01-20',
        'Gatto giovane, pelo tigrato, curioso e vivace',
        'cat_1.jpg',
        'Gatto tigrato che osserva',
        1,
        3
    ),
    (
        'Micia',
        '2018-08-14',
        'Gatta dal pelo lungo, elegante e calma',
        'cat_2.jpg',
        'Gatta dal pelo lungo seduta',
        1,
        4
    ),
    (
        'Lulu',
        '2022-02-28',
        'Gatto molto socievole e giocherellone',
        'cat_3.jpg',
        'Gatto in posizione di gioco',
        1,
        3
    ),
    (
        'Lui',
        '2020-11-11',
        'Gatto calmo e affettuoso, adatto alle visite',
        'cat_4.jpg',
        'Gatto disteso su un cuscino',
        1,
        4
    );

INSERT INTO Prenotazioni (Data, Ora, Utente, Luogo)
VALUES (
        '2025-12-01',
        '10:00:00',
        3,
        'A101'
    ),
    (
        '2025-12-02',
        '14:30:00',
        4,
        'A201'
    ),
    (
        '2026-01-12',
        '14:00:00',
        3,
        'A201'
    ),
    (
        '2026-01-15',
        '09:30:00',
        3,
        'C001'
    ),
    (
        '2026-01-20',
        '10:00:00',
        4,
        'C001'
    );