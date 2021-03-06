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
 * @since     12.10.2016
 * @link      http://github.com/heiglandreas/org.heigl.TextStatistics
 */

namespace Org_Heigl\TextStatisticsTests\Calculator;

use Mockery as M;
use Org_Heigl\TextStatistics\Calculator\AverageSyllablesPerWordCalculator;
use Org_Heigl\TextStatistics\Calculator\SyllableCounter;
use Org_Heigl\TextStatistics\Calculator\WordCounter;
use Org_Heigl\TextStatistics\Text;
use PHPUnit\Framework\TestCase;

/** @runTestsInSeparateProcesses */
class AverageSyllablesPerWordCalculatorTest extends TestCase
{
    public function testThatSyllablesPerWordAreCalculatedProperly()
    {
        $syllableCounter = M::mock('alias:' . SyllableCounter::class);
        $syllableCounter->shouldReceive('calculate')->andReturn(12);

        $wordCounter = M::mock('alias:' . WordCounter::class);
        $wordCounter->shouldReceive('calculate')->andReturn(3);

        $text = new Text('Dieser text enthält die ein oder andere Silbe des Donaudampfschifffahrtskapitäns');

        $averageSyllablesPerWord = new AverageSyllablesPerWordCalculator($syllableCounter, $wordCounter);

        $this->assertEquals(4, (int) $averageSyllablesPerWord->calculate($text));
    }
}
