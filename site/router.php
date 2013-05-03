<?php


function bfstopBuildRoute(&$query)
{
    $segments = array();
    if (isset($query['view']))
    {
        $segments[] = $query['view'];
        unset($query['view']);
        if (isset($query['token']))
        {
            $segments[] = $query['token'];
            unset($query['token']);
        }
    }
    return $segments;
}

function bfstopParseRoute($segments)
{
    $vars = array();
    switch ($segments[0])
    {
        case 'tokenunblock':
            $vars['view'] = 'tokenunblock';
            $vars['token'] = count($segments) > 1 ? (int)$segments[1] : 0;
            break;
       default:
            $vars['view'] = 'tokenunblock';
    }
    return $vars;
}
