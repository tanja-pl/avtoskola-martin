<?php

namespace Tests\Unit;

use Tests\TestCase;

use function App\Support\Chat\retrieveRelevantKnowledge;

class KnowledgeRetrievalTest extends TestCase
{
    public function test_a_car_question_answers_with_category_b_driving_days(): void
    {
        foreach ([
            'kolku denovi treba da vozam kola so instruktor?',
            'колку денови треба да возам кола со инструктор?',
            'how many days do I drive a car with an instructor?',
        ] as $question) {
            $knowledge = $this->knowledgeFor($question);

            $this->assertStringContainsString('36 наставни часа', $knowledge, $question);
            $this->assertStringContainsString('18 дена', $knowledge, $question);
            $this->assertStringNotContainsString('категорија Ц', $knowledge, $question);
        }
    }

    public function test_vehicle_words_retrieve_that_category_even_without_a_letter(): void
    {
        $motor = $this->knowledgeFor('kolku denovi treba da vozam motor so instruktor?');
        $this->assertStringContainsString('категорија А,А2,А1', $motor);
        $this->assertStringContainsString('8 дена', $motor);

        $truck = $this->knowledgeFor('колку денови треба да возам камион?');
        $this->assertStringContainsString('категорија Ц', $truck);
        $this->assertStringContainsString('10 дена', $truck);
        $this->assertStringNotContainsString('категорија ЦЕ', $truck);

        $bus = $this->knowledgeFor('kolku denovi treba da vozam avtobus?');
        $this->assertStringContainsString('категорија Д', $bus);
        $this->assertStringContainsString('8 дена', $bus);
    }

    public function test_a_car_price_question_retrieves_the_category_b_price(): void
    {
        $knowledge = $this->knowledgeFor('kolku cini kola');

        $this->assertStringContainsString('Обука за Б 32000 денари', $knowledge);
    }

    public function test_a_named_category_still_retrieves_its_own_training_length(): void
    {
        $knowledge = $this->knowledgeFor('kolku denovi treba da vozam za b kategorija?');

        $this->assertStringContainsString('36 наставни часа', $knowledge);
        $this->assertStringContainsString('18 дена', $knowledge);
    }

    private function knowledgeFor(string $question): string
    {
        return retrieveRelevantKnowledge(resource_path('knowledge'), $question, [
            'max_retrieved_chunks' => 4,
            'max_context_chars' => 2200,
            'always_include_core_facts' => true,
        ]);
    }
}
