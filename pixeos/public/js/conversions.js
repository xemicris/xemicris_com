export function convertirFechaEspanol(string) {
    var info = string.split('-').reverse().join('/');
    return info;
}
export function convertirFechaIngles(string) {
    var info = string.split('/').reverse().join('-');
    return info;
}