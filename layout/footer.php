
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

    const alert = (message, type) => {
        const wrapper = document.createElement('div')
        wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
            `   <div>${message}</div>`,
            `     <button type="button" class="close" data-dismiss="alert" aria-label="Close">`,
            `         <span aria-hidden="true">&times;</span>`,
            `     </button>`,
            `</div>`
        ].join('')

        alertPlaceholder.append(wrapper)
    }

    let xhr = null;
    $('#add_employee_form').on('submit', function (e) {
        if (xhr) {
            xhr.abort();
        }

        let $form = $(this);
        // let $data = $form.serialize(); //не сработало
        let $data = "first_name=" + $form.find("#first_name").val() +
            "&last_name=" + $form.find("#first_name").val() +
            "&patronymic=" + $form.find("#last_name").val() +
            "&phone_number=" + $form.find("#phone_number").val() +
            "&position_id=" + $form.find("#position_id").val() +
            "&department_id=" + $form.find("#department_id").val() +
            "&address_id=" + $form.find("#address_id").val();

        xhr = $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: $data,
            success: function (response) {
                let res = JSON.parse(response);

                if (res.success == false) {
                    alert('Сохранение не удалось! <hr>' + res.message, 'danger');
                } else {
                    alert('Данные сотрудника сохранены!', 'success');
                    setTimeout(function(){ $('#addEmployeeModal').hide();},2000);
                    document.location.reload();
                }

            },
            complete: function () {
                xhr = null;
            },
        });

        e.preventDefault();
    });
</script>