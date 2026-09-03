# Déploiement Kolokolo (Hostinger)

## Contrainte importante

Kolokolo est une application **Express + MySQL** (SSR EJS, sessions, admin, formulaires).
Elle **nécessite un runtime Node.js** en production.

Sur un hébergement Hostinger **classique** (PHP / Git générique sans « Node.js Web App ») :
- le webhook Git **copie seulement des fichiers** ;
- **aucun** `npm install` / `npm run build` / `node` n’est exécuté ;
- le site **ne démarrera pas**.

Le flux « push → build → mise à jour du site » fonctionne avec :
1. **Hostinger Node.js Web App** (recommandé), ou
2. un **VPS** (SSH + PM2).

---

## Option A — Hostinger Node.js Web App (recommandée)

### 1. Préparer la base

- Créer une base MySQL sur Hostinger (ou externe).
- Noter host, port, nom, user, mot de passe.

### 2. Créer le site Node

Dans hPanel : **Websites → Add Website → Node.js web app → Import Git repository**.

Réglages :

| Champ | Valeur |
| --- | --- |
| Framework | Other |
| Branch | `production` |
| Node.js | 20 (ou 18+) |
| Build command | `npm run build` |
| Entry file | `src/app.js` |
| Package manager | npm |

**Ne pas committer de `.htaccess`** : Hostinger en génère un dans `public_html` pour router vers le process Node. Un fichier maison provoque souvent un **403**. Si tu as déjà un 403 : supprimer / laisser le `.htaccess` dans `public_html`, puis **Redeploy** dans hPanel.

> La branche `production` est mise à jour **uniquement** après un build GitHub réussi (voir workflows).

### 3. Variables d’environnement (hPanel)

Reprendre `.env.example` :

```
PORT=                 # souvent injecté par Hostinger — laisser leur valeur
SITE_URL=https://kolokolo.tech
SESSION_SECRET=...
DB_HOST=...
DB_PORT=3306
DB_NAME=...
DB_USER=...
DB_PASSWORD=...
ADMIN_EMAIL=...
ADMIN_PASSWORD=...
SMTP_HOST=...
SMTP_PORT=587
SMTP_SECURE=false
SMTP_USER=...
SMTP_PASSWORD=...
MAIL_FROM=...
MAIL_TO=...
```

### 4. Brancher GitHub

1. Connecter le compte GitHub dans Hostinger (app officielle).
2. Auto-deploy activé → Hostinger crée le webhook.
3. Chaque mise à jour de `production` → `npm install` → `npm run build` → redémarrage de `src/app.js`.

### 5. Flux Git local

```text
push sur main
  → GitHub Actions : CI + build
  → si OK : force-update de la branche production
  → webhook Hostinger : install + build + restart
```

Secrets GitHub optionnels :

- `DEPLOY_PAT` — token avec droit d’écriture sur le dépôt (si le `GITHUB_TOKEN` par défaut ne peut pas pousser sur `production`).

Dans **Settings → Actions → General → Workflow permissions**, autoriser **Read and write**.

---

## Option B — Hébergement sans Node (non compatible tel quel)

Le Git Hostinger « Advanced → Git » **ne lance pas Node**.  
Pour y déployer Kolokolo il faudrait **réécrire** le site en HTML/PHP statique (perte du CMS admin, sessions, newsletter serveur, etc.).

Ce n’est **pas** le chemin prévu par ce dépôt.

---

## Commandes locales

```bash
npm ci
npm run build    # compile le SCSS + vérifie les modules
npm start        # lance le serveur (après .env + MySQL)
npm run migrate  # optionnel : aussi exécuté au boot
```

---

## Fichiers CI/CD

| Fichier | Rôle |
| --- | --- |
| `.github/workflows/ci.yml` | Build sur PR / push |
| `.github/workflows/deploy.yml` | Build puis promotion `main` → `production` |
| `scripts/build.js` | Script `npm run build` |
| `.env.example` | Modèle des variables |

---

## Checklist go-live

- [ ] Site Hostinger de type **Node.js Web App** (pas Git classique PHP)
- [ ] Branche `production` connectée + auto-deploy
- [ ] **Pas** de `.htaccess` custom dans le repo / `public_html` (Hostinger le génère)
- [ ] Variables d’environnement renseignées
- [ ] MySQL accessible depuis l’app
- [ ] Premier push sur `main` → Actions vertes → déploiement Hostinger OK
- [ ] Vérifier `/` et `/auth` (admin)
- [ ] En cas de **403** : Redeploy dans hPanel pour régénérer le `.htaccess`
