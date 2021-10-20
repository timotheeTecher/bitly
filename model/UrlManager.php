<?php
    class UrlManager {
        
        private function connectToDB() {
            try {
                $dataBase = new PDO('mysql:host=localhost;dbname=bitly;charset=utf8', 'root', '');
                $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(Exception $e) {
                throw new Exception('Error :'.$e->getMessage());
            }

            return $dataBase;
        }

        public function isExistingUrl($url) {
            $dataBase = $this->connectToDB();
            $request  = $dataBase->prepare('SELECT COUNT(*) AS numberOfUrl FROM links WHERE url = :url');
            $request->execute(array('url' => $url));
            $result = $request->fetch();
            if($result['numberOfUrl'] != 0) {
                return true;
            }
            
            return false;
        }

        public function isShortcut($shortcut) {
            $dataBase = $this->connectToDB();
            $request  = $dataBase->prepare('SELECT COUNT(*) AS numberOfShortcut FROM links WHERE shortcut = :shortcut');
            $request->execute(array('shortcut' => $shortcut));
            $result = $request->fetch();
            if($result['numberOfShortcut'] != 1) {
                return false;
            }
            
            return true;
        }

        public function getUrl($shortcut) {
            $dataBase = $this->connectToDB();
            $request  = $dataBase->prepare('SELECT * FROM links WHERE shortcut = :shortcut');
            $request->execute(array('shortcut' => $shortcut));
            $result = $request->fetch();
            
            return $result;
        }

        public function insertUrl($url, $shortcut) {
            $dataBase = $this->connectToDB();
            $request  = $dataBase->prepare('INSERT INTO links(url, shortcut) VALUES(:url, :shortcut)');
            $result   = $request->execute(array(
                'url'      => $url,
                'shortcut' => $shortcut
            ));

            return $result;
        }
    }