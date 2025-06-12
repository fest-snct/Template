function showModal(elm, img_id) {
    const modal_img = document.getElementById("modal_img");
    const modal_title = document.getElementById("modal_title");
    const modal = document.getElementById("modal");
    const self_img = elm.getElementsByTagName("img")[0];
    const modal_txt = document.getElementById("modal_txt");
    const figs = document.getElementsByTagName("main")[0].getElementsByClassName("s_items");
    const matchRx = /[ 　]場所[:：][ 　]?\d{1,2}-\d{3}$/;
    const matchAlt = self_img.getAttribute("alt").match(matchRx);
    modal_place.innerText = matchAlt != null ? matchAlt[0].replace(/^[ 　]/, "", 1) : "";
    modal_title.innerText = self_img.getAttribute("alt").replace(matchRx, "");
    modal_txt.innerText = figs[img_id].getAttribute("data-description");
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
//addEventListener('click', closeModal);
//https://pote-chil.com/posts/close-dialog-by-backdrop