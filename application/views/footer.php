<script>
    ClassicEditor.create( document.querySelector( '#editor' ) )
    .then( editor => {
        editor.ui.view.editable.element.style.height = '300px';
        editor.ui.view.editable.element.style.width = '100%';
    } )
    .catch( error => {
        console.error( error );
    } );

</script>

</body>

</html>