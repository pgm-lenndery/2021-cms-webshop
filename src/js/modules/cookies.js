import { cookies, node } from 'cutleryjs';

export const spotNotifyCookieHooks = () => {
    const $notifyCards = node('[data-cookie-hook].card--notify', true);
    $notifyCards.forEach( n => {
        const { dataset: { cookieHook } } = n;
        
        const cookie = cookies.get(`hook:${ cookieHook }`);
        if (cookie) n.remove();
    })
}

export const setCookieHook = (name) => {
    cookies.set(`hook:${name}`, 'true');
};

export const cookieHook = (hook, callback = () => {null}) => {
    const $target = node(`[data-cookie-hook="${hook}"]`)
    if (cookies.get(`hook:${hook}`) == null) {
        callback($target);
        if ($target.classList.contains('notice')) $target.classList.add('notice--show');
    };
}