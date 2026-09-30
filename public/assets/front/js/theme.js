(function () {
	var KEY = 'kolokolo-theme';
	var themes = ['light', 'dark'];

	function normalize(value) {
		return themes.indexOf(value) !== -1 ? value : '';
	}

	function readStorage() {
		try {
			return normalize(localStorage.getItem(KEY));
		} catch (err) {
			return '';
		}
	}

	function writeStorage(theme) {
		try {
			localStorage.setItem(KEY, theme);
		} catch (err) {}
	}

	function currentTheme() {
		var attr = document.documentElement.getAttribute('data-theme');
		return normalize(attr) || readStorage() || 'light';
	}

	function applyTheme(theme) {
		var next = normalize(theme) || 'light';
		document.documentElement.setAttribute('data-theme', next);
		writeStorage(next);

		var meta = document.querySelector('meta[name="theme-color"]');
		if (meta) meta.setAttribute('content', next === 'dark' ? '#0C0B22' : '#FF0A08');

		document.querySelectorAll('[data-theme-switch]').forEach(function (group) {
			group.querySelectorAll('[data-theme-set]').forEach(function (btn) {
				var on = btn.getAttribute('data-theme-set') === next;
				btn.classList.toggle('is-active', on);
				btn.setAttribute('aria-pressed', on ? 'true' : 'false');
			});
		});
	}

	applyTheme(currentTheme());

	document.addEventListener('click', function (event) {
		var btn = event.target.closest('[data-theme-switch] [data-theme-set]');
		if (!btn) return;
		var next = normalize(btn.getAttribute('data-theme-set'));
		if (!next || next === currentTheme()) return;
		applyTheme(next);
	});
})();
