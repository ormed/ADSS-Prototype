<?php
class Patient extends Person {

    private $LOS;
    private $ID;

    function setLOD($LOS) {
        $this->LOS = $LOS;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

}