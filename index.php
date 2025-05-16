<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel</title>
    <link rel="apple-touch-icon" sizes="180x180" href="admin/image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="32x32" href="admin/image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="16x16" href="admin/image/ph-logo.webp">


    <style>
        body,
        html {
            height: 100%;
            background-position: center; 
            background-repeat: no-repeat; 
            background-size: cover;
            background-image: url(admin/image/test.jpg);
        }
        
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            width: 700px;
            padding: 5px;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .full-height {
            height: 30vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color:rgb(212, 232, 241);
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="flex-center position-ref full-height">
                <div class="content">
                    <div class="title m-b-md">
                        Paradise Hotel
                    </div>
                    <div class="links">
                        <a href="admin/">Admin Log In</a>
                        <a href="manager/">manager Log In</a>
                        <a href="employee">employee Log In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>