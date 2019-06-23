$("#user_form").validate({
    rules: {
        user_nombre: {
            required: true,
            regex: "^[a-zA-Z ]+$",
            rangelength: [10, 50]
        },
        user_correo: {
            required: true,
            email: true,
            rangelength: [10, 255]
        },
        user_password: {
            required: true,
            rangelength: [6, 255]
        },
        user_empresa: {
            required: true,
            rangelength: [5, 50]
        },
        user_direccion: {
            required: true,
            rangelength: [5, 50]
        },
        user_telefono: {
            required: true,
            regex: "^9[0-9]{8}$"
        },
        user_web_empresa: {
            required: true,
            url: true
        },
        user_cargo: {
            required: true,
            rangelength: [5, 50]
        },
        user_priv_id: {
            required: true
        }
    },
    messages: {
        user_nombre: {
            required: "Ingresa tu nombre Completo.",
            regex: "Solo texto es permitido.",
            rangelength: "El largo debe estar entre 10 y 50 caracteres."
        },
        user_correo: {
            required: "Ingresa un Correo Electronico.",
            email: "Ingrese un Correo Electronico Valido.",
            rangelength: "El largo debe ser minimo de 10 caracteres."
        },
        user_password: {
            required: "Ingresa una contraseña.",
            rangelength: "El largo debe ser minimo de 6 caracteres."
        },
        user_empresa: {
            required: "Ingresa el nombre de la empresa.",
            rangelength: "El largo debe ser minimo de 5 caracteres."
        },
        user_direccion: {
            required: "Ingresa una dirección.",
            rangelength: "El largo debe estar entre 5 y 50 caracteres."
        },
        user_telefono: {
            required: "Ingresa un telefono.",
            regex: "El formato correcto debe comenzar con un 9, seguido de 8 digitos."
        },
        user_web_empresa: {
            required: "Ingresa la web de una empresa.",
            url: "El formato correcto debe comenzar con http(s)."
        },
        user_cargo: {
            required: "Ingresa un cargo.",
            rangelength: "El largo debe estar entre 5 y 50 caracteres."
        },
        user_priv_id: {
            required: "Elige un Privilegio."
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