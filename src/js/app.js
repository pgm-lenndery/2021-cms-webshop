import { eventCallback, Api, getFormData, returnNode } from 'cutleryjs';
import { sesamCollapse, sesam } from 'sesam-collapse';
import feather from 'feather-icons';
import { Maronsy } from './modules/maronsy';
import { initialize } from './modules/app';
import { spotNotifyCookieHooks } from './modules/cookies';

// initialize scripts when dom is loaded
document.addEventListener('DOMContentLoaded', (event) => {
    initialize();
    spotNotifyCookieHooks();
    
    // initialize collapsing elements
    sesamCollapse.initialize();
    
    // initialize feather icons
    feather.replace({ stroke: '#88603d', 'stroke-width': '2.4px', width: '20px', height: '20px' });
    
    
    const sizesSingleShops = [
        { breakpoint: 0, options: { columns: 1 }},
        { breakpoint: 760, options: { columns: 1 }},
        { breakpoint: 1502, options: { columns: 2, justifyColumns: 'space-between' }},
        // { breakpoint: 1190, options: { columns: 3 }},
        // { breakpoint: 1502, options: { columns: 4, justifyColumns: 'center' }},
    ]
    returnNode('.maronsy.maronsy--single-shops') && new Maronsy({ sizes: sizesSingleShops, justifyColumns: 'flex-start' }).init();
    
    const sizesBlog = [
        { breakpoint: 0, options: { columns: 1 }},
        { breakpoint: 760, options: { columns: 2 }},
        { breakpoint: 1000, options: { columns: 2 }},
    ]
    returnNode('.maronsy.maronsy--blog') && new Maronsy({ sizes: sizesBlog, gap: '2rem' }).init();
});
