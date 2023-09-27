// Obtener .hamburguer__button
const hamburguerButton = document.querySelector(".hamburguer__button");
// Obtener .hamburguer__menu
const hamburguerMenu = document.querySelector(".hamburguer__menu");
// app 
const app = document.querySelector(".app-hm");
// hacer una consulta

if ( hamburguerButton && hamburguerMenu ) {
    
    // Agregar evento click a .hamburguer__button
    hamburguerButton.addEventListener("click", () => {
        
        // Agregar clase .hamburguer__menu--active a .hamburguer__menu
        hamburguerMenu.classList.toggle("hamburguer__menu--active");

        if( app ){
            // Agregar clase .app-hm--active a #app-hm
            app.classList.toggle("app-hm--active");
            }
        }

    );

}
