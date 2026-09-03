# Déploiement Kolokolo (Hostinger)

## Point important : tu ne verras JAMAIS un dossier `dist/` sur Hostinger

`dist/` est **local / CI uniquement** (il est dans `.gitignore`).

Le workflow GitHub copie le **contenu** de `dist/` vers la branche **`production`** :
- `dist/index.html` → `production` → `public_html/index.html`
- `dist/a-propos/` → `public_html/a-propos/`
- etc.

Si Hostinger est branché sur **`main`**, tu reçois le code source Node (`.ejs`, `src/…`) — **pas** le site HTML.

---

## Config Hostinger (à vérifier)

1. **Advanced → Git**
2. Branche : **`production`** (obligatoire)
3. Dossier cible : **`public_html`**
4. Auto-deploy activé

Après un deploy réussi, dans le File Manager tu dois voir :

```text
public_html/
  index.html          ← obligatoire
  a-propos/
  blog/
  assets/
  .htaccess
  …
```

S’il n’y a pas `index.html` à la racine, Hostinger n’est pas sur la bonne branche (ou le workflow n’a pas tourné).

---

## Config GitHub

1. **Settings → Actions → General → Workflow permissions** → **Read and write** → Save  
2. Onglet **Actions** : lancer **Deploy** (workflow_dispatch) ou pousser sur `main`  
3. Vérifier que le job est vert, puis regarder la branche `production` sur GitHub : elle ne doit contenir que le HTML (pas `src/`, pas `package.json`)

---

## Flux

```text
push main
  → Actions : npm run build → dist/
  → branche production = contenu de dist/
  → webhook Hostinger tire production → public_html
```

---

## Limites du mode statique

| OK | Non disponible |
| --- | --- |
| Pages vitrine, blog seed, assets | Admin `/admin` |
| URLs + `.htaccess` | Formulaires POST, recherche API |
| | Contenu CMS live (figé au build) |

---

## Local

```bash
npm ci
npm run build
# aperçu : ouvrir dist/index.html ou npx serve dist
```

---

## 403 / pas de site

1. Hostinger = branche **`production`**, pas `main`
2. `public_html/index.html` présent
3. Relancer le workflow **Deploy** sur GitHub, puis Redeploy Hostinger
