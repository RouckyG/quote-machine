#Quote Machine

## Installation

Installation des dépendances PHP avec composer :

```shell
$ composer install
```

Création d'un fichier `.env.local` à partir du fichier `.env` :

```shell
cp .env .env.local
```

Puis modifiez les variables d'environnement du fichier `.env.local` selon votre environnement local.

Création de la base de donnée :

```shell
$ php bin/console doctrine:database:create
```

Création du schéma de base de données en exécutant les migrations :

```shell
$ php bin/console doctrine:migration:migrate
```

Chargement des fixtures :

```shell
$ php bin/console doctrine:fixtures:load
```

pour installer la base de donnée avec migration et fixtures :

```shell
$ composer run db
```
## Développement

Lancement du serveur de développement

```shell
$ php bon/console server:start
```