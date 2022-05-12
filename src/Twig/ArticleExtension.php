<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ArticleExtension extends AbstractExtension
{


    public function getFunctions(): array
    {
        return [
            new TwigFunction('ttc', [$this, 'ttc']),
        ];
    }

    public function ttc($value)
    {
        return ($value + ($value*0.19));
    }
}
