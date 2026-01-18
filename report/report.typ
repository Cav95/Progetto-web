#set page(
  paper: "a4",
  numbering: "1"
)

#set document(
  author: ("Mattia Cavina", "Matteo Grandini"),
  title: [
    Relazione progetto di Tecnologie Web \
    "Unibo Pet Therapy"
  ]
)

#set par(
  justify: true
)

#set text(
  size: 14pt
)

// #set list(marker: (sym.bullet, [◦]))

#show title: set align(center)
#show title: set text(size: 25pt)

#show link: underline

#page(align(center + horizon)[
  #set text(size: 15pt)

  #title()
  #v(1cm)
  #grid(
    columns: (1fr, 1fr),
    align(center)[
      *Mattia Cavina* \
      #link("mailto:mattia.cavina2@studio.unibo.it")
    ],
    align(center)[
      *Matteo Grandini* \
      #link("mailto:matteo.grandini@studio.unibo.it")
    ],
  )
])

= Obiettivo
Il progetto verteva nella creazione di un app web per un servizio rivolto agli studenti dell’Università di Bologna. In particolare, abbiamo deciso di realizzare una piattaforma per la gestione di sedute di Pet-Therapy, in quanto permettono di aiutare sia per gli studenti in periodo di esami che per studenti fuori sede che potrebbero non aver instaurato legami.

= Tipologia utenti e operazioni dedicate
Esistono tre classi di utenti, ciascuna con a disposizione diverse funzionalità. Ogni livello di autorizzazione ha accesso anche alle funzionalità dei livelli più bassi.

- *Utente non registrato* (Livello 0)
  - Visualizzare i Pet
  - Registrarsi
- *Utente registrato* (Livello 1)
  - Accedere al proprio account
  - Prenotare sessioni
  - Disdire sessioni prenotate
  - Modificare la propria password
- *Admin* (Livello 2)
  - Aggiungere nuovi Pet
  - Modificare ed Eliminare Pet
  - Bannare un _Utente registrato_
  - Visualizzare tutte le prenotazioni degli _Utenti registrati_
  - Eliminare le prenotazioni degli _Utenti registrati_

= Design, Usabilità e User Experience
Sono state prese tutte le precauzioni e le decisioni necessarie per creare un’interfaccia utente che fosse intuitiva e accessibile. Alcuni esempi includono:

- Creazione di interfacce che non richiedano conoscenze pregresse sul funzionamento dell’applicativo
- Tutti i tag *\<img\>* hanno un attributo _alt_
- Tutti i tag *\<input\>* hanno un tag *\<label\>* corrispondente
- Sono stati utilizzati i parametri *aria-\** (_Accessible Rich Internet Applications_)
- Sono stati verificati i contrasti dei colori
- E tanto altro ancora