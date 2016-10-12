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

namespace Org_Heigl\TextStatistics\Calculator;

use Org\Heigl\Hyphenator\Tokenizer\PunctuationTokenizer;
use Org\Heigl\Hyphenator\Tokenizer\TokenizerRegistry;
use Org\Heigl\Hyphenator\Tokenizer\WhitespaceTokenizer;
use Org\Heigl\Hyphenator\Tokenizer\WordToken;
use Org_Heigl\TextStatistics\Text;

class WordCounter implements CalculatorInterface
{
    protected $tokenizer;

    public function __construct()
    {
        $this->tokenizer = new TokenizerRegistry();
        $this->tokenizer->add(new PunctuationTokenizer());
        $this->tokenizer->add(new WhitespaceTokenizer());
    }

    /**
     * Do the actual calculation of a statistic
     *
     * @param Text $text
     *
     * @return mixed
     */
    public function calculate(Text $text)
    {
        $tokens = $this->tokenizer->tokenize($text->getPlainText());
        foreach ($tokens as $token) {
            if (! $token instanceof WordToken) {
                $tokens->replace($token, []);
            }
        }

        return $tokens->count();
    }
}
