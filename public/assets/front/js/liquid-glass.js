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

	// Hero : lumières douces (bokeh) sur plusieurs plans de profondeur, qui réagissent au curseur.
	// - les lumières proches du curseur s'éclairent et y sont reliées par de fins fils dorés ;
	// - elles s'écartent en tourbillonnant puis reviennent en place (ressort amorti) ;
	// - un mouvement rapide laisse une traînée d'étincelles ; un clic envoie une onde.
	function initParticles() {
		var area = document.querySelector('.slider-area');
		var host = area && (area.querySelector('.slider-active') || area);
		if (!host || prefersReduced()) return;
		var zone = area || host;

		var canvas = document.createElement('canvas');
		canvas.className = 'hero-particles';
		canvas.setAttribute('aria-hidden', 'true');
		host.appendChild(canvas);

		var ctx = canvas.getContext('2d', { alpha: true });
		if (!ctx) return;

		var COLORS = [[245, 166, 35], [245, 166, 35], [255, 122, 58], [255, 42, 30]];
		var sprites = COLORS.map(makeSprite);
		var sparkSprite = makeSprite([255, 196, 120]);

		var particles = [];
		var sparks = [];
		var ripples = [];
		var width = 0;
		var height = 0;
		var dpr = 1;
		var running = false;
		var inView = true;
		var pageVisible = !document.hidden;
		var detached = false;
		var raf = 0;
		var resizeTimer = 0;
		var last = 0;
		var born = 0;
		var radius = 190;
		// Curseur : position brute, position lissée, présence (0 → 1).
		var cursor = { x: 0, y: 0, sx: 0, sy: 0, on: false, presence: 0, lastX: null, lastY: null };
		var tilt = { x: 0, y: 0, tx: 0, ty: 0 };

		function makeSprite(c) {
			var size = 128;
			var s = document.createElement('canvas');
			s.width = size;
			s.height = size;
			var g = s.getContext('2d');
			var grad = g.createRadialGradient(size / 2, size / 2, 0, size / 2, size / 2, size / 2);
			var rgb = c[0] + ',' + c[1] + ',' + c[2];
			grad.addColorStop(0, 'rgba(255,236,205,1)');
			grad.addColorStop(0.18, 'rgba(' + rgb + ',0.95)');
			grad.addColorStop(0.45, 'rgba(' + rgb + ',0.4)');
			grad.addColorStop(0.72, 'rgba(' + rgb + ',0.1)');
			grad.addColorStop(1, 'rgba(' + rgb + ',0)');
			g.fillStyle = grad;
			g.fillRect(0, 0, size, size);
			return s;
		}

		function count() {
			return window.innerWidth < 768 ? 18 : 38;
		}

		function makeParticle(anyHeight) {
			var z = 0.2 + Math.pow(Math.random(), 1.6) * 0.8;
			return {
				x: Math.random(),
				y: anyHeight ? Math.random() : 1.08,
				z: z,
				size: 16 + z * z * 70,
				rise: 4 + z * 9,
				sway: 6 + Math.random() * 14,
				swayPeriod: 14000 + Math.random() * 16000,
				phase: Math.random() * Math.PI * 2,
				breathPeriod: 5000 + Math.random() * 7000,
				alpha: 0.3 + z * 0.5,
				sprite: sprites[(Math.random() * sprites.length) | 0],
				ox: 0, oy: 0, vx: 0, vy: 0, // déplacement dû au curseur
				lit: 0,                     // éclairage dû au curseur (lissé)
				px: 0, py: 0
			};
		}

		function spawn(total) {
			var list = [];
			for (var i = 0; i < total; i += 1) list.push(makeParticle(true));
			return list;
		}

		function resize() {
			if (detached || !canvas.isConnected) return;
			var rect = host.getBoundingClientRect();
			dpr = Math.min(window.devicePixelRatio || 1, 2);
			width = Math.max(1, Math.round(rect.width));
			height = Math.max(1, Math.round(rect.height));
			radius = Math.max(130, Math.min(220, width * 0.15));
			canvas.width = Math.round(width * dpr);
			canvas.height = Math.round(height * dpr);
			canvas.style.width = width + 'px';
			canvas.style.height = height + 'px';
			ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
			if (particles.length !== count()) particles = spawn(count());
		}

		function edgeFade(y) {
			var fade = 0.14;
			if (y > 1 - fade) return Math.max(0, (1.08 - y) / (fade + 0.08));
			if (y < fade) return Math.max(0, y / fade);
			return 1;
		}

		function localPoint(event) {
			var rect = host.getBoundingClientRect();
			return { x: event.clientX - rect.left, y: event.clientY - rect.top };
		}

		function emitSparks(x, y, amount, dirX, dirY) {
			for (var i = 0; i < amount && sparks.length < 90; i += 1) {
				var angle = Math.random() * Math.PI * 2;
				var speed = 10 + Math.random() * 34;
				sparks.push({
					x: x + (Math.random() - 0.5) * 6,
					y: y + (Math.random() - 0.5) * 6,
					vx: Math.cos(angle) * speed - dirX * 0.08,
					vy: Math.sin(angle) * speed - dirY * 0.08 - 12,
					life: 0,
					ttl: 0.8 + Math.random() * 0.9,
					size: 5 + Math.random() * 9
				});
			}
		}

		function frame(now) {
			if (!running || detached || !inView || !pageVisible) return;
			var dtMs = last ? Math.min(now - last, 50) : 16;
			var dt = dtMs / 1000;
			last = now;
			if (!born) born = now;

			var intro = Math.min(1, (now - born) / 2500);
			intro = intro * intro * (3 - 2 * intro);

			// Lissages : curseur, présence, inclinaison (parallaxe).
			var follow = 1 - Math.pow(0.0005, dt);
			var slow = 1 - Math.pow(0.04, dt);
			cursor.sx += (cursor.x - cursor.sx) * follow;
			cursor.sy += (cursor.y - cursor.sy) * follow;
			cursor.presence += ((cursor.on ? 1 : 0) - cursor.presence) * (1 - Math.pow(0.02, dt));
			tilt.x += (tilt.tx - tilt.x) * slow;
			tilt.y += (tilt.ty - tilt.y) * slow;

			ctx.clearRect(0, 0, width, height);
			ctx.globalCompositeOperation = 'lighter';

			// Halo très doux qui suit le curseur.
			if (cursor.presence > 0.01) {
				var halo = radius * 1.5;
				ctx.globalAlpha = 0.24 * cursor.presence * intro;
				ctx.drawImage(sparkSprite, cursor.sx - halo / 2, cursor.sy - halo / 2, halo, halo);
			}

			var i;
			var j;
			var p;
			for (i = 0; i < particles.length; i += 1) {
				p = particles[i];
				p.y -= (p.rise * dt) / height;
				if (p.y < -0.08) {
					particles[i] = p = makeParticle(false);
				}
				var t = now + p.phase * 1000;
				var baseX = p.x * width + Math.sin((t / p.swayPeriod) * Math.PI * 2) * p.sway - tilt.x * 28 * p.z;
				var baseY = p.y * height - tilt.y * 18 * p.z;

				// Forces : remous autour du curseur + ondes, puis ressort qui ramène en place.
				var ax = -p.ox * 7 - p.vx * 3.2;
				var ay = -p.oy * 7 - p.vy * 3.2;
				var cx = baseX + p.ox;
				var cy = baseY + p.oy;
				var near = 0;
				if (cursor.presence > 0.01) {
					var dx = cx - cursor.sx;
					var dy = cy - cursor.sy;
					var d = Math.sqrt(dx * dx + dy * dy) || 1;
					var link = radius * 1.45;
					if (d < link) near = 1 - d / link;
					if (d < radius) {
						var g = 1 - d / radius;
						var f = g * g * cursor.presence * (0.5 + p.z);
						ax += (dx / d) * f * 520 + (-dy / d) * f * 620;
						ay += (dy / d) * f * 520 + (dx / d) * f * 620;
					}
				}
				for (j = 0; j < ripples.length; j += 1) {
					var r = ripples[j];
					var rx = cx - r.x;
					var ry = cy - r.y;
					var rd = Math.sqrt(rx * rx + ry * ry) || 1;
					var band = Math.abs(rd - r.r);
					if (band < 50) {
						var push = (1 - band / 50) * (1 - r.life / r.ttl) * 5200 * (0.4 + p.z);
						ax += (rx / rd) * push;
						ay += (ry / rd) * push;
					}
				}
				p.vx += ax * dt;
				p.vy += ay * dt;
				p.ox += p.vx * dt;
				p.oy += p.vy * dt;
				p.lit += (near - p.lit) * (1 - Math.pow(0.002, dt));
				p.px = baseX + p.ox;
				p.py = baseY + p.oy;
			}

			// Fils dorés entre le curseur et les lumières proches.
			if (cursor.presence > 0.01) {
				ctx.lineWidth = 0.8;
				for (i = 0; i < particles.length; i += 1) {
					p = particles[i];
					if (p.lit < 0.04) continue;
					ctx.globalAlpha = Math.min(1, p.lit * 1.6) * 0.55 * cursor.presence * intro * edgeFade(p.y);
					ctx.strokeStyle = 'rgb(245,176,70)';
					ctx.beginPath();
					ctx.moveTo(cursor.sx, cursor.sy);
					ctx.lineTo(p.px, p.py);
					ctx.stroke();
				}
			}

			// Lumières.
			for (i = 0; i < particles.length; i += 1) {
				p = particles[i];
				var tt = now + p.phase * 1000;
				var breath = 0.55 + 0.45 * Math.sin((tt / p.breathPeriod) * Math.PI * 2);
				var boost = 1 + p.lit * 1.6;
				var a = Math.min(1, p.alpha * Math.max(breath, p.lit) * boost) * edgeFade(p.y) * intro;
				if (a <= 0.005) continue;
				var size = p.size * (1 + p.lit * 0.35);
				ctx.globalAlpha = a;
				ctx.drawImage(p.sprite, p.px - size / 2, p.py - size / 2, size, size);
			}

			// Étincelles.
			for (i = sparks.length - 1; i >= 0; i -= 1) {
				var s = sparks[i];
				s.life += dt;
				if (s.life >= s.ttl) {
					sparks.splice(i, 1);
					continue;
				}
				s.vx *= Math.pow(0.25, dt);
				s.vy = s.vy * Math.pow(0.25, dt) - 6 * dt;
				s.x += s.vx * dt;
				s.y += s.vy * dt;
				var k = 1 - s.life / s.ttl;
				ctx.globalAlpha = k * k * 0.9;
				var ss = s.size * (0.4 + 0.6 * k);
				ctx.drawImage(sparkSprite, s.x - ss / 2, s.y - ss / 2, ss, ss);
			}

			// Ondes.
			ctx.globalCompositeOperation = 'source-over';
			for (i = ripples.length - 1; i >= 0; i -= 1) {
				var w = ripples[i];
				w.life += dt;
				if (w.life >= w.ttl) {
					ripples.splice(i, 1);
					continue;
				}
				var q = w.life / w.ttl;
				w.r = w.max * (1 - Math.pow(1 - q, 3));
				ctx.globalAlpha = 0.35 * (1 - q) * (1 - q);
				ctx.lineWidth = 1.2;
				ctx.strokeStyle = 'rgb(255,206,150)';
				ctx.beginPath();
				ctx.arc(w.x, w.y, w.r, 0, Math.PI * 2);
				ctx.stroke();
			}

			ctx.globalAlpha = 1;
			raf = window.requestAnimationFrame(frame);
		}

		function kick() {
			if (!running || detached || !inView || !pageVisible) return;
			window.cancelAnimationFrame(raf);
			last = 0;
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
			observer.observe(zone);
		}

		zone.addEventListener('pointermove', function (event) {
			var pt = localPoint(event);
			if (!cursor.on) {
				cursor.sx = pt.x;
				cursor.sy = pt.y;
			}
			cursor.x = pt.x;
			cursor.y = pt.y;
			cursor.on = true;
			tilt.tx = (pt.x / width - 0.5) * 2;
			tilt.ty = (pt.y / height - 0.5) * 2;
			if (cursor.lastX !== null) {
				var mx = pt.x - cursor.lastX;
				var my = pt.y - cursor.lastY;
				var dist = Math.sqrt(mx * mx + my * my);
				if (dist > 6) emitSparks(pt.x, pt.y, Math.min(3, Math.floor(dist / 14)), mx * 20, my * 20);
			}
			cursor.lastX = pt.x;
			cursor.lastY = pt.y;
		}, { passive: true });

		zone.addEventListener('pointerleave', function () {
			cursor.on = false;
			cursor.lastX = null;
			cursor.lastY = null;
			tilt.tx = 0;
			tilt.ty = 0;
		});

		zone.addEventListener('pointerup', function (event) {
			if (event.pointerType === 'touch') cursor.on = false;
			cursor.lastX = null;
			cursor.lastY = null;
		});

		zone.addEventListener('pointerdown', function (event) {
			var pt = localPoint(event);
			if (ripples.length < 4) ripples.push({ x: pt.x, y: pt.y, r: 0, max: Math.max(220, radius * 1.8), life: 0, ttl: 1.3 });
			emitSparks(pt.x, pt.y, 10, 0, 0);
		}, { passive: true });

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
