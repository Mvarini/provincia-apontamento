import flatpickr from "flatpickr";

// Se quiser usar em português do Brasil
import {Portuguese} from "flatpickr/dist/l10n/pt.js";

// Inicializar o flatpickr
flatpickr(".datepicker", {
    locale: Portuguese,
    dateFormat: "d/m/Y",
});
