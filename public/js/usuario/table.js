class TableCRUD {
    /**
     * 
     * @param {*} arrayObj 
     * @param {*} arrayHeader 
     * @param {*} TABLECONTAINER 
     */
    constructor( arrayObj = [], arrayHeader = [], TABLECONTAINER = null ) {
        this.arrayObj = arrayObj;
        this.arrayHeader = arrayHeader;
        this.TABLECONTAINER = TABLECONTAINER;
        this.onclickFunction = () => {console.log('No se ha definido una función')};
        this.filters = [];
    }

    /**
     * Setea el array de objetos
     * @param {*} arrayObj Array de objetos a renderizar
     */
    setArrayObj( arrayObj ) {
        this.arrayObj = arrayObj;
    }

    /**
     * Setea el array de headers
     * Cada header tiene 2 propiedades:
     * - name: nombre del header en el objeto
     * - label: label del header en la tabla
     * @param {*} arrayHeader Array de headers de la tabla
     */
    setArrayHeader( arrayHeader ) {
        this.arrayHeader = arrayHeader;
    }

    /**
     * Setea el contenedor de la tabla a renderizar
     * @param {*} TABLECONTAINER Contenedor en el documento html
     */
    setTableContainer( TABLECONTAINER ) {
        this.TABLECONTAINER = TABLECONTAINER;
    }

    /**
     * Devuelve el array de objetos
     * @returns el array de objetos
     */
    getArrayObj() {
        return this.arrayObj;
    }
    /**
     * Devuelve el array de headers
     * @returns el array de headers
     */
    getArrayHeader() {
        return this.arrayHeader;
    }

    /**
     * Devuelve el contenedor de la tabla
     * @returns el contenedor de la tabla
     */
    getTableContainer() {
        return this.TABLECONTAINER;
    }

    /**
     * Agrega un filtro a la tabla, el filtro debe tener la siguiente estructura:
     * { 
     *  header: NOMBRE DEL HEADER EN LA TABLA, 
     *  type: TIPO DE INPUT QUE SE RENDERIZARÁ,
     *  value: VALOR DEL INPUT,
     * }
     * 
     * Tipos de input:
     * - date: input type="date"
     * - month: input type="month"
     * - select: select
     * - text: input type="text"
     * - number: input type="number"
     * - personalizado: input personalizado
     * 
     * Input select:
     * - options: array de opciones a renderizar
     * 
     * Input personalizado:
     * - render (container) => {return html} : función que renderiza el input
     * - func () => {return true}: función que filtra el array de objetos según el valor del input
     * 
     * Adicionalmente existen las propiedades de los inputs para los filtros:
     * - placeholder: placeholder del input
     *  
     * @param {*} filter Array de filtros a renderizar
     */
    addFilter( filter ) {
        // filter = { header: 'date', type: 'date' }
        this.filters.push(filter);
    }

    /**
     * Devuelve el array de filtros según los filtros aplicados
     * @returns el array de objetos filtrados por los filtros
     */
    getArrayObjFiltered() {

        let arrayObjFiltered = this.arrayObj;
        // console.log("Filtrando tabla...")
        // console.log("Array de objetos: ", arrayObjFiltered);

        // Filtrar por filters
        for (let i = 0; i < this.filters.length; i++) {
            // filtros = { header: 'date', type: 'date' }
            const filter = this.filters[i];

            
            const type = filter.type;
            if(type === "personalizado"){
                console.log("Filtro personalizado");
                arrayObjFiltered = arrayObjFiltered.filter( obj => {
                    return filter.func(obj);
                });

                continue;
            }

            // Obtener el valor del input
            const input = document.querySelector(`[name="${filter.header}"]`);
            const value = input.value;

            if (value != '') {

                // console.log("Header: ", filter.header," Tipo de filtro: ", filter.type, " con valor: ", value);
                // console.log("input: ", input);
                // console.log("value: ", value);

                // Filtrar
                arrayObjFiltered = arrayObjFiltered.filter( obj => {
                    // Filtrar por fecha
                    if (filter.type === "date") {
                        // Obtener la fecha del objeto
                        const date = new Date(obj[filter.header]+"T00:00:00");
                        const day = date.getDate();
                        const month = date.getMonth() + 1;
                        const year = date.getFullYear();
                        // Obtener la fecha del input
                        const dateInput = new Date(value+"T00:00:00");
                        const dayInput = dateInput.getDate();
                        const monthInput = dateInput.getMonth() + 1;
                        const yearInput = dateInput.getFullYear();
                        // Check date
                        if ( day != dayInput || month != monthInput || year != yearInput) {
                            return false;
                        }
                        return true;
                    }
                    // Filtrar por mes
                    else if (filter.type === "month") {
                        // Obtener la fecha del objeto
                        const date = new Date(obj[filter.header]+"T00:00:00");
                        const year = date.getFullYear();
                        const month = date.getMonth() + 1;
                        // Obtener la fecha del input
                        const dateInput = new Date(value+"T00:00:00");
                        const yearInput = dateInput.getFullYear();
                        const monthInput = dateInput.getMonth() + 1;
                        // Check date
                        if ( year != yearInput || month != monthInput) {
                            return false;
                        }
                        return true;
                    }
                    // Filtrar por texto
                    else if ( filter.type === "text" ) {
                        // Verificar si tiene ;
                        if ( filter.header.includes(';') ) {
                            // Obtener los headers
                            const headers = filter.header.split(';');
                            // Recorrer los headers
                            for (let i = 0; i < headers.length; i++) {
                                // Verificar si el objeto contiene el valor
                                if ( obj[headers[i]].toLowerCase().includes(value.toLowerCase()) ) {
                                    return true;
                                }
                            }
                            return false;
                        }
                        // Verificar si el objeto contiene el valor
                        return obj[filter.header].toLowerCase().includes(value.toLowerCase());
                    }
                    
                    // Filtrar por select
                    else if ( filter.type === "select" ) {
                        return obj[filter.header] == value;
                    }

                    console.log("No se ha podido filtrar");
                });
            }
            
        }

        return arrayObjFiltered;
    }

    /**
     * Aplica los filtros a la tabla
     */
    applyFilters() {
        this.updateTable();
    }

    /**
     * Permite setear la función que se ejecutará al hacer click en un elemento de la tabla
     * La funcion recibe como parámetro el id, el objeto y el tr del objeto clickeado
     * (id, obj, tr) => {console.log(id)}
     * @param {function} onclickFunction Función que se ejecutará al hacer click en un elemento de la tabla
     */
    setOnClickFunction( onclickFunction ) {
        this.onclickFunction = onclickFunction;
    }

    /**
     * Permite obtener el objeto con el id especificado
     * @param {*} id 
     * @returns el objeto con el id especificado, si no se encuentra retorna null
     */
    searchId( id ) {
        for (let i = 0; i < this.arrayObj.length; i++) {
            if (this.arrayObj[i].id === id) {
                return this.arrayObj[i];
            }
        }
        return null;
    }

    searchRowHTML( rowName, value ) {
        for (let i = 0; i < this.arrayObj.length; i++) {
            if (this.arrayObj[i][rowName] === value) {
                // obtener html
                const table = this.TABLECONTAINER.querySelector('.table__container__body');
                const tbody = table.querySelector('tbody');
                const tr = tbody.querySelectorAll('tr')[i];
                return tr;
            }
        }
        return null;
    }

    checkAll( checkboxName ) {
        // Seleccionar el contenedor, tbody
        const checkboxes = this.TABLECONTAINER.querySelectorAll(`tbody [name*="${checkboxName}"]`);
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
        }
    }

    uncheckAll( checkboxName ) {
        // Seleccionar el contenedor, tbody
        const checkboxes = this.TABLECONTAINER.querySelectorAll(`tbody [name*="${checkboxName}"]`);
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
        }
    }

    /**
     * Permite seleccionar los checkboxes de la tabla(Una vez renderizada la tabla)
     * @param {*} checkboxName Nombre del checkbox | permisos | permisos[sucursal_id] | permisos[rol_id] | permisos[rol_id][sucursal_id]
     * @param {*} checkedValues Array de valores a seleccionar
     */
    checkRows( checkboxName, checkedValues ) {

        // tipo anidado?
        const tipoAnidado = checkboxName.includes('[') ? true : false;
        // Obtener el nombre del checkbox
        let cbName = checkboxName, headers = null;
        // Procesar checkboxName
        if (tipoAnidado) {
            cbName = checkboxName.split('[')[0];
            // Obtener los headers
            headers = checkboxName.split('[')[1].split(']')[0].split(',');
        }

        //seleccionar los checkboxes
        const checkboxes = this.TABLECONTAINER.querySelectorAll(`input[name*="${cbName}"]`);
        
        for (let i = 0; i < checkboxes.length; i++) {
            // Verificar si es un checkbox simple
            console.log("checkboxes[i].name: ", checkboxes[i].name);
            if( !tipoAnidado ) {
                // Verificar si el valor está en checkedValues, convertir checkboxes[i].value a int
                console.log("checkboxes[i].value: ", checkboxes[i].value);
                if (checkedValues.includes( parseInt(checkboxes[i].value)) ) {
                    checkboxes[i].checked = true;
                }
                continue;
            }
            
            // for each
            var checkHeader = true;
            // obj
            const obj = this.arrayObj[i];

            // Verificar si el valor está en checkedValues
            checkedValues.forEach( checkedValue => {
                // 
                checkHeader = true;
                // Verificar si todos los headers coinciden
                headers.forEach( header => {
                    // Obtener el valor del header
                    const headerValue = obj[header];                    
                    // Verificar si coincide con el valor del header

                    if (checkedValue[header] != headerValue) {
                        checkHeader = false;
                        return;
                    }
                });

                // Verificar si check es true
                if (checkHeader && checkboxes[i].value == checkedValue.id) {
                    checkboxes[i].checked = true;
                    return;
                }               
            });

        }

    }

    toggleCheckAll( checkboxName ) {
        // Buscar en el contedor thead si está checked
        // name[] or name[header][] or name[header1][header2][]
        const name = checkboxName.split('[')[0];
        const checkboxElement = this.TABLECONTAINER.querySelector(`#__${name}__`);

        const checked = checkboxElement.checked;

        if (checked) {
            this.checkAll(checkboxName);
        } else {
            this.uncheckAll(checkboxName);
        }

    }

    /*
    <div class="table__container__body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Clinica</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <td>12:30</td>
                    <td>Mike32342</td>
                    <td>Clínica 1</td>
                    <td>
                        <a href="perfil.html" class="table__link"><i class="fas fa-eye"></i></a>
                        <a href="perfil.html" class="table__link"><i class="fas fa-edit"></i></a>
                        <a href="perfil.html" class="table__link"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>
                        <a href="perfil.html" class="table__link"><i class="fas fa-eye"></i></a>
                        <a href="perfil.html" class="table__link"><i class="fas fa-edit"></i></a>
                        <a href="perfil.html" class="table__link"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>3</th>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>
                        <a href="perfil.html" class="table__link"><i class="fas fa-eye"></i></a>
                        <a href="perfil.html" class="table__link"><i class="fas fa-edit"></i></a>
                        <a href="perfil.html" class="table__link"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
     */
    renderTable() {

        const tableContainer = document.createElement('div');
        tableContainer.classList.add('table__container__body');
        this.TABLECONTAINER.appendChild(tableContainer);
        
        const table = document.createElement('table');
        table.classList.add('table');
        table.style.width = '100%';
        table.style.borderCollapse = 'collapse';
        
        const thead = document.createElement('thead');
        const tr = document.createElement('tr');
        
        // Estilo de borde y padding para las celdas de la tabla
        const cellStyle = 'border: 1px solid #ccc; padding: 8px; text-align: left;';
        
        
        // Estilo de fondo para el encabezado de la tabla
        const headerStyle = 'background-color: #509fd8; color: #fff;';

        
        for (let i = 0; i < this.arrayHeader.length; i++) {
            const th = document.createElement('th');
            // Obtener el nombre y etiqueta del encabezado
            let name = this.arrayHeader[i];
            console.log("name: ", name);
            let label = name;
            if (typeof this.arrayHeader[i] === 'object') {
                name = this.arrayHeader[i].name;
                label = this.arrayHeader[i].label;
            }
                // Omitir la creación del encabezado si el nombre es 'id'
            if (name === 'id') {
                continue; // Salta a la siguiente iteración del ciclo
            }
            // Si el encabezado contiene "checkbox:", crea un input checkbox
            if (name.includes('checkbox:')) {
                const input = document.createElement('input');
                input.type = 'checkbox';
                const checkboxName = name.split(':')[1].split('[')[0];
                input.id = "__" + checkboxName + "__";
                input.addEventListener('click', () => {
                    this.toggleCheckAll(checkboxName);
                });
                th.appendChild(input);
            } else {
                th.innerHTML = label;
            }
            // Aplicar estilo al encabezado si es necesario
            if (typeof this.arrayHeader[i] === 'object' && this.arrayHeader[i].hidden) {
                th.style.display = 'none';
            }
            // Agregar estilo a la celda
            th.style.cssText = cellStyle;
            // Agregar el encabezado a la fila del encabezado
            tr.appendChild(th);
        }

        // Aplicar estilo al encabezado de la tabla
        tr.querySelectorAll('th').forEach(header => {
            header.style.cssText += headerStyle;
        });
        thead.appendChild(tr);
        table.appendChild(thead);

        const tbody = document.createElement('tbody');

        // Obtener el array de objetos 
        let arrayObj = this.arrayObj;

        // Recorrer el array de objetos filtrados
        for (let i = 0; i < arrayObj.length; i++) {

            // Recorrer header
            const tr = document.createElement('tr');

            for (let j = 0; j < this.arrayHeader.length; j++) {
                
                const td = document.createElement('td');

                // Obtener el nombre del header
                let name = this.arrayHeader[j];
 
                if (typeof this.arrayHeader[j] === 'object') {
                    name = this.arrayHeader[j].name;
                }
                // Obtener el label del header
                let label = name;
                if (typeof this.arrayHeader[j] === 'object') {
                    label = this.arrayHeader[j].label;
                }

                if( name.includes('checkbox:') ) {
                    const input = document.createElement('input');
                    input.type = 'checkbox';
                    // name can be checkbox:users or checkbox:users[header1,header2,...]
                    // Extract the checkbox name
                    let nameExtracted = name.split(':')[1];
                    // split the nameExtracted by '['
                    let nameExtractedArray = nameExtracted.split('[');
                    // if the nameExtractedArray has more than 1 element
                    if (nameExtractedArray.length > 1) {
                        // split the nameExtractedArray[1] by ','
                        let headers = nameExtractedArray[1].split(',');
                        let extension, header, value;
                        // for each headers
                        for (let k = 0; k < headers.length; k++) {
                            // set the name of the input to nameExtracted
                            header = headers[k].split(']')[0];
                            value = arrayObj[i][header];
                            extension = '[' + value + ']';
                            input.name = nameExtractedArray[0] + extension + "[]";
                        }
                    }else{
                        // set the name of the input to nameExtracted
                        input.name = nameExtracted + "[]";
                    }
                    // set the id of the input to nameExtracted
                    input.value = arrayObj[i].id;
                    td.appendChild(input);
                }else{
                    td.innerHTML = arrayObj[i][name];
                }

                // Verificar si el header está oculto
                if (typeof this.arrayHeader[j] === 'object' && this.arrayHeader[j].hidden) {
                    td.style.display = 'none';
                }
                // Agregar evento mouseover para cambiar el estilo de toda la fila
                tr.addEventListener('mouseover', function() {
                    tr.querySelectorAll('td').forEach(cell => {
                        cell.style.backgroundColor = '#509fd8'; // Color de fondo azul
                        cell.style.color = '#ffffff'; // Color de texto blanco
                    });
                });

                // Agregar evento mouseout para restaurar el estilo original de toda la fila
                tr.addEventListener('mouseout', function() {
                    tr.querySelectorAll('td').forEach(cell => {
                        cell.style.backgroundColor = ''; // Restaurar color de fondo original
                        cell.style.color = ''; // Restaurar color de texto original
                    });
                });

                tr.appendChild(td);
            }

            tbody.appendChild(tr);

            // Acciones on click
            tr.addEventListener('click', () => {
                this.onclickFunction(arrayObj[i].id, arrayObj[i], tr);
            });
            
        }

        table.appendChild(tbody);

        tableContainer.appendChild(table);

    }

    updateTable() {
        console.log("Actualizando tabla...")
        // Ocultar todos los elementos
        const table = this.TABLECONTAINER.querySelector('.table__container__body');
        // elementos
        const elements = table.querySelectorAll('tbody tr');
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
        // Mostrar los elementos filtrados
        const arrayObjFiltered = this.getArrayObjFiltered();
        console.log("Array de objetos filtrados: ", arrayObjFiltered);
        
        for (let i = 0; i < arrayObjFiltered.length; i++) {
            // Obtener el objeto
            const obj = arrayObjFiltered[i];
            // Obtener la posicion del objeto en el arrayObj
            const index = this.arrayObj.indexOf(obj);
            // Obtener el elemento
            const element = elements[index];
            // Mostrar el elemento
            element.style.display = 'table-row';
        }
    }

    /*<div class="filter-container">
        <div class="filter__row">
            <div class="search-bar">
                <input type="text" placeholder="Buscar cita" class="search-bar__input">
                <button type="submit" class="search-bar__button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        
        <div class="filter__row">
            <!-- fecha -->
            <input type="date" name="date" value="">
            <!-- clinica -->
            <select name="clinica" id="clinica">
                <option value="clinica1">Clínica 1</option>
                <option value="clinica2">Clínica 2</option>
                <option value="clinica3">Clínica 3</option>
            </select>
        </div>
    </div> */
    renderFilter() {
        // Verificar si hay filtros
        if (this.filters.length === 0) {
            return;
        }

        const filterContainer = document.createElement('div');
        filterContainer.classList.add('filter-container');
        this.TABLECONTAINER.appendChild(filterContainer);

        const filterRow = document.createElement('div');
        filterRow.classList.add('filter__row');
        filterContainer.appendChild(filterRow);

        let count = 0;
        // Recorrer los filtros
        for (let i = 0; i < this.filters.length; i++) {
            const filter = this.filters[i];
            if(count === 0){
                const filterRow = document.createElement('div');
                count = 2;
            }
            count--;
            filterRow.classList.add('filter__row');
            filterContainer.appendChild(filterRow);

            if (filter.type === 'date') {
                const input = document.createElement('input');
                input.classList.add('input');
                input.type = 'date';
                input.name = filter.header;
                input.value = filter.value;
                filterRow.appendChild(input);
            } else if (filter.type === 'month') {
                const input = document.createElement('input');
                input.classList.add('input');
                input.type = 'month';
                input.name = filter.header;
                input.value = filter.value;
                filterRow.appendChild(input);

            } else if (filter.type === 'select') {
                const select = document.createElement('select');
                select.classList.add('input');
                select.name = filter.header;
                select.id = filter.header;
                filterRow.appendChild(select);

                // Ver todos
                const option = document.createElement('option');
                option.value = '';
                option.innerHTML = 'Todos';
                select.appendChild(option);

                // Recorrer las opciones
                for (let j = 0; j < filter.options.length; j++) {
                    const option = document.createElement('option');
                    // get value
                    let value = filter.options[j];
                    if (typeof filter.options[j] === 'object') {
                        value = filter.options[j].value;
                    }
                    // get label
                    let label = filter.options[j];
                    if (typeof filter.options[j] === 'object') {
                        label = filter.options[j].label;
                    }

                    option.value = value;
                    option.innerHTML = label;
                    select.appendChild(option);
                }

            } else if (filter.type === 'text') {
                
                const searchBar = document.createElement('div');
                searchBar.classList.add('search-bar');
                filterRow.appendChild(searchBar);

                const input = document.createElement('input');
                input.classList.add('input');
                input.type = 'text';
                input.placeholder = filter.placeholder === undefined ? "Buscar " + filter.header : filter.placeholder;
                input.name = filter.header;
                input.classList.add('search-bar__input');
                searchBar.appendChild(input);

                const button = document.createElement('button');
                button.type = 'button';
                button.classList.add('search-bar__button');
                searchBar.appendChild(button);

                const i = document.createElement('i');
                i.classList.add('fas');
                i.classList.add('fa-search');
                button.appendChild(i);

                // Evento on click
                button.addEventListener('click', () => {
                    this.applyFilters();
                });

                // enter
                input.addEventListener('keyup', (e) => {
                    if (e.keyCode === 13) {
                        this.applyFilters();
                    }
                });

            } else if (filter.type === 'number') {
                const input = document.createElement('input');
                input.classList.add('input');
                input.type = 'number';
                input.name = filter.header;
                input.value = filter.value;
                filterRow.appendChild(input);
                // Evento on change
                filterRow.addEventListener('change', () => {
                    // aplicar filtros
                    this.applyFilters();
                });
            } else if (filter.type === 'personalizado') {
                filter.render( filterRow );
            }else{
                const input = document.createElement('input');
                input.classList.add('input');
                input.type = 'text';
                input.name = filter.header;
                input.value = filter.value;
                filterRow.appendChild(input);
                console.log('no se reconoce el tipo de filtro');
            }

            // onchange
            filterRow.addEventListener('change', () => {
                // aplicar filtros
                this.applyFilters();
            });

        }

        
    }

    render() {
        // clear
        this.TABLECONTAINER.innerHTML = '';
        // render
        this.renderFilter();
        this.renderTable();
    }
}

export default TableCRUD;


// test

