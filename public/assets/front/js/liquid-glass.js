(function () {
	var GLASS_SELECTOR = '.grb-btn, .grb-border-btn, .quote-btn-primary, .subscribe-form button, .bs-ad-cta';
	var reduceQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

	function prefersReduced() {
		return reduceQuery.matches;
	}

	function setPoint(el, x, y) {
		el.style.setProperty('--glass-x', x + '%');
		el.style.setProperty('--glass-y', y + '%');
	}

	function bindGlass(el) {
		if (el.dataset.liquidGlass === '1') return;
		el.dataset.liquidGlass = '1';
		setPoint(el, 50, 16);
		if (prefersReduced()) return;

		el.addEventListener('pointermove', function (event) {
			var rect = el.getBoundingClientRect();
			if (!rect.width || !rect.height) return;
			setPoint(
				el,
				((event.clientX - rect.left) / rect.width) * 100,
				((event.clientY - rect.top) / rect.height) * 100
			);
		});

		el.addEventListener('pointerleave', function () {
			setPoint(el, 50, 16);
		});
	}

	function scanGlass() {
		document.querySelectorAll(GLASS_SELECTOR).forEach(bindGlass);
	}

	function initParticles() {
		var area = document.querySelector('.slider-area');
		var host = area && (area.querySelector('.slider-active') || area);
		if (!host || prefersReduced()) return;

		var canvas = document.createElement('canvas');
		canvas.className = 'hero-particles';
		canvas.setAttribute('aria-hidden', 'true');
		host.appendChild(canvas);

		var ctx = canvas.getContext('2d', { alpha: true });
		if (!ctx) return;

		var particles = [];
		var width = 0;
		var height = 0;
		var dpr = 1;
		var running = false;
		var inView = true;
		var pageVisible = !document.hidden;
		var detached = false;
		var raf = 0;
		var resizeTimer = 0;

		function count() {
			return window.innerWidth < 768 ? 70 : 120;
		}

		function spawn(total) {
			var list = [];
			var i;
			var large;
			for (i = 0; i < total; i += 1) {
				large = Math.random() > 0.72;
				list.push({
					x: Math.random(),
					y: Math.random(),
					r: large ? 2.2 + Math.random() * 2.8 : 1.1 + Math.random() * 2,
					vx: (Math.random() - 0.5) * 0.004,
					vy: -0.0012 - Math.random() * 0.0028,
					wobble: Math.random() * Math.PI * 2,
					wobbleSpeed: 0.004 + Math.random() * 0.008,
					wobbleAmp: 0.0004 + Math.random() * 0.0008,
					alpha: large ? 0.45 + Math.random() * 0.4 : 0.32 + Math.random() * 0.45,
					pulse: Math.random() * Math.PI * 2,
					speed: 0.006 + Math.random() * 0.01,
					amber: Math.random() > 0.35,
					glow: large
				});
			}
			return list;
		}

		function resize() {
			if (detached || !canvas.isConnected) return;
			var rect = host.getBoundingClientRect();
			dpr = Math.min(window.devicePixelRatio || 1, 2);
			width = Math.max(1, Math.round(rect.width));
			height = Math.max(1, Math.round(rect.height));
			canvas.width = Math.round(width * dpr);
			canvas.height = Math.round(height * dpr);
			canvas.style.width = width + 'px';
			canvas.style.height = height + 'px';
			ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
			if (particles.length !== count()) {
				particles = spawn(count());
			}
		}

		function frame() {
			if (!running || detached) return;
			if (!inView || !pageVisible) return;
			ctx.clearRect(0, 0, width, height);
			var i;
			var p;
			var glow;
			var px;
			var py;
			for (i = 0; i < particles.length; i += 1) {
				p = particles[i];
				p.wobble += p.wobbleSpeed;
				p.x += p.vx + Math.sin(p.wobble) * p.wobbleAmp;
				p.y += p.vy;
				p.pulse += p.speed;
				if (p.y < -0.02) {
					p.y = 1.02;
					p.x = Math.random();
				}
				if (p.x < -0.02) p.x = 1.02;
				if (p.x > 1.02) p.x = -0.02;

				glow = p.alpha * (0.55 + 0.45 * Math.sin(p.pulse));
				px = p.x * width;
				py = p.y * height;
				ctx.beginPath();
				ctx.shadowBlur = p.glow ? 16 : 7;
				ctx.shadowColor = p.amber
					? 'rgba(245, 166, 35, 0.9)'
					: 'rgba(255, 10, 8, 0.85)';
				ctx.fillStyle = p.amber
					? 'rgba(245, 166, 35,' + glow.toFixed(3) + ')'
					: 'rgba(255, 10, 8,' + glow.toFixed(3) + ')';
				ctx.arc(px, py, p.r, 0, Math.PI * 2);
				ctx.fill();
			}
			ctx.shadowBlur = 0;
			raf = window.requestAnimationFrame(frame);
		}

		function kick() {
			if (!running || detached || !inView || !pageVisible) return;
			window.cancelAnimationFrame(raf);
			raf = window.requestAnimationFrame(frame);
		}

		function start() {
			if (running || prefersReduced()) return;
			running = true;
			kick();
		}

		function stop() {
			running = false;
			window.cancelAnimationFrame(raf);
		}

		function detach() {
			detached = true;
			stop();
			if (canvas.parentNode) canvas.parentNode.removeChild(canvas);
		}

		resize();
		particles = spawn(count());

		if (typeof IntersectionObserver === 'function') {
			inView = false;
			var observer = new IntersectionObserver(function (entries) {
				inView = !!(entries[0] && entries[0].isIntersecting);
				if (inView) kick();
			}, { threshold: 0.08 });
			observer.observe(area || host);
		}

		window.addEventListener('resize', function () {
			window.clearTimeout(resizeTimer);
			resizeTimer = window.setTimeout(resize, 120);
		}, { passive: true });

		document.addEventListener('visibilitychange', function () {
			pageVisible = !document.hidden;
			if (pageVisible) kick();
		});

		start();

		if (typeof reduceQuery.addEventListener === 'function') {
			reduceQuery.addEventListener('change', function () {
				if (prefersReduced()) detach();
			});
		}
	}

	function boot() {
		scanGlass();
		initParticles();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', boot);
	} else {
		boot();
	}
})();
