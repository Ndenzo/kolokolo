// Site vitrine sur une page : défilement doux vers les sections, menu actif selon la section visible.
(function () {
	var sections = Array.prototype.slice.call(document.querySelectorAll('.onepage-section[id]'));
	var onHome = sections.length > 0;

	function headerOffset() {
		var header = document.querySelector('.header-sticky');
		return (header ? header.offsetHeight : 80) + 12;
	}

	function closeDrawer() {
		var side = document.querySelector('.side-info');
		var overlay = document.querySelector('.offcanvas-overlay');
		if (side) side.classList.remove('info-open');
		if (overlay) overlay.classList.remove('overlay-open');
	}

	function scrollToId(id, smooth) {
		var target = id === 'accueil' ? document.body : document.getElementById(id);
		if (!target) return false;
		var top = id === 'accueil' ? 0 : target.getBoundingClientRect().top + window.pageYOffset - headerOffset();
		window.scrollTo({ top: Math.max(0, top), behavior: smooth ? 'smooth' : 'auto' });
		return true;
	}

	// Les images chargées pendant le défilement décalent la cible : on corrige une fois arrivé.
	function scrollToSection(id) {
		if (!scrollToId(id, true)) return;
		var tries = 0;
		var timer = 0;
		function settle() {
			window.clearTimeout(timer);
			timer = window.setTimeout(function () {
				var target = document.getElementById(id);
				if (!target || id === 'accueil') return;
				var delta = target.getBoundingClientRect().top - headerOffset();
				if (Math.abs(delta) > 6 && tries < 3) {
					tries += 1;
					scrollToId(id, true);
					settle();
				}
			}, 450);
		}
		window.addEventListener('scroll', settle, { passive: true });
		window.setTimeout(function () { window.removeEventListener('scroll', settle); }, 4000);
		settle();
	}

	// Liens vers une section de l'accueil (/#services, /?lang=en#services…).
	document.addEventListener('click', function (event) {
		var link = event.target.closest && event.target.closest('a[href*="#"]');
		if (!link || link.hasAttribute('data-quote-open')) return;
		var url;
		try { url = new URL(link.href, location.href); } catch (e) { return; }
		var id = url.hash.slice(1);
		if (!id || url.pathname !== location.pathname || url.search !== location.search) return;
		if (!onHome || !document.getElementById(id)) return;
		event.preventDefault();
		closeDrawer();
		scrollToSection(id);
		if (history.replaceState) history.replaceState(null, '', id === 'accueil' ? url.pathname + url.search : '#' + id);
	});

	if (!onHome) return;

	// Arrivée depuis une autre page avec une ancre : on corrige la position (en-tête fixe).
	if (location.hash.length > 1) {
		var initial = decodeURIComponent(location.hash.slice(1));
		window.addEventListener('load', function () {
			setTimeout(function () { scrollToId(initial, false); }, 60);
		});
	}

	// Menu actif selon la section affichée.
	var current = '';
	function setActive(id) {
		if (id === current) return;
		current = id;
		document.querySelectorAll('a[data-section]').forEach(function (a) {
			var li = a.parentElement;
			var on = a.getAttribute('data-section') === id;
			a.classList.toggle('is-active', on);
			if (li) li.classList.toggle('active', on);
			if (on) a.setAttribute('aria-current', 'true');
			else a.removeAttribute('aria-current');
		});
	}

	var ticking = false;
	function update() {
		ticking = false;
		var line = window.pageYOffset + headerOffset() + window.innerHeight * 0.25;
		var id = 'accueil';
		for (var i = 0; i < sections.length; i += 1) {
			if (sections[i].offsetTop <= line) id = sections[i].id;
		}
		if (window.innerHeight + window.pageYOffset >= document.body.scrollHeight - 4) {
			id = sections[sections.length - 1].id;
		}
		setActive(id);
	}
	window.addEventListener('scroll', function () {
		if (!ticking) {
			ticking = true;
			window.requestAnimationFrame(update);
		}
	}, { passive: true });
	window.addEventListener('load', update);
	update();
})();
