<!DOCTYPE html>
<html>

<head>
    <title>Kilimo Awards</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        .container {
            max-width: 600px;
            margin: auto;
        }

        .header {
            max-width: 600px;
            margin: auto;
            text-align: center;
        }

        .nomi {
            max-width: 600px;
            margin: auto;
            background-color: #006837;
        }

        .conn {
            max-width: 600px;
            background-color: #004425;
            padding: 5px;
            text-align: center;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.7em;
        }

        .aza {
            max-width: 600px;
            display: flex;
            padding: 10px;
            padding-bottom: 30px;
            background-color: #006837;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8em;
        }

        .conrats {
            max-width: 250px;
            padding-left: 30px;


        }

        .abut {
            max-width: 100%;
            padding-left: 30px;
        }

        a {
            text-decoration: none;
            color: #ffffff;
            font-weight: 700;
        }

        .promo {
            max-width: 600px;
        }

        .footer {
            max-width: 600px;
            padding: 30px;
            background-color: #1b1b1b;
            color: #ffffff;
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.7em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img width="200" src="https://mkulimaawards.co.tz/web/images/logo.jpg">
        </div>
        <div class="conn">
            <p><a href="https://mkulimaawards.co.tz">Home | </a><a
                    href="https://mkulimaawards.co.tz/awards/categories">Categories
                    | </a><a href="https://mkulimaawards.co.tz/about-us">About Us | </a><a
                    href="https://mkulimaawards.co.tz/contact-us">Contact Us</a></p>
            </ul>
        </div>

        <div class="aza">
            <div class="abut">
                <p>Dear {{ $data['name'] }},</p>

                <p>We are thrilled to inform you that your entity has been selected as a nominee for the prestigious
                    Mkulima Awards in the category of <strong
                        style="text-transform: uppercase">{{ $data['category'] }}</strong>. Congratulations on this
                    well-deserved
                    recognition!</p>

                <p>The Mkulima Awards aim to celebrate and honor outstanding achievements in the agricultural sector,
                    recognizing individuals and organizations that have made significant contributions to the
                    advancement of agriculture in Tanzania. With a total of {{ $data['total_category'] }} categories
                    covering various aspects of the agricultural industry, the awards seek to highlight excellence and
                    innovation across the sector.</p>

                <p>The awards ceremony will take place In Morogoro, on 4<sup>th</sup> May, 2024, bringing together
                    industry leaders, policymakers, and stakeholders to celebrate the achievements of the nominees and
                    showcase the latest trends and developments in agriculture.</p>

                <p>Voting for the Mkulima Awards will begin on 16<sup>th</sup> March and continue until 24<sup>th</sup>
                    April 2024 allowing members
                    of the agricultural community and the general public to participate in selecting the winners across
                    different categories.</p>

                <p>To confirm your participation and provide additional details for the awards ceremony, please click on
                    the following link: <a href="{{ $data['confimation_link'] }}">Confirm Your Participation</a></p>

                <p>We kindly ask that you complete the confirmation process by 30<sup>th</sup> March, 2024 to secure
                    your spot as a nominee.</p>

                <p>We look forward to celebrating your achievements at the Mkulima Awards ceremony and showcasing your
                    contributions to the agricultural community.</p>

                <p>If you have any questions or require further assistance, please don't hesitate to contact us at
                    info@mkulimaawards.co.tz</p>

                <p>Once again, congratulations on your nomination, and we wish you the best of luck in the upcoming
                    awards!</p>
            </div>
        </div>

        <div class="footer">
            <div class="linki">
                <h4><a href="https://mkulimaawards.co.tz/">www.mkulimaawards.co.tz</a></h4>
                <p>Korogwe Road, Block No 10 (Halotel Building), First Floor P.O Box 2380 Morogoro, Tanzania<br>+255 754
                    222 800</p>
            </div>
            <div class="infoh">

            </div>
        </div>
    </div>
</body>

</html>
