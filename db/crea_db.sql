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

CREATE TABLE Orari (
    Orario time NOT NULL,
    constraint PK_Orari primary key (Orario)
);

alter table Utenti
add constraint Unique_Mail unique key Email (Email);

alter table Pet
add constraint FK_Razza foreign key (ID_Razza) references Razze (ID_Razza);

alter table Prenotazioni
add constraint FK_Utente foreign key (Utente) references Utenti (ID_Utente);

alter table Prenotazioni
add constraint FK_Luogo foreign key (Luogo) references Luoghi (Codice);

alter table Prenotazioni
add constraint Unique_TimeSlot unique key (Data, Ora);

alter table Razze
add constraint FK_Specie foreign key (ID_Specie) references Specie (ID_Specie);

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

INSERT INTO Luoghi (Codice, Nome, Piano, Capienza)
VALUES ('A101', 'Aula 1.1', 1, 2),
    ('A201', 'Aula 2.1', 2, 3),
    ('C001', 'Cortile interno', 0, 10);

INSERT INTO Curiosita (Titolo, Descrizione)
VALUES ('I gatti hanno sviluppato il "miagolio" per noi','I gattini miagolano per attirare l attenzione della madre, ma i gatti adulti selvatici raramente miagolano tra loro (comunicano principalmente tramite odori, feromoni e linguaggio del corpo)..'),
('Importanza della Socializzazione','La socializzazione tra pet e utenti è cruciale per ottenere benefici terapeutici.'),
('Il naso del cane','Sapevi che il naso di un cane è unico, proprio come l impronta digitale di un essere umano? Se osservi da vicino il tartufo (il naso) del tuo cane, vedrai una serie di creste e fessure.'),
('L''olfatto dei cani', 'I cani hanno un senso dell''olfatto fino a 100.000 volte più acuto di quello umano. Possono persino rilevare alcune malattie umane o variazioni di zucchero nel sangue semplicemente annusando.'),
('Le fusa dei gatti', 'Un gatto non fa le fusa solo quando è felice. Può farlo anche per calmarsi o per autoguarirsi: la frequenza delle fusa (25-150 Hz) aiuta a migliorare la densità ossea e a riparare i tendini.'),
('Sogni canini', 'Anche i cani sognano! Se vedi il tuo cane muovere le zampe o emettere piccoli versi mentre dorme, probabilmente si trova nella fase REM e sta rivivendo la sua giornata.'),
('Le orecchie dei gatti', 'I gatti hanno 32 muscoli in ogni orecchio, che permettono loro di ruotarle di 180 gradi in modo indipendente per localizzare con precisione millimetrica l''origine di un rumore.'),
('Sudorazione canina', 'I cani non sudano come noi. Le loro uniche ghiandole sudoripare si trovano nei polpastrelli delle zampe. Per rinfrescarsi, utilizzano principalmente il respiro affannoso (ansimare).'),
('Visione notturna felina', 'I gatti non vedono nel buio totale, ma hanno bisogno solo di un sesto della luce necessaria agli umani per vedere chiaramente, grazie al "tapetum lucidum" che riflette la luce.'),
('L''intelligenza dei cani', 'In media, un cane adulto ha l''intelligenza di un bambino di due anni e può imparare circa 165 parole, inclusi segnali e gesti.'),
('Gatti e acqua', 'Alcune razze di gatti, come il Turco Van o il Maine Coon, amano l''acqua e sono ottimi nuotatori. Molti gatti domestici ne sono invece intimoriti perché il pelo bagnato è pesante.'),
('Il salto del gatto', 'Un gatto in salute può saltare fino a sei volte la sua altezza in un solo balzo grazie ai potenti muscoli delle zampe posteriori.'),
('La coda dei cani', 'La coda non serve solo per esprimere felicità. È fondamentale per l''equilibrio durante la corsa e funge da timone quando il cane nuota.'),
('Impronte feline', 'Proprio come i cani, anche i gatti hanno un''impronta del naso unica e irripetibile, che potrebbe essere usata per identificarli con certezza.'),
('Cani e pioggia', 'Molti cani non amano uscire sotto la pioggia non perché temano l''acqua, ma perché il suono amplificato delle gocce può risultare fastidioso per le loro orecchie sensibili.'),
('Gatti e sapore dolce', 'I gatti sono tra i pochi mammiferi che non possiedono i recettori del gusto per il dolce. Per loro, lo zucchero non ha alcun sapore.'),
('La velocità del Greyhound', 'Il Greyhound è il cane più veloce al mondo: può raggiungere i 70 km/h in pochi secondi, superando in accelerazione persino una Ferrari.'),
('Gatti e scatole', 'I gatti amano le scatole perché offrono un senso di sicurezza e protezione. In uno spazio ristretto, si sentono al riparo dai predatori e meno stressati.'),
('Cani e TV', 'I cani oggi possono vedere la TV grazie agli schermi moderni ad alta frequenza. Preferiscono programmi con altri animali e immagini in movimento rapido.'),
('La lingua dei gatti', 'La lingua del gatto è ricoperta di piccole papille di cheratina simili a ganci. Servono per pulirsi meticolosamente e per rimuovere la carne dalle ossa delle prede.'),
('L''udito del cane', 'I cani possono sentire frequenze ultrasoniche che gli umani non percepiscono. Possono sentire il rumore della pioggia a chilometri di distanza.'),
('Gatti "mancini"', 'Studi suggeriscono che i gatti maschi tendano a usare di più la zampa sinistra, mentre le femmine preferiscono la destra.'),
('Cani e tempo', 'I cani percepiscono il passare del tempo. Sanno distinguere tra un''assenza di un''ora e una di cinque ore grazie al decadimento degli odori in casa.'),
('Lo stretching felino', 'I gatti si stirano costantemente per mantenere i muscoli flessibili e riattivare la circolazione dopo i loro lunghi sonnellini (che durano 12-16 ore al giorno).'),
('Bacio canino', 'Quando un cane ti lecca, non ti sta solo dando un "bacio". È un segno di sottomissione, affetto e un modo per raccogliere informazioni biochimiche su di te.'),
('Gatti e cadute', 'I gatti hanno un "riflesso di raddrizzamento" che permette loro di girarsi in aria durante una caduta per atterrare sulle zampe, grazie a una colonna vertebrale flessibile.'),
('Il terzo occhio', 'Sia i cani che i gatti hanno una terza palpebra chiamata "membrana nittitante" che serve a proteggere l''occhio e a mantenerlo idratato.'),
('Baffi non solo sul muso', 'I gatti hanno vibrisse (baffi) non solo sul muso, ma anche sul retro delle zampe anteriori per percepire meglio le prede in movimento.'),
('Cani e empatia', 'I cani sono gli unici animali che cercano lo sguardo dell''uomo per conforto e collaborazione, un comportamento evolutosi in millenni di convivenza.'),
('Gatti e lattosio', 'Nonostante l''immagine classica, molti gatti adulti sono intolleranti al lattosio. Dare loro il latte vaccino può causare seri problemi digestivi.'),
('La potenza del morso', 'Il Pastore Tedesco ha una pressione del morso di circa 108 kg, sufficiente a rompere ossa resistenti, ma può essere delicatissimo con i cuccioli.'),
('Gatti e territori', 'I gatti strofinano il muso contro mobili e persone per marcare il territorio con le ghiandole odorifere situate sulle guance.'),
('Cani e sbadigli', 'Lo sbadiglio nel cane non indica solo sonno. Spesso è un "segnale di calma" usato per scaricare lo stress o per tranquillizzare altri cani e umani.');

