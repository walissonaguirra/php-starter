<!doctype html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?= $title; ?></title>
    <style>
        body {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-family: Helvetica, sans-serif;
        }

        table {
            max-width: 500px;
            padding: 0 10px;
            background: #ffffff;
        }

        .content {
            font-size: 16px;
            margin-bottom: 25px;
            padding-bottom: 5px;
            border-bottom: 1px solid #EEEEEE;
        }

        .content p {
            margin: 25px 0;
        }

        .footer {
            font-size: 14px;
            color: #888888;
            font-style: italic;
        }

        .footer p {
            margin: 0 0 2px 0;
        }
    </style>
</head>
<body>
<table role="presentation" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <div class="content">
                <?= $this->section("content"); ?>
            </div>
        </td>
    </tr>
</table>
</body>
</html>