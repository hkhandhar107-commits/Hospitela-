document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('form[data-confirm]').forEach(form => {
    form.addEventListener('submit', event => {
      const message = form.dataset.confirm || 'Are you sure?';
      if (!window.confirm(message)) event.preventDefault();
    });
  });
  const toggle = document.getElementById('menuToggle');
  const sidebar = document.querySelector('.sidebar');
  if (toggle && sidebar) {
    toggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    document.addEventListener('click', event => {
      if (window.innerWidth <= 760 && sidebar.classList.contains('open') &&
          !sidebar.contains(event.target) && !toggle.contains(event.target)) {
        sidebar.classList.remove('open');
      }
    });
  }
});
