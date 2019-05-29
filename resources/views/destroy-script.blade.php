<form id="form-destroy" action="#" method="POST">
    @csrf
    @method('DELETE')
</form>

<script>
    document.addEventListener('click', function (e) {
        if (!e.target.matches('a.btn-destroy')) return;

        e.preventDefault();

        /* Confirm delete */
        if (!confirm('@lang('crudpage::text.confirm_delete')')) {
            return;
        }

        var form = document.querySelector('#form-destroy');
        form.action = e.target.href;
        form.submit();
    });
</script>
