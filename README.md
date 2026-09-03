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
| `npm run build` | Compile le SCSS et exporte le site HTML dans `dist/` |
| `npm start` | Démarre le serveur Express (dev / hébergement Node) |
| `npm run dev` | Mode watch |
| `npm run migrate` | Migrations Knex |

## Déploiement (Hostinger)

Voir **[DEPLOY.md](./DEPLOY.md)**.

Sans Node sur Hostinger : le build produit des **fichiers HTML** dans `dist/`. La branche GitHub `production` (mise à jour par Actions) ne contient que ce build — brancher Hostinger dessus vers `public_html`.

## Pages

| URL | Description |
| --- | --- |
| `/` | Accueil |
| `/coming` | Page maintenance / coming soon |
| `/admin` | Back-office (après `/auth`) |
