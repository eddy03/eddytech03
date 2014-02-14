<?php

class Conf {
    
    static public function markdownPath( $absolutepath = false, $trailingDir = true ) {
        if($absolutepath) {
            if($trailingDir)
                return base_path() . DIRECTORY_SEPARATOR . 'markdown' . DIRECTORY_SEPARATOR;
            else
                return base_path() . DIRECTORY_SEPARATOR . 'markdown';            
        }
        else {
            if($trailingDir)
                return 'markdown' . DIRECTORY_SEPARATOR;
            else
                return 'markdown';
        }
    }
}