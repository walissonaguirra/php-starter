(function () {

    function send(e) {
        e.preventDefault();

        let form = this;
        let data = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: data
        })
            .then((res) => res.json())
            .then((res) => {
                if (res.redirect) {
                    window.location.href = res.redirect;
                } else if (res.reload) {
                    window.location.reload();
                } else if (res.message) {
                    alert(res.message);
                } else {
                    alert("Erro inesperado! Por favor tente novamente");
                }
            })
            .catch(() => {
                alert(`Não foi possivel enviar os dados, atualize a página e tente novamente`);
            });
    }

    document.querySelectorAll("form").forEach(function (form) {
        form.addEventListener("submit", send);
    });

    window.sendFormAjax = send;

})();