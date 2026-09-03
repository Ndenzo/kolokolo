(function () {
	function bindForm(form) {
		const errorBox = form.querySelector('[data-newsletter-error]');
		const successBox = form.querySelector('[data-newsletter-success]');
		const submitBtn = form.querySelector('button[type="submit"]');
		const idle = form.querySelector('.newsletter-btn-idle');
		const busy = form.querySelector('.newsletter-btn-busy');

		form.addEventListener('submit', async (event) => {
			event.preventDefault();
			if (errorBox) {
				errorBox.hidden = true;
				errorBox.textContent = '';
			}
			if (!form.reportValidity()) return;
			submitBtn.disabled = true;
			if (idle) idle.hidden = true;
			if (busy) busy.hidden = false;
			try {
				const data = new URLSearchParams(new FormData(form));
				const res = await fetch('/newsletter', {
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
						errorBox.textContent = json.error || (window.KOLOKOLO_I18N && window.KOLOKOLO_I18N.newsletterError) || 'Impossible de vous inscrire.';
						errorBox.hidden = false;
					}
					return;
				}
				form.classList.add('is-done');
				form.reset();
				if (successBox) successBox.hidden = false;
			} catch (_err) {
				if (errorBox) {
					errorBox.textContent = (window.KOLOKOLO_I18N && window.KOLOKOLO_I18N.newsletterFail) || 'Impossible de vous inscrire pour le moment.';
					errorBox.hidden = false;
				}
			} finally {
				submitBtn.disabled = false;
				if (idle) idle.hidden = false;
				if (busy) busy.hidden = true;
			}
		});
	}

	document.querySelectorAll('[data-newsletter-form]').forEach(bindForm);
})();
