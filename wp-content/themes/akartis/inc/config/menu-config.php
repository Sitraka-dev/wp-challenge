<?php 
    // Configuration du menu

    /**
     * Fonction pour ajouter des classes CSS aux éléments de menu
     * On peut voir  l'application du fltre "nav_menu_css_class" 
     * dans la Class "class-walker-nav-menu.php" (wp-includes/class-walker-nav-menu.php)
     * @param mixed $classes
     */
    function akartis_menu_class($classes) {
        // var_dump(func_get_args()); // Pour voir les arguments passés à la fonction
        // die();

        // On ajoute la classe 'nav-item' à chaque élément de menu
		$classes[] = 'nav-item';
		return $classes;
	}
	add_filter('nav_menu_css_class', 'akartis_menu_class');

    /**
     * Fonction pour ajouter des attributs (ici c'est "class" de valeur "nav-link") aux liens de menu
     * On peut voir l'application du filtre "nav_menu_link_attributes" 
     * dans la Class "class-walker-nav-menu.php" (wp-includes/class-walker-nav-menu.php)
     * @param mixed $attrs
     */

	function akartis_menu_link_class($attrs) {
		$attrs['class'] = 'nav-link';
		return $attrs;
	}
	add_filter('nav_menu_link_attributes', 'akartis_menu_link_class');