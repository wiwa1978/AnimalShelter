<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Server Error Page</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">
    <style type="text/css">
        body {
          padding: 0;
          margin: 0;
        }
          /* 
          '#B4123C
          '#BE123C    
          '#312E81 
          '#BC3E25   
          */
        #notfound {
          position: relative;
          height: 100vh;
        }

        #notfound .notfound-bg {
          position: absolute;
          width: 100%;
          height: 100%;
          background-size: cover;
        }

        #notfound .notfound-bg:after {
          content: '';
          position: absolute;
          width: 100%;
          height: 100%;
          background-color: #B4123C; 

        }

        #notfound .notfound {
          position: absolute;
          left: 50%;
          top: 50%;
          -webkit-transform: translate(-50%, -50%);
              -ms-transform: translate(-50%, -50%);
                  transform: translate(-50%, -50%);
        }

        .notfound {
          max-width: 910px;
          width: 100%;
          line-height: 1.4;
          text-align: center;
        }

        .notfound .notfound-404 {
          position: relative;
          height: 150px;
        }

        .notfound .notfound-404 h1 {
          font-family: 'Montserrat', sans-serif;
          position: absolute;
          left: 50%;
          top: 50%;
          -webkit-transform: translate(-50%, -50%);
              -ms-transform: translate(-50%, -50%);
                  transform: translate(-50%, -50%);
          font-size: 100px;
          font-weight: 900;
          margin: 0px;
          color: #fff;
          text-transform: uppercase;
          letter-spacing: 10px;
        }

        .notfound h2 {
          font-family: 'Montserrat', sans-serif;
          font-size: 28px;
          font-weight: 700;
          text-transform: uppercase;
          color: #fff;
          margin-top: 20px;
          margin-bottom: 30px;
        }

        .notfound .home-btn, .notfound .contact-btn {
          font-family: 'Montserrat', sans-serif;
          display: inline-block;
          font-weight: 700;
          text-decoration: none;
          background-color: transparent;
          border: 2px solid transparent;
          text-transform: uppercase;
          padding: 13px 25px;
          font-size: 18px;
          border-radius: 40px;
          margin: 7px;
          -webkit-transition: 0.2s all;
          transition: 0.2s all;
        }

        .notfound .home-btn:hover, .notfound .contact-btn:hover {
          opacity: 0.9;
        }

        .notfound .home-btn {
          color: rgba(49, 46, 129, 0.7);
          background: #fff;
        }

        .notfound .contact-btn {
          border: 2px solid rgba(255, 255, 255, 0.9);
          color: rgba(49, 46, 129, 0.9);
          background: #fff;
        }

        @media only screen and (max-width: 767px) {
          .notfound .notfound-404 h1 {
            font-size: 182px;
          }
        }

        @media only screen and (max-width: 480px) {
          .notfound .notfound-404 {
            height: 146px;
          }
          .notfound .notfound-404 h1 {
            font-size: 146px;
          }
          .notfound h2 {
            font-size: 16px;
          }
          .notfound .home-btn, .notfound .contact-btn {
            font-size: 14px;
          }
          #notfound img#logo  {
                width: 20px; /* Adjust the width as needed */
                height: auto; /* This will maintain the aspect ratio */
            }
  
        }

    </style>
</head>
<body>


    <div id="notfound">
    <div class="notfound-bg"></div>
    <div class="notfound">
   
    <img src="{{ asset('storage/images/icon_logo.svg') }}" alt="Description" width="400" height="400">


        <div class="notfound-404">
            <h1>@yield('code')<h1>
        </div>
        <div class="notfound-404">
            <h2>@yield('title') - @yield('message')</h2>
        </div>
        
        <a href="/" class="home-btn">Go Home</a>
        <a href="support" class="contact-btn">Contact us</a>
    </div>
</div>

</body>
</html>