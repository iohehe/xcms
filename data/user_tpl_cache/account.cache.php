<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
</head>
<body>
    <table>
        <thead>
        <h3>User Info</h3>
        </thead>
        <tbody border="1">
            <tr>
                <td>user_name</td>
                <td>{{ name }}</td>
            </tr>
            <tr>
                <td>email</td>
                <td>{{ email }}</td>
            </tr>

            <br />
            <tr>
                <td>
                    <form enctype="multipart/form-data" method="post" action="index.php?c=account&a=uploadProfile">
                        <input type="file" name="profile" />
                        <input type="submit" name="submit" value="Submit" />
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <br />
    <tr><img src="data/upload/{{ profile }}"/></tr>
</body>
</html>