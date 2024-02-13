import {searchUsuariosQuery} from "../usuario/usuario.js";
import tableCrud from "../usuario/table.js";

// Crear tabla
const CONTAINER = document.getElementById("personas-container");
const HEADER = [
    {name: "id", label: "ID", hidden: true},
    {name: "nombre", label: "Nombre"},
    {name: "email", label: "Email"},
    {name: "apellido_materno", label: "Apellido Materno"},
    {name: "apellido_paterno", label: "Apellido Paterno"},

];
const TABLE = new tableCrud({}, HEADER, CONTAINER );

function handleOnClick(id, usuario) {
    console.log('perosnass',usuario )
    // Obtener inputs del formulario
    // nombre, apellido1, apellido2, rut, nacionalidad, celular, correo
    const NOMBRE = document.querySelector("#nombre");
    const APELLIDO_PATERNO = document.querySelector("#apellido_paterno");
    const APELLIDO_MATERNO = document.querySelector("#apellido_materno");
    const EMAIL = document.querySelector("#email");
    // Setear valores
    NOMBRE.value = usuario.nombre;
    APELLIDO_PATERNO.value = usuario.apellido_paterno;
    console.log('apellido pmaterno', usuario.apellido_materno)
    APELLIDO_MATERNO.value = usuario.apellido_materno;
    EMAIL.value = usuario.email;

    // Cerrar modal #modalBuscarPersonas
    $('#modalBuscarPersonas').modal('hide');


}
TABLE.setOnClickFunction(handleOnClick);

// Timer
let timeout;

// Funciones
function handleResults(results) {
    
    if(results.length === 0) {
        // Limpiar container
        CONTAINER.innerHTML = "<p class='text-center'>No se encontraron resultados</p>";
        return;
    }
    console.log("Resultados en handle", results);
    // Actualizar objetos TABLE
    TABLE.setArrayObj(results);

    // Renderizar tabla
    TABLE.render();
}

function setLoader() {
    // Verificar si existe loader
    if(document.querySelector(".rectangles-loader")) {
        return;
    }
    // Set loader
    CONTAINER.innerHTML = `
        <div class="rectangles-loader m-auto"><div></div><div></div><div></div>
    `;
}

function handleQuery(query) {

    if(query.length === 0) {
        // container #personas-container
        let container = document.querySelector("#personas-container");
        // Limpiar container
        container.innerHTML = "";
        return;
    }

    // Obtener resultados
    searchUsuariosQuery(query).then(results => {
        // Manejar resultados
        console.log("Resultados", results.usuario);
        handleResults(results.usuario);
    });

}

// 
async function handleKeyPress(e) {
    // Reiniciar timer
    clearTimeout(timeout);

    // Set loader
    setLoader();

    // Configurar temporizador
    timeout = setTimeout( () => {
        // Obtener query
        let query = e.target.value;
        // Manejar query
        handleQuery(query);
        console.log("Buscando...");
    }, 500);
}

//  Obtener #searchQuery
const searchQuery = document.querySelector("#searchQuery");

// onkeyup
searchQuery.addEventListener("keyup", handleKeyPress);