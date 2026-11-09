<?php

namespace Tests\Unit;

use Tests\TestCase;

use function App\Support\Chat\ensurePaymentSlipNotice;
use function App\Support\Chat\ensureSchoolPaymentNotice;
use function App\Support\Chat\omitPaymentSlipDenial;
use function App\Support\Chat\omitPhotoDenial;
use function App\Support\Chat\paymentSlipImagesForMessage;
use function App\Support\Chat\schoolPaymentImageForMessage;
use function App\Support\Chat\vehicleImagesForMessage;

class VehicleImagesTest extends TestCase
{
    public function test_price_question_does_not_attach_photos(): void
    {
        $images = vehicleImagesForMessage('Колку чини Б категорија?');

        $this->assertSame([], $images);
    }

    public function test_photo_request_returns_only_that_category(): void
    {
        $images = vehicleImagesForMessage('Покажи ми слика за Б категорија');
        $files = $this->filenames($images);

        $this->assertContains('b-1.png', $files);
        $this->assertNotContains('b-automatic.png', $files);
        $this->assertNotContains('a1.png', $files);
        $this->assertNotContains('c.jpg', $files);
    }

    public function test_motorcycle_photo_is_not_shared_across_categories(): void
    {
        $images = vehicleImagesForMessage('Сакам слика за A1');
        $files = $this->filenames($images);

        $this->assertSame(['a1.png'], $files);
    }

    public function test_category_a_photo_request_returns_all_three_images(): void
    {
        $images = vehicleImagesForMessage('Сакам слики за А категорија');
        $files = $this->filenames($images);

        $this->assertEqualsCanonicalizing(['a.png', 'a-category.png', 'a-category1.png'], $files);
        $this->assertNotContains('a1.png', $files);
        $this->assertNotContains('a2.png', $files);
        $this->assertNotContains('a2-category.png', $files);
    }

    public function test_motorcycle_photos_without_a_named_category_use_category_a(): void
    {
        foreach (['sliki od motorite', 'слики од моторите'] as $message) {
            $files = $this->filenames(vehicleImagesForMessage($message));

            $this->assertEqualsCanonicalizing(['a.png', 'a-category.png', 'a-category1.png'], $files);
            $this->assertNotContains('a1.png', $files);
            $this->assertNotContains('a2.png', $files);
            $this->assertNotContains('b-1.png', $files);
        }
    }

    public function test_car_photos_without_a_named_category_use_category_b(): void
    {
        foreach (['sliki od kolite', 'слики од колите'] as $message) {
            $files = $this->filenames(vehicleImagesForMessage($message));

            $this->assertContains('b-1.png', $files);
            $this->assertContains('b-8.png', $files);
            $this->assertNotContains('b-automatic.png', $files);
            $this->assertNotContains('a.png', $files);
            $this->assertNotContains('be.png', $files);
        }
    }

    public function test_a_named_category_wins_over_the_word_motorcycle(): void
    {
        $files = $this->filenames(vehicleImagesForMessage('слики од моторите за A2'));

        $this->assertEqualsCanonicalizing(['a2.png', 'a2-category.png'], $files);
        $this->assertNotContains('a.png', $files);
    }

    public function test_category_a2_photo_request_includes_the_category_image(): void
    {
        $images = vehicleImagesForMessage('Покажи слики за A2 категорија');
        $files = $this->filenames($images);

        $this->assertEqualsCanonicalizing(['a2.png', 'a2-category.png'], $files);
        $this->assertNotContains('a.png', $files);
    }

    public function test_a_shown_photo_reply_drops_the_apology_that_images_cannot_be_displayed(): void
    {
        $images = vehicleImagesForMessage('Сакам слики за А категорија');
        $reply = omitPhotoDenial(
            'Жал ми е, но немам можност да прикажам слики. Можам да ви дадам информации за категорија A, ако ви се потребни.',
            $images,
        );

        $this->assertStringNotContainsString('немам можност', $reply);
        $this->assertStringContainsString('Можам да ви дадам информации за категорија A', $reply);
    }

    public function test_a_reply_that_only_denies_photos_is_replaced_when_photos_are_shown(): void
    {
        $images = vehicleImagesForMessage('Сакам слики за А категорија');

        $this->assertSame(
            'Еве ги фотографиите.',
            omitPhotoDenial('Жал ми е, но немам можност да прикажам слики.', $images),
        );
    }

