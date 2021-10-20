<?php
    require('controller/controller.php');
    
    try {
        if(!empty($_GET['page'])) {
            $page = $_GET['page'];
            switch($page) {
                case '../':
                    if(!empty($_POST['url'])) {
                        $url = $_POST['url'];
                        if(!filter_var($url, FILTER_VALIDATE_URL)) {
                            header('Location: ../?error=true&message=Adresse url non valide');
                            exit();
                        }
                        $shortcut = crypt($url, rand());
                        addUrl($url, $shortcut);
                    } else {
                        loadHomeView();
                    }
                    break;
                default:
                    throw new Exception('Cette page n\'existe pas ou a été suprimée !');
                    break;
            }
        } else if(!empty($_GET['q'])) {
            $shortcut = htmlspecialchars($_GET['q']);
            redirect($shortcut);
        } else {
            loadHomeView();
        }
    } catch(Exception $e) {
        die('Error : '.$e->getMessage());
    }