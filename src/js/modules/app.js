import { eventCallback, getFormData, returnNode } from 'cutleryjs';
import { sesam } from 'sesam-collapse';
import { setCookieHook } from './cookies';
import { fetchSearchQuery, displaySearchResults } from './search';

export const initialize = () => {    
    document.addEventListener('click', ({ target: parentNode }) => {
        // close sidemenu if clicked outside
        const p = parentNode.closest('.sidemenu');
        !p && sesam({
            target: 'sidemenu',
            action: 'hide'
        })
        
        // show menu if the user clicks on the sidemenu
        eventCallback('.sidemenu nav', () => {
            sesam({
                target: 'sidemenu',
                action: 'show'
            })
        }, false)
        
        eventCallback('[data-cookie-hook].card--notify .card__close', ({ parentNode }) => {
            const id = parentNode.closest('.card').dataset.cookieHook;
            setCookieHook(id);
            parentNode.remove();
        }, false)
    })
    
    document.addEventListener('submit', e => {
        eventCallback('#searchForm', async target => {
            // prevent page reload
            e.preventDefault();
            
            // get the query from the form
            const searchQuery = getFormData(target).get('search');
            
            // update the url of the page without reloading
            window.history.pushState('', '', window.location['origin'] + window.location['pathname'] + `?search=${searchQuery}`);
            
            // get the results, based on query
            const searchData = await fetchSearchQuery(searchQuery);
            
            // render results
            displaySearchResults(await searchData);
        }, false)
    })
}
