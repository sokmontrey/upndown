<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/b71972c7cc.js" crossorigin="anonymous"></script>
    <style>
        @import url('<?=BASE_PATH?>/app/styles/setup.css');
        @import url('<?=BASE_PATH?>/app/styles/global.css');
        :root { /* Global variables for page theme */
            --bg-color: var(<?='--bg-'.THEME?>);
            --txt-color: var(<?='--txt-'.THEME?>);
            --txt-sec-color: var(<?='--txt-sec-'.THEME?>);
            --prm-color: var(<?='--prm-'.THEME?>);
            --sur-color: var(<?='--sur-'.THEME?>);
            --err-color: var(<?='--err-'.THEME?>);
            --suc-color: var(<?='--suc-'.THEME?>);
        }
    </style>
    <title>Votio: Voting App</title>
</head>

<body class="mono-font">
