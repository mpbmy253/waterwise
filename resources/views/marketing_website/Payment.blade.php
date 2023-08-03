<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - Water Wise - </title>
    <link rel="stylesheet" href="{{ url('public/marketing_website/styles/Payment.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('public/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('public/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('public/vendors/styles/style.css') }}" />

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM Sans:wght@700&display=swap" />

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
	<div class="payment-page">
		<svg class="rectangle-top" width="2241" height="177" viewBox="0 0 2241 177" fill="none"
			xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd"
				d="M2240.13 133.18C2240.13 133.18 2128.32 58.5306 1843.14 58.978C1557.96 59.4254 1470.63 187.335 1150.68 174.066C830.738 160.797 662.774 90.3518 386.244 80.1747C0.068868 56.3418 0.0790527 64.0159 0.0790527 64.0159L-2.80325e-05 4.4286L2239.96 6.33125L2240.13 133.18Z"
				fill="url(#paint0_linear_13_527)" />
			<defs>
				<linearGradient id="paint0_linear_13_527" x1="938.535" y1="175.437" x2="938.258" y2="-1.5191"
					gradientUnits="userSpaceOnUse">
					<stop stop-color="#00A6FF" stop-opacity="0.7" />
					<stop offset="1" stop-color="#2353FF" stop-opacity="0" />
				</linearGradient>
			</defs>
		</svg>

        <form id="payment-form" method="post" action="{{ url('payment') }}">
            {{ @csrf_field() }}
            <div class="frame-3">
                <div class="payment">
                    <div class="content">
                        <div class="heading-and-supporting-text">
                            <div class="heading-and-subheading">
                                <div class="heading">Payment</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-holder-name-field">
                    <div class="input-field-base">
                        <div class="input-field-label">
                            <div class="label">
                                <span>
                                    <span class="label-span">Card Holder Name </span>
                                    <span style="color:red;">*</span></span>
                                </span>
                            </div>
                            <div class="text">
                                <input class="input-field" type="text" placeholder="Enter Card Name" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-number-field">
                    <div class="input-field-base">
                        <div class="input-field-label">
                            <div class="label">
                                <span>
                                    <span class="label-span3">Card Number </span>
                                    <span style="color:red;">*</span></span>
                                </span>
                            </div>
                            <div class="text">
                                <input class="input-field" type="number"  placeholder="Enter Card Number" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-expire-field">
                    <div class="month-field">
                        <div class="input-field-base">
                            <div class="input-field-label">
                                <div class="label">
                                    <span>
                                        <span class="label-span5">Card Expire </span>
                                        <span style="color:red;">*</span></span>
                                    </span>
                                </div>
                                <div class="text">
                                    <input class="input-field2" type="number" placeholder="Month" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="year-field">
                        <div class="input-field-base">
                            <div class="input-field-label">
                                <div class="text">
                                    <input class="input-field2" type="number"  placeholder="Year" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cvc-field">
                        <div class="input-field-base">
                            <div class="input-field-label">
                                <div class="label">
                                    <span>
                                        <span class="label-span7">CVC Number </span>
                                        <span style="color:red;">*</span></span>
                                    </span>
                                </div>
                                <div class="text">
                                    <input class="input-field3" type="number" placeholder="CVC" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cancel-button">
                    <button class="button" type="reset">
                        <div class="button-base">
                            <div class="text2">Cancel</div>
                        </div>
                    </button>
                </div>

                <div class="submit-button" type="submit">
                    <button class="button">
                        <div class="button-base">
                            <div class="text2">Submit</div>
                        </div>
                    </button>
                </div>
            </div>
        </form>

		<div class="water-drop">
			<div class="water-drop2">
				<svg class="inner-shadows" width="707" height="953" viewBox="0 0 707 953" fill="none"
					xmlns="http://www.w3.org/2000/svg">
					<g filter="url(#filter0_ii_13_568)">
						<path
							d="M353.415 952.14C565.565 952.14 706.829 824.718 706.829 633.82C706.829 539.781 667.051 446.213 636.962 383.677C582.395 270.361 488.559 145.76 409.512 32.9135C394.213 11.7548 374.324 0 353.415 0C333.016 0 312.616 11.7548 297.317 32.9135C218.27 145.76 124.435 270.361 69.867 383.677C40.2882 446.213 0 539.781 0 633.82C0 824.718 141.264 952.14 353.415 952.14Z"
							fill="#53C2F5" fill-opacity="0.01" />
					</g>
					<defs>
						<filter id="filter0_ii_13_568" x="-15.9732" y="0" width="738.775" height="958.53"
							filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
							<feFlood flood-opacity="0" result="BackgroundImageFix" />
							<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
							<feColorMatrix in="SourceAlpha" type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
							<feOffset dx="-15.9732" dy="6.38926" />
							<feGaussianBlur stdDeviation="19.9664" />
							<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1" />
							<feColorMatrix type="matrix"
								values="0 0 0 0 0.270588 0 0 0 0 0.643137 0 0 0 0 0.843137 0 0 0 0.7 0" />
							<feBlend mode="normal" in2="shape" result="effect1_innerShadow_13_568" />
							<feColorMatrix in="SourceAlpha" type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
							<feOffset dx="15.9732" dy="6.38926" />
							<feGaussianBlur stdDeviation="19.9664" />
							<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1" />
							<feColorMatrix type="matrix"
								values="0 0 0 0 0.270588 0 0 0 0 0.643137 0 0 0 0 0.843137 0 0 0 0.7 0" />
							<feBlend mode="normal" in2="effect1_innerShadow_13_568"
								result="effect2_innerShadow_13_568" />
						</filter>
					</defs>
				</svg>

				<svg class="drop" width="707" height="953" viewBox="0 0 707 953" fill="none"
					xmlns="http://www.w3.org/2000/svg">
					<g filter="url(#filter0_dii_13_569)">
						<path
							d="M353.585 953C565.736 953 707 825.578 707 634.68C707 540.641 667.222 447.073 637.133 384.537C582.565 271.22 488.729 146.619 409.683 33.7731C394.383 12.6144 374.494 0.859619 353.585 0.859619C333.186 0.859619 312.787 12.6144 297.488 33.7731C218.441 146.619 124.605 271.22 70.0376 384.537C40.4589 447.073 0.170654 540.641 0.170654 634.68C0.170654 825.578 141.435 953 353.585 953Z"
							fill="#50C0FF" />
					</g>
					<mask id="mask0_13_569" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="707"
						height="953">
						<path
							d="M353.585 953C565.736 953 707 825.578 707 634.68C707 540.641 667.222 447.073 637.133 384.537C582.565 271.22 488.729 146.619 409.683 33.7731C394.383 12.6144 374.494 0.859619 353.585 0.859619C333.186 0.859619 312.787 12.6144 297.488 33.7731C218.441 146.619 124.605 271.22 70.0376 384.537C40.4589 447.073 0.170654 540.641 0.170654 634.68C0.170654 825.578 141.435 953 353.585 953Z"
							fill="#38ADEF" />
					</mask>
					<g mask="url(#mask0_13_569)">
						<g style="mix-blend-mode:darken" filter="url(#filter1_f_13_569)">
							<path
								d="M353.585 854.502C565.736 854.502 707 773.948 707 653.265C707 593.816 667.222 534.663 637.133 495.129C582.565 423.492 488.729 344.722 409.683 273.382C394.383 260.006 374.494 252.575 353.585 252.575C333.186 252.575 312.787 260.006 297.488 273.382C218.441 344.722 124.605 423.492 70.0376 495.129C40.4589 534.663 0.170654 593.816 0.170654 653.265C0.170654 773.948 141.435 854.502 353.585 854.502Z"
								fill="#096FCE" />
						</g>
						<g filter="url(#filter2_f_13_569)">
							<path
								d="M352.399 618.109C452.068 618.109 597.892 613.117 597.892 465.164C597.892 392.281 527.825 319.762 513.689 271.295C488.054 183.47 415.89 39.4085 378.754 -48.0515C371.566 -64.4503 362.223 -73.5607 352.399 -73.5607C342.816 -73.5607 333.232 -64.4503 326.045 -48.0515C288.909 39.4085 219.117 183.47 193.481 271.295C179.585 319.762 99.791 392.281 99.791 465.164C99.791 613.117 252.731 618.109 352.399 618.109Z"
								fill="white" fill-opacity="0.88" />
						</g>
						<g filter="url(#filter3_ii_13_569)">
							<path
								d="M353.585 953C565.736 953 707 825.578 707 634.68C707 540.641 667.222 447.073 637.133 384.537C582.565 271.22 488.729 146.619 409.683 33.7731C394.383 12.6144 374.494 0.859619 353.585 0.859619C333.186 0.859619 312.787 12.6144 297.488 33.7731C218.441 146.619 124.605 271.22 70.0376 384.537C40.4589 447.073 0.170654 540.641 0.170654 634.68C0.170654 825.578 141.435 953 353.585 953Z"
								fill="#53C2F5" fill-opacity="0.01" />
						</g>
						<g filter="url(#filter4_f_13_569)">
							<path
								d="M-14.6787 750.423C-14.6787 789.822 177.446 952.89 356.525 952.89C537.265 952.89 721.799 795.294 721.799 750.423"
								stroke="#3395ED" stroke-opacity="0.28" stroke-width="63.8926" stroke-linecap="round" />
						</g>
					</g>
					<defs>
						<filter id="filter0_dii_13_569" x="-114.836" y="-82.2008" width="936.843" height="1209.31"
							filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
							<feFlood flood-opacity="0" result="BackgroundImageFix" />
							<feColorMatrix in="SourceAlpha" type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
							<feOffset dy="59.1007" />
							<feGaussianBlur stdDeviation="57.5034" />
							<feComposite in2="hardAlpha" operator="out" />
							<feColorMatrix type="matrix"
								values="0 0 0 0 0.329412 0 0 0 0 0.682353 0 0 0 0 0.968627 0 0 0 0.44 0" />
							<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13_569" />
							<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13_569" result="shape" />
							<feColorMatrix in="SourceAlpha" type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
							<feOffset dy="6.38926" />
							<feGaussianBlur stdDeviation="31.1477" />
							<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1" />
							<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
							<feBlend mode="normal" in2="shape" result="effect2_innerShadow_13_569" />
							<feColorMatrix in="SourceAlpha" type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
							<feOffset dy="-92.6443" />
							<feGaussianBlur stdDeviation="41.5302" />
							<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1" />
							<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.14 0" />
							<feBlend mode="normal" in2="effect2_innerShadow_13_569"
								result="effect3_innerShadow_13_569" />
						</filter>
						<filter id="filter1_f_13_569" x="-185.118" y="67.286" width="1077.41" height="972.505"
							filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
							<feFlood flood-opacity="0" result="BackgroundImageFix" />
							<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
							<feGaussianBlur stdDeviation="92.6443" result="effect1_foregroundBlur_13_569" />
						</filter>
						<filter id="filter2_f_13_569" x="-85.4976" y="-258.849" width="868.678" height="1062.25"
							filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
							<feFlood flood-opacity="0" result="BackgroundImageFix" />
							<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
							<feGaussianBlur stdDeviation="92.6443" result="effect1_foregroundBlur_13_569" />
						</filter>
						<filter id="filter3_ii_13_569" x="-15.8025" y="0.859619" width="738.776" height="958.53"
							filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
							<feFlood flood-opacity="0" result="BackgroundImageFix" />
							<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
							<feColorMatrix in="SourceAlpha" type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
							<feOffset dx="-15.9732" dy="6.38926" />
							<feGaussianBlur stdDeviation="19.9664" />
							<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1" />
							<feColorMatrix type="matrix"
								values="0 0 0 0 0.270588 0 0 0 0 0.643137 0 0 0 0 0.843137 0 0 0 0.7 0" />
							<feBlend mode="normal" in2="shape" result="effect1_innerShadow_13_569" />
							<feColorMatrix in="SourceAlpha" type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
							<feOffset dx="15.9732" dy="6.38926" />
							<feGaussianBlur stdDeviation="19.9664" />
							<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1" />
							<feColorMatrix type="matrix"
								values="0 0 0 0 0.270588 0 0 0 0 0.643137 0 0 0 0 0.843137 0 0 0 0.7 0" />
							<feBlend mode="normal" in2="effect1_innerShadow_13_569"
								result="effect2_innerShadow_13_569" />
						</filter>
						<filter id="filter4_f_13_569" x="-59.4035" y="705.699" width="825.928" height="291.916"
							filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
							<feFlood flood-opacity="0" result="BackgroundImageFix" />
							<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
							<feGaussianBlur stdDeviation="6.38926" result="effect1_foregroundBlur_13_569" />
						</filter>
					</defs>
				</svg>
			</div>
		</div>
	</div>

    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#payment-form').submit(function(event) {
                // Prevent the form from submitting immediately
                event.preventDefault();
                $('#payment-form').off('submit').submit();
            });

            // Handle cancel button click
            $('button[type="reset"]').click(function() {
                // Go back to the previous page
                window.history.back();
            });
        });
    </script>

</body>

</html>
