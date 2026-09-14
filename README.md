# Kolokolo

Site web principal de l’agence digitale Kolokolo (Dakar).  
Application **Node.js + Express + MySQL** — pas d’étape de build.

## Prérequis

- Node.js 18 ou supérieur
- MySQL

## Installation locale

```bash
npm install
cp .env.example .env   # puis renseigner DB / SMTP / secrets
```

Créer la base MySQL (`utf8mb4`), puis :

```bash
npm run migrate
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
| `npm start` | Démarre le serveur Express |
| `npm run dev` | Mode watch |
| `npm run migrate` | Migrations Knex |

## Déploiement (Hostinger)

Voir **[DEPLOY.md](./DEPLOY.md)**.

En résumé : app Node.js, fichier de démarrage `src/app.js`, `npm start`. Aucun build / aucun `dist/`.

## Pages

| URL | Description |
| --- | --- |
| `/` | Accueil |
| `/coming` | Page maintenance / coming soon |
| `/admin` | Back-office (après `/auth`) |
