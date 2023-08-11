console.log("Script loaded");
var editModal = document.getElementById("editModal");
var editIdInput = document.getElementById("editId");
var editNombreInput = document.getElementById("editNombre");

function openEditModal(id, nombre, matricula, email, direccion) {
  editIdInput.value = id;
  editModal.style.display = "flex";

  var form = editModal.querySelector("form");
  var idField = form.querySelector("#editId");
  var nombreField = form.querySelector("#editNombre");
  var matriculaField = form.querySelector("#editMatricula");
  var emailField = form.querySelector("#editEmail");
  var direccionField = form.querySelector("#editDireccion");

  idField.value = id;
  nombreField.value = nombre;
  matriculaField.value = matricula;
  emailField.value = email;
  direccionField.value = direccion;

  editModal.style.display = "block";
}

function closeModal() {
  editModal.style.display = "none";
}

function deleteRow(id) {
  var confirmDelete = confirm(
    "¿Estás seguro de que deseas eliminar este registro?"
  );
  if (confirmDelete) {
    // Realizar la solicitud AJAX al servidor para eliminar el registro
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Recargar la página después de eliminar el registro
        window.location.reload();
      }
    };
    xhr.open("GET", "delete.php?id=" + id, true);
    xhr.send();
  }
}
