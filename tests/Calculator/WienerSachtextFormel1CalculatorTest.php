<?php
/**
 * Copyright (c) Andreas Heigl<andreas@heigl.org>
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @since     14.10.2016
 * @link      http://github.com/heiglandreas/org.heigl.TextStatistics
 */

namespace Org_Heigl\TextStatisticsTests\Calculator;

use Mockery as M;
use Org_Heigl\TextStatistics\Calculator\AverageSentenceLengthCalculator;
use Org_Heigl\TextStatistics\Calculator\WienerSachtextFormel1Calculator;
use Org_Heigl\TextStatistics\Calculator\WordsWithNCharsPercentCalculator;
use Org_Heigl\TextStatistics\Calculator\WordsWithNSyllablesOnlyPercentCalculator;
use Org_Heigl\TextStatistics\Calculator\WordsWithNSyllablesPercentCalculator;
use Org_Heigl\TextStatistics\Text;
use PHPUnit\Framework\TestCase;

/** @runTestsInSeparateProcesses */
class WienerSachtextFormel1CalculatorTest extends TestCase
{
    public function testThatCalculationWorksAsExpected()
    {
        $percentWordsWithMoreThanThreeSyllables = M::mock('alias:' . WordsWithNSyllablesPercentCalculator::class);
        $percentWordsWithMoreThanThreeSyllables->shouldReceive('calculate')->andReturn(10);

        $averageSentenceLenght = M::mock('alias:' . AverageSentenceLengthCalculator::class);
        $averageSentenceLenght->shouldReceive('calculate')->andReturn(4.5);

        $percentWordsWithMoreThanSixChars = M::mock('alias:' . WordsWithNCharsPercentCalculator::class);
        $percentWordsWithMoreThanSixChars->shouldReceive('calculate')->andReturn(12);

        $percentSingleSyllableWords = M::mock('alias:' . WordsWithNSyllablesOnlyPercentCalculator::class);
        $percentSingleSyllableWords->shouldReceive('calculate')->andReturn(30);

        $text = new Text('Foo');

        $calculator = new WienerSachtextFormel1Calculator(
            $percentWordsWithMoreThanThreeSyllables,
            $averageSentenceLenght,
            $percentWordsWithMoreThanSixChars,
            $percentSingleSyllableWords
        );

        $result = $calculator->calculate($text);
        $this->assertEquals(2.39, round($result, 2));
    }
}
