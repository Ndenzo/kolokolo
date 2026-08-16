(function () {
	const form = document.getElementById('contact-form');
	if (!form) return;
	const errorBox = document.querySelector('[data-contact-error]');
	const successBox = document.querySelector('[data-contact-success]');
	const submitBtn = form.querySelector('button[type="submit"]');

	if (window.jQuery && jQuery.fn.select2) {
		const $form = jQuery('#contact-form');
		$form.find('select').select2({
			width: '100%',
			language: 'fr',
			placeholder: 'Choisir un sujet',
			allowClear: false,
			dropdownParent: jQuery('.get-in-touch').length ? jQuery('.get-in-touch') : $form,
			minimumResultsForSearch: Infinity,
		});
	}

	form.addEventListener('submit', async (event) => {
		event.preventDefault();
		if (errorBox) {
			errorBox.hidden = true;
			errorBox.textContent = '';
		}
		if (!form.reportValidity()) return;
		submitBtn.disabled = true;
		const idle = submitBtn.querySelector('.quote-btn-idle');
		const busy = submitBtn.querySelector('.quote-btn-busy');
		if (idle) idle.hidden = true;
		if (busy) busy.hidden = false;
		try {
			const data = new URLSearchParams(new FormData(form));
			const res = await fetch('/contact', {
				method: 'POST',
				headers: {
					Accept: 'application/json',
					'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
				},
				body: data.toString(),
			});
			const json = await res.json().catch(() => ({}));
			if (!res.ok || !json.ok) {
				if (errorBox) {
					errorBox.textContent = json.error || 'Impossible d’envoyer le message.';
					errorBox.hidden = false;
				}
				return;
			}
			form.reset();
			if (window.jQuery) jQuery('#contact-form select').val(null).trigger('change');
			form.hidden = true;
			if (successBox) successBox.hidden = false;
			const heading = document.querySelector('.get-in-touch .contact-heading');
			if (heading) heading.hidden = true;
		} catch (_err) {
			if (errorBox) {
				errorBox.textContent = 'Impossible d’envoyer le message pour le moment.';
				errorBox.hidden = false;
			}
		} finally {
			submitBtn.disabled = false;
			if (idle) idle.hidden = false;
			if (busy) busy.hidden = true;
		}
	});
})();
