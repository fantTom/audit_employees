<?php

declare(strict_types=1);

function testBrackets(string $str): bool
{
    if (!$str) {
        return false;
    }

    $brackets = str_split($str);
    $stack = [];
    $openingBrackets = ['{', '[', '('];
    $closingBrackets = ['}', ']', ')'];
    $reverseBrackets = array_combine($openingBrackets, $closingBrackets);

    foreach ($brackets as $char) {
        if (in_array($char, $openingBrackets)) {
            $stack[] = $char;
            continue;
        }

        if (in_array($char, $closingBrackets) && !empty($stack)) {
            $lastElement = $stack[count($stack) - 1];
            if ($reverseBrackets[$lastElement] == $char) {
                array_pop($stack);
                continue;
            }
        }

        return false;
    }

    return empty($stack);
}

function result(bool $val)
{
    echo $val ? 'Correct string.' : 'Incorrect string.';
    echo '<br>';
}


$brackets = key_exists('brackets', $_REQUEST) ? $_REQUEST['brackets'] : '';
result(testBrackets($brackets));

$str[] = '({([])()})';
$str[] = '{([)]}';
$str[] = '{[()]}';
$str[] = '{[()][{()()({[()]})(){}[]()}]}';
$str[] = '(((([][[{({{}})}]])){}))';
$str[] = '({{[]{(())}}})';
$str[] = ')({{[]{(())}}})';
$str[] = '({{[]{(())}}})(';
$str[] = '({[]{(())}()}))';

foreach ($str as $s) {
    result(testBrackets($s));
}
