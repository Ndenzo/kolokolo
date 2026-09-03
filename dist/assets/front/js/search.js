(function () {
	const form = document.querySelector('[data-site-search]');
	const input = document.getElementById('site-search-input');
	const box = document.querySelector('[data-search-suggest]');
	if (!form || !input || !box) return;

	let timer = null;
	let controller = null;
	let requestId = 0;

	function i18n(key) {
		return (window.KOLOKOLO_I18N && window.KOLOKOLO_I18N[key]) || key;
	}

	function escapeHtml(value) {
		return String(value || '')
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;');
	}

	function setSuggest(html) {
		box.innerHTML = html;
		box.hidden = !html;
	}

	function showLoader() {
		setSuggest(
			'<div class="search-suggest-loader" role="status" aria-live="polite">' +
				'<span class="search-suggest-spinner" aria-hidden="true"></span>' +
				'<span>' + escapeHtml(i18n('searching')) + '</span>' +
			'</div>'
		);
	}

	function render(groups, query) {
		if (!groups.length) {
			setSuggest(
				'<div class="search-suggest-empty" role="status">' +
					'<p>' + escapeHtml(i18n('noResults')) + ' <strong>' + escapeHtml(query) + '</strong></p>' +
				'</div>'
			);
			return;
		}
		const html = groups
			.map((group) => {
				const items = (group.items || [])
					.map((item) => {
						const extra = item.excerpt
							? '<small>' + escapeHtml(item.excerpt) + '</small>'
							: '';
						const external = /^https?:\/\//i.test(item.url);
						return (
							'<a class="search-suggest-item" href="' +
							escapeHtml(item.url) +
							'"' +
							(external ? ' target="_blank" rel="noopener noreferrer"' : '') +
							'><span>' +
							escapeHtml(item.title) +
							'</span>' +
							extra +
							'</a>'
						);
					})
					.join('');
				return (
					'<div class="search-suggest-group">' +
						'<p class="search-suggest-kicker">' +
						escapeHtml(group.label) +
						'</p>' +
						items +
					'</div>'
				);
			})
			.join('');
		setSuggest(html);
	}

	async function runSearch(query) {
		if (controller) controller.abort();
		controller = new AbortController();
		const current = ++requestId;
		showLoader();
		try {
			const res = await fetch('/recherche?q=' + encodeURIComponent(query), {
				headers: { Accept: 'application/json' },
				signal: controller.signal,
			});
			const json = await res.json().catch(() => ({}));
			if (current !== requestId) return;
			if (!res.ok || json.ok === false) {
				setSuggest('<div class="search-suggest-empty"><p>' + escapeHtml(i18n('searchError')) + '</p></div>');
				return;
			}
			render(json.groups || [], query);
		} catch (err) {
			if (err.name === 'AbortError' || current !== requestId) return;
			setSuggest('<div class="search-suggest-empty"><p>' + escapeHtml(i18n('searchError')) + '</p></div>');
		}
	}

	function scheduleSearch() {
		const query = input.value.trim();
		clearTimeout(timer);
		if (query.length < 2) {
			if (controller) controller.abort();
			requestId += 1;
			setSuggest('');
			return;
		}
		showLoader();
		timer = setTimeout(() => runSearch(query), 280);
	}

	input.addEventListener('input', scheduleSearch);
	input.addEventListener('click', (event) => event.stopPropagation());
	box.addEventListener('click', (event) => event.stopPropagation());

	form.addEventListener('submit', (event) => {
		event.preventDefault();
		const first = box.querySelector('.search-suggest-item');
		if (first) {
			window.location.href = first.getAttribute('href');
			return;
		}
		const query = input.value.trim();
		if (query) window.location.href = '/blog?q=' + encodeURIComponent(query);
	});

	document.querySelectorAll('.search-trigger').forEach((trigger) => {
		trigger.addEventListener('click', () => {
			setTimeout(() => input.focus(), 320);
		});
	});

	document.querySelector('.search-close')?.addEventListener('click', () => {
		if (controller) controller.abort();
		clearTimeout(timer);
		setSuggest('');
	});
})();
