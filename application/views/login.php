<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jquery -->
    <script src="<?= base_url('assets/jquery/dist/jquery.min.js');?>"></script>
    <title>Login</title>
</head>
<body>
    <form action="" id="form-login">
        <label for="">Username</label>
        <input type="text" name="username">
        <br>
        <label for="">Password</label>
        <input type="text" name="password">
        <br>
        <button class="btn-login" type="submit">Login</button>
    </form>


    <script>
        $(document).ready(function() {
            $('#form-login').submit((e) => {
                e.preventDefault();

                var form = $('#form-login').serialize();
                $.ajax({
                    type: 'post',
                    data:  form,
                    url:  '<?= site_url('auth/identify');?>',
                    dataType:  'text',
                    success: function(response) {
                        console.log(response)
                    }
                })
            })
        })
    </script>
</body>
</html>