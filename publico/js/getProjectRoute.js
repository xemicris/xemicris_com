export function getProjectRoute(){
    const dominio = window.location.origin;
    const separador = '/';
    if(dominio != 'https://xemicris.com'){
        let LocalONo = window.location.pathname.split(separador);
        return dominio + '/' + LocalONo[1];
    }else if(dominio == 'https://xemicris.com'){
        return dominio;
    }
}