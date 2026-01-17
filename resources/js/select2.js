import $ from 'jquery';
import select2 from 'select2';
import 'select2/dist/css/select2.css';
import 'select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.css';

// Torna o jQuery disponível globalmente (necessário para o Select2)
window.$ = window.jQuery = $;

// Inicializa o plugin Select2
select2();

// Exemplo de uso
$(document).ready(function () {
    $('.form-select').select2({
        theme: 'bootstrap-5',
        placeholder: "Selecione uma opção",
        // allowClear: true
        width: '100%'
    });
});
