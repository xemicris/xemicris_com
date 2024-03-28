const cuerpo = document.querySelector('.body');
const menuSuperior = document.querySelector('.menu-superior');

if(cuerpo) cuerpo.addEventListener('click', () =>{
                if(menuSuperior) menuSuperior.classList.remove('show');
            });
if(menuSuperior) menuSuperior.addEventListener('click', (evento) =>{
                    evento.stopPropagation();
                })