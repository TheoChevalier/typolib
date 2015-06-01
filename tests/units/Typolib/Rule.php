<?php
namespace tests\units\Typolib;

use atoum;
use Typolib\Rule as _Rule;

require_once __DIR__ . '/../bootstrap.php';

class Rule extends atoum\test
{
    public function checkQuotationMarkRuleDP()
    {
        return [
            ['"test"', ['«', '»'], ['«test»' , [0, 5]]],
            ['«test“', ['«', '»'], ['«test»' , [5]]],
            ['«test»', ['«', '»'], ['«test»' , []]],
        ];
    }

    /**
     * @dataProvider checkQuotationMarkRuleDP
     */
    public function testcheckQuotationMarkRule($string, $rule, $result)
    {
        $this
            ->array(_Rule::checkQuotationMarkRule($string, $rule))
                ->isEqualTo($result);
    }
}
