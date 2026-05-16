const editableSpans = document.querySelectorAll('span.editable-user-text-info');
document.addEventListener('click', (e) => {
  for (const span of editableSpans) if (!span.contains(e.target)) {
    //become span
    span.nodeType = "span";
    span.textContent = span.value;
  }
});
for (const span of editableSpans) {
    span.addEventListener("click", async (e) => {
        //become input
        span.nodeType = "input";
        span.value = span.textContent;
    });
}