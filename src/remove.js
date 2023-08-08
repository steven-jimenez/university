function deleteRow(button) {
  // Obtener la fila que contiene el botón
  const row = button.parentNode.parentNode;
  // Eliminar la fila
  row.remove();
}
