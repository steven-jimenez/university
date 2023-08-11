console.log("Script loaded");
var editModal = document.getElementById("editModal");
var editIdInput = document.getElementById("editId");
var editMatriculaInput = document.getElementById("editMatricula");
var editEmailInput = document.getElementById("editEmail");
var editNombreInput = document.getElementById("editNombre");
var editDireccionInput = document.getElementById("editDireccion");

function openEditModal(id, nombre, matricula, email, direccion) {
  editIdInput.value = id;
  editMatriculaInput.value = matricula;
  editEmailInput.value = email;
  editNombreInput.value = nombre;
  editDireccionInput.value = direccion;

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
