function navigateTo(page)
{
    document.querySelectorAll('.mainlayout').forEach(
        section=> {
            section.classList.remove('active');
        }
    );

    const selectedPage =  document.getElementById(page);
    if(selectedPage)
    {
        selectedPage.classList.add('active');
    }
}

function handleRouting(){
    const hash = window.location.hash.substring(1) || 'home';
    navigateTo(hash);
}

window.addEventListener('load', handleRouting);
window.addEventListener('hashchange, handleRouting');