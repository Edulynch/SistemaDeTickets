$("#gsoporte_form").validate({
    rules: {
        gsoporte_titulo: {
            required: true,
            regex: "^[a-zA-Z ]+$",
            rangelength: [5, 50]
        },
        gsoporte_descripcion: {
            required: true,
            rangelength: [5, 50]
        }
    },
    messages: {
        gsoporte_titulo: {
            required: "Ingresa un titulo para el Grupo.",
            regex: "Solo texto es permitido.",
            rangelength: "El largo debe estar entre 5 y 50 caracteres."
        },
        gsoporte_descripcion: {
            required: "Ingresa una descripción",
            rangelength: "El largo debe estar entre 5 y 50 caracteres."
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