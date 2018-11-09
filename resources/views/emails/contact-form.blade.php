<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <style>
            .wrapper {
                max-width: 480px;
                background-color: white;
                display: block;
                margin: auto;
                min-height: 500px;
                background: #fafafa;
            }

            .header {
                padding: 20px;
                background: rgba(0,0,0,0.75);
                box-shadow: 0px 5px 5px rgba(0,0,0,0.1);
            }

            .header img {
                width: 70%;
                height: auto;
                display: block;
                margin: auto;
            }

            .footer {
                background: green;
                color: white;
                padding: 7px;
                text-align: center;
            }

            .body {
                margin: 40px 0px;
                text-align: justify;
            }

            .mt-3 {
                margin-top: 40px;
            }
            h4 {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <img src="https://gpibmargamulya.or.id/app-asset/img/logo-marga-mulya.png" alt="logo">
            </div>
            <div class="body">
                <h4>Sender</h4>
                <p>{{ $sender }}</p>
                <h4 class="mt-3">Message</h4>
                <p>{{ $body }}</p>
            </div>
            <div class="footer">
                <div class="col text-center">
                    <small class="m-0">Powerred by <a href="https://kevingiovanni.com">Kevin Giovanni</a></small>
                </div>
            </div>
        </div>
    </body>
</html>
