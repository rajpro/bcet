<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?=base_url('home_assets/images/bcetfav.png')?>" type='image/png'>
    <title>BCET</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/jqvmap/jqvmap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" type="text/css"/>
    <style>
        @media (max-width: 767px){
            .custom-sidebar {
                height: auto !important;
            }
        }

        .ajax-loader {
            display: none;
            width: 100%;
            height: 100%;
            background-color: #0000007d;
            z-index: 9999;
            position: absolute;
            top: 0;
            left: 0;
            color: white;
        }
        
        .actions a {
            margin-right: 15px;
        }
        .actions a:last-child {
            margin-right: 0px;
        }
        .mdi-notifications {
            animation-iteration-count:infinite;
        }
        /* Keyframes...*/
        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            10% { transform: translate(-1px, -2px) rotate(-1deg); }
            20% { transform: translate(-3px, 0px) rotate(1deg); }
            30% { transform: translate(3px, 2px) rotate(0deg); }
            40% { transform: translate(1px, -1px) rotate(1deg); }
            50% { transform: translate(-1px, 2px) rotate(-1deg); }
            60% { transform: translate(-3px, 1px) rotate(0deg); }
            70% { transform: translate(3px, 1px) rotate(-1deg); }
            80% { transform: translate(-1px, -1px) rotate(1deg); }
            90% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -2px) rotate(-1deg); }
        }
    </style>
    <script>
    var base_url = '<?=base_url()?>';
    </script>
  </head>