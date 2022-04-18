(() => {

    const modal = document.getElementById("user-modal")
    const body = modal.querySelector(".modal-body");

    modal.addEventListener("show.bs.modal", (e) => {
        fetch(e.relatedTarget.dataset.url, {
            method: "GET",
        })
            .then((res) => res.json())
            .then((res) => {
                body.innerHTML = res.html;
                body
                    .querySelector("form")
                    .addEventListener("submit", window.sendFormAjax);
            })
            .catch((error) => {
                body.innerHTML = `<p><strong>Erro não foi possivel carregar os dados</strong></p>`;
            });
    });

})();