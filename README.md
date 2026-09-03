# Kolokolo

Site web principal de l’agence digitale Kolokolo (Dakar).

## Prérequis

- Node.js 18 ou supérieur
- MySQL

## Installation

```bash
npm install
cp .env.example .env   # puis renseigner DB / SMTP / secrets
```

Créer la base MySQL (`utf8mb4`), puis :

```bash
npm run migrate   # optionnel : aussi au démarrage
npm run build
npm start
```

Le site est disponible sur [http://localhost:3000](http://localhost:3000).

En développement :

```bash
npm run dev
```

## Scripts

| Commande | Description |
| --- | --- |
| `npm run build` | Compile le SCSS et vérifie l’app (étape CI / Hostinger) |
| `npm start` | Démarre le serveur Express |
| `npm run dev` | Mode watch |
| `npm run migrate` | Migrations Knex |

## Déploiement (Hostinger)

Voir **[DEPLOY.md](./DEPLOY.md)**.

Résumé : l’app est **Node.js** (Express). Sur Hostinger, utiliser un site **Node.js Web App** branché sur la branche `production`. Un push sur `main` lance le build GitHub, puis met à jour `production` pour déclencher le webhook Hostinger.

## Pages

| URL | Description |
| --- | --- |
| `/` | Accueil |
| `/coming` | Page maintenance / coming soon |
| `/admin` | Back-office (après `/auth`) |
