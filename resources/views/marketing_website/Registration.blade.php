<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - Water Wise - </title>
    <link rel="stylesheet" href="{{ url('marketing_website/styles/Registration.css') }}" />
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
    <style>

        </style>
</head>

<body>
    <div class="register-page">
        <div class="register">
            <div class="content2">
                <div class="heading-and-supporting-text">
                    <div class="heading-and-subheading">
                        <div class="heading">Registration</div>
                    </div>
                </div>
            </div>
        </div>
        @include('message_alert')

        <form method="post" action="{{ url('register') }}">
            {{ @csrf_field() }}
            <div class="fname-field">
                <div class="input-field-base">
                    <div class="input-field-label">
                        <div class="label">
                            <span>
                                <span class="label-span15">First Name </span>
                                <span style="color:red;">*</span></span>
                            </span>
                        </div>
                        <div class="text">
                            <input class="input-field" type="text" name="firstname" value="{{ old('firstname') }}" required placeholder="Enter your First Name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="lname-field">
                <div class="input-field-base">
                    <div class="input-field-label">
                        <div class="label">
                            <span>
                                <span class="label-span13">Last Name </span>
                                <span style="color:red;">*</span></span>
                            </span>
                        </div>
                        <div class="text">
                            <input class="input-field" type="text" name="lastname" value="{{ old('lastname') }}" required placeholder="Enter your Last Name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="email-field">
                <div class="input-field-base">
                    <div class="input-field-label">
                        <div class="label">
                            <span>
                                <span class="label-span11">Email Address </span>
                                <span style="color:red;">*</span></span>
                            </span>
                        </div>
                        <div class="text">
                            <input class="input-field" type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your Email Address">
                        </div>
                        <div style="color:red; font-size: 1.5rem;"> {{ $errors->first('email') }} </div>
                    </div>
                </div>
            </div>

            <div class="mobile-field">
                <div class="input-field-base">
                    <div class="input-field-label">
                        <div class="label">
                            <span>
                                <span class="label-span9">Mobile Number </span>
                                <span style="color:red;">*</span></span>
                            </span>
                        </div>
                        <div class="text">
                            <input class="input-field" type="number" name="mobile" value="{{ old('mobile') }}" required placeholder="Enter your Mobile Numnber">
                        </div>
                        <div style="color:red; font-size: 1.5rem;"> {{ $errors->first('mobile') }} </div>
                    </div>
                </div>
            </div>

            <div class="gender-field">
                <div class="input-field-base">
                    <div class="input-field-label">
                        <div class="label">
                            <span>
                                <span class="label-span5">Gender </span>
                                <span style="color:red;">*</span>
                            </span>
                        </div>
                        <div class="dropdown">
                            <select class="input-field" name="gender" required>
                                <option value="" disabled selected>Select your gender</option>
                                <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="compnay-name-field">
                <div class="input-field-base">
                    <div class="input-field-label">
                        <div class="label">
                            <span>
                                <span class="label-span7">Company Name </span>
                                <span style="color:red;">*</span></span>
                            </span>
                        </div>
                        <div class="text">
                            <input class="input-field" type="text" name="company_name" value="{{ old('company_name') }}" required placeholder="Enter your Company Name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="company-uen-field">
                <div class="input-field-base">
                    <div class="input-field-label">
                        <div class="label">
                            <span>
                                <span class="label-span3">Company UEN </span>
                                <span style="color:red;">*</span></span>
                            </span>
                        </div>
                        <div class="text">
                            <input class="input-field" type="text" name="company_uen" value="{{ old('company_uen') }}" required placeholder="Enter your Company UEN">
                        </div>
                    </div>
                </div>
            </div>

            <div class="register-type-field">
                <div class="input-field-base">
                    <div class="input-with-label">
                        <div class="label">
                            <span>
                                <span class="label-span">Registration Type </span>
                                <span style="color:red;">*</span>
                            </span>
                        </div>
                        <div class="radio-buttons">
                            <label>
                                <input type="radio" id="register-company" name="registration_type" value="Company" required/>Company
                            </label>
                        </div>
                        <div class="radio-buttons">
                            <label>
                                <input type="radio" id="register-company" name="registration_type" value="Seller" required/>Seller
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="register-button">
                <button class="button">
                    <div class="button-base">
                        <div class="text">Register</div>
                    </div>
                </button>
            </div>
        </form>

        <div class="already-have-account">
            <div class="already-have-an-account">Already have an account ?</div>
            <a href="{{url('/login')}}" class="login">Login</a>
        </div>

        <svg class="rectangle-left" width="265" height="1373" viewBox="0 0 265 1373" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M197.476 0.568237C197.476 0.568237 86.5696 69.456 87.4556 243.996C88.3416 418.536 278.592 471.204 259.111 667.105C239.63 863.005 135.018 966.238 120.1 1135.55C84.9627 1372.05 96.373 1372 96.373 1372L7.7751 1372.41L8.87 1.44729L197.476 0.568237Z"
                fill="url(#paint0_linear_21_342)" />
            <defs>
                <linearGradient id="paint0_linear_21_342" x1="261.314" y1="796.939" x2="-1.79423"
                    y2="798.275" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#00A6FF" stop-opacity="0.7" />
                    <stop offset="1" stop-color="#2353FF" stop-opacity="0" />
                </linearGradient>
            </defs>
        </svg>

        <svg class="rectangle-right" width="265" height="1373" viewBox="0 0 265 1373" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M63.1239 1371.95C63.1239 1371.95 176.982 1303.45 176.757 1128.91C176.533 954.376 -18.1112 901.053 2.60775 705.228C23.3267 509.404 130.873 406.537 146.814 237.286C183.727 0.916115 172.04 0.929776 172.04 0.929776L262.782 0.822757L256.294 1371.72L63.1239 1371.95Z"
                fill="url(#paint0_linear_21_343)" />
            <defs>
                <linearGradient id="paint0_linear_21_343" x1="0.859981" y1="575.392" x2="270.335"
                    y2="575.046" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#00A6FF" stop-opacity="0.7" />
                    <stop offset="1" stop-color="#2353FF" stop-opacity="0" />
                </linearGradient>
            </defs>
        </svg>
    </div>

</body>

</html>
