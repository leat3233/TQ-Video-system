(function(w) {

    function enterLines() {
        let lines = document.getElementsByClassName("line-enter");
        for (var i = 0; i < lines.length; i++) {
            lines[i].onclick = function() {
                let id = this.attributes['data-id'].value;
                let url = window[id];
                window.open(url, "_blank");
            }
        }
    }

    function init() {
        enterLines();
    }
    window.addEventListener("DOMContentLoaded", init, !1);
})(window);