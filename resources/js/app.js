import Quill from "quill";
import "quill/dist/quill.snow.css";
import './home.js';

let quillInstance = null;

function initQuill (){
    const editorContainer = document.getElementById('quill-editor');
    const contentInput = document.getElementById('content-input');

    if (!editorContainer || !contentInput) {
        quillInstance = null;
        return;
    }

    editorContainer.innerHTML = '';
    const toolbar = editorContainer.previousElementSibling;
    if (toolbar && toolbar.classList.contains('ql-toolbar')) {
        toolbar.remove();
    }

    quillInstance = new Quill(editorContainer, {
        theme: "snow",
        placeholder: "Escribe el contenido de la página...",
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                [{ font: [] }],
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ align: [] }],
                ["link", "image", "video"],
                ["formula", "code-block", "clean"],
            ],
        },
    });

    if (contentInput.value.trim() !== '') {
        quillInstance.root.innerHTML = contentInput.value;
    }

    quillInstance.on("text-change", () => {
        contentInput.value = quillInstance.root.innerHTML;
        contentInput.dispatchEvent(new Event("input"));
    });
}

document.addEventListener("livewire:navigated", initQuill);
if (!window.Livewire) {
    document.addEventListener("DOMContentLoaded", initQuill);
}
