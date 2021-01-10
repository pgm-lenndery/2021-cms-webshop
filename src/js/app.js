import { eventCallback, Api, getFormData, returnNode } from 'cutleryjs';
import { sesamCollapse, sesam } from 'sesam-collapse';
import feather from 'feather-icons';
import { Maronsy } from './maronsy';

// initialize scripts when dom is loaded
document.addEventListener('DOMContentLoaded', (event) => {
    // initialize collapsing elements
    sesamCollapse.initialize();
    
    // initialize feather icons
    feather.replace({ stroke: '#88603d', 'stroke-width': '2.4px', width: '20px', height: '20px' });
    
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
        },false)
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
        } ,false)
    })
    
    const sizesSingleShops = [
        { breakpoint: 0, options: { columns: 1 }},
        { breakpoint: 760, options: { columns: 1 }},
        { breakpoint: 1502, options: { columns: 2, justifyColumns: 'space-between' }},
        // { breakpoint: 1190, options: { columns: 3 }},
        // { breakpoint: 1502, options: { columns: 4, justifyColumns: 'center' }},
    ]
    returnNode('.maronsy.maronsy--single-shops') && new Maronsy({ sizesSingleShops, justifyColumns: 'flex-start' }).init();
});

/**
 * Fetch shop-data from the WP JSON Api
 * @param {string} query The query that was entered by the user in the search field
 */
const fetchSearchQuery = async query => {
    // get data from WP JSON Api
    const data = await new Api('http://golocal.local/wp-json/wp/v2/shops/').JSON();
    
    // filter to find shop
    return await data.filter(({ title: { rendered }, custom_fields: { place } }) => 
        unescape(rendered).toLowerCase().includes(query.toLowerCase())
    )
}

/**
 * Render the results
 * @param {*} data The data that was returned from the fetchSearchQuery function
 */
const displaySearchResults = data => {
    // check if there are results
    const resultsFound = data.length > 0;
    
    // get the node that will contain the results
    const $results = returnNode('#searchResults');
    
    // display a message if no results are found
    if (!resultsFound) $results.innerHTML = '<h5>No results</h5>'
    
    // render results if they where found
    else {
        $results.innerHTML = '';
        data.forEach(({ link, title: { rendered }, custom_fields: { introduction } }) => {
            const $card = document.createElement('a');
            $card.href = link;
            $card.classList.add('card');
            $card.innerHTML = `
                <h5 class="card__title">${ rendered }</h5>
                <div class="card__content">${ introduction }</div>
            `;
            $results.append($card);
        })
    }
}
