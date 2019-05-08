<script>
    @if(count($errors))
        var error = new Error();
        var arrayErros = JSON.parse('{!! json_encode($errors->toArray()) !!} ');
        error.apply(arrayErros);
    @endif

   $('.add-ticket').on('click', function () {
       submitForm($('#frm-add-ticket'));
   });
</script>