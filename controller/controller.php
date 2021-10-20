<?php
    require('model/UrlManager.php');

    function loadHomeView() {
        require('view/homeView.php');
    }

    function addUrl($url, $shortcut) {
        $urlManager = new UrlManager();
        if($urlManager->isExistingUrl($url)) {
            header('Location: ../?error=true&message=Adresse url déjà envoyée');
        }
        $result = $urlManager->insertUrl($url, $shortcut);
        if($result === false) {
            throw new Exception('Error : Impossible d\'insérer cette url !');
        } else {
            header('Location: ../?short='.$shortcut);
            exit();
        }
    }
    
    function redirect($shortcut) {
        $urlManager = new UrlManager();
        if(!$urlManager->isShortcut($shortcut)) {
            header('Location: ../?error=true&message=Adresse url non connue !');
            exit();
        }
        $result = $urlManager->getUrl($shortcut);
        header('Location: '.$result['url']);
        exit();
    }