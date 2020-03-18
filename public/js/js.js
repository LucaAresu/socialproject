let configHeaders = {
    "Content-Type": "application/json",
    "Accept": "application/json, text-plain, */*",
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": window.laravel.csrf
};
function cancellaPost(id ){
     let confirm = window.confirm('Vuoi cancellare questo post?');
     if (confirm)
         document.querySelector('#form-' + id).submit();
 }

function caricaCommenti() {
    event.preventDefault();
    let visualizzaForm = () => {
        let margin = 'mt-3';
        padre = document.querySelector('div#' + event.target.id);
        form = document.createElement('form');
        form.id = 'form-'+event.target.id;
        form.method = 'POST';
        form.action = event.target.href;
        padre.appendChild(form);

        textArea = document.createElement('textArea');
        textArea.classList.add('form-control',margin);
        textArea.name = 'contenuto';
        form.appendChild(textArea);

        hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = '_token';
        hidden.value = window.laravel.csrf;
        form.appendChild(hidden);

        submit = document.createElement('button');
        submit.classList.add('btn', 'btn-primary',margin, 'mb-3');
        submit.innerHTML = 'Invia';
        submit.type = 'submit';
        submit.addEventListener('click',invioForm);
        form.appendChild(submit);

        var spazioCommenti = document.createElement('div');
        spazioCommenti.id = 'spazio-'+padre.id;
        padre.appendChild(spazioCommenti);
        return spazioCommenti;

    };

    let add = document.querySelector('#form-'+ event.target.id);
    if(add === null) {

        let spazioCommenti = visualizzaForm();

        let id = event.target.id.replace('comment-', '');
        let headers = new Headers(configHeaders);
        let init = {
            method: 'POST',
            headers: headers,
            body: JSON.stringify({
                'postId': id,
                '_token': window.laravel.csrf
            }),
        }

        let request = new Request(window.laravel.basePath+'/json/commenti/' + id, init);
        fetch(request).then(resp => {
            if (resp.ok)
                return resp.text();
            else throw new Error('fail');

        }).then(resp => {
            if (resp) {
                spazioCommenti.innerHTML = resp;
            }
            else
                throw new Error('no data');
        }).catch(err => {

        });
    }
}
function invioForm() {
    event.preventDefault();
    let padre = event.target.parentElement.parentElement;
    let spazioCommenti = padre.querySelector('#spazio-'+padre.id)
    form = event.target.parentNode;
    if(!form[0].value) {
        form[0].classList.add('is-invalid');
        return;
    }
    let headers = new Headers(configHeaders);

    let init = {
        method: 'POST',
        headers: headers,
        body: JSON.stringify({
            'contenuto' : form[0].value,
            '_token': window.laravel.csrf
        }),
    }
    let request = new Request(form.action, init);
    fetch(request).then(resp => {
        if (resp.ok)
            return resp.text();
        else throw new Error('fail');

    }).then(resp => {
        if(resp) {
            spazioCommenti.insertAdjacentHTML("afterbegin", resp);
            form[0].value = '';
        }else
            throw new Error('Nessun valore');

    }).catch(err => {
        console.log(err);
    });
}
function like(bottone, id) {
    let invertiBottone = () => {
        let i = bottone.querySelector('i');
        i.classList.toggle('far');
        i.classList.toggle('fas');
        let numlikes = bottone.parentElement.parentElement.parentElement.parentElement.querySelector('.numlikes');
        numlikes.innerHTML = numlikes.innerHTML.replace('likes','').trim();
        finale === 'mettiLike' ? numlikes.innerHTML++ : numlikes.innerHTML--;
        numlikes.innerHTML+=' likes';
    };
    let i = bottone.querySelector('i');
    let finale = i.classList.contains('far') ? 'mettiLike': 'togliLike';
    let headers = new Headers(configHeaders);
    let init = {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(
            {
                'postid': id,
                '_token': window.laravel.csrf,
            }
        )
    };
        let request = new Request(window.laravel.basePath+'/json/post/'+finale,init);
        fetch(request).then(resp => {
            if(resp.ok)
                return resp.json();
            throw new Error('errore');
        }).then(resp =>{
            if(resp)
                invertiBottone();
            else throw new Error('boh');
        }).catch(err =>{
            console.log(err);
        });

}

function vote(trigger) {
    let param = trigger.id.split('-');
    let modo = param[0];
    let commentId = param[1];
    let differenza = 0;
    let gestisciFreccie = () => {
        let cambiaSomma = n => {
            let div = document.querySelector('#punti-'+commentId);
            console.log(div);
            let nvoti = parseInt(div.innerHTML);
            nvoti = modo === 'up' ? nvoti+=n : nvoti-=n;
            div.innerHTML = nvoti+' punti';

        };
        let coloreTesto = param[0] === 'up' ? 'text-primary' : 'text-danger';
        let altroModo = modo === 'up' ? 'down' : 'up';
        let altroDiv = trigger.parentElement.querySelector('#' + altroModo + '-' + commentId);
        if (trigger.classList.contains('votato')){
            trigger.classList.remove('votato', 'text-primary', 'text-danger');
            differenza--;
        }
        else {
            if(altroDiv.classList.contains('votato')) {
                altroDiv.classList.remove('votato', 'text-primary', 'text-danger');
                differenza++;
            }
            trigger.classList.add('votato', coloreTesto);
            differenza++;
        }
        cambiaSomma(differenza);
    }

    let headers = new Headers(configHeaders);
    let init = {
        method: 'POST',
        headers: headers,
        body: JSON.stringify({
            '_token': window.laravel.csrf,
            'commentId': commentId,
            'modo': param[0] === 'up',

        })
    }
    let request = new Request(window.laravel.basePath+'/json/vote/handle', init)
    fetch(request).then(resp => {
        if(resp.ok)
            return resp.text();
    }).then(resp =>
    {
        if (resp)
            gestisciFreccie();
    }).catch();
}

function follow(userId) {

    let scambioBottoni = (bottone) => {
        bottone.classList.toggle('btn-outline-success');
        bottone.classList.toggle('btn-success');
        bottone.innerHTML = bottone.innerHTML === 'Segui'? 'Seguito':'Segui';
    };
    let headers = new Headers(configHeaders);
    let init = {
        method: 'POST',
        headers: headers,
        body: JSON.stringify({
            '_token': window.laravel.csrf,
            'user': userId,
        })
    };
    let request = new Request(window.laravel.basePath+'/json/follow',init);

    fetch(request).then(resp => {
        if(resp.ok)
            return resp.text();
        throw new Error('boh');
    })
    .then(resp =>{
        if(resp){
            document.querySelectorAll('.user-'+userId).forEach(ele => {
                scambioBottoni(ele);
            });
        }
        else
            throw new Error('err');
    }).catch(err =>{
        console.log(err);
    });
}

