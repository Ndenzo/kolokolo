# Déploiement Kolokolo (Hostinger) — tout sur `main`

## Principe

1. En local : `npm run build` → génère **`dist/`** (HTML + assets)
2. Tu commits **`dist/`** + le `.htaccess` racine sur **`main`**
3. Hostinger Git est branché sur **`main`** → `public_html`
4. Le `.htaccess` racine sert le site depuis **`dist/`** (URLs `/`, `/a-propos`, …)

Plus de branche `production`.

---

## Hostinger

1. **Advanced → Git**
2. Branche : **`main`**
3. Cible : **`public_html`**
4. Auto-deploy / webhook OK

Après deploy, File Manager :

```text
public_html/
  .htaccess          ← routage vers dist/
  dist/
    index.html
    a-propos/
    assets/
    …
  src/               ← présent mais bloqué par .htaccess
  …
```

Le site s’ouvre sur `/` (pas `/dist/`).

---

## Workflow local

```bash
npm ci
npm run build
# vérifier dist/index.html
git add dist .htaccess
git commit -m "build: export statique"
git push origin main
```

GitHub Actions (**CI**) vérifie seulement que le build passe ; **c’est toi** qui versions `dist/` sur `main`.

---

## Limites du mode statique

| OK | Non disponible |
| --- | --- |
| Pages vitrine, blog seed, assets | Admin `/admin` |
| URLs via `.htaccess` | Formulaires POST, recherche API |
| | Contenu CMS live (figé au build) |

---

## 403 / page blanche

1. `dist/index.html` est bien commit / présent sur le serveur
2. `.htaccess` racine présent
3. Redeploy Hostinger après le push
