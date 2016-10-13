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

namespace Org_Heigl\TextStatistics\Service;

use Org\Heigl\Hyphenator\Hyphenator;
use Org\Heigl\Hyphenator\Options;
use Org_Heigl\TextStatistics\Calculator\AverageSentenceLengthCalculator;
use Org_Heigl\TextStatistics\Calculator\SentenceCounter;
use Org_Heigl\TextStatistics\Calculator\SyllableCounter;
use Org_Heigl\TextStatistics\Calculator\WienerSachtextFormel1Calculator;
use Org_Heigl\TextStatistics\Calculator\WordCounter;
use Org_Heigl\TextStatistics\Calculator\WordsWithNCharsCounter;
use Org_Heigl\TextStatistics\Calculator\WordsWithNCharsPercentCalculator;
use Org_Heigl\TextStatistics\Calculator\WordsWithNSyllablesCounter;
use Org_Heigl\TextStatistics\Calculator\WordsWithNSyllablesPercentCalculator;
use Org_Heigl\TextStatistics\Util\SyllableFilter;

class WienerSachtextFormel4CalculatorFactory
{
    public static function getCalculator()
    {
        return new WienerSachtextFormel1Calculator(
            new WordsWithNSyllablesPercentCalculator(WordsWithNSyllablesCounterFactory::getCalculator('de_DE', 3), new WordCounter()),
            new AverageSentenceLengthCalculator(new WordCounter(), new SentenceCounter())
        );
    }
}
