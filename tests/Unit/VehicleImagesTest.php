<?php

namespace Tests\Unit;

use Tests\TestCase;

use function App\Support\Chat\omitPhotoDenial;
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
