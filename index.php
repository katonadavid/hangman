<?php 
// session_save_path('sess/');
// session_start();
// echo $_COOKIE['PHPSESSID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/app.js" defer></script>
    <title>Hangman v0.1</title>
</head>
<body class="d-flex flex-column">

    <header class="w-100 d-flex justify-content-center py-3">
        <img id="logo" src="img/logo.svg" alt="">
    </header>
    <main class="d-flex flex-column flex-fill">
        <section class="d-flex justify-content-center align-items-center h-75 px-3" id="middle">
            <div id="middle-left" class="h-100 flex-fill d-flex align-items-center">
                <div id="past-letters" class="p-3 font-weight-bold">
                </div>
            </div>
            <div id="middle-right" class="h-100 flex-fill d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 934.1 1122" id="man">
                    <defs>
                    <clipPath id="clip-path" transform="translate(1 1.5)">
                        <path id="mouth-2" d="M693,361c.9-5.6,3.5-10.1,7.3-14.3s7.8-8.4,12.6-10.5c10.6-4.6,20.8,6.7,23.1,16,1.1,4.4,1.9,12-1.3,15.8s-11.4,6.8-16.4,7.3c-9.8.8-19.3-6-22.2-15.3-2.2-7.3-13.8-4.2-11.5,3.2,4.4,14.6,18.9,25.3,34.4,24,8.2-.7,18.3-4.7,24.2-10.7s6.3-16.3,5-24.3c-2.6-15.8-16.9-31.1-34-28.7-8.3,1.2-15.1,7.2-20.7,13s-10.8,13-12.1,21.4,10.4,10.8,11.6,3.1Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-2" transform="translate(1 1.5)">
                        <path id="head1" d="M723.9,216.6c-36.3-22.1-84-7.9-106.9,26.4-23.9,35.9-18.9,83.2,5.7,117.3a134.3,134.3,0,0,0,49.2,41.5c19.7,9.7,44,16.7,66.2,13.9s38-21.1,47.5-39.5a102.4,102.4,0,0,0,10.6-59.6c-6.1-48.2-47.4-80.1-89-98.7-7-3.1-13.1,7.3-6.1,10.4,32.5,14.5,66.4,36.8,78.9,71.9,11.9,33,2.1,77.4-28.1,97.8-16.7,11.4-41.3,5.6-59.1-.5a124.7,124.7,0,0,1-49.7-31.3c-25.9-27-37.8-66.3-23.7-102,7.4-18.6,21.9-34.5,40.8-41.6s40.2-6.2,57.6,4.4c6.6,4,12.7-6.4,6.1-10.4Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-3" transform="translate(1 1.5)">
                        <circle id="eye1" cx="651" cy="270" r="8.5" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-4" transform="translate(1 1.5)">
                        <circle id="eye2" cx="711.3" cy="269.8" r="8.5" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-5" transform="translate(1 1.5)">
                        <path id="mouth" d="M689.6,362.3a436.1,436.1,0,0,1,51.1-1.5c7.7.3,7.7-11.7,0-12a436.1,436.1,0,0,0-51.1,1.5c-7.6.7-7.7,12.7,0,12Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-6" transform="translate(1 1.5)">
                        <path id="body" d="M720,419.4a2704.8,2704.8,0,0,0,11.7,304.1c1,9.8,13,9.9,12,0A2704.8,2704.8,0,0,1,732,419.4c.2-9.9-11.8-9.9-12,0Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-7" transform="translate(1 1.5)">
                        <path id="left-arm" d="M725.4,478.6c-32.4-4.8-63.1-16.3-92.4-30.8-13.8-6.8-27.6-13.9-40.8-22-11.5-7-23.2-15.7-28.5-28.6-2.9-7-14.5-3.9-11.6,3.2,5.7,13.8,16,23.8,28.2,32.1,13.7,9.2,28.7,16.7,43.5,24.1,31.1,15.6,63.8,28.5,98.4,33.5,7.6,1.1,10.8-10.4,3.2-11.5Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-8" transform="translate(1 1.5)">
                        <path id="right-arm" d="M730.8,489.6a332.4,332.4,0,0,0,177-86.9c5.6-5.4-2.9-13.8-8.5-8.5A322.1,322.1,0,0,1,727.6,478c-7.6,1.2-4.3,12.7,3.2,11.6Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-9" transform="translate(1 1.5)">
                        <path id="left-leg" d="M728.1,713.8q-41.7,26.6-83.8,52.2c-25,15.2-51.4,29.2-74.5,47.3-11.9,9.3-22.5,20.1-30.8,32.9-4.2,6.5,6.2,12.5,10.4,6,18.8-29,51-45.7,79.8-63.1q52.9-31.8,104.9-64.9c6.5-4.2.5-14.6-6-10.4Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-10" transform="translate(1 1.5)">
                        <path id="right-leg" d="M736.3,727.7,852,857.3c5.2,5.7,13.6-2.8,8.5-8.5L744.7,719.2c-5.1-5.7-13.6,2.8-8.4,8.5Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-11" transform="translate(1 1.5)">
                        <path id="ground" d="M21.8,1115.2l320.8-3.7,91.7-1.1c7.7-.1,7.8-12.1,0-12l-320.9,3.7-91.6,1.1c-7.7.1-7.8,12.1,0,12Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-12" transform="translate(1 1.5)">
                        <path id="wood1" d="M81,1101.9q-3-203.1,1.4-406.2C85.3,560.4,91.1,425.1,98.8,290c4.3-75.6,8.1-151.3,3.7-226.9-.5-7.7-12.5-7.8-12,0,3.9,67.3,1.3,134.8-2.3,202.1S80.6,400.3,77.7,467.8q-8.5,203-9.8,406.2c-.4,75.9,0,152,1.1,227.9.1,7.8,12.1,7.8,12,0Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-13" transform="translate(1 1.5)">
                        <path id="wood2" d="M94.6,70.3Q212.4,58.9,330.2,50.7t235-13.2q66.4-2.8,132.9-4.7c6.5-.2,6.6-12.2,0-12q-118.1,3.3-236,9.7t-235,16Q160.8,51.9,94.6,58.3c-6.5.6-6.5,12.6,0,12Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-14" transform="translate(1 1.5)">
                        <path id="wood3" d="M373.2,38.4,153.5,245.1l-62,58.3c-4.6,4.4,2.6,11.2,7.3,6.8L318.5,103.5l62-58.3c4.7-4.4-2.6-11.2-7.3-6.8Z" fill="none"/>
                    </clipPath>
                    <clipPath id="clip-path-15" transform="translate(1 1.5)">
                        <path id="wood4" d="M690.5,31.7q1.1,86.4.3,172.9c0,7.7,12,7.7,12,0q.8-86.4-.3-172.9c-.1-7.7-12.1-7.7-12,0Z" fill="none"/>
                    </clipPath>
                    </defs>
                    <title>man</title>
                    <g id="man">
                    <g id="mouth-2-grp">
                        <g clip-path="url(#clip-path)">
                        <path id="mouth-2-path" d="M681,371s10-37,34-42,29.6,27.3,28.8,31.1S740,380,725,381s-22,5-30-7a88.1,88.1,0,0,1-11.1-24.1" transform="translate(1 1.5)" fill="none" stroke="#482f2f" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="head1-grp">
                        <g clip-path="url(#clip-path-2)">
                        <path id="head1-path" d="M690,222s57,5,91,67-15,110-23,113-34,29-103-17-47-122-36-138,38-54,114-23" transform="translate(1 1.5)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="eye1-grp">
                        <g clip-path="url(#clip-path-3)">
                        <path id="eye1-path" d="M648,256l5,29" transform="translate(1 1.5)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="eye2-grp">
                        <g clip-path="url(#clip-path-4)">
                        <path id="eye2-path" d="M708.3,255.8l5,29" transform="translate(1 1.5)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="mouth-grp">
                        <g clip-path="url(#clip-path-5)">
                        <line id="mouth-path" x1="675" y1="359.5" x2="755" y2="356.5" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="body-grp">
                        <g clip-path="url(#clip-path-6)">
                        <path id="body-path" d="M727,392V533c0,54,13,219,13,219" transform="translate(1 1.5)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="left-arm-grp">
                        <g clip-path="url(#clip-path-7)">
                        <path id="left-arm-path" d="M744,480s-49,11-122-29-68-59-73-79" transform="translate(1 1.5)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="right-arm-grp">
                        <g clip-path="url(#clip-path-8)">
                        <path id="right-arm-path" d="M704.4,486.8S781,479,838,447s85-70,85-70" transform="translate(1 1.5)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="left-leg-grp">
                        <g clip-path="url(#clip-path-9)">
                        <path id="left-leg-path" d="M742.7,712.8S634,774,602,797s-64,48-64,62" transform="translate(1 1.5)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="right-leg-grp">
                        <g clip-path="url(#clip-path-10)">
                        <line id="right-leg-path" x1="732.2" y1="718.8" x2="872" y2="869.5" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    </g>
                    <g id="scaffold">
                    <g id="ground-grp">
                        <g clip-path="url(#clip-path-11)">
                        <line id="ground-path" x1="472" y1="1108.5" y2="1109.5" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="wood1-grp">
                        <g clip-path="url(#clip-path-12)">
                        <path id="wood1-path" d="M75,1119s-1-210-1-261,3-275,5-292S91,346,91,340s8-166,8-193S95,40,95,40" transform="translate(1 1.5)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="wood2-grp">
                        <g clip-path="url(#clip-path-13)">
                        <path id="wood2-path" d="M60,66S361,40,392,39,735,24,735,24" transform="translate(1 1.5)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="wood3-grp">
                        <g clip-path="url(#clip-path-14)">
                        <line id="wood3-path" x1="397" y1="27.5" x2="59" y2="342.5" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    <g id="wood4-grp">
                        <g clip-path="url(#clip-path-15)">
                        <line id="wood4-path" x1="697.5" x2="697.5" y2="252" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                    </g>
                    </g>
                </svg>
            </div>
              
                    
        </section>
        <!-- END OF MAN -->
        <section class="d-flex flex-fill flex-column justify-content-around align-items-center">
            <div id="letter-list" class="d-flex"></div>
            <input type="text" name="letterinput" id="letterinput" class="text-center" size="2" maxlength="1">
        </section>
    </main>
</body>

<!-- Word and letter templates -->
<template id="tmp-word">
        <div class="word d-flex mx-3"></div>
</template>
<template id="tmp-letter">
    <div class="letter-frame position-relative d-flex align-items-end justify-content-center m-1">
                    <span class="letter text-uppercase"></span>
    </div>
</template>
</html>