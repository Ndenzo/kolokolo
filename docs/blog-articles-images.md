# Articles blog Kolokolo — données & prompts images

Document pour générer une **image de couverture** cohérente pour chaque article du blog Kolokolo.

---

## Spécifications visuelles (à respecter)

| Critère | Valeur |
| --- | --- |
| **Proportion (ratio)** | **7:4** (paysage) |
| **Taille recommandée** | **1400 × 800 px** (ou 770 × 440 px minimum) |
| **Format de sortie** | JPG ou PNG, sans texte illisible / sans watermark |
| **Recadrage** | Zone sûre au centre : éviter les sujets collés aux bords (crop possible sur le site) |
| **Style global** | Moderne, pro, digital agency — tons **rouge `#FF0A08`**, **ambre `#F5A623`**, **encre `#0C0B22`**, fond clair ou nuit selon l’article |
| **À éviter** | Logos inventés, texte long, UI pixel-perfect fake, visages stock génériques trop « banque d’images » |

Nom de fichier cible (une fois générées) :

- `bms1.jpg` → article `comment-reussir-le-lancement-de-son-site-web`
- `bms2.jpg` → article `5-astuces-pour-booster-votre-presence-sur-les-reseaux-sociaux`
- `bms3.jpg` → article `pourquoi-investir-dans-une-application-mobile-en-2026`
- `bms4.jpg` → article `etre-visible-partout-sur-internet-cest-possible`
- `bms5.jpg` → article `seo-comment-etre-trouve-par-vos-clients`

Dossier de destination sur le site : `public/assets/front/img/blog/`

---

## JSON — articles du blog

```json
{
  "brand": {
    "name": "Kolokolo",
    "tagline": "Agence digitale internationale basée à Dakar",
    "colors": {
      "red": "#FF0A08",
      "amber": "#F5A623",
      "ink": "#0C0B22"
    },
    "imageSpec": {
      "aspectRatio": "7:4",
      "width": 1400,
      "height": 800,
      "format": "jpg"
    }
  },
  "articles": [
    {
      "id": 1,
      "title": "Comment réussir le lancement de son site web ?",
      "slug": "comment-reussir-le-lancement-de-son-site-web",
      "category": "Site Web",
      "excerpt": "Les points essentiels à vérifier avant, pendant et après la mise en ligne de votre site.",
      "tags": ["Site Web", "Dakar", "Kolokolo", "Mise en ligne"],
      "cover_image": "/assets/front/img/blog/bms1.jpg",
      "cover_filename": "bms1.jpg",
      "published_at": "2026-01-22",
      "imageBrief": "Lancement d’un site web : mise en ligne, checklist, écran d’ordinateur moderne, ambiance agence digitale à Dakar."
    },
    {
      "id": 2,
      "title": "5 astuces pour booster votre présence sur les réseaux sociaux",
      "slug": "5-astuces-pour-booster-votre-presence-sur-les-reseaux-sociaux",
      "category": "Social Media",
      "excerpt": "Nos conseils pour développer votre communauté et votre visibilité digitale à Dakar.",
      "tags": ["Social Media", "Contenu", "Dakar", "Communauté"],
      "cover_image": "/assets/front/img/blog/bms2.jpg",
      "cover_filename": "bms2.jpg",
      "published_at": "2026-02-16",
      "imageBrief": "Social media marketing : smartphone, flux de contenu, engagement communautaire, énergie créative africaine contemporaine."
    },
    {
      "id": 3,
      "title": "Pourquoi investir dans une application mobile en 2026 ?",
      "slug": "pourquoi-investir-dans-une-application-mobile-en-2026",
      "category": "Mobile App",
      "excerpt": "Les avantages d’une application mobile pour développer votre activité au Sénégal.",
      "tags": ["Mobile App", "Produit digital", "Sénégal", "Innovation"],
      "cover_image": "/assets/front/img/blog/bms3.jpg",
      "cover_filename": "bms3.jpg",
      "published_at": "2026-03-07",
      "imageBrief": "Application mobile moderne : mockup téléphone, UI épurée, innovation produit digital au Sénégal."
    },
    {
      "id": 4,
      "title": "Être visible partout sur internet, c’est possible",
      "slug": "etre-visible-partout-sur-internet-cest-possible",
      "category": "Publicité Digitale",
      "excerpt": "Nous vous affichons partout sur internet, que ce soit sur Google, YouTube, Facebook, Twitter ou LinkedIn.",
      "tags": ["Publicité Digitale", "Google", "Facebook", "Visibilité"],
      "cover_image": "/assets/front/img/blog/bms4.jpg",
      "cover_filename": "bms4.jpg",
      "published_at": "2026-04-21",
      "imageBrief": "Publicité digitale et visibilité web : réseau de canaux, campagnes multi-plateformes, graphisme dynamique rouge/ambre."
    },
    {
      "id": 5,
      "title": "SEO : comment être trouvé par vos clients",
      "slug": "seo-comment-etre-trouve-par-vos-clients",
      "category": "SEO & visibilité",
      "excerpt": "Nous optimisons votre site pour qu’il soit trouvé par vos clients, sur Google comme sur les réseaux sociaux.",
      "tags": ["SEO", "Google", "Visibilité", "Référencement"],
      "cover_image": "/assets/front/img/blog/bms5.jpg",
      "cover_filename": "bms5.jpg",
      "published_at": "2026-05-05",
      "imageBrief": "SEO et référencement : recherche, classement, croissance organique, métaphore claire et professionnelle."
    }
  ]
}
```

