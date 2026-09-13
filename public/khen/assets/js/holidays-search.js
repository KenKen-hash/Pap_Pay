document.addEventListener('DOMContentLoaded', function () {

    const searchForm = document.querySelector('[data-admin-search]');

    if (!searchForm) {
        return;
    }

    const searchInput = searchForm.querySelector('.admin-search-input');
    const searchResults = searchForm.querySelector('.admin-search-results');
    const searchClear = searchForm.querySelector('.admin-search-clear');

    if (!searchInput || !searchResults) {
        return;
    }

    /*
     * The Blade page provides this array:
     *
     * window.papPayAdminSearchPages = [...]
     *
     * The JavaScript file itself stays completely static,
     * so Blade route() expressions are NOT placed here.
     */
    const searchPages = Array.isArray(window.papPayAdminSearchPages)
        ? window.papPayAdminSearchPages
        : [];

    function normalize(value) {
        return String(value || '')
            .toLowerCase()
            .trim()
            .replace(/\s+/g, ' ');
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    function hideResults() {
        searchResults.classList.remove('show');
        searchInput.setAttribute('aria-expanded', 'false');
    }

    function showResults() {
        searchResults.classList.add('show');
        searchInput.setAttribute('aria-expanded', 'true');
    }

    function renderResults(query) {

        const normalizedQuery = normalize(query);

        if (!normalizedQuery) {
            searchResults.innerHTML = '';
            hideResults();
            return;
        }

        const searchTerms = normalizedQuery
            .split(' ')
            .filter(Boolean);

        const matches = searchPages.filter(function (page) {

            const searchableText = normalize(
                [
                    page.title,
                    page.description,
                    page.keywords
                ].join(' ')
            );

            return searchTerms.every(function (term) {
                return searchableText.includes(term);
            });
        });

        if (matches.length === 0) {

            searchResults.innerHTML = `
                <div class="admin-search-no-results">
                    <i class="bi bi-search"></i>
                    <div>
                        <strong>No matching pages found</strong>
                        <span>No page matches "${escapeHtml(normalizedQuery)}".</span>
                    </div>
                </div>
            `;

            showResults();
            return;
        }

        searchResults.innerHTML = matches.map(function (page) {

            return `
                <a
                    href="${escapeHtml(page.url)}"
                    class="admin-search-result"
                    role="option"
                >
                    <span class="admin-search-result-icon">
                        <i class="bi ${escapeHtml(page.icon || 'bi-grid')}"></i>
                    </span>

                    <span class="admin-search-result-content">
                        <span class="admin-search-result-title">
                            ${escapeHtml(page.title)}
                        </span>

                        <span class="admin-search-result-description">
                            ${escapeHtml(page.description || '')}
                        </span>
                    </span>

                    <span class="admin-search-result-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
            `;

        }).join('');

        showResults();
    }

    searchInput.addEventListener('input', function () {
        renderResults(this.value);

        if (searchClear) {
            searchClear.classList.toggle(
                'show',
                normalize(this.value).length > 0
            );
        }
    });

    searchInput.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            hideResults();
            this.blur();
            return;
        }

        if (event.key === 'Enter') {

            event.preventDefault();

            const firstResult =
                searchResults.querySelector('.admin-search-result');

            if (firstResult) {
                window.location.href = firstResult.href;
            }
        }
    });

    if (searchClear) {

        searchClear.addEventListener('click', function () {

            searchInput.value = '';

            searchResults.innerHTML = '';

            this.classList.remove('show');

            hideResults();

            searchInput.focus();
        });
    }

    document.addEventListener('click', function (event) {

        if (!searchForm.contains(event.target)) {
            hideResults();
        }
    });

    searchInput.addEventListener('focus', function () {

        if (normalize(this.value)) {
            renderResults(this.value);
        }
    });

});
