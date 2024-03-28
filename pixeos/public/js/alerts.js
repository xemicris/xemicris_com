export const alerts = (icon = '', title = '', showConfirmButton = '', timer = '', showCancelButton = '', confirmButtonColor = '', 
                        cancelButtonColor = '',  confirmButtonText = '', cancelButtonText = '', text = '', heightAuto = '', scrollbarPadding = '')=>{
    const alert = Swal.fire({
        icon: icon,
        title: title,
        text: showConfirmButton,
        timer: timer,
        showCancelButton: showCancelButton,
        confirmButtonColor: confirmButtonColor,
        cancelButtonColor: cancelButtonColor,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
        text: text,
        heightAuto: heightAuto,
        scrollbarPadding: scrollbarPadding
    });

    return alert;
}