---

## Prompt ChatGPT (à coller tel quel)

Copie-colle le bloc ci-dessous dans ChatGPT (idéalement avec génération d’images activée). Demande **une image par article**, dans l’ordre.

````
Tu es directeur artistique pour Kolokolo, une agence digitale internationale basée à Dakar (Sénégal).

Génère UNE image de couverture de blog pour CHAQUE article listé ci-dessous (5 images au total).

CONTRAINTES TECHNIQUES OBLIGATOIRES (identiques pour toutes les images) :
- Proportion exacte : 7:4 (paysage)
- Résolution cible : 1400 × 800 pixels
- Composition centrée, sujet principal dans le tiers central (le site peut recadrer légèrement)
- Style cohérent d’une image à l’autre : moderne, premium, digital, légèrement contemporain africain (Dakar), sans cliché touristique
- Palette récurrente : rouge #FF0A08, ambre #F5A623, encre #0C0B22, avec neutres clairs ou sombre selon l’ambiance
- Pas de logo inventé, pas de texte long, pas de watermark, pas de watermark IA visible
- Pas de captures d’écran UI réalistes illisibles ; privilégier la métaphore visuelle claire
- Rendu photo-réaliste ou illustration 3D soft / editorial digital (reste constant sur les 5 images)

Pour chaque article, produis l’image puis indique le nom de fichier cible.

ARTICLES :

1) Fichier : bms1.jpg
Titre : Comment réussir le lancement de son site web ?
Catégorie : Site Web
Brief : Scène de lancement / go-live d’un site web. Ordinateur ou laptop moderne, sensation de « mise en ligne réussie », checklist implicite, ambiance agence digitale pro à Dakar. Énergie confiante, propre, premium.

2) Fichier : bms2.jpg
Titre : 5 astuces pour booster votre présence sur les réseaux sociaux
Catégorie : Social Media
Brief : Présence social media. Smartphone en avant-plan, idée de contenu engageant et de communauté qui grandit, bulles / flux abstraits (sans logos de marques protégés). Dynamique, créatif, chaleureux.

3) Fichier : bms3.jpg
Titre : Pourquoi investir dans une application mobile en 2026 ?
Catégorie : Mobile App
Brief : Produit application mobile. Mockup de téléphone élégant, interface abstraite et épurée, innovation utile pour le marché sénégalais / africain. Futuriste mais accessible.

4) Fichier : bms4.jpg
Titre : Être visible partout sur internet, c’est possible
Catégorie : Publicité Digitale
Brief : Visibilité multi-canaux. Réseau abstrait de connexions / signaux publicitaires diffusés, sensation d’être vu partout en ligne. Graphisme énergique rouge/ambre sur fond encre ou clair.

5) Fichier : bms5.jpg
Titre : SEO : comment être trouvé par vos clients
Catégorie : SEO & visibilité
Brief : Référencement / être trouvé. Métaphore de recherche et de classement (loupe abstraite, chemin vers le sommet, signaux de croissance organique). Clair, pédagogique, sérieux.

Ordre de livraison :
1. Génère l’image 1 (bms1.jpg)
2. Puis l’image 2 (bms2.jpg)
3. Puis 3, 4 et 5
Après chaque image, rappelle : nom de fichier + ratio 7:4 (1400×800).
````

---

## Après génération

1. Exporter / télécharger chaque image en **1400×800** (recadrer en 7:4 si besoin).
2. Renommer en `bms1.jpg` … `bms5.jpg`.
3. Remplacer les fichiers dans `public/assets/front/img/blog/`.
4. Vérifier l’affichage sur `/blog` et la home (cartes articles).
