class WCP_Scripts{
    constructor(){
        document.addEventListener( 'DOMContentLoaded', () => {
            console.log('WCP_Scripts init');
            document.querySelectorAll( '.wcp-js' ).forEach( btn => {
                btn.addEventListener( 'click', event => this.chooseColor( event ) );
            })
        })
    }

    chooseColor( event ) {
        event.preventDefault();
        const select = document.querySelector( '[name="attribute_color"]' )
        select.value = event.target.dataset.value;
        
        jQuery('#color').trigger('change');
    }
}

new WCP_Scripts();