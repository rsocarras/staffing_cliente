/**
 * Conceptos de novedad por cargo: «Todos» y sincronización del maestro.
 * Delegación en document para que funcione con formularios cargados por AJAX (modal de cargos).
 */
(function () {
	'use strict';

	function checksMismoTipo(root, tid) {
		var want = String(tid != null ? tid : '');
		var list = [];
		if (!root || !root.querySelectorAll) {
			return list;
		}
		root.querySelectorAll('.js-cargo-concepto-check').forEach(function (cb) {
			if (String(cb.getAttribute('data-tipo-id') || '') === want) {
				list.push(cb);
			}
		});
		return list;
	}

	function masterTodosPorTipo(root, tid) {
		var want = String(tid != null ? tid : '');
		var found = null;
		if (!root || !root.querySelectorAll) {
			return null;
		}
		root.querySelectorAll('.js-cargo-concepto-todos').forEach(function (m) {
			if (String(m.getAttribute('data-tipo-id') || '') === want) {
				found = m;
			}
		});
		return found;
	}

	function syncMasters(root) {
		if (!root) {
			return;
		}
		root.querySelectorAll('.js-cargo-concepto-todos').forEach(function (master) {
			var tid = master.getAttribute('data-tipo-id');
			var all = checksMismoTipo(root, tid);
			var n = all.length;
			var k = 0;
			all.forEach(function (x) {
				if (x.checked) {
					k++;
				}
			});
			master.checked = n > 0 && k === n;
			master.indeterminate = k > 0 && k < n;
		});
	}

	function wrapFrom(el) {
		return el && el.closest ? el.closest('#js-cargo-conceptos-wrap') : null;
	}

	document.addEventListener('change', function (e) {
		var t = e.target;
		if (!t || !t.classList) {
			return;
		}

		if (t.classList.contains('js-cargo-concepto-todos')) {
			var root = wrapFrom(t);
			if (!root) {
				return;
			}
			var tid = t.getAttribute('data-tipo-id');
			var on = t.checked;
			checksMismoTipo(root, tid).forEach(function (cb) {
				cb.checked = on;
			});
			t.indeterminate = false;
			return;
		}

		if (t.classList.contains('js-cargo-concepto-check')) {
			var root2 = wrapFrom(t);
			if (!root2) {
				return;
			}
			var tid2 = t.getAttribute('data-tipo-id');
			var master = masterTodosPorTipo(root2, tid2);
			if (!master) {
				return;
			}
			var all = checksMismoTipo(root2, tid2);
			var n = all.length;
			var k = 0;
			all.forEach(function (x) {
				if (x.checked) {
					k++;
				}
			});
			master.checked = n > 0 && k === n;
			master.indeterminate = k > 0 && k < n;
		}
	});

	window.staffingCargoConceptosSyncRoot = function (root) {
		syncMasters(root);
	};
})();
