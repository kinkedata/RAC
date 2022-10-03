(function($){
    const selectedState = $('#vacante_state').data('value');
    const states = Object.keys(sucursales);

    states.forEach((state) => {
        $('#vacante_state').append(`<option value="${state}">${state}</option>`);
    });

    if(selectedState) {
        $('#vacante_state').val(selectedState);
    }

    /**
     * Redirects the browser to the vacantes page with the query parameters from the selects
     */
    function redirectSearch() {
        const type = $('#vacante_type').val();
        const state = $('#vacante_state').val();
        const location = window.location;

        window.location.replace(`${location.origin}${location.pathname}?state=${state}&&type=${type}`);
    }

    $('#vacante_type').on('change', redirectSearch);
    $('#vacante_state').on('change', redirectSearch);
})(jQuery);