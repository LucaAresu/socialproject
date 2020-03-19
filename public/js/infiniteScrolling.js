document.addEventListener('DOMContentLoaded', evt =>{
    window.scrollTo(0, 0);


    let btnNewPost = document.querySelector('#new-post-button')
    if(btnNewPost) {
        btnNewPost.addEventListener('click', evt => {
            fetch(window.laravel.basePath+'/json/getCrea').then(resp => {
                return resp.text();
            }).then(resp => {
                showCrea(resp);
                btnNewPost.parentElement.removeChild(btnNewPost);

            }).catch(err => {

            });
        });
    }
    let showCrea = resp => {
        let div = document.createElement('div');
        div.innerHTML = resp;
        div.id = 'divCrea';
        btnNewPost.parentElement.prepend(div);
        $('#divCrea').hide();
        $('#divCrea').fadeIn();
    };

});
let scrollDisponibile=true;

document.addEventListener('scroll', event => {
    if ((window.innerHeight + window.scrollY + (window.innerHeight / 3)) >= document.body.scrollHeight) {
        if(scrollDisponibile) {
            scrollDisponibile = false;
            let divs= document.querySelectorAll('.containerPost');
            let lastDiv = divs[divs.length-1];
            let lastPostId = lastDiv.id.replace('containerPost-','');
            if(typeof userId === 'undefined')
                userId = 0;
            let headers = new Headers(configHeaders);
            let init = {
                method: 'POST',
                headers: headers,
                body: JSON.stringify({
                    'postId': lastPostId,
                    '_token': window.laravel.csrf,
                    'userId': userId,
                    'modo': modo,
                }),
            }
            let request = new Request(window.laravel.basePath+'/json/prossimaPagina', init);
            fetch(request).then(resp => {

                if (resp.ok)
                    return resp.text();
                throw new Error('errore1');
            }).then(resp => {
                if (resp) {
                    scrollDisponibile = true;
                    lastDiv.parentElement.insertAdjacentHTML("beforeend", resp);
                }

            }).catch(err => {
                console.log(err);
            });
        }
    }
});


