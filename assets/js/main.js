document.addEventListener('DOMContentLoaded', () => {
  const root = document.documentElement;
  const toggle = document.querySelector('[data-theme-toggle]');
  const themeStorageKey = 'mirror-theme';

  const applyTheme = (theme) => {
    root.setAttribute('data-theme', theme);

    if (toggle) {
      const icon = toggle.querySelector('i');

      if (icon) {
        icon.className = theme === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
      }
    }
  };

  const storedTheme = window.localStorage.getItem(themeStorageKey);
  const preferredTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  applyTheme(storedTheme || preferredTheme);

  toggle?.addEventListener('click', () => {
    const nextTheme = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    window.localStorage.setItem(themeStorageKey, nextTheme);
    applyTheme(nextTheme);
  });

  document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', (event) => {
      const targetId = link.getAttribute('href');

      if (!targetId || targetId === '#') {
        return;
      }

      const target = document.querySelector(targetId);

      if (!target) {
        return;
      }

      event.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });

  if (window.AOS) {
    window.AOS.init({ duration: 800, once: true, offset: 48 });
  }
});
