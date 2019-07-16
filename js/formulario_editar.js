$("#formulario_form").validate({
    rules: {
        ticket_titulo: {
            required: true,
            rangelength: [5, 100]
        },
        ticket_gsoporte_id: {
            required: true
        },
        ticket_descripcion: {
            required: true,
            rangelength: [5, 255]
        },
        ticket_estado_id: {
            required: true
        }
    },
    messages: {
        ticket_titulo: {
            required: "Ingresa un titulo para el Ticket.",
            rangelength: "El largo debe estar entre 5 y 100 caracteres."
        },
        ticket_gsoporte_id: {
            required: "Selecciona un Grupo de Soporte."
        },
        ticket_descripcion: {
            required: "Ingresa una descripción para el Ticket",
            rangelength: "El largo debe ser minimo de 5 caracteres."
        },
        ticket_estado_id: {
            required: "Selecciona un estado de Ticket"
        }
    }
});

$.validator.addMethod(
    "regex",
    function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Revisa lo introducido en el campo."
);