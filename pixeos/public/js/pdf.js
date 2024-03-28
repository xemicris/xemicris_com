export const pdf = (respuesta)=>{
    var opt = {
        margin: 1,
        filename: 'nota.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'cm', format: 'letter', orientation: 'landscape' }
    };
    html2pdf().set(opt).from(respuesta).save();
}