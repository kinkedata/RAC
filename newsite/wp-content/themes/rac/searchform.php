<form class="input-group w-auto my-auto d-sm-flex flex-row d-md-flex m-auto" id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="search-field form-control search-bar" name="s" placeholder="¿Qué producto buscas?" value="<?php echo get_search_query(); ?>">
    <input type="submit" value="Buscar" class="input-group-text border-0 d-lg-flex search-bar-button">
</form>

<!--form class="input-group w-auto my-auto d-sm-flex flex-row d-md-flex m-auto">
    <input autocomplete="off" type="search" class="form-control search-bar" placeholder="Buscar" style="min-width: 460px;"/>
    <span class="input-group-text border-0 d-none d-lg-flex search-bar-button"><i class="fas fa-search"></i></span>
</form-->