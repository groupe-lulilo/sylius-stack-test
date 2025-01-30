# Sylius Stack Demo

## Starting the project

```bash
docker compose up -d
php bin/console doctrine:migrations:migrate
```

## Create account

1. Accéder à la base de donnée et ajouter un user dans la table de ce nom
2. Pour ce qui est du role il faut cette valeur avec ces côtes car c'est le format `["ROLE_ADMIN"]`
3. Faire la commande : `php bin/console security:hash-password <password>`
4. Ajouter votre compte et connecter vous
