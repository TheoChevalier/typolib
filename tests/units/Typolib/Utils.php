<?php
namespace tests\units\Typolib;

use atoum;
use Typolib\Utils as _Utils;

require_once __DIR__ . '/../bootstrap.php';

class Utils extends atoum\test
{
    public function sanitizeFileNameDP()
    {
        return [
            ['[test]', '#test#'],
            ['te st', 'te_st'],
            ['test../', 'test..#'],
            ['st@te', 'st#te'],
            ['te_st', 'te_st'],
            ['Test9', 'Test9'],
            ['Mon code!!!', 'Mon_code###'],
        ];
    }

    /**
     * @dataProvider sanitizeFileNameDP
     */
    public function testSanitizeFileName($a, $b)
    {
        $this
            ->string(_Utils::sanitizeFileName($a))
                ->isEqualTo($b);
    }
}
