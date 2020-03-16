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
