// TypeIt by Alex MacArthur - https://typeitjs.com
(function (v, _) {
	typeof exports == "object" && typeof module != "undefined" ? module.exports = _() : typeof define == "function" && define.amd ? define(_) : (v = typeof globalThis != "undefined" ? globalThis : v || self, v.TypeIt = _())
})(this, function () {
	"use strict";
	var v = e => Array.isArray(e),
		_ = e => v(e) ? e : [e];
	const ne = function (e) {
		const r = function (p) {
				return f = f.concat(_(p)), this
			},
			s = function (p, m) {
				f[p] = m
			},
			o = function () {
				f = f.map(p => (delete p.done, p))
			},
			a = () => f.filter(p => !p.done),
			u = p => {
				f[p].done = !0
			};
		let f = [];
		return r(e), {
			add: r,
			set: s,
			reset: o,
			getItems: a,
			markDone: u
		}
	};
	var V = e => Array.from(e),
		$ = e => document.createTextNode(e);
	const R = e => ([...e.childNodes].forEach(r => {
		if (r.nodeValue) {
			[...r.nodeValue].forEach(s => {
				r.parentNode.insertBefore($(s), r)
			}), r.remove();
			return
		}
		R(r)
	}), e);
	var q = e => {
		let r = document.implementation.createHTMLDocument();
		return r.body.innerHTML = e, R(r.body)
	};
	const j = "data-typeit-id",
		C = "ti-cursor",
		H = "START",
		se = "END",
		oe = {
			started: !1,
			completed: !1,
			frozen: !1,
			destroyed: !1
		},
		ie = {
			breakLines: !0,
			cursor: !0,
			cursorChar: "|",
			cursorSpeed: 1e3,
			deleteSpeed: null,
			html: !0,
			lifeLike: !0,
			loop: !1,
			loopDelay: 750,
			nextStringDelay: 750,
			speed: 100,
			startDelay: 250,
			startDelete: !1,
			strings: [],
			waitUntilVisible: !1,
			beforeString: () => {},
			afterString: () => {},
			beforeStep: () => {},
			afterStep: () => {},
			afterComplete: () => {}
		};

	function B(e, r = !1) {
		const s = document.createTreeWalker(e, NodeFilter.SHOW_ALL, {
			acceptNode: u => {
				var f;
				return ((f = u == null ? void 0 : u.classList) == null ? void 0 : f.contains(C)) ? NodeFilter.FILTER_REJECT : NodeFilter.FILTER_ACCEPT
			}
		});
		let o, a = [];
		for (; o = s.nextNode();) o.originalParent = o.parentNode, a.push(o);
		return r ? a.reverse() : a
	}

	function le(e) {
		return B(q(e))
	}

	function W(e, r = !0) {
		return r ? le(e) : V(e).map($)
	}
	var I = e => document.createElement(e),
		J = (e, r = "") => {
			let s = I("style");
			s.id = r, s.appendChild($(e)), document.head.appendChild(s)
		};
	const Y = e => Number.isInteger(e),
		L = (e, r = document, s = !1) => r[`querySelector${s?"All":""}`](e);
	var F = e => "value" in e;
	const G = e => F(e) ? V(e.value) : B(e, !0).filter(r => !(r.childNodes.length > 0)),
		ae = (e, r, s = H) => {
			let o = new RegExp(se, "i").test(s),
				a = e ? L(e, r) : r,
				u = B(a, !0),
				f = u[0],
				p = u[u.length - 1],
				b = o && !e ? 0 : G(r).findIndex(x => x.isSameNode(o ? f : p));
			return o && b--, b + 1
		};
	var K = ({
			el: e,
			move: r,
			cursorPos: s,
			to: o
		}) => Y(r) ? r * -1 : ae(r, e, o) - s,
		X = e => (v(e) || (e = [e / 2, e / 2]), e),
		Z = (e, r) => Math.abs(Math.random() * (e + r - (e - r)) + (e - r));
	let ee = e => e / 2;

	function ue(e) {
		let {
			speed: r,
			deleteSpeed: s,
			lifeLike: o
		} = e;
		return s = s !== null ? s : r / 3, o ? [Z(r, ee(r)), Z(s, ee(s))] : [r, s]
	}
	var ce = e => (e.forEach(r => clearTimeout(r)), []),
		de = () => Math.random().toString().substring(2, 9),
		fe = (e, r) => {
			new IntersectionObserver((o, a) => {
				o.forEach(u => {
					u.isIntersecting && (r(), a.unobserve(e))
				})
			}, {
				threshold: 1
			}).observe(e)
		};
	const E = e => typeof e == "function" ? e() : e,
		he = e => (e == null ? void 0 : e.tagName) === "BODY",
		pe = (e, r) => {
			if (F(e)) {
				e.value = `${e.value}${r.textContent}`;
				return
			}
			r.innerHTML = "";
			let s = he(r.originalParent) ? e : r.originalParent || e;
			s.insertBefore(r, L("." + C, s) || null)
		},
		me = (e, r, s) => Math.min(Math.max(r + e, 0), s.length);
	var k = (e, r) => Object.assign({}, e, r),
		Q = e => {
			if (!e) return;
			const r = e.parentNode;
			(r.childNodes.length > 1 ? e : r).remove()
		},
		ye = (e, r, s) => {
			let o = r[s - 1],
				a = L(`.${C}`, e);
			e = (o == null ? void 0 : o.parentNode) || e, e.insertBefore(a, o || null)
		};

	function ge(e) {
		return typeof e == "string" ? L(e) : e
	}
	const Se = e => /<(.+)>(.*?)<\/(.+)>/.test(e.outerHTML),
		be = async (e, r, s) => new Promise(o => {
			const a = async () => {
				await e(), o()
			};
			s.push(setTimeout(a, r))
		}), Te = {
			"font-family": "",
			"font-weight": "",
			"font-size": "",
			"font-style": "",
			"line-height": "",
			color: "",
			"margin-left": "-.125em",
			"margin-right": ".125em"
		}, ve = (e, r, s) => {
			let a = `${`[${j}='${e}']`} .${C}`,
				u = getComputedStyle(s),
				f = Object.entries(Te).reduce((p, [m, b]) => `${p} ${m}: var(--ti-cursor-${m}, ${b||u[m]});`, "");
			J(`@keyframes blink-${e} { 0% {opacity: 0} 49% {opacity: 0} 50% {opacity: 1} } ${a} { display: inline; letter-spacing: -1em; ${f} animation: blink-${e} ${r.cursorSpeed/1e3}s infinite; } ${a}.with-delay { animation-delay: 500ms; } ${a}.disabled { animation: none; }`, e)
		};

	function _e(e, r = {}) {
		const s = async (t, n, l = !1) => {
			g.frozen && await new Promise(h => {
				this.unfreeze = () => {
					g.frozen = !1, h()
				}
			}), l || await i.beforeStep(this), await be(t, n, U), l || await i.afterStep(this)
		}, o = () => F(c), a = t => ue(i)[t], u = () => G(c), f = (t, n = 0) => t ? a(n) : 0, p = (t = {}) => {
			let n = t.delay;
			n && S.add(() => w(n))
		}, m = (t, n) => (S.add(t), p(n), this), b = (t = {}) => [() => P(t), () => P(i)], x = t => {
			let n = i.nextStringDelay;
			S.add([() => w(n[0]), ...t, () => w(n[1])])
		}, Ee = () => {
			if (o()) return;
			let t = I("span");
			return t.className = C, O ? (t.innerHTML = q(i.cursorChar).innerHTML, t) : (t.style.visibility = "hidden", t)
		}, we = async () => {
			!o() && c.appendChild(M), O && ve(re, i, c)
		}, A = t => {
			O && (M.classList.toggle("disabled", t), M.classList.toggle("with-delay", !t))
		}, Ce = () => {
			let t = i.strings.filter(n => !!n);
			t.forEach((n, l) => {
				let h = W(n, i.html);
				if (S.add(() => D({
						chars: h
					})), l + 1 === t.length) return;
				const d = [i.breakLines ? () => D({
					chars: [I("BR")],
					silent: !0
				}) : () => N({
					num: h.length
				})];
				x(d)
			})
		}, Ne = async t => {
			T && await te({
				value: T
			}), S.reset(), S.set(0, () => w(t)), await N({
				num: null
			})
		}, Ie = t => {
			let n = c.innerHTML;
			return n ? (c.innerHTML = "", i.startDelete ? (c.innerHTML = n, R(c), x([() => N({
				num: null
			})]), t) : n.trim().split(/<br(?:\s*?)(?:\/)?>/).concat(t)) : t
		}, z = async () => {
			g.started = !0;
			let t = S.getItems();
			try {
				for (let l = 0; l < t.length; l++) await t[l](), S.markDone(l), A(!1);
				if (g.completed = !0, await i.afterComplete(this), !i.loop) throw "";
				let n = i.loopDelay;
				s(async () => {
					await Ne(n[0]), z()
				}, n[1])
			} catch {}
			return this
		}, w = (t = 0) => s(() => {}, t), te = async ({
			value: t,
			to: n = H,
			instant: l = !1
		}) => {
			A(!0);
			let h = K({
					el: c,
					move: t,
					cursorPos: T,
					to: n
				}),
				d = () => {
					T = me(h < 0 ? -1 : 1, T, u()), ye(c, u(), T)
				};
			await s(async () => {
				for (let y = 0; y < Math.abs(h); y++) l ? d() : await s(d, a(0))
			}, f(l))
		}, D = ({
			chars: t,
			silent: n = !1,
			instant: l = !1
		}) => (A(!0), s(async () => {
			const h = d => pe(c, d);
			n || await i.beforeString(t, this);
			for (let d of t) l || Se(d) ? h(d) : await s(() => h(d), a(0));
			n || await i.afterString(t, this)
		}, f(l), !0)), P = async t => {
			i = k(i, t)
		}, Le = async () => {
			if (o()) {
				c.value = "";
				return
			}
			u().forEach(t => {
				Q(t)
			})
		}, N = async ({
			num: t = null,
			instant: n = !1,
			to: l = H
		}) => {
			A(!0), await s(async () => {
				let h = Y(t) || o() ? t : K({
					el: c,
					move: t,
					cursorPos: T,
					to: l
				});
				const d = () => {
					let y = u();
					!y.length || (o() ? c.value = c.value.slice(0, -1) : Q(y[T]))
				};
				for (let y = 0; y < h; y++) n ? d() : await s(d, a(1))
			}, f(n, 1)), t === null && u().length - 1 > 0 && await N({
				num: null
			})
		};
		this.break = function (t) {
			return m(() => D({
				chars: [I("BR")],
				silent: !0
			}), t)
		}, this.delete = function (t = null, n = {}) {
			t = E(t);
			let l = b(n),
				h = t,
				{
					instant: d,
					to: y
				} = n;
			return m([l[0], () => N({
				num: h,
				instant: d,
				to: y
			}), l[1]], n)
		}, this.empty = function (t = {}) {
			return m(Le, t)
		}, this.exec = function (t, n) {
			let l = b(n);
			return m([l[0], t, l[1]], n)
		}, this.move = function (t, n = {}) {
			t = E(t);
			let l = b(n),
				{
					instant: h,
					to: d
				} = n,
				y = {
					value: t === null ? "" : t,
					to: d,
					instant: h
				};
			return m([l[0], () => te(y), l[1]], n)
		}, this.options = function (t) {
			return t = E(t), m(() => P(t), t)
		}, this.pause = function (t, n = {}) {
			return m(() => w(E(t)), n)
		}, this.type = function (t, n = {}) {
			t = E(t);
			let l = b(n),
				h = W(t, i.html),
				{
					instant: d
				} = n,
				y = [l[0], () => D({
					chars: h,
					instant: d
				}), l[1]];
			return m(y, n)
		}, this.is = function (t) {
			return g[t]
		}, this.destroy = function (t = !0) {
			U = ce(U), E(t) && Q(M), g.destroyed = !0
		}, this.freeze = function () {
			g.frozen = !0
		}, this.unfreeze = function () {}, this.reset = function () {
			!this.is("destroyed") && this.destroy(), S.reset(), T = 0;
			for (let t in g) g[t] = !1;
			return c[o() ? "value" : "innerHTML"] = "", this
		}, this.go = function () {
			return g.started ? this : (we(), i.waitUntilVisible ? (fe(c, z.bind(this)), this) : (z(), this))
		}, this.getQueue = () => S, this.getOptions = () => i, this.updateOptions = t => P(t), this.getElement = () => c;
		let c = ge(e),
			U = [],
			T = 0,
			g = k({}, oe),
			i = k(ie, r);
		i = k(i, {
			html: !o() && i.html,
			nextStringDelay: X(i.nextStringDelay),
			loopDelay: X(i.loopDelay)
		});
		let re = de(),
			S = ne([() => w(i.startDelay)]);
		c.dataset.typeitId = re, J(`[${j}]:before {content: '.'; display: inline-block; width: 0; visibility: hidden;}`);
		let O = i.cursor && !o(),
			M = Ee();
		i.strings = Ie(_(i.strings)), i.strings.length && Ce()
	}
	return _e
});
