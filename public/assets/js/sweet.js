document.addEventListener("DOMContentLoaded", function () {
    // Agrega el evento click a todos los botones de editar
    document.querySelectorAll(".btn-edit").forEach(function (btn) {
        btn.addEventListener("click", function () {
            // Obtén los datos del ticket desde los atributos data-
            var ticketId = this.getAttribute("data-id");
            var ticketStatusId = this.getAttribute("data-status-id");

            // Asigna los datos al formulario del modal
            document.getElementById("ticketId").value = ticketId;
            document.getElementById("txt_ticket_status_id").value =
                ticketStatusId;

            // Abre el modal
            var modal = new bootstrap.Modal(
                document.getElementById("modalEditar")
            );
            modal.show();
        });
    });
});

document
    .querySelector('button[type="submit"]')
    .addEventListener("click", function (e) {
        e.preventDefault();
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, actualizar!",
        }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes enviar tu formulario
                fetch("/actualizar-tickets", {
                    method: "POST",
                    body: new FormData(document.getElementById("formEditar")),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.status === "correcto") {
                            Swal.fire("¡Actualizado!", data.message, "success");
                        } else {
                            Swal.fire("Error", data.message, "error");
                        }
                    })
                    .catch((error) => {
                        Swal.fire(
                            "Error",
                            "Ocurrió un error al actualizar el ticket.",
                            "error"
                        );
                    });
            }
        });
    });
