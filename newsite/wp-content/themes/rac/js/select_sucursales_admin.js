/**
 * Logic to handle the list of branches in the "vacantes" custom post
 * 
 * NOTE: The "sucursales" variable is comming from the "newsite/wp-content/themes/rac/js/lista_sucursales-rh.js"
 * script loaded in the functions.php file
 */
(function($) {
    // If the states select does not exists
    // returns to exit all this logic in order to prevent
    // javascript errors
    if (!document.getElementById('estado_vacante')) {
        return;
    }

    /**
     * Sets the list of states to the "State" select in the "Vacante" custom post admin
     */
    function setStatesToSelect() {
        const states = Object.keys(sucursales);
        const currentState = $('#estado_vacante').data('value');

        states.forEach((state) => {
            $('#estado_vacante').append(`<option value="${state}">${state}</option>`);
        });

        // Sets the value from the database if exists
        if (currentState) {
            $('#estado_vacante').val(currentState);
        }
        setCities();
    }

    /**
     * Sets the cities to the "ciudad" select depending on the selected state
     */
     function setCities() {
         const selectedState = $('#estado_vacante').val();
         const cities = Object.keys(sucursales[selectedState]) || [];
         const currentCity = $('#ciudad_vacante').data('value');

        // Clears the previous options
        $('#ciudad_vacante').html('');
        // Add all the cities for the selected state
        cities.forEach((city) => {
            $('#ciudad_vacante').append(`<option value="${city}">${city}</option>`);
        });

        // Sets the value from the database if exists
        if (currentCity) {
            $('#ciudad_vacante').val(currentCity);
        }
        setBranches();
    }

    /**
     * Sets the branches to the "sucursal" select depending on the selected state
     */
    function setBranches() {
        const selectedState = $('#estado_vacante').val();
        const selectedCity = $('#ciudad_vacante').val();
        const branches = sucursales[selectedState][selectedCity] || [];
        const currentBranch = $('#sucursal_vacante').data('value');

        // Clears the previous options
        $('#sucursal_vacante').html('');
        // Add all the branches for the selected state
        branches.forEach((branch) => {
            $('#sucursal_vacante').append(`<option value="${branch.titulo}">${branch.titulo}</option>`);
        });

        // Sets the value from the database
        if (currentBranch) {
            $('#sucursal_vacante').val(currentBranch);
        }
    }

    setStatesToSelect();
    $('#estado_vacante').on('change', setCities);
    $('#ciudad_vacante').on('change', setBranches);
})(jQuery);