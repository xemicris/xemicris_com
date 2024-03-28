export async function useFetch(url, dataForm = '', simpleData = '', arrayData = [], ret = true, resp = true){
    let formulario;
    if(dataForm !== ''){
        formulario = new FormData(dataForm)
    } else{
       formulario =  new FormData();
    }
    if(simpleData != ''){
        const key = Object.keys(simpleData)[0]
        const value = Object.values(simpleData)[0]
        formulario.append(key, value);
    }else{
        arrayData.forEach(simD =>{
            const key = Object.keys(simD)[0]
            const value = Object.values(simD)[0]
            formulario.append(key, value);
        })
    }
    let respuesta = await fetch(url, {
        method: "POST",
        body: formulario,
        mode: 'cors',
        cache: 'no-cache',
    })
    if(ret){
        let respuestaJson = (resp) ? await respuesta.json() : await respuesta.text();
        return respuestaJson;
    }
}
