$(function () {
  var operation = "C"; //"C"=Crear
  var selected_index = -1; // Indice de el elemento seleccionado en la lista
  var tblPersons = localStorage.getItem("tblPersons"); //Retornar los datos almacenados
  tblPersons = JSON.parse(tblPersons); //Convertir String a Object
  if (tblPersons === null) // Si no hay datos, inicializar un array vacio
      tblPersons = [];

  function Create() {
    //Obtener los valores de la forma HTML y transformalos en String.
    var person = JSON.stringify({
      ID: $("#txtID").val(),
      Name: $("#txtName").val(),
      Phone: $("#txtPhone").val(),
      Email: $("#txtEmail").val()
    }); 
    //Añadir el objeto a la tabla
    tblPersons.push(person);
    //Almacenar los datos en el Local Storage
    localStorage.setItem("tblPersons", JSON.stringify(tblPersons));
    alert("Los datos han sido almacenados"); //Mensaje de alerta
    return true;
  }

  function List() {
    $("#tblList").html("");
    $("#tblList").html(
            "<thead>" +
            "<tr>" +                
            "<th>ID</th>" +
            "<th>Nombre</th>" +
            "<th>Teléfono</th>" +
            "<th>Email</th>" +
            "<th>Acciones</th>" +
            "</tr>" +
            "</thead>" +
            "<tbody>" +
            "</tbody>"
            ); //Agregar la tabla a la estructura HTML
    for (var i in tblPersons) {
        var per = JSON.parse(tblPersons[i]);
        $("#tblList tbody").append("<tr>" +                    
                "<td>" + per.ID + "</td>" +
                "<td>" + per.Name + "</td>" +
                "<td>" + per.Phone + "</td>" +
                "<td>" + per.Email + "</td>" +                    
                "<td><img src='edit.png' alt='Edit" + i + "' class='btnEdit'/>&nbsp &nbsp<img src='delete.png' alt='Delete" + i + "' class='btnDelete'/></td>" +
                "</tr>"
                );
    } //Recorrer y agregar los items a la tabla HTML
  }
  
  List();
});
