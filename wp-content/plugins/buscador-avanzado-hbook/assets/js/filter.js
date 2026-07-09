/**
 * Buscador Avanzado HBook — motor de filtrado en tiempo real.
 * Vanilla JS, sin dependencias. Usa Fetch API contra admin-ajax.php.
 */
(function () {
  'use strict';

  if (typeof window.BAH_DATA === 'undefined') {
    return;
  }

  var DEBOUNCE_MS = 220;

  function init(root) {
    var data = window.BAH_DATA;

    var els = {
      root: root,
      form: root.querySelector('[data-bah-filters] #bah-filters-form') || root.querySelector('#bah-filters-form'),
      grid: root.querySelector('[data-bah-grid]'),
      gridWrap: root.querySelector('[data-bah-grid-wrap]'),
      count: root.querySelector('[data-bah-count]'),
      empty: root.querySelector('[data-bah-empty]'),
      spinner: root.querySelector('[data-bah-spinner]'),
      loadMoreBtn: root.querySelector('[data-bah-loadmore]'),
      filtersPanel: root.querySelector('[data-bah-filters]'),
      openBtn: root.querySelector('[data-bah-open-filters]'),
      closeBtns: root.querySelectorAll('[data-bah-close-filters]'),
      overlay: root.querySelector('[data-bah-overlay]'),
      clearBtns: root.querySelectorAll('[data-bah-clear-filters]'),
      mobileBadge: root.querySelector('[data-bah-active-count]'),
    };

    if (!els.form || !els.grid) {
      return;
    }

    var state = {
      page: 1,
      controller: null,
      debounceTimer: null,
    };

    bindFilterEvents();
    bindOffCanvas();
    bindLoadMore();
    applyFiltersFromUrl();
    updateMobileBadge();

    /* ── Recolección de filtros activos ── */

    function getActiveFilters() {
      var filters = {};
      var inputs = els.form.querySelectorAll('.bah-checkbox__input:checked');

      inputs.forEach(function (input) {
        var tax = input.getAttribute('data-taxonomy');
        if (!filters[tax]) {
          filters[tax] = [];
        }
        filters[tax].push(input.value);
      });

      return filters;
    }

    function countActiveFilters() {
      return els.form.querySelectorAll('.bah-checkbox__input:checked').length;
    }

    function updateMobileBadge() {
      if (!els.mobileBadge) {
        return;
      }
      var n = countActiveFilters();
      els.mobileBadge.textContent = String(n);
      els.mobileBadge.hidden = n === 0;
    }

    /* ── Deep-linking simple vía slugs de término en la URL ── */

    function applyFiltersFromUrl() {
      var params = new URLSearchParams(window.location.search);
      var slugs = params.getAll('bah');

      if (!slugs.length) {
        return;
      }

      var toCheck = els.form.querySelectorAll('.bah-checkbox__input');
      toCheck.forEach(function (input) {
        if (slugs.indexOf(input.getAttribute('data-slug')) !== -1) {
          input.checked = true;
        }
      });

      updateMobileBadge();
      fetchResults(true);
    }

    function syncUrl() {
      var params = new URLSearchParams(window.location.search);
      params.delete('bah');

      els.form.querySelectorAll('.bah-checkbox__input:checked').forEach(function (input) {
        params.append('bah', input.getAttribute('data-slug'));
      });

      var query = params.toString();
      var newUrl = window.location.pathname + (query ? '?' + query : '') + window.location.hash;

      window.history.replaceState({}, '', newUrl);
    }

    /* ── Eventos de filtros ── */

    function bindFilterEvents() {
      els.form.addEventListener('change', function (event) {
        if (!event.target.classList.contains('bah-checkbox__input')) {
          return;
        }

        updateMobileBadge();

        window.clearTimeout(state.debounceTimer);
        state.debounceTimer = window.setTimeout(function () {
          fetchResults(true);
        }, DEBOUNCE_MS);
      });

      els.clearBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
          els.form.querySelectorAll('.bah-checkbox__input:checked').forEach(function (input) {
            input.checked = false;
          });
          updateMobileBadge();
          fetchResults(true);
        });
      });
    }

    /* ── Off-canvas móvil ── */

    function bindOffCanvas() {
      if (!els.filtersPanel) {
        return;
      }

      function open() {
        els.filtersPanel.classList.add('is-open');
        els.overlay.hidden = false;
        requestAnimationFrame(function () {
          els.overlay.classList.add('is-visible');
        });
        document.body.style.overflow = 'hidden';
        if (els.openBtn) {
          els.openBtn.setAttribute('aria-expanded', 'true');
        }
      }

      function close() {
        els.filtersPanel.classList.remove('is-open');
        els.overlay.classList.remove('is-visible');
        document.body.style.overflow = '';
        if (els.openBtn) {
          els.openBtn.setAttribute('aria-expanded', 'false');
        }
        window.setTimeout(function () {
          if (!els.filtersPanel.classList.contains('is-open')) {
            els.overlay.hidden = true;
          }
        }, 300);
      }

      if (els.openBtn) {
        els.openBtn.addEventListener('click', open);
      }

      els.closeBtns.forEach(function (btn) {
        btn.addEventListener('click', close);
      });

      if (els.overlay) {
        els.overlay.addEventListener('click', close);
      }

      document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && els.filtersPanel.classList.contains('is-open')) {
          close();
        }
      });
    }

    /* ── Cargar más (paginación progresiva) ── */

    function bindLoadMore() {
      if (!els.loadMoreBtn) {
        return;
      }

      els.loadMoreBtn.addEventListener('click', function () {
        fetchResults(false);
      });
    }

    /* ── Petición AJAX ── */

    function fetchResults(reset) {
      if (state.controller) {
        state.controller.abort();
      }
      state.controller = new AbortController();

      if (reset) {
        state.page = 1;
      } else {
        state.page += 1;
      }

      var filters = getActiveFilters();
      var body = new URLSearchParams();
      body.set('action', 'bah_filter');
      body.set('nonce', data.nonce);
      body.set('page', String(state.page));
      body.set('per_page', String(data.perPage || 12));

      Object.keys(filters).forEach(function (tax) {
        filters[tax].forEach(function (termId) {
          body.append('filters[' + tax + '][]', termId);
        });
      });

      setLoading(true, reset);

      fetch(data.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        },
        body: body.toString(),
        signal: state.controller.signal,
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (json) {
          if (!json || !json.success) {
            throw new Error('bah_filter_failed');
          }
          renderResults(json.data, reset);
          syncUrl();
        })
        .catch(function (error) {
          if (error && error.name === 'AbortError') {
            return;
          }
          setLoading(false, reset);
        });
    }

    function renderResults(payload, reset) {
      if (reset) {
        els.grid.innerHTML = payload.html;
      } else if (payload.html) {
        els.grid.insertAdjacentHTML('beforeend', payload.html);
      }

      if (els.count) {
        els.count.textContent = formatCount(payload.count);
      }

      if (els.empty) {
        var showEmpty = payload.count === 0;
        els.empty.hidden = !showEmpty;
        if (showEmpty && payload.emptyStateHtml) {
          els.empty.innerHTML = payload.emptyStateHtml;
          bindDynamicEmptyStateClear();
        }
      }

      if (els.loadMoreBtn) {
        els.loadMoreBtn.hidden = !payload.hasMore;
      }

      state.page = payload.page;

      setLoading(false, reset);
    }

    function bindDynamicEmptyStateClear() {
      var btn = els.empty.querySelector('[data-bah-clear-filters]');
      if (btn) {
        btn.addEventListener('click', function () {
          els.form.querySelectorAll('.bah-checkbox__input:checked').forEach(function (input) {
            input.checked = false;
          });
          updateMobileBadge();
          fetchResults(true);
        });
      }
    }

    function formatCount(count) {
      if (count === 0) {
        return data.i18n.resultsNone;
      }
      if (count === 1) {
        return data.i18n.resultsOne;
      }
      return data.i18n.resultsMany.replace('%d', count);
    }

    function setLoading(isLoading, reset) {
      if (isLoading) {
        if (reset) {
          els.grid.classList.add('is-loading');
        }
        if (els.spinner) {
          els.spinner.hidden = false;
        }
        if (els.loadMoreBtn) {
          els.loadMoreBtn.disabled = true;
        }
      } else {
        els.grid.classList.remove('is-loading');
        if (els.spinner) {
          els.spinner.hidden = true;
        }
        if (els.loadMoreBtn) {
          els.loadMoreBtn.disabled = false;
        }
      }
    }
  }

  function boot() {
    var roots = document.querySelectorAll('[data-bah-root]');
    roots.forEach(init);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
