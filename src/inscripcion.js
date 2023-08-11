function inscribirClase(claseId) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      window.location.reload();
    }
  };
  xhr.open("GET", "inscripcion.php?claseId=" + claseId, true);
  xhr.send();
}

function darDeBajaClase(claseId) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      window.location.reload();
    }
  };
  xhr.open("GET", "darDeBaja.php?claseId=" + claseId, true);
  xhr.send();
}
