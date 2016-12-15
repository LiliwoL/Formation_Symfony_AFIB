
#Symfony FormationAFIB Décembre 2016


## Branche master




## Sous Branches:
### DataFixtures
### Formulaires
### Security






## Pour récupérer un projet depuis GIT

1. git clone
2. composer update

**Création de la base**
3. php bin/console doctrine:database:create --connecton=geo
4. php bin/console doctrine:database:create --connecton=biblio

**Mise à jour du schéma**
5. php bin/console doctrine:schema:update --em=geo
6. php bin/console doctrine:schema:update --em=biblio

**Ajout des DataFixtures (cf. branche DataFixtures)**

