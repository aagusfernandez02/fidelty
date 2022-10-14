let input_Stock = document.getElementById('input_stock');
let input_punto_reposicion = document.getElementById('input_punto_reposicion');
let checkBox_ingresoConStock = document.getElementById('ingreso_con_stock');
let checkBox_ingresoConPuntoReposicion = document.getElementById('ingreso_con_punto_reposicion');
checkBox_ingresoConStock.addEventListener('click', () => {
    if (checkBox_ingresoConStock.checked) {
        input_Stock.removeAttribute('disabled');
        input_Stock.setAttribute('required', true);
    } else {
        input_Stock.setAttribute('disabled', true);
        input_Stock.removeAttribute('required');
    }
});
checkBox_ingresoConPuntoReposicion.addEventListener('click', () => {
    if (checkBox_ingresoConPuntoReposicion.checked) {
        input_punto_reposicion.removeAttribute('disabled');
        input_punto_reposicion.setAttribute('required', true);
    } else {
        input_punto_reposicion.setAttribute('disabled', true);
        input_punto_reposicion.removeAttribute('required');
    }
});