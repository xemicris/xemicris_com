/**
 * Función que retorna un mensaje cuando no hay notas
 * @returns {object} div
 */
export function noNotes() {
    const div = document.createElement('div');
    div.className = 'text-center';
    const texto = document.createElement('h3');
    texto.textContent = 'No hay notas';
    div.appendChild(texto);
    return div;
}