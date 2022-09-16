// Activar-desactivar solapas login
let solapaSocio = document.getElementById('solapaSocio');
let solapaComercio = document.getElementById('solapaComercio');

let modoLogin = "comercio";

// Cambio modo de login a socio
solapaSocio.addEventListener("click", () => {
    if (solapaSocio.classList.contains('noActive')) {
        modoLogin = "socio";
        refreshSegunModo();
    }
});

// Cambio modo de login a comercio
solapaComercio.addEventListener("click", () => {
    if (solapaComercio.classList.contains('noActive')) {
        modoLogin = "comercio";
        refreshSegunModo();
    }
});

// Función destinada a actualizar el contenido según la opción de login a utilizar
let refreshSegunModo = () => {
    if (modoLogin == "socio") {
        solapaSocio.classList.remove('noActive');
        solapaSocio.classList.add('active');
        solapaComercio.classList.remove('active');
        solapaComercio.classList.add('noActive');
    } else if (modoLogin == "comercio") {
        solapaSocio.classList.add('noActive');
        solapaSocio.classList.remove('active');
        solapaComercio.classList.add('active');
        solapaComercio.classList.remove('noActive');
    }
};