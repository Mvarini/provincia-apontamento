window.gerarRelatorio = function (url) {
    Swal.fire({
        title: 'Gerando Relatório',
        text: 'Aguarde enquanto preparamos seu PDF...',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
            // Inicia o download
            window.location.href = url;
        }
    });

    const checkDownload = setInterval(() => {
        // Verifica se o cookie que definimos no Controller existe
        if (document.cookie.indexOf('download_finished=true') !== -1) {
            Swal.close();

            Swal.fire({
                icon: 'success',
                title: 'Download concluído!',
                timer: 2000,
                showConfirmButton: false
            });

            // Limpa o cookie
            document.cookie = "download_finished=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            clearInterval(checkDownload);
        }
    }, 500);
}
