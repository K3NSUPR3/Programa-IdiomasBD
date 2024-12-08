
  function moveLabelUp(input) {
    const labelSpan = input.previousElementSibling.querySelector('.label-span');
    if (input.value) {
        labelSpan.classList.add('active');  // Agrega una clase para mover el label
    } else {
        labelSpan.classList.remove('active');
    }
}
  

  function verificarContraseñas() {
    var password1 = document.getElementById("password1").value;
    var password2 = document.getElementById("password2").value;
    var mensajeError = document.getElementById("mensajeError");
  
    if (password1 !== password2) {
      mensajeError.textContent = "Las contraseñas no coinciden.";
      return false; // Evita que el formulario se envíe
    } else {
      mensajeError.textContent = ""; // Limpia el mensaje de error si coinciden
      return true; // Permite enviar el formulario
    }
  }
  