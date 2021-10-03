<?php

    include 'template.class.php';
    $template = new template();

    $template->template_header('Home');

    $template->template_welcome();

    $template->template_footer('Copyright &copy; 2021 West Acton');
    
?>