INSERT INTO Specie (Nomespecie)
VALUES ('Cane'),
    ('Gatto'),
    ('Sconosciuta');

INSERT INTO Razze (Nomerazza, ID_Specie)
VALUES ('Carlino', 1),
    ('Barboncino', 1),
    ('Golden Retriever', 1),
    ('Europeo', 2),
    ('Soriano', 2),
    ('British Shorthair', 2),
    ("Bengala", 2),
    ("Sconosciuta", 3);

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
        'Cane adulto tranquillo, ma che ama giocare',
        'fido.jpg',
        'Cane di razza carlino, seduto con lingua fuori',
        1,
        1
    ),
    (
        'Rocky',
        '2020-03-12',
        'Bellissimo cane, estremamente affettuoso e giocherellone',
        'rocky.jpg',
        'Cane di razza golden retriever con la lingua fuori',
        1,
        3
    ),
    (
        'Coco',
        '2017-10-05',
        'Cane anziano, tranquillo e che fa molta compagnia',
        'coco.jpg',
        'Cane di razza barboncino dallo sguardo dolce',
        0,
        2
    ),
    (
        'Felix',
        '2021-01-20',
        'Gatto giovane e vivace che adora le coccole',
        'felix.jpg',
        'Gatto domestico con mantello tuxedo che guarda in alto',
        1,
        4
    ),
    (
        'Micia',
        '2018-08-14',
        'Gatta dal bellissimo pelo fulvo, molto affettuosa',
        'micia.jpg',
        'Gatta soriana dal pelo fulvo seduta con lo sguardo rivolto in camera',
        1,
        5
    ),
    (
        'Max',
        '2022-02-28',
        'Gatto tranquillo e riservato, ma non dice di no a qualche gioco',
        'max.jpg',
        'Gatto in posizione a sfinge sul letto, con lo sguardo perso',
        1,
        6
    ),
    (
        'Luis',
        '2020-11-11',
        'Gatto estremamente vivace, difficile da stancare',
        'luis.jpg',
        'Gatto bengala con lo sguardo fisso verso il soffitto',
        1,
        7
    ),
    (
        'Vittoryo',
        '1964-12-21',
        "Non ne sappiamo molto... ma è molto simpatico, anche se a volte un po' volgare",
        'ghini.jpg',
        'Professor Vittorio Ghini in una posa di sorpresa',
        1,
        8
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
        '15:00:00',
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
        '09:00:00',
        3,
        'C001'
    ),
    (
        '2026-01-20',
        '10:00:00',
        4,
        'C001'
    );

INSERT INTO Orari (Orario)
VALUES ('09:00:00'),
    ('10:00:00'),
    ('11:00:00'),
    ('12:00:00'),
    ('13:00:00'),
    ('14:00:00'),
    ('15:00:00'),
    ('16:00:00'),
    ('17:00:00');