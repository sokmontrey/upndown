<?php
$BASE_PATH = $BASE_PATH ?? '';
$THEME = $THEME ?? 'light';
?>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/b71972c7cc.js" crossorigin="anonymous"></script>
    <style>
        @import url('<?=$BASE_PATH?>/app/styles/setup.css');
        @import url('<?=$BASE_PATH?>/app/styles/global.css');
        :root { /* Global variables for page theme */
            --bg-color: var(<?='--bg-'.$THEME?>);
            --text-color: var(<?='--text-'.$THEME?>);
            --text2-color: var(<?='--text2-'.$THEME?>);
            --primary-color: var(<?='--primary-'.$THEME?>);
            --secondary-color: var(<?='--secondary-'.$THEME?>);
        }
    </style>
    <title>UpNDown</title>
</head>

<body class="mono-font">
