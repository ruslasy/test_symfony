import '../css/app.scss';


let addButton = document.getElementById('add-button');

addButton.addEventListener('click', generate, false);

function generate()
{
    let form = document.getElementById('form-link');
    fetch('\\link', {method: 'POST', body: new FormData(form)}).then((response) => {
        return response.json();
      })
      .then((data) => {
        let linkFiled = document.getElementById('link-filed');
        linkFiled.innerHTML = data['link'];
        linkFiled.href = data['link'];
      });
}
