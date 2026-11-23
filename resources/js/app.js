import './bootstrap';
import $ from 'jquery';
import select2 from 'select2';
import 'select2/dist/css/select2.css';

import Alpine from 'alpinejs';

window.$ = window.jQuery = $;
window.Alpine = Alpine;

// Ініціалізація Select2 для вибору міток товарів / записів
select2(window, $);
$(function () {
    if ($('#filters').length) {
        $('#filters').select2({
            width: '100%',
            placeholder: 'Оберіть мітки товару',
        });
    }
});

// Запуск Alpine.js для Breeze
Alpine.start();
