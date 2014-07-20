function loadTinyMCEEditor() {
  tinyMCE.init({
    selector: "textarea.textareaMCE",
    entity_encoding : "named+numeric",
    plugins: "image moxiemanager",

    toolbar: "undo redo | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | image insertimage insertfile"
  });
}
loadTinyMCEEditor();