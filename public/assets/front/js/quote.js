(function () {
	const modal = document.getElementById('quote-modal');
	if (!modal) return;
	const form = document.getElementById('quote-form');
	const offerInput = document.getElementById('quote-offer');
	const errorBox = modal.querySelector('[data-quote-error]');
	const successBox = modal.querySelector('[data-quote-success]');
	const submitBtn = form.querySelector('.quote-submit');

	function enhanceQuoteSelects() {
		if (!window.jQuery || !jQuery.fn.select2) return;
		jQuery('#quote-form select').each(function () {
			const $el = jQuery(this);
			if ($el.hasClass('select2-hidden-accessible')) return;
			$el.select2({
				width: '100%',
				language: document.documentElement.lang === 'en' ? 'en' : 'fr',
				placeholder: (window.KOLOKOLO_I18N && window.KOLOKOLO_I18N.choose) || 'Choisir',
				allowClear: true,
				dropdownParent: jQuery('#quote-modal'),
			});
		});
	}

	function openModal(opts) {
		document.body.classList.add('quote-open');
		modal.hidden = false;
		enhanceQuoteSelects();
		form.hidden = false;
		successBox.hidden = true;
		errorBox.hidden = true;
		errorBox.textContent = '';
		offerInput.value = opts.offer || '';
		modal.querySelectorAll('input[name="services"]').forEach((input) => {
			input.checked = Boolean(opts.service) && input.value === opts.service;
		});
		const first = form.querySelector('input[name="firstname"]');
		if (first) first.focus();
	}

	function closeModal() {
		document.body.classList.remove('quote-open');
		modal.hidden = true;
	}

	document.addEventListener('click', (event) => {
		const trigger = event.target.closest('[data-quote-open]');
		if (trigger) {
			event.preventDefault();
			openModal({
				service: trigger.getAttribute('data-quote-service') || '',
				offer: trigger.getAttribute('data-quote-offer') || '',
			});
			return;
		}
		if (event.target.closest('[data-quote-close]')) {
			event.preventDefault();
			closeModal();
		}
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && !modal.hidden) {
			if (window.jQuery && jQuery('.select2-container--open').length) return;
			closeModal();
		}
	});

	form.addEventListener('submit', async (event) => {
		event.preventDefault();
		errorBox.hidden = true;
		const selected = Array.from(form.querySelectorAll('input[name="services"]:checked'));
		if (!form.reportValidity()) return;
		if (!selected.length) {
			errorBox.textContent = (window.KOLOKOLO_I18N && window.KOLOKOLO_I18N.quoteService) || 'Sélectionnez au moins un service.';
			errorBox.hidden = false;
			return;
		}
		submitBtn.disabled = true;
		const idle = submitBtn.querySelector('.quote-btn-idle');
		const busy = submitBtn.querySelector('.quote-btn-busy');
		if (idle) idle.hidden = true;
		if (busy) busy.hidden = false;
		try {
			const data = new URLSearchParams(new FormData(form));
			const res = await fetch('/devis', {
				method: 'POST',
				headers: {
					Accept: 'application/json',
					'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
				},
				body: data.toString(),
			});
			const json = await res.json().catch(() => ({}));
			if (!res.ok || !json.ok) {
				errorBox.textContent = json.error || (window.KOLOKOLO_I18N && window.KOLOKOLO_I18N.quoteSendError) || 'Impossible d’envoyer la demande.';
				errorBox.hidden = false;
				return;
			}
			form.reset();
			offerInput.value = '';
			if (window.jQuery) jQuery('#quote-form select').val(null).trigger('change');
			form.hidden = true;
			successBox.hidden = false;
		} catch (_err) {
			errorBox.textContent = (window.KOLOKOLO_I18N && window.KOLOKOLO_I18N.quoteSendFail) || 'Impossible d’envoyer la demande pour le moment.';
			errorBox.hidden = false;
		} finally {
			submitBtn.disabled = false;
			if (idle) idle.hidden = false;
			if (busy) busy.hidden = true;
		}
	});
})();
