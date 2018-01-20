Project : PIMP MY CAR
	(garage d'entretien de motos et d'automobiles) 	

- Event
- prestation
- vehicule
- date
- document
- user
- calendar
- cart

1/ Event : 
Un event est constitué d'un vehicule, d'une prestation, d'une date

2/ prestation :
Une prestation est constituée d'une action et d'une equipe

3/ Vehicule : 
Un Vehicule est constitué d'une voiture ou d'une moto

4/ Date : 
Une date est constituée d'une année, d'un mois ,d'un jour, d'une heure

5/ Document
Un event est constitué de pieces justificatifs ou d'un bon de commande ou d'un rapport ou d'une facture 

6/ User : 
Un user est constitué d'un prestataire dans une equipe ou d'un client

7/ Calendar
Un calendar est constitué d'events


Bundle : 
- CoreBundle
- UserBundle
- PrestationBundle
- ProductBundle
- OrderBundle



Entity : 
- Date
    - created_at
    - updated_at
    
- Action : 
    - name
    - price
    - category (esthetic, maintenance, customizing)
    
    

