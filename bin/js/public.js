import css from '../css/theme.scss'; 
'use strict';

// form.js
class BurgerClass {

    constructor() {
        let open = $( "#burger-open" )
            close = $( "#burger-close" )
        
        $( open ).on( 'click', ( event ) => {
            //$( '[data-drawer]' ).show()
            $( '[data-drawer]' ).toggleClass("bay-drawer-close bay-drawer-open")
        } )
        $( close ).on( 'click', ( event ) => {
            //$( '[data-drawer]' ).hide()
            $( '[data-drawer]' ).toggleClass("bay-drawer-open bay-drawer-close")
        } )
    }

};

let burgerButton = new BurgerClass()