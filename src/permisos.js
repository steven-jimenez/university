console.log("Script loaded");

var editModal = document.getElementById("editModal");
var editIdInput = document.getElementById("editId");
var editEmailInput = document.getElementById("editEmail");
var editPermisoInput = document.getElementById("editPermiso");
var editEstadoCheckbox = document.getElementById("toggle");

function openEditModal(id, email, permiso, estado) {
  editIdInput.value = id;
  editEmailInput.value = email;
  editPermisoInput.value = permiso;
  editEstadoCheckbox.checked = estado === "activo";

  editModal.style.display = "block";
}

function closeModal() {
  editModal.style.display = "none";
}
