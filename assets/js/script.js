document.addEventListener('click', (event) => {
    const target = event.target;
    const confirmForm = target.closest?.('form[data-confirm]');

    if (confirmForm && !window.confirm(confirmForm.dataset.confirm || 'Are you sure?')) {
        event.preventDefault();
    }
});

window.addEventListener('load', () => {
    const flash = document.querySelector('.flash');

    if (flash) {
        window.setTimeout(() => {
            flash.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            flash.style.opacity = '0';
            flash.style.transform = 'translateY(-8px)';
        }, 3200);
    }

    const featurePanel = document.querySelector('[data-feature-panel]');
    const featureTabs = document.querySelectorAll('[data-feature]');

    if (featurePanel && featureTabs.length) {
        const featureContent = {
            catalog: {
                badge: 'Catalog overview',
                title: 'Browse every book in one place',
                body: 'Search titles, update records, and keep the collection organized without leaving the dashboard.',
                stats: [
                    ['Fast search', 'Find books by title, author, or ISBN'],
                    ['Quick actions', 'Edit, view, or delete with one click'],
                ],
            },
            inventory: {
                badge: 'Inventory focus',
                title: 'Track stock at a glance',
                body: 'Keep an eye on quantities and make sure popular titles never run out unexpectedly.',
                stats: [
                    ['Stock counts', 'Monitor every title quantity in seconds'],
                    ['Low inventory', 'Spot books that need restocking early'],
                ],
            },
            reports: {
                badge: 'Reports ready',
                title: 'See the collection from above',
                body: 'Use the dashboard summary to understand the size and shape of the library collection quickly.',
                stats: [
                    ['Dashboard totals', 'Instant book and category counts'],
                    ['Recent activity', 'Review the latest additions first'],
                ],
            },
        };

        const badge = featurePanel.querySelector('.feature-badge');
        const title = featurePanel.querySelector('h3');
        const body = featurePanel.querySelector('p');
        const statBlocks = featurePanel.querySelectorAll('.feature-stats div');

        featureTabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                const key = tab.dataset.feature;
                const data = featureContent[key];

                featureTabs.forEach((item) => item.classList.toggle('is-active', item === tab));

                if (!data) {
                    return;
                }

                badge.textContent = data.badge;
                title.textContent = data.title;
                body.textContent = data.body;

                statBlocks.forEach((block, index) => {
                    const heading = block.querySelector('strong');
                    const copy = block.querySelector('span');
                    const entry = data.stats[index];

                    if (heading && copy && entry) {
                        heading.textContent = entry[0];
                        copy.textContent = entry[1];
                    }
                });
            });
        });
    }
});