
import $ from 'jquery';
import select2 from 'select2';
import 'select2/dist/css/select2.css';

window.$ = window.jQuery = $;
select2(window, $);

$(function () {
    $('#filters').select2({
        width: '100%',
        placeholder: 'Оберіть мітки',
    });
});
