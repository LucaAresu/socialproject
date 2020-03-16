document.addEventListener('DOMContentLoaded', evt =>{
    window.scrollTo(0, 0);
});
let scrollDisponibile=true;

document.addEventListener('scroll', event => {
    if ((window.innerHeight + window.scrollY + (window.innerHeight / 3)) >= document.body.scrollHeight) {
        if(scrollDisponibile) {
            scrollDisponibile = false;
            let divs= document.querySelectorAll('.containerCommenti');
            let lastCom = divs[divs.length-1];
            let lastComId = lastCom.id.replace('com-','');
            let headers = new Headers(configHeaders);
            let init = {
                method: 'POST',
                headers: headers,
                body: JSON.stringify({
                    'comId': lastComId,
                    '_token': window.laravel.csrf,
                }),
            };
            let request = new Request(window.laravel.basePath+'/json/prossimoCommento', init);
            fetch(request).then(resp => {
                if (resp.ok)
                    return resp.text();
                throw new Error('errore1');
            }).then(resp => {
                if (resp) {
                    scrollDisponibile = true;
                    lastCom.parentElement.insertAdjacentHTML("beforeend", resp);
                }
            }).catch(err => {
                console.log(err);
            });
        }
    }
});
