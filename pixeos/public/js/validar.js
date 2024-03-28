export function validarEmail(supuestoEmail) {
    var expresion = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (expresion.test(supuestoEmail)) {
        return true;
    } else {
        return false;
    }
}