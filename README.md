# 🚀 API RESTful per Gestione Prodotti e Ordini con Riduzione CO₂

---

## 📋 Descrizione Generale

Questa applicazione implementa un set di **API RESTful** per la gestione di prodotti e ordini di vendita, focalizzandosi sulla **misurazione e visualizzazione della CO₂ risparmiata** grazie alla vendita di prodotti eco-sostenibili.

Le API permettono di:

- Gestire prodotti con attributi: **nome** e **CO₂ risparmiata**
- Gestire ordini di vendita con: **data di vendita**, **paese di destinazione**, e prodotti con relative quantità
- Visualizzare il **totale della CO₂ risparmiata**, con possibilità di filtrare per intervalli temporali, paese e prodotto

---

## ⚙️ Specifiche API REST

Le API seguono rigorosamente l'architettura RESTful, utilizzando i seguenti principi:

### Architettura delle API

- **Naming**: Le risorse sono nominate in modo chiaro e intuitivo.
- **Metodi**: Utilizzo dei metodi HTTP standard:
  - `GET` per recuperare dati
  - `POST` per creare nuove risorse
  - `PUT` per aggiornare risorse esistenti
  - `DELETE` per rimuovere risorse
- **Status Code**: Utilizzo di codici di stato HTTP appropriati per le risposte.

### Risorse API

#### Prodotti

- **Inserimento di un prodotto**
  - **Endpoint**: `POST /api/prodotti`
  - **Body**: 
    ```json
    { "nome": "NomeProdotto", "co2_risparmiata": 10 }
    ```

- **Modifica di un prodotto**
  - **Endpoint**: `PUT /api/prodotti/{id}`
  - **Body**: 
    ```json
    { "nome": "NomeAggiornato", "co2_risparmiata": 15 }
    ```

- **Cancellazione di un prodotto**
  - **Endpoint**: `DELETE /api/prodotti/{id}`

#### Ordini

- **Inserimento di un ordine**
  - **Endpoint**: `POST /api/ordini`
  - **Body**: 
    ```json
    { "data_vendita": "2023-01-01", "paese_destinazione": "Italia", "prodotti": [{ "id": 1, "quantita": 2 }] }
    ```

- **Modifica di un ordine**
  - **Endpoint**: `PUT /api/ordini/{id}`
  - **Body**: 
    ```json
    { "data_vendita": "2023-01-02", "paese_destinazione": "Francia", "prodotti": [{ "id": 1, "quantita": 3 }] }
    ```

- **Cancellazione di un ordine**
  - **Endpoint**: `DELETE /api/ordini/{id}`

#### Visualizzazione CO₂ Risparmiata

- **Totale CO₂ risparmiata**
  - **Endpoint**: `GET /api/co2`
  - **Parametri**: 
    ```
    ?data_inizio=2023-01-01&data_fine=2023-12-31&paese=Italia&prodotto=NomeProdotto
    ```

---

## 🗄️ Database

Il progetto utilizza **MySQL** come database per memorizzare le informazioni. È fornito un file `migrations.sql` per ricostruire la struttura del database.

### File `migrations.sql`

Il file `migrations.sql` contiene le istruzioni SQL necessarie per creare le tabelle per i prodotti e gli ordini, inclusi i vincoli e le relazioni necessarie.

---

## 🔒 Sicurezza

Tutte le query al database sono sanitizzate per prevenire attacchi di tipo SQL Injection. È richiesto l'uso di **PDO (PHP Data Objects)** per gestire le interazioni con il database in modo sicuro.

---

## 📦 Installazione

1. Clona il repository:
   ```bash
   git clone <repository-url>
