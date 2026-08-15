const path = require('path');
const express = require('express');

const app = express();
const PORT = process.env.PORT || 3000;

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, '..', 'views'));

app.use(express.static(path.join(__dirname, '..', 'public')));
app.use(express.urlencoded({ extended: true }));

function renderHome(_req, res) {
  res.render('layout', {
    title: 'Kolokolo',
    page: 'home',
  });
}

function renderComing(_req, res) {
  res.render('coming', {
    title: 'KoloKolo - Maintenance',
  });
}

app.get('/', renderHome);
app.get('/site', renderHome);
app.get('/site/site', renderHome);

app.get('/coming', renderComing);
app.get('/site/coming', renderComing);

app.use((req, res) => {
  res.status(404).render('layout', {
    title: 'Page introuvable — Kolokolo',
    page: '404',
  });
});

app.listen(PORT, () => {
  console.log(`Kolokolo disponible sur http://localhost:${PORT}`);
});
