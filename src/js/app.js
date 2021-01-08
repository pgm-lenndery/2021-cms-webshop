import { eventCallback, Api, getFormData, returnNode } from 'cutleryjs';
import { sesamCollapse, sesam } from 'sesam-collapse';
import feather from 'feather-icons';
import { Maronsy } from './maronsy';

// initialize scripts when dom is loaded
document.addEventListener('DOMContentLoaded', (event) => {
    // initialize sesam
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
        
        eventCallback('.sidemenu nav', () => {
            sesam({
                target: 'sidemenu',
                action: 'show'
            })
        },false)
    })
    
    document.addEventListener('submit', e => {
        eventCallback('#searchForm', async target => {
            e.preventDefault();
            const searchQuery = getFormData(target).get('search');
            window.history.pushState('', '', window.location['origin'] + window.location['pathname'] + `?search=${searchQuery}`);
            const searchData = await fetchSearchQuery(searchQuery);
            displaySearchResults(await searchData);
        } ,false)
    })
    
    const sizes = [
        { breakpoint: 0, options: { columns: 1 }},
        { breakpoint: 576, options: { columns: 2 }},
        { breakpoint: 992, options: { columns: 3 }},
        { breakpoint: 1500, options: { columns: 4, justifyColumns: 'center' }},
    ]
    new Maronsy({ sizes, justifyColumns: 'flex-start' }).init();
});

const fetchSearchQuery = async query => {
    const data = await new Api('http://golocal.local/wp-json/wp/v2/shops/').JSON();
    return await data.filter(({ title: { rendered }, custom_fields: { place } }) => 
        unescape(rendered).toLowerCase().includes(query.toLowerCase())
        // || place?.includes(await query)
    )
}

const displaySearchResults = data => {
    const $results = returnNode('#searchResults');
    $results.innerHTML = '<strong>loading</strong>';
    if (!data) $results.innerHTML = '<h5>No results</h5>'
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
