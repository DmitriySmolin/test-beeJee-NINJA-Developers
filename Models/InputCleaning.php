<?php

namespace Models;

class InputCleaning
{
    /**
     * cleaning input from tags, slashes, spaces
     * @param string $inputStr
     * @return string $inputStr
     */
    public function clean(string $inputStr): string
    {
        $inputStr = htmlspecialchars(stripslashes(trim($inputStr)));
        return $inputStr;
    }
}