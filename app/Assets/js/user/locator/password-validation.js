const validateFormPasswords = () => {
    const password = document.getElementById("password-one").value;
    const confirmPassword = document.getElementById("password-two").value;

    // Validate that passwords match
    if (password !== confirmPassword) {
        swal("Atención", "Las contraseñas no coinciden", "error");
        return false;
    }

    // Validate that the password contains at least one combination of letters and numbers
    const pattern = /^(?=.*\d)(?=.*[a-zA-Z]).*$/;
    if (password != "" && !pattern.test(password)) {
        swal("Atención", "Las contraseñas deben contener asl menos una combinación de letras y números", "error");
        return false;
    }

    return true; // Allow form submission if all validations pass
};
