let addButton = document.getElementById('add-button');

addButton.addEventListener('click', generate, false);

function generate()
{
    let form = document.getElementById('form-link');
    fetch('\\link', {method: 'POST', body: new FormData(form)}).then((response) => {
        if(response.status == 400) 
        {
           alert('Ошибка валидации');
           return;
        }
        return response.json();
      })
      .then((data) => {
        let linkFiled = document.getElementById('link-filed');
        linkFiled.innerHTML = data['link'];
        linkFiled.href = data['link'];
      });
}