    public function test_category_without_a_photo_returns_nothing(): void
    {
        $this->assertSame([], vehicleImagesForMessage('Покажи слика за AM категорија'));
    }

    public function test_follow_up_photo_uses_the_category_already_discussed(): void
    {
        $images = vehicleImagesForMessage('Покажи слика', [
            ['role' => 'user', 'content' => 'Ме интересира Ц категорија'],
        ]);
        $files = $this->filenames($images);

        $this->assertContains('c.jpg', $files);
        $this->assertNotContains('ce.jpg', $files);
        $this->assertNotContains('b-1.png', $files);
    }

    public function test_payment_slip_questions_return_the_three_forms(): void
    {
        foreach ([
            'уплатница',
            'uplatnica',
            'uplata za poligon',
            'uplata za grad',
            'smetka',
            'сметка',
        ] as $question) {
            $images = paymentSlipImagesForMessage($question);
            $files = $this->filenames($images);

            $this->assertSame([
                'uplatnica1.png',
                'administrativna-taksa11.png',
                'generiranje-etest.png',
            ], $files, $question);
            $this->assertSame(['document', 'document', 'document'], array_column($images, 'kind'));
        }
    }

    public function test_a_polygon_question_without_payment_does_not_attach_slips(): void
    {
        $this->assertSame([], paymentSlipImagesForMessage('Каде е полигонот?'));
    }

    public function test_payment_reply_says_all_three_slips_are_required(): void
    {
        $slips = paymentSlipImagesForMessage('уплатница');
        $reply = ensurePaymentSlipNotice('Еве ги обрасците.', $slips);

        $this->assertStringContainsString('овие 3 уплатници', $reply);
        $this->assertStringContainsString('Еве ги обрасците.', $reply);
        $this->assertSame(
            'Веќе пишува за трите уплатници.',
            ensurePaymentSlipNotice('Веќе пишува за трите уплатници.', $slips),
        );
    }

    public function test_payment_reply_drops_the_missing_information_apology(): void
    {
        $slips = paymentSlipImagesForMessage('уплатница');
        $apology = 'Жал ми е, но ја немам точната информација за цените и сметките за уплата. Ве молам оставете име и контакт телефон, за тимот наскоро да стапи во контакт со вас.';

        $this->assertSame('', omitPaymentSlipDenial($apology, $slips));
        $this->assertSame(
            'Еве ги уплатниците.',
            omitPaymentSlipDenial('Еве ги уплатниците. '.$apology, $slips),
        );
        $this->assertSame($apology, omitPaymentSlipDenial($apology, []));
    }

    public function test_school_payment_questions_attach_the_school_slip(): void
    {
        foreach ([
            'Како можам да платам во автошкола?',
            'how can I pay in the driving school',
            'уплатница за автошкола',
            'uplatnica za avtoskola',
            'Како се плаќа обуката?',
        ] as $question) {
            $images = schoolPaymentImageForMessage($question);
            $files = $this->filenames($images);

            $this->assertSame(['uplatnica-avtoskola.jpg'], $files, $question);
            $this->assertSame(['document'], array_column($images, 'kind'));
            $this->assertSame([], $this->filenames(paymentSlipImagesForMessage($question)), $question);
        }
    }

    public function test_exam_slips_stay_separate_from_the_school_slip(): void
    {
        $this->assertSame([], schoolPaymentImageForMessage('уплатница'));
        $this->assertSame([], schoolPaymentImageForMessage('Каде е полигонот?'));
    }

    public function test_school_payment_reply_names_the_account_and_drops_the_apology(): void
    {
        $slips = schoolPaymentImageForMessage('како да платам');
        $reply = ensureSchoolPaymentNotice('Еве ја уплатницата.', $slips);

        $this->assertStringContainsString('270-0436012501-12', $reply);
        $this->assertStringContainsString('Еве ја уплатницата.', $reply);

        $apology = 'Жал ми е, но ја немам точната информација за уплата. Ве молам оставете име и контакт телефон, за тимот наскоро да стапи во контакт со вас.';
        $this->assertSame('', omitPaymentSlipDenial($apology, $slips));
    }

    /**
     * @param  list<array{url: string, alt: string}>  $images
     * @return list<string>
     */
    private function filenames(array $images): array
    {
        return array_map(static function (array $image): string {
            return rawurldecode(basename(parse_url($image['url'], PHP_URL_PATH) ?: ''));
        }, $images);
    }
}
