(function () {
	var KEY = 'kolokolo-lang';
	var langs = ['fr', 'en'];

	function normalize(value) {
		return langs.indexOf(value) !== -1 ? value : '';
	}

	function readStorage() {
		try {
			return normalize(localStorage.getItem(KEY));
		} catch (err) {
			return '';
		}
	}

	function readCookie() {
		var match = document.cookie.match(/(?:^|;\s*)kolokolo-lang=([^;]*)/);
		return match ? normalize(decodeURIComponent(match[1])) : '';
	}

	function writeCookie(lang) {
		document.cookie = 'kolokolo-lang=' + encodeURIComponent(lang) + '; Path=/; Max-Age=31536000; SameSite=Lax';
	}

	function applyButtons(lang) {
		document.documentElement.lang = lang;
		document.querySelectorAll('[data-lang-switch]').forEach(function (group) {
			group.querySelectorAll('[data-lang]').forEach(function (btn) {
				var on = btn.getAttribute('data-lang') === lang;
				btn.classList.toggle('is-active', on);
				btn.setAttribute('aria-pressed', on ? 'true' : 'false');
			});
		});
	}

	var cookie = readCookie();
	var stored = readStorage();
	var lang = cookie || stored || 'fr';

	if (cookie !== lang) writeCookie(lang);
	try {
		localStorage.setItem(KEY, lang);
	} catch (err) {}

	if (!cookie && stored === 'en') {
		location.reload();
		return;
	}

	applyButtons(lang);

	document.addEventListener('click', function (event) {
		var btn = event.target.closest('[data-lang-switch] [data-lang]');
		if (!btn) return;
		var next = normalize(btn.getAttribute('data-lang'));
		if (!next || next === lang) return;
		try {
			localStorage.setItem(KEY, next);
		} catch (err) {}
		writeCookie(next);
		location.reload();
	});
})();
