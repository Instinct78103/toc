document.addEventListener('DOMContentLoaded', (event) => {
  document.querySelectorAll('pre code').forEach((el) => {
    if (typeof el === 'object') {
      hljs.highlightElement(el);
    }
  });
});