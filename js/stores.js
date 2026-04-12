var glb_iIndex = 0;
function showModal(e) {
    const modal_img = document.getElementById("modal_img");
    const modal_title = document.getElementById("modal_title");
    const modal = document.getElementById("modal");
    const self_img = e.currentTarget.getElementsByTagName("img")[0];
    const modal_txt = document.getElementById("modal_txt");
    const figs = document.getElementsByTagName("main")[0].getElementsByClassName("s_items");
    const currentFigure = figs[this.img_id];
    glb_iIndex = this.img_id;
    modal_place.innerText = currentFigure.getAttribute("data-location");
    modal_title.innerText = currentFigure.getAttribute("data-name");
    modal_txt.innerText = currentFigure.getAttribute("data-description");
    const newsLink = currentFigure.getAttribute("data-news-link");
    if (newsLink) {
        const link = document.createElement("a");
        link.href = newsLink;
        link.textContent = "ニュースはこちら";
        const br = document.createElement("br");
        modal_txt.appendChild(br);
        modal_txt.appendChild(link);
    }
    modal_img.src = self_img.src;
    modal_img.alt = self_img.alt;
    modal.removeAttribute("class");
}
function closeModal(e) {
    const modal_inner = document.getElementById("modal_inner");
    const clb = document.getElementsByClassName("close-button")[0];
    const clb_a = document.getElementsByClassName("close-button__line")[0];
    const clb_b = document.getElementsByClassName("close-button__line")[1];
    if (e.target == modal_inner || e.target == clb || e.target == clb_a || e.target == clb_b) {
        const modal = document.getElementById("modal");
        modal.setAttribute("class", "nodisp");
    }
}
function moveModal(e){
    const dir = this.dir;
    const figs = document.getElementsByTagName("main")[0].getElementsByClassName("s_items");
    glb_iIndex += dir;
    if (glb_iIndex >= figs.length) {
        glb_iIndex = 0;
    } else if (glb_iIndex < 0){
        glb_iIndex = figs.length - 1;
    }
    
    const modal_img = document.getElementById("modal_img");
    const modal_title = document.getElementById("modal_title");
    const modal = document.getElementById("modal");
    const self_img = figs[glb_iIndex].getElementsByTagName("img")[0];
    const modal_txt = document.getElementById("modal_txt");
    modal_place.innerText = figs[glb_iIndex].getAttribute("data-location");
    modal_title.innerText = figs[glb_iIndex].getAttribute("data-name");
    modal_txt.innerText = figs[glb_iIndex].getAttribute("data-description");
    const newsLink = figs[glb_iIndex].getAttribute("data-news-link");
    if (newsLink) {
        const link = document.createElement("a");
        link.href = newsLink;
        link.textContent = "ニュースはこちら";
        const br = document.createElement("br");
        modal_txt.appendChild(br);
        modal_txt.appendChild(link);
    }
    modal_img.src = self_img.src;
    modal_img.alt = self_img.alt;
    modal.removeAttribute("class");
}
window.onload = function () {
  const figs = document.getElementsByTagName("main")[0].getElementsByClassName("s_items");
  for (let i = 0; i < figs.length; i++) {
    figs[i].addEventListener("click", {img_id: i, handleEvent: showModal});
  }
  document.getElementById("modal_inner").addEventListener("click", closeModal);
  document.getElementById("modal_head").getElementsByClassName("close-button")[0].addEventListener("click", closeModal);
  document.getElementById("next").addEventListener("click", {dir: 1, handleEvent:moveModal});
  document.getElementById("prev").addEventListener("click", {dir: -1, handleEvent:moveModal});
}
