 // mostrar/ocultar contraseña
        function setupPasswordToggle(inputId, toggleId) {
            document
                .getElementById(toggleId)
                ?.addEventListener("click", function() {
                    const input = document.getElementById(inputId);
                    const icon = this.querySelector("i");
                    if (input.type === "password") {
                        input.type = "text";
                        icon.classList.replace("fa-eye", "fa-eye-slash");
                    } else {
                        input.type = "password";
                        icon.classList.replace("fa-eye-slash", "fa-eye");
                    }
                });
        }
        setupPasswordToggle("password", "togglePassword");
        setupPasswordToggle("confirmPassword", "toggleConfirmPassword");

        // Validación simple de coincidencia de contraseñas
        document.querySelector("form")?.addEventListener("submit", function(e) {
            const pass = document.getElementById("password").value;
            const confirm = document.getElementById("confirmPassword").value;
            if (pass !== confirm) {
                e.preventDefault();
                alert("Las contraseñas no coinciden. Por favor, verifica.");
                document.getElementById("confirmPassword").focus();
            }
        });
