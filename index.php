<?php 
session_save_path('sess/');
session_start();

if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), "", time()-3600, "/");
}

$_SESSION = [];
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js" defer></script>
    <script src="js/app.js" defer></script>
    <title>Hangman v0.1</title>
</head>
<body class="d-flex flex-column">

    <header class="position-relative w-100 d-flex justify-content-center py-3">
        <img id="logo" src="img/logo.svg" alt="">
        <div id="settings">
        <div class="d-flex justify-content-center align-items-center h-100 p-1">
            <img src="img/gear.svg">
        </div>
        <div class="flex-column align-items-center">
            <div class="d-flex align-items-center">
                <img src="img/globe.svg">
                <select name="language" id="language">
                    <option value="en">en</option>
                    <option value="de">de</option>
                    <option value="hu">hu</option>
                </select>
            </div>
            <div class="d-flex align-items-center">
                <img src="img/difficulty.svg">
            </div>
        </div>
        </div>
    </header>
    <main class="d-flex flex-column flex-fill">
        <section class="px-3">
            <div class="h-100 flex-fill d-flex align-items-center justify-content-center">
                <svg class="h-100 pb-1" id="man" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 934.1 1122" id="man">
                    <defs>
                        <clipPath id="clip-path" transform="translate(0)">
                        <path d="M694,362.5c.9-5.6,3.5-10.1,7.3-14.3s7.8-8.4,12.6-10.5c10.6-4.6,20.8,6.7,23.1,16,1.1,4.4,1.9,12-1.3,15.8s-11.4,6.8-16.4,7.3c-9.8.8-19.3-6-22.2-15.3-2.2-7.3-13.8-4.2-11.5,3.2,4.4,14.6,18.9,25.3,34.4,24,8.2-.7,18.3-4.7,24.2-10.7s6.3-16.3,5-24.3c-2.6-15.8-16.9-31.1-34-28.7-8.3,1.2-15.1,7.2-20.7,13s-10.8,13-12.1,21.4,10.4,10.8,11.6,3.1Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-2" transform="translate(0)">
                        <path d="M724.9,218.1c-36.3-22.1-84-7.9-106.9,26.4-23.9,35.9-18.9,83.2,5.7,117.3a134.3,134.3,0,0,0,49.2,41.5c19.7,9.7,44,16.7,66.2,13.9s38-21.1,47.5-39.5a101.6,101.6,0,0,0,10.6-59.6c-6.1-48.2-47.4-80.1-89-98.7-7-3.1-13.1,7.3-6.1,10.4,32.5,14.5,66.4,36.8,78.9,71.9,11.9,33,2.1,77.4-28.1,97.8-16.7,11.4-41.3,5.6-59.1-.5a124.7,124.7,0,0,1-49.7-31.3c-25.9-27-37.8-66.3-23.7-102,7.4-18.6,21.9-34.5,40.8-41.6s40.2-6.2,57.6,4.4C725.4,232.5,731.5,222.1,724.9,218.1Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-3" transform="translate(0)">
                        <circle cx="652" cy="271.5" r="8.5" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-4" transform="translate(0)">
                        <circle cx="712.3" cy="271.3" r="8.5" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-5" transform="translate(0)">
                        <path d="M690.6,363.8a436.1,436.1,0,0,1,51.1-1.5c7.7.3,7.7-11.7,0-12a436.1,436.1,0,0,0-51.1,1.5C683,352.5,682.9,364.5,690.6,363.8Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-6" transform="translate(0)">
                        <path d="M721,420.9A2708.5,2708.5,0,0,0,732.7,725c1,9.8,13,9.9,12,0A2708.5,2708.5,0,0,1,733,420.9C733.2,411,721.2,411,721,420.9Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-7" transform="translate(0)">
                        <path d="M726.4,480.1c-32.4-4.8-63.1-16.3-92.4-30.8-13.8-6.8-27.6-13.9-40.8-22-11.5-7-23.2-15.7-28.5-28.6-2.9-7-14.5-3.9-11.6,3.2,5.7,13.8,16,23.8,28.2,32.1,13.7,9.2,28.7,16.7,43.5,24.1,31.1,15.6,63.8,28.5,98.4,33.5,7.6,1.1,10.8-10.4,3.2-11.5Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-8" transform="translate(0)">
                        <path d="M731.8,491.1a332.7,332.7,0,0,0,177-86.9c5.6-5.4-2.9-13.8-8.5-8.5a321.4,321.4,0,0,1-171.7,83.8C721,480.7,724.3,492.2,731.8,491.1Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-9" transform="translate(0)">
                        <path d="M729.1,715.3q-41.7,26.6-83.8,52.2c-25,15.2-51.4,29.2-74.5,47.3-11.9,9.3-22.5,20.1-30.8,32.9-4.2,6.5,6.2,12.5,10.4,6,18.8-29,51-45.7,79.8-63.1q52.9-31.8,104.9-64.9c6.5-4.2.5-14.6-6-10.4Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-10" transform="translate(0)">
                        <path d="M737.3,729.2,853,858.8c5.2,5.7,13.6-2.8,8.5-8.5L745.7,720.7C740.6,715,732.1,723.5,737.3,729.2Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-11" transform="translate(0)">
                        <path d="M672.1,253.6a74.2,74.2,0,0,0-38.3,33.9c-3.6,6.7,6.3,13.4,10,6.6a64.1,64.1,0,0,1,33.8-29.8c7.1-2.8,1.7-13.4-5.5-10.7Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-12" transform="translate(0)">
                        <path d="M638.1,254.8a74.7,74.7,0,0,1,36.3,36c3.2,7-7.1,13.1-10.4,6.1a63.6,63.6,0,0,0-31.9-31.7c-7.1-3.2-1-13.6,6-10.4Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-13" transform="translate(0)">
                        <path d="M698.8,251.6a74.2,74.2,0,0,1,38.3,33.9c3.6,6.7-6.4,13.4-10,6.6a64.1,64.1,0,0,0-33.8-29.8c-7.2-2.8-1.7-13.4,5.5-10.7Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-14" transform="translate(0)">
                        <path d="M732.8,252.8a74.7,74.7,0,0,0-36.3,36c-3.3,7,7.1,13.1,10.3,6.1a63.8,63.8,0,0,1,32-31.7c7-3.2.9-13.6-6-10.4Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-15" transform="translate(0)">
                        <path d="M700.2,367.9c5.4-6.7,17.5-8.1,25.5-9.5,4.9-.8,9.7-1.3,14.6-1.7s8.6-1.1,12.3,1.5c6.4,4.4,12.4-6,6.1-10.4-9.4-6.4-24-2.8-34.4-1.2s-25.4,4-32.6,12.8c-4.8,6,3.6,14.5,8.5,8.5Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-16" transform="translate(0)">
                        <path id="happy" d="M662.8,363.1c31.4-1.7,62.7-11.7,86.8-32.3l-5.8,1.5c-1-1.8-1.4-2-1.1-.5v7.7l.3,10.5c.1,6.1,1,12.8-.4,18.9-2.3,9.9-13.2,12.5-22.1,12.4s-19.8-4.5-28.8-9.1-18.7-9.7-23.8-18.3c-4-6.6-14.3-.6-10.4,6.1,8.2,13.6,24.8,21.6,38.9,27.6s31,8.7,45.2.9c17.4-9.6,13.6-31.4,13.2-48.1-.2-6.8.9-20.1-9.5-19.8-3.8,0-7.2,4.3-10.1,6.4a111,111,0,0,1-11.8,7.4c-18.5,10.3-39.6,15.5-60.7,16.7-7.6.4-7.7,12.4,0,12Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-17" transform="translate(0)">
                        <path d="M22.8,1116.7l320.8-3.7,91.7-1.1c7.7-.1,7.8-12.1,0-12l-320.9,3.7-91.6,1.1C15.1,1104.8,15,1116.8,22.8,1116.7Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-18" transform="translate(0)">
                        <path d="M82,1103.4q-3-203.1,1.4-406.2c2.9-135.3,8.7-270.6,16.4-405.7,4.3-75.6,8.1-151.3,3.7-226.9-.5-7.7-12.5-7.8-12,0,3.9,67.3,1.3,134.8-2.3,202.1S81.6,401.8,78.7,469.3q-8.5,203-9.8,406.2c-.4,75.9,0,152,1.1,227.9C70.1,1111.2,82.1,1111.2,82,1103.4Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-19" transform="translate(0)">
                        <path d="M95.6,71.8Q213.4,60.4,331.2,52.2T566.2,39q66.4-2.8,132.9-4.7c6.5-.2,6.6-12.2,0-12q-118.1,3.3-236,9.7t-235,16Q161.8,53.4,95.6,59.8C89.1,60.4,89.1,72.4,95.6,71.8Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-20" transform="translate(0)">
                        <path d="M374.2,39.9,154.5,246.6l-62,58.3c-4.6,4.4,2.6,11.2,7.3,6.8L319.5,105l62-58.3C386.2,42.3,378.9,35.5,374.2,39.9Z" fill="none"/>
                        </clipPath>
                        <clipPath id="clip-path-21" transform="translate(0)">
                        <path d="M691.5,33.2q1.1,86.4.3,172.9c0,7.7,12,7.7,12,0q.8-86.4-.3-172.9C703.4,25.5,691.4,25.5,691.5,33.2Z" fill="none"/>
                        </clipPath>
                    </defs>
                    <title>man2</title>
                    <g id="man">
                        <g id="mouth-2-grp">
                        <g clip-path="url(#clip-path)">
                            <path id="mouth-2-path" d="M682,372.5s10-37,34-42,29.6,27.3,28.8,31.1S741,381.5,726,382.5s-22,5-30-7a89.4,89.4,0,0,1-11.1-24.1" transform="translate(0)" fill="none" stroke="#482f2f" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="head1-grp">
                        <g clip-path="url(#clip-path-2)">
                            <path id="head1-path" d="M691,223.5s57,5,91,67-15,110-23,113-34,29-103-17-47-122-36-138,38-54,114-23" transform="translate(0)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="eye1-grp">
                        <g clip-path="url(#clip-path-3)">
                            <path id="eye1-path" d="M649,257.5l5,29" transform="translate(0)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="eye2-grp">
                        <g clip-path="url(#clip-path-4)">
                            <path id="eye2-path" d="M709.3,257.3l5,29" transform="translate(0)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="mouth-grp">
                        <g clip-path="url(#clip-path-5)">
                            <line id="mouth-path" x1="675" y1="359.5" x2="755" y2="356.5" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="body-grp">
                        <g clip-path="url(#clip-path-6)">
                            <path id="body-path" d="M728,393.5v141c0,54,13,219,13,219" transform="translate(0)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="left-arm-grp">
                        <g clip-path="url(#clip-path-7)">
                            <path id="left-arm-path" d="M745,481.5s-49,11-122-29-68-59-73-79" transform="translate(0)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="right-arm-grp">
                        <g clip-path="url(#clip-path-8)">
                            <path id="right-arm-path" d="M705.4,488.3S782,480.5,839,448.5s85-70,85-70" transform="translate(0)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="left-leg-grp">
                        <g clip-path="url(#clip-path-9)">
                            <path id="left-leg-path" d="M743.7,714.3S635,775.5,603,798.5s-64,48-64,62" transform="translate(0)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="right-leg-grp">
                        <g clip-path="url(#clip-path-10)">
                            <line id="right-leg-path" x1="732.2" y1="718.8" x2="872" y2="869.5" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="eye1-dead-grp1">
                        <g clip-path="url(#clip-path-11)">
                            <path id="eye1-dead-path1" d="M684.7,254.4s-42,11-53,48" transform="translate(0)" fill="none" stroke="#482f2f" stroke-miterlimit="10" stroke-width="20"/>
                        </g>
                        </g>
                        <g id="eye1-dead-grp2">
                        <g clip-path="url(#clip-path-12)">
                            <path id="eye1-dead-path2" d="M621.7,254.4s45,11,52,55" transform="translate(0)" fill="none" stroke="#482f2f" stroke-miterlimit="10" stroke-width="20"/>
                        </g>
                        </g>
                        <g id="eye2-dead-grp1">
                        <g clip-path="url(#clip-path-13)">
                            <path id="eye2-dead-path1" d="M686.2,252.4s42,11,53,48" transform="translate(0)" fill="none" stroke="#482f2f" stroke-miterlimit="10" stroke-width="20"/>
                        </g>
                        </g>
                        <g id="eye2-dead-grp2">
                        <g clip-path="url(#clip-path-14)">
                            <path id="eye2-dead-path2" d="M749.2,252.4s-45,11-52,55" transform="translate(0)" fill="none" stroke="#482f2f" stroke-miterlimit="10" stroke-width="20"/>
                        </g>
                        </g>
                        <g id="mouth-dead-grp">
                        <g clip-path="url(#clip-path-15)">
                            <path id="mouth-dead-path" d="M765.7,357.4s-11-8-20-7-37,2-45,9-14,12-14,14" transform="translate(0)" fill="none" stroke="#482f2f" stroke-miterlimit="10" stroke-width="20"/>
                        </g>
                        </g>
                        <g id="happy-grp">
                        <g clip-path="url(#clip-path-16)">
                            <path id="happy-path" d="M652,351.6s64.1,9.8,94.5-24.8c3.6,26.1,9.4,50.4-5.7,57.2s-35.3,3.3-53-7.2S650,345.9,650,345.9" transform="translate(0)" fill="none" stroke="#482f2f" stroke-miterlimit="10" stroke-width="30"/>
                        </g>
                        </g>
                    </g>
                    <g id="scaffold">
                        <g id="ground-grp">
                        <g clip-path="url(#clip-path-17)">
                            <line id="ground-path" x1="472" y1="1108.5" y2="1109.5" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="wood1-grp">
                        <g clip-path="url(#clip-path-18)">
                            <path id="wood1-path" d="M76,1120.5s-1-210-1-261,3-275,5-292,12-220,12-226,8-166,8-193-4-107-4-107" transform="translate(0)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="wood2-grp">
                        <g clip-path="url(#clip-path-19)">
                            <path id="wood2-path" d="M61,67.5s301-26,332-27,343-15,343-15" transform="translate(0)" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="wood3-grp">
                        <g clip-path="url(#clip-path-20)">
                            <line id="wood3-path" x1="397" y1="27.5" x2="59" y2="342.5" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                        <g id="wood4-grp">
                        <g clip-path="url(#clip-path-21)">
                            <line id="wood4-path" x1="697.5" x2="697.5" y2="252" fill="none" stroke="#433" stroke-miterlimit="10" stroke-width="25"/>
                        </g>
                        </g>
                    </g>
            </svg>
        </section>
        <section>
            <div class="h-100 flex-fill d-flex justify-content-center">
                    <div id="past-letters" class="d-flex justify-content-center align-items-center font-weight-bold"></div>
            </div>
        </section>
        <!-- END OF MAN -->
        <section class="d-flex justify-content-around align-items-center">
            <div id="letter-list" class="d-flex w-100 flex-column flex-md-row flex-wrap justify-content-center align-items-center"></div>
        </section>
        <section class="position-relative">
            <span id="wordCount"></span>
            <input type="text" name="letterinput" id="letterinput" class="text-center" size="2" maxlength="1" autofocus>
        </section>
    </main>

    <div class="d-flex justify-content-center p-4 text-white ui-modal" id="invalid-input-modal">
        <span>Invalid input!</span>
    </div>
    <div class="d-flex justify-content-center p-4 text-white ui-modal" id="gameWon-modal">
        <span>You won!</span>
    </div>
    <div class="d-flex justify-content-center p-4 text-white ui-modal" id="gameOver-modal">
        <span>Game over!</span>
    </div>
</body>

<!-- Word and letter templates -->
<template id="tmp-word">
        <div class="word d-flex mx-3 flex-wrap justify-content-center"></div>
</template>
<template id="tmp-letter">
    <div class="letter-frame position-relative d-flex align-items-end justify-content-center m-1">
                    <span class="text-uppercase"></span>
    </div>
</template>
</html>