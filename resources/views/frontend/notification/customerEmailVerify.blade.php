<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
    
<body>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #F0F0F0;
        }
        a{
            text-decoration: none;
        }
        .email-body{
        background-color: #fff;
        padding: 20px;
        border-radius:10px;
        width: 570px;
        margin: 32px auto;
        }
        .btn {
            background-color: #35BB5B;
            border-outline:none;
            border:0;
            border-radius:10px;
            padding:23.5px 200px;
          font-weight:600;
          font-size: 18px;
          color: white;
            

        }

        .link_option {
        font-weight:400;
        margin: 0px;
        font-size: 12px !important;
        margin-top:30px
        }

        .link {
        font-weight:400;
        font-size:12px !important;
        color:#2FAFFD;
        }

        .container {
            padding: 40px;
        }

        img {
            display: block;
            margin: 0 auto;
            width: 215px;
        }


        .detials {
            margin: 1rem auto;
          text-align:center;
        }

        .header_text {
            text-align: center;
            font-weight:700;
          font-size:24px !important;
            color: #333;
          margin: 32px 0px;
        }
        .sub_header_text{
        font-size: 15px !important;
        font-weight:400;
        width:446px;
        margin: 0px auto;
        margin-bottom: 30px
        }

        .detials p {
            text-align: center;
            font-size: 0.9rem;
        }

        .detials h1 {
            text-align: center;
        }


        .order h3 {
            text-align: center;
            background-color: #eeeeee;
            padding: 20px;
        }

 

        .email-body p {
            color: #51545E;
        }

        .order-table {
            width: 100%;

        }

        .order-table td {
            border-bottom: 2px solid #eee;
            padding: 20px;
        }


        footer {
            margin-top: 20px;
            text-align: center;
            border-top: 1px solid #c0c0c0;
            padding: 0px 40px;
        }

        footer p {
            color: #c0c0c0;
            font-size: 0.8rem
        }
    </style>

    <div class="email-body">
            <img src="https://cdn.pixabay.com/photo/2018/03/28/04/02/logo-3268177_960_720.png" alt="logo" />
            <div class="detials">
                <h2 class="header_text">Verify your email address </h2>
                <p class="sub_header_text">Please confirm that you want to use this as your Bitcoin Agent account email address. once you’re done you can now trade on Bitcoin Agent</p>
                <a href="{{ route('customer.email.verification', $token) }}" class="btn">Verify Email</a>
                <p class="link_option">Or paste this link into your browser</p>
                <a href="{{ route('customer.email.verification', $token) }}" class="link">{{ route('customer.email.verification', $token) }}</a>
            </div>
        </div>
    
</body>
<footer>
    <p>24th January, 2020</p>
    <p>Have any question or help? contact us : 80808080808 </p>
</footer>

</html>