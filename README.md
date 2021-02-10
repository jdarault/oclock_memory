# oclock_memory

## Installation en local
1. Récupérer / Installer composer : [Site composer.org](https://getcomposer.org/download/)
2. Renseigner la constante DATABASE_URL avec vos paramètres dans le fichier _.env_
3. Installer les dépendances
```text
php composer.phar install
```
4. Mettre à jour la base de données
```text
php bin/console doctrine:schema:update --force
```

## Installation sur un serveur de test
1. Dupliquer le fichier _.env_ en _.env.test_
2. Renseigner la constante DATABASE_URL avec vos paramètres dans le fichier _.env.test_
3. Installer les dépendances
```text
php composer.phar install
```
4. Lancer le script _deploy_recette.sh_