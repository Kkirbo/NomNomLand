//-------------------------------------------------------------------------Resize <a> to the image it contains-------------------------------------------------------------------------
function resizeImageLink() {
    for (const link of document.querySelectorAll('.imageLink')) {
        let img = undefined;
        for (const element of link.children) {
            if ((element instanceof HTMLImageElement)) {
                img = element;
                continue;
            }
        }
        if (img !== undefined) link.style.height = `${img.height}px`;
    }
}
resizeImageLink();
window.onresize = resizeImageLink;
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------