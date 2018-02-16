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
 * @since     13.10.2016
 * @link      http://github.com/heiglandreas/org.heigl.TextStatistics
 */

namespace Org_Heigl\TextStatisticsTests\Calculator;

use Org_Heigl\TextStatistics\Calculator\WordCounter;
use Org_Heigl\TextStatistics\Calculator\WordsWithNSyllablesCounter;
use Org_Heigl\TextStatistics\Calculator\WordsWithNSyllablesPercentCalculator;
use Org_Heigl\TextStatistics\Text;
use Mockery as M;
use PHPUnit\Framework\TestCase;

/** @runTestsInSeparateProcesses */
class WordsWithNSyllablesPercentCalculatorTest extends TestCase
{
    public function testThatSyllablePercentageCounterWorks()
    {
        $text = new Text('Dieser tExt enthält die ein oder andere Silbe des Donaudampfschifffahrtskapitäns');

        $wordsWithNSyllables = M::mock('alias:' . WordsWithNSyllablesCounter::class);
        $wordsWithNSyllables->shouldReceive('calculate')->andReturn(3);

        $wordCounter = M::mock('alias:' . WordCounter::class);
        $wordCounter->shouldReceive('calculate')->andReturn(30);

        $calculator = new WordsWithNSyllablesPercentCalculator($wordsWithNSyllables, $wordCounter);
        $this->assertEquals(10, $calculator->calculate($text));
    }
}
