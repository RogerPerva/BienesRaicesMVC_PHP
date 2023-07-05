document.addEventListener('DOMContentLoaded', function () {

    eventListeners();
    darkMode();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme:dark)'); //Aqui nos lee si tenemos activado el darkmode en el sistema o no.
    console.log(prefiereDarkMode.matches);
    if (prefiereDarkMode) {
        document.body.classList.add('dark-mode'); //si lo tenemos activado nos agregara el darkmode.
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode) {
            document.body.classList.add('dark-mode'); //si lo tenemos activado nos agregara el darkmode.
        } else {
            document.body.classList.remove('dark-mode');
        }
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode'); //agregamos la clase dentro del body
    })
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu'); //seleccionamos elementos del html

    mobileMenu.addEventListener('click', navegacionResposive);

    //Muestra campos condicionales.
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    // queryselectorAll nos regresa un arreglo, tenemos que recorrerlo y agregar un add eventlistener a cada elemento.
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto))



}

//  Con el siguiente codigo agregamos la clase de mostrar que hace que se muestre y oculte la barra de navegacion, una manera mas corta seria tambien
//  function navegacionResposive(){
//     const navegacion = document.querySelector('.navegacion');
//     if(navegacion.classList.contains('mostrar')){
//         navegacion.classList.remove('mostrar');
//     }else {
//         navegacion.classList.add('mostrar');
//     } }

function navegacionResposive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    //Utilizamos evento para acceder a los eventos del mouse y asi llegar al evento que buscamos y agregar el codigo html donde corresponde segun sea email o telefono
    //Inyectamos codigo dependiendo de lo que el usuario pida
    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
        <label for="telefono">Numero de Telefono:</label>
        <input type="tel" id="telefono" name="contacto[telefono]">

        
        <p>Elija la fecha y la hora para ser contactado</p>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">

        `;

    } else {
        contactoDiv.innerHTML = `
        
        <label for="Email">Email:</label>
        <input type="email" placeholder="Tu email" id="email" name="contacto[email]" required>

        `;
    }


}



