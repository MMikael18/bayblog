import 'bootstrap';
import css from '../css/theme.scss'; 
'use strict';

// form.js
class BurgerClass {

    constructor() {
        let open = jQuery( "#burger-open" ),
            close = jQuery( "#burger-close" ),
            closeShadow = jQuery( ".bay-drawer-shadow" )
        
        jQuery( open ).on( 'click', ( event ) => {
            jQuery( '[data-drawer]' ).toggleClass("bay-drawer-close bay-drawer-open")
        } )
        jQuery( close ).on( 'click', ( event ) => {
            jQuery( '[data-drawer]' ).toggleClass("bay-drawer-open bay-drawer-close")
        } )
        jQuery( closeShadow ).on( 'click', ( event ) => {
            jQuery( '[data-drawer]' ).toggleClass("bay-drawer-open bay-drawer-close")
        } )
    }

}

class SearchClass {
    constructor(container) {
        this.container =  container || "#data-containes"
        jQuery( "#bayajaxsearch" ).keypress((e) => {
            if(e.which === 13) return false;            
        })
        jQuery( "#bayajaxsearch" ).keyup(() => {            
            this.ajax_search();             
        })
    }

    ajax_search(){        
        let value = jQuery( "#bayajaxsearch" ).val()
        fetch(
            bay_loadmore_params.ajaxurl+'?action=get_postlist',{
                method: "post",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({query: value})
            })
            .then((response) => {
                return response.text();
            })
            .then((html) => {
                jQuery( this.container ).html(html)
            })
    }
}

jQuery(function(){
    let burgerButton = new BurgerClass(),
        BayAjaxSearch = new SearchClass()
})