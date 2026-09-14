(function () {
	function qs(sel, root) {
		return (root || document).querySelector(sel);
	}
	function qsa(sel, root) {
		return Array.from((root || document).querySelectorAll(sel));
	}

	function initDropzone(zone) {
		const input = zone.querySelector('input[type="file"]');
		const hidden = zone.querySelector('input[type="hidden"]');
		const preview = zone.querySelector('[data-preview]');
		const hint = zone.querySelector('[data-hint]');
		const removeBtn = zone.querySelector('[data-remove]');

		function show(url) {
			if (!url) {
				preview.innerHTML = '';
				hint.hidden = false;
				removeBtn.hidden = true;
				return;
			}
			preview.innerHTML = '<img src="' + url + '" alt="">';
			hint.hidden = true;
			removeBtn.hidden = false;
		}

		async function send(file) {
			const data = new FormData();
			data.append('file', file);
			const res = await fetch('/admin/uploads', { method: 'POST', body: data });
			const json = await res.json();
			if (!res.ok) throw new Error(json.error || 'Upload impossible');
			hidden.value = json.url;
			show(json.url);
		}

		zone.addEventListener('click', (e) => {
			if (e.target.closest('[data-remove]')) return;
			input.click();
		});
		zone.addEventListener('dragover', (e) => {
			e.preventDefault();
			zone.classList.add('is-over');
		});
		zone.addEventListener('dragleave', () => zone.classList.remove('is-over'));
		zone.addEventListener('drop', (e) => {
			e.preventDefault();
			zone.classList.remove('is-over');
			const file = e.dataTransfer.files[0];
			if (file) send(file).catch((err) => alert(err.message));
		});
		input.addEventListener('change', () => {
			const file = input.files[0];
			if (file) send(file).catch((err) => alert(err.message));
		});
		removeBtn.addEventListener('click', (e) => {
			e.preventDefault();
			e.stopPropagation();
			hidden.value = '';
			show('');
		});
		show(hidden.value);
	}

	qsa('[data-dropzone]').forEach(initDropzone);

	if (window.tinymce) {
		tinymce.init({
			selector: 'textarea.js-wysiwyg',
			menubar: false,
			plugins: 'lists link image table code autoresize',
			toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | table | code',
			content_css: '/assets/admin/css/editor.css',
			convert_urls: false,
			relative_urls: false,
			height: 320,
			images_upload_handler: (blobInfo) => {
				const data = new FormData();
				data.append('file', blobInfo.blob(), blobInfo.filename());
				return fetch('/admin/uploads', { method: 'POST', body: data })
					.then((res) => res.json())
					.then((json) => {
						if (!json.url) throw new Error(json.error || 'Upload impossible');
						return json.url;
					});
			},
		});
	}

	function initToasts() {
		qsa('[data-toast]').forEach((toast) => {
			setTimeout(() => {
				toast.style.opacity = '0';
				toast.style.transform = 'translateY(-8px)';
				toast.style.transition = '0.2s';
				setTimeout(() => toast.remove(), 200);
			}, 4200);
		});
	}

	function initConfirmModal() {
		const overlay = qs('#admin-confirm');
		if (!overlay) return;
		const okBtn = qs('[data-confirm-ok]', overlay);
		const cancelBtn = qs('[data-confirm-cancel]', overlay);
		const titleEl = qs('#admin-confirm-title', overlay);
		const textEl = qs('#admin-confirm-text', overlay);
		const defaultTitle = titleEl ? titleEl.textContent : '';
		const defaultText = textEl ? textEl.textContent : '';
		const defaultOk = okBtn ? okBtn.textContent : '';
		let pendingForm = null;

		function close() {
			overlay.classList.remove('is-open');
			pendingForm = null;
		}

		cancelBtn.addEventListener('click', close);
		overlay.addEventListener('click', (e) => {
			if (e.target === overlay) close();
		});
		okBtn.addEventListener('click', () => {
			if (!pendingForm) return;
			const form = pendingForm;
			form.dataset.confirmed = '1';
			close();
			form.requestSubmit();
		});

		qsa('[data-confirm]').forEach((form) => {
			form.addEventListener('submit', (e) => {
				if (form.dataset.confirmed === '1') {
					delete form.dataset.confirmed;
					return;
				}
				e.preventDefault();
				pendingForm = form;
				if (titleEl) titleEl.textContent = form.getAttribute('data-confirm-title') || defaultTitle;
				if (textEl) textEl.textContent = form.getAttribute('data-confirm-message') || defaultText;
				if (okBtn) okBtn.textContent = form.getAttribute('data-confirm-ok') || defaultOk;
				overlay.classList.add('is-open');
			});
		});
	}

	function cellSortValue(row, index) {
		const cell = row.children[index];
		if (!cell) return '';
		return (cell.getAttribute('data-sort-value') || cell.textContent || '').trim().toLowerCase();
	}

	function initDataTable(root) {
		const table = qs('table', root);
		if (!table || !table.tBodies[0]) return;
		const allRows = Array.from(table.tBodies[0].rows);
		if (!allRows.length) return;

		const searchInput = qs('[data-table-search]', root);
		const pageSizeSel = qs('[data-page-size]', root);
		const pager = qs('[data-pager]', root);
		const info = qs('[data-table-info]', root);
		const empty = qs('[data-table-empty]', root);
		const headers = qsa('th[data-sort]', table);
		let page = 1;
		let pageSize = Number((pageSizeSel && pageSizeSel.value) || root.dataset.pageSize || 10);
		let sortIndex = Number(root.dataset.sortIndex || -1);
		let sortDir = root.dataset.sortDir || 'desc';

		function filteredRows() {
			const q = (searchInput ? searchInput.value : '').trim().toLowerCase();
			let rows = allRows.slice();
			if (q) {
				rows = rows.filter((row) => (row.getAttribute('data-search') || row.textContent).toLowerCase().includes(q));
			}
			if (sortIndex >= 0) {
				rows.sort((a, b) => {
					const av = cellSortValue(a, sortIndex);
					const bv = cellSortValue(b, sortIndex);
					if (av < bv) return sortDir === 'asc' ? -1 : 1;
					if (av > bv) return sortDir === 'asc' ? 1 : -1;
					return 0;
				});
			}
			return rows;
		}

		function updateHeaderState() {
			headers.forEach((th) => {
				const idx = th.cellIndex;
				th.classList.toggle('is-sorted', idx === sortIndex);
				const ind = qs('.sort-ind', th);
				if (ind) ind.textContent = idx === sortIndex ? (sortDir === 'asc' ? '▲' : '▼') : '↕';
			});
		}

		function render() {
			const rows = filteredRows();
			const total = allRows.length;
			const shown = rows.length;
			const pages = Math.max(1, Math.ceil(shown / pageSize));
			if (page > pages) page = 1;
			const start = (page - 1) * pageSize;
			const pageRows = rows.slice(start, start + pageSize);

			allRows.forEach((row) => {
				row.hidden = true;
			});
			pageRows.forEach((row) => {
				row.hidden = false;
			});

			if (empty) empty.style.display = shown ? 'none' : 'block';
			table.style.display = shown ? '' : 'none';

			if (info) {
				if (!shown) info.textContent = `0 / ${total} élément${total > 1 ? 's' : ''}`;
				else {
					const from = start + 1;
					const to = start + pageRows.length;
					info.textContent = `${from}–${to} sur ${shown} (total ${total})`;
				}
			}

			if (pager) {
				pager.innerHTML = '';
				const addBtn = (label, target, disabled, active) => {
					const btn = document.createElement('button');
					btn.type = 'button';
					btn.textContent = label;
					btn.disabled = disabled;
					if (active) btn.classList.add('is-active');
					btn.addEventListener('click', () => {
						page = target;
						render();
					});
					pager.appendChild(btn);
				};
				addBtn('«', 1, page === 1);
				addBtn('‹', Math.max(1, page - 1), page === 1);
				for (let i = 1; i <= pages; i += 1) addBtn(String(i), i, false, i === page);
				addBtn('›', Math.min(pages, page + 1), page === pages);
				addBtn('»', pages, page === pages);
			}
			updateHeaderState();
		}

		if (searchInput) {
			searchInput.addEventListener('input', () => {
				page = 1;
				render();
			});
		}
		if (pageSizeSel) {
			pageSizeSel.addEventListener('change', () => {
				pageSize = Number(pageSizeSel.value) || 10;
				page = 1;
				render();
			});
			if (window.jQuery) {
				jQuery(pageSizeSel).on('change', () => {
					pageSize = Number(pageSizeSel.value) || 10;
					page = 1;
					render();
				});
			}
		}
		headers.forEach((th) => {
			if (!qs('.sort-ind', th)) {
				const ind = document.createElement('span');
				ind.className = 'sort-ind';
				ind.textContent = '↕';
				th.appendChild(ind);
			}
			th.addEventListener('click', () => {
				if (sortIndex === th.cellIndex) sortDir = sortDir === 'asc' ? 'desc' : 'asc';
				else {
					sortIndex = th.cellIndex;
					sortDir = th.getAttribute('data-sort-dir') || 'asc';
				}
				page = 1;
				render();
			});
		});
		render();
	}

	function initSelect2(scope) {
		if (!window.jQuery || !jQuery.fn.select2) return;
		jQuery(scope || document).find('select').each(function () {
			const $el = jQuery(this);
			if ($el.hasClass('select2-hidden-accessible')) return;
			const compact = $el.is('[data-page-size], .select-inline');
			const placeholder = $el.attr('data-placeholder') || '';
			$el.select2({
				width: compact ? ($el.hasClass('select-inline') ? '200px' : '88px') : '100%',
				language: 'fr',
				placeholder: placeholder || undefined,
				allowClear: Boolean(placeholder) && !$el.prop('required'),
				tags: $el.is('[data-allow-custom]'),
				minimumResultsForSearch: compact ? Infinity : 0,
				dropdownParent: jQuery(document.body),
			});
		});
	}

	function initPhoneAddon() {
		qsa('[data-phone-addon]').forEach((box) => {
			const selector = box.getAttribute('data-country-select') || '[name="country_iso2"]';
			const countrySelect = document.querySelector(selector);
			const flag = qs('[data-phone-flag]', box);
			const dial = qs('[data-phone-dial]', box);
			function apply() {
				if (!countrySelect) return;
				const option = countrySelect.options[countrySelect.selectedIndex];
				const iso = (option && option.getAttribute('data-iso2')) || countrySelect.value || 'sn';
				const code = (option && option.getAttribute('data-dial')) || '';
				if (flag) flag.className = 'fi fi-' + String(iso).toLowerCase();
				if (dial) dial.textContent = code;
			}
			if (countrySelect) {
				countrySelect.addEventListener('change', apply);
				if (window.jQuery) jQuery(countrySelect).on('change', apply);
			}
			apply();
		});
	}

	function fieldControl(field) {
		return qs('select[name], textarea[name], input[name]', field);
	}

	function fieldValue(field) {
		const input = fieldControl(field);
		return input ? String(input.value || '').trim() : '';
	}

	function validateField(field) {
		const input = fieldControl(field);
		const error = qs('[data-error]', field);
		if (!input) return true;
		const rules = (input.getAttribute('data-validate') || (input.required ? 'required' : '')).split(/\s+/).filter(Boolean);
		let message = '';
		const value = fieldValue(field);
		if (rules.includes('required') && !value) message = 'Ce champ est obligatoire.';
		if (!message && rules.includes('email') && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
			message = 'Adresse email invalide.';
		}
		if (!message && rules.includes('url') && value) {
			try {
				const parsed = new URL(value);
				if (!/^https?:$/.test(parsed.protocol)) message = 'URL invalide.';
			} catch {
				message = 'URL invalide.';
			}
		}
		if (!message && input.type === 'number' && value) {
			const min = input.min !== '' ? Number(input.min) : null;
			const max = input.max !== '' ? Number(input.max) : null;
			const num = Number(value);
			if (Number.isNaN(num) || (min !== null && num < min) || (max !== null && num > max)) {
				message = 'Valeur hors limites.';
			}
		}
		field.classList.toggle('is-invalid', Boolean(message));
		if (error) error.textContent = message;
		return !message;
	}

	function initFormValidation(form) {
		const fields = qsa('[data-field]', form);
		const submits = qsa('button[type="submit"], .js-submit', form);

		function refresh() {
			let valid = true;
			fields.forEach((field) => {
				if (!validateField(field)) valid = false;
			});
			submits.forEach((btn) => {
				btn.disabled = !valid;
			});
			return valid;
		}

		fields.forEach((field) => {
			qsa('input[name], textarea[name], select[name]', field).forEach((input) => {
				input.addEventListener('input', refresh);
				input.addEventListener('change', refresh);
				input.addEventListener('blur', () => validateField(field));
				if (window.jQuery && input.tagName === 'SELECT') {
					jQuery(input).on('change', refresh);
				}
			});
		});
		form.addEventListener('submit', (e) => {
			if (window.tinymce) window.tinymce.triggerSave();
			if (!refresh()) e.preventDefault();
		});
		refresh();
	}

	function initSwitches() {
		qsa('[data-switch]').forEach((input) => {
			const label = input.closest('.switch');
			const state = label && qs('[data-switch-state]', label);
			if (!state) return;
			function sync() {
				state.textContent = input.checked ? 'Actif' : 'Masqué';
			}
			input.addEventListener('change', sync);
			sync();
		});
	}

	function initPasswordToggles() {
		qsa('[data-password-toggle]').forEach((btn) => {
			const wrap = btn.closest('.password-field');
			const input = wrap && wrap.querySelector('input');
			if (!input) return;
			btn.addEventListener('click', () => {
				const shown = input.type === 'text';
				input.type = shown ? 'password' : 'text';
				btn.setAttribute('aria-pressed', shown ? 'false' : 'true');
				btn.setAttribute('aria-label', shown ? 'Afficher le mot de passe' : 'Masquer le mot de passe');
				const icon = btn.querySelector('i');
				if (icon) icon.className = shown ? 'fas fa-eye' : 'fas fa-eye-slash';
			});
		});
	}

	function initNavGroups() {
		qsa('[data-nav-group]').forEach((group) => {
			const toggle = qs('.nav-group-toggle', group);
			const panel = qs('.nav-group-panel', group);
			if (!toggle || !panel) return;
			toggle.addEventListener('click', () => {
				const open = group.classList.toggle('is-open');
				toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
				panel.hidden = !open;
			});
		});
	}

	initToasts();
	initConfirmModal();
	initNavGroups();
	initSwitches();
	initPasswordToggles();
	qsa('[data-table]').forEach(initDataTable);
	initSelect2(document);
	initPhoneAddon();
	qsa('form[data-admin-form]').forEach(initFormValidation);

	qsa('form').forEach((form) => {
		if (form.hasAttribute('data-admin-form')) return;
		form.addEventListener('submit', () => {
			if (window.tinymce) window.tinymce.triggerSave();
		});
	});
})();
