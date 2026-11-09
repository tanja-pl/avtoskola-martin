<?php

namespace Tests\Unit;

use Tests\TestCase;

use function App\Support\Chat\directConsentReply;

class ConsentDocumentTest extends TestCase
{
    private string $directory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->directory = public_path('documents/consent');
        if (! is_dir($this->directory)) {
            mkdir($this->directory, 0755, true);
        }
    }

    public function test_a_consent_question_without_a_category_asks_which_one(): void
    {
        $reply = directConsentReply('ми треба согласност од родители', []);

        $this->assertNotNull($reply);
        $this->assertStringContainsString('Б, АМ и А1', $reply['reply']);
        $this->assertSame([], $reply['downloads']);
    }

    public function test_an_underage_visitor_with_a_known_category_gets_that_document(): void
    {
        $path = $this->directory.'/soglasnost-b.doc';
        $created = ! is_file($path);
        if ($created) {
            file_put_contents($path, "original-b-doc\n");
        }

        try {
            $reply = directConsentReply('малолетен сум', [[
                'role' => 'user',
                'content' => 'сакам да возам кола',
            ]]);

            $this->assertStringContainsString('категорија Б', $reply['reply']);
            $this->assertCount(1, $reply['downloads']);
            $this->assertSame('Преземи согласност за Б', $reply['downloads'][0]['label']);
            $this->assertSame('soglasnost-b.doc', $reply['downloads'][0]['filename']);
            $this->assertStringContainsString('/documents/consent/soglasnost-b.doc', $reply['downloads'][0]['url']);
            $this->assertSame("original-b-doc\n", (string) file_get_contents($path));
        } finally {
            if ($created) {
                @unlink($path);
            }
        }
    }

    public function test_follow_up_uses_the_category_they_choose(): void
    {
        $path = $this->directory.'/soglasnost-a1.doc';
        $created = ! is_file($path);
        if ($created) {
            file_put_contents($path, 'a1-doc');
        }

        try {
            $history = [[
                'role' => 'assistant',
                'content' => 'Согласност од родители имаме за категории Б, АМ и А1. За која од нив ви треба документот?',
            ]];
            $reply = directConsentReply('А1', $history);

            $this->assertSame('Преземи согласност за А1', $reply['downloads'][0]['label']);
            $this->assertSame('soglasnost-a1.doc', $reply['downloads'][0]['filename']);
        } finally {
            if ($created) {
                @unlink($path);
            }
        }
    }

    public function test_a_category_without_a_consent_form_offers_help(): void
    {
        foreach (['согласност за камион', 'малолетен сум и сакам категорија А'] as $question) {
            $reply = directConsentReply($question, []);

            $this->assertStringContainsString('немаме документ', $reply['reply'], $question);
            $this->assertStringContainsString('име и контакт телефон', $reply['reply']);
            $this->assertSame([], $reply['downloads']);
        }
    }

    public function test_schedule_agreement_is_not_a_consent_request(): void
    {
        $this->assertNull(directConsentReply('во согласност со инструкторот', []));
    }
}
