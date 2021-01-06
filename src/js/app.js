import { eventCallback, Api, getFormData, returnNode } from 'cutleryjs';
import { sesamCollapse, sesam } from 'sesam-collapse';
import feather from 'feather-icons';

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
});

const fetchSearchQuery = async query => {
    const data = await new Api('http://golocal.local/wp-json/wp/v2/shops/').JSON();
    return await data.filter(({ title: { rendered } }) => unescape(rendered).toLowerCase().includes(query.toLowerCase()))
}

const displaySearchResults = data => {
    const $results = returnNode('#searchResults');
    $results.innerHTML = '';
    console.log(data);
    
    if (!data) $results.innerHTML = '<h5>No results</h5>'
    else data.forEach(({ link, title: { rendered } }) => {
        const $card = document.createElement('a');
        $card.href = link;
        $card.classList.add('card');
        $card.innerHTML = `
            <h5 class="card__title">${ rendered }</h5>
            <div class="card__content">
                <p>Some content</p>
            </div>
        `;
        $results.append($card);
    })
}