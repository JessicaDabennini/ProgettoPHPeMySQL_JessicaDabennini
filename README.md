Descrizione del Progetto
Questo progetto implementa un'API RESTful per gestire prodotti e ordini di vendita, con un focus sulla riduzione delle emissioni di CO2. Le API consentono di inserire, modificare e cancellare prodotti e ordini, nonché di visualizzare il totale della CO2 risparmiata.

Architettura delle API
Le API seguono l'architettura REST e rispettano i seguenti principi:

Naming: Le risorse sono nominate in modo chiaro e intuitivo.
Metodi: Utilizzo dei metodi HTTP standard:
GET per recuperare dati
POST per creare nuove risorse
PUT per aggiornare risorse esistenti
DELETE per rimuovere risorse
Status Code: Utilizzo di codici di stato HTTP appropriati per le risposte.
Risorse API
Prodotti
Inserimento di un prodotto
Endpoint: POST /api/prodotti
Body: { "nome": "NomeProdotto", "co2_risparmiata": 10 }
Modifica di un prodotto
Endpoint: PUT /api/prodotti/{id}
Body: { "nome": "NomeAggiornato", "co2_risparmiata": 15 }
Cancellazione di un prodotto
Endpoint: DELETE /api/prodotti/{id}
Ordini
Inserimento di un ordine
Endpoint: POST /api/ordini
Body: { "data_vendita": "2023-01-01", "paese_destinazione": "Italia", "prodotti": [{ "id": 1, "quantita": 2 }] }
Modifica di un ordine
Endpoint: PUT /api/ordini/{id}
Body: { "data_vendita": "2023-01-02", "paese_destinazione": "Francia", "prodotti": [{ "id": 1, "quantita": 3 }] }
Cancellazione di un ordine
Endpoint: DELETE /api/ordini/{id}
Visualizzazione CO2 Risparmiata
Totale CO2 risparmiata
Endpoint: GET /api/co2
Parametri: ?data_inizio=2023-01-01&data_fine=2023-12-31&paese=Italia&prodotto=NomeProdotto
Database
Il progetto utilizza MySQL come database per memorizzare le informazioni. È fornito un file migrations.sql per ricostruire la struttura del database.

File migrations.sql
Il file migrations.sql contiene le istruzioni SQL necessarie per creare le tabelle per i prodotti e gli ordini, inclusi i vincoli e le relazioni necessarie.

Sicurezza
Tutte le query al database sono sanitizzate per prevenire attacchi di tipo SQL Injection. È richiesto l'uso di PDO (PHP Data Objects) per gestire le interazioni con il database in modo sicuro.
