async function searchUsuariosQuery(query){
    let url = `/api/usuarios/buscar?search=${query}`;
    let response = await fetch(url);
    let result = await response.json();
    console.log('dentro del result', result);
    return result;
}

export {searchUsuariosQuery};