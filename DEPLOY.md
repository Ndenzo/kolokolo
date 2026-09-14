# Déploiement Kolokolo — application Node.js (Hostinger)

Déploiement simple : pas de build, pas d’export HTML. Hostinger lance l’app Express avec `npm start`.

## Prérequis Hostinger

1. Hébergement avec **Node.js** (pas uniquement Apache/static)
2. Base **MySQL** créée dans hPanel
3. Variables d’environnement configurées (voir `.env.example`)

## Configuration de l’app Node

Dans hPanel → **Websites** → **Node.js** (ou Advanced → Node.js) :

| Réglage | Valeur |
| --- | --- |
| Application root | racine du repo (ex. `domains/…/public_html` ou le dossier Git) |
| Application startup file | `src/app.js` |
| Node version | **18** ou **20** |
| Application URL | ton domaine |

Commande de démarrage : `npm start` (déjà défini dans `package.json`).

## Variables d’environnement

Copier `.env.example` → `.env` **sur le serveur** (ou via l’UI Node.js Hostinger). Ne jamais committer `.env`.

Obligatoires :

- `PORT` — souvent fourni par Hostinger ; sinon `3000`
- `SITE_URL` — URL publique HTTPS (`https://kolokolo.tech`)
- `SESSION_SECRET`
- `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`
- `ADMIN_EMAIL`, `ADMIN_PASSWORD` (premier compte admin)

SMTP optionnel pour devis / contact / newsletter.

## Première mise en ligne

```bash
npm install --omit=dev
npm run migrate
npm start
```

Sur Hostinger, `npm install` et le démarrage sont en général gérés par le panneau après un deploy Git.

## Workflow quotidien

```bash
git push origin main
```

Hostinger tire `main` → réinstalle si besoin → redémarre Node.  
Aucun `npm run build`, aucun dossier `dist/`.

## Vérifications

1. Le site répond sur l’URL du domaine
2. `/admin` accessible après login
3. Les uploads vont dans `public/uploads/` (droits en écriture)
4. `SITE_URL` est bien en HTTPS (métas Open Graph)

## Dépannage

| Symptôme | Piste |
| --- | --- |
| App ne démarre pas | Logs Node, `.env` / DB, Node ≥ 18 |
| 502 / timeout | `PORT` incorrect ou app crashée (voir logs) |
| CSS / images 404 | `public/` bien déployé ; pas besoin de `dist/` |
| Admin KO | Migrations non jouées : `npm run migrate` |
