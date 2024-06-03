<?php

function getArrayAsHTMLList(array $array, string $ulClass = '', string $liClass = ''): string
{

    $ulClass = $ulClass ? ' class="' . $ulClass . '"' : '';
    $liClass = $liClass ? ' class="' . $liClass . '"' : '';

    return '<ul' . $ulClass . '>'
        . implode(array_map(fn($v) => '<li' . $liClass . '>' . $v . '</li>', $array))
        . '</ul>';
}
