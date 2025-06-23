# 🚀 API RESTful per Gestione Prodotti e Ordini con Riduzione CO₂

---

## 📋 Descrizione Generale

Questa applicazione implementa un set di **API RESTful** per la gestione di prodotti e ordini di vendita, focalizzandosi sulla **misurazione e visualizzazione della CO₂ risparmiata** grazie alla vendita di prodotti eco-sostenibili.

Le API permettono di:

- Gestire prodotti con attributi: **nome** e **CO₂ risparmiata**
- Gestire ordini di vendita con: **data di vendita**, **paese di destinazione**, e prodotti con relative quantità
- Visualizzare il **totale della CO₂ risparmiata**, con possibilità di filtrare per intervalli temporali, paese e nome del prodotto
- **Counter del totale della CO₂** derivante dalla somma di tutte le vendite.

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

- **leggere la tabella dei prodotti**
- **Endpoint**: `GET /product/readProduct.php`


- **Inserimento di un prodotto**
  - **Endpoint**: `POST /product/createProduct.php`
  - **Body**: 
    ```json
    { "product_name": "NomeProdotto", "co2_saved": 0.5 }
    ```

- **Modifica di un prodotto**
  - **Endpoint**: `PUT /product/updateProduct.php`
  - **Body**: 
    ```json
    { "id": 1,"product_name": "NomeAggiornato", "co2_saved": 0.5 }
    ```

- **Cancellazione di un prodotto**
  - **Endpoint**: `DELETE /product/deleteProduct.php`
   - **Body**: 
    ```json
    { "id": 1 }
    ```

#### Ordini

- **leggere la tabella degli ordini**
- **Endpoint**: `GET /order/readOrder.php`


- **Inserimento di un ordine**
  - **Endpoint**: `POST /order/createOrder.php`
  - **Body**: 
    ```json
    { "sales_date": "2025-01-01", "destination_country": "Italia", "product_id":1, "quantity":23}
    ```

- **Modifica di un ordine**
  - **Endpoint**: `/order/updateOrder.php`
  - **Body**: 
    ```json
    { "sales_date": "nuovaData", "destination_country": "nuovoPaese", "product_id":2, "quantity":22}
    ```

- **Cancellazione di un ordine**
  - **Endpoint**: `DELETE /order/deleteOrder.php`
   - **Body**: 
    ```json
    { "id": 1 }
    ```

#### Visualizzazione CO₂ Risparmiata

- **Counter totale CO₂ risparmiata**
  - **Endpoint**: `GET /product/co2tot_counter.php`

- **Totale CO₂ risparmiata**
  - **Endpoint**: `GET /product/co2.php`
  - **Parametri**: 
    ```
    ?start_date=2023-01-01&end_date=2023-12-31&country=Italia&product=NomeProdotto
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
