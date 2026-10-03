document.addEventListener("DOMContentLoaded", () => {

    // Función reutilizable para elementos contenteditable (se mantiene para el TÍTULO)
    function setupInlineEdit(elementId, statusId, fieldName, allowEnterKey = false) {
        const element = document.getElementById(elementId);
        const saveStatus = document.getElementById(statusId);

        if (!element || !saveStatus) return;

        let originalContent = "";

        element.addEventListener("focus", () => {
            originalContent = element.innerText.trim();
        });

        if (!allowEnterKey) {
            element.addEventListener("keydown", (e) => {
                if (e.key === "Enter") {
                    e.preventDefault();
                    element.blur();
                }
            });
        }

        element.addEventListener("blur", async () => {
            const newContent = element.innerText.trim();

            if (newContent === originalContent) return;

            if (newContent === "") {
                element.innerText = originalContent;
                return;
            }

            saveStatus.classList.remove("hidden");
            saveStatus.textContent = "Guardando cambios...";

            try {
                const id = element.dataset.id;
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");

                const response = await fetch(`/admin/home/${id}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({ [fieldName]: newContent }),
                });

                if (!response.ok) throw new Error("Error al guardar");

                originalContent = newContent;
                element.innerText = newContent;

                saveStatus.textContent = "¡Guardado!";
                setTimeout(() => {
                    saveStatus.classList.add("hidden");
                }, 2000);

            } catch (error) {
                console.error(error);
                saveStatus.textContent = "Error al guardar";
                element.innerText = originalContent;
            }
        });
    }

    // Configurar autoguardado para el TÍTULO
    setupInlineEdit("editable-title", "save-status", "title", false);

    // ==========================================
    // AUTOGUARDADO PARA QUILL (BODY)
    // ==========================================
    function setupQuillAutosave() {
        const titleElement = document.getElementById("editable-title");
        const saveStatusBody = document.getElementById("save-status-body");
        const contentInput = document.getElementById("content-input");

        if (!titleElement || !saveStatusBody || !contentInput) return;

        let timeout = null;
        let originalContent = contentInput.value;

        // Escuchamos el evento 'input' que app.js dispara al actualizar contentInput desde Quill
        contentInput.addEventListener("input", () => {
            clearTimeout(timeout);

            // Debounce de 1 segundo tras dejar de escribir
            timeout = setTimeout(async () => {
                const newContent = contentInput.value;

                if (newContent === originalContent) return;

                saveStatusBody.classList.remove("hidden");
                saveStatusBody.textContent = "Guardando cambios...";

                try {
                    const id = titleElement.dataset.id;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");

                    const response = await fetch(`/admin/home/${id}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({ body: newContent }),
                    });

                    if (!response.ok) throw new Error("Error al guardar");

                    originalContent = newContent;
                    saveStatusBody.textContent = "¡Guardado!";
                    setTimeout(() => {
                        saveStatusBody.classList.add("hidden");
                    }, 2000);

                } catch (error) {
                    console.error(error);
                    saveStatusBody.textContent = "Error al guardar";
                }
            }, 1000);
        });
    }

    setupQuillAutosave();
});
