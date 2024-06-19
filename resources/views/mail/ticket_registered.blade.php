<!DOCTYPE html>
<html>
<head>
    <title>Ticket Registrado</title>
</head>
<body>
    <h1>Ticket Registrado</h1>
    <p>Hola, {{ $ticket->first_name }} {{ $ticket->last_name }}</p>
    <p>Tu ticket ha sido registrado con éxito.</p>
    <p><strong>ID del Ticket:</strong> {{ $ticket->id }}</p>
    <p><strong>Asunto:</strong> {{ $ticket->subject }}</p>
    <p><strong>Descripción:</strong> {{ $ticket->description }}</p>
    <p>Gracias por usar nuestro sistema.</p>
</body>
</html>
