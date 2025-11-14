document.addEventListener("DOMContentLoaded", (e) => {
  /**@type {HTMLElement} */
  let target;
  /**@type {HTMLDivElement} */
  let tooltip = document.querySelector(".tooltip");
  document.querySelectorAll("*").forEach((el) => {
    el.addEventListener("mouseover", (e) => {
      if (target) {
        tooltip.classList.add("hidden");
        target.classList.remove("target");
      }
      target = e.target;
      target.classList.add("target");
    });
    el.addEventListener("click", (e) => {
      if (!target) {
        tooltip.classList.add("hidden");
        return;
      }
      tooltip.classList.remove("hidden");
      const props = [
        "color",
        "background-color",
        "font-size",
        "width",
        "height",
        "margin",
        "padding",
      ];
      const styles = target.computedStyleMap();
      let results = "";
      for (const p of props) {
        results += `<div><span class="prop">${p}</span>: <span>${styles.get(
          p
        )}</span></div>`;
      }
      tooltip.innerHTML = results;
      tooltip.style.left = e.pageX + "px";
      tooltip.style.top = e.pageY + "px";
    });
  });
});
