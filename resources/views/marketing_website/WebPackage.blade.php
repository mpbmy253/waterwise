<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> - Water Wise - </title>
    <link rel="stylesheet" href="{{ url('marketing_website/styles/WebPackage.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/style.css') }}" />

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM Sans:wght@700&display=swap" />

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>

<body>
	<div class="web-package-page">
		<div class="top">
			<svg class="gradient-bg" width="2240" height="300" viewBox="0 0 2240 300" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<path d="M0 0H1088.07H2240V280.087C1034.33 126.443 905.357 375.007 0 275.885V0Z"
					fill="url(#paint0_linear_74_231)" />
				<defs>
					<linearGradient id="paint0_linear_74_231" x1="1085.54" y1="-3.30172" x2="1085.54" y2="616.493"
						gradientUnits="userSpaceOnUse">
						<stop offset="0.182292" stop-color="#4A6964" />
						<stop offset="0.651042" stop-color="#A0BFBA" />
					</linearGradient>
				</defs>
			</svg>

			<img class="logo" alt="" src="{{ url('marketing_website/img/logo@2x.png') }}"/>

			<button class="login">
                <a class="login2" href="{{url('/login')}}">Login</a>
            </button>

			<div class="menu">
                <a class="home" href="{{url('/')}}">Home</a>
			    <a class="about-us" href="{{url('/aboutus')}}">About us</a>
			    <a class="contact-us2" href="{{url('/contactus')}}">Contact Us</a>
			</div>
		</div>

        <div class="package-plan">Package Plan</div>
		<div class="web-only-package">Web-only package</div>

        <div class="buttton-web-a">
			<div class="button-content">
                <button class="rectangle-background">
                    <a href="{{url('/register')}}">
                        <div class="package-content3">
                            <div class="_1-month">1 month</div>
                            <div class="no-mobile-app-unable-to-upgrade-to-package-b">
                                No mobile app<br />Unable to upgrade to Package B
                            </div>
                        </div>
                        <div class="line-113"></div>
                        <div class="pricing3">
                            <div class="_128">$128</div>
                            <div class="month3">/month</div>
                        </div>
                    </a>
                </button>
			</div>
		</div>

        <div class="button-web-b">
			<div class="button-content">
				<button class="rectangle-background2">
                    <a href="{{url('/register')}}">
                        <div class="package-content2">
                            <div class="_6-months">6 months</div>
                            <div class="no-mobile-app-unable-to-upgrade-to-package-b2">
                                No mobile app<br />Unable to upgrade to Package B
                            </div>
                        </div>
                        <div class="line-112"></div>
                        <div class="pricing2">
                            <div class="save-10">save 10%</div>
                            <div class="_691">$691</div>
                            <div class="month2">/month</div>
                        </div>
                    </a>
                </button>
			</div>
		</div>

		<div class="button-web-c">
			<div class="button-content">
                <button class="rectangle-background">
                    <a href="{{url('/register')}}">
                        <div class="package-content">
                            <div class="_12-months-1-month-free">12 months + 1 month free</div>
                            <div class="no-mobile-app-unable-to-upgrade-to-package-b">
                                No mobile app<br />Unable to upgrade to Package B
                            </div>
                        </div>
                        <div class="line-11"></div>
                        <div class="pricing">
                            <div class="save-15">save 15%</div>
                            <div class="_1305">$1305</div>
                            <div class="month">/month</div>
                        </div>
                    </a>
                </button>
			</div>
		</div>

	</div>

    <div class="footer">
        <div class="group-232">
            <div class="group-231">
                <div class="support">Support</div>
                <div class="help-centre">Help centre</div>
                <div class="account-information">Account information</div>
                <div class="about">About</div>

                <div class="contact-us">Contact us</div>
            </div>

            <div class="group-230">
                <div class="talk-to-support">Talk to support</div>
                <div class="support-docs">Support docs</div>
                <div class="system-status">System status</div>
                <div class="covid-responde">Covid responde</div>
                <div class="help-and-solution">Help and Solution</div>
            </div>

            <div class="group-229">
                <div class="update">Update</div>
                <div class="security">Security</div>
                <div class="beta-test">Beta test</div>
                <div class="pricing-product">Pricing product</div>
                <div class="product">Product</div>
            </div>
        </div>

        <div class="_2023-water-wise-copyright-and-rights-reserved">
            © 2023 Water Wise. Copyright and rights reserved
        </div>

        <div class="group-234">
            <div class="terms-and-condtions">Terms and Condtions</div>
            <div class="ellipse-61"></div>
            <div class="privacy-policy">Privacy Policy</div>
        </div>

        <div class="facebook">
            <img class="facebook2" alt="" src="{{ url('marketing_website/img/facebook@2x.png') }}"/>
        </div>

        <div class="instagram">
            <img class="instagram2" alt="" src="{{ url('marketing_website/img/instagram@2x.png') }}"/>
        </div>

        <div class="linked-in">
            <img class="linked-in2" alt="" src="{{ url('marketing_website/img/linkedin@2x.png') }}" />
        </div>

        <div class="twitter-variant-05">
            <img class="twitter" alt="" src="{{ url('marketing_website/img/twitter@2x.png') }}" />
        </div>
    </div>
</body>

</html>
