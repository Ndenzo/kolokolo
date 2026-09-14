# Déploiement Kolokolo — application Node.js (Hostinger)

Déploiement simple : pas de build, pas d’export HTML. Hostinger lance l’app Express avec `npm start`.

## Prérequis Hostinger

1. Hébergement avec **Node.js** (pas uniquement Apache/static)
2. Base **MySQL** créée dans hPanel
3. Variables d’environnement configurées (voir `.env.example`)

## Configuration de l’app Node

Dans hPanel → **Websites** → ton site → **Node.js** :

| Réglage | Valeur |
| --- | --- |
| Application type | `express` (ou Node.js server) |
| Application root | racine du repo |
| Entry / startup file | `src/app.js` |
| Build command | **vide** (ou laisse le no-op) |
| Output directory | **vide** |
| Node version | **18** ou **20** |

Commande de démarrage : `npm start`.

## Variables d’environnement (obligatoires)

À définir dans le panneau Node.js **ou** via un `.env` sur le serveur (jamais committer).

| Variable | Exemple Hostinger |
| --- | --- |
| `PORT` | laissé vide — Hostinger l’injecte |
| `HOST` | `0.0.0.0` (défaut dans le code) |
| `NODE_ENV` | `production` |
| `SITE_URL` | `https://ton-domaine.com` |
| `SESSION_SECRET` | chaîne longue aléatoire |
| `DB_HOST` | hôte MySQL Hostinger (souvent `localhost` ou un host type `srv….hostinger.com`) |
| `DB_PORT` | `3306` |
| `DB_NAME` | nom de la base créée |
| `DB_USER` | utilisateur MySQL |
| `DB_PASSWORD` | mot de passe MySQL |
| `ADMIN_EMAIL` | email admin initial |
| `ADMIN_PASSWORD` | mot de passe admin initial |

SMTP optionnel pour devis / contact / newsletter.

> Sur Hostinger, **ne mets pas** `127.0.0.1` / `root` / mot de passe local : utilise les identifiants MySQL du panneau.

## Première mise en ligne

```bash
npm install --omit=dev
npm start
```

Les migrations tournent au démarrage (`boot()`).  
Sur Hostinger, `npm install` et le démarrage sont en général gérés par le panneau.

## Workflow quotidien

```bash
git push origin main
```

Hostinger tire `main` → réinstalle si besoin → redémarre Node.

## Erreur 503

La 503 signifie presque toujours : **le process Node n’écoute pas** (crash au boot ou mauvais entry file).

1. Ouvre **Runtime Logs** / logs Node dans hPanel
2. Cherche `[kolokolo] échec démarrage` ou une erreur MySQL (`ECONNREFUSED`, `Access denied`, `Unknown database`)
3. Vérifie :
   - Entry file = `src/app.js`
   - Variables `DB_*` correctes (hôte Hostinger, pas ton `.env` local)
   - Base MySQL créée
   - Node 18+
   - Build command / Output directory **vides**
4. Teste `/health` une fois l’app up → doit répondre `ok`

## Vérifications

1. Le site répond sur l’URL du domaine
2. `/health` → `ok`
3. `/admin` accessible après login
4. `public/uploads/` accessible en écriture
5. `SITE_URL` en HTTPS
