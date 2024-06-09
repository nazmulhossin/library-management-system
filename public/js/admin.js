/* shrink and expand sidebar */
document.querySelector('aside div .fa-down-left-and-up-right-to-center').addEventListener('click', () => {
    document.querySelector('aside').classList.add('shrink-sidebar');
});

document.querySelector('aside div .fa-up-right-and-down-left-from-center').addEventListener('click', () => {
    document.querySelector('aside').classList.remove('shrink-sidebar');
});