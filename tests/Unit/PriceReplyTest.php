<?php

namespace Tests\Unit;

use Tests\TestCase;

use function App\Support\Chat\directPriceReply;

class PriceReplyTest extends TestCase
{
    public function test_a_vague_price_question_asks_category_or_exam_center(): void
    {
        foreach ([
            'kolku pari',
            'колку пари',
            'cena',
            'цени',
            'ги знаеш цените?',
            'gi znaes cenite',
        ] as $question) {
            $reply = directPriceReply($question, []);

            $this->assertNotNull($reply, $question);
            $this->assertStringContainsString('некоја категорија', $reply, $question);
            $this->assertStringContainsString('испитниот центар', $reply, $question);
            $this->assertStringNotContainsString('32000', $reply, $question);
            $this->assertStringNotContainsString('денари', (string) $reply, $question);
        }
    }

    public function test_an_exam_center_price_has_no_figure(): void
    {
        foreach ([
            'kolku pari za ispitniot centar',
            'цена за испитниот центар',
            'kolku e cenata za polaganje',
        ] as $question) {
            $reply = directPriceReply($question, []);

            $this->assertStringContainsString('Не ја знам цената за испитниот центар', (string) $reply, $question);
            $this->assertStringContainsString('Зависи од категоријата', (string) $reply, $question);
            $this->assertStringNotContainsString('денари', (string) $reply, $question);
        }
    }

    public function test_a_named_category_gets_only_that_training_price(): void
    {
        $car = directPriceReply('kolku cini kola', []);
        $this->assertStringContainsString('32000 денари', (string) $car);
        $this->assertStringContainsString('три месечни рати', (string) $car);
        $this->assertStringNotContainsString('30000', (string) $car);
        $this->assertStringNotContainsString('38000', (string) $car);

        $truck = directPriceReply('колку пари за камион', []);
        $this->assertStringContainsString('30000 денари', (string) $truck);
        $this->assertStringNotContainsString('32000', (string) $truck);

        $bus = directPriceReply('cena za avtobus', []);
        $this->assertStringContainsString('38000 денари', (string) $bus);

        $motor = directPriceReply('kolku pari za motor', []);
        $this->assertStringContainsString('24.000 денари', (string) $motor);
        $this->assertStringContainsString('26.000 денари', (string) $motor);
    }

    public function test_follow_up_chooses_exam_center_or_a_category(): void
    {
        $history = [[
            'role' => 'assistant',
            'content' => 'Дали прашувате за цена на некоја категорија, или ви треба цена за испитниот центар?',
        ]];

        $exam = directPriceReply('испитниот центар', $history);
        $this->assertStringContainsString('Не ја знам цената за испитниот центар', (string) $exam);
        $this->assertStringNotContainsString('денари', (string) $exam);

        $car = directPriceReply('кола', $history);
        $this->assertStringContainsString('32000 денари', (string) $car);

        $which = directPriceReply('за категорија', $history);
        $this->assertStringContainsString('За која категорија ви треба цената?', (string) $which);
    }

    public function test_a_category_after_the_exam_answer_still_has_no_exam_price(): void
    {
        $history = [[
            'role' => 'assistant',
            'content' => 'Не ја знам цената за испитниот центар. Зависи од категоријата што треба да се положи.',
        ]];

        $reply = directPriceReply('за Б', $history);

        $this->assertStringContainsString('Не ја знам цената за испитниот центар', (string) $reply);
        $this->assertStringNotContainsString('32000', (string) $reply);
    }
}
