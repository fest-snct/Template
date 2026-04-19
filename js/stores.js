var glb_iIndex = 0;

function setModal(currentFigure) {
    const modal_img = document.getElementById("modal_img");
    const modal_title = document.getElementById("modal_title");
    const modal = document.getElementById("modal");
    const modal_txt = document.getElementById("modal_txt");
    const self_img = currentFigure.getElementsByTagName("img")[0];
    
    modal_place.innerText = currentFigure.getAttribute("data-location");
    modal_title.innerText = currentFigure.getAttribute("data-name");
    modal_txt.textContent = currentFigure.getAttribute("data-description");
    
    const newsLink = currentFigure.getAttribute("data-news-link");
    const n_title = currentFigure.getAttribute("data-news-title");
    if (newsLink) {
        const link = document.createElement("a");
        
        link.href = newsLink;
        link.textContent = n_title ? n_title : "ニュースはこちら";

        modal_txt.appendChild(document.createElement("br"))
        modal_txt.appendChild(link);
    }
    
    modal_img.src = self_img.src;
    modal_img.alt = self_img.alt;
    modal.removeAttribute("class");
}

function showModal(e) {
    const figs = document.getElementsByTagName("main")[0].getElementsByClassName("s_items");
    glb_iIndex = this.img_id;
    const currentFigure = figs[this.img_id];
    setModal(currentFigure);
}

function moveModal(e) {
    const dir = this.dir;
    const figs = document.getElementsByTagName("main")[0].getElementsByClassName("s_items");
    glb_iIndex += dir;
    
    if (glb_iIndex >= figs.length) {
        glb_iIndex = 0;
    } else if (glb_iIndex < 0) {
        glb_iIndex = figs.length - 1;
    }
    
    setModal(figs[glb_iIndex]);
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
