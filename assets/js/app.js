(() => {
  const header = document.querySelector('[data-header]');
  const menuToggle = document.querySelector('[data-menu-toggle]');
  const mobileNav = document.querySelector('[data-mobile-nav]');

  const onScroll = () => {
    if (!header) return;
    const forceSolid = header.dataset.solid === 'true';
    if (forceSolid || window.scrollY > 40) {
      header.classList.add('is-solid');
      header.classList.remove('is-transparent');
    } else {
      header.classList.add('is-transparent');
      header.classList.remove('is-solid');
    }
  };

  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  if (menuToggle && mobileNav) {
    menuToggle.addEventListener('click', () => {
      const open = mobileNav.classList.toggle('is-open');
      menuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      document.body.style.overflow = open ? 'hidden' : '';
    });
    mobileNav.querySelectorAll('a').forEach((a) => {
      a.addEventListener('click', () => {
        mobileNav.classList.remove('is-open');
        document.body.style.overflow = '';
      });
    });
  }

  const reveals = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add('is-visible'));
  }

  const counters = document.querySelectorAll('[data-counter]');
  const animateCounter = (el) => {
    const target = Number(el.dataset.counter || 0);
    const prefix = el.dataset.prefix || '';
    const suffix = el.dataset.suffix || '';
    if (!target) {
      el.textContent = el.dataset.display || '—';
      return;
    }
    const duration = 1400;
    const start = performance.now();
    const step = (now) => {
      const p = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      const value = Math.floor(target * eased);
      el.textContent = prefix + value.toLocaleString('fr-FR') + suffix;
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = prefix + target.toLocaleString('fr-FR') + suffix;
    };
    requestAnimationFrame(step);
  };

  if ('IntersectionObserver' in window) {
    const cio = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          cio.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });
    counters.forEach((el) => cio.observe(el));
  } else {
    counters.forEach(animateCounter);
  }

  // Régions (liste + carte SVG)
  const panel = document.querySelector('[data-region-panel]');
  if (panel) {
    const desc = panel.querySelector('[data-region-desc]');
    const count = panel.querySelector('[data-region-count]');
    const domains = panel.querySelector('[data-region-domains]');
    const projects = panel.querySelector('[data-region-projects]');
    const base = document.body.dataset.base || '';

    async function loadRegion(slug) {
      document.querySelectorAll('[data-region-trigger], .region-hotspot').forEach((el) => {
        const key = el.dataset.regionTrigger || el.dataset.region;
        el.classList.toggle('is-active', key === slug);
      });
      try {
        const res = await fetch(`${base}/api/regions/${slug}`);
        if (!res.ok) throw new Error('fail');
        const data = await res.json();
        const activeItem = panel.querySelector(`[data-region-trigger="${slug}"]`);
        if (activeItem) {
          const titleEl = activeItem.querySelector('.h3');
          if (titleEl) titleEl.textContent = data.name;
          const countEl = activeItem.querySelector('.region-count');
          if (countEl) countEl.textContent = `${data.projects_count} projet${data.projects_count > 1 ? 's' : ''}`;
        }
        if (desc) desc.textContent = data.description || '';
        if (count) count.textContent = `${data.projects_count} projet${data.projects_count > 1 ? 's' : ''}`;
        if (domains) {
          domains.innerHTML = data.domains.length
            ? data.domains.map((d) => `<span class="chip">${d.title}</span>`).join(' ')
            : '<span class="chip">À compléter</span>';
        }
        if (projects) {
          projects.innerHTML = data.projects.length
            ? data.projects.map((p) => `<li><a class="link-arrow" href="${p.url}">${p.title}</a></li>`).join('')
            : '<li>Aucun projet publié pour cette région.</li>';
        }
      } catch (e) {
        if (desc) desc.textContent = 'Impossible de charger les informations.';
      }
    }

    document.querySelectorAll('[data-region-trigger]').forEach((el) => {
      el.addEventListener('click', () => loadRegion(el.dataset.regionTrigger));
      el.addEventListener('keydown', (ev) => {
        if (ev.key === 'Enter' || ev.key === ' ') {
          ev.preventDefault();
          loadRegion(el.dataset.regionTrigger);
        }
      });
    });
    document.querySelectorAll('.region-hotspot[data-region]').forEach((el) => {
      el.addEventListener('click', () => loadRegion(el.dataset.region));
      el.addEventListener('keydown', (ev) => {
        if (ev.key === 'Enter' || ev.key === ' ') {
          ev.preventDefault();
          loadRegion(el.dataset.region);
        }
      });
    });
    const first = document.querySelector('[data-region-trigger]');
    if (first) loadRegion(first.dataset.regionTrigger);
  }
})();
