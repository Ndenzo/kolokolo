# Déploiement Kolokolo (Hostinger)

## Pourquoi tu ne voyais pas de HTML

Kolokolo en développement est une app **Express + EJS** : les pages sont rendues **à la demande** par Node. Il n’y a **pas** de fichiers `.html` dans le dépôt source.

Sur Hostinger **sans** « Node.js Web App », le Git ne fait que **copier** le code → tu vois des `.ejs` / `.js`, pas un site navigable → souvent **403** ou listing inutile.

**Solution pour un abonnement classique :** `npm run build` génère un site **HTML statique** dans `dist/`. C’est **ce dossier** qu’il faut mettre en ligne.

---

## Flux recommandé (Git + webhook Hostinger)

```text
push sur main
  → GitHub Actions : npm ci + npm run build
  → branche production = contenu de dist/ (HTML + assets + .htaccess)
  → webhook Hostinger tire production → public_html
```

### Réglages Hostinger (Git classique)

1. **Advanced → Git** (pas Node.js Web App)
2. Repo GitHub, branche : **`production`**
3. Dossier cible : **`public_html`** (vide au premier deploy)
4. Auto-deploy / webhook activé

### GitHub

- **Settings → Actions → General → Workflow permissions** : Read and write
- Optionnel : secret `DEPLOY_PAT` si le push sur `production` est refusé

### Checklist

- [ ] Build local OK : `npm run build` puis ouvrir `dist/index.html` (ou servir `dist/`)
- [ ] Hostinger branché sur **`production`**, pas `main`
- [ ] Après push sur `main`, Actions vertes + dossier `public_html` contient `index.html`
- [ ] Plus de sources Node (`src/`, `views/`) dans `public_html`

---

## Limites du mode statique

| Fonctionne | Ne fonctionne pas (sans Node) |
| --- | --- |
| Pages vitrine, blog seed, SEO head | Back-office `/admin` |
| Assets CSS/JS/images | Formulaires contact / devis / newsletter (POST) |
| URLs propres via `.htaccess` | Recherche AJAX `/recherche` |
| | CMS dynamique (contenu figé au build) |

Pour un CMS + formulaires complets : **Node.js Web App** Hostinger (ou VPS) avec `src/app.js` + MySQL.

---

## Commandes locales

```bash
npm ci
npm run build          # SCSS + export HTML → dist/
npx --yes serve dist   # aperçu local du site statique
npm start              # app Node complète (dev / Node hosting)
```

---

## Fichiers CI/CD

| Fichier | Rôle |
| --- | --- |
| `scripts/build.js` | Orchestre SCSS + export |
| `scripts/export-static.js` | Génère `dist/**/*.html` |
| `.github/workflows/ci.yml` | Build sur PR / push |
| `.github/workflows/deploy.yml` | Publie `dist/` → branche `production` |

---

## En cas de 403

1. Vérifier que `public_html/index.html` existe
2. Vérifier le `.htaccess` généré dans `dist/` (déployé avec le site)
3. Redeploy Hostinger après un push `production` réussi
