document.addEventListener("DOMContentLoaded", function () {
    $("#btnExportQR").click(function (event) {
        event.preventDefault();

        $.ajax({
            url: "{{ route('export.qr') }}",
            method: "GET",
            success: function (response) {
                var qrImage = "data:image/png;base64," + response.qr;
                $("#qrImage").attr("src", qrImage);
                $("#downloadLink").attr("href", qrImage);

                var modal = new bootstrap.Modal(
                    document.getElementById("qrModal")
                );
                modal.show();
            },
            error: function () {
                alert("Error al generar el código QR.");
            },
        });
    });
});
