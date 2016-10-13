# Text-Statistics

Calculate text-statistics including Sylables, Flesch-Reading-Ease (english and german) and such things.

[![Build Status](https://travis-ci.org/heiglandreas/TextStatistics.svg?branch=master)](https://travis-ci.org/heiglandreas/TextStatistics)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/heiglandreas/TextStatistics/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/heiglandreas/TextStatistics/?branch=master)
[![Code Climate](https://codeclimate.com/github/heiglandreas/TextStatistics/badges/gpa.svg)](https://codeclimate.com/github/heiglandreas/TextStatistics)
[![StyleCI](https://styleci.io/repos/70740411/shield?branch=master)](https://styleci.io/repos/70740411)
[![Coverage Status](https://coveralls.io/repos/github/heiglandreas/TextStatistics/badge.svg?branch=master)](https://coveralls.io/github/heiglandreas/TextStatistics?branch=master)

[![Latest Stable Version](https://poser.pugx.org/org_heigl/textstatistics/v/stable)](https://packagist.org/packages/org_heigl/textstatistics)
[![Total Downloads](https://poser.pugx.org/org_heigl/textstatistics/downloads)](https://packagist.org/packages/org_heigl/textstatistics)
[![License](https://poser.pugx.org/org_heigl/textstatistics/license)](https://packagist.org/packages/org_heigl/textstatistics)
[![composer.lock](https://poser.pugx.org/org_heigl/textstatistics/composerlock)](https://packagist.org/packages/org_heigl/textstatistics)

## Why

The one other implementation [davechild/textstatistics](https://packagist.org/packages/davechild/textstatistics)
sadly only implements statistics for english texts. That sadly didn't work for texts with
f.e. german umlauts. So I decided to implement some of the algorithms again using work I
already did for a [hyphenator](https://packagist.org/packages/org_heigl/hyphenator).

That's why f.e. the syllable-calculation differs.


## Installation

TextStatistics is best installed using [composer](https://getcomposer.org)

## Usage

The different Calculators all implement a common ```CalculatorInterface```
and therefore all provide a ```calculate```-Method that expects a ```Text```-Object 
containing the Text to be calculated.
 
Currently these Statistics are avalable:
 
 * Average Sentence Length
 * Average Syllables per word
 * Character-Count (including Whitespace)
 * Character-Count (excluding whitespace)
 * Flesch-Reading-Ease for English texts
 * Flesch-Reading-Ease for German texts
 * Sentence-Count
 * Syllable-Count
 * Word-Count
 
There are Factory-Methods for each statistic available, so getting one of the statistics 
requires the following line of code:

```php
$text = new \Org_Heigl\TextStatistics\Text($theText);
$wordCount =\Org_Heigl\TextStatistics\Service\WordCounterFactory::getCalculator()->calculate($text);
$fleschReadingEase = /Org_Heigl\TextStatistics\Service\FleschReadingEaseCalculatorFactory::getCalculator()->calculate($text);
```

You can also add multiple Calculators to the TextStatisticsGenerator and retrieve multiple
Statistics in one go like this:

```php
$text = new \Org_Heigl\TextStatistics\Text($theText);

$statGenerator = new \Org_Heigl\TextStatistics\TextSTatisticsGenerator();
$statGenerator->add('wordCount', \Org_Heigl\TextStatistics\Service\WordCounterFactory::getCalculator());
$statGenerator->add('flesch', \Org_Heigl\TextStatistics\Service\FleschReadingEaseCalculatorFactory::getCalculator());

print_R($statGenerator->calculate($text));

// array(
//    'wordCount' => xx,
//    'flesch' => yy,
// )
```