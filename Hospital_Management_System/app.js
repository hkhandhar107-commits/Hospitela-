document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!confirm(form.getAttribute('data-confirm') || 'Are you sure?')) event.preventDefault();
    });
  });
  const search = document.querySelector('[data-table-search]');
  if (search) {
    search.addEventListener('input', () => {
      const query = search.value.toLowerCase();
      document.querySelectorAll('[data-search-table] tbody tr').forEach(row => {
        row.hidden = !row.innerText.toLowerCase().includes(query);
      });
    });
  }
});
