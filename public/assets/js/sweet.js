document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-edit").forEach(function (btn) {
        btn.addEventListener("click", function () {
            var ticketId = this.getAttribute("data-id");
            var ticketStatusId = this.getAttribute("data-status-id");
            document.getElementById("ticketId").value = ticketId;
            document.getElementById("txt_ticket_status_id").value =
                ticketStatusId;
            var modal = new bootstrap.Modal(
                document.getElementById("modalEditar")
            );
            modal.show();
        });
    });
});

document.getElementById("formEditar").addEventListener("submit", function (e) {
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
            fetch("/actualizar-tickets", {
                method: "POST",
                body: new FormData(this),
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "correcto") {
                        var ticketId =
                            document.getElementById("ticketId").value;
                        var selectedStatus = document.querySelector(
                            "#txt_ticket_status_id option:checked"
                        ).textContent;
                        document.querySelector(
                            "#ticket-" + ticketId + " .ticket-status"
                        ).textContent = selectedStatus;
                        document.querySelector(
                            "#ticket-" + ticketId + " .updated-at"
                        ).textContent = new Date().toLocaleString();
                        Swal.fire("¡Actualizado!", data.message, "success");
                        var modal = bootstrap.Modal.getInstance(
                            document.getElementById("modalEditar")
                        );
                        modal.hide();
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
