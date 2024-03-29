import { eventCallback, Api, getFormData, returnNode } from 'cutleryjs';
import { sesamCollapse, sesam } from 'sesam-collapse';
import feather from 'feather-icons';

/**
 * Fetch shop-data from the WP JSON Api
 * @param {string} query The query that was entered by the user in the search field
 */
export const fetchSearchQuery = async query => {
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
export const displaySearchResults = data => {
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
            $card.classList.add('card', 'card--search');
            $card.innerHTML = `
                <h5 class="card__title">${ rendered }</h5>
                <div class="card__content">${ introduction }</div>
            `;
            $results.append($card);
        })
    }
}