Project : PIMP MY CAR
	plateforme d'ateliers mecanique multitech (motos, automobiles, car) 
	Multitech mechanical workshop platform (motorcycles, cars, trucks)	

- Event
- prestation
- vehicule
- date
- document
- user
- calendar
- cart / order
- workshop (atelier)

1/ Event : 
Un event est constitué d'un vehicule, d'une prestation et d'un user

2/ prestation :
Une prestation est constituée d'une activité et d'un atelier

3/ Vehicule : 
Un Vehicule est constitué d'une voiture, d'une moto ou d'un car

4/ Date : 
Une date est constituée d'une année, d'un mois ,d'un jour, d'une heure

5/ Document
Un document est constitué de pieces justificatifs ou d'un bon de commande ou d'un rapport ou d'une facture 

6/ User : 
Un user est constitué d'un prestataire dans une equipe ou d'un client

7/ Calendar
Un calendar est constitué d'events et de dates

8/ Workshop :
Un atelier est constitué d'une activité et d'une capacité de contenance


Bundle : 
- CoreBundle
- UserBundle
- EventBundle
- PrestationBundle
- ProductBundle (buildings, vehicules)
- OrderBundle
- MediaBundle (images, videos)



Trait
- DateLog
    - created_at
    - updated_at
    - removed_at


Entity 
- Date :
    - startAt
    - endsAt
    - cancelsAt
    
- Activité : 
    - name
    - price
    - category (esthetic, maintenance, customizing)
    - execution time
    
- Workshop :
    - name
    - activity
    - isAvailable 
    - capacity (small, classic, large)

- Image

- video

