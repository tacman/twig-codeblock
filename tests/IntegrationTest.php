<?php

namespace Ramsey\Twig\CodeBlock\Test;

use Ramsey\Twig\CodeBlock\CodeBlockExtension;
use Twig\Test\IntegrationTestCase;

class IntegrationTest extends IntegrationTestCase
{
    protected function setUp()
    {
        exec('which pygmentize', $output, $return);

        if ($return === 1) {
            $this->fail('pygmentize not found; unable to run tests');
        }

        $pygmentsVersion = exec('pygmentize -V', $output, $return);

        if (preg_match('/2\.2\.?\d?/', $pygmentsVersion) === 0) {
            $this->fail(
                'Pygments version 2.2 is required to run the tests. However, '
                . 'this library will work with any version of Python and '
                . 'Pygments supported by the ramsey/pygments library. Found: '
                . $pygmentsVersion
            );
        }
    }

    public function getExtensions()
    {
        return [
            // Defaults to using pygmentize
            new CodeBlockExtension(),
        ];
    }

    public function getFixturesDir()
    {
        return __DIR__ . '/fixtures/integration/';
    }
